<!DOCTYPE html>
<html>
  <head>
    <title>CN Finder</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="113230825694-lcat8m1v6ubgkb142nj3qegft7h49h4s.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
  <script src="bootstrap/js/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/js/sweetalert2.js"></script>
  <script src="bootstrap/js/sweetalert2.all.js"></script>
  <link rel="stylesheet" href="bootstrap/css/sweetalert2.css" />
  <link rel="stylesheet" href="bootstrap/css/sweetalert2.min.css" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bootstrap/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bootstrap/css/AdminLTE.min.css">
  <link rel="stylesheet" href="bootstrap/css/skins/skin-bluefb.min.css">
  <link rel="stylesheet" href="bootstrap/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/customtable.css">
  <link rel="stylesheet" href="bootstrap/css/sidebar.css">
  

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic|Roboto+Condensed:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
    <!-- Template Styles -->
    <link href="bootstrap/css/style.css" rel="stylesheet" media="screen">
      </head>
<style>


.modal {overflow: visible}

.swal2-popup {
  font-size: 1.6rem !important;

}

.swal2-container {
  z-index: 10000;
}

.popover-content {
	color:#000;	
}
</style>

	  <!-- NAVBAR
	      ================================================== -->
	  <nav class="navbar navbar-default" role="navigation" style="z-index:10000">
	  	  <div class="container">
			  <div class="navbar-header">
			    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>

			    <!--Replace text with your app name or logo image-->
			    <a class="navbar-brand" href="#">Car Needs Finder</a>

			  </div>
			  <div class="collapse navbar-collapse navbar-ex1-collapse" id="myNavbar">
			    <ul class="nav navbar-nav">
			      <li><a href="developers.html">Developers</a></li>
			      <li><a onclick="$('header').animatescroll({padding:71});">About CNF</a></li>
			      <li><a onclick="$('.features').animatescroll({padding:71});">Features</a></li>
			      <li><a onclick="$('.download').animatescroll({padding:71});">Download the App</a></li>
                  <li><a onclick="$('.get-it').animatescroll({padding:71});">Register Shop	</a></li>
			    </ul>
			  </div>
		  </div>
	  </nav>


	   <!-- HEADER
	   ================================================== -->
	  <header>
		 <div class="container">
			 <div class="row">
				 <div class="col-md-12">
					  <h1>Welcome!</h1>
					  <p class="lead">to a smarter approach to car maintenance.</p>

					  <div class="carousel-iphone">
					  	<div id="carousel-example-generic" class="carousel slide">

					    <!-- Indicators -->
					    <ol class="carousel-indicators">
					      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
					      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
						  <li data-target="#carousel-example-generic" data-slide-to="3"></li>
					    </ol>

					    <!-- Wrapper for slides -->
					    <div class="carousel-inner">
					      <div class="item active">
					        <img src="bootstrap/img/screenshots/app-1.png" alt="App Screen 1">
					      </div>
						  <div class="item">
					        <img src="bootstrap/img/screenshots/category.png" alt="App Screen 3">
					      </div>
					      <div class="item">
					        <img src="bootstrap/img/screenshots/nearby.png" alt="App Screen 2">
					      </div>
					      <div class="item">
					        <img src="bootstrap/img/screenshots/map.png" alt="App Screen 3">
					      </div>

					    </div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	 </header>


	  <!-- PURCHASE
	      ================================================== -->
	  <section class="purchase">
		  <div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					
				  </div>
			  </div>
		  </div>
	  </section>


	  <!-- PAYOFF
	      ================================================== -->
	  <section class="payoff">
		<div class="container">
			  <div class="row">
				  <div class="col-md-12">
					  <h1>Car Needs Finder offers a comprehensive guide for car owners to quickly locate nearby shops for car services and upgrades. Provides up-to-date information for your car maintenance needs including repair shop, gas station, car wash and a whole lot more. Car needs finder lets you search the nearest and most convenient car shop you need.</h1>
				  </div>
			  </div>
		  </div>
	  </section>


	  <!-- DETAILS
	      ================================================== -->
	  <section class="detail">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="carousel-example-generic-2" class="carousel slide">

					  <!-- Wrapper for slides -->
					  <div class="carousel-inner">
					    <div class="item active">
					      	<div class="row">
					      		<div class="col-sm-12 col-md-offset-1 col-md-6">
					      			<h1>Having trouble finding a better car shop?</h1>
					      			<p>Car Needs Finder app can help the car owners to locate a nearby shops like gas stations, car wash, tire shops, car maintenance, vulcanizing shops and many others regarding maintaining of the car. </p>
					      		</div>
					      		<div class="col-sm-12 col-md-5">
					      			<div class="app-screenshot">
					      				<img src="bootstrap/img/screenshots/app-1.png" class="img-responsive" alt="App Screen 1">
					      			</div>
					      		</div>
					      	</div>
					    </div>
					    <div class="item">
					    	<div class="row">
					    		<div class="col-sm-12 col-md-offset-1 col-md-6">
					    			<h1>Rating and feedback</h1>
					    			<p>You can send feedbacks in a specific shop and read testimonials from other users about a local shop, and get a quick glance of their customer service.</p>
					    		</div>
					    		<div class="col-sm-12 col-md-5">
					    			<div class="app-screenshot">
					    				<img src="bootstrap/img/screenshots/commentrating.png" class="img-responsive" alt="App Screen 2">
					    			</div>
					    		</div>
					    	</div>
						</div>
					    <div class="item">
					      <div class="row">
					      	<div class="col-sm-12 col-md-offset-1 col-md-6">
					      		<h1>Powered by Google map</h1>
					      		<p>Thanks to the advanced mapping architecture developed by Google, you can be confident to get accurate directions!</p>
					      	</div>
					      	<div class="col-sm-12 col-md-5">
					      		<div class="app-screenshot">
					      			<img src="bootstrap/img/screenshots/google.png" class="img-responsive" alt="App Screen 3">
					      		</div>
					      	</div>
					      </div>
					    </div>
					  </div>
					  
					  
					

					  <!-- Indicators -->
					  <ol class="carousel-indicators">
					    <li data-target="#carousel-example-generic-2" data-slide-to="0" class="active"></li>
					    <li data-target="#carousel-example-generic-2" data-slide-to="1"></li>
					    <li data-target="#carousel-example-generic-2" data-slide-to="2"></li>
					  </ol>
					</div>
				</div>
			</div>
		</div>
	</section>


	  <!-- FEATURES
	      ================================================== -->
	  <section class="features">
		  <div class="container">
			  <div class="row">

				  <div class="col-md-4">
					  <div class="circle"><i class="icon-map"></i></div>
					  <h2>Easy to search</h2>
					  <p> Filter your needs based on categories, and view reviews and rates for local businesses.</p>
				  </div>
				  <div class="col-md-4">
					  <div class="circle"><i class="icon-search"></i></div>
					  <h2>Quickly find nearby shops</h2>
					  <p>Saves you time and money looking around for nearby shops.</p>
				  </div>

				  <div class="col-md-4">
					  <div class="circle"><i class="icon-user"></i></div>
					  <h2>User friendly</h2>
					  <p>Navigate the app with ease thanks to its intuitive design.</p>
				  </div>

			  </div>
		  </div>
	  </section>
      
      <section class="download">
		  <div class="container" >
			  <div class="row" style="padding-top:40px; padding-bottom:40px;">

				  <div class="col-md-6">
                  <div style="padding-top:30px;">
					  <a href="https://drive.google.com/open?id=1cyqwdvzem5hYUwQPbpm6YaWBimBG5RkR"><span class="	glyphicon glyphicon-download-alt" style="color:#06F; font-size:80px;"></span></a>
				  </div> 
                      <div style="padding-top:30px;"><p> So what are you still waiting for? </p>
                      <h2>Download now!</h2></div>
					  
				  </div>
				  <div class="col-md-6">
                  <div style="padding-bottom:30px; padding-top:30px;">
					  <iframe width="420" height="315"
						src="https://www.youtube.com/embed/abL0dG-5IM0?playlist=abL0dG-5IM0&loop=1" frameborder="0" allowfullscreen>
                        
					  </iframe>
                      </div>
				  </div>

			  </div>
		  </div>
	  </section>


	 <!-- SOCIAL
	     ================================================== -->
	  <section class="social">
	  	<div class="container">
	  		  <div class="row">
	  			  <div class="col-md-12">
	  			  	<h2>Connect with us</h2>
	  			   	<a href="https://www.facebook.com/Car-Needs-Finder-2239408059630266" class="icon-facebook"></a>
	  			   	<a href="https://twitter.com/car_needs" class="icon-twitter"></a>
	  			   	<a class="icon-google" title="Google Account" data-toggle="popover" data-placement="bottom" data-content="carneedsfinderapp@gmail.com" ></a>
	  			   	<a href="https://www.instagram.com/carneedsfinder/" class="icon-instagram"></a>
	  			   </div>
	  		  </div>
	  	  </div>
	  </section>


	 <!-- GET IT
	     ================================================== -->
	  <section class="get-it">
	  	<div class="container">
	  		<div class="row">
	  			<div class="col-md-12">
	  				<h1>Promoting your business has never been easier. Best of all, it's free to add your shop to the listing!</h1>
	  				<p class="lead">Just sign in your google account, and start being a part of our website visited by car owners looking for shops like yours! It's that simple.</p>
	  				<a href="#" onclick="loginGoogle();"><u> <h1> Get started today, Login Now! </h1></u> </a>
	  			</div>
	  			<div class="col-md-12">
	  				<hr />
		  			<ul>

                	</ul>
	  			</div>
	  		</div>
	  	</div>
	  </section>


	 <!-- JAVASCRIPT
	     ================================================== -->
    
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/animatescroll.js"></script>
    <script src="bootstrap/js/scripts.js"></script>
    <script src="bootstrap/js/retina.min.js"></script>

