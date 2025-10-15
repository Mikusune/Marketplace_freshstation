<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Live Chat</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Customer List -->
                            <div class="col-md-4 col-12 border-right">
                                <h6 class="mb-3">Daftar Percakapan</h6>
                                <div class="list-group chat-list" id="chat-list">
                                    <div class="text-center p-3">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Chat Area -->
                            <div class="col-md-8 col-12">
                                <div class="chat-header mb-3 d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0" id="current-chat-user">Pilih percakapan</h6>
                                </div>
                                <div class="chat-area bg-light p-3" style="height: 400px; overflow-y: auto;">
                                    <div id="chat-messages" class="chat-messages">
                                        <div class="text-center text-muted">
                                            Pilih percakapan untuk melihat pesan
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-input mt-3">
                                    <form id="chat-form" class="d-flex gap-2">
                                        <input type="hidden" id="current-user-id" value="">
                                        <input type="text" class="form-control" id="message-input" placeholder="Ketik pesan..." disabled>
                                        <button type="submit" class="btn btn-primary" disabled>
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.chat-message {
    margin-bottom: 15px;
    max-width: 80%;
    word-wrap: break-word;
}

.chat-message.admin {
    margin-left: auto;
    background: #55B55E;
    color: white;
    padding: 10px 15px;
    border-radius: 15px 15px 0 15px;
}

.chat-message.customer {
    margin-right: auto;
    background: #f8f9fa;
    padding: 10px 15px;
    border-radius: 15px 15px 15px 0;
    border: 1px solid #dee2e6;
}

.chat-area {
    height: 400px;
    overflow-y: auto;
    padding: 20px;
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 8px;
}

.message-content {
    margin-bottom: 5px;
    white-space: pre-wrap;
}

.chat-time {
    font-size: 0.75rem;
    opacity: 0.8;
    margin-top: 4px;
}

.chat-customer {
    transition: all 0.2s ease;
    border-left: 3px solid transparent;
}

.chat-customer:hover,
.chat-customer.active {
    background-color: #55B55E !important;
    border-left-color: #3d8043;
}

.chat-customer:hover *,
.chat-customer.active * {
    color: #fff !important;
}

.chat-customer:hover .text-muted,
.chat-customer.active .text-muted {
    color: rgba(255, 255, 255, 0.8) !important;
}

.chat-customer .unread-badge {
    background: #dc3545;
    color: white;
    padding: 2px 6px;
    border-radius: 10px;
    font-size: 12px;
}

.chat-list {
    height: 450px;
    overflow-y: auto;
    border: 1px solid #dee2e6;
    border-radius: 8px;
}

.chat-input {
    margin-top: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.chat-header {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 15px;
}

#message-input {
    border-radius: 20px;
    padding: 10px 20px;
}

#chat-form button {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #55B55E;
    border-color: #55B55E;
}

#chat-form button:hover {
    background-color: #3d8043;
    border-color: #3d8043;
}

