<?php require_once('conn.php') ?>
<?php
if (empty($_POST['data'])) {
    header("Location: ../homeShopOwner.php");
}else{
	$id = $_POST['id'];
	$data = $_POST['data'];
}

$query = "UPDATE admin SET activation='$data' WHERE idadmin = '$id'";
if(mysqli_query($conn, $query)){
	echo 1;
		}else{
	echo 0;
	}
?>