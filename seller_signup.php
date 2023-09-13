<?php
require('connection.inc.php');


if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($con, $_POST['username']);
   $email = mysqli_real_escape_string($con, $_POST['email_id']);
   $mob = mysqli_real_escape_string($con, $_POST['contact_no']);
   $pass = mysqli_real_escape_string($con, $_POST['password']);
   $cpass = mysqli_real_escape_string($con, $_POST['cpassword']);

   $select = " SELECT * FROM admin_users WHERE email_id = '$email' && username = '$name' ";

   $result = mysqli_query($con, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'User already exists !';

   }else{

      if($pass != $cpass){
         $error[] = 'Password not matched!';
      }else{
         $insert = "INSERT INTO admin_users(username, email_id, contact_no, password, role, status) VALUES('$name','$email', '$mob', '$pass',1, 1)";
         mysqli_query($con, $insert);
         header("location:admin/login.php");
         exit;
      }
   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Seller Registration Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/seller_login.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Register as a Seller</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="username" required placeholder="Enter your name">
      <input type="email" name="email_id" required placeholder="Enter your email">
      <input type="text" name="contact_no" required placeholder="Enter your contact number">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="password" name="cpassword" required placeholder="Confirm your password">

      <input type="submit" name="submit" value="register now" class="form-btn">
   </form>

</div>

</body>
</html>