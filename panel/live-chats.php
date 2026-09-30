<?php
require_once __DIR__ . '/includes/auth.php';
requireLogin();
$db = getDB();

// Handle Delete or Management Actions
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['action'])) {
    if (!validateCSRF($_POST['csrf_token'] ?? '')) {
        $_SESSION['flash_msg'] = 'Security validation failed.';
        $_SESSION['flash_type'] = 'error';
    } else {
        $chatId = (int)($_POST['chat_id'] ?? 0);

        if ($_POST['action'] === 'delete_chat' && $chatId > 0) {
            $stmt = $db->prepare("DELETE FROM chat_conversations WHERE id = ?");
            $stmt->execute([$chatId]);
            $_SESSION['flash_msg'] = "Chat conversation #{$chatId} was permanently deleted.";
            $_SESSION['flash_type'] = 'success';
            header("Location: live-chats.php");
            exit;
        } elseif ($_POST['action'] === 'delete_all_test') {
            // Delete conversations without valid captured phone or test sessions
            $stmt = $db->prepare("DELETE FROM chat_conversations WHERE user_phone IS NULL OR user_phone = '' OR user_name LIKE '%test%'");
            $stmt->execute();
            $deletedCount = $stmt->rowCount();
            $_SESSION['flash_msg'] = "Cleaned up {$deletedCount} test / empty chat sessions.";
            $_SESSION['flash_type'] = 'info';
            header("Location: live-chats.php");
            exit;
        }
    }
}

// Handle Export Transcript as Plain Text Download
if (isset($_GET['export_txt'])) {
    $expId = (int)$_GET['export_txt'];
    $stmt = $db->prepare("SELECT * FROM chat_conversations WHERE id = ?");
    $stmt->execute([$expId]);
    $expChat = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($expChat) {
        $filename = 'chat_transcript_' . ($expChat['user_name'] ? preg_replace('/[^a-zA-Z0-9_-]/', '_', $expChat['user_name']) : 'visitor_' . $expId) . '_' . date('Y-m-d') . '.txt';
        header('Content-Type: text/plain; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        echo "=======================================================\n";
        echo "ANOTHER LEVEL LOFT CONVERSIONS - AI CHAT TRANSCRIPT\n";
        echo "=======================================================\n";
        echo "Chat ID:        #" . $expChat['id'] . "\n";
        echo "Session ID:     " . $expChat['session_id'] . "\n";
        echo "Date / Time:    " . $expChat['created_at'] . "\n";
        echo "Customer Name:  " . ($expChat['user_name'] ?: 'Not Provided') . "\n";
        echo "Phone:          " . ($expChat['user_phone'] ?: 'Not Provided') . "\n";
        echo "Postcode:       " . ($expChat['user_postcode'] ?: 'Not Provided') . "\n";
        echo "Area / Town:    " . ($expChat['area_town'] ?: 'Not Detected') . "\n";
        echo "Full Address:   " . ($expChat['user_address'] ?: 'Not Provided') . "\n";
        echo "Lead Captured:  " . ($expChat['lead_captured'] ? 'YES' : 'NO') . "\n";
        echo "Source Page:    " . ($expChat['source_page'] ?: 'Direct') . "\n";
        echo "=======================================================\n\n";

        $history = json_decode($expChat['transcript'] ?? '[]', true) ?: [];
        foreach ($history as $idx => $msg) {
            $sender = ($msg['sender'] ?? '') === 'bot' ? 'Sarah (Loft Specialist)' : ($expChat['user_name'] ?: 'Customer');
            $time = $msg['time'] ?? '';
            $text = trim($msg['text'] ?? '');
            echo "[{$time}] {$sender}:\n";
            echo "{$text}\n\n";
        }
        exit;
    }
}

// Handle Full CSV Export of all chats
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=another_level_chats_' . date('Y-m-d_His') . '.csv');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['ID', 'Date Created', 'Customer Name', 'Phone', 'Postcode', 'Area / Town', 'Address', 'Messages', 'Lead Captured', 'Source Page', 'Session ID']);
    $cStmt = $db->query("SELECT id, created_at, user_name, user_phone, user_postcode, area_town, user_address, message_count, lead_captured, source_page, session_id FROM chat_conversations ORDER BY id DESC");
    while ($r = $cStmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($out, [
            $r['id'],
            $r['created_at'],
            $r['user_name'] ?: 'Visitor #' . $r['id'],
            $r['user_phone'] ?: '',
            $r['user_postcode'] ?: '',
            $r['area_town'] ?: '',
            $r['user_address'] ?: '',
            $r['message_count'],
            $r['lead_captured'] ? 'Yes' : 'No',
            $r['source_page'] ?: '',
            $r['session_id']
        ]);
    }
    fclose($out);
    exit;
}

// Stats aggregation
$statsTotalChats = 0;
$statsCapturedLeads = 0;
$statsTotalMessages = 0;
try {
    $statsTotalChats = (int)$db->query("SELECT COUNT(*) FROM chat_conversations")->fetchColumn();
    $statsCapturedLeads = (int)$db->query("SELECT COUNT(*) FROM chat_conversations WHERE lead_captured = 1")->fetchColumn();
    $statsTotalMessages = (int)$db->query("SELECT COALESCE(SUM(message_count), 0) FROM chat_conversations")->fetchColumn();
} catch (Exception $e) {}

