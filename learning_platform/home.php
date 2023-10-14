<?php
require('../connection.inc.php');
require('../functions.inc.php');

$sql = "SELECT * FROM categories";
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;900&display=swap');
    :root{
   --main-color:#c43b68;
   --red:#e74c3c;
   --orange:#f39c12;
   --light-color:#888;
   --light-bg:#eee;
   --black:#2c3e50;
   --white:#fff;
   --border:.1rem solid rgba(0,0,0,.2);

   *{
   font-family: 'Poppins', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
    }
}
</style>
<body>
<div class="container">
   <header class="header">
      <section class="flex">
         <a href="../index.php" class="logo"><b>Learn at Craftopia</b></a>
         <form action="search.html" method="post" class="search-form">
            <input type="text" name="search_box" required placeholder="Search courses..." maxlength="100">
            <button type="submit" class="fas fa-search"></button>
         </form>
         <div class="icons">
            <div id="search-btn" class="fas fa-search"></div>
            <div id="toggle-btn" class="fas fa-sun"></div>
         </div>
      </section>
   </header>   
   
   <section class="courses"  style="background-image: url('../media/background.jpg'); background-size: cover; height:100vh;"> 
      <h1 class="heading">Our Categories</h1>
      <div class="box-container">
         <?php while($row = mysqli_fetch_assoc($res)) { ?>
            <div class="box">
               <div class="thumb">
                    
                  <img src="../admin/category_images/<?php echo  $row['image']?>" alt="Category Image" width="100">
               </div>
               <h3 class="title"><?php echo $row['categories']; ?></h3>
               <a href="playlist.php?category_id=<?php echo $row['id']; ?>" class="inline-btn">View Playlist</a>

            </div> 
         <?php } ?>
      </div>
   </section>

   <!-- custom js file link  -->
   <script src="script.js"></script>
</div>
</body>
</html>
