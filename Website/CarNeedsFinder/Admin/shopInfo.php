<?php
$idSO = base64_decode($_GET['cnf']);
if($idSO == ""){
	header('Location: Home.php');
}else if(!is_numeric($idSO)){
	header('Location: Home.php');
}
?>
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
.dataTable th, .dataTable td {
max-width: 200px;
min-width: 70px;
overflow: hidden;
text-overflow: ellipsis;
white-space: nowrap;
}
</style>
<body class="hold-transition skin-blue sidebar-mini">
<input type="hidden" id="idSO" name="idSO" value="<?php echo $idSO ?>"
<div class="wrapper">
<input type="hidden" value="Auto Mechanic" name="category" id="category" />
<?php include 'navigationBar.php';?>
  <div class="content-wrapper">
    <section class="content-header">
		<div class="well well-lg well-gradient">
        <p style="font-size:30px; font-family: Tahoma, Geneva, sans-serif; font-weight:bolder;" id="pageHeader"><i class="	glyphicon glyphicon-cog"></i>&nbsp;Shop Information</p>
		</div>
    </section>

    <section class="content container-fluid">
<table id="data" class="display responsive nowrap dataTable no-footer dtr-inline collapsed table table-bordered table-striped textcenter" style="width:100%; border-color:black;">
<caption><center><h3><strong>Shop Reports</strong></h3></center></caption>
        <thead class="bg-light-blue-gradient">
            <tr>
                <th>Reporter Name</th>
                <th>Report</th>
                <th></th>
                <th>View</th>
            </tr>
        </thead>
 
        <tbody id="mytable">


</tbody>
</table>


<table id="reportdata" class="display responsive nowrap dataTable no-footer dtr-inline collapsed table table-bordered table-striped textcenter" style="width:100%; border-color:black;">
<caption><center><h3><strong>Feedback Reports</strong></h3></center></caption>
        <thead class="bg-light-blue-gradient">
            <tr>
                <th>Author Name</th>
                <th>Report</th>
                <th></th>
                <th>View</th>
            </tr>
        </thead>
 
        <tbody id="reportable">


</tbody>
</table>
<hr>
<div class="row"  style="margin-top:50px">
                <div class="col-md-3 col-lg-3 " align="center"> <img id="shopimage" alt="User Pic" style="width:300px;display:block; height: auto; border:2px solid #113c94;" src="" class="img-responsive responsive-image "> </div>
  <div class=" col-md-9 col-lg-9 "> 
  <table class="mytable table" id="tableinfo">
        <thead class="bg-light-blue-gradient">        
        <tr>
        	<th class="col-md-2"><strong>Name</strong></th>
        	<th class="col-md-9"><strong>Information</strong></th>
        </tr>
        </thead>
        <tbody>
        <tr>
        	<td><strong>Shop Owner</strong></td>
            <td><a target="_blank" rel="noopener noreferrer" href="#"id="shopownertd"></a></td>
        </tr>
        <tr>
        	<td><strong>Shop Name</strong></td>
            <td id="shopnametd"></td>
        </tr>
        <tr>
        	<td><strong>Shop Type</strong></td>
            <td id="shoptypetd"></td>
        </tr>
        <tr>
        	<td><strong>Shop State</strong></td>
            <td ><span id="shopstatetd" style="font-style:italic; font-size:30px;" ></span></td>
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
  
  <div>
  <button class="btn btn-lg btn-edit pull-right" onClick="openReview();">Make an action</button>
  </div>
  	</div>
  </div>
        <hr>
        <div class="bg-light-blue-gradient">
        <h3 style="padding:5px;">Location</h3>
        </div>
		<div class="row">
       	  <div class="col-md-6">
          <div id="map" style="width:100%;height:300px;border:2px solid #113c94;"></div>
		  </div>
          <div class="col-md-6">
          <div id="map2" style="width:100%;height:300px;border:2px solid #113c94;"></div>
		  </div>
		</div>
        
        <hr>
        <div class="bg-light-blue-gradient">
        <h4 style="padding:10px;">History</h4>
        </div>
        <div class="form-group">
  			<textarea class="form-control" rows="5" id="history" name="history" style="border:2px solid #113c94;" disabled>
			</textarea>
		</div>
        
        <div class="bg-light-blue-gradient">
        <h4 style="padding:10px;">Resolved Reports</h4>
        </div>
        <div class="form-group">
  			<textarea class="form-control" rows="5" id="resolvedhistory" name="resolvedhistory" style="border:2px solid #113c94;" disabled>
			</textarea>
		</div>
        
        
        
        
