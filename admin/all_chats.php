<?php
include('top.inc.php');

// Retrieve the seller's ID from the session (replace this with your seller's authentication logic)
$sellerId = $_SESSION['ADMIN_ID'];

// Query the database to get a list of customers who have chatted with the seller
$sql = "SELECT DISTINCT outgoing_msg_id FROM messages WHERE incoming_msg_id = $sellerId";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat History</title>
    <link rel="stylesheet" href="chat.css">
    <!-- Include your CSS files here -->
</head>
<body>
    <div class="chat-container">
        <!-- Left Sidebar with Customer Names -->
        <div class="sidebar">
            <h2>Customer Chats</h2>
            <ul class="customer-list">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $customerId = $row['outgoing_msg_id'];

                    // Query the customers table to fetch customer details
                    $customerQuery = "SELECT * FROM users WHERE id = $customerId";
                    $stmtCustomer = mysqli_prepare($con, $customerQuery);

                    mysqli_stmt_execute($stmtCustomer);
                    $customerResult = mysqli_stmt_get_result($stmtCustomer);

                    if ($customerData = mysqli_fetch_assoc($customerResult)) {
                        $customerName = $customerData['name'];
                        // Add more customer details as needed
                        echo '<li class="customer-item">';
                        echo '<a href="chat_from_all_chats.php?outgoing_msg_id=' . $customerId . '&incoming_msg_id=' . $sellerId . '">' . $customerName . '</a>';
                        echo '<div class="customer-info">';
                        // Display customer information (e.g., profile picture)
                        echo '</div>';
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
                <p>Click on a customer to start chatting.</p>
            </div>
            <form action="#" class="typing-area" id="message-form">
                <input type="text" class="customer-id" name="customer_id" value="<?php echo $customerId;?>" hidden>
                <input type="text" name="message" class="input-field" id="message-input" placeholder="Type a message here..." autocomplete="off">
                <button type="submit"><i class="fab fa-telegram-plane"></i></button>
            </form>
        </div>
    </div>

    <script>
        function scrollToBottom() {
            var chatBox = document.getElementById('chat-box');
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        const customerItems = document.querySelectorAll('.customer-item');
        const chatBox = document.getElementById('chat-box');
        var customerId = <?php echo $customerId; ?>;

        function sendMessage() {
            var messageInput = document.getElementById('message-input');
            var message = messageInput.value;

            if (message !== '') {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'insert-chat.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                // Combine both parameters in a single string
                var data = 'customer_id=' + customerId + '&message=' + message;

                xhr.onload = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Message sent successfully, you can handle the response here if needed
                            console.log("Success");
                            console.log(xhr.responseText);
                            // Update the chat-box with the new message
                            chatBox.innerHTML += '<div class="outgoing-message"><p>' + message + '</p></div>';
                            scrollToBottom(); // Optionally, scroll to the bottom of the chat
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

        // JavaScript to load chat when a customer is clicked
        customerItems.forEach((customerItem) => {
            customerItem.addEventListener('click', () => {
        const customerId = customerItem.querySelector('a').getAttribute('href').split('=')[2];
        const header = document.querySelector('.details');
        const customerName = customerItem.querySelector('a').textContent;
        header.innerHTML = '<span>&nbsp;&nbsp;' + customerName + '</span>';

        // Clear the chat box before loading new content
        chatBox.innerHTML = '<p>Loading chat...</p>'; // Display a loading message

        // Function to load chat messages for the selected customer
        function loadChat() {
            // Send an AJAX request to get-chat.php to fetch chat messages for the selected customer
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

            xhr.send('customer_id=' + customerId);
        }

        // Load chat initially
        loadChat();

        // Set up an interval to periodically load chat messages
        const chatInterval = setInterval(loadChat, 1000); // Adjust the interval as needed (e.g., every 5 seconds)

        // Function to stop the chat loading interval when needed (e.g., when seller switches customers)
        function stopChatInterval() {
            clearInterval(chatInterval);
        }

        // Event listener to stop the chat loading interval when seller switches customers
        customerItem.addEventListener('mouseleave', stopChatInterval);
        document.getElementById('message-form').addEventListener('submit', function (e) {
            e.preventDefault();
            sendMessage(customerId);
        });
    });
});
        document.getElementById('message-form').addEventListener('submit', function (e) {
            e.preventDefault();
            sendMessage();
        });
    </script>
</body>
</html>
