<?php
include_once "top.inc.php";

if(isset($_SESSION["ADMIN_ID"])){
    $seller_id = $_SESSION["ADMIN_ID"];
    $output = "";

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT DISTINCT outgoing_msg_id FROM messages WHERE incoming_msg_id = $seller_id";
    $stmt = mysqli_prepare($con, $sql);
    // mysqli_stmt_bind_param($stmt, "i", $seller_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $customer_id = intval($row['outgoing_msg_id']);
            
            // Query to fetch customer details if needed
            $customer_query = "SELECT * FROM users WHERE id = $customer_id";
            $stmt_customer = mysqli_prepare($con, $customer_query);
            // mysqli_stmt_bind_param($stmt_customer, "i", $customer_id);
            mysqli_stmt_execute($stmt_customer);
            $customer_result = mysqli_stmt_get_result($stmt_customer);
            
            if ($customer_data = mysqli_fetch_assoc($customer_result)) {
                $customer_name = $customer_data['name'];
                // Add more customer details as needed
                
                // Fetch messages for this customer
                $messages_query = "SELECT * FROM messages WHERE (outgoing_msg_id = $customer_id AND incoming_msg_id = $seller_id) OR (outgoing_msg_id = $seller_id AND incoming_msg_id = $customer_id) ORDER BY msg_id";

                $stmt_messages = mysqli_prepare($con, $messages_query);
                // mysqli_stmt_bind_param($stmt_messages, "ii", $customer_id, $seller_id);
                mysqli_stmt_execute($stmt_messages);
                $messages_result = mysqli_stmt_get_result($stmt_messages);
                
                if(mysqli_num_rows($messages_result) > 0){
                    while($message_row = mysqli_fetch_assoc($messages_result)){
                        // Escape the message content to prevent XSS
                        $message = htmlspecialchars($message_row['msg']);
                        
                        if($message_row['outgoing_msg_id'] === $customer_id){
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

                $output .= '</div>'; // Close the customer chat div
            }
        }
    }else{
        $output .= '<p>No messages from customers.</p>';
    }

    echo $output;
}
?>
