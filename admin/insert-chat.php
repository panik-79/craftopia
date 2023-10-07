<?php
include('connection.inc.php'); // Include your database connection configuration

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get customer_id and message from the POST request
    $customer_id = (int)$_POST['customer_id'];
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $seller_id = $_SESSION['ADMIN_ID']; // Get the seller's ID from the session (replace with your authentication logic)

    // Insert the message into the messages table
    $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
            VALUES ($customer_id, $seller_id, '$message')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Message inserted successfully
        $response = array('status' => 'success', 'message' => $message);
        echo json_encode($response);
    } else {
        // Handle the error here
        $response = array('status' => 'error', 'message' => 'Failed to insert message.');
        echo json_encode($response);
    }
} else {
    // Invalid request method
    $response = array('status' => 'error', 'message' => 'Invalid request method.');
    echo json_encode($response);
}
?>
