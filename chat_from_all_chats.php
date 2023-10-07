<?php 

  include_once "connection.inc.php";
  include_once "header.php";
  if(isset($_GET['incoming_msg_id'])){
    $incoming_msg_id = $_GET['incoming_msg_id'];

    echo "User ID: " . $_SESSION["USER_ID"] . "<br>";
    echo "Seller ID: " . $incoming_msg_id . "<br>";

    $q = "SELECT username FROM admin_users WHERE id =  {$incoming_msg_id}";
    $sq = mysqli_query($con, $q);
    if ($sq) {
        $rw = mysqli_fetch_assoc($sq); 
        if ($rw) {
            $seller_name = $rw['username'];
        } 
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your head content here -->
    <link rel="stylesheet" type="text/css" href="chat.css"> <!-- Add your chat-specific CSS here -->
</head>
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="all_chats.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <div class="details">
                    <span>&nbsp;&nbsp;<?php echo $seller_name ?></span>
                </div>
            </header>
            <div class="chat-box" id="chat-box">
                <!-- Chat messages will be added here -->

            </div>
            <form action="#" class="typing-area" id="message-form">
                <input type="text" class="incoming_id" name="incomingid" value="<?php echo $incoming_msg_id; ?>" hidden>
                <input type="text" name="message" class="input-field" id="message-input" placeholder="Type a message here..." autocomplete="off">
                <button type="submit"><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

    <script src="chat.js"></script>
</body>
</html>

</html>

