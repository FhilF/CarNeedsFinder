<?php require_once('conn.php') ?>
<?php

$idReport = $_POST['idReport'];
$state = $_POST['state'];

$query = "UPDATE shopreport SET reportstate = '$state' where idshopreport = $idReport ";
if(mysqli_query($conn, $query)){
	echo "success";
		}else{
	echo "error";
		}
?>
