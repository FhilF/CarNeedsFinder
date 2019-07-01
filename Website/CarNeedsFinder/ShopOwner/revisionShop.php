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



</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<input type="hidden" id="activation" name="activation" value="Revision" />

  <?php include 'navigationBar.php' ?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="well well-lg bg-myblue-color"><p style="font-size:30px; font-weight:bold; font-family:Arial, Helvetica, sans-serif;" id="pageHeader">For Revision Shops</p>
    </section>
    <section class="content container-fluid">
    
<table id="data" class="display responsive nowrap dataTable no-footer dtr-inline collapsed table table-bordered table-striped" style="width:100%; border-color:black;">
        <thead class=" bg-light-blue-gradient">
            <tr>
            	<th></th>
                <th>Shop Name</th>
                <th>Shop Type</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
 
        <tbody id="mytable">


</tbody>
</table>
        
    </section>
  </div>
<?php include 'footer.php' ?>

</div>

<script src="../bootstrap/js/adminlte.min.js"></script>

<script>
function confirmDelete(id){
	swal({
		title: "Are you sure you want to delete this?",
  		text: "Make sure you've already check the information of this Shop",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			deleteShop(id);
			}else{
			swal.close()
			}
		});
}
function deleteShop(id){
	var idshop = id;
	$.ajax({
		type: "POST",
		url: "../php/updateActivation.php",
		data: "shopID="+idshop+"&activation=User Deleted",
		success: function(msg){
			if(msg == 1){
				setTimeout(function() {
				swal({title: "Good Job!", text: "Successfully deleted your shop", icon: "success"})
				.then(function() {
					window.location = "revisionShop.php";
				}); }, 1000);
				}else{
				setTimeout(function() {
				swal({title: "Sorry!", text: "There was a problem submitting your request", icon: "error"})
				.then(function() {
					window.location = "revisionShop.php";
				}); }, 1000);
					
					
					
				}
           }
         });
			}

</script>

<script>


var mylat = '';
var mylng = '';
fetchData();

	function fetchData(){
	var output = '';
	var id = $('#id').val();
	var activation = $('#activation').val();
	$.ajax({
		type: "POST",
		url: "../php/fetchShopbyOwner.php",
		data: "id="+id+"&activation="+activation,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			
							output += '<tr>' +
										'<td style="width:135px;"><center><img src="../uploads/'+ shop[i].shopicon +'"class="responsive" /></center></td>' +
										'<td style="max-width:135px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].shopname +'</span></td>' +
										'<td style="max-width:180px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].shoptype +'</span></td>' +
										'<td style="width:10px;"><button class="btn btn-default" onclick = "viewShopData('+'\''+shop[i].idshop+'\''+')"><span class="glyphicon glyphicon-search"></span></button></td>' +
										'<td style="width:10px;"><a href="forRevisionShop.php?cnf='+'\''+window.btoa(shop[i].idshop)+'\''+'"><button class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></button></a></td>' +
										'<td style="width:10px;"><button class="btn btn-danger" onclick = "confirmDelete('+'\''+shop[i].idshop+'\''+')" ><span class="glyphicon glyphicon-trash"></span></button>' +
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
					$('#permittd').html(shop[i].businesspermitno);
					
					
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
	var output = '';
	$.ajax({
		type: "POST",
		url: "../php/fetchAdminReviewbyId.php",
		data: "idshop="+idShopData,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			
							output +=  shop[i].comment2 +'&#13;&#10;&#13;&#10;' ;
									  
									  $("#history").html(output);
						}
		
		}

	
	});
	}

</script>


</body>
</html>


  <div class="modal fade" id="myModal" role="dialog" style="z-index:10000">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div><h4 class="modal-title">Shop Information</h4></div>
        </div>
        <div class="modal-body">
  <div>
  <table class="mytable table table-bordered">
        <thead>        
        <tr>
        	<th class="col-md-2">Name</th>
        	<th class="col-md-9">Information</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        	<td>Shop Name</td>
            <td id="shopnametd"></td>
        </tr>
        <tr>
        	<td>Shop Type</td>
            <td id="shoptypetd"></td>
        </tr>
        <tr>
        	<td>Description</td>
            <td id="descriptiontd"></td>
        </tr>
        <tr>
        	<td>Address</td>
            <td id="addresstd"></td>
        </tr>
        <tr>
        	<td>Phone Number</td>
            <td id="phonetd"></td>
        </tr>
        <tr>
        	<td>Telephone Number</td>
            <td id="telephonetd"></td>
        </tr>
        <tr>
        	<td>Website</td>
            <td id="websitetd"></td>
        </tr>
        <tr>
        	<td>Facebook</td>
            <td id="facebooktd"></td>
        </tr>
        <tr>
        	<td>Business Permit No.</td>
            <td id="permittd"></td>
        </tr>
        </tbody>
  </table>
  </div>
        <hr>
        <h3>Location</h3>
		<div class="row">
       	  <div class="col-md-6">
          <div id="map" style="width:100%;height:300px; border:solid 1px;"></div>
		  </div>
          <div class="col-md-6">
          <div id="map2" style="width:100%;height:300px; border:solid 1px;"></div>
		  </div>
		</div>
        <h3>
        <div class="form-group">
  			<label for="comment">History</label>
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