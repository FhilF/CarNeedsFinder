<?php require_once('conn.php') ?>
<?php
session_start();
$id = $_POST['id'];
$shopname = $_POST["shopname"];
$shopdescription = $_POST["shopdescription"];
$website = $_POST["website"];
$facebook = $_POST["fb"];
$phonenumber = $_POST["pnumber"];
$telephonenumber = $_POST["tnumber"];
$shoptype = implode(',', $_POST['shoptype']);
$address = $_POST["address"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];

$idAdmin = "1";
$comment = "Application Submitted";

$mydate = date("Ymdhis");
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
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
$query = "INSERT INTO shop(shopname, address, phonenumber, telephonenumber, description, latitude, longitude, website, facebook, shopowner_idshopowner, shoptype, shopicon, activation) VALUES ('".addslashes($shopname)."','".addslashes($address)."','$phonenumber','$telephonenumber','".addslashes($shopdescription)."','$lat','$lng','".addslashes($website)."','".addslashes($facebook)."','$id','$shoptype','".addslashes($filename)."','Inactive')";

if(mysqli_query($conn, $query)){
	$last_id = mysqli_insert_id($conn);
	$query2 = "INSERT INTO adminreview(comment, shop_idshop,admin_idadmin,date,time,state) VALUES ('$comment','$last_id','$idAdmin',curdate(),current_time(),0)";
	if(mysqli_query($conn, $query2)){
	echo "success";
		}else{
	echo "error3";
	}
		}else{
	echo "error5";
	}
			
        }
    }
} else {
    echo "error4";
}
?>
