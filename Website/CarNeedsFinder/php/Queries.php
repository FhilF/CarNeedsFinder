<?php
 
class Queries
{
    //Database connection link
    private $con;
 
    //Class constructor
    function __construct()
    {
        //Getting the DbConnect.php file
        require_once dirname(__FILE__) . '/Connector.php';
 
        //Creating a DbConnect object to connect to the database
        $db = new Connector();
 
        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->con = $db->connect();
    }
	
	/*
	* The create operation
	* When this method is called a new record is created in the database
	*/

	function register($firstname, $lastname, $email, $password, $birthday, $address, $phonenumber){
		$stmt = $this->con->prepare("INSERT INTO user (firstname, lastname, email, password, address, birthday, phonenumber) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssss", $firstname, $lastname, $email, $password, $address, $birthday, $phonenumber);
		if($stmt->execute())
			return true; 
		return false; 
	}


	function addreview($comment, $rate, $shop_idshop, $reviewername, $revieweremail){
		$stmt = $this->con->prepare("INSERT INTO shopreview (comment, rate, shop_idshop, reviewername, revieweremail) VALUES (?, ?, ?, ?,?)");
		$stmt->bind_param("sisss", $comment, $rate, $shop_idshop, $reviewername, $revieweremail);
		if($stmt->execute())
			return true; 
		return false; 
	}

