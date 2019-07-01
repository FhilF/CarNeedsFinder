<?php require_once('conn.php') ?>
<?php
$shopID = $_POST['shopID'];
$activation = $_POST['activation'];
$query = "UPDATE shop SET activation='$activation' WHERE idshop = '$shopID'";
if(mysqli_query($conn, $query)){
	echo 1;
		}else{
	echo 0;
	}
?>