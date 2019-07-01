<?php require_once('conn.php') ?>
<?php
if (empty($_POST['idSched'])) {
    header("Location: ../homeShopOwner.php");
}
$idSched = $_POST['idSched'];
$opening = $_POST['opening'];
$closing = $_POST['closing'];

$query = "UPDATE operatinghours SET opening = '$opening' , closing = '$closing' where idoperatinghours = $idSched ";
if(mysqli_query($conn, $query)){
	echo "success";
		}else{
	echo "error";
		}
?>
