/**
 * Another Level Loft Conversions - AI Live Chat Client
 */

(function () {
  'use strict';

  var SESSION_STORAGE_KEY = 'al_ai_chat_session_v1';
  var HISTORY_STORAGE_KEY = 'al_ai_chat_history_v1';

  var state = {
    sessionId: null,
    history: [],
    isOpen: false,
    isSubmitting: false
  };

  // Generate or retrieve persistent session ID for the tab/session
  function getSessionId() {
    var stored = sessionStorage.getItem(SESSION_STORAGE_KEY);
    if (!stored) {
      stored = 'chat_' + Math.random().toString(36).substring(2, 10) + Date.now().toString(36);
      sessionStorage.setItem(SESSION_STORAGE_KEY, stored);
    }
    return stored;
  }

  // Load history from session storage
  function loadHistory() {
    try {
      var saved = sessionStorage.getItem(HISTORY_STORAGE_KEY);
      if (saved) {
        state.history = JSON.parse(saved);
      }
    } catch (e) {
      state.history = [];
    }
  }

  // Save history
  function saveHistory() {
    try {
      sessionStorage.setItem(HISTORY_STORAGE_KEY, JSON.stringify(state.history));
    } catch (e) {}
  }

  // Escape HTML to prevent XSS
  function escapeHtml(text) {
    var div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  // Simple Markdown parser for **bold** and bullet points
  function formatBotMessage(text) {
    var safe = escapeHtml(text);
    // Replace **bold** with <strong>bold</strong>
    safe = safe.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
    // Replace bullet points (• or - ) with neat list formatting
    var lines = safe.split('\n');
    var formattedLines = [];
    var inList = false;

    lines.forEach(function (line) {
      var trimmed = line.trim();
      if (trimmed.indexOf('• ') === 0 || trimmed.indexOf('- ') === 0) {
        if (!inList) {
          formattedLines.push('<ul>');
          inList = true;
        }
        formattedLines.push('<li>' + trimmed.substring(2) + '</li>');
      } else {
        if (inList) {
          formattedLines.push('</ul>');
          inList = false;
        }
        if (trimmed !== '') {
          formattedLines.push('<p>' + line + '</p>');
        }
      }
    });

    if (inList) {
      formattedLines.push('</ul>');
    }

    return formattedLines.join('');
  }

  // Format current time HH:MM
  function getFormattedTime() {
    var now = new Date();
    var h = now.getHours().toString().padStart(2, '0');
    var m = now.getMinutes().toString().padStart(2, '0');
    return h + ':' + m;
  }

  // Scroll chat messages to bottom
  function scrollToBottom() {
    var body = document.getElementById('aiChatBody');
    if (body) {
      body.scrollTop = body.scrollHeight;
    }
  }

  // Append a message bubble to the chat body
  function renderMessage(sender, text, time) {
    var body = document.getElementById('aiChatBody');
    var typing = document.getElementById('aiChatTyping');
    if (!body) return;

    var msgDiv = document.createElement('div');
    msgDiv.className = 'ai-chat-msg ' + (sender === 'user' ? 'user' : 'bot');

    var bubbleDiv = document.createElement('div');
    bubbleDiv.className = 'ai-chat-bubble';

    if (sender === 'bot') {
      bubbleDiv.innerHTML = formatBotMessage(text);
    } else {
      bubbleDiv.textContent = text;
    }

    var timeDiv = document.createElement('div');
    timeDiv.className = 'ai-chat-time';
    timeDiv.textContent = time || getFormattedTime();

    msgDiv.appendChild(bubbleDiv);
    msgDiv.appendChild(timeDiv);

    // Insert before typing indicator
    if (typing && typing.parentNode === body) {
      body.insertBefore(msgDiv, typing);
    } else {
      body.appendChild(msgDiv);
    }

    scrollToBottom();
  }

  // Show / hide typing indicator
  function setTyping(isActive) {
    var typing = document.getElementById('aiChatTyping');
    if (typing) {
      if (isActive) {
        typing.classList.add('is-active');
      } else {
        typing.classList.remove('is-active');
      }
      scrollToBottom();
    }
  }

  // Open Chat Window
  window.openAIChat = function (event) {
    if (event && event.preventDefault) {
      event.preventDefault();
    }

    var modal = document.getElementById('aiChatModal');
    var backdrop = document.getElementById('aiChatBackdrop');
    if (!modal) return;

    modal.classList.add('is-open');
    if (backdrop) backdrop.classList.add('is-open');
    state.isOpen = true;

    // Focus input after transition
    setTimeout(function () {
      var input = document.getElementById('aiChatInput');
      if (input && window.innerWidth > 767) {
        input.focus();
      }
      scrollToBottom();
    }, 200);

    // Log chat open event
    if (window.trackCustomEvent) {
      window.trackCustomEvent('chat_open', 'ai_live_chat_launcher');
    }
  };

  // Close Chat Window
  window.closeAIChat = function () {
    var modal = document.getElementById('aiChatModal');
    var backdrop = document.getElementById('aiChatBackdrop');
    if (modal) modal.classList.remove('is-open');
    if (backdrop) backdrop.classList.remove('is-open');
    state.isOpen = false;
  };

  // Toggle Chat
  window.toggleAIChat = function (event) {
    if (state.isOpen) {
      window.closeAIChat();
    } else {
      window.openAIChat(event);
    }
  };

  // Open Stylish Reset Confirmation Modal
  window.resetAIChat = function () {
    var overlay = document.getElementById('aiChatConfirmOverlay');
    if (overlay) {
      overlay.classList.add('is-active');
    }
  };

  // Cancel / Close Reset Modal
  window.cancelResetChat = function () {
    var overlay = document.getElementById('aiChatConfirmOverlay');
    if (overlay) {
      overlay.classList.remove('is-active');
    }
  };

  // Confirm and Execute Fresh Chat Reset
  window.confirmResetChat = function () {
    window.cancelResetChat();

    sessionStorage.removeItem(SESSION_STORAGE_KEY);
    sessionStorage.removeItem(HISTORY_STORAGE_KEY);
    state.history = [];
    state.sessionId = 'chat_' + Math.random().toString(36).substring(2, 10) + Date.now().toString(36);
    sessionStorage.setItem(SESSION_STORAGE_KEY, state.sessionId);

    var body = document.getElementById('aiChatBody');
    if (body) {
      // Keep initial welcome message and suggestion chips, remove subsequent user & bot turns
      var bubbles = body.querySelectorAll('.ai-chat-msg:not(:first-child)');
      bubbles.forEach(function (b) { b.remove(); });
    }
    var input = document.getElementById('aiChatInput');
    if (input) {
      input.value = '';
      if (window.innerWidth > 767) {
        input.focus();
      }
    }
  };

  // Send suggestion chip
  window.sendAIChatChip = function (text) {
    var input = document.getElementById('aiChatInput');
    if (input) {
      input.value = text;
    }
    submitMessage(text);
  };

  // Submit message to backend
  function submitMessage(text) {
    var messageText = (text || '').trim();
    if (!messageText || state.isSubmitting) return;

    state.isSubmitting = true;
    var sendBtn = document.getElementById('aiChatSendBtn');
    var input = document.getElementById('aiChatInput');

    if (sendBtn) sendBtn.disabled = true;
    if (input) input.value = '';

    var currentTime = getFormattedTime();

    // Render user message immediately
    renderMessage('user', messageText, currentTime);

    // Add to history
    state.history.push({
      sender: 'user',
      text: messageText,
      time: currentTime
    });
    saveHistory();

    // Show typing dots
    setTyping(true);

    // Send payload to backend
    fetch('/api/chat.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        message: messageText,
        session_id: state.sessionId,
        page: window.location.pathname,
        history: state.history
      })
    })
      .then(function (res) {
        return res.json();
      })
      .then(function (data) {
        setTyping(false);
        state.isSubmitting = false;
        if (sendBtn) sendBtn.disabled = false;

        var botReply = (data && data.reply) ? data.reply : "Thank you! Our surveying team will be pleased to assist you. Call us directly on 0800 0862744.";
        var botTime = getFormattedTime();

        renderMessage('bot', botReply, botTime);

        state.history.push({
          sender: 'bot',
          text: botReply,
          time: botTime
        });
        saveHistory();
      })
      .catch(function (err) {
        setTyping(false);
        state.isSubmitting = false;
        if (sendBtn) sendBtn.disabled = false;

        var fallbackMsg = "Thank you for getting in touch! We're here to answer all your loft questions. Feel free to call us free on 0800 0862744 or leave your phone number.";
        renderMessage('bot', fallbackMsg, getFormattedTime());
      });
  }

  // Initialize on DOM ready
  document.addEventListener('DOMContentLoaded', function () {
    state.sessionId = getSessionId();
    loadHistory();

    var form = document.getElementById('aiChatForm');
    var input = document.getElementById('aiChatInput');

    if (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (input) {
          submitMessage(input.value);
        }
      });
    }

    // Replay saved history if any
    if (state.history && state.history.length > 0) {
      state.history.forEach(function (item) {
        renderMessage(item.sender, item.text, item.time);
      });
    }

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && state.isOpen) {
        window.closeAIChat();
      }
    });
  });
})();