$conversionRate = $statsTotalChats > 0 ? round(($statsCapturedLeads / $statsTotalChats) * 100, 1) : 0;

// Search & Filter parameters
$searchQuery = trim($_GET['q'] ?? '');
$filterType = trim($_GET['filter'] ?? 'all'); // 'all', 'leads', 'exploratory', 'today'

$whereClauses = [];
$queryParams = [];

if (!empty($searchQuery)) {
    $whereClauses[] = "(user_name LIKE ? OR user_phone LIKE ? OR user_postcode LIKE ? OR area_town LIKE ? OR user_address LIKE ? OR transcript LIKE ?)";
    $like = "%{$searchQuery}%";
    $queryParams = array_merge($queryParams, [$like, $like, $like, $like, $like, $like]);
}

if ($filterType === 'leads') {
    $whereClauses[] = "lead_captured = 1";
} elseif ($filterType === 'exploratory') {
    $whereClauses[] = "lead_captured = 0";
} elseif ($filterType === 'today') {
    $whereClauses[] = "DATE(created_at) = DATE('now')";
}

$whereSql = !empty($whereClauses) ? "WHERE " . implode(" AND ", $whereClauses) : "";
$sql = "SELECT * FROM chat_conversations {$whereSql} ORDER BY id DESC";
$stmt = $db->prepare($sql);
$stmt->execute($queryParams);
$conversations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Identify Selected Conversation
$hasSelectedChat = isset($_GET['id']) && (int)$_GET['id'] > 0;
$focusedId = $hasSelectedChat ? (int)$_GET['id'] : 0;
$selectedChat = null;

if ($focusedId > 0) {
    foreach ($conversations as $c) {
        if ((int)$c['id'] === $focusedId) {
            $selectedChat = $c;
            break;
        }
    }
    // If not found in filtered list, try direct query
    if (!$selectedChat) {
        $cStmt = $db->prepare("SELECT * FROM chat_conversations WHERE id = ?");
        $cStmt->execute([$focusedId]);
        $selectedChat = $cStmt->fetch(PDO::FETCH_ASSOC);
    }
}

if (!$selectedChat && !empty($conversations)) {
    $selectedChat = $conversations[0];
    $focusedId = (int)$selectedChat['id'];
}

// If a chat is selected, decode its transcript and check for a linked booking
$transcriptMessages = [];
$linkedBooking = null;
if ($selectedChat) {
    $rawTranscript = $selectedChat['transcript'] ?? '[]';
    $transcriptMessages = json_decode($rawTranscript, true);
    if (!is_array($transcriptMessages)) {
        $transcriptMessages = [];
    }

    // Check if phone matches any booking
    if (!empty($selectedChat['user_phone'])) {
        $cleanPhone = preg_replace('/[^0-9]/', '', $selectedChat['user_phone']);
        if (strlen($cleanPhone) >= 7) {
            $bStmt = $db->prepare("SELECT id, name, phone, email, preferred_date, preferred_slot, status, created_at FROM bookings WHERE REPLACE(REPLACE(REPLACE(phone, ' ', ''), '-', ''), '+', '') LIKE ? ORDER BY id DESC LIMIT 1");
            $bStmt->execute(['%' . substr($cleanPhone, -8) . '%']);
            $linkedBooking = $bStmt->fetch(PDO::FETCH_ASSOC);
        }
    }
}

$pageTitle = "AI Live Chats & Transcripts";
$activeNav = "live-chats";
require_once __DIR__ . '/includes/header.php';
?>

