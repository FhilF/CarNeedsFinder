<?php require_once('conn.php') ?>
<?php


$query = "UPDATE shopreport SET adminstate = 1 where adminstate = 0 and reportstate = 0";
if(mysqli_query($conn, $query)){
	echo "success";
		}else{
	echo "error";
		}
?>
