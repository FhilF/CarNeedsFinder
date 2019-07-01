<?php
session_start();
?>
<?php
include "conn.php";

$email = mysqli_real_escape_string($conn,$_POST['email']);
$password = mysqli_real_escape_string($conn,$_POST['password']);

if ($email != "" && $password != ""){

    $sql_query = "select *, concat(firstname,' ',lastname) as name from admin where email='".$email."' and password='".$password."'";
    $result = mysqli_query($conn,$sql_query);
    $row = mysqli_fetch_array($result);
	
	$idadminrow = $row['idadmin'];
	$emailrow = $row['email'];
	$passwordrow = $row['password'];
	$activationrow = $row['activation'];
	$namerow = $row['name'];
	$imagerow = $row['image'];
    if($emailrow == $email && $activationrow == 'Inactive' && $passwordrow == $password){
        echo 2;
    }elseif($emailrow == $email && $activationrow == 'Main' && $passwordrow == $password){
		$_SESSION['activation'] = $activationrow;
		$_SESSION['idadmin'] = $idadminrow;
		$_SESSION['name'] = $namerow;
		$_SESSION['image'] = $imagerow;
		$_SESSION['account'] = 1;
        echo 1;
    }elseif($emailrow == $email && $activationrow == 'Admin' && $passwordrow == $password){
		$_SESSION['activation'] = $activationrow;
		$_SESSION['idadmin'] = $idadminrow;
		$_SESSION['name'] = $namerow;
		$_SESSION['image'] = $imagerow;
		$_SESSION['account'] = 1;
        echo 1;
    }else{
		echo 0;	
	}

}else if ($email == "" || $password == ""){
	echo 3;
}else{
	echo 4;
}