<?php

include_once "connection.inc.php";
var_dump($_POST);
file_put_contents('post_data.txt', print_r($_POST, true));

if (isset($_SESSION["USER_ID"])) {

    $outgoing_id = $_SESSION["USER_ID"];


    $incoming_id = intval($_POST['incomingid']);
    $message = $_POST['message'];

    // Output JavaScript with the extracted values
    echo '<script>';
    echo 'var incoming_id = ' . $incoming_id . ';';
    echo 'var message = "' . $message . '";';
    echo '</script>';

        if (!empty($message)) {
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')");
            
            if ($sql) {
                // Message inserted successfully
                echo json_encode(array('status' => 'success', 'message' => $message));
            } else {
                // Handle the error here
                echo json_encode(array('status' => 'error', 'message' => 'Failed to insert message.'));
            }
        }
}

?>