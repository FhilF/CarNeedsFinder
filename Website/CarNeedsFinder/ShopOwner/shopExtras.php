<?php 
$idShop = base64_decode($_GET['cnf']);
if($idShop == ""){
	header('Location: Home.php');
}else if(!is_numeric($idShop)){
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

header {
    background-color: pink;
}


#data.table.table-bordered{
    border:1px solid #1d4d63;
	
    margin-top:20px;
  }
#data.table.table-bordered > thead > tr > th{
    border:1px solid #1d4d63;
}
#data.table.table-bordered > tbody > tr > td{
    border:1px solid #1d4d63;
}


#data2.table.table-bordered{
    border:1px solid #1d4d63;
	
    margin-top:20px;
  }
#data2.table.table-bordered > thead > tr > th{
    border:1px solid #1d4d63;
}
#data2.table.table-bordered > tbody > tr > td{
    border:1px solid #1d4d63;
}

#data3.table.table-bordered{
    border:1px solid #1d4d63;
	
    margin-top:20px;
  }
#data3.table.table-bordered > thead > tr > th{
    border:1px solid #1d4d63;
}
#data3.table.table-bordered > tbody > tr > td{
    border:1px solid #1d4d63;
}



</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<input type="hidden" id="idshop" name="idshop" value="<?php echo $idShop ?>" />
<input type="hidden" id="activation" name="activation" value="Inactive" />

  <?php include 'navigationBar.php' ?>
  <div class="content-wrapper">
    <section class="content-header">
  	<div class="well well-lg bg-myblue-color">
    <h1 id="shopname" style="font-weight:bold;">Shop Information</h1>
  	</div>
    </section>
    <section class="content container-fluid">
    
<div class="row">

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
  <button style="background-color:#28414d; color:#FFF" class="btn btn-default pull-right" onClick="editShopDetail();"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit Shop Details</button>
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
  			<textarea class="form-control" rows="5" id="history" name="history" style="border:2px solid #1d4d63;" disabled>
			</textarea>
		</div>
<hr>


<h3 class="pull-left" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Shop Images</h3>
<button style="background-color:#28414d; color:#FFF" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal4"><span class="fa fa-plus"></span>&nbsp; Add New Image</button>

<br><br>


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

    
    
<br><br>


<div class="row">
<div class="col-md-6">
<header>
<h3 class="pull-left" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Operating Hours</h3>
<button style="background-color:#28414d; color:#FFF" class="btn btn-default pull-right" onclick="confirmSubmit(4)"><span class="fa fa-plus"></span>&nbsp; New Schedule</button>
</header>
<table id="data3" class="table table-bordered table-hover table-responsive table-striped">
	<thead class="bg-darkblue-gradient">
	<tr>
		<th width="100px;">Day</th>
        <th>Opening</th>
        <th>Closing</th>
        <th></th>
        <th></th>
	</tr>
	</thead>
    <tbody id="operatinghours">
    </tbody>
</table>
</div>
</div>
<hr>
<div class="row" style="padding-top:5%">
<div class="col-md-6">
<header>
<h3 class="pull-left" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Shop Products</h3>
<button style="background-color:#28414d; color:#FFF" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal1"><span class="fa fa-plus"></span>&nbsp;Add Product</button>
</header>
<table id="data" class="display responsive nowrap dataTable no-footer dtr-inline collapsed table table-bordered table-striped" style="width:100%; border-color:black;">
        <thead class="bg-darkblue-gradient">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th></th>
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
<button style="background-color:#28414d; color:#FFF" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal2"><span class="fa fa-plus"></span>&nbsp;Add Services</button>
</header>
<table id="data2" class="display responsive nowrap dataTable no-footer dtr-inline collapsed table table-bordered table-striped" style="width:100%; border-color:black;">
        <thead class="bg-darkblue-gradient">
            <tr>
                <th>Service</th>
                <th>Price</th>
                <th></th>
            </tr>
        </thead>
 
        <tbody id="mytableservice">


</tbody>
</table>
</div>
</div>

