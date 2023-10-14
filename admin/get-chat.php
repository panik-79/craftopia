<?php
include('connection.inc.php'); // Include your database connection configuration

if(isset($_SESSION["ADMIN_ID"])){
    $seller_id = $_SESSION["ADMIN_ID"];
    $output = "";
    $customer_id = $_POST['customer_id'];
    $output .= '<div class="customer-chat">';
    
    // Fetch messages for this customer only
    $messages_query = "SELECT * FROM messages WHERE (outgoing_msg_id = $seller_id  AND incoming_msg_id = $customer_id) OR 
                        (outgoing_msg_id = $customer_id AND incoming_msg_id = $seller_id) ORDER BY msg_id";

    $stmt_messages = mysqli_prepare($conn, $messages_query);
    mysqli_stmt_execute($stmt_messages);
    $messages_result = mysqli_stmt_get_result($stmt_messages);
    
    if(mysqli_num_rows($messages_result) > 0){
        while($message_row = mysqli_fetch_assoc($messages_result)){
            // Escape the message content to prevent XSS
            $message = htmlspecialchars($message_row['msg']);
            

            if($message_row['outgoing_msg_id'] === (int)$customer_id){
                $output .= '<div class="chat outgoing">
                            <div class="details">
                                <p>'. $message .'</p>
                            </div>
                            </div>';
            }else{
                $output .= '<div class="chat incoming">
                            <div class="details">
                                <p>'. $message .'</p>
                            </div>
                            </div>';
            }
        }
    } else {
        $output .= '<p>No messages from this customer.</p>';
    }

    // Close the chat div for this customer
    $output .= '</div>';
}
    echo $output;
?>