<hr>

<center>
<h3 class="pull-left" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Shop Images</h3>
  <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
    <!-- Indicators -->
    <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    
  </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" id="imagebox" role="listbox">
      
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
        
</center>
<br><br>


<div class="row">
<div class="col-md-6">
<header>
<h3 class="pull-left" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Operating Hours</h3>
</header>
<table class="display responsive nowrap dataTable no-footer dtr-inline collapsed table table-bordered table-striped textcenter" style="width:100%; border-color:black;">
        <thead class="bg-light-blue-gradient">
	<tr>
		<th width="100px;">Day</th>
        <th>Opening</th>
        <th>Closing</th>
	</tr>
	</thead>
    <tbody id="operatinghours">
    </tbody>
</table>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-6">
<header>
<h3 class="pull-left" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Shop Products</h3>
</header>
<table id="product" class="display responsive nowrap dataTable no-footer dtr-inline collapsed table table-bordered table-striped textcenter" style="width:100%; border-color:black;">
        <thead class="bg-light-blue-gradient">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th></th>
            </tr>
        </thead>
 
        <tbody id="mytableproduct">


</tbody>
</table>
</div>
<div class="col-md-6">
<header>
<h3 class="pull-left" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Shop Services</h3>
</header>
<table id="service" class="display responsive nowrap dataTable no-footer dtr-inline collapsed table table-bordered table-striped textcenter" style="width:100%; border-color:black;">
        <thead class="bg-light-blue-gradient">
            <tr>
                <th>Service</th>
                <th>Price</th>
            </tr>
        </thead>
 
        <tbody id="mytableservice">


</tbody>
</table>
</div>
</div>


<div>
<h3 class="pull-left" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Shop Reviews</h3>
<table id="shopreview" class="display responsive nowrap dataTable no-footer dtr-inline collapsed table table-bordered table-striped textcenter" style="width:100%; border-color:black;">
        <thead class="bg-light-blue-gradient">
            <tr>
                <th style="max-width:160px;">Reviewer Name</th>
                <th>Rate & Review</th>
            </tr>
        </thead>
 
        <tbody id="reviewtable">


</tbody>
</table>
</div>
        
    </section>
  </div>
  <?php include 'footer.php';?>
</div>

<script src="../bootstrap/js/adminlte.min.js"></script>
<script>
getShopData();
fetchData();

	function fetchData(){
	var idshop = $('#idSO').val();
	var output = '';
	$.ajax({
		type: "POST",
		url: "../php/fetchShopReportbyShopId.php",
		data: "idshop="+idshop,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			if(shop[i].reportstate == 1){
				shop[i].reportstate = "Pending Report"
			}else if(shop[i].reportstate == 2){
				shop[i].reportstate = "Resolved Report" 
			}else if (shop[i].reportstate == 3){
				shop[i].reportstate = "Unresolved Report"
			}
							output += '<tr>' +
										'<td style="max-width:135px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].reportername +'</span></td>' +
										'<td style="max-width:180px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].report +'</span></td>' +
										'<td style="max-width:180px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].reportstate +'</span></td>' +
										
										'<td style="width:10px;"><button class="btn btn-default" onclick = "getReport('+'\''+shop[i].idshopreport+'\''+')"><span class="glyphicon glyphicon-search"></span></button></td>'  +
								      '</tr>';
									  
									  $("#mytable").html(output);
						}
	$( "#data" ).DataTable();
    },
    error: function() {
        location.reload();
		
		}

	
	});
	
	}
