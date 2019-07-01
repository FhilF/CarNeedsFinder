<?php 

	//getting the Queries class
	require_once 'Queries.php';

	//function validating all the paramters are available
	//we will pass the required parameters to this function 
	function isTheseParametersAvailable($params){
		//assuming all parameters are available 
		$available = true; 
		$missingparams = ""; 
		
		foreach($params as $param){
			if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
				$available = false; 
				$missingparams = $missingparams . ", " . $param; 
			}
		}
		
		//if parameters are missing 
		if(!$available){
			$response = array(); 
			$response['error'] = true; 
			$response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
			
			//displaying error
			echo json_encode($response);
			
			//stopping further execution
			die();
		}
	}
	
	//an array to display response
	$response = array();
	
	//if it is an api call 
	//that means a get parameter named api call is set in the URL 
	//and with this parameter we are concluding that it is an api call
	if(isset($_GET['dbqueries'])){
		
		switch($_GET['dbqueries']){
			
			//the CREATE operation
			//if the api call value is 'createhero'
			//we will create a record in the database
			case 'login':
				//first check the parameters required for this request are available or not 
				isTheseParametersAvailable(array('email','password'));
				
				//creating a new Queries object
				$db = new Queries();
				
				//creating a new record in the database
				$result = $db->login(
					$_POST['email'],
					$_POST['password']
				);
				

				//if the record is created adding success to response
				if($result){
					//record is created means there is no error
					$response['error'] = false; 

					//in message we have a success message
					$response['message'] = 'You logged in successfully';

					//and we are getting all the heroes from the database in the response
					$response['users'] = $db->login($_POST['email'],
					$_POST['password']);
				}else{

					//if record is not added that means there is an error 
					$response['error'] = true; 

					//and we have the error message
					$response['message'] = 'Email or Password is invalid';
				}
				
			break; 

			case 'getnearestbyshop':
				//first check the parameters required for this request are available or not 
				isTheseParametersAvailable(array('latitude','longitude','shoptype'));
				
				//creating a new Queries object
				$db = new Queries();
				
				//creating a new record in the database
				$result = $db->getnearestbyshop(
					$_POST['latitude'],
					$_POST['longitude'],
					$_POST['shoptype']
				);
				

				//if the record is created adding success to response
				if($result){
					//record is created means there is no error
					$response['error'] = false; 

					//in message we have a success message
					$response['message'] = 'You get the nearest shops successfully';

					//and we are getting all the heroes from the database in the response
					$response['nearest'] = $db->getnearestbyshop($_POST['latitude'],$_POST['longitude'],$_POST['shoptype']);
					
				}else{

					//if record is not added that means there is an error 
					$response['error'] = true; 

					//and we have the error message
					$response['message'] = 'Some error occurred please try again';
				}
				
			break; 

			case 'addreview':
				//first check the parameters required for this request are available or not 
				isTheseParametersAvailable(array('comment','rate'));
				
				//creating a new Queries object
				$db = new Queries();
				
				//creating a new record in the database
				$result = $db->addreview(
					$_POST['comment'],
					$_POST['rate'],
					$_POST['shop_idshop'],
					$_POST['reviewername'],
					$_POST['revieweremail']
				);
				

				//if the record is created adding success to response
				if($result){
					//record is created means there is no error
					$response['error'] = false; 

					//in message we have a success message
					$response['message'] = 'Thank you for the review!';

				}else{

					//if record is not added that means there is an error 
					$response['error'] = true; 

					//and we have the error message
					$response['message'] = 'Some error occurred please try again';
				}
				
			break;

			case 'addshopreport':
				//first check the parameters required for this request are available or not 
				isTheseParametersAvailable(array('report'));
				
				//creating a new Queries object
				$db = new Queries();
				
				//creating a new record in the database
				$result = $db->addShopReport(
					$_POST['report'],
					$_POST['reportername'],
					$_POST['reporteremail'],
					$_POST['shop_idshop']
				);
				

				//if the record is created adding success to response
				if($result){
					//record is created means there is no error
					$response['error'] = false; 

					//in message we have a success message
					$response['message'] = 'Shop reported, Thank you!';

				}else{

					//if record is not added that means there is an error 
					$response['error'] = true; 

					//and we have the error message
					$response['message'] = 'Some error occurred please try again';
				}
				
			break;	

			case 'register':
				//first check the parameters required for this request are available or not 
				isTheseParametersAvailable(array('firstname','lastname','email','password'));
				
				//creating a new Queries object
				$db = new Queries();
				
				//creating a new record in the database
				$result = $db->register(
					$_POST['firstname'],
					$_POST['lastname'],
					$_POST['email'],
					$_POST['password'],
					$_POST['birthday'],
					$_POST['address'],
					$_POST['phonenumber']
				);
				

				//if the record is created adding success to response
				if($result){
					//record is created means there is no error
					$response['error'] = false; 

					//in message we have a success message
					$response['message'] = 'Successfully registered!';

				}else{

					//if record is not added that means there is an error 
					$response['error'] = true; 

					//and we have the error message
					$response['message'] = 'Registered Failed. Please check the data.';
				}
				
			break; 


			
			//the READ operation
			//if the call is getheroes

			case 'getshop':

				//first check the parameters required for this request are available or not 
			
				if(isset($_POST['shoptype'])){
				//creating a new Queries object
				$db = new Queries();
				if($db->getShop($_POST['shoptype'])){
						$response['error'] = false; 
						$response['message'] = 'Requested data successfully';
						$response['shops'] = $db->getShop($_POST['shoptype']);
					}else{
						$response['error'] = true; 
						$response['message'] = 'No shops registered';
					}
			}
				
			break; 

			case 'getallshop':
				$db = new Queries();
				$response['error'] = false; 
				$response['message'] = 'Request successfully completed';
				$response['shops'] = $db->getAllShop();
			break; 
			
			

			case 'getproduct':
				//first check the parameters required for this request are available or not 
				
				if(isset($_POST['shopid'])){
				//creating a new Queries object
				$db = new Queries();
				if($db->getProduct($_POST['shopid'])){
						$response['error'] = false; 
						$response['message'] = 'Requested data successfully';
						$response['products'] = $db->getProduct($_POST['shopid']);
					}else{
						$response['error'] = true; 
						$response['message'] = 'No products from this shop';
					}
			}
				
			break; 

			case 'getservice':
				//first check the parameters required for this request are available or not 
			
				if(isset($_POST['shopid'])){
				//creating a new Queries object
				$db = new Queries();
				if($db->getService($_POST['shopid'])){
						$response['error'] = false; 
						$response['message'] = 'Requested data successfully';
						$response['services'] = $db->getService($_POST['shopid']);
					}else{
						$response['error'] = true; 
						$response['message'] = 'No services from this shop';
					}
			}
				
			break; 
			
			
			case 'getshopreview':
				//first check the parameters required for this request are available or not 
				
				if(isset($_POST['shopid'])){
				//creating a new Queries object
				$db = new Queries();
				if($db->getShopReview($_POST['shopid'])){
						$response['error'] = false; 
						$response['message'] = 'Requested data successfully';
						$response['shopreviews'] = $db->getShopReview($_POST['shopid']);
					}else{
						$response['error'] = true; 
						$response['message'] = 'No reviews from this shop';
					}
			}
				
			break;
			
			case 'getshoptotaluserandrate':
				//first check the parameters required for this request are available or not 
				
				if(isset($_POST['shopid'])){
				//creating a new Queries object
				$db = new Queries();
				if($db->getShopTotalUserandRate($_POST['shopid'])){
						$response['error'] = false; 
						$response['message'] = 'Requested data successfully';
						$response['shoptotals'] = $db->getShopTotalUserandRate($_POST['shopid']);
					}else{
						$response['error'] = true; 
						$response['message'] = 'No reviews from this shop';
					}
			}
				
			break;
			
			

		}
		
	}else{
		//if it is not api call 
		//pushing appropriate values to response array 
		$response['error'] = true; 
		$response['message'] = 'Invalid DB Query';
	}
	
	//displaying the response in json structure 
	echo json_encode($response);