<hr>
<header>
<h3 class="pull-left" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Shop Reports</h3>
</header>
<table id="shopreview" class="display responsive nowrap dataTable no-footer dtr-inline collapsed table table-bordered table-striped textcenter" style="width:100%; border-color:black;">
        <thead class="bg-light-blue-gradient">
            <tr>
                <th style="max-width:160px;">Reviewer Name</th>
                <th>Rate & Review</th>
                <th style="max-width:50px;">State</th>
                <th>Report</th>
            </tr>
        </thead>
 
        <tbody id="reviewtable">


</tbody>
</table>


        
    </section>
  </div>
<?php include 'footer.php' ?>

</div>

<script src="../bootstrap/js/adminlte.min.js"></script>

<script>
getShopData();
fetchShopReview();
function getShopData(){
	var idShopData = $('#idshop').val();
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
	
	
	}
	
function fetchShopReview(){
	var output = '';
	var id = $('#idshop').val();
	var buttondisplay
	$.ajax({
		type: "POST",
		url: "../php/fetchShopReviewbyShopId.php",
		data: "idshop="+id,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
				if (shop[i].reportstate == 1 ){
					shop[i].reportstate = "Reported"
					buttondisplay = '<td style="width:10px;"><button class="btn btn-danger disabled" ><span class="glyphicon glyphicon-trash"></span></button>';
				}else if(shop[i].reportstate == 0 ){
					shop[i].reportstate = ""
					buttondisplay = '<td style="width:10px;"><button class="btn btn-danger" onclick = "confirmDelete('+'\''+shop[i].idshopreview+'\''+','+'3'+')" ><span class="glyphicon glyphicon-trash"></span></button>'
				}
				
			
							output += '<tr>' +
										'<td style="max-width:135px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].reviewername+ '-<small>('+ shop[i].revieweremail + ')</small>'+'</span></td>' +
										'<td style="max-width:135px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].comment + " - "+shop[i].rate + ' <span class="glyphicon glyphicon-star"></span></span></td>' +
										'<td><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].reportstate+ '</span></td>' +
										buttondisplay +
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


function fillUp(){
	swal({
		title: "Error!",
  		text: "Please fill up the form",
  		icon: "error",
		})
}

function confirmSubmit(confirmid){
	if (confirmid == 1){
	swal({
		title: "Are you sure you want to insert this product?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			var product = $('#product').val();
				if(product == "" || $('#file').get(0).files.length === 0){
					fillUp();
				}else{
					submitProduct();
					
				}
			}else{
			swal.close()
			}
		});
}else if (confirmid == 2){
	swal({
		title: "Are you sure you want to insert this service?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
				var service = $('#service').val();
				if(service != ""){
					submitService();
				}else{
					fillUp();
				}
			
			}else{
			swal.close()
			}
		});
	
}else if (confirmid == 3){
	swal({
		title: "Are you sure you want to insert this schedule?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			submitSched();
			}else{
			swal.close()
			}
		});
	
}else if (confirmid == 4){
	swal({
		title: "Are you sure you want to Create a New Schedule?",
  		text: "This will delete the current schedule",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			createNewSched();
			}else{
			swal.close()
			}
		});
		
}else if (confirmid == 5){
	swal({
		title: "Are you sure you want to add this image?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
				if($('#file1').get(0).files.length === 0){
					fillUp();
				}else{
					countImage();
					
				}
			
			}else{
			swal.close()
			}
		});
	
}else if (confirmid == 6){
	swal({
		title: "Are you sure you want to add this details?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			updateShopDetails();
			}else{
			swal.close()
			}
		});
	
}else{
	swal({
		title: "Sorry!",
  		text: "There was a problem submitting your form",
  		icon: "error",
		showCloseButton: true
		})

}
}


