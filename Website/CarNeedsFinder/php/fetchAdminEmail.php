<?php require_once('conn.php') ?>
<?php
$email = $_POST['email'];
	$query = "select * , concat(lastname,', ',firstname) as name from admin where email = '".addslashes($email)."'";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

?>