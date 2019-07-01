<?php require_once('conn.php') ?>
<?php
$idSO = $_POST['idSO'];
	$query = "Select * from shopowner where idshopowner = $idSO";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);


?>