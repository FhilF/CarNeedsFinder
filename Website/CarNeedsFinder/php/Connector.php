<?php 
 
 /*
 * Created by Belal Khan
 * website: www.simplifiedcoding.net 
 */
 
 //Class DbConnect
 class Connector
 {
 //Variable to store database link
 private $con;
 
 //Class constructor
 function __construct()
 {
 
 }
 
 //This method will connect to the database
 function connect()
 {
 //Including the constants.php file to get the database constants
 include_once dirname(__FILE__) . '/conn.php';
 
 //connecting to mysql database
 $this->con = new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
 
 //finally returning the connection link 
 return $this->con;
 }
 
 }