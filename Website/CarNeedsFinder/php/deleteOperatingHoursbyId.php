<?php require_once('conn.php') ?>
<?php
if (empty($_POST['id'])) {
    header("Location: ../homeShopOwner.php");
}
$id = $_POST['id'];
$query = "DELETE FROM operatinghours where idoperatinghours = $id";
if(mysqli_query($conn, $query)){
	echo "success";
		}else{
	echo "error";
		}
?>