</html>
<script>

$(document).ready(function () {
    $(document).click(function (event) {
        var clickover = $(event.target);
        var _opened = $(".navbar-collapse").hasClass("navbar-collapse in");
        if (_opened === true && !clickover.hasClass("navbar-toggle")) {
            $("button.navbar-toggle").click();
        }
    });
});
	
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
  
	function register(){
		var phone = $('#phonenumber').val();
		var address = $('#address').val();
		if ( phone == "" || address == ""){
			swal({title: "Sorry!", text: "Please fill up the form", type: "error"});
		}else if(phone.length != 10){
			swal({title: "Sorry!", text: "Please input a valid phone number", type: "error"});
		}else{
		var fd = new FormData(document.getElementById("register"));
            $.ajax({
              url: "php/addShopOwner.php",
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
				if (data == "success"){
				setTimeout(function() {
				swal({title: "Good Job!", text: "Succesfully Registered", type: "success"})
				.then(function() {
					window.location.href = "ShopOwner/Home.php";
				}); }, 1000);
				}else{
					swal({
					title: "Sorry!",
  					text: "There was a problem submitting your form",
  					type: "error",
					showCloseButton: true
					})	
				}
            });
            return false;
		}
		return false;
		
		
	}
	
function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
	  $('#myModal').modal('toggle');
	  location.reload();
    });
  }

