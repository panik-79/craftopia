<?php
require('top.inc.php');
isAdmin();
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($conn,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($conn,$_GET['operation']);
		$id=get_safe_value($conn,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update admin_users set status='$status' where id='$id'";
		mysqli_query($conn,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($conn,$_GET['id']);
		$delete_sql="delete from admin_users where id='$id'";
		mysqli_query($conn,$delete_sql);
	}
}

$sql="select * from admin_users where role=1 order by id desc";
$res=mysqli_query($conn,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Manage Vendors</h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th width="4%">ID</th>
							   <th width="20%">Username</th>
							   <th width="20%">Password</th>
							   <th width="20%">Email</th>
							   <th width="10%">Mobile</th>
							   <th width="26%"></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['username']?></td>
							   <td><?php echo $row['password']?></td>
							   <td><?php echo $row['email_id']?></td>
							   <td><?php echo $row['contact_no']?></td>
							  
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>inactive</a></span>&nbsp;";
								}
					
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								
								?>
							   </td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>