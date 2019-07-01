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
<input type="hidden" value="Car Aircon" name="category" id="category" />
<?php include 'navigationBar.php';?>
  <div class="content-wrapper">
    <section class="content-header">
		<div class="well well-lg well-gradient">
        <p style="font-size:30px; font-family: Tahoma, Geneva, sans-serif; font-weight:bolder;" id="pageHeader"><i class="fa fa-cog"></i>&nbsp;</p>
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
                <th></th>
                <th></th>
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
$(document).ready(function() {
	var myheader = $('#category').val();
	document.getElementById('pageHeader').innerHTML += myheader
} );

</script>
<script>

var mylat = '';
var mylng = '';
fetchData();

	function fetchData(){
	var output = '';
	var category = $('#category').val();
	$.ajax({
		type: "POST",
		url: "../php/fetchActiveShopbyCategory.php",
		data: "category="+category,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			
							output += '<tr>' +
										'<td style="width:135px;"><center><img src="../uploads/'+ shop[i].shopicon +'"class="responsive" /></center></td>' +
										'<td style="max-width:135px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].shopname +'</span></td>' +
										'<td style="max-width:180px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].shoptype +'</span></td>' +
										'<td style="max-width:150px;"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].name +'</span></td>' +
										'<td style="width:10px;"><button class="btn btn-default" onclick = "viewShopData('+'\''+shop[i].idshop+'\''+')"><span class="glyphicon glyphicon-search"></span></button></td>' +
										'<td style="width:10px;"><button class="btn btn-edit" data-toggle="modal" data-target="#myModal2" onclick = "getID('+'\''+shop[i].idshop+'\''+')" ><span class="glyphicon glyphicon-trash"></span></button>' +
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
					$('#shopownertd').attr("href", 'shopOwnerInformation.php?cnf='+'\''+window.btoa(shop[i].shopowner_idshopowner)+'\''+'')
					$('#shopinfo').attr("href", 'shopInfo.php?cnf=='+'\''+window.btoa(shop[i].idshop)+'\''+'')
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
	
	function getID(shopID){
		$('#shopID').val(shopID);
		
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
           success: function(data)
           {
			   
			   if (data == "error"){
				setTimeout(function() {
				swal({title: "Sorry!", text: "There was a problem in submitting your review", icon: "error"})
				.then(function() {
					location.reload();
				}); }, 1000);
				
				}else if (data == "success"){
				setTimeout(function() {
				swal({title: "Good Job!", text: "Successfully Submitted your Review", icon: "success"})
				.then(function() {
					location.reload();
				}); }, 1000);
				};
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
        
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <a target="_blank" rel="noopener noreferrer" id="shopinfo"><button class="btn btn-success"><span class="glyphicon glyphicon-search"></span>&nbsp;View Full Information</button></a>
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
          <button type="button" class="btn btn-edit" onClick="confirmReview()">Submit</button>
          <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6Ls8aU5Ug11kHV6NTiGIsKXZLeU2A67U&callback=viewShopData">
</script>