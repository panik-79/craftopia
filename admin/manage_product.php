<?php
require('top.inc.php');

$condition = "";
$condition1 = " and added_by='". $_SESSION['ADMIN_ID'] ."'";
if($_SESSION['ADMIN_ROLE'] == 1){
	$condition = " and product.added_by='". $_SESSION['ADMIN_ID'] ."'";
	$condition1 = " and added_by='". $_SESSION['ADMIN_ID'] ."'";
	
}

$categories_id='';
$name='';
$mrp='';
$price='';
$qty='';
$image='';
$short_desc	='';
$description ='';
$best_seller ='';

$msg='';
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($conn,$_GET['id']);
	$res=mysqli_query($conn,"select * from product where id='$id' $condition1");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$categories_id=$row['categories_id'];
		$name=$row['name'];
		$mrp=$row['mrp'];
		$price=$row['price'];
		$qty=$row['qty'];
		$short_desc=$row['short_desc'];
		$description=$row['description'];
		$best_seller=$row['best_seller'];

	}else{
		header('location:product.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$categories_id=get_safe_value($conn,$_POST['categories_id']);
	$name=get_safe_value($conn,$_POST['name']);
	$mrp=get_safe_value($conn,$_POST['mrp']);
	$price=get_safe_value($conn,$_POST['price']);
	$qty=get_safe_value($conn,$_POST['qty']);
	$short_desc=get_safe_value($conn,$_POST['short_desc']);
	$description=get_safe_value($conn,$_POST['description']);
	$best_seller=get_safe_value($conn,$_POST['best_seller']);

	
	
	$res = mysqli_query($conn, "select * from product where name='$name'$condition1");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Product already exist";
			}
		}else{
			$msg="Product already exist";
		}
	}
	
	if(isset($_GET['id']) && $_GET['id']==0){
		if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
			$msg="Please select only png,jpg and jpeg image formate";
		}
	}else{
		if($_FILES['image']['type']!=''){
				if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
				$msg="Please select only png,jpg and jpeg image formate";
			}
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){
				$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
				$update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',best_seller='$best_seller'  ,image='$image' where id='$id'";
			}else{
				$update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',best_seller='$best_seller' where id='$id'";
			}
			mysqli_query($conn,$update_sql);
		}else{
			$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
			mysqli_query($conn,"insert into product(categories_id,name,mrp,price,qty,short_desc,description,best_seller,status,image, added_by) values('$categories_id','$name','$mrp','$price','$qty','$short_desc','$description','$best_seller',1,'$image', '".$_SESSION['ADMIN_ID']."')");
		}
		header('location:product.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Products</strong></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">Categories</label>
									<select class="form-control" name="categories_id">
										<option>Select Category</option>
										<?php
										$res=mysqli_query($conn,"select id,categories from categories order by categories asc");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$categories_id){
												echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['categories']."</option>";
											}
											
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Product Name</label>
									<input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">MRP</label>
									<input type="text" name="mrp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $mrp?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Price</label>
									<input type="text" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price?>">
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Best Seller</label>
									<select class="form-control" name="best_seller" required>
										<option>Select</option>
										<?php
										if($best_seller==1){
											echo '<option value="1" selected>Yes</option>
											<option value="0">No</option>';
										}else if($best_seller==0){
											echo '<option value="1">Yes</option>
											<option value="0" selected>No</option>';
										}else{
											echo '<option value="1">Yes</option>
											<option value="0">No</option>';
										}
										?>
										
										<option value="0">No</option>
									</select>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Qty</label>
									<input type="text" name="qty" placeholder="Enter qty" class="form-control" required value="<?php echo $qty?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Image</label>
									<input type="file" name="image" class="form-control" <?php echo  $image_required?>>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Short Description</label>
									<textarea name="short_desc" placeholder="Enter product short description" class="form-control" required><?php echo $short_desc?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Description</label>
									<textarea name="description" placeholder="Enter product description" class="form-control" required><?php echo $description?></textarea>
								</div>
		
								
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
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