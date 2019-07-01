<?php require_once('conn.php') ?>
<?php
if( isset($_POST['id']) && isset($_POST['idshop'])){
$id = $_POST['id'];
$idshop = $_POST['idshop'];
}else{
$idshop = "0";
$id = "0";
}
	$query = "Select * from shop s RIGHT JOIN shopowner sh ON s.shopowner_idshopowner = sh.idshopowner where s.idshop = '$idshop' AND s.shopowner_idshopowner = '$id' AND s.activation = 'Active'";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>