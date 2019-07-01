<?php require_once('conn.php') ?>
<?php
if (empty($_POST['id'])) {
    header("Location: ../homeShopOwner.php");
}
$id = $_POST['id'];
$query = "DELETE FROM shopservice where idshopservice = $id";
if(mysqli_query($conn, $query)){
	echo "success";
		}else{
	echo "error";
		}
?>
