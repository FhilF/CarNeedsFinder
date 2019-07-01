<?php require_once('conn.php') ?>
<?php
$id = $_POST['shopId'];
$idshopowner = $_POST['Id'];
if($id == ""){
	header('Location: ../homeShopOwner.php');
}
$idAdmin = "1";
$activation = "Resubmitted";
$comment = "Application Re-Sumitted";


$namecopy = $_POST["namecopy"];
$addresscopy = $_POST["addresscopy"];
$pnumbercopy = $_POST["pnumbercopy"];
$tnumbercopy = $_POST["tnumbercopy"];
$desccopy = $_POST["desccopy"];
$latcopy = $_POST["latcopy"];
$lngcopy = $_POST["lngcopy"];
$webcopy = $_POST["webcopy"];
$fbcopy = $_POST["fbcopy"];
$typecopy = $_POST["typecopy"];
$iconcopy = $_POST["iconcopy"];
$permitcopy = $_POST["permitcopy"];



$shopname = $_POST["shopname"];
$permit = $_POST["permit"];
$shopdescription = $_POST["shopdescription"];
$website = $_POST["website"];
$facebook = $_POST["fb"];
$phonenumber = $_POST["pnumber"];
$telephonenumber = $_POST["tnumber"];
if(empty($_POST['shoptype'])){
    $shoptype = $_POST['shoptype2'];
} else {
    $shoptype = $_POST['shoptype'];
	$result = is_array($shoptype) ? 'Array' : 'not an Array';
	if ($result == 'Array'){
		$shoptype = implode(',', $_POST['shoptype']);
	}else{
		$shoptype = $_POST['shoptype'];
	}
}
$address = $_POST["address"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];
$mydate = date("Ymdhis");
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ($_FILES['file']['size'] == 0)
{

$query = "UPDATE shop SET shopname = '".addslashes($shopname)."', address = '".addslashes($address)."', phonenumber = '$phonenumber', telephonenumber = '$telephonenumber', description = '".addslashes($shopdescription)."' , latitude = '$lat' , longitude = '$lng', website = '".addslashes($website)."' , facebook = '".addslashes($facebook)."' , shoptype = '$shoptype' , businesspermitno = '".addslashes($permit)."', activation = '$activation' WHERE idShop = $id;";

$query2 = "INSERT INTO adminreview(comment, shop_idshop,admin_idadmin,date,time,state) VALUES ('$comment','$id','$idAdmin',curdate(),current_time(),0)";

$query3 = "INSERT INTO shopcopy(shopname, address, phonenumber, telephonenumber, description, latitude, longitude, website, facebook, shopowner_idshopowner, shoptype, shopicon, businesspermitno, shop_idshop) VALUES ('".addslashes($namecopy)."','".addslashes($addresscopy)."','$pnumbercopy','$tnumbercopy','".addslashes($desccopy)."','$latcopy','$lngcopy','".addslashes($webcopy)."','".addslashes($fbcopy)."','$idshopowner','$typecopy','".addslashes($iconcopy)."','".addslashes($permitcopy)."','$id')";
if(mysqli_query($conn, $query)){
if(mysqli_query($conn, $query2)){
if(mysqli_query($conn, $query3)){
	echo 'success';
	}else{
	echo 'error';
	}
	}else{
	echo 'error';
	}
		}else{
	echo "error3";
	}
}else{
if ((($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 10000000)
&& in_array($extension, $allowedExts)) {
    if ($_FILES["file"]["error"] > 0) {
        echo "error1";
    } else {
        $filename = $mydate.$_FILES["file"]["name"];
        if (file_exists("../uploads/" . $filename)) {
            echo " error2";
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"],
            "../uploads/" . $filename);
			
$query = "UPDATE shop SET shopname = '".addslashes($shopname)."', address = '".addslashes($address)."', phonenumber = '$phonenumber', telephonenumber = '$telephonenumber', description = '".addslashes($shopdescription)."' , latitude = '$lat' , longitude = '$lng', website = '".addslashes($website)."' , facebook = '".addslashes($facebook)."' , shoptype = '$shoptype' , activation = '$activation', businesspermitno = '".addslashes($permit)."', shopicon = '".addslashes($filename)."' WHERE idShop = $id;";
$query2 = "INSERT INTO adminreview(comment, shop_idshop,admin_idadmin,date,time,state) VALUES ('$comment','$id','$idAdmin',curdate(),current_time(),0)";
$query3 = "INSERT INTO shopcopy(shopname, address, phonenumber, telephonenumber, description, latitude, longitude, website, facebook, shopowner_idshopowner, shoptype, shopicon, businesspermitno, shop_idshop) VALUES ('".addslashes($namecopy)."','".addslashes($addresscopy)."','$pnumbercopy','$tnumbercopy','".addslashes($desccopy)."','$latcopy','$lngcopy','".addslashes($webcopy)."','".addslashes($fbcopy)."','$idshopowner','$typecopy','".addslashes($iconcopy)."','".addslashes($permitcopy)."','$id')";
if(mysqli_query($conn, $query)){
if(mysqli_query($conn, $query2)){
if(mysqli_query($conn, $query3)){
	echo 'success';
	}else{
	echo 'error';
	}
	}else{
	echo 'error';
	}
		}else{
	echo "error3";
	}
			
        }
    }
} else {
    echo "error4";
}

}
?>
