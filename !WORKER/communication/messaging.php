<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../!SIGNUP/source/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Messaging</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Overall layout */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        #container { display: flex; height: 100vh; }
        #conversations { width: 30%; border-right: 1px solid #ccc; padding: 10px; overflow-y: auto; }
        #chat { width: 70%; display: flex; flex-direction: column; padding: 10px; }
        #chatHeader { margin: 0; padding: 10px 0; border-bottom: 1px solid #ccc; display: flex; align-items: center; }
        #chatHeader img { border-radius: 50%; margin-right: 10px; }
        #chatMessages { flex: 1; overflow-y: auto; padding: 10px; border-bottom: 1px solid #ccc; }
        #chatInput { display: flex; }
        #chatInput input { flex: 1; padding: 10px; font-size: 16px; }
        #chatInput button { padding: 10px 20px; font-size: 16px; }

        /* New conversation creation */
        #newConversation { padding: 10px; margin-bottom: 10px; border-bottom: 1px solid #ccc; }
        #newConversation input { width: calc(100% - 110px); padding: 5px; }
        #newConversation button { padding: 5px 10px; }

        /* Conversation list items */
        .conversationItem {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }
        .conversationItem:hover { background-color: #f0f0f0; }
        .unread { font-weight: bold; }
        .conv-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
        .conv-text {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .conv-name { font-weight: bold; }
        .conv-preview { font-size: 0.9em; color: #555; }
    </style>
</head>
<body>
<div id="container">
    <!-- Left panel: Conversation list and new conversation creation -->
    <div id="conversations">
        <h3>Conversations</h3>
        <div id="newConversation">
            <input type="email" id="newChatEmail" placeholder="Enter user email">
            <button id="startChatBtn">Start Chat</button>
        </div>
        <div id="conversationList">
            <!-- Conversations will be loaded via AJAX -->
        </div>
    </div>
    <!-- Right panel: Chat window -->
    <div id="chat">
        <h3 id="chatHeader">Select a conversation</h3>
        <div id="chatMessages">
            <!-- Chat messages will be loaded via AJAX -->
        </div>
        <div id="chatInput">
            <input type="text" id="messageInput" placeholder="Type a message...">
            <button id="sendBtn">Send</button>
        </div>
    </div>
</div>

<script>
// Preselected user id from query parameter (if any)
var preselectedId = <?php echo isset($_GET['id']) ? json_encode($_GET['id']) : 'null'; ?>;

$(document).ready(function() {
    var currentChatPartner = null;
    
    // Helper function to build image source using your directory structure
    function getImageSrc(profimg) {
        return (profimg && profimg.trim() !== "") 
            ? '/Works/!SIGNUP/uploads/' + profimg 
            : '/Works/!SIGNUP/uploads/default/image.png';
    }
    
    // Load conversation list via AJAX
    function loadConversations() {
        $.ajax({
            url: 'list_chats.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.status === 'success' && response.conversations.length > 0) {
                    var listHtml = '';
                    $.each(response.conversations, function(index, conversation) {
                        var senderPrefix = (conversation.sender_id == <?php echo $_SESSION['id']; ?>) 
                                                ? 'You: ' 
                                                : conversation.partner_firstname + ': ';
                        var unreadClass = "";
                        if(conversation.is_read == 0 && conversation.sender_id != <?php echo $_SESSION['id']; ?>) {
                            unreadClass = " unread";
                        }
                        var imageSrc = getImageSrc(conversation.profimg);
                        listHtml += '<div class="conversationItem' + unreadClass + '" data-chat-partner="'+conversation.chat_partner+'" data-fullname="'+conversation.fullname+'" data-img="'+conversation.profimg+'">' +
                                        '<img class="conv-img" src="' + imageSrc + '" alt="Profile Image">' +
                                        '<div class="conv-text">' +
                                            '<div class="conv-name">' + conversation.fullname + '</div>' +
                                            '<div class="conv-preview"><small>' + senderPrefix + conversation.message + '</small></div>' +
                                        '</div>' +
                                    '</div>';
                    });
                    $('#conversationList').html(listHtml);
                } else {
                    $('#conversationList').html('<p>No conversations found.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
    
    loadConversations();
    
    // Load chat messages for a selected conversation
    function loadChat(chatPartnerId) {
        $.ajax({
            url: 'get_messages.php',
            method: 'GET',
            data: { other_user_id: chatPartnerId },
            dataType: 'json',
            success: function(response) {
                if(response.status === 'success') {
                    var messagesHtml = '';
                    $.each(response.messages, function(index, message) {
                        var sender = (message.sender_id == <?php echo $_SESSION['id']; ?>) ? 'You' : message.sender_firstname;
                        messagesHtml += '<div><strong>' + sender + ':</strong> ' + message.message + '</div>';
                    });
                    $('#chatMessages').html(messagesHtml);
                    $('#chatMessages').scrollTop($('#chatMessages')[0].scrollHeight);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
    
    // Mark conversation as read by calling mark_as_read.php
    function markConversationAsRead(chatPartnerId) {
        $.ajax({
            url: 'mark_as_read.php',
            method: 'POST',
            data: { other_user_id: chatPartnerId },
            dataType: 'json',
            success: function(response) {
                if(response.status !== 'success'){
                    console.error('Error marking as read:', response.message);
                }
                loadConversations();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
    
    // When a conversation item is clicked, load its chat messages and mark as read
    $(document).on('click', '.conversationItem', function() {
        currentChatPartner = $(this).data('chat-partner');
        var fullname = $(this).data('fullname');
        var profimg = $(this).data('img');
        var imageSrc = getImageSrc(profimg);
        $('#chatHeader').html('<img src="'+imageSrc+'" alt="Profile Image" width="50" height="50"> ' + fullname);
        loadChat(currentChatPartner);
        markConversationAsRead(currentChatPartner);
    });
    
    // Send message event handler
    $('#sendBtn').click(function() {
        var msg = $('#messageInput').val();
        if(msg.trim() !== '' && currentChatPartner) {
            $.ajax({
                url: 'send_message.php',
                method: 'POST',
                data: { receiver_id: currentChatPartner, message: msg },
                dataType: 'json',
                success: function(response) {
                    if(response.status === 'success') {
                        $('#messageInput').val('');
                        loadChat(currentChatPartner);
                        loadConversations();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        } else {
            alert('Please type a message and select a conversation.');
        }
    });
    
    // Start new conversation event handler
    $('#startChatBtn').click(function() {
        var email = $('#newChatEmail').val();
        if(email.trim() === ''){
           alert('Please enter an email.');
           return;
        }
        $.ajax({
           url: 'start_conversation.php',
           method: 'POST',
           data: { email: email },
           dataType: 'json',
           success: function(response) {
              if(response.status === 'success'){
                  currentChatPartner = response.chat_partner;
                  var imageSrc = getImageSrc(response.profimg);
                  $('#chatHeader').html('<img src="'+imageSrc+'" alt="Profile Image" width="50" height="50"> ' + response.name);
                  loadChat(currentChatPartner);
                  loadConversations();
              } else {
                  alert(response.message);
              }
           },
           error: function(xhr, status, error){
               console.error(error);
           }
        });
    });
    
    // If a preselected id is passed in the URL, load that conversation automatically
    if (preselectedId !== null) {
        $.ajax({
            url: 'get_user_info.php',
            method: 'GET',
            data: { id: preselectedId },
            dataType: 'json',
            success: function(response) {
                if(response.status === 'success'){
                    var user = response.user;
                    currentChatPartner = user.id;
                    var imageSrc = getImageSrc(user.profimg);
                    $('#chatHeader').html('<img src="'+imageSrc+'" alt="Profile Image" width="50" height="50"> ' + user.firstname + ' ' + user.lastname);
                    loadChat(currentChatPartner);
                } else {
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error){
                console.error(error);
            }
        });
    }
    
    // Optionally, refresh chat and conversation list every 5 seconds
    setInterval(function() {
        if(currentChatPartner) {
            loadChat(currentChatPartner);
            loadConversations();
        }
    }, 5000);
});
</script>
</body>
</html>