function confirmDelete(id,confirmid){
	if (confirmid == 1){
	swal({
		title: "Are you sure you want to delete this service?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			deleteService(id);
			}else{
			swal.close()
			}
		});
	
}else if (confirmid == 2){
	swal({
		title: "Are you sure you want to delete this operating hour?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			deleteSched(id);
			}else{
			swal.close()
			}
		});
	
}else if (confirmid == 3){
	swal({
		title: "Are you sure you want to report this review?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			updateShopReviewReportState(id);
			
			}else{
			swal.close()
			}
		});
	
}else{
	swal({
		title: "Sorry!",
  		text: "There was a problem submitting your form",
  		icon: "error",
		showCloseButton: true
		})

}
}

function confirmDelwithImage(id,image,confirmid){
	if(confirmid == 1){
	swal({
		title: "Are you sure you want to delete this image?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			deleteImage(id,image);
			}else{
			swal.close()
			}
		});
	}else if(confirmid == 2){
	swal({
		title: "Are you sure you want to delete this product?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			deleteProduct(id,image);
				
			}else{
			swal.close()
			}
		});
	}else{
		swal({
		title: "Sorry!",
  		text: "There was a problem submitting your form",
  		icon: "error",
		showCloseButton: true
		})
		
	}
		
}
function createNewSched(){
	var id = $('#idshop').val();
	$.ajax({
		type: "POST",
		url: "../php/addNewOperatingHoursbyShopId.php",
		data: "id="+id,
		success: function(data){
				if(data == "success"){
					setTimeout(function() {
					swal({title: "Good Job!", text: "You created a new schedule", icon: "success"})
					.then(function() {
					location.reload();
					}); }, 1000);
					
				}else{
					setTimeout(function() {
					swal({title: "Sorry!", text: "There was a problem in deleting you schedule", icon: "error"})
					.then(function() {
					location.reload();
					}); }, 1000);
				}
		}
	});
	
}

function updateShopReviewReportState(id){
	$.ajax({
		type: "POST",
		url: "../php/updateShopReviewReportState.php",
		data: "idShopReview="+id+"&state=1",
		success: function(data){
				if(data == "success"){
					setTimeout(function() {
					swal({title: "Good Job!", text: "You reported a review", icon: "success"})
					.then(function() {
					location.reload();
					}); }, 1000);
					
				}else{
					setTimeout(function() {
					swal({title: "Sorry!", text: "There was a problem on submitting your request", icon: "error"})
					.then(function() {
					location.reload();
					}); }, 1000);
				}
		}
	});
	
	
}

function deleteSched(id){
	$.ajax({
		type: "POST",
		url: "../php/deleteOperatingHoursbyId.php",
		data: "id="+id,
		success: function(data){
				if(data == "success"){
					setTimeout(function() {
					swal({title: "Good Job!", text: "You deleted your operating hour", icon: "success"})
					.then(function() {
					location.reload();
					}); }, 1000);
					
				}else{
					setTimeout(function() {
					swal({title: "Sorry!", text: "There was a problem in deleting you schedule", icon: "error"})
					.then(function() {
					location.reload();
					}); }, 1000);
				}
		}
	});
	
	
}

function deleteProduct(id,image){
	$.ajax({
		type: "POST",
		url: "../php/deleteProductbyId.php",
		data: "id="+id+"&image="+image,
		success: function(data){
				if(data == "success"){
					setTimeout(function() {
					swal({title: "Good Job!", text: "You deleted your product", icon: "success"})
					.then(function() {
					location.reload();
					}); }, 1000);
					
				}else{
					setTimeout(function() {
					swal({title: "Sorry!", text: "There was a problem in deleting you product", icon: "error"})
					.then(function() {
					location.reload();
					}); }, 1000);
				}
		}
	});
	
	
}

function deleteService(id){
	$.ajax({
		type: "POST",
		url: "../php/deleteServicebyId.php",
		data: "id="+id,
		success: function(data){
				if(data == "success"){
					setTimeout(function() {
					swal({title: "Good Job!", text: "You deleted your shop's service", icon: "success"})
					.then(function() {
					location.reload();
					}); }, 1000);
					
				}else{
					setTimeout(function() {
					swal({title: "Sorry!", text: "There was a problem in deleting your shop's service", icon: "error"})
					.then(function() {
					location.reload();
					}); }, 1000);
				}
		}
	});
	
	
}

