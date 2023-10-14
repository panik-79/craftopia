<?php
require('../connection.inc.php');
require('../functions.inc.php');


if (isset($_GET['category_id'])) {
    $category_id = intval($_GET['category_id']);

    $category_query = "SELECT categories, image FROM categories WHERE id = $category_id";
    $category_result = mysqli_query($conn, $category_query);

    if ($category_result) {
        $category_row = mysqli_fetch_assoc($category_result);
        if ($category_row) {
            $category_name = $category_row['categories'];
            $category_image = $category_row['image'];
        } else {
            echo "Category not found!";
            exit;
        }
    } else {
        echo "Error fetching category details: " . mysqli_error($conn);
        exit;
    }

    $category_image_src = '../admin/category_images/' . $category_image;

    $videos_query = "SELECT * FROM videos WHERE categories_id = $category_id";
    $videos_result = mysqli_query($conn, $videos_query);
} else {
    echo "Category ID is not provided!";
    exit;
}
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

<header class="header" >
   <section class="flex">
      <a href="home.php" class="logo">Learn at Craftopia</a>
      <div class="icons">
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>
   </section>
</header>

<section class="playlist-details"  style="background-image: url('../media/background.jpg'); background-size: cover;">
   <h1 class="heading">Category: <?php echo $category_name; ?></h1>
</section>

<section class="playlist-videos"  style="background-image: url('../media/background.jpg'); background-size: cover; height:100vh;">
   <div class="box-container">
      <?php while ($video_row = mysqli_fetch_assoc($videos_result)) { ?>
         <a class="box" href="watch-video.php?video_id=<?php echo $video_row['vid']; ?>">
            <i class="fas fa-play"></i>

            <img src="<?php echo $category_image_src ?>" alt="">
            <h3><?php echo $video_row['title']; ?></h3>
         </a>
      <?php } ?>
   </div>
</section>

<!-- custom js file link -->
<script src="script.js"></script>

</body>
</html>