<style>
/* Executive Live Chats Hub Styles */
.chat-hub-stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
  margin-bottom: 24px;
}
.chat-stat-card {
  background: var(--p-surface);
  border: 1px solid var(--p-border);
  border-radius: var(--p-radius);
  padding: 18px 20px;
  box-shadow: var(--p-shadow-sm);
  display: flex;
  align-items: center;
  gap: 16px;
}
.chat-stat-icon-wrap {
  width: 46px;
  height: 46px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.chat-stat-val {
  font-size: 24px;
  font-weight: 800;
  line-height: 1.1;
  color: var(--p-text);
  letter-spacing: -0.02em;
}
.chat-stat-lbl {
  font-size: 12.5px;
  font-weight: 600;
  color: var(--p-text-muted);
  text-transform: uppercase;
  letter-spacing: 0.04em;
  margin-top: 3px;
}

/* Split Chat Window */
.chat-split-container {
  display: grid;
  grid-template-columns: 360px 1fr;
  background: var(--p-surface);
  border: 1px solid var(--p-border);
  border-radius: var(--p-radius);
  box-shadow: var(--p-shadow-sm);
  height: 680px;
  max-height: calc(100vh - 250px);
  min-height: 480px;
  overflow: hidden;
}

/* Left Column: Conversations List */
.chat-list-pane {
  border-right: 1px solid var(--p-border);
  display: flex;
  flex-direction: column;
  background: #FAFBFA;
  overflow: hidden;
  height: 100%;
  min-height: 0;
}
.chat-list-header {
  padding: 14px 16px;
  border-bottom: 1px solid var(--p-border);
  background: #FFFFFF;
  flex-shrink: 0;
}
.chat-list-search-form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.chat-filter-chips {
  display: flex;
  align-items: center;
  gap: 6px;
  overflow-x: auto;
  padding-bottom: 2px;
}
.chat-filter-chip {
  font-size: 11.5px;
  font-weight: 600;
  padding: 4px 10px;
  border-radius: 20px;
  background: #EDF2E7;
  color: #3E5434;
  white-space: nowrap;
  border: 1px solid transparent;
  transition: all 0.15s ease;
}
.chat-filter-chip:hover {
  background: #DCE8D5;
}
.chat-filter-chip.active {
  background: var(--p-primary);
  color: #FFFFFF;
}

.chat-items-scroll {
  flex: 1 1 0%;
  min-height: 0;
  overflow-y: auto;
  overflow-x: hidden;
  padding: 8px 10px;
  scrollbar-width: none !important;
  -ms-overflow-style: none !important;
}
.chat-items-scroll::-webkit-scrollbar {
  display: none !important;
  width: 0px !important;
  height: 0px !important;
}

.chat-conv-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  padding: 13px 14px;
  border-radius: var(--p-radius);
  border: 1px solid transparent;
  margin-bottom: 6px;
  transition: all 0.15s ease;
  background: #FFFFFF;
  text-decoration: none;
  color: inherit;
  box-shadow: 0 1px 2px rgba(0,0,0,0.03);
  position: relative;
}
.chat-conv-item:hover {
  border-color: #D6E0D2;
  background: #F8FAF7;
  transform: translateY(-1px);
}
.chat-conv-item.active {
  background: #F0F6EE;
  border-color: #BDD4B5;
  box-shadow: 0 2px 8px rgba(79, 107, 66, 0.12);
}
.chat-conv-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #E2E8F0;
  color: #4A5568;
  font-weight: 700;
  font-size: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.chat-conv-item.active .chat-conv-avatar {
  background: var(--p-primary);
  color: #FFFFFF;
}
.chat-conv-item.has-lead .chat-conv-avatar {
  background: #2E7D32;
  color: #FFFFFF;
}
.chat-conv-meta {
  flex: 1;
  min-width: 0;
}
.chat-conv-top {
  display: flex;
  align-items: baseline;
  justify-content: space-between;
  margin-bottom: 3px;
}
.chat-conv-name {
  font-size: 14px;
  font-weight: 700;
  color: var(--p-text);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 170px;
}
.chat-conv-time {
  font-size: 11px;
  color: var(--p-text-muted);
  white-space: nowrap;
}
.chat-conv-sub {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 5px;
  margin-top: 4px;
}
.chat-badge-town {
  font-size: 11px;
  font-weight: 600;
  background: #EDF2E7;
  color: #4A5568;
  padding: 2px 7px;
  border-radius: 4px;
}
.chat-badge-lead {
  font-size: 11px;
  font-weight: 700;
  background: #E6F4EA;
  color: #137333;
  padding: 2px 8px;
  border-radius: 4px;
  display: inline-flex;
  align-items: center;
  gap: 3px;
}
.chat-badge-count {
  font-size: 11px;
  color: #718096;
}

/* Right Column: Active Conversation Viewer */
.chat-viewer-pane {
  display: flex;
  flex-direction: column;
  background: #FFFFFF;
  overflow: hidden;
  height: 100%;
  min-height: 0;
}
.chat-viewer-header {
  padding: 14px 22px;
  border-bottom: 1px solid var(--p-border);
  background: #FFFFFF;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
  flex-shrink: 0;
}
.chat-viewer-visitor {
  display: flex;
  align-items: center;
  gap: 14px;
}
.chat-viewer-avatar-large {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: var(--p-primary-light);
  color: var(--p-primary);
  font-size: 17px;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid #C8DEC2;
}
.chat-viewer-name {
  font-size: 16px;
  font-weight: 800;
  color: var(--p-text);
  line-height: 1.2;
}
.chat-viewer-details {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 4px;
  font-size: 12.5px;
  color: var(--p-text-muted);
}
.chat-viewer-details a {
  color: var(--p-primary);
  font-weight: 600;
  text-decoration: underline;
}

/* Dossier Card under header */
.chat-dossier-bar {
  background: #F7FAF6;
  border-bottom: 1px solid var(--p-border);
  padding: 10px 22px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
  font-size: 12.5px;
  flex-shrink: 0;
}
.dossier-item {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  color: #2D3748;
}
.dossier-label {
  font-weight: 600;
  color: #718096;
  text-transform: uppercase;
  font-size: 11px;
}

