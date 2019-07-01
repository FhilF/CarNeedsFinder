<?php
session_start();
unset($_SESSION["shopOwner"]);
unset($_SESSION['idShopOwner']);
unset($_SESSION['nameShopOwner']);
unset($_SESSION['imageShopOwner']);
unset($_SESSION['emailShopOwner']);
header('Location: ../index.php');
?>