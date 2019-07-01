<?php require_once('conn.php') ?>
<?php
$shopID = $_POST['shopID'];
$activation = $_POST['activation'];
if(empty($_POST['reason'])){
    $reason = "";
}else{
	$reason = $_POST['reason'];
}
if(empty($_POST['comment'])){
    $comment = "N/A";
}else{
	$comment = $_POST['comment'];
}
$idAdmin = $_POST['idadmin'];
$fullcomment = $activation . ' - ' .$reason. ': ' .$comment ;

if (empty($reason)){
$query = "UPDATE shop SET activation='$activation' WHERE idshop = '$shopID'";
$query2 = "INSERT INTO adminreview(comment, shop_idshop,admin_idadmin,date,time,state) VALUES ('$comment', '$shopID','$idAdmin',curdate(),current_time(),0)";
if(mysqli_query($conn, $query)){
	if(mysqli_query($conn, $query2)){
	echo 'success';
		}else{
		echo 'error';
		}
	}else{
	echo 'error';
	}
}else{
$query = "UPDATE shop SET activation='$activation' WHERE idshop = '$shopID'";
$query2 = "INSERT INTO adminreview(comment, shop_idshop,admin_idadmin,date,time,state) VALUES ('$fullcomment','$shopID','$idAdmin',curdate(),current_time(),0)";
if(mysqli_query($conn, $query)){
	if(mysqli_query($conn, $query2)){
	echo 'success';
		}else{
		echo 'error';
		}
	}else{
	echo 'error';
	}
	
}
?>