function deleteImage(id,image){
	$.ajax({
		type: "POST",
		url: "../php/deleteImagebyId.php",
		data: "id="+id+"&image="+image,
		success: function(data){
				if(data == "success"){
					setTimeout(function() {
					swal({title: "Good Job!", text: "You deleted your image", icon: "success"})
					.then(function() {
					location.reload();
					}); }, 1000);
					
				}else{
					setTimeout(function() {
					swal({title: "Sorry!", text: "There was a problem in deleting your image", icon: "error"})
					.then(function() {
					location.reload();
					}); }, 1000);
				}
		}
	});
	
	
}
		
		
function submitProduct() {
            var fd = new FormData(document.getElementById("addProduct"));
            $.ajax({
              url: "../php/addProduct.php",
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
				if (data == "success"){
				setTimeout(function() {
				swal({title: "Good Job!", text: "You added your product", icon: "success"})
				.then(function() {
					location.reload();
				}); }, 1000);
				}else{
					swal({
					title: "Sorry!",
  					text: "There was a problem submitting your form",
  					icon: "error",
					showCloseButton: true
					})	
				}
            });
            return false;
        }
		

function submitService() {
            var fd = new FormData(document.getElementById("addService"));
            $.ajax({
              url: "../php/addService.php",
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
				if (data == "success"){
				setTimeout(function() {
				swal({title: "Good Job!", text: "You added your service", icon: "success"})
				.then(function() {
					location.reload();
				}); }, 1000);
				}else{
					swal({
					title: "Sorry!",
  					text: "There was a problem submitting your form",
  					icon: "error",
					showCloseButton: true
					})	
				}
            });
            return false;
        }
		
function submitSched() {
            var fd = new FormData(document.getElementById("updateSched"));
            $.ajax({
              url: "../php/updateSchedbyId.php",
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
				if (data == "success"){
				setTimeout(function() {
				swal({title: "Good Job!", text: "You added your Schedule", icon: "success"})
				.then(function() {
					location.reload();
				}); }, 1000);
				}else{
					swal({
					title: "Sorry!",
  					text: "There was a problem submitting your form",
  					icon: "error",
					showCloseButton: true
					})	
				}
            });
            return false;
        }
		
function updateShopDetails() {
            var fd = new FormData(document.getElementById("updateDetails"));
            $.ajax({
              url: "../php/editShopInfobyId.php",
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
				if (data == "success"){
				setTimeout(function() {
				swal({title: "Good Job!", text: "You updated your shop details", icon: "success"})
				.then(function() {
					location.reload();
				}); }, 1000);
				}else{
					swal({
					title: "Sorry!",
  					text: "There was a problem submitting your form",
  					icon: "error",
					showCloseButton: true
					})	
				}
            });
            return false;
        }

function countImage(){
	var id = $('#idshop').val();
	$.ajax({
		type: "POST",
		url: "../php/countImageShopbyId.php",
		data: "id="+id,
		success: function(data){
		if (data == 5){
			swal({
					title: "Sorry!",
  					text: "You already exceeded limit of uploading images",
  					icon: "error",
					showCloseButton: true
					})	
		
		}else{
			addImage();
		}
		
		}
	});
}


function addImage() {
            var fd = new FormData(document.getElementById("addImage"));
            $.ajax({
              url: "../php/addShopImagebyId.php",
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
				if (data == "success"){
				setTimeout(function() {
				swal({title: "Good Job!", text: "You added your image", icon: "success"})
				.then(function() {
					location.reload();
				}); }, 1000);
				}else if (data == "size"){
				setTimeout(function() {
				swal({title: "Sorry!", text: "Your image exceeds the maximum file size of 1 mb", icon: "error",showCloseButton: true})
				.then(function() {
					location.reload();
				}); }, 1000);
				}else{
					swal({
					title: "Sorry!",
  					text: "There was a problem submitting your form",
  					icon: "error",
					showCloseButton: true
					})	
				}
            });
            return false;
        }
		

    </script>