/* Stream / Messages Body */
.chat-stream-body {
  flex: 1 1 0%;
  min-height: 0;
  height: 100%;
  overflow-y: scroll; /* Force vertical scrollbar */
  overflow-x: hidden;
  padding: 22px 26px;
  background: #F4F6F3;
  display: flex;
  flex-direction: column;
  gap: 16px;
  scrollbar-width: none !important;
  -ms-overflow-style: none !important;
}
.chat-stream-body::-webkit-scrollbar {
  display: none !important;
  width: 0px !important;
  height: 0px !important;
}
.chat-bubble-row {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  max-width: 80%;
}
.chat-bubble-row.bot-row {
  align-self: flex-start;
}
.chat-bubble-row.user-row {
  align-self: flex-end;
  flex-direction: row-reverse;
}
.bubble-avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  font-weight: 700;
  flex-shrink: 0;
  margin-top: 2px;
}
.bubble-avatar.bot {
  background: #4F6B42;
  color: #FFFFFF;
  box-shadow: 0 2px 6px rgba(79,107,66,0.3);
}
.bubble-avatar.user {
  background: #2D3748;
  color: #FFFFFF;
}
.chat-bubble {
  padding: 12px 16px;
  border-radius: 14px;
  position: relative;
  line-height: 1.55;
  font-size: 13.5px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.06);
  word-break: break-word;
}
.chat-bubble-row.bot-row .chat-bubble {
  background: #FFFFFF;
  color: #1A1D1A;
  border: 1px solid #E2E8F0;
  border-top-left-radius: 4px;
}
.chat-bubble-row.user-row .chat-bubble {
  background: #2D4428;
  color: #FFFFFF;
  border-top-right-radius: 4px;
  box-shadow: 0 2px 6px rgba(45,68,40,0.25);
}
.chat-bubble-sender {
  font-size: 11.5px;
  font-weight: 700;
  margin-bottom: 4px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
}
.chat-bubble-row.bot-row .chat-bubble-sender {
  color: #4F6B42;
}
.chat-bubble-row.user-row .chat-bubble-sender {
  color: #A0C895;
}
.chat-bubble-time {
  font-size: 10.5px;
  font-weight: 500;
  opacity: 0.75;
}
.chat-bubble-text {
  white-space: pre-wrap;
}

/* Timeline milestone marker */
.chat-timeline-milestone {
  align-self: center;
  background: #E8F5E9;
  border: 1px solid #C8E6C9;
  color: #2E7D32;
  font-size: 12px;
  font-weight: 700;
  padding: 5px 16px;
  border-radius: 20px;
  display: flex;
  align-items: center;
  gap: 6px;
  margin: 6px 0;
  box-shadow: 0 1px 2px rgba(0,0,0,0.03);
}

/* Empty State */
.chat-empty-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
  padding: 40px;
  text-align: center;
  color: #718096;
}

/* Header Elements */
.chat-header-mobile-bar {
  display: none;
}
.chat-viewer-actions-desktop {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}
.chat-header-quick-actions {
  display: flex;
  align-items: center;
  gap: 6px;
}
.chat-quick-booking-pill {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  font-size: 11.5px;
  font-weight: 700;
  color: #FFFFFF;
  background: #2E7D32;
  padding: 4px 9px;
  border-radius: 6px;
  text-decoration: none;
  box-shadow: 0 1px 3px rgba(46,125,50,0.25);
  transition: all 0.15s;
}
.chat-quick-booking-pill:hover {
  background: #1B5E20;
  color: #FFFFFF;
}
.chat-quick-icon-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 30px;
  height: 30px;
  border-radius: 6px;
  background: #F7FAFC;
  border: 1px solid #E2E8F0;
  color: #4A5568;
  cursor: pointer;
  text-decoration: none;
  transition: all 0.15s;
}
.chat-quick-icon-btn:hover {
  background: #EDF2F7;
  color: #1A202C;
}
.chat-quick-icon-btn.danger {
  color: #E53E3E;
}
.chat-quick-icon-btn.danger:hover {
  background: #FFF5F5;
  border-color: #FEB2B2;
  color: #C53030;
}
.chat-badge-lead-inline {
  display: inline-flex;
  align-items: center;
  font-size: 10.5px;
  font-weight: 700;
  color: #2E7D32;
  background: #E8F5E9;
  border: 1px solid #C8E6C9;
  padding: 2px 7px;
  border-radius: 10px;
  line-height: 1.2;
}
.chat-badge-town-sm {
  display: inline-flex;
  align-items: center;
  font-size: 11px;
  font-weight: 600;
  color: #3E5434;
  background: #EBF2E7;
  padding: 2px 6px;
  border-radius: 4px;
}

@media (max-width: 1024px) {
  .chat-split-container {
    grid-template-columns: 1fr;
    max-height: none;
  }
  .chat-split-container.has-active-mobile .chat-list-pane {
    display: none !important;
  }
  .chat-split-container.hide-active-mobile .chat-viewer-pane {
    display: none !important;
  }
}

