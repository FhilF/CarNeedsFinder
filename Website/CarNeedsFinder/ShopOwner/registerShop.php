<?php
session_start();
if ($_SESSION['shopOwner'] != '1'){
	header('Location: ../loginShopOwner.php');
}else{
$id = $_SESSION['idShopOwner'];
$name = $_SESSION['nameShopOwner'];
$myimage = $_SESSION['imageShopOwner'];	
if (file_exists('../uploads/profiles/'.$myimage)) {
	$image = $myimage;
	}else{
	$image = "noimage.png";
	}
}

$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = basename($_SERVER['PHP_SELF'], ".php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Untitled Document</title>
<script src="../bootstrap/js/jquery-3.2.1.min.js"></script>
<script src="../bootstrap/js/jquery.easing.min.js"></script>
<script src="../bootstrap/js/jquery-multi-step-form.js" type="text/javascript"></script>
<script src="../bootstrap/js/sweetalert2.js"></script>
<script src="../bootstrap/js/sweetalert2.all.js"></script>
<link rel="stylesheet" href="../bootstrap/css/sweetalert2.css" />
<link rel="stylesheet" href="../bootstrap/css/sweetalert2.min.css" />
<link rel="stylesheet" href="../bootstrap/css/customcheckbox.css" />
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link href="../bootstrap/css/jquery-multi-step-form.css" media="screen" rel="stylesheet" type="text/css"/>
</head>
<style>
    * {margin: 0; padding: 0;}

    html {
	    height: 100%;
	    background: url('../images/bg.png');
	    background: 
		    linear-gradient(rgba(196, 102, 0, 0.2), rgba(155, 89, 182, 0.2)), 
		    url('../images/bg.png');
    }

    body {
	    font-family: arial, verdana;
    }
	
	.addcolor {
    color:#2EA42B;
	
}

.swal2-container {
  z-index: 10000;
}
.swal2-popup {
  font-size: 1.6rem !important;
  
}

.text-justify-xs {
    text-align: justify;
}

/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {
    .text-justify-sm {
        text-align: justify;
    }
}

/* Medium devices (desktops, 992px and up) */
@media (min-width: 992px) {
    .text-justify-md {
        text-align: justify;
    }
}

/* Large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {
    .text-justify-lg {
        text-align: justify;
    }
}


.bg-myblue-color{background:#246280 !important;background:-webkit-gradient(linear, left bottom, left top, color-stop(0, #1b4254), color-stop(1, #222d32)) !important;background:-ms-linear-gradient(bottom, #1b4254, #222d32) !important;background:-moz-linear-gradient(center bottom, #1b4254 0, #222d32 100%) !important;background:-o-linear-gradient(#222d32, #1b4254) !important;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#222d32', endColorstr='#1b4254', GradientType=0) !important;color:#fff}


.bg-darkblue-gradient{background:#2c7699 !important;background:-webkit-gradient(linear, left bottom, left top, color-stop(0, #2c7699), color-stop(1, #88c2dd)) !important;background:-ms-linear-gradient(bottom, #2c7699, #88c2dd) !important;background:-moz-linear-gradient(center bottom, #2c7699 0, #88c2dd 100%) !important;background:-o-linear-gradient(#88c2dd, #2c7699) !important;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#88c2dd', endColorstr='#2c7699', GradientType=0) !important;color:#fff}

</style>

</head>
<body class="text-justify-lg">
	
<div id="multistepform" style="z-index:9500;">
	<ul id="multistepform-progressbar" style="z-index:9500;">
		<li class="active">Shop Information</li>
        <li>Type & Image</li>
		<li>Location</li>
	</ul>
    <form method="post" id="fileinfo" name="fileinfo" onsubmit="return submitForm();" style="z-index:9500;">
	<div class="form" style="z-index:9500;">
        
		<h2 class="fs-title">Shop Information</h2>
		<input type="hidden" value="<?php echo $id ?>" name="id" id="id" />
		<input type="text" id="shopname" name="shopname" placeholder="*Shop Name" required="required">
        <textarea id="shopdescription" name="shopdescription" placeholder="*Shop Description"></textarea>
        <table class="table">
        <tr><td class="col-lg-6">
        <input type="text" id="website" name="website" placeholder="Website">
		</td><td class="col-lg-6">
        <input type="text" id="fb" name="fb" placeholder="Facebook Page">
        </td></tr>
        <tr><td>
		<input type="number" id="pnumber" name="pnumber" placeholder="Phone Number">
        </td><td>
		<input type="text" id="tnumber" name="tnumber" placeholder="Telephone Number">
        </td></tr>
        </table>

        
		<input type="button" name="next" class="next button" value="Next">
        
	</div>
    	<div class="form">
		<h2 class="fs-title">*Shop Type & Image</h2>
<div class="mycontainer" style=" padding-top:10px; border:solid #CCC">
<center>
<table style="width:100%; table-layout:fixed;" class="table table-bordered table-responsive"><tr>
<th>
<label class="container1">Auto Mechanic
  <input type="checkbox" name="shoptype[]" id="shoptype[]" value="Auto Mechanic">
  <span class="checkmark"></span>
</label>
</th>

<th>
<label class="container1">Car Accessories
  <input type="checkbox" name="shoptype[]" id="shoptype[]" value="Car Accessories">
  <span class="checkmark"></span>
</label>
</th>

<th>
<label class="container1">Gas Station
  <input type="checkbox" name="shoptype[]" id="shoptype[]" value="Gas Station">
  <span class="checkmark"></span>
</label>
</th>
</tr>
<tr>
<td>
<label class="container1">Car Aircon
  <input type="checkbox" name="shoptype[]" id="shoptype[]" value="Car Aircon">
  <span class="checkmark"></span>
</label>
</td>
<td>
<label class="container1">Car Wash
  <input type="checkbox" name="shoptype[]" id="shoptype[]" value="Car Wash">
  <span class="checkmark"></span>
</label>
</td>
<td>
<label class="container1">Tire Supply
  <input type="checkbox" name="shoptype[]" id="shoptype[]" value="Tire Supply">
  <span class="checkmark"></span>
</label>
</td>
</tr>
</table>
</center>
<hr />
<center>
<div style="padding-left:40px; padding-right:40px;">
<input type="file" name="file" id="file" accept="image/x-png,image/jpeg,image/jpg,image/png"  onchange="showMyImage(this)" >
</div>
</center>
</div>
<input type="button" name="previous" class="previous button" value="Previous" />
<input type="button" name="next" class="next button" value="Next">
</div>


	<div class="form">
		<h2 class="fs-title">Shop Location</h2>
        <textarea id="address" name="address" placeholder="*Shop Complete Address"></textarea>
		<input class="hidden" id="lat" name="lat" />
        <input class="hidden" id="lng" name="lng" />
        <div>
        <h5 style="font-weight:bolder; font-family:Arial, Helvetica, sans-serif;" >*Mark Your Shop Location</h5>
		<button type="button" class="btn btn-success btn-lg" onclick="reminder2()">Open Map</button>
        </div>
        <div style="padding-top:50px;">
		<input type="button" name="previous" class="previous button" value="Previous" />
        <input type="button" name="check" class="button" value="Submit" onclick="checkDetails()" />
		<input class="hidden" type="submit" name="submit" id="submit" class="button"/>
        </div>
        
	</div>
   
    </form>
</div>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script>

$(document).ready(function(){
    $.multistepform({
        container:'multistepform',
        form_method:'GET',
    })
});
reminder();
function reminder(){
setTimeout(function(){
	swal({
  title: 'Welcome!',
  width: 600,
  padding: '3em',
  type: 'info',
  html:
    'To register your shop please fill up the required details with <i class="glyphicon glyphicon-asterisk" aria-hidden="true"></i>',
  showCloseButton: true,
  focusConfirm: false,
  allowOutsideClick: false,
})
}, 400); 
	
}

function reminder2(){
$('#myModal').modal('show'); 
	setTimeout(function(){
	swal({
  title: 'Hello! Just a little reminder!',
  width: 600,
  padding: '3em',
  type: 'info',
  html:
    '<small>Please mark your shop, This will show as your location to the users. Once your application form is activated you cannot change it anymore. You can use the Button to get your current location or just mark your shop in the map</small>',
  showCloseButton: true,
  focusConfirm: false,
  allowOutsideClick: false,
  
})
}, 400); 
	
}
</script>
    <script type="text/javascript">
        function submitForm() {
            var fd = new FormData(document.getElementById("fileinfo"));
            fd.append("label", "WEBUPLOAD");
            $.ajax({
              url: "../php/addShop.php",
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
				if (data == "error1"){
				setTimeout(function() {
                swal({title: "Sorry! File Error", text: "We only accept files with 5mb max file size and with file extensions of jpeg and png", type: "error"})
				.then(function() {
					location.reload();
				}); }, 1000);
				}else if (data == "error2") {
			    setTimeout(function() {
				swal({title: "Sorry!", text: "File Already Exist", type: "error"})
				.then(function() {
					location.reload();
				}); }, 1000);
				}else if (data == "error3"){
				setTimeout(function() {
				swal({title: "Sorry!", text: "There was a problem uploading your application form", type: "error"})
				.then(function() {
					location.reload();
				}); }, 1000);
				
				}else if (data == "error4"){
				setTimeout(function() {
				swal({title: "Sorry!", text: "There was a problem uploading your application form", type: "error"})
				.then(function() {
					location.reload();
				}); }, 1000);
				
				}else if (data == "success"){
				setTimeout(function() {
				swal({title: "Good Job!", text: "Your application form needs to be checked first, Please wait for a while to activate your Shop", type: "success"})
				.then(function() {
					window.location = "Home.php";
				}); }, 1000);
				}else{
				setTimeout(function() {
				swal({title: "Sorry!", text: "There was a problem uploading your application form", type: "error"})
				.then(function() {
					location.reload();
				}); }, 1000);
				}
            });
            return false;
        }
    </script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});


</script>
<script>


	var map;
    var markers = [];
	var mylat = "";
	var mylng = "";	
	var myposition;
	var marker;
	var panorama2;


function initMap() {
	
		var myCenter = new google.maps.LatLng(mylat, mylng);
  		var mapCanvas = document.getElementById("map1");
  		var mapOptions = {center: myCenter, zoom: 15};
  		var map1 = new google.maps.Map(mapCanvas, mapOptions);
  		var marker = new google.maps.Marker({position:myCenter});
  		marker.setMap(map1);
	
        var cab = new google.maps.LatLng(15.4865047, 120.973393);
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13.5,                        // Set the zoom level manually
          center: cab,
		  });
		  
		  
		// This event listener will call addMarker() when the map is clicked.
        map.addListener('click', function(event) {
          if (markers.length >= 1) {
              deleteMarkers();
          }
		
          addMarker(event.latLng);
          mylat = event.latLng.lat();
          mylng =  event.latLng.lng();
		  $(document).ready(function () {
    	  $('#lat').val(mylat);
		  $('#lng').val(mylng);
		  });
        });
document.getElementById("myBtn").addEventListener('click', function() {
delMark();
getLocation();


});


function mypano(positionpano){
var panoOptions = {
    					position: positionpano,
    					linksControl: false,
    					panControl: false,
    					zoomControlOptions: {
      					style: google.maps.ZoomControlStyle.SMALL
    						},
    					enableCloseButton: false
  						};

  					var panorama = new google.maps.StreetViewPanorama(
    					document.getElementById('map3'), panoOptions);
						panorama2 = new google.maps.StreetViewPanorama(
    					document.getElementById('map2'), panoOptions);
						
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError, delMark);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function delMark() {
          if (markers.length >= 1) {
              deleteMarkers();
          }
}


function showPosition(position) {
	
    mylat = position.coords.latitude; 
    mylng = position.coords.longitude;
	myposition = {lat: mylat, lng: mylng};
	$(document).ready(function () {
    $('#lat').val(mylat);
	$('#lng').val(mylng);
	
	});

	
	marker = new google.maps.Marker({
    position: myposition,
    title:"My Location",
	
});
markers.push(marker);
marker.setMap(map);
map.setZoom(16);
map.panTo(myposition);
mypano(myposition);


}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            swal("Error!","User denied the request for Geolocation","error");
            break;
        case error.POSITION_UNAVAILABLE:
            swal("Error!","Location information is unavailable.","error");
            break;
        case error.TIMEOUT:
            swal("Error!","The request to get user location timed out.","error");
            break;
        case error.UNKNOWN_ERROR:
            swal("Error!","An unknown error occurred.","error");
            break;
    }
}


      // Adds a marker to the map and push to the array.
      function addMarker(location) {
        marker = new google.maps.Marker({
          position: location,
          map: map
        });
        markers.push(marker);
		map.setZoom(16);
		map.panTo(location);
		mypano(location);
      }

      // Sets the map on all markers in the array.
      function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

      // Removes the markers from the map, but keeps them in the array.
      function clearMarkers() {
        setMapOnAll(null);
      }

      // Deletes all markers in the array by removing references to them.
      function deleteMarkers() {
        clearMarkers();
        markers = [];
      }
}



function checkDetails(){
	var ShopName = $('#shopname').val();
	var Address = $('#address').val();
	var ShopDescription = $('#shopdescription').val();
	var facebook = $('#fb').val();
	var website = $('#website').val();
	var phone = $('#pnumber').val();
	var tele = $('#tnumber').val();
	var ShopType = $( ":checkbox:checked" ).map(function() {
    return this.value;
	}).get().join(", ");
	if (ShopName == '' || Address == '' || ShopType == '' || ShopDescription == ''){
		swal("Reminder!","Please fill up the required details","warning");
	}else if($('#file').get(0).files.length === 0){
		swal("Reminder!","Please upload your shop banner","warning");
	}else if(mylat == ""){
		swal("Reminder!","Please put a mark on the map","warning");
	}else{
		$('#shopnametd').html(ShopName);;
		$('#shoptypetd').html(ShopType);
		$('#descriptiontd').html(ShopDescription);
		$('#addresstd').html(Address);
		$('#phonetd').html(phone);
		$('#telephonetd').html(tele);
		$('#websitetd').html(website);
		$('#facebooktd').html(facebook);
		initMap();
		$('#myModal1').modal('show');
		$('#myModal1').on('shown.bs.modal', function () {
						google.maps.event.trigger(map, "resize");
						google.maps.event.trigger(panorama2, "resize");
    					});
		
	setTimeout(function(){
	swal({
  	title: 'Note!',
  	width: 600,
  	padding: '3em',
  	type: 'info',
  	html:
    '<small>Once you submitted your application form, You will still have time to change the information you submitted to us while this is being reviewed by the Admins.You cannot change some of the information you provided when this is activated. You will receive notification about your shop when Admins are making action. So check first before submitting your shop Application! Thank You!</small>',
  	showCloseButton: true,
  	focusConfirm: false,
  	allowOutsideClick: false,
  
})
}, 400); 
		
	}
}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=PASTEKEYHERE&callback=initMap">
    </script>
<script>
 function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("shopimage");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
</script>
</body></html>
  <div class="modal fade" id="myModal" role="dialog" style="z-index:10000">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header ">
          <button type="button" class="btn btn-success pull-right" id="myBtn" style="margin-right:5px;">Get Current Location</button>
          <div><h4 class="modal-title">Please Mark Your Shop Location <span class="glyphicon glyphicon-info-sign addcolor" data-toggle="tooltip" title="Note: This mark will be used to locate your shop by users"></span></h4></div>
        </div>
        <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
          <div id="map" style="width:100%;height:400px;"></div>
          </div>
          <div class="col-md-6">
          <div id="map3" style="width:100%;height:400px; border:solid 1px;"></div>
          </div>
        </div>
        </div>
        <div class="modal-footer">
        
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>


    <div class="modal fade" id="myModal2" role="dialog" style="z-index:10000">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div><h4 class="modal-title">Shop Banner</h4></div>
        </div>
        <div class="modal-body">
          <form id="form1">
          
 <br/>
 <center>
<img id="thumbnil" style="width:300px; margin-top:10px;"  src="" alt="image"/>
</center>
</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Done</button>
        </div>
      </div>
    </div>
  </div>
  
  
<div class="modal fade" id="myModal1" role="dialog" style="z-index:10000">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-darkblue-gradient">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div><h4 class="modal-title">Shop Information</h4></div>
        </div>
        <div class="modal-body">
  <div>
  <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img id="shopimage" alt="User Pic" style="width:300px;display:block; height: auto; border:2px solid #1d4d63;" src="" class="img-responsive responsive-image "> </div>
  <div class=" col-md-9 col-lg-9 "> 
  <table class="mytable table" id="tableinfo">
        <thead class="bg-darkblue-gradient">        
        <tr>
        	<th class="col-md-2"><strong>Name</strong></th>
        	<th class="col-md-9"><strong>Information</strong></th>
        </tr>
        </thead>
        <tbody>
        <tr>
        	<td><strong>Shop Name</strong></td>
            <td id="shopnametd"></td>
        </tr>
        <tr>
        	<td><strong>Shop Type</strong></td>
            <td id="shoptypetd"></td>
        </tr>
        <tr>
        	<td><strong>Description</strong></td>
            <td id="descriptiontd"></td>
        </tr>
        <tr>
        	<td><strong>Address</strong></td>
            <td id="addresstd"></td>
        </tr>
        <tr>
        	<td><strong>Phone Number</strong></td>
            <td id="phonetd"></td>
        </tr>
        <tr>
        	<td><strong>Telephone Number</strong></td>
            <td id="telephonetd"></td>
        </tr>
        <tr>
        	<td><strong>Website</strong></td>
            <td id="websitetd"></td>
        </tr>
        <tr>
        	<td><strong>Facebook</strong></td>
            <td id="facebooktd"></td>
        </tr>
        </tbody>
  </table>
  	</div>
  </div>
  </div>
        <hr>
        <div class="bg-darkblue-gradient">
        <h3 style="padding:5px;">Location</h3>
        </div>
		<div class="row">
       	  <div class="col-md-6">
          <div id="map1" style="width:100%;height:300px;border:2px solid #1d4d63;"></div>
		  </div>
          <div class="col-md-6">
          <div id="map2" style="width:100%;height:300px;border:2px solid #1d4d63;"></div>
		  </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="submitform" onclick="document.getElementById('submit').click()">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  