<script>
fetchShopProduct();
fetchOperatingHours();
fetchShopService();
fetchShopIcon();
fetchImage();

	function fetchShopIcon(){
	var output = '';
	var id = $('#idshop').val();
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
	fetchShopVerification();
	function fetchShopVerification(){
	var output = '';
	var output2 = '';
	var id = $('#id').val();
	var idshop = $('#idshop').val();
	$.ajax({
		type: "POST",
		url: "../php/fetchShopVerification.php",
		data: "id="+id+"&idshop="+idshop,
		success: function(data){
		var shop = JSON.parse(data);
		if (shop === undefined || shop.length == 0) {
			location.href = "Home.php";
		}else{
			for(var i in shop){
				output += shop[i].shopname
				output2 += shop[i].description
				}
		}

		}
	});
	
	}
	
	function fetchImage(){
	var output = '';
	var output1 = '';
	var x = 0;
	var id = $('#idshop').val();
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
											'<button class="btn btn-danger" onclick = "confirmDelwithImage('+'\''+shop[i].idshopimage+'\''+','+'\''+shop[i].image+'\''+','+'1'+')" ><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</button>'+
      										'</div>'+
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
	var id = $('#idshop').val();
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
										'<td style="width:10px;"><button class="btn btn-danger" onclick = "confirmDelwithImage('+'\''+shop[i].idshopproduct+'\''+','+'\''+shop[i].image+'\''+','+'2'+')" ><span class="glyphicon glyphicon-trash"></span></button>' +
								      '</tr>';
									  
									  
						}
						$("#mytableproduct").html(output);
		
		$( "#data" ).DataTable();
    },
    error: function() {
		location.reload();
    }

	
	});
	
	}
	
	
	function fetchShopService(){
	var output = '';
	var id = $('#idshop').val();
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
										'<td style="width:10px;"><button class="btn btn-danger" onclick = "confirmDelete('+'\''+shop[i].idshopservice+'\''+','+'1'+')" ><span class="glyphicon glyphicon-trash"></span></button>' +
										
								      '</tr>';
									  
									  
						}
						$("#mytableservice").html(output);
		
		$( "#data2" ).DataTable();
    },
    error: function() {
		location.reload();
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
	

	
function fetchOperatingHours(){
	var output = '';
	var id = $('#idshop').val();
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
										'<td style="width:10px;"><button class="btn btn-default" onclick = "openSched('+'\''+shop[i].idoperatinghours+'\''+')"><span class="glyphicon glyphicon-pencil"></span></button></td>' +
										'<td style="width:10px;"><button class="btn btn-danger" onclick = "confirmDelete('+'\''+shop[i].idoperatinghours+'\''+','+'2'+')" ><span class="glyphicon glyphicon-trash"></span></button>' +
								      '</tr>';
									  
									  
						}
						$("#operatinghours").html(output);
		
		}

	
	});
	
	}
	
function openSched(id){
	$('#idSched').val(id);
	$('#myModal3').modal('show');
	
}


function editShopDetail(){
	
	var idShopData = $('#idshop').val();
	$.ajax({
		type: "POST",
		url: "../php/fetchShopData.php",
		data: "idshop="+idShopData,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
				$(function () {
					$('#editDescription').val(shop[i].description);
					$('#editPhone').val(shop[i].phonenumber);
					$('#editTelephone').val(shop[i].telephonenumber);
					$('#editWebsite').val(shop[i].website);
					$('#editFacebook').val(shop[i].facebook);
					
				

				
				});
				$('#myModal5').modal('toggle');
		}
	}
	
});
}


</script>