	function addShopReport($report,$reportername,$reporteremail,$shop_idshop){
		$stmt = $this->con->prepare("INSERT INTO shopreport (report,reportername,reporteremail,shop_idshop) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("sssi", $report,$reportername,$reporteremail,$shop_idshop);
		if($stmt->execute())
			return true; 
		return false; 
	}

	/*
	* The read operation
	* When this method is called it is returning all the existing record of the database
	*/
	function login($email, $password){
		$stmt = $this->con->prepare("SELECT iduser, firstname, lastname, email, password, address, birthday, phonenumber FROM user WHERE email = ? and password = ?");
		$stmt->bind_param("ss", $email, $password);
		$stmt->execute();
		$stmt->bind_result($iduser, $firstname, $lastname, $email, $password, $address, $birthday, $phonenumber);
		
		$users = array(); 
		
		while($stmt->fetch()){
			$user  = array();
			$user['iduser'] = $iduser; 
			$user['firstname'] = $firstname; 
			$user['lastname'] = $lastname; 
			$user['email'] = $email; 
			$user['password'] = $password; 
			$user['address'] = $address; 
			$user['birthday'] = $birthday; 
			$user['phonenumber'] = $phonenumber; 
			
			array_push($users, $user); 
		}
		
		return $users; 
	}

	function getShop($type){
		$stmt = $this->con->prepare("SELECT idshop, shopname, shop.address, shop.phonenumber, telephonenumber, description, latitude, longitude, website, facebook, shoptype, shopicon, shopowner.idshopowner as idshopowner, shopowner.firstname as owner_firstname, shopowner.lastname as  owner_lastname, shopowner.email as owner_email, AVG(shopreview.rate) AS total_rate, COUNT(DISTINCT shopreview.idshopreview) AS total_userrate, GROUP_CONCAT(DISTINCT shopimage.idshopimage) as idslider, GROUP_CONCAT(DISTINCT shopimage.image) as slider, GROUP_CONCAT(DISTINCT operatinghours.idoperatinghours) As idHours, GROUP_CONCAT( operatinghours.opening) As opening, GROUP_CONCAT(operatinghours.closing) As closing, GROUP_CONCAT(DISTINCT operatinghours.day ORDER BY 
		     CASE
		          WHEN operatinghours.day = 'Sunday' THEN 1
		          WHEN operatinghours.day = 'Monday' THEN 2
		          WHEN operatinghours.day = 'Tuesday' THEN 3
		          WHEN operatinghours.day = 'Wednesday' THEN 4
		          WHEN operatinghours.day = 'Thursday' THEN 5
		          WHEN operatinghours.day = 'Friday' THEN 6
		          WHEN operatinghours.day = 'Saturday' THEN 7
		     END ASC) As day FROM shop LEFT JOIN shopowner ON shop.shopowner_idshopowner = shopowner.idshopowner LEFT JOIN shopreview ON shop.idshop = shopreview.shop_idshop LEFT JOIN shopimage ON shop.idshop = shopimage.shop_idshop LEFT JOIN operatinghours ON shop.idshop = operatinghours.shop_idshop WHERE shoptype LIKE ? AND shop.activation = 'Active' GROUP BY shop.idshop");
		$stmt->bind_param("s", $type);
		$stmt->execute();
		$stmt->bind_result($idshop, $shopname, $address, $phonenumber, $telephonenumber, $description, $latitude, $longitude, $website, $facebook, $shoptype, $shopicon, $idshopowner, $owner_firstname, $owner_lastname, $owner_email, $total_rate, $total_userrate, $idslider, $slider, $idHours, $opening, $closing, $day);
		
		$shops = array(); 
		
		while($stmt->fetch()){
			$shop  = array();
			$shop['idshop'] = $idshop; 
			$shop['shopname'] = $shopname;
			$shop['address'] = $address; 
			$shop['phonenumber'] = $phonenumber; 
			$shop['telephonenumber'] = $telephonenumber; 
			$shop['description'] = $description; 
			$shop['latitude'] = $latitude; 
			$shop['longitude'] = $longitude; 
			$shop['website'] = $website; 
			$shop['facebook'] = $facebook;
			$shop['shoptype'] = $shoptype;
			$shop['shopicon'] = $shopicon;
			$shop['idshopowner'] = $idshopowner;
			$shop['owner_firstname'] = $owner_firstname;
			$shop['owner_lastname'] = $owner_lastname;
			$shop['owner_email'] = $owner_email;
			$shop['total_rate'] = $total_rate;
			$shop['total_userrate'] = $total_userrate;
			$shop['idslider'] = $idslider;
			$shop['slider'] = $slider;
			$shop['idHours'] = $idHours;
			$shop['opening'] = $opening;
			$shop['closing'] = $closing;
			$shop['day'] = $day;
			
			array_push($shops, $shop); 
		}
		
		return $shops; 
	}

	function getAllShop(){
		$stmt = $this->con->prepare("SELECT idshop, shopname, shop.address, shop.phonenumber, telephonenumber, description, latitude, longitude, website, facebook, shoptype, shopicon, shopowner.idshopowner as idshopowner, shopowner.firstname as owner_firstname, shopowner.lastname as  owner_lastname, shopowner.email as owner_email, AVG(shopreview.rate) AS total_rate, COUNT(DISTINCT shopreview.idshopreview) AS total_userrate, GROUP_CONCAT(DISTINCT shopimage.idshopimage) as idslider, GROUP_CONCAT(DISTINCT shopimage.image) as slider, GROUP_CONCAT(DISTINCT operatinghours.idoperatinghours) As idHours, GROUP_CONCAT( operatinghours.opening) As opening, GROUP_CONCAT(operatinghours.closing) As closing, GROUP_CONCAT(DISTINCT operatinghours.day ORDER BY 
		     CASE
		          WHEN operatinghours.day = 'Sunday' THEN 1
		          WHEN operatinghours.day = 'Monday' THEN 2
		          WHEN operatinghours.day = 'Tuesday' THEN 3
		          WHEN operatinghours.day = 'Wednesday' THEN 4
		          WHEN operatinghours.day = 'Thursday' THEN 5
		          WHEN operatinghours.day = 'Friday' THEN 6
		          WHEN operatinghours.day = 'Saturday' THEN 7
		     END ASC) As day FROM shop LEFT JOIN shopowner ON shop.shopowner_idshopowner = shopowner.idshopowner LEFT JOIN shopreview ON shop.idshop = shopreview.shop_idshop LEFT JOIN shopimage ON shop.idshop = shopimage.shop_idshop LEFT JOIN operatinghours ON shop.idshop = operatinghours.shop_idshop WHERE shop.activation = 'Active' GROUP BY shop.idshop");
		$stmt->execute();
		$stmt->bind_result($idshop, $shopname, $address, $phonenumber, $telephonenumber, $description, $latitude, $longitude, $website, $facebook, $shoptype, $shopicon, $idshopowner, $owner_firstname, $owner_lastname, $owner_email, $total_rate, $total_userrate, $idslider, $slider, $idHours, $opening, $closing, $day);
		
		$shops = array(); 
		
		while($stmt->fetch()){
			$shop  = array();
			$shop['idshop'] = $idshop; 
			$shop['shopname'] = $shopname;
			$shop['address'] = $address; 
			$shop['phonenumber'] = $phonenumber; 
			$shop['telephonenumber'] = $telephonenumber; 
			$shop['description'] = $description; 
			$shop['latitude'] = $latitude; 
			$shop['longitude'] = $longitude; 
			$shop['website'] = $website; 
			$shop['facebook'] = $facebook;
			$shop['shoptype'] = $shoptype;
			$shop['shopicon'] = $shopicon;
			$shop['idshopowner'] = $idshopowner;
			$shop['owner_firstname'] = $owner_firstname;
			$shop['owner_lastname'] = $owner_lastname;
			$shop['owner_email'] = $owner_email;
			$shop['total_rate'] = $total_rate;
			$shop['total_userrate'] = $total_userrate;
			$shop['idslider'] = $idslider;
			$shop['slider'] = $slider;
			$shop['idHours'] = $idHours;
			$shop['opening'] = $opening;
			$shop['closing'] = $closing;
			$shop['day'] = $day;

			array_push($shops, $shop); 
		}
		
		return $shops; 
	}


	function getNearestByShop($user_lat, $user_lng, $shoptype){
		$stmt = $this->con->prepare("SELECT idshop, shopname, shop.address, shop.phonenumber, telephonenumber, description, latitude, longitude, website, facebook, shoptype, shopicon, shopowner.idshopowner as idshopowner, shopowner.firstname as owner_firstname, shopowner.lastname as  owner_lastname, shopowner.email as owner_email, AVG(shopreview.rate) AS total_rate, COUNT(DISTINCT shopreview.idshopreview) AS total_userrate,  ( 6371  * acos ( cos ( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin ( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance, GROUP_CONCAT(DISTINCT operatinghours.idoperatinghours) As idHours, GROUP_CONCAT( operatinghours.opening) As opening, GROUP_CONCAT(operatinghours.closing) As closing, GROUP_CONCAT(DISTINCT operatinghours.day ORDER BY 
		     CASE
		          WHEN operatinghours.day = 'Sunday' THEN 1
		          WHEN operatinghours.day = 'Monday' THEN 2
		          WHEN operatinghours.day = 'Tuesday' THEN 3
		          WHEN operatinghours.day = 'Wednesday' THEN 4
		          WHEN operatinghours.day = 'Thursday' THEN 5
		          WHEN operatinghours.day = 'Friday' THEN 6
		          WHEN operatinghours.day = 'Saturday' THEN 7
		     END ASC) As day, GROUP_CONCAT(DISTINCT shopimage.idshopimage) as idslider, GROUP_CONCAT(DISTINCT shopimage.image) as slider FROM shop LEFT JOIN shopowner ON shop.shopowner_idshopowner = shopowner.idshopowner LEFT JOIN shopreview ON shop.idshop = shopreview.shop_idshop LEFT JOIN shopimage ON shop.idshop = shopimage.shop_idshop LEFT JOIN operatinghours ON shop.idshop = operatinghours.shop_idshop WHERE shoptype LIKE ? AND shop.activation = 'Active' GROUP BY shop.idshop HAVING distance < 2 ORDER BY distance");
		$stmt->bind_param("ssss", $user_lat, $user_lng,$user_lat, $shoptype);
		$stmt->execute();
		$stmt->bind_result($idshop, $shopname, $address, $phonenumber, $telephonenumber, $description, $latitude, $longitude, $website, $facebook, $shoptype, $shopicon, $idshopowner, $owner_firstname, $owner_lastname, $owner_email, $total_rate, $total_userrate, $distance, $idHours, $opening, $closing, $day, $idslider, $slider);
		
		$nearest = array(); 
		
		while($stmt->fetch()){
			$shop  = array();
			$shop['idshop'] = $idshop; 
			$shop['shopname'] = $shopname;
			$shop['address'] = $address; 
			$shop['phonenumber'] = $phonenumber; 
			$shop['telephonenumber'] = $telephonenumber; 
			$shop['description'] = $description; 
			$shop['latitude'] = $latitude; 
			$shop['longitude'] = $longitude; 
			$shop['website'] = $website; 
			$shop['facebook'] = $facebook;
			$shop['shoptype'] = $shoptype;
			$shop['shopicon'] = $shopicon;
			$shop['idshopowner'] = $idshopowner;
			$shop['owner_firstname'] = $owner_firstname;
			$shop['owner_lastname'] = $owner_lastname;
			$shop['owner_email'] = $owner_email;
			$shop['total_rate'] = $total_rate;
			$shop['total_userrate'] = $total_userrate;
			$shop['distance'] = $distance;
			$shop['idHours'] = $idHours;
			$shop['opening'] = $opening;
			$shop['closing'] = $closing;
			$shop['day'] = $day;
			$shop['idslider'] = $idslider;
			$shop['slider'] = $slider;
			
			array_push($nearest, $shop); 
		}
		
		return $nearest; 
	}

	function getProduct($shopid){
		$stmt = $this->con->prepare("SELECT idshopproduct, productname, description, price, image FROM shopproduct WHERE shop_idshop = ?");
		$stmt->bind_param("i", $shopid);
		$stmt->execute();
		$stmt->bind_result($idshopproduct, $productname, $description, $price, $image);
		
		$products = array(); 
		
		while($stmt->fetch()){
			$product  = array();
			$product['idshopproduct'] = $idshopproduct; 
			$product['productname'] = $productname; 
			$product['description'] = $description; 
			$product['price'] = $price; 
			$product['image'] = $image; 
			
			array_push($products, $product); 
		}
		
		return $products; 
	}
	
	

	function getService($shopid){
		$stmt = $this->con->prepare("SELECT idshopservice, servicename, price FROM shopservice WHERE shop_idshop = ?");
		$stmt->bind_param("i", $shopid);
		$stmt->execute();
		$stmt->bind_result($idshopservice, $servicename, $price);
		
		$services = array(); 
		
		while($stmt->fetch()){
			$service  = array();
			$service['idshopservice'] = $idshopservice; 
			$service['servicename'] = $servicename; 
			$service['price'] = $price; 
			
			array_push($services, $service); 
		}
		
		return $services; 
	}
	
	function getShopReview($shopid){
		$stmt = $this->con->prepare("SELECT comment AS review, datetime AS reviewdate,rate AS rate,reviewername,revieweremail,idshopreview AS idreview FROM shopreview WHERE shop_idshop = ?");
		$stmt->bind_param("i", $shopid);
		$stmt->execute();
		$stmt->bind_result($review, $reviewdate, $rate, $reviewername, $revieweremail, $idreview);
		
		$shopreviews = array(); 
		
		while($stmt->fetch()){
			$shopreview  = array();
			$shopreview['review'] = $review;
			$shopreview['reviewdate'] = $reviewdate;
			$shopreview['rate'] = $rate;
			$shopreview['reviewername'] = $reviewername;
			$shopreview['revieweremail'] = $revieweremail;
			$shopreview['idreview'] = $idreview;
			
			array_push($shopreviews, $shopreview); 
		}
		
		return $shopreviews; 
	}
	
	
	function getShopTotalUserandRate($shopid){
		$stmt = $this->con->prepare("SELECT  AVG(shopreview.rate) AS total_rate, COUNT(DISTINCT idshopreview) AS total_userrate from shopreview where shop_idshop = ?");
		$stmt->bind_param("i", $shopid);
		$stmt->execute();
		$stmt->bind_result($total_rate, $total_userrate);
		
		$shoptotals = array(); 
		
		while($stmt->fetch()){
			$shoptotal  = array();
			$shoptotal['total_rate'] = $total_rate;
			$shoptotal['total_userrate'] = $total_userrate;
			
			array_push($shoptotals, $shoptotal); 
		}
		
		return $shoptotals; 
	}
	
}