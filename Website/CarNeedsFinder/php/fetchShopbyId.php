<?php require_once('conn.php') ?>
<?php
$id = $_POST['id'];
	$query = "Select * from shop where idshop = $id";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>