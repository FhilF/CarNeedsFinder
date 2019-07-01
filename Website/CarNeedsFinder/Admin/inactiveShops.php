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

</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include 'navigationBar.php';?>
  <div class="content-wrapper">
    <section class="content-header">
    <div class="well well-lg well-gradient">
      <p style="font-size:25px;font-family: Tahoma, Geneva, sans-serif; font-weight:bolder;" id="pageHeader"><i class="fa fa-folder-o"></i>&nbsp;Inactive Shops</p>
      <small><span class="glyphicon glyphicon-alert"></span>&nbsp;Please mark shops as read to alert shop owners that their shop is being reviewed and to be able to make action</small><br>
      </div>

      

    </section>
    <section class="content container-fluid">
    
<table id="data" class="display responsive nowrap dataTable no-footer dtr-inline collapsed table table-bordered table-striped textcenter" style="width:100%; border-color:black;">
        <thead class="bg-light-blue-gradient">
            <tr>
            	<th></th>
                <th>Shop Name</th>
                <th>Shop Type</th>
                <th>Shop Owner</th>
                <th style="max-width:35px;"><small>View</small></th>
            </tr>
        </thead>
 
        <tbody id="mytable">


</tbody>
</table>
        
    </section>
  </div>
 <?php include 'footer.php';?>
</div>

<script src="../bootstrap/js/adminlte.min.js"></script>
<script>
function confirmActivate(id){
	swal({
		title: "Are you sure?",
  		text: "Make sure you've already check the information of this Shop",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			activateShop(id);
			}else{
			swal.close()
			}
		});
}

function confirmReview(){
	var check = $('#review').val();
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

var mylat = '';
var mylng = '';
fetchData();

	function fetchData(){
	var output = '';
	$.ajax({
		type: "GET",
		url: "../php/fetchInactiveShop.php",
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			
							output += '<tr>' +
										'<td style="width:135px;"><center><img src="../uploads/'+ shop[i].shopicon +'"class="responsive" /></center></td>' +
										'<td style="max-width:135px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].shopname +'</span></td>' +
										'<td style="max-width:180px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].shoptype +'</span></td>' +
										'<td style="max-width:150px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].name +'</span></td>' +
										'<td style="width:10px;"><button class="btn btn-default bg-button" onclick = "viewShopData('+'\''+shop[i].idshop+'\''+')"><span class="glyphicon glyphicon-search"></span></button></td>' +
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
	
	
	function viewShopData(idData){
	var idShopData = idData;
	var output = "";
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
					$('#descriptiontd').html(shop[i].description);
					$('#addresstd').html(shop[i].shopaddress);
					$('#phonetd').html(shop[i].phonenumber);
					$('#telephonetd').html(shop[i].telephonenumber);
					$('#websitetd').html(shop[i].website);
					$('#facebooktd').html(shop[i].facebook);
					$('#shopID').val(idShopData);
					if(shop[i].shopicon == null){
					$("#shopimage").attr("src","../uploads/noimage.png");
				}else{
					$("#shopimage").attr("src",'../uploads/'+shop[i].shopicon+'');
				}
					
					
				setTimeout(function() {
					$('#myModal').modal('show');
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

    				$('#myModal').on('shown.bs.modal', function () {
						google.maps.event.trigger(map, "resize");
    					google.maps.event.trigger(panorama, "resize");
    					});
						
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
	
	function activateShop(id){
	var idshop = id; 
	var comment = "Your Shop is now activated. You may now add your products and services to your shop, Thank You!"
	var idadmin = $('#idadmin').val();
	$.ajax({
		type: "POST",
		url: "../php/addAdminReview.php",
		data: "shopID="+idshop+"&comment="+comment+"&activation=Active"+"&idadmin="+idadmin,
		success: function(msg){
			if(msg == "success"){
				setTimeout(function() {
				swal({title: "Good Job!", text: "Successfully submitted your review", icon: "success"})
				.then(function() {
					window.location = "inactiveShops.php";
				}); }, 1000);
				}else{
				setTimeout(function() {
				swal({title: "Sorry!", text: "There was a problem submitting your review", icon: "error"})
				.then(function() {
					window.location = "inactiveShops.php";
				}); }, 1000);
					
					
					
				}
           }
         });
	}
			
	function markReadShop(){
	var idshop = $('#shopID').val();
	var shop = $('#shopnametd').text();
	var comment = "Your Shop is being reviewed by the Admin, Thank You!";
	var idadmin = $('#idadmin').val();
	$.ajax({
		type: "POST",
		url: "../php/addAdminReview.php",
		data: "shopID="+idshop+"&comment="+comment+"&activation=Marked"+"&idadmin="+idadmin,
		success: function(msg){
			if(msg == "success"){
				setTimeout(function() {
				swal({title: "Good Job!", text: "Shop is Mark As Read", icon: "success"})
				.then(function() {
					window.location = "inactiveShops.php";
				}); }, 1000);
				}else{
				setTimeout(function() {
				swal({title: "Sorry!", text: "There was a problem", icon: "error"})
				.then(function() {
					window.location = "inactiveShops.php";
				}); }, 1000);
					
					
					
				}
           }
         });
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
					window.location = "inactiveShops.php";
				}); }, 1000);
				}else{
				setTimeout(function() {
				swal({title: "Sorry!", text: "There was a problem submitting your review", icon: "error"})
				.then(function() {
					window.location = "inactiveShops.php";
				}); }, 1000);
					
					
					
				}
           }
         });
			}



</script>


</body>
</html>

  
<div class="modal fade" id="myModal" role="dialog" style="z-index:9500">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="border:1px solid;">
        <div class="modal-header bg-light-blue-gradient" style="padding:30px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div><h3 class="modal-title"><center>Shop Information</center></</h3></div>
        </div>
        <div class="modal-body" style="margin-top:10px;">
  <div>
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

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-edit" onClick="markReadShop()">Mark as Read</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="myModal2" role="dialog">
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
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6Ls8aU5Ug11kHV6NTiGIsKXZLeU2A67U&callback=viewShopData">
</script>

