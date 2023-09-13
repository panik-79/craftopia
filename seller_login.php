<?php


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Seller Login Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/seller_login.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>Don't have an account? <a href="seller_signup.php">Register now</a></p>
   </form>

</div>

</body>
</html>