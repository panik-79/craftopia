<?php

function get_safe_value($conn,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($conn,$str);
	}
}


function isAdmin(){
	if(!isset($_SESSION['ADMIN_LOGIN'])){
	?>
		<script>
		window.location.href='login.php';
		</script>
		<?php
	}
	if($_SESSION['ADMIN_ROLE']==1){
		?>
		<script>
		window.location.href='product.php';
		</script>
		<?php
	}
}
?>