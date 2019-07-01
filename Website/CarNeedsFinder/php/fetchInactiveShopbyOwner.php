<?php require_once('conn.php') ?>
<?php
    $id = $_POST['id'];
	$query = "Select *, concat(sh.firstname , ' ' , sh.lastname) as name, s.address as shopaddress from shop s RIGHT JOIN shopowner sh ON s.shopowner_idshopowner = sh.idshopowner where s.activation = 'Inactive' AND sh.idshopowner ='$id' OR s.activation = 'Marked' AND sh.idshopowner ='$id' OR s.activation = 'Resubmitted' AND sh.idshopowner ='$id'";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>