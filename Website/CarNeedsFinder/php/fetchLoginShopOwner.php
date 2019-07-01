<?php

?>
<?php
include "conn.php";
$email = $_POST['email'];
$image = $_POST['image'];
if ($email != ""){

    $sql_query = "select *, concat(firstname,' ',lastname) as name from shopowner where email='".$email."'";
    $result = mysqli_query($conn,$sql_query);
    $row = mysqli_fetch_array($result);

	$idrow = $row['idshopowner'];
	$emailrow = $row['email'];
	$namerow = $row['name'];
	$activationrow = $row['accountstate'];
	
    if($emailrow == $email && $activationrow == 'Active'){
		session_start();
		$_SESSION['idShopOwner'] = $idrow; 
		$_SESSION['nameShopOwner'] = $namerow;
		$_SESSION['imageShopOwner']= $image;
		$_SESSION['emailShopOwner']= $emailrow;
		$_SESSION['shopOwner'] = 1;
        echo 1;
    }else if ($emailrow == $email && $activationrow == 'Inactive'){
		echo 2;	
	}else{
		echo 0;
	}

}else{
	echo 4;
}

?>