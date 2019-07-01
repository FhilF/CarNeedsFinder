<?php require_once('conn.php') ?>
<?php
$id = $_POST['idshop'];
	$query = "Select *, concat(sh.firstname , ' ' , sh.lastname) as name, s.address as shopaddress, concat('Activation: ',s.activation , ' <br> ', ar.date) as admincomment , concat(ar.comment , ' <br> ', ar.date) as admincomment2, concat(ar.comment) as admincomment3 from shop s 
				RIGHT JOIN shopowner sh ON s.shopowner_idshopowner = sh.idshopowner
				LEFT JOIN adminreview ar ON s.idshop = ar.shop_idshop
				WHERE s.idshop = '$id' and ar.idadminreview = (select max(idadminreview) from adminreview a2 right join shop
                s2 ON a2.shop_idshop = s2.idshop where s2.idshop = '$id')";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>