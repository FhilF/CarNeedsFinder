<?php require_once('conn.php') ?>
<?php
if (empty($_POST['idShop'])) {
    header("Location: ../homeShopOwner.php");
}
$idShop = $_POST['idShop'];
$mydate = date("Ymdhis");
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file1"]["name"]);
$extension = end($temp);
if ((($_FILES["file1"]["type"] == "image/gif")
|| ($_FILES["file1"]["type"] == "image/jpeg")
|| ($_FILES["file1"]["type"] == "image/jpg")
|| ($_FILES["file1"]["type"] == "image/pjpeg")
|| ($_FILES["file1"]["type"] == "image/x-png")
|| ($_FILES["file1"]["type"] == "image/png"))
&& ($_FILES["file1"]["size"] < 10000000)
&& in_array($extension, $allowedExts)) {
    if ($_FILES["file1"]["error"] > 0) {
        echo "error";
    } else {
        $filename = $mydate.$_FILES["file1"]["name"];
        if (file_exists("../uploads/" . $filename)) {
            echo " error";
        } else {
            move_uploaded_file($_FILES["file1"]["tmp_name"],
            "../uploads/" . $filename);
$query = "INSERT INTO shopimage(image, shop_idshop) VALUES ('".addslashes($filename)."','$idShop')";
if(mysqli_query($conn, $query)){
	echo "success";
		}else{
	echo "error";
	}
			
        }
    }
} else {
    echo "size";
}
?>
