<?php
session_start();
$con=mysqli_connect("localhost","root","","ecom");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/phpeCom/');
define('SITE_PATH','http://127.0.0.1/phpeCom/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');
define('VIDEO_SERVER_PATH',SERVER_PATH.'media/videos/');
define('VIDEO_SITE_PATH',SITE_PATH.'media/videos/');
define('CATEGORY_SERVER_PATH',SITE_PATH.'admin/category_images/');
define('CATEGORY_SITE_PATH',SITE_PATH.'../admin/category_images/');
?>