function getShopData(){
	var idShopData = $('#idSO').val();
	var output = '';
	var output2 = '';
	var reportOutput = '';
	var reviewOutput = '';
	$("#reports").html("");
	$("#reviews").html("");
	$.ajax({
		type: "POST",
		url: "../php/fetchShopData.php",
		data: "idshop="+idShopData,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
				$(function () {
					$('#shopownertd').attr("href", 'shopOwnerInformation.php?cnf='+'\''+window.btoa(shop[i].shopowner_idshopowner)+'\''+'')
					mylat = shop[i].latitude;
					mylng = shop[i].longitude;
  					$('#shopownertd').html(shop[i].name);
					$('#shopnametd').html(shop[i].shopname);;
					$('#shoptypetd').html(shop[i].shoptype);
					$('#shopstatetd').html(shop[i].activation);
					$('#descriptiontd').html(shop[i].description);
					$('#addresstd').html(shop[i].shopaddress);
					$('#phonetd').html(shop[i].phonenumber);
					$('#telephonetd').html(shop[i].telephonenumber);
					$('#websitetd').html(shop[i].website);
					$('#facebooktd').html(shop[i].facebook);
					if(shop[i].shopicon == null){
					$("#shopimage").attr("src","../uploads/noimage.png");
				}else{
					$("#shopimage").attr("src",'../uploads/'+shop[i].shopicon+'');
				}
					
					
				setTimeout(function() {
					var myCenter = new google.maps.LatLng(mylat, mylng);
  					var mapCanvas = document.getElementById("map");
  					var mapOptions = {center: myCenter, zoom: 15};
  					var map = new google.maps.Map(mapCanvas, mapOptions);
  					var marker = new google.maps.Marker({position:myCenter});
  					marker.setMap(map);
					  var panoOptions = {
    					position: myCenter,
    					linksControl: false,
    					panControl: false,
    					zoomControlOptions: {
      					style: google.maps.ZoomControlStyle.SMALL
    						},
    					enableCloseButton: false
  						};

  					var panorama = new google.maps.StreetViewPanorama(
    					document.getElementById('map2'), panoOptions);

						google.maps.event.trigger(map, "resize");
    					google.maps.event.trigger(panorama, "resize");
						
						}, 500);

				});
				}
		}
	});
	
	$.ajax({
		type: "POST",
		url: "../php/fetchAdminReviewbyId.php",
		data: "idshop="+idShopData,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			
							output +=  shop[i].comment +'&#13;&#10;&#13;&#10;' ;
									  
									  $("#history").html(output);
						}
		
		}

	
	});
	
	
	$.ajax({
		type: "POST",
		url: "../php/fetchShopReportbyShopIdandState.php",
		data: "idshop="+idShopData+"&reportState=2",
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			
							output2 +=  shop[i].reportername+ " ("+ shop[i].reporteremail+")" + ": "+shop[i].report+ " ("+ shop[i].datetime +")"+'&#13;&#10;&#13;&#10;' ; 
									  
									  $("#resolvedhistory").html(output2);
						}
		
		}

	
	});

	}
	
fetchShopProduct();
fetchOperatingHours();
fetchShopService();
fetchShopIcon();
fetchImage();
fetchShopReview();


