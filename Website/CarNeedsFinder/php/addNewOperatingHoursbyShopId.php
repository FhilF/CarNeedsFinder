<?php require_once('conn.php') ?>
<?php
if (empty($_POST['id'])) {
    header("Location: ../homeShopOwner.php");
}
$id = $_POST['id'];

$queryDelete = "DELETE FROM operatinghours where shop_idshop = $id";
$query = "INSERT INTO operatinghours(day,opening,closing,shop_idshop) VALUES 
			('Monday','08:00:00','17:00:00',$id),
			('Tuesday','08:00:00','17:00:00',$id),
			('Wednesday','08:00:00','17:00:00',$id),
			('Thursday','08:00:00','17:00:00',$id),
			('Friday','08:00:00','17:00:00',$id),
			('Saturday','08:00:00','17:00:00',$id),
			('Sunday','08:00:00','17:00:00',$id)
			";
if(mysqli_query($conn, $queryDelete)){
	if(mysqli_query($conn, $query)){
		echo "success";
		}else{
		echo "error";
		}
	}else{
	echo "error";
	}

?>
