<?php
/**
 * Another Level Loft Conversions - AI Live Chat Widget
 * Desktop: Floating pill button in bottom right.
 * Mobile: Floating pill hidden; triggered via sticky footer dock button.
 */

if (!function_exists('getDB')) {
    require_once __DIR__ . '/../panel/includes/db.php';
}

$chatDb = getDB();
$chatSettings = [];
try {
    $cStmt = $chatDb->query("SELECT key, value FROM settings WHERE key IN ('ai_chat_enabled', 'ai_chat_name')");
    $chatSettings = $cStmt->fetchAll(PDO::FETCH_KEY_PAIR);
} catch (Throwable $e) {}

$isChatEnabled = ($chatSettings['ai_chat_enabled'] ?? '1') === '1';
$assistantName = htmlspecialchars($chatSettings['ai_chat_name'] ?? 'Sarah — Loft Specialist');

if (!$isChatEnabled) {
    return;
}
?>

<!-- Link AI Live Chat Stylesheet -->
<link rel="stylesheet" href="css/chat.css?v=<?php echo filemtime(__DIR__ . '/../css/chat.css'); ?>">

<!-- Mobile Backdrop Dimmer -->
<div class="ai-chat-backdrop" id="aiChatBackdrop" onclick="closeAIChat()"></div>

<!-- Floating Launcher Button (DESKTOP ONLY - Hidden on Mobile via CSS) -->
<div class="ai-chat-launcher-floating" id="aiChatLauncherDesktop">
  <div class="ai-chat-tooltip" onclick="openAIChat(event)">
    <span>👋 Have a question? <strong>Chat with Sarah</strong></span>
  </div>
  <button type="button" class="ai-chat-pill-btn" onclick="openAIChat(event)" aria-label="Open AI Live Chat with Loft Specialist">
    <div class="ai-chat-avatar-wrap">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
        <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z"/>
      </svg>
      <span class="ai-chat-online-dot"></span>
    </div>
    <span>Live Chat</span>
  </button>
</div>

<!-- Chat Window / Mobile Bottom Sheet -->
<div class="ai-chat-modal" id="aiChatModal" role="dialog" aria-modal="true" aria-labelledby="aiChatTitle">
  
  <!-- Header -->
  <div class="ai-chat-header">
    <span class="ai-chat-drag-handle"></span>
    <div class="ai-chat-header-info">
      <div class="ai-chat-header-avatar">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
        </svg>
      </div>
      <div class="ai-chat-header-text">
        <h3 id="aiChatTitle"><?php echo $assistantName; ?></h3>
        <div class="ai-chat-status">Online • Typically replies instantly</div>
      </div>
    </div>
    <div class="ai-chat-header-actions">
      <button type="button" class="ai-chat-header-btn" onclick="resetAIChat()" title="Start New Chat" aria-label="Start New Chat">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M3 12a9 9 0 0 1 15-6.7L21 8"/>
          <path d="M21 3v5h-5"/>
          <path d="M21 12a9 9 0 0 1-15 6.7L3 16"/>
          <path d="M3 21v-5h5"/>
        </svg>
      </button>
      <button type="button" class="ai-chat-header-btn" onclick="closeAIChat()" title="Close Chat" aria-label="Close chat">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>
  </div>

  <!-- Messages Scroll Area -->
  <div class="ai-chat-body" id="aiChatBody">
    
    <!-- Welcome Message -->
    <div class="ai-chat-msg bot">
      <div class="ai-chat-bubble">
        <p>Hi there! 👋 I'm Sarah, your Loft Specialist at <strong>Another Level</strong>.</p>
        <p>Whether you're curious about <strong>typical costs</strong>, <strong>planning permission rules</strong>, or would like to <strong>book a free architectural survey</strong>, how can I help you today?</p>
      </div>
      <div class="ai-chat-time">Just now</div>
    </div>

    <!-- Quick Action Chips -->
    <div class="ai-chat-chips">
      <button type="button" class="ai-chat-chip-btn" onclick="sendAIChatChip('How much does a dormer loft conversion cost?')">💰 Dormer Cost?</button>
      <button type="button" class="ai-chat-chip-btn" onclick="sendAIChatChip('How long does a loft conversion take to build?')">⏱️ How Long?</button>
      <button type="button" class="ai-chat-chip-btn" onclick="sendAIChatChip('Do I need planning permission for my loft?')">📐 Planning Rules?</button>
      <button type="button" class="ai-chat-chip-btn" onclick="sendAIChatChip('I would like to book a free architectural survey')">📅 Book Free Survey</button>
    </div>

    <!-- Animated Typing Indicator -->
    <div class="ai-chat-typing" id="aiChatTyping">
      <span class="ai-typing-dot"></span>
      <span class="ai-typing-dot"></span>
      <span class="ai-typing-dot"></span>
    </div>

  </div>

  <!-- Footer Input Area -->
  <div class="ai-chat-footer">
    <form class="ai-chat-input-form" id="aiChatForm">
      <input type="text" class="ai-chat-input" id="aiChatInput" placeholder="Ask a question or leave phone..." autocomplete="off" required>
      <button type="submit" class="ai-chat-send-btn" id="aiChatSendBtn" aria-label="Send message">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
          <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
        </svg>
      </button>
    </form>
    <div class="ai-chat-disclaimer">
      🔒 100% Free Advice &bull; No Obligation &bull; Another Level NW
    </div>
  </div>

  <!-- Stylish In-Widget Reset Confirmation Modal -->
  <div class="ai-chat-confirm-overlay" id="aiChatConfirmOverlay">
    <div class="ai-chat-confirm-card">
      <div class="ai-chat-confirm-icon">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M3 12a9 9 0 0 1 15-6.7L21 8"/>
          <path d="M21 3v5h-5"/>
          <path d="M21 12a9 9 0 0 1-15 6.7L3 16"/>
          <path d="M3 21v-5h5"/>
        </svg>
      </div>
      <h4>Start a Fresh Chat?</h4>
      <p>This will clear your current conversation and start a new session with Sarah.</p>
      <div class="ai-chat-confirm-actions">
        <button type="button" class="ai-chat-btn-cancel" onclick="cancelResetChat()">Cancel</button>
        <button type="button" class="ai-chat-btn-confirm" onclick="confirmResetChat()">Yes, Start Fresh</button>
      </div>
    </div>
  </div>

</div>

<!-- Link AI Live Chat JavaScript -->
<script src="js/ai-chat.js?v=<?php echo filemtime(__DIR__ . '/../js/ai-chat.js'); ?>"></script>
