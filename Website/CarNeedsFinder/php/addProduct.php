<?php require_once('conn.php') ?>
<?php
if (empty($_POST['idShopP'])) {
    header("Location: ../homeShopOwner.php");
}
$idShop = $_POST['idShopP'];
$product = $_POST['product'];

if (empty($_POST['productPrice'])){
$price = "0.00 PHP";	
}else{
$price = $_POST['productPrice']. 'PHP';
}
$description = $_POST['description'];
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
        echo "error";
    } else {
        $filename = $mydate.$_FILES["file"]["name"];
        if (file_exists("../uploads/products/" . $filename)) {
            echo " error";
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"],
            "../uploads/products/" . $filename);
$query = "INSERT INTO shopproduct(productname, description, price, image, shop_idshop) VALUES ('".addslashes($product)."','".addslashes($description)."','".addslashes($price)."','".addslashes($filename)."','$idShop')";
if(mysqli_query($conn, $query)){
	echo "success";
		}else{
	echo "error";
	}
			
        }
    }
} else {
    echo "error";
}
?>
