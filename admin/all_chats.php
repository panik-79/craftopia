<?php
require('top.inc.php');

$sellerId = $_SESSION['ADMIN_ID'];
$sql = "SELECT DISTINCT outgoing_msg_id FROM messages WHERE incoming_msg_id = $sellerId";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
body, h2 {
    margin: 0;
    padding: 0;
}

form {
    margin-top: 10px ;
    display: flex;
    justify-content: center;
}

form input {
    font-size: 18px;
    text-align: left;
    font-weight: 300;
    padding: 10px;
    border-bottom: 1px solid #e6e6e6;
    border: 2px solid #999;
    border-radius: 5px;
    width:390px;
}

.customer-chat {
    background-color: #f7f7f7;
    border: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    max-width: 100%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    clear: both;
    margin-left: auto;
}

/* Chat Area Styles */
.chat-area .details {
    margin-bottom:10px;
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
    border-radius: 5px;
    max-width: 450px;
}

/* CSS for the chat messages */
.chat-box .chat {
    margin: 0;
    display: flex;
    flex-direction: column;
}

/* Style for sender's messages (outgoing) */
.chat-box .outgoing {
    display: flex;
    align-items: flex-end;
    margin-right: auto;
    max-width: calc(100% - 30px);
}

.chat-box .outgoing .details {
    text-align: start;
    
}

.chat-box .outgoing .details p {
    background: #c43b68;
    color: #fff;
    border-radius: 20px 20px 20px 20px;
    margin-right: 0px;
    padding: 5px;
}

/* Style for receiver's messages (incoming) */
.chat-box .incoming {
    display: flex;
    align-items: flex-start;
    margin-left: auto;
    padding:5px;
}

.chat-box .incoming .details {
    margin-right: 10px;
    margin-left: 0; 
    text-align: end;
}

.chat-box .incoming .details p {
    background: #fff;
    color: #c43b68;
    border-radius: 20px 20px 20px 20px;
    margin-left: 10px;
    padding: 5px;
}

button[type="submit"] {
    background-color: #c43b68;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
}

button[type="submit"] i.fab.fa-telegram-plane {
    margin-right: 5px;
}

/* Responsive Media Query */
@media screen and (max-width: 450px) {
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

.customer-list {
    list-style: none;
    padding: 0;
}

.customer-item {
    cursor: pointer;
    padding: 10px;
    border-bottom: 1px solid #ccc;
}

.customer-item:hover {
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
    <div class="chat-container">
        <div class="sidebar">
            <h2>Customer Chats</h2>
            <ul class="customer-list">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $customerId = $row['outgoing_msg_id'];

                    // Query the customers table to fetch customer details
                    $customerQuery = "SELECT * FROM users WHERE id = $customerId";
                    $stmtCustomer = mysqli_prepare($conn, $customerQuery);

                    mysqli_stmt_execute($stmtCustomer);
                    $customerResult = mysqli_stmt_get_result($stmtCustomer);

                    if ($customerData = mysqli_fetch_assoc($customerResult)) {
                        $customerName = $customerData['name'];
                        echo '<li class="customer-item">';
                        echo '<a href="chat_from_all_chats.php?outgoing_msg_id=' . $customerId . '&incoming_msg_id=' . $sellerId . '">' . $customerName . '</a>';
                        echo '<div class="customer-info">';
                        echo '</div>';
                        echo '</li>';
                    }
                }
                ?>
            </ul>
        </div>

        <div class="chat-area">
            <!-- Messages will be displayed here -->
            <div>
                <div class="details">
                    <span>&nbsp;&nbsp;</span>
                </div>
            </div>
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



</html>



<script>
    function scrollToBottom() {
        var chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    const customerItems = document.querySelectorAll('.customer-item');
    const chatBox = document.getElementById('chat-box');
    var customerId = null; // Initialize customerId as null

    function sendMessage() {
        var messageInput = document.getElementById('message-input');
        var message = messageInput.value;

        if (message !== '') {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'insert-chat.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // Combining both parameters in a single string
            var data = 'customer_id=' + customerId + '&message=' + message;

            xhr.onload = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log("Success");
                        console.log(xhr.responseText);
                        chatBox.innerHTML += '<div class="outgoing-message"><p>' + message + '</p></div>';
                        scrollToBottom();
                    } else {
                        console.error('Error sending message. Status code: ' + xhr.status);
                    }
                }
            };

            xhr.send(data);
            messageInput.value = '';
        }
    }

    // JavaScript to load chat when a customer is clicked
    customerItems.forEach((customerItem) => {
        customerItem.addEventListener('click', () => {
            customerId = customerItem.querySelector('a').getAttribute('href').split('=')[1]; 
            console.log('Customer ID: ' + customerId);

            const header_namebox = document.querySelector('.details');
            const customerName = customerItem.querySelector('a').textContent;
            header_namebox.innerHTML = '<span>&nbsp;&nbsp;' + customerName + '</span>';

            chatBox.innerHTML = '<p>Loading chat...</p>'; 

            // Function to load chat messages for the selected customer
            function loadChat() {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'get-chat.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var data = xhr.responseText;
                            chatBox.innerHTML = data; 
                            scrollToBottom(); 
                        } else {
                            chatBox.innerHTML = '<p>Error loading chat.</p>';
                        }
                    }
                };

                xhr.send('customer_id=' + customerId);
            }

            loadChat();

            const chatInterval = setInterval(loadChat, 1000);

            function stopChatInterval() {
                clearInterval(chatInterval);
            }

            customerItem.addEventListener('mouseleave', stopChatInterval);
        });
    });

    document.getElementById('message-form').addEventListener('submit', function (e) {
        e.preventDefault();
        sendMessage();
    });
</script>
