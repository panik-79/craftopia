<?php
require('top.inc.php');

$condition = "";
$condition1 = " and added_by='". $_SESSION['ADMIN_ID'] ."'";
if($_SESSION['ADMIN_ROLE'] == 1){
	$condition = " and product.added_by='". $_SESSION['ADMIN_ID'] ."'";
	$condition1 = " and added_by='". $_SESSION['ADMIN_ID'] ."'";
}

$vid = '';
$categories_id = '';
$video_title = '';
$video = '';
$short_desc = '';

$msg = '';
$video_required = 'required';
if(isset($_GET['vid']) && $_GET['vid']!=''){
	$video_required='';
	$vid = get_safe_value($conn, $_GET['vid']);
	$res = mysqli_query($conn, "select * from videos where vid='$vid'");
	$check = mysqli_num_rows($res);
	if($check > 0){
		$row = mysqli_fetch_assoc($res);
		$categories_id = $row['categories_id'];
		$video_title = $row['title'];
		$short_desc = $row['description'];
	}else{
		header('location: add_videos.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$categories_id = get_safe_value($conn, $_POST['categories_id']);
	$video_title = get_safe_value($conn, $_POST['video_title']);
	$short_desc = get_safe_value($conn, $_POST['short_desc']);
	
	$res = mysqli_query($conn, "select * from videos where title='$video_title'");
	$check = mysqli_num_rows($res);
	if($check > 0){
		if(isset($_GET['vid']) && $_GET['vid']!=''){
			$getData = mysqli_fetch_assoc($res);
			if($vid == $getData['vid']){
			
			}else{
				$msg = "Video already exists";
			}
		}else{
			$msg = "Video already exists";
		}
	}
	
    if(isset($_GET['vid']) && $_GET['vid'] == 0){
        if($_FILES['video']['type'] != 'video/mp4' && $_FILES['video']['type'] != 'video/webm' && $_FILES['video']['type'] != 'video/ogg'){
            $msg = "Please select only MP4, WebM, or Ogg video formats.";
        }
    }else{
        if($_FILES['video']['type'] != ''){
            if($_FILES['video']['type'] != 'video/mp4' && $_FILES['video']['type'] != 'video/webm' && $_FILES['video']['type'] != 'video/ogg'){
                $msg = "Please select only MP4, WebM, or Ogg video formats.";
            }
        }
    }
    
    if ($msg == '') {
        if (isset($_POST['submit'])) {
            if (isset($_FILES['video']) && $_FILES['video']['name'] != '') {
                $videoTitle = $_POST['video_title'];
                $short_desc = $_POST['short_desc'];
                $videoCategory = $_POST['categories_id'];
    
                $video = rand(111111111, 999999999) . '_' . $_FILES['video']['name'];
                move_uploaded_file($_FILES['video']['tmp_name'], VIDEO_SERVER_PATH . $video);
    

                if (isset($_GET['vid']) && $_GET['vid'] != '') {

                    $id = $_GET['vid'];
                    $update_sql = "UPDATE videos SET title='$videoTitle', description='$short_desc', categories_id='$videoCategory', video='$video' WHERE vid='$vid'";
                    mysqli_query($conn, $update_sql);
                } else {
                    // Insert a new video record
                    $insert_sql = "INSERT INTO videos (title, description, categories_id, video) VALUES ('$videoTitle', '$short_desc', '$videoCategory', '$video')";
                    mysqli_query($conn, $insert_sql);
                }
                
                header('location: add_videos.php');
                die();
            }
        }
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Video</strong></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Categories</label>
                                <select class="form-control" name="categories_id">
                                    <option>Select Category</option>
                                    <?php
                                    $res = mysqli_query($conn, "select id, categories from categories order by categories asc");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        if ($row['id'] == $categories_id) {
                                            echo "<option selected value=" . $row['id'] . ">" . $row['categories'] . "</option>";
                                        } else {
                                            echo "<option value=" . $row['id'] . ">" . $row['categories'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Video Title</label>
                                <input type="text" name="video_title" placeholder="Enter Video Title" class="form-control" required value="<?php echo $video_title ?>">
                            </div>

                            <?php $video_required = true; ?>

                            <div class="form-group">
                                <label for="video" class="form-control-label">Video</label>
                                <input type="file" name="video" class="form-control" <?php echo $video_required ? 'required' : '' ?>>
                            </div>

                            <div class="form-group">
                                <label for="categories" class="form-control-label">Description</label>
                                <textarea name="short_desc" placeholder="Enter video description" class="form-control" required><?php echo $short_desc ?></textarea>
                            </div>

                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                            <div class="field_error"><?php echo $msg ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('footer.inc.php');
?>
