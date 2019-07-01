<?php require_once('conn.php') ?>
<?php
$email = $_POST['email'];
$pass = $_POST['pass'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$bday = $_POST['bday'];
$address = $_POST['address'];

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

        if (file_exists("../uploads/profiles/" . $filename)) {
            echo "error";
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"],
            "../uploads/profiles/" . $filename);
$query = "INSERT INTO admin(firstname, lastname, email, password, address, birthday, number, image,activation) VALUES ('$fname','$lname','$email','$pass','$address','$bday','$phone','$filename','Inactive')";
if(mysqli_query($conn, $query)){
	echo "success";
		}else{
	echo "error";
	}
			
        }
    }
} else {
    echo "Invalid file";
}
?>