@media (max-width: 768px) {
  .panel-header-actions {
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
  }
  .panel-header-actions h1 {
    font-size: 20px !important;
  }
  .panel-header-actions p {
    font-size: 13px !important;
    line-height: 1.4;
  }
  .chat-header-btn-row,
  .panel-header-actions > div:last-child {
    width: 100% !important;
    display: flex !important;
    gap: 8px !important;
  }
  .chat-header-btn-row a.btn,
  .chat-header-btn-row form,
  .panel-header-actions > div:last-child a.btn,
  .panel-header-actions > div:last-child form {
    flex: 1 1 0% !important;
    margin: 0 !important;
  }
  .chat-header-btn-row a.btn,
  .chat-header-btn-row form button,
  .panel-header-actions > div:last-child form button {
    width: 100% !important;
    justify-content: center !important;
    font-size: 12px !important;
    padding: 7px 10px !important;
  }

  /* Sleek Compact 2x2 Stats Grid */
  .chat-hub-stats-grid {
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 10px !important;
    margin-bottom: 16px !important;
  }
  .chat-stat-card {
    padding: 10px 12px !important;
    gap: 10px !important;
    border-radius: 10px !important;
  }
  .chat-stat-icon-wrap {
    width: 38px !important;
    height: 38px !important;
    border-radius: 8px !important;
  }
  .chat-stat-icon-wrap svg {
    width: 18px !important;
    height: 18px !important;
  }
  .chat-stat-val {
    font-size: 19px !important;
  }
  .chat-stat-lbl {
    font-size: 10px !important;
    letter-spacing: 0.02em !important;
    margin-top: 1px !important;
    line-height: 1.25 !important;
  }

  /* Split Container & Mobile Workspace */
  .chat-split-container {
    height: auto !important;
    min-height: 520px !important;
    margin-bottom: calc(76px + env(safe-area-inset-bottom)) !important;
    border-radius: 12px !important;
  }
  .chat-viewer-pane {
    height: calc(100vh - 150px) !important;
    min-height: 520px !important;
  }
  
  /* Modern Compact Mobile Header */
  .chat-viewer-header {
    padding: 10px 12px !important;
    flex-direction: column !important;
    align-items: stretch !important;
    gap: 8px !important;
    background: #FFFFFF !important;
    border-bottom: 1px solid var(--p-border) !important;
  }
  .chat-header-mobile-bar {
    display: flex !important;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding-bottom: 7px;
    border-bottom: 1px solid #EDF2F7;
  }
  .btn-mobile-back {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    font-weight: 700;
    color: #4A5568;
    background: #EDF2F7;
    padding: 5px 9px;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.15s;
  }
  .btn-mobile-back:hover {
    background: #E2E8F0;
    color: #1A202C;
  }
  .chat-viewer-actions-desktop {
    display: none !important;
  }
  .chat-viewer-visitor {
    width: 100%;
    gap: 10px !important;
  }
  .chat-viewer-avatar-large {
    width: 38px !important;
    height: 38px !important;
    font-size: 15px !important;
    border-width: 1.5px !important;
    flex-shrink: 0 !important;
  }
  .chat-viewer-name {
    font-size: 14.5px !important;
    font-weight: 800 !important;
    color: #1A202C !important;
  }
  .chat-viewer-details {
    font-size: 11px !important;
    gap: 6px !important;
    margin-top: 2px !important;
    color: #718096 !important;
  }
  .chat-dossier-bar {
    display: none !important;
  }

  /* Chat Messages Stream */
  .chat-stream-body {
    padding: 14px 12px 28px 12px !important;
    gap: 12px !important;
    background: #F4F6F8 !important;
  }
  .chat-bubble-row {
    max-width: 92% !important;
    gap: 8px !important;
  }
  .chat-bubble {
    padding: 10px 13px !important;
    font-size: 13px !important;
    line-height: 1.45 !important;
  }
  .bubble-avatar {
    width: 28px !important;
    height: 28px !important;
    font-size: 11px !important;
  }
  .bubble-avatar svg {
    width: 14px !important;
    height: 14px !important;
  }
}
</style>

<!-- Page Header with Quick Export -->
<div class="panel-header-actions" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px">
  <div>
    <h1 style="font-size:24px;font-weight:800;color:var(--p-text);margin-bottom:4px;display:flex;align-items:center;gap:10px">
      <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--p-primary)"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
      AI Live Chat Conversations
    </h1>
    <p style="font-size:14px;color:var(--p-text-muted)">
      Real-time homeowner conversations, AI responses by Sarah, verified postcodes, and captured survey bookings.
    </p>
  </div>
  <div class="chat-header-btn-row" style="display:flex;align-items:center;gap:10px">
    <a href="live-chats.php?export=csv" class="btn btn-secondary btn-sm" title="Export all conversation logs to CSV">
      <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
      <span>Export All CSV</span>
    </a>
    <form method="POST" action="live-chats.php" class="js-confirm-form"
          data-confirm-title="Clean Up Test Chat Sessions?"
          data-confirm-message="Are you sure you want to clean up sessions without valid phone numbers or test chats? This will remove dummy entries from your live chat hub."
          data-confirm-btn="Yes, Clean Up"
          data-confirm-type="warning"
          style="margin:0">
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCsrfToken()); ?>">
      <input type="hidden" name="action" value="delete_all_test">
      <button type="submit" class="btn btn-secondary btn-sm" style="color:#C53030">
        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
        <span>Clean Test Chats</span>
      </button>
    </form>
  </div>
</div>

<!-- 4 Top Executive Stat Cards -->
<div class="chat-hub-stats-grid">
  <div class="chat-stat-card">
    <div class="chat-stat-icon-wrap" style="background:#EBF2E7;color:#3E5434">
      <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
    </div>
    <div>
      <div class="chat-stat-val"><?php echo number_format($statsTotalChats); ?></div>
      <div class="chat-stat-lbl">Total Conversations</div>
    </div>
  </div>

  <div class="chat-stat-card">
    <div class="chat-stat-icon-wrap" style="background:#E8F5E9;color:#2E7D32">
      <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
    </div>
    <div>
      <div class="chat-stat-val" style="color:#2E7D32"><?php echo number_format($statsCapturedLeads); ?></div>
      <div class="chat-stat-lbl">Survey Leads Captured</div>
    </div>
  </div>

  <div class="chat-stat-card">
    <div class="chat-stat-icon-wrap" style="background:#E3F2FD;color:#1565C0">
      <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
    </div>
    <div>
      <div class="chat-stat-val"><?php echo number_format($statsTotalMessages); ?></div>
      <div class="chat-stat-lbl">Total Messages Sent</div>
    </div>
  </div>

  <div class="chat-stat-card">
    <div class="chat-stat-icon-wrap" style="background:#FFF3E0;color:#E65100">
      <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
    </div>
    <div>
      <div class="chat-stat-val" style="color:#E65100"><?php echo $conversionRate; ?>%</div>
      <div class="chat-stat-lbl">Lead Conversion Rate</div>
    </div>
  </div>