function fetchShopReview(){
	var output = '';
	var id = $('#idSO').val();
	$.ajax({
		type: "POST",
		url: "../php/fetchShopReviewbyShopId.php",
		data: "idshop="+id,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			
							output += '<tr>' +
										'<td style="max-width:135px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].reviewername+ '-<small>('+ shop[i].revieweremail + ')</small>'+'</span></td>' +
										'<td style="max-width:135px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].comment + " - "+shop[i].rate + ' <span class="glyphicon glyphicon-star"></span></span></td>' +
								      '</tr>';
									  
									  
						}
						
		$("#reviewtable").html(output);
		$("#shopreview" ).DataTable();
    },
    error: function() {
        location.reload();
		
		}
	
	});
	
	}

	function fetchShopIcon(){
	var output = '';
	var id = $('#idSO').val();
	$.ajax({
		type: "POST",
		url: "../php/fetchShopbyId.php",
		data: "id="+id,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			
							output += '<div class="item active">'+
        								'<img class="img" src="../uploads/'+ shop[i].shopicon +'" style="width:600px; height:320px;">'  
							
						}
						$("#imagebox").html(output);
		
		}

	
	});
	
	}

	
	function fetchImage(){
	var output = '';
	var output1 = '';
	var x = 0;
	var id = $('#idSO').val();
	$.ajax({
		type: "POST",
		url: "../php/fetchShopImagebyId.php",
		data: "id="+id,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
					x++;
							output += '<div class="item">' +
      										'<img src="../uploads/'+ shop[i].image +'" style="width:600px; height:320px;">'+
											'<div class="carousel-caption">'+
    									'</div>';
							output1 += '<li data-target="#myCarousel" data-slide-to="'+ x +'"></li>';
						}
						$("#imagebox").append(output);
						$(".carousel-indicators").append(output1);
						
		
		}

	
	});
	
	}
	
	
	


	function fetchShopProduct(){
	var output = '';
	var id = $('#idSO').val();
	$.ajax({
		type: "POST",
		url: "../php/fetchShopProductbyShopId.php",
		data: "id="+id,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			
							output += '<tr>' +
										'<td style="max-width:135px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].productname +'</span></td>' +
										'<td style="max-width:135px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].price +'</span></td>' +
										'<td style="width:10px;"><button class="btn btn-default" onclick = "fetchShopProductbyId('+'\''+shop[i].idshopproduct+'\''+')"><span class="glyphicon glyphicon-search"></span></button></td>' +
								      '</tr>';
									  
									  
						}
						$("#mytableproduct").html(output);
						
		$( "#product" ).DataTable();
    },
    error: function() {
        location.reload();
		
		}
	
	});
	
	}
	
	
	function fetchShopService(){
	var output = '';
	var id = $('#idSO').val();
	$.ajax({
		type: "POST",
		url: "../php/fetchShopServicebyShopId.php",
		data: "id="+id,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			
							output += '<tr>' +
										'<td style="max-width:135px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].servicename +'</span></td>' +
										'<td style="max-width:135px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].price +'</span></td>' +
										
								      '</tr>';
									  
									  
						}
						$("#mytableservice").html(output);
		
		$( "#service" ).DataTable();
    },
    error: function() {
        location.reload();
		
		}

	
	});
	
	}
	
	function fetchOperatingHours(){
	var output = '';
	var id = $('#idSO').val();
	$.ajax({
		type: "POST",
		url: "../php/fetchOperatingHoursbyShopId.php",
		data: "id="+id,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			
							output += '<tr>' +
										'<td style="max-width:135px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].day +'</span></td>' +
										'<td style="max-width:180px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].opening +'</span></td>' +
										'<td style="max-width:180px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].closing +'</span></td>' +
								      '</tr>';
									  
									  
						}
						$("#operatinghours").html(output);
		
		}

	
	});
	
	}
	
	
	function getReport(idReport){
		$.ajax({
		type: "POST",
		url: "../php/fetchShopReportbyId.php",
		data: "idshop="+idReport,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
				

							$('#reportername').html("<strong>Reporter Name: </strong>" + shop[i].reportername);
							$('#report').html("<strong>Report:&nbsp;</strong>" + shop[i].userreport);
							$('#emailreporter').html(shop[i].reporteremail);
							$('#resolved').click({param1: 2, param2: shop[i].idshopreport}, confirmSubmit);
							$('#unresolved').click({param1: 3, param2: shop[i].idshopreport}, confirmSubmit);
							$('#mark').click({param1: 4, param2: shop[i].idshopreport}, confirmSubmit);
							
							
						}
		}
	});
		$('#myModal2').modal('show');
	}
	
	
	
	function confirmSubmit(event){
		
	if(event.data.param1== 2){
		swal({
		title: "Are you sure this is already resolved?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
				updateReportState(event.data.param1,event.data.param2);
				
			}else{
			swal.close()
			}
		});
		
	}else if(event.data.param1== 3) {
		swal({
		title: "Are you sure this is report cannot be resolved?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			updateReportState(event.data.param1,event.data.param2);
				
			}else{
			swal.close()
			}
		});
		
	}else if(event.data.param1== 4) {
		swal({
		title: "Are you want to mark this as spam?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			updateReportState(event.data.param1,event.data.param2);
				
			}else{
			swal.close()
			}
		});
	}
}

function updateReportState(state,idreport){
	console.log(state,idreport);
	var mystate = state;
		var message = "";
		if (mystate == 2){
			message = "Succesfully change to resolved"
		}else if(mystate == 3){
			message = "Succesfully change to unresolved"
		}else if(mystate == 4){
			message = "Succesfully mark as spam"
		}
		$.ajax({
		type: "POST",
		url: "../php/updateShopReportStatebyId.php",
		data: "idReport="+idreport+"&state="+state,
		success: function(msg){
			if(msg == "success"){
				setTimeout(function() {
				swal({title: "Good Job!", text: message, icon: "success"})
				.then(function() {
					location.reload();
				}); }, 1000);
				}else{
				setTimeout(function() {
				swal({title: "Sorry!", text: "There was a problem submitting your request", icon: "error"})
				.then(function() {
					location.reload();
				}); }, 1000);
					
					
					
				}
           }
         });
}

function fetchShopProductbyId(id){
	$.ajax({
		type: "POST",
		url: "../php/fetchShopProductbyId.php",
		data: "id="+id,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
				$("#productimg").attr("src", "../uploads/products/"+shop[i].image);
				$('#producttd').html(shop[i].productname);
				$('#descriptiontd').html(shop[i].description);
				$('#pricetd').html(shop[i].price);
				$('#myModal').modal('show');
					
						}
		
		}

	
	});
	
	}
	
	
function openReview(){
		$(document).ready(function() {
		var idShop = $('#idSO').val();
		$('#shopID').val(idShop)
		$('#myModal3').modal('show');
		});
		
	}
	
