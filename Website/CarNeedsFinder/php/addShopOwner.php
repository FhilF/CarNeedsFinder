<?php require_once('conn.php') ?>
<?php

$email = $_POST['email'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phonenumber = $_POST['phonenumber'];
$address = $_POST['address'];
$image = $_POST['image'];


$query = "INSERT INTO shopowner(email,firstname,lastname,usernumber,address,accountstate) VALUES ('".addslashes($email)."','".addslashes($firstname)."','".addslashes($lastname)."','$phonenumber','".addslashes($address)."','Active')";
if(mysqli_query($conn, $query)){
	echo "success";
		session_start();
		$last_id = mysqli_insert_id($conn);
		$_SESSION['idShopOwner'] = $last_id; 
		$_SESSION['nameShopOwner'] = $firstname . ' ' . $lastname;
		$_SESSION['imageShopOwner']= $image;
		$_SESSION['emailShopOwner']= $email;
		$_SESSION['shopOwner'] = 1;
		}else{
	echo "error";
		}
?>
