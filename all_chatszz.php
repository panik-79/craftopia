<?php
include('top.php');

// Retrieve the user's ID from the session
$userId = $_SESSION['USER_ID'];

// Query the database to get a list of sellers the user has chatted with
$sql = "SELECT DISTINCT incoming_msg_id FROM messages WHERE outgoing_msg_id = $userId";
$stmt = mysqli_prepare($con, $sql);
// mysqli_stmt_bind_param($stmt, 'i', $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat History</title>
    <!-- <link rel="stylesheet" href="style.css"> Include your CSS file -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
	<script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>
<style>

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    body, h2 {
        margin: 0;
        padding: 0;
    }

    .form header {
    font-size: 25px;
    font-weight: 600;
    padding-bottom: 10px;
    border-bottom: 1px solid #e6e6e6;
    }

    .form form {
    margin: 20px 0;
    }

    .form form .error-text {
    color: #721c24;
    padding: 8px 10px;
    text-align: center;
    border-radius: 5px;
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    margin-bottom: 10px;
    display: none;
    }



    /* Chat Area Styles */
    .chat-area header {
    display: flex;
    align-items: center;
    padding: 18px 30px;
    }

    .chat-box {
    position: relative;
    min-height: 500px;
    max-height: 500px;
    overflow-y: auto;
    padding: 10px 30px 20px 30px;
    background: #f7f7f7;
    box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%),
                inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
    }

    /* CSS for the chat messages */
    .chat-box .chat {
    margin: 10px 0;
    display: flex;
    flex-direction: column; /* Display messages in a vertical column */
    }

    /* Style for sender's messages (outgoing) */
    .chat-box .outgoing {
    display: flex;
    /* flex-direction: row-reverse; Reverse the direction of messages for sender */
    align-items: flex-end;
    /* Align sender's messages to the right */
    margin-right: 0; /* Adjust spacing for sender */
    }

    .chat-box .outgoing .details {
    margin-left: 10px;
    margin-right: 0; /* Adjust spacing for sender */
    max-width: calc(100% - 30px); /* Limit the width of sender's messages */
    }

    .chat-box .outgoing .details p {
    background: #007bff; /* Sender's message background color */
    color: #fff; /* Sender's message text color */
    border-radius: 20px 20px 20px 20px; /* Round the corners for sender's messages */
    margin-right: 60px; /* Adjust spacing for sender */
    }

    /* Style for receiver's messages (incoming) */
    .chat-box .incoming {
    display: flex;
    align-items: flex-end; /* Align receiver's messages to the left */
    margin-left: 0; /* Adjust spacing for receiver */
    }

    .chat-box .incoming .details {
    margin-right: 10px;
    text-align: end;
    margin-left: 0; /* Adjust spacing for receiver */
    max-width: calc(100% - 30px); /* Limit the width of receiver's messages */
    }

    .chat-box .incoming .details p {
    background: #f2f2f2; /* Receiver's message background color */
    color: #333; /* Receiver's message text color */
    border-radius: 20px 20px 20px 20px; /* Round the corners for receiver's messages */
    margin-left: 60px; /* Adjust spacing for receiver */
    }

    /* Responsive Media Query */
    /@media screen and (max-width: 450px) {
    .form, .users {
        padding: 20px;
    }
    
    .form header {
        text-align: center;
    }
    
    .form form .name-details {
        flex-direction: column;
    }
    
    .form .name-details .field:first-child {
        margin-right: 0px;
    }
    
    .form .name-details .field:last-child {
        margin-left: 0px;
    }

    .users header img {
        height: 45px;
        width: 45px;
    }

    .users header .logout {
        padding: 6px 10px;
        font-size: 16px;
    }

    :is(.users, .users-list) .content .details {
        margin-left: 15px;
    }

    .users-list a {
        padding-right: 10px;
    }

    .chat-area header {
        padding: 15px 20px;
    }

    .chat-box {
        min-height: 400px;
        padding: 10px 15px 15px 20px;
    }

    .chat-box .chat p {
        font-size: 15px;
    }

    .chat-box .outgoing .details {
        max-width: 230px;
    }

    .chat-box .incoming .details {
        max-width: 265px;
    }

    .incoming .details img {
        height: 30px;
        width: 30px;
    }

    .chat-area form {
        padding: 20px;
    }

    .chat-area form input {
        height: 40px;
        width: calc(100% - 48px);
    }

    .chat-area form button {
        width: 45px;
    }
    }

    /* Chat container styles */
    .chat-container {
        display: flex;
        justify-content: space-between;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Left sidebar styles */
    .sidebar {
        flex: 1;
        background-color: #f0f0f0;
        padding: 20px;
        border-right: 1px solid #ddd;
        overflow-y: auto;
    }

    .sidebar h2 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .seller-list {
        list-style: none;
        padding: 0;
    }

    .seller-item {
        cursor: pointer;
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    .seller-item:hover {
        background-color: #e0e0e0;
    }

    /* Right chat area styles */
    .chat-area {
        flex: 2;
        background-color: #fff;
        padding: 20px;
    }

    .chat-box {
        max-height: 400px;
        overflow-y: auto;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }

    .chat-area h2 {
        font-size: 18px;
        margin-bottom: 10px;
    }


</style>
<body>
    <div class="chat-container">
        <!-- Left Sidebar with Seller Names -->
        <div class="sidebar">
            <h2>Your Chats</h2>
            <ul class="seller-list">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $sellerId = $row['incoming_msg_id'];

                    // Query the sellers table to fetch seller details
                    $sellerQuery = "SELECT * FROM admin_users WHERE id = $sellerId";
                    $stmtSeller = mysqli_prepare($con, $sellerQuery);

                    mysqli_stmt_execute($stmtSeller);
                    $sellerResult = mysqli_stmt_get_result($stmtSeller);

                    if ($sellerData = mysqli_fetch_assoc($sellerResult)) {
                        $sellerName = $sellerData['username'];
                        // Add more seller details as needed
                        echo '<li class="seller-item">';
                        echo '<a href="chat_from_all_chats.php?outgoing_msg_id=' . $userId . ' ?>&incoming_msg_id=' . $sellerId . '">' . $sellerName . '</a>';
                        echo '<div class="seller-info">';
        
                        echo '</div>';
                        echo '</a>';
                        echo '</li>';

                    }
                }
                ?>
            </ul>
        </div>

        <!-- Right Chat Area (Initially Empty) -->
        <div class="chat-area">
                <!-- Messages will be displayed here -->
                    <header>
                        <div class="details">
                            <span>&nbsp;&nbsp;</span>
                        </div>
                    </header>
                    <div class="chat-box" id="chat-box">
                        <!-- Chat messages will be added here -->
                        <p>Click on a seller to start chatting.</p>

                    </div>
                    <form action="#" class="typing-area" id="message-form">
                        <input type="text" class="incoming_id" name="incomingid" value="<?php echo $sellerId; ?>" hidden>
                        <input type="text" name="message" class="input-field" id="message-input" placeholder="Type a message here..." autocomplete="off">
                        <button type="submit"><i class="fab fa-telegram-plane"></i></button>
                    </form>

            </div>
        </div>
    </div>


<script>
    function scrollToBottom() {
        var chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    const sellerItems = document.querySelectorAll('.seller-item');
    const chatBox = document.getElementById('chat-box');

    function sendMessage(incomingId) {
        var messageInput = document.getElementById('message-input');
        var message = messageInput.value;

        if (message !== '') {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'insert-chat.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // Combine both parameters in a single string
            var data = 'incomingid=' + incomingId + '&message=' + message;

            xhr.onload = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Message sent successfully, you can handle the response here if needed
                        console.log("Success");
                        console.log(xhr.responseText);
                    } else {
                        // Error sending the message, handle it as needed
                        console.error('Error sending message. Status code: ' + xhr.status);
                    }
                }
            };

            xhr.send(data); // Send the combined data
            // Clear the input field
            messageInput.value = '';
        }
    }

    // JavaScript to load chat when a seller is clicked
    sellerItems.forEach((sellerItem) => {
        sellerItem.addEventListener('click', () => {
            const incomingId = sellerItem.querySelector('a').getAttribute('href').split('=')[2];
            const header = document.querySelector('.details');
            const sellerName = sellerItem.querySelector('a').textContent;
            header.innerHTML = '<span>&nbsp;&nbsp;' + sellerName + incomingId + '</span>';
            
            // Clear the chat box before loading new content
            chatBox.innerHTML = '<p>Loading chat...</p>'; // Display a loading message

            // Function to load chat messages for the selected seller
            function loadChat() {
                // Send an AJAX request to get-chat.php to fetch chat messages for the selected seller
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'get-chat.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var data = xhr.responseText;
                            chatBox.innerHTML = data; // Update the chat-box with fetched chat messages
                            scrollToBottom(); // Optionally, scroll to the bottom of the chat
                        } else {
                            chatBox.innerHTML = '<p>Error loading chat.</p>'; // Display an error message
                        }
                    }
                };

                xhr.send('incomingid=' + incomingId);
            }

            // Load chat initially
            loadChat();

            // Set up an interval to periodically load chat messages
            const chatInterval = setInterval(loadChat, 1000); // Adjust the interval as needed (e.g., every 5 seconds)

            // Function to stop the chat loading interval when needed (e.g., when user switches sellers)
            function stopChatInterval() {
                clearInterval(chatInterval);
            }

            // Event listener to stop the chat loading interval when user switches sellers
            sellerItem.addEventListener('mouseleave', stopChatInterval);
            document.getElementById('message-form').addEventListener('submit', function (e) {
                e.preventDefault();
                sendMessage(incomingId);
            });
        });
    });

</script>


</body>
</html>