.spinner-border.text-primary {
    color: #55B55E !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentUserId = null;
    const chatList = document.getElementById('chat-list');
    const chatMessages = document.getElementById('chat-messages');
    const chatForm = document.getElementById('chat-form');
    const messageInput = document.getElementById('message-input');
    const currentChatUser = document.getElementById('current-chat-user');

    // Function to load chat list
    function loadChatList() {
        fetch('<?= base_url('admin/chat/get_chat_list') ?>', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('[DEBUG] chat list data:', data);
            chatList.innerHTML = '';
            if (Array.isArray(data) && data.length > 0) {
                data.forEach(chat => {
                    if (!chat.user_id || !chat.username) {
                        console.warn('[DEBUG] chat data missing user_id or username:', chat);
                        return;
                    }
                    const div = document.createElement('div');
                    div.className = 'chat-customer list-group-item list-group-item-action';
                    div.dataset.userId = chat.user_id;
                    div.dataset.username = chat.username;
                    const lastMessageTime = chat.last_message_time || chat.created_at;
                    div.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-1">${chat.username}</h6>
                            <div class="d-flex align-items-center gap-2">
                                ${chat.unread_count > 0 ? `<span class="unread-badge">${chat.unread_count}</span>` : ''}
                                <small class="text-muted">${formatDate(lastMessageTime)}</small>
                            </div>
                        </div>
                        <p class="mb-1 text-truncate">${chat.message || ''}</p>
                    `;
                    div.addEventListener('click', function() {
                        console.log('[DEBUG] Percakapan diklik:', chat.user_id, chat.username);
                        // Update active state
                        document.querySelectorAll('.chat-customer').forEach(el => el.classList.remove('active'));
                        this.classList.add('active');
                        loadChat(chat.user_id, chat.username);
                    });
                    // Set active if currentUserId matches
                    if (chat.user_id == currentUserId) div.classList.add('active');
                    chatList.appendChild(div);
                });
            } else {
                chatList.innerHTML = '<div class="p-3 text-center text-muted">Belum ada percakapan</div>';
            }
        })
        .catch(error => {
            console.error('Error loading chat list:', error);
            chatList.innerHTML = '<div class="p-3 text-center text-danger">Gagal memuat daftar chat</div>';
        });
    }

    // Function to format date
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            day: '2-digit',
            month: 'short'
        });
    }

    // Function to load chat messages with optimized loading
    function loadChat(userId, username) {
        console.log('[DEBUG] loadChat dipanggil:', userId, username);
        currentUserId = userId;
        document.getElementById('current-user-id').value = userId;
        messageInput.disabled = false;
        chatForm.querySelector('button').disabled = false;
        currentChatUser.textContent = username;
        // Reset chatMessages dan hapus data-loaded agar pesan lama hilang
        chatMessages.innerHTML = '<div class="text-center p-3"><div class="spinner-border text-primary" role="status"></div></div>';
        chatMessages.removeAttribute('data-loaded');
        getLatestMessages(userId);
    }

    // Function to get latest messages
    function getLatestMessages(userId, silent = false) {
        const lastMessageId = getLastMessageId();
        
        fetch(`<?= base_url('admin/chat/get_messages/') ?>/${userId}${lastMessageId ? '?after=' + lastMessageId : ''}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (!silent) {
                chatMessages.setAttribute('data-loaded', 'true');
            }

            if (data.success) {
                if (!silent && !lastMessageId) {
                    // Clear and show all messages only on initial load or manual refresh
                    chatMessages.innerHTML = '';
                    data.messages.forEach(message => {
                        appendMessage(message);
                    });
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                } else if (data.messages && data.messages.length > 0) {
                    // Append only new messages
                    data.messages.forEach(message => {
                        if (!document.querySelector(`[data-message-id="${message.id}"]`)) {
                            appendMessage(message);
                            if (!silent) {
                                chatMessages.scrollTop = chatMessages.scrollHeight;
                            }
                        }
                    });
                }
            } else if (!silent) {
                chatMessages.innerHTML = '<div class="text-center text-muted p-3">Belum ada pesan</div>';
            }
        })
        .catch(error => {
            console.error('Error loading messages:', error);
            if (!silent) {
                chatMessages.innerHTML = '<div class="text-center text-danger p-3">Gagal memuat pesan</div>';
            }
        });
    }

    // Helper function to get the last message ID
    function getLastMessageId() {
        const messages = chatMessages.querySelectorAll('.chat-message');
        if (messages.length > 0) {
            const lastMessage = messages[messages.length - 1];
            return lastMessage.dataset.messageId;
        }
        return null;
    }

    // Function to append a message
    function appendMessage(message) {
        const div = document.createElement('div');
        div.className = `chat-message ${message.from_type}`;
        div.dataset.messageId = message.id;
        
        div.innerHTML = `
            <div class="message-content">${message.message}</div>
            <div class="chat-time">${message.created_at}</div>
        `;
        chatMessages.appendChild(div);
    }

    // Format pesan sebelum mengirim
    function formatMessageHTML(message, time, isAdmin = false) {
        return `
            <div class="chat-message ${isAdmin ? 'admin' : 'customer'}">
                <div class="message-content">${message}</div>
                <div class="chat-time">${time}</div>
            </div>
        `;
    }

    // Handle sending messages
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        if (!currentUserId || !messageInput.value.trim()) return;

        const message = messageInput.value.trim();
        const button = this.querySelector('button');
        const originalText = button.innerHTML;
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

        fetch('<?= base_url('admin/chat/send_message') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                user_id: currentUserId,
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageInput.value = '';
                loadChat(currentUserId, currentChatUser.textContent);
                loadChatList();
            } else {
                alert('Gagal mengirim pesan');
            }
        })
        .catch(error => {
            console.error('Error sending message:', error);
            alert('Gagal mengirim pesan');
        })
        .finally(() => {
            button.disabled = false;
            button.innerHTML = originalText;
        });
    });

    // Load chat list initially
    loadChatList();

    // Refresh chat list and current chat periodically
    setInterval(() => {
        loadChatList();
        if (currentUserId) {
            getLatestMessages(currentUserId, true);
        }
    }, 5000);
});
</script>