</body>
</html>

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
  
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-light-blue-gradient">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Product</h4>
        </div>
        <div class="modal-body">
		<form method="post" id="addProduct"> 
        <input type="hidden" id="idShopP" name="idShopP" value="<?php echo $idShop ?>" />
        <div class="row">
        <div class="col-sm-9">
            <div class="form-group">
            <label>Product</label>
            <div class="form-group">
            	<input type="text" name="product" id="product" required class="form-control">
            </div></div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
            <label>Price</label>
            <div class="form-group">
            	<input type="text" name="productPrice" id="productPrice" placeholder="php" class="form-control">
            </div></div>
        </div>
		</div>
        <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" rows="4" id="description" name="description" required></textarea>
        </div></div>
        </div>
        <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
         <label>Add Image</label>
        <input type="file" name="file" id="file" required style="border:thin #DDD" accept="image/x-png,image/jpeg,image/jpg,image/png" >
        	</div></div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="confirmSubmit(1);" name="btnSubmit" class="btn btn-success" data-dismiss="modal">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-light-blue-gradient">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Service</h4>
        </div>
        <div class="modal-body">     
		<form method="post" id="addService"> 
        <input type="hidden" id="idShopS" name="idShopS" value="<?php echo $idShop ?>" />
        <div class="row">
        <div class="col-sm-9">
            <div class="form-group">
            <label>Service</label>
            <div class="form-group">
            	<input type="text" name="service" id="service" required class="form-control">
            </div></div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
            <label>Price</label>
            <div class="form-group">
            	<input type="text" name="servicePrice" id="servicePrice" placeholder="php" class="form-control">
            </div></div>
        </div>
		</div>

        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="confirmSubmit(2);" name="btnSubmit" class="btn btn-success" data-dismiss="modal">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-light-blue-gradient">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Insert Schedule</h4>
        </div>
        <div class="modal-body">     
		<form method="post" id="updateSched"> 
        <input type="hidden" id="idSched" name="idSched" />
        <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
            <label>Opening</label>
            <div class="form-group">
            	<input type="time" name="opening" id="opening" required class="form-control">
            </div></div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
            <label>Closing</label>
            <div class="form-group">
            	<input type="time" name="closing" id="closing" required class="form-control">
            </div></div>
        </div>
        
        
        </div>
        

        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="confirmSubmit(3);" name="btnSubmit" class="btn btn-success" data-dismiss="modal">Submit</button>
          
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



  <div class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-light-blue-gradient">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Image</h4>
        </div>
        <div class="modal-body">
		<form method="post" id="addImage"> 

        <input type="hidden" id="idShop" name="idShop" value="<?php echo $idShop ?>" />
       
        <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
        <input type="file" name="file1" id="file1" required style="border:thin #DDD" accept="image/x-png,image/jpeg,image/jpg,image/png" >
        	</div></div>
        </div>
        <div class="modal-footer">
        
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" onclick="confirmSubmit(5);" name="btnSubmit" class="btn btn-success" data-dismiss="modal">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="myModal5" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-light-blue-gradient">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Shop Details</h4>
        </div>
        <div class="modal-body" style="height:400px;">     
		<form method="post" id="updateDetails"> 
        <input type="hidden" id="idShopE" name="idShopE" value="<?php echo $idShop ?>" />
        <div class="col-md-12">
        <div class="form-group ">
  			<label for="usr">Phone Number:</label>
 			<input type="text" class="form-control" id="editPhone" name="editPhone">
		</div>
        
        <div class="form-group ">
  			<label for="usr">Telephone Number:</label>
 			<input type="text" class="form-control" id="editTelephone" name="editTelephone">
		</div>
        
        <div class="form-group ">
  			<label for="usr">Website:</label>
 			<input type="text" class="form-control" id="editWebsite" name="editWebsite">
		</div>
        
        <div class="form-group ">
  			<label for="usr">Facebook:</label>
 			<input type="text" class="form-control" id="editFacebook" name="editFacebook">
		</div>
        
        <div class="form-group">
  			<label for="comment">Description:</label>
  			<textarea class="form-control" rows="2" id="editDescription" name="editDescription"></textarea>
		</div>
        
		</div>
        </form>
        </div>
        <div class="modal-footer">
        
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" onclick="confirmSubmit(6);" name="btnSubmit" class="btn btn-success" data-dismiss="modal">Submit</button>
          
        </div>
      </div>
    </div>
  </div>
</div>


<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6Ls8aU5Ug11kHV6NTiGIsKXZLeU2A67U&callback=getShopData">
</script>