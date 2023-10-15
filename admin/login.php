<?php
require('connection.inc.php');
require('functions.inc.php');
$msg='';
if(isset($_POST['submit'])){
	$username=get_safe_value($conn,$_POST['username']);
	$password=get_safe_value($conn,$_POST['password']);
	$sql="select * from admin_users where username='$username' and password='$password'";
	$res=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($res);
	if($count>0){
      $row = mysqli_fetch_assoc($res);
      if($row['status'] == '0'){
         $msg = "Account Deactivated";
      }else{
		$_SESSION['ADMIN_LOGIN']='yes';
		$_SESSION['ADMIN_ID']=$row['id'];
		$_SESSION['ADMIN_USERNAME']=$username;
		$_SESSION['ADMIN_ROLE']=$row['role'];
		header('location: categories.php');
		die();
      }
	}else{
		$msg="Please enter correct login details";	
	}
}
?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
      <style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

         *{
            font-family: 'Poppins', sans-serif;
            margin:0; padding:0;
            box-sizing: border-box;
            outline: none; border:none;
            text-decoration: none;
         }

         body {
            background-color: white;
         }

         .sufee-login {
            display: flex;
            align-content: center;
            flex-wrap: wrap;
            justify-content: center;
            height: 100vh;
         }

         .login-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
         }

         .login-form {
            margin-top: 30px;
         }

         .form-group label {
            color: #c43b68;
         }

         .form-control {
            background-color: #f7f7f7;
            border: 2px solid #c43b68; 
            color: #333; 
         }

         .btn-success {
            background-color: #c43b68;
            border: none;
            color: white;
         }

         .btn-success:hover {
            background-color: #ff4981;
         }

         .field_error {
            color: #ff0000;
         }
         h1 {
            color: #c43b68; 
            text-align: center;
            font-size: 36px; 
            font-weight:bold;
         }
      </style>

   </head>
   <body  style="background-image: url('../media/background.jpg'); background-size: cover;">
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <h1 style="margin-bottom:10px; margin-top:20px;">Seller Login</h1>
               <div class="login-form mt-150">
                  <form method="post">
                     <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                     <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30" style="margin-top:20px;">Sign in</button>
					</form>
					<div class="field_error"><?php echo $msg?></div>
               </div>
            </div>   
         </div>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>