<?php require_once('conn.php') ?>
<?php
$id = $_POST['idshop'];
	$query = "Select *, concat(a.lastname ,', ', a.firstname, '&nbsp;:&nbsp;&nbsp; ' , ar.comment, '&nbsp;&nbsp;','( ',ar.date,' - ', ar.time,' )') as comment, concat('CNF Admin', '&nbsp;:&nbsp;&nbsp; ' , ar.comment, '&nbsp;&nbsp;','( ',ar.date,' - ', ar.time,' )') as comment2 from shop s 
				LEFT JOIN adminreview ar ON s.idshop = ar.shop_idshop
				LEFT JOIN admin a ON ar.admin_idadmin = a.idadmin
				WHERE s.idshop ='$id'
				order by ar.date,ar.time";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>