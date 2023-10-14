<?php
require('../connection.inc.php');
require('../functions.inc.php');

// Checking if a video ID is provided in the query parameter
if (isset($_GET['video_id'])) {
    $video_id = intval($_GET['video_id']);

    $video_query = "SELECT * FROM videos WHERE vid = $video_id";
    $video_result = mysqli_query($conn, $video_query);

    if ($video_row = mysqli_fetch_assoc($video_result)) {
        $video_title = $video_row['title'];
        $video_src = '../media/videos/' . $video_row['video'];
        $video_description = $video_row['description'];
    } else {
        echo "Video not found!";
        exit;
    }
} else {
    echo "Video ID is not provided!";
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
   <header class="header">
      <section class="flex">
         <a href="home.php" class="logo">Learn at Craftopia</a>
         <div class="icons">
            <div id="toggle-btn" class="fas fa-sun"></div>
         </div>

      </section>
   </header>

   <section class="watch-video"  style="background-image: url('../media/background.jpg'); background-size: cover;">
      <div class="video-container"  style="background-image: url('../media/background.jpg'); background-size: cover; ">
         <div class="video">
            <video src="<?php echo $video_src; ?>" controls id="video" width="900" height="750"></video>
         </div>
         <h3 class="title"><?php echo $video_title; ?></h3>

         <form action="" method="post" class="flex">
            <a href="playlist.php?category_id=<?php echo $video_row['categories_id']; ?>" class="inline-btn">View Playlist</a>
         </form>
         <p class="description"><?php echo $video_description; ?></p>
      </div>
   </section>
   <script src="script.js"></script>
</body>
</html>
