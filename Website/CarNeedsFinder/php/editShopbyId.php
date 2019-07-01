<?php require_once('conn.php') ?>
<?php
$id = $_POST['shopId'];
if($id == ""){
	header('Location: ../homeShopOwner.php');
}

$shopname = $_POST["shopname"];
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
if ($_POST["activation"] == "Revision"){
	$activation = "Inactive";
}else{
	$activation = $_POST["activation"];
}
$mydate = date("Ymdhis");
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ($_FILES['file']['size'] == 0)
{

$query = "UPDATE shop SET shopname = '".addslashes($shopname)."', address = '".addslashes($address)."', phonenumber = '$phonenumber', telephonenumber = '$telephonenumber', description = '".addslashes($shopdescription)."' , latitude = '$lat' , longitude = '$lng', website = '".addslashes($website)."' , facebook = '".addslashes($facebook)."' , shoptype = '$shoptype' , activation = '$activation' WHERE idShop = $id;";
if(mysqli_query($conn, $query)){
	echo "success";
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
			
$query = "UPDATE shop SET shopname = '".addslashes($shopname)."', address = '".addslashes($address)."', phonenumber = '$phonenumber', telephonenumber = '$telephonenumber', description = '".addslashes($shopdescription)."' , latitude = '$lat' , longitude = '$lng', website = '".addslashes($website)."' , facebook = '".addslashes($facebook)."' , shoptype = '$shoptype' , activation = '$activation', shopicon = '".addslashes($filename)."' WHERE idShop = $id;";
if(mysqli_query($conn, $query)){
	echo "success";
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
