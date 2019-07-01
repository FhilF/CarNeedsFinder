<?php require_once('conn.php') ?>
<?php
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d H:i:s');
$idShopReview = $_POST['idShopReview'];
$state = $_POST['state'];

$query = "UPDATE shopreview SET reportstate = '$state', datereported = '$date', adminstate = '0' where idshopreview ='$idShopReview' ";
if(mysqli_query($conn, $query)){
	echo "success";
		}else{
	echo "error";
		}
?>
