<?php
require('top.inc.php');
isAdmin();
$categories = '';
$msg = '';
$existingImage = '';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($conn, $_GET['id']);
    $res = mysqli_query($conn, "SELECT * FROM categories WHERE id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $categories = $row['categories'];
        $existingImage = $row['image']; // Get the existing image filename
    } else {
        header('location: categories.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $categories = get_safe_value($conn, $_POST['categories']);

    // Check if a new image file is uploaded
    if ($_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $upload_path = 'category_images/' . $image;

        // Move the uploaded image to the destination folder
        move_uploaded_file($image_tmp, $upload_path);
    } else {
        // If no new image is uploaded, keep the existing image filename
        $image = $existingImage;
    }

    $res = mysqli_query($conn, "SELECT * FROM categories WHERE categories='$categories'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
            } else {
                $msg = "Category already exists";
            }
        } else {
            $msg = "Category already exists";
        }
    }

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            mysqli_query($conn, "UPDATE categories SET categories='$categories', image='$image' WHERE id='$id'");
        } else {
            mysqli_query($conn, "INSERT INTO categories(categories, image, status) VALUES ('$categories', '$image', '1')");
        }
        header('location: categories.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Categories</strong></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="categories" class="form-control-label">Categories</label>
                                <input type="text" name="categories" placeholder="Enter categories name" class="form-control" required value="<?php echo $categories ?>">
                            </div>

                            <div class="form-group">
                                <label for="image" class="form-control-label">Category Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <?php if (!empty($existingImage)) : ?>
                                <div class="form-group">
                                    <label for="existing-image" class="form-control-label">Existing Image</label>
                                    <img src="<?php echo $existingImage; ?>" alt="Category Image" width="100">
                                </div>
                            <?php endif; ?>

                            <button id="submit-btn" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
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
