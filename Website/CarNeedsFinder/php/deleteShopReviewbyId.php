<?php require_once('conn.php') ?>
<?php
if (empty($_POST['idreview'])) {
    header("Location: ../homeShopOwner.php");
}
$id = $_POST['idreview'];
$authname = $_POST['authname'];
$authcomment = $_POST['authcomment'];
$authemail = $_POST['authemail'];
$query = "DELETE FROM shopreview where idshopreview = $id";
if(mysqli_query($conn, $query)){
	echo "success";
		}else{
	echo "error";
		}
?>