</div>

<!-- Main Split Chat Workspace -->
<div class="chat-split-container <?php echo $hasSelectedChat ? 'has-active-mobile' : 'hide-active-mobile'; ?>">
  
  <!-- Left Side: Conversation Search & List -->
  <div class="chat-list-pane">
    <div class="chat-list-header">
      <form method="GET" action="live-chats.php" class="chat-list-search-form">
        <div style="position:relative">
          <input 
            type="text" 
            name="q" 
            class="form-input" 
            style="padding-left:34px;height:38px;font-size:13px;width:100%" 
            placeholder="Search visitor, phone, town..." 
            value="<?php echo htmlspecialchars($searchQuery); ?>"
          >
          <svg style="position:absolute;left:10px;top:10px;color:#A0AEC0" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        </div>

        <div class="chat-filter-chips">
          <a href="live-chats.php<?php echo !empty($searchQuery) ? '?q=' . urlencode($searchQuery) : ''; ?>" class="chat-filter-chip <?php echo $filterType === 'all' ? 'active' : ''; ?>">All (<?php echo $statsTotalChats; ?>)</a>
          <a href="live-chats.php?filter=leads<?php echo !empty($searchQuery) ? '&q=' . urlencode($searchQuery) : ''; ?>" class="chat-filter-chip <?php echo $filterType === 'leads' ? 'active' : ''; ?>">Leads (<?php echo $statsCapturedLeads; ?>)</a>
          <a href="live-chats.php?filter=exploratory<?php echo !empty($searchQuery) ? '&q=' . urlencode($searchQuery) : ''; ?>" class="chat-filter-chip <?php echo $filterType === 'exploratory' ? 'active' : ''; ?>">Inquiries</a>
          <a href="live-chats.php?filter=today<?php echo !empty($searchQuery) ? '&q=' . urlencode($searchQuery) : ''; ?>" class="chat-filter-chip <?php echo $filterType === 'today' ? 'active' : ''; ?>">Today</a>
        </div>
      </form>
    </div>

    <!-- Scrollable Chat Items -->
    <div class="chat-items-scroll">
      <?php if (empty($conversations)): ?>
        <div style="text-align:center;padding:40px 20px;color:#A0AEC0;font-size:13px">
          <svg viewBox="0 0 24 24" width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.5" style="margin:0 auto 10px;display:block;opacity:0.6"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
          No conversations found matching filters.
        </div>
      <?php else: ?>
        <?php foreach ($conversations as $c): 
          $isActive = $selectedChat && (int)$selectedChat['id'] === (int)$c['id'];
          $hasLead = (int)($c['lead_captured'] ?? 0) === 1;
          $cName = !empty($c['user_name']) ? $c['user_name'] : 'Visitor #' . $c['id'];
          $initial = strtoupper(substr(trim($cName), 0, 1));
          $msgCount = (int)($c['message_count'] ?? 0);
          $timeAgo = date('d M, H:i', strtotime($c['created_at']));
        ?>
          <a href="live-chats.php?id=<?php echo $c['id']; ?><?php echo !empty($searchQuery) ? '&q=' . urlencode($searchQuery) : ''; ?><?php echo $filterType !== 'all' ? '&filter=' . urlencode($filterType) : ''; ?>" class="chat-conv-item <?php echo $isActive ? 'active' : ''; ?> <?php echo $hasLead ? 'has-lead' : ''; ?>">
            <div class="chat-conv-avatar">
              <?php echo $initial ?: '#'; ?>
            </div>
            <div class="chat-conv-meta">
              <div class="chat-conv-top">
                <span class="chat-conv-name" title="<?php echo htmlspecialchars($cName); ?>">
                  <?php echo htmlspecialchars($cName); ?>
                </span>
                <span class="chat-conv-time"><?php echo $timeAgo; ?></span>
              </div>
              
              <div style="font-size:12px;color:#718096;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                <?php if (!empty($c['user_phone'])): ?>
                  <span>📞 <?php echo htmlspecialchars($c['user_phone']); ?></span>
                <?php else: ?>
                  <span>Loft conversion query</span>
                <?php endif; ?>
              </div>

              <div class="chat-conv-sub">
                <?php if (!empty($c['area_town'])): ?>
                  <span class="chat-badge-town"><?php echo htmlspecialchars($c['area_town']); ?></span>
                <?php elseif (!empty($c['user_postcode'])): ?>
                  <span class="chat-badge-town"><?php echo htmlspecialchars($c['user_postcode']); ?></span>
                <?php endif; ?>

                <?php if ($hasLead): ?>
                  <span class="chat-badge-lead">✓ Lead Captured</span>
                <?php endif; ?>

                <span class="chat-badge-count"><?php echo $msgCount; ?> msgs</span>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <!-- Right Side: Active Transcript Viewer -->
  <div class="chat-viewer-pane">
    <?php if ($selectedChat): 
      $vName = !empty($selectedChat['user_name']) ? $selectedChat['user_name'] : 'Visitor #' . $selectedChat['id'];
      $vPhone = $selectedChat['user_phone'] ?? '';
      $vPostcode = $selectedChat['user_postcode'] ?? '';
      $vTown = $selectedChat['area_town'] ?? '';
      $vAddress = $selectedChat['user_address'] ?? '';
      $vSource = $selectedChat['source_page'] ?? '';
      $isCaptured = (int)($selectedChat['lead_captured'] ?? 0) === 1;
    ?>
      <!-- Active Chat Top Navigation & Controls -->
      <div class="chat-viewer-header">
        <!-- Top Bar on Mobile (Back button + Quick action icons) -->
        <div class="chat-header-mobile-bar">
          <a href="live-chats.php" class="btn-mobile-back" id="mobileBackBtn">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
            <span>All Chats</span>
          </a>
          <div class="chat-header-quick-actions">
            <?php if ($linkedBooking): ?>
              <a href="bookings.php?lead_id=<?php echo $linkedBooking['id']; ?>" class="chat-quick-booking-pill" title="View Booking #<?php echo $linkedBooking['id']; ?> in Survey Leads">
                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect><path d="M9 14l2 2 4-4"></path></svg>
                <span>#<?php echo $linkedBooking['id']; ?></span>
              </a>
            <?php endif; ?>

            <a href="live-chats.php?export_txt=<?php echo $selectedChat['id']; ?>" class="chat-quick-icon-btn" title="Download Plain Text Transcript">
              <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            </a>

            <form method="POST" action="live-chats.php" class="js-confirm-form"
                  data-confirm-title="Delete Chat Conversation?"
                  data-confirm-message="Permanently delete the conversation transcript with <?php echo htmlspecialchars(addslashes($vName)); ?>? This action cannot be undone."
                  data-confirm-btn="Yes, Delete"
                  data-confirm-type="danger"
                  style="margin:0;display:inline-flex">
              <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCsrfToken()); ?>">
              <input type="hidden" name="action" value="delete_chat">
              <input type="hidden" name="chat_id" value="<?php echo $selectedChat['id']; ?>">
              <button type="submit" class="chat-quick-icon-btn danger" title="Permanently delete this conversation">
                <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
              </button>
            </form>
          </div>
        </div>

        <!-- Visitor Identity -->
        <div class="chat-viewer-visitor">
          <div class="chat-viewer-avatar-large">
            <?php echo strtoupper(substr($vName, 0, 1)) ?: '#'; ?>
          </div>
          <div style="flex:1;min-width:0">
            <div style="display:flex;align-items:center;gap:7px;flex-wrap:wrap">
              <div class="chat-viewer-name" style="word-break:break-word"><?php echo htmlspecialchars($vName); ?></div>
              <?php if ($isCaptured): ?>
                <span class="chat-badge-lead-inline">✓ Lead</span>
              <?php endif; ?>
            </div>
            <div class="chat-viewer-details">
              <?php if (!empty($vPhone)): ?>
                <span>📞 <a href="tel:<?php echo htmlspecialchars($vPhone); ?>"><?php echo htmlspecialchars($vPhone); ?></a></span>
              <?php endif; ?>
              <?php if (!empty($vTown)): ?>
                <span class="chat-badge-town-sm">📍 <?php echo htmlspecialchars($vTown); ?><?php if (!empty($vPostcode)): ?> (<?php echo htmlspecialchars($vPostcode); ?>)<?php endif; ?></span>
              <?php elseif (!empty($vPostcode)): ?>
                <span class="chat-badge-town-sm">📍 <?php echo htmlspecialchars($vPostcode); ?></span>
              <?php endif; ?>
              <span style="opacity:0.75">Started: <?php echo date('d M, H:i', strtotime($selectedChat['created_at'])); ?></span>
            </div>
          </div>
        </div>

        <!-- Action Buttons (Desktop view) -->
        <div class="chat-viewer-actions chat-viewer-actions-desktop">
          <?php if ($linkedBooking): ?>
            <a href="bookings.php?lead_id=<?php echo $linkedBooking['id']; ?>" class="btn btn-primary btn-sm chat-btn-booking" style="background:#2E7D32;border-color:#2E7D32" title="Open Lead in Survey Leads Manager">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect><path d="M9 14l2 2 4-4"></path></svg>
              <span>View Booking #<?php echo $linkedBooking['id']; ?> &rarr;</span>
            </a>
          <?php endif; ?>

          <a href="live-chats.php?export_txt=<?php echo $selectedChat['id']; ?>" class="btn btn-secondary btn-sm chat-btn-download" title="Download Plain Text Transcript">
            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            <span>Download Transcript</span>
          </a>

          <form method="POST" action="live-chats.php" class="js-confirm-form"
                data-confirm-title="Delete Chat Conversation?"
                data-confirm-message="Permanently delete the conversation transcript with <?php echo htmlspecialchars(addslashes($vName)); ?>? This action cannot be undone."
                data-confirm-btn="Yes, Delete"
                data-confirm-type="danger"
                style="margin:0">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(getCsrfToken()); ?>">
            <input type="hidden" name="action" value="delete_chat">
            <input type="hidden" name="chat_id" value="<?php echo $selectedChat['id']; ?>">
            <button type="submit" class="btn btn-secondary btn-sm chat-btn-delete" style="color:#C53030" title="Permanently delete this conversation">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
              <span>Delete</span>
            </button>
          </form>
        </div>
      </div>

      <!-- Dossier Strip Bar -->
      <div class="chat-dossier-bar">
        <div style="display:flex;align-items:center;gap:18px;flex-wrap:wrap">
          <div class="dossier-item">
            <span class="dossier-label">Status:</span>
            <?php if ($isCaptured): ?>
              <span class="chat-badge-lead">✓ Lead Auto-Captured</span>
            <?php else: ?>
              <span style="color:#718096;font-size:12px">General Inquiry</span>
            <?php endif; ?>
          </div>

          <?php if (!empty($vAddress)): ?>
            <div class="dossier-item">
              <span class="dossier-label">Address:</span>
              <strong style="color:#1A202C"><?php echo htmlspecialchars($vAddress); ?></strong>
            </div>
          <?php endif; ?>

          <?php if (!empty($vSource)): ?>
            <div class="dossier-item">
              <span class="dossier-label">Origin Page:</span>
              <a href="<?php echo htmlspecialchars(getSitePageUrl($selectedChat['site_id'] ?? 1, $vSource)); ?>" target="_blank" style="color:var(--p-primary);font-weight:600">
                <?php echo htmlspecialchars($vSource); ?> &nearr;
              </a>
            </div>
          <?php endif; ?>
        </div>

        <div style="font-size:12px;color:#718096">
          Session ID: <code><?php echo htmlspecialchars($selectedChat['session_id']); ?></code>
        </div>
      </div>

      <!-- Messages Stream Scroll Area -->
      <div class="chat-stream-body" id="chatStreamScroll">
        <?php if (empty($transcriptMessages)): ?>
          <div style="text-align:center;padding:50px 20px;color:#A0AEC0">
            No message exchange logged for this session.
          </div>
        <?php else: ?>
          <?php 
          $postcodeAnnounced = false;
          $leadAnnounced = false;
          foreach ($transcriptMessages as $msg): 
            $isBot = ($msg['sender'] ?? '') === 'bot';
            $senderLabel = $isBot ? 'Sarah (Loft Specialist)' : $vName;
            $msgTime = !empty($msg['time']) ? date('H:i', strtotime($msg['time'])) : '';
            $text = trim($msg['text'] ?? '');

            // Render Markdown bold (**text**) cleanly
            $formattedText = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', htmlspecialchars($text));
            $formattedText = nl2br($formattedText);
          ?>
            <div class="chat-bubble-row <?php echo $isBot ? 'bot-row' : 'user-row'; ?>">
              <div class="bubble-avatar <?php echo $isBot ? 'bot' : 'user'; ?>">
                <?php if ($isBot): ?>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                <?php else: ?>
                  <?php echo strtoupper(substr($vName, 0, 1)) ?: 'U'; ?>
                <?php endif; ?>
              </div>
              <div class="chat-bubble">
                <div class="chat-bubble-sender">
                  <span><?php echo htmlspecialchars($senderLabel); ?></span>
                  <span class="chat-bubble-time"><?php echo $msgTime; ?></span>
                </div>
                <div class="chat-bubble-text"><?php echo $formattedText; ?></div>
              </div>
            </div>

            <?php 
            // Show milestone marker after postcode verification
            if (!$postcodeAnnounced && !empty($vTown) && stripos($text, $vTown) !== false && $isBot): 
              $postcodeAnnounced = true;
            ?>
              <div class="chat-timeline-milestone">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
                <span>UK Postcode Verified: <?php echo htmlspecialchars($vTown); ?> (<?php echo htmlspecialchars($vPostcode); ?>)</span>
              </div>
            <?php endif; ?>

            <?php 
            // Show milestone marker for lead capture
            if (!$leadAnnounced && $isCaptured && stripos($text, 'survey') !== false && $isBot): 
              $leadAnnounced = true;
            ?>
              <div class="chat-timeline-milestone" style="background:#EBF3FF;border-color:#BFDBFE;color:#1E40AF">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                <span>Free Survey Request Auto-Captured into CRM</span>
              </div>
            <?php endif; ?>

          <?php endforeach; ?>
        <?php endif; ?>
      </div>

    <?php else: ?>
      <!-- Empty State when no conversation is selected -->
      <div class="chat-empty-state">
        <svg viewBox="0 0 24 24" width="60" height="60" fill="none" stroke="currentColor" stroke-width="1.2" style="opacity:0.4;margin-bottom:16px"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
        <h3 style="font-size:18px;font-weight:700;color:var(--p-text);margin-bottom:6px">No Chat Selected</h3>
        <p style="font-size:14px;max-width:320px;line-height:1.5">
          Select a visitor from the list on the left to review their live chat transcript, phone number, and survey booking details.
        </p>
      </div>
    <?php endif; ?>
  </div>

</div>

<script>
// Auto scroll transcript to the bottom on load
function scrollChatToBottom() {
  var stream = document.getElementById('chatStreamScroll');
  if (stream) {
    stream.scrollTop = stream.scrollHeight;
  }
}
document.addEventListener('DOMContentLoaded', scrollChatToBottom);
window.addEventListener('load', function() {
  setTimeout(scrollChatToBottom, 80);
});

</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
