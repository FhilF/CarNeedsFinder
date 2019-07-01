<?php require_once('conn.php') ?>
<?php


$query = "UPDATE shopreview SET adminstate = 1 where adminstate = 0 and reportstate = 1 ";
if(mysqli_query($conn, $query)){
	echo "success";
		}else{
	echo "error";
		}
?>
