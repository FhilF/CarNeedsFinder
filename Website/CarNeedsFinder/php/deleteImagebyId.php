<?php require_once('conn.php') ?>
<?php
if (empty($_POST['id'])) {
    header("Location: ../homeShopOwner.php");
}
$id = $_POST['id'];
$image = $_POST['image'];
$query = "DELETE FROM shopimage where idshopimage = $id";
if(mysqli_query($conn, $query)){
	echo "success";
	unlink('../uploads/'.$image);
		}else{
	echo "error";
		}
?>
