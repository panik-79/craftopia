<?php
include('connection.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = (int)$_POST['customer_id'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $seller_id = $_SESSION['ADMIN_ID'];

    $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
            VALUES ($customer_id, $seller_id, '$message')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $response = array('status' => 'success', 'message' => $message);
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to insert message.');
        echo json_encode($response);
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method.');
    echo json_encode($response);
}
?>

