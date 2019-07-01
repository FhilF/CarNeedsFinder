<?php require_once('conn.php') ?>
<?php
$id = $_POST['idShopE'];
if($id == ""){
	header('Location: ../homeShopOwner.php');
}


$shopdescription = $_POST["editDescription"];
$website = $_POST["editWebsite"];
$facebook = $_POST["editFacebook"];
$phonenumber = $_POST["editPhone"];
$telephonenumber = $_POST["editTelephone"];


$query = "UPDATE shop SET phonenumber = '$phonenumber', telephonenumber = '$telephonenumber', description = '".addslashes($shopdescription)."' , website = '".addslashes($website)."' WHERE idShop = $id;";
if(mysqli_query($conn, $query)){
	echo "success";
		}else{
	echo "error3";
	}

?>
