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
  <link rel="stylesheet" href="../bootstrap/css/skins/skin-bluefb.min.css">
  <link rel="stylesheet" href="../bootstrap/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/DataTables/datatables.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/DataTables/Responsive-2.2.2/css/responsive.bootstrap.css">
  <link rel="stylesheet" href="../bootstrap/css/customtable.css">
  <link rel="stylesheet" href="../bootstrap/css/sidebar.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #28414d;
    margin: 1em 0;
    padding: 0; 
}
.trans {
	-webkit-transition: all 3s;
    -moz-transition: all 3s;
    -ms-transition: all 3s;
    -o-transition: all 3s;
    transition: all 3s;
	
}

</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include 'navigationBar.php';?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Home<br>
		<small>Hello!&nbsp;<?php echo $name ?></small>
        
      </h1>
    </section>
    <section class="content container-fluid">
<hr>
    <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="listShopOwner.php"><span class="info-box-icon bg-green-gradient"><i class="fa fa-address-card"></i></span></a>

            <div class="info-box-content">
              <span class="info-box-text">Shop Owners</span>
              <span class="info-box-number" id="ownerinfo"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="#" onClick="openShop()"><span class="info-box-icon bg-red-gradient"><i class="fa fa-shopping-cart"></i></span></a>

            <div class="info-box-content">
              <span class="info-box-text">Active Shops</span>
              <span class="info-box-number" id="shopinfo"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        
      </div>
      <!-- /.row -->
      
      
<hr>
<header style="background-color:#28414d;"><center><h1 style="color:#FFF; padding:10px;">Registered Shop Locations</h1></center></header>
<div class="mapcontainer">
<div id="map" style="width:100%;height:500px; border: solid 1px;"></div>
</div>
    
        
    </section>
  </div>
  <?php include 'footer.php';?>
</div>

<script src="../bootstrap/js/adminlte.min.js"></script>

<script>
countActiveShops();
countUsers();
countOwners();
function openShop(){
$(document).ready(function(){
$('#shopList').addClass('menu-open active');
});
}

function countActiveShops(){
	$.ajax({
		type: "POST",
		url: "../php/countActiveShop.php",
		success: function(data){
		$('#shopinfo').html(data);
		
		}
	});
}

function countUsers(){
	$.ajax({
		type: "POST",
		url: "../php/countUsers.php",
		success: function(data){
		$('#userinfo').html(data);
		
		}
	});
}

function countOwners(){
	$.ajax({
		type: "POST",
		url: "../php/countShopOwners.php",
		success: function(data){
		$('#ownerinfo').html(data);
		
		}
	});
}


	
var map;
var marker;
var locations = [];


fetchData();
function fetchData(){
	var x = -1;
	var output = '';
	$.ajax({
		type: "POST",
		url: "../php/fetchAllActiveShop.php",
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