$( document ).ready(function() {
	
    $( "#phonenumber" ).keyup(function() {
		var phone = $('#phonenumber').val();
		if(phone.length == 10) {
         $('#phonenumber').css("border-color", "#0F0");
    	} else {
         $('#phonenumber').css("border-color", "#F00");
    	}
	});

});

function loginGoogle(){
	swal({
  		title: '',
 		html:
    		'<center><div id="my-signin2"></div></center>',
		imageUrl: 'https://media.giphy.com/media/TK4yMeRswlKWA/giphy.gif',
  		imageWidth: 400,
  		imageHeight: 200,
  		imageAlt: 'Custom image',
  		showCloseButton: true,
		showConfirmButton: false,
		footer: '<a href></a>',
	})	
	renderButton();
}

function info(){
swal({title: "Good Job!", text: "Succesfully Registered", type: "success"})	
}

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});

    function onSuccess(googleUser) {
      console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
	  var firstname = googleUser.getBasicProfile().getGivenName();
			var lastname = googleUser.getBasicProfile().getFamilyName();
			var email = googleUser.getBasicProfile().getEmail();
			var image = googleUser.getBasicProfile().getImageUrl()
			$('#firstname').val(firstname);
			$('#email').val(email);
			$('#lastname').val(lastname);
			$('#image').val(image);

    $.ajax({
       type: "POST",
       url: 'php/fetchLoginShopOwner.php',
       data: "email="+email+"&image="+ image,
       success: function(data)
	   
       {
          if (data == 2) {
			var auth2 = gapi.auth2.getAuthInstance();
    		auth2.signOut().then(function () {
    		});
			swal({title: "Sorry!", text: "Your account is inactive", type: "error"}).then(
       		function () { /*Your Code Here*/ 
			location.reload();
			},function () { return false; });
			
          }
          else if (data == 1){
			window.location.href = "ShopOwner/Home.php";
            
          }else if (data == 0){
			  swal.close();
			  setTimeout(function() {
					$('#myModal').modal('show');
					}, 500);
					$('#myModal').modal({backdrop: 'static', keyboard: false})  
			 
		  }else{
			 swal({title: "Sorry!", text: "There was a problem in logging in", type: "error"});
		  }
		  
		  
		  
       }
 });
    }
    function onFailure(error) {
      console.log(error);
    }
    function renderButton() {
      gapi.signin2.render('my-signin2', {
        'scope': 'profile email',
        'width': 220,
        'height': 40,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
      });
    }
  </script>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="border:1px solid;">
        <div class="modal-header bg-green-gradient" style="padding:30px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div><h3 class="modal-title"><center></center></</h3></div>
        </div>
        <div class="modal-body" style="margin-top:10px; height:200px;">
        <form method="post" id="register"> 
        
            <input type="hidden" name="email" id="email"/>
            <input type="hidden" name="firstname" id="firstname"/>
            <input type="hidden" name="lastname" id="lastname"/>
            <input type="hidden" name="image" id="image"/>
          <h4>Before you continue please fill up the details provided</h4>
          <div class="col-md-6">
          <div class="input-group">
          
    		<span class="input-group-addon" title="number">+63</span>
    		<input type="number" class="form-control" onKeyPress="if(this.value.length==10) return false;" id="phonenumber" name="phonenumber" />
    	  </div>
          </div>
		  <div class="col-md-12">
		  <div class="form-group">
  			<label class="pull-left" for="address">Home Address</label>
 			<textarea class="form-control" rows="3" id="address" name="address"></textarea>
		</div>
		  </div>
          
        </div>
        <div class="modal-footer" style="margin-top:40px;">
          <button type="button" class="btn btn-default" onClick="signOut()">Close</button>
          <button type="button" class="btn btn-success" onClick="register()">Submit</button>
        </div>
        
        </form>
      </div>
      
    </div>
  </div>