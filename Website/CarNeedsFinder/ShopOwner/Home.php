<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Panel</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <script src="../bootstrap/js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" charset="utf8" src="../bootstrap/DataTables/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf8" src="../bootstrap/DataTables/Responsive-2.2.2/js/dataTables.responsive.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../bootstrap/js/sweetalert.min.js"></script>
  <link rel="stylesheet" href="../bootstrap/css/sweetalert.min.css" />
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../bootstrap/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../bootstrap/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../bootstrap/css/skins/skin-dark-blue.min.css">
  <link rel="stylesheet" href="../bootstrap/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/DataTables/datatables.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/DataTables/Responsive-2.2.2/css/responsive.bootstrap.css">
  <link rel="stylesheet" href="../bootstrap/css/customtable2.css">

  
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
.content-wrapper{
	background: white;
    background: #fff url(../images/footer-bg.png)  0px 100% repeat-x;

}
.carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
	  width:100%;
      margin: auto;
  }
.carousel-control span.glyphicon {
    color:#2E3A65;
}
.myimg
{
    max-width: 100%;
    min-width: 330px;
    max-height: auto;
	min-height:350px;
	
}

.ads
{
    max-width: 100%;
    min-width: 330px;
    max-height: auto;
	min-height:60px;
}

</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	
    <?php include 'navigationBar.php' ?>

  <div class="content-wrapper">
      <section class="content-header">
    </section>

    <section class="content container-fluid">
    

  <div id="myCarousel" class="carousel slide" data-ride="carousel" >
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img class="img-responsive myimg" src="../images/ownerimage1.jpg"alt="Los Angeles" style="width:100%;">
        <div class="carousel-caption">
        </div>
      </div>

      <div class="item">
        <img class="img-responsive myimg" src="../images/ownerimage2.jpg" alt="New York" style="width:100%;">
        <div class="carousel-caption">
          <h4>Register your shop. Lead and guide potential customers to your shop.</h4>
        </div>
      </div>
    
      <div class="item">
        <img class="img-responsive myimg" src="../images/ownerimage.jpg" alt="New York" style="width:100%;">
        <div class="carousel-caption">
          <h4>Advertise your product and services your shop offers. Expose your services and on how will these help your potential customers.</h4>
        </div>
      </div>
      
      <div class="item">
        <img class="img-responsive myimg" src="../images/start.png" alt="New York" style="width:100%;">
        <div class="carousel-caption">
          <h1>Want to start now?</h1>
          <p style="text-decoration: underline;"><a href="registerShop.php"><button class="btn btn-primary btn-lg">Register your shop!</button></a></p>
        </div>
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
 

<br>
<header style="background-color:#28414d;"><center><h1 style="color:#FFF; padding:10px;">Shops Registered in Car Needs Finder</h1></center></header>
<div class="mapcontainer">
<div id="map" style="width:100%;height:500px; border: solid 1px;"></div>
</div>

        
    </section>
    
  </div>
  
<?php include 'footer.php' ?>

</div>

<script src="../bootstrap/js/adminlte.min.js"></script>

<script>
var map;
var marker;
var locations = [];


fetchData();
function fetchData(){
	var x = -1;
	var output = '';
	$.ajax({
		type: "POST",
		url: "../php/fetchShopDisplay.php",
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
				x++
					output = ([shop[i].shopname, shop[i].latitude, shop[i].longitude, x, shop[i].shopaddress, shop[i].idshop]);
					locations.push(output);
						}
		}

	
	});
	
	}

		function initMap() {
			// create object literal to store map properties
			var myOptions = {
				zoom: 8 // set zoom level
				
			};
			
			// create map object and apply properties
			var map = new google.maps.Map( document.getElementById( "map" ), myOptions );
			
			// create map bounds object
			var bounds = new google.maps.LatLngBounds();
			// create array containing locations

			// loop through locations and add to map
			for ( var i = 0; i < locations.length; i++ )
			{
				// get current location
				var location = locations[ i ];
				
				// create map position
				var position = new google.maps.LatLng( location[ 1 ], location[ 2 ] );
				
				// add position to bounds
				bounds.extend( position );
				
				// create marker (https://developers.google.com/maps/documentation/javascript/reference#MarkerOptions)
				var marker = new google.maps.Marker({
					animation: google.maps.Animation.DROP
					, map: map
					, position: position
					, title: location[ 0 ]
				});
				
				// create info window and add to marker (https://developers.google.com/maps/documentation/javascript/reference#InfoWindowOptions)
				google.maps.event.addListener( marker, 'click', ( 
					function( marker, i ) {
						return function() {
							var infowindow = new google.maps.InfoWindow();
							infowindow.setContent('<strong>'+ locations[ i ][ 0 ] + '</strong><br>'+
							'<small>'+ locations[ i ][ 4 ] + '</small>'
							);
							infowindow.open( map, marker );
						}
					}
				)( marker, i ) );
			};
			// fit map to bounds
			map.fitBounds( bounds );
		}
		// load map after page has finished loading
		function loadScript() {
			var script = document.createElement( "script" );
			script.type = "text/javascript";
			script.src = "https://maps.googleapis.com/maps/api/js?key=PASTEKEYHERE&callback=initMap"; // initialize method called using callback parameter
			document.body.appendChild( script );
		}
		window.onload = loadScript;		
		
</script>
</body>
</html>
