<?php require_once('conn.php') ?>
<?php
$id = $_POST['id'];
	$query = "select * , concat(lastname,', ',firstname) as name from admin where idadmin = $id";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>