function confirmReview(){
	var check = $('#activation').val();
	if (check == "0"){
	swal({title: "Sorry!", text: "Please select a review", icon: "error"})
	}else{
	swal({
		title: "Are you sure?",
  		text: "Make sure you've already check the information of this Shop",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			submitReview();
			}else{
			swal.close()
			}
		}); }
}

function submitReview() {
	
	$.ajax({
           type: "POST",
           url: "../php/addAdminReview.php",
           data: $("#formReview").serialize(), // serializes the form's elements.
           success: function(msg)
           {
               if(msg == "success"){
				setTimeout(function() {
				swal({title: "Good Job!", text: "Successfully submitted your review", icon: "success"})
				.then(function() {
					window.location = "markedShops.php";
				}); }, 1000);
				}else{
				setTimeout(function() {
				swal({title: "Sorry!", text: "There was a problem submitting your review", icon: "error"})
				.then(function() {
					window.location = "markedShops.php";
				}); }, 1000);
					
					
					
				}
           }
         });
			}


$(document).ready(function() {

    $("#activation").change(function() {
        var val = $(this).val();
        if (val == "Deleted") {
            $("#reason").html("<option value='Invalid information'>Invalid information</option><option value='Does not exist'>Does not exist</option><option value='Already exist'>Already exist</option><option value='Shop Location'>Shop Location</option><option value='Other'>Other</option>");
        } else if (val == "Revision") {
            $("#reason").html("<option value='Invalid Information'>Invalid Information</option><option value='Shop Location'>Shop Location</option><option value='Other'>Other</option>");

        }
    });


});
</script>


</body>
</html>



<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-light-blue-gradient">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><center>Report Info</center></h4>
        </div>
        <div class="modal-body">
          <h4 id="reportername"><strong>Reporter Name:&nbsp;</strong></h4>
          <small id="emailreporter" style="margin-top:-20px;"></small>
          <p id="report"><strong>Report:&nbsp;</strong></p>
        </div>
        
        
        <div class="modal-footer">
          <div class="pull-left">
        	<div class="dropdown">
    		<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Make an Action
    		<span class="caret"></span></button>
    		<ul class="dropdown-menu">
      		<li><a href="#" id="resolved">Report resolved</a></li>
      		<li><a href="#" id="unresolved">Report unresolved</a></li>
      		<li><a href="#" id="mark">Mark as spam</a></li>
    		</ul>
  			</div>
            
            </div>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


  <div class="modal fade" id="myModal" role="dialog" style="z-index:9500">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-light-blue-gradient">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div><h4 class="modal-title">Shop Product</h4></div>
        </div>
        <div class="modal-body" id="shopproduct">
  <div class="row">
  <div class="col-md-4" align="center"><img id="productimg" src="" style="width:200px; height:150px; border:solid #CCC;"/></div>
  <div class="col-md-8">
  <table class="mytable table table-bordered">
  <thead class="bg-light-blue-gradient">
  <tr>
  <th width="100px;">Name</th>
  <th>Data</th>
  </tr>
  </thead>
  <tr>
  <td>Product:</td>
  <td id="producttd"></td>
  </tr>
  <tr>
  <td>Description:</td>
  <td id="descriptiontd"></td>
  </tr>
  <tr>
  <td>Price:</td>
  <td id="pricetd"></td>
  </tr>
  </table>
  </div>
  </div>
   
   
  
  <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  </div>

<div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
        
          <button type="button" class="close" data-dismiss="modal" >&times;</button>
          <h4 class="modal-title">Admin Shop Review</h4>
        </div>
        <div class="modal-body">
        <form id="formReview" name="formReview" method="post">
        <input type="hidden" value="<?php echo $idadmin ?>" name="idadmin" id="idadmin" />
        <input type="hidden" id="shopID" name="shopID"  />
          	<div class="form-group">
  				<label for="review">Review</label>
  				<select class="form-control" id="activation" name="activation">
                	<option value="0">Please Select One</option>
    				<option value="Deleted">Delete</option>
    				<option value="Revision">For Revision</option>
  				</select>
			</div>
            <div class="form-group">
  				<label for="Reason">Reason</label>
  				<select class="form-control" id="reason" name="reason">
  				</select>
			</div>
         	<div class="form-group">
  				<label for="comment">Comment:</label>
  				<textarea class="form-control" rows="3" id="comment" name="comment"></textarea>
			</div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onClick="confirmReview()">Submit</button>
          <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6Ls8aU5Ug11kHV6NTiGIsKXZLeU2A67U&callback=getShopData">
</script>