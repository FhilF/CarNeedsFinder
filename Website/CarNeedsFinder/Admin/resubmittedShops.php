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
      <p style="font-size:25px;font-family: Tahoma, Geneva, sans-serif; font-weight:bolder;" id="pageHeader"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;Resubmitted Shops</p>
      <small><span class="glyphicon glyphicon-alert"></span> Please make sure to check the information before making an action</small>
      <a href="revisionShops.php"><button type="button" class="btn btn-edit pull-right">Show For Revision Shop List</button></a>
      <br>
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
                <th style="max-width:35px;"><small>Activate</small></th>
                <th style="max-width:35px;"><small>Review</small></th>
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

var mylat = '';
var mylng = '';
fetchData();

	function fetchData(){
	var output = '';
	$.ajax({
		type: "POST",
		data: "activation=Resubmitted",
		url: "../php/fetchActiveShopbyActivation.php",
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			
							output += '<tr>' +
										'<td style="width:135px;"><center><img src="../uploads/'+ shop[i].shopicon +'"class="responsive" /></center></td>' +
										'<td style="max-width:135px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].shopname +'</span></td>' +
										'<td style="max-width:180px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].shoptype +'</span></td>' +
										'<td style="max-width:150px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].name +'</span></td>' +
										'<td style="width:10px;"><button class="btn btn-default bg-button" onclick = "viewShopData('+'\''+shop[i].idshop+'\''+')"><span class="glyphicon glyphicon-search"></span></button></td>' +
										'<td style="width:10px;"><button class="btn btn-default" onclick = "confirmActivate('+'\''+shop[i].idshop+'\''+')" ><span class="glyphicon glyphicon-ok"</span></button></td>' +
										'<td style="width:10px;"><button class="btn btn-edit" onclick = "openReview('+'\''+shop[i].idshop+'\''+')"><span class="glyphicon glyphicon-pencil"></span></button>' +
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
	
	function openReview(idShop){
		$(document).ready(function() {
		$('#shopID').val(idShop)
		$('#myModal2').modal('show');
		});
		
	}
	
	
function viewShopData(idData){
	var output = '';
	var idShopData = idData;
	$.ajax({
		type: "POST",
		url: "../php/fetchShopData.php",
		data: "idshop="+idShopData,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
				$(function () {
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
					if(shop[i].shopicon == null){
					$("#shopimage").attr("src","../uploads/noimage.png");
				}else{
					$("#shopimage").attr("src",'../uploads/'+shop[i].shopicon+'');
				}
					
					
				setTimeout(function() {
					$('#myModal').modal('show');
					var myCenter = new google.maps.LatLng(mylat, mylng);
  					var mapCanvas = document.getElementById("mapview");
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
    					document.getElementById('mapstreet'), panoOptions);

    				$('#myModal').on('shown.bs.modal', function () {
						google.maps.event.trigger(map, "resize");
    					google.maps.event.trigger(panorama, "resize");
    					});
						
						}, 500);

				});
				}
		}
	});
	
	
	var output2 = '';
	$.ajax({
		type: "POST",
		url: "../php/fetchShopCopyData.php",
		data: "idshop="+idShopData,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
				$(function () {
					mylat2 = shop[i].latitude;
					mylng2 = shop[i].longitude;
					$('#shopnametdcopy').html(shop[i].shopname);;
					$('#shoptypetdcopy').html(shop[i].shoptype);
					$('#descriptiontdcopy').html(shop[i].description);
					$('#addresstdcopy').html(shop[i].shopaddress);
					$('#phonetdcopy').html(shop[i].phonenumber);
					$('#telephonetdcopy').html(shop[i].telephonenumber);
					$('#websitetdcopy').html(shop[i].website);
					$('#facebooktdcopy').html(shop[i].facebook);
					if(shop[i].shopicon == null){
					$("#shopimagecopy").attr("src","../uploads/noimage.png");
				}else{
					$("#shopimagecopy").attr("src",'../uploads/'+shop[i].shopicon+'');
				}
					
					
					});
				setTimeout(function() {
					$('#myModal').modal('show');
					var myCenter = new google.maps.LatLng(mylat2, mylng2);
  					var mapCanvas = document.getElementById("mapview2");
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
    					document.getElementById('mapstreet2'), panoOptions);

    				$('#myModal').on('shown.bs.modal', function () {
						google.maps.event.trigger(map, "resize");
    					google.maps.event.trigger(panorama, "resize");
    					});
						
						}, 500);
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


  <div class="modal fade" id="myModal" role="dialog" style="z-index:9500">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="border:1px solid;">
        <div class="modal-header bg-light-blue-gradient" style="padding:30px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div><h3 class="modal-title"><center>Shop Information</center></</h3></div>
        </div>
        <div class="modal-body" style="margin-top:10px;">
  <div>
        <div class="modal-body">
  <div>
  <table class="mytable table" id="tableinfo">
        <thead class="bg-light-blue-gradient">
        <tr>
        	<th class="col-md-2">Name</th>
        	<th class="col-md-5">Data</th>
        	<th class="col-md-5">Old Data</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        	<td><strong>Shop Owner</strong></td>
            <td id="shopownertd"></td>
            <td></td>
        </tr>
        <tr>
        	<td><strong>Shop Icon</strong></td>
            <td id=""><img id="shopimage" alt="User Pic" style="width:150px;display:block; height: auto; border:2px solid #113c94;" src="" class="img-responsive responsive-image "></td>
            <td id=""><img id="shopimagecopy" alt="User Pic" style="width:150px;display:block; height: auto; border:2px solid #113c94;" src="" class="img-responsive responsive-image "></td>
        </tr>
        <tr>
        	<td><strong>Shop Name</strong></td>
            <td id="shopnametd"></td>
            <td id="shopnametdcopy"></td>
        </tr>
        <tr>
        	<td><strong>Shop Type</strong></td>
            <td id="shoptypetd"></td>
            <td id="shoptypetdcopy"></td>
        </tr>
        <tr>
        	<td><strong>Description</strong></td>
            <td id="descriptiontd"></td>
            <td id="descriptiontdcopy"></td>
        </tr>
        <tr>
        	<td><strong>Address</strong></td>
        	<td id="addresstd"></td>
            <td id="addresstdcopy"></td>
        </tr>
        <tr>
        	<td><strong>Phone</strong></td>
            <td id="phonetd"></td>
            <td id="phonetdcopy"></td>
        </tr>
        <tr>
        	<td><strong>Telephone</strong></td>
            <td id="telephonetd"></td>
            <td id="telephonetdcopy"></td>
        </tr>
        <tr>
        	<td><strong>Website</strong></td>
            <td id="websitetd"></td>
            <td id="websitetdcopy"></td>
        </tr>
        <tr>
        	<td><strong>Facebook</strong></td>
            <td id="facebooktd"></td>
            <td id="facebooktdcopy"></td>
        </tr>
        </tbody>
  </table>
  </div>
        <hr>
        <div class="bg-light-blue-gradient">
        <h3 style="padding:5px;">Location</h3>
        </div>
		<div class="row">
       	  <div class="col-md-6">
          <header><h4 style="font-weight:bolder">Data</h4></header>
          <div id="mapview" style="width:100%;height:300px;border:2px solid #113c94;"></div>
		  </div>
          <div class="col-md-6">
          <header><h4 style="font-weight:bolder">Old Data</h4></header>
          <div id="mapview2" style="width:100%;height:300px;border:2px solid #113c94;"></div>
          
		  </div>
		</div>
        <div class="row">
       	  <div class="col-md-6">
          <header><h4 style="font-weight:bolder">Data</h4></header>
          <div id="mapstreet" style="width:100%;height:300px;border:2px solid #113c94;"></div>
		  </div>
          <div class="col-md-6">
          <header><h4 style="font-weight:bolder">Old Data</h4></header>
          <div id="mapstreet2" style="width:100%;height:300px;border:2px solid #113c94;"></div>
		  </div>
		</div>
        
        <hr>
        <div class="bg-light-blue-gradient">
        <h4 style="padding:10px;">History</h4>
        </div>
        <div class="form-group">

  			<textarea class="form-control" rows="5" id="history" name="history" disabled>
			</textarea>
		</div>

        </div>

        <div class="modal-footer">
        
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6Ls8aU5Ug11kHV6NTiGIsKXZLeU2A67U&callback=viewShopData">
</script>

