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
        <p style="font-size:30px; font-family: Tahoma, Geneva, sans-serif; font-weight:bolder;" id="pageHeader"><i class="fa fa-group"></i>&nbsp; Admin List</p>
		</div>
    </section>
    <section class="content container-fluid">
<input type="hidden" id="activation" name="activation" value="<?php echo $_SESSION['activation'] ?>">
<table id="data" class="display responsive nowrap dataTable no-footer dtr-inline collapsed table table-bordered table-striped textcenter" style="width:100%; border-color:black;">
        <thead class="bg-light-blue-gradient">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th style="max-width:30px;"></th>
                <th style="max-width:30px;"></th>
                <th style="max-width:30px;"></th>
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
fetchData();

	function fetchData(){
	var output = '';
	var output2 = '';
	$.ajax({
		type: "GET",
		url: "../php/fetchAllAdmin.php",
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			
							output += '<tr>' +
										
										'<td style="max-width:150px; class="col-md-6"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].name +'</span></td>' +
										'<td style="max-width:150px; class="col-md-6"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].email +'</span></td>' +
										'<td style="max-width:150px; class="col-md-6"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].activation +'</span></td>' +
										'<td style="width:10px;"><button class="btn btn-default bg-button" onclick = "viewData('+'\''+shop[i].idadmin+'\''+')"><span class="glyphicon glyphicon-search"></span></button></td>' +
										'<td style="width:10px;"><button class="btn btn-default" onclick = "updateActivation('+'\''+shop[i].idadmin+'\''+','+'\''+shop[i].activation+'\''+')" ><span class="glyphicon glyphicon-ok"</span></button></td>' +
										'<td style="width:10px;"><button class="btn btn-danger" onclick = "updateActivation('+'\''+shop[i].idadmin+'\''+','+'\''+"Deleted"+'\''+')" ><span class="glyphicon glyphicon-trash"></span></button>' +
									
								      '</tr>';
									  
									  
							output2 += '<tr>' +
										
										'<td style="max-width:150px; class="col-md-6"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].name +'</span></td>' +
										'<td style="max-width:150px; class="col-md-6"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].email +'</span></td>' +
										'<td style="max-width:150px; class="col-md-6"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].activation +'</span></td>' +
										'<td style="width:10px;"><button class="disabled btn btn-default bg-button " onClick="alertMe()"><span class="glyphicon glyphicon-search"></span></button></td>' +
										'<td style="width:10px;"><button class="disabled btn btn-default" onClick="alertMe()"><span class="glyphicon glyphicon-ok"</span></button></td>' +
										'<td style="width:10px;"><button class="disabled btn btn-danger" onclick = "alertMe()" ><span class="glyphicon glyphicon-trash"></span></button>' +
									
								      '</tr>';
									  
						}
									  var activation = $('#activation').val();
									  if (activation == "Main"){
									  $("#mytable").html(output);
									  }else{
									  $("#mytable").html(output2);
									  }
		
		$( "#data" ).DataTable();
    },
    error: function() {
        location.reload();
    }

	
	});
	
	}
	
	
function alertMe(){
	
	swal({
    title: "Sorry!",
      text: "You're not allowed to use this function",
      icon: "warning",
      showclosebutton :true
    })
	
}


function viewData(idData){
	$.ajax({
		type: "POST",
		url: "../php/fetchAdminbyId.php",
		data: "id="+idData,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
				$(function () {
					$('#usertd').html(shop[i].name);
					$('#addresstd').html(shop[i].address);
					$('#birthdaytd').html(shop[i].birthday);
					$('#numbertd').html(shop[i].number);
					$("#productimg").attr("src", "../uploads/profiles/"+shop[i].image);
					$('#myModal').modal('show');
	
	
	
	
					});
				}
		}
	});
	
	}


function updateActivation(idData,data){
	if (data == "Inactive"){
	swal({
		title: "Are you sure you want to activate this user?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			$.ajax({
			type: "POST",
			url: "../php/updateAdminActivationbyId.php",
			data: "id="+idData+"&data=Admin",
			success: function(data){
			
			if(data == 1){
				setTimeout(function() {
				swal({title: "Good Job!",text: "You activated a user",icon: "success",showclosebutton :true})
				.then(function() {
					location.reload();
				}); }, 1000);
			}else{
				swal({title: "Sorry!",text: "There was a problem in activating the user",icon: "error",showclosebutton :true})
			}
			}
		});	
				
			}else{
			swal.close()
			}
		});
		
	}else if (data == "Admin"){
	swal({
		title: "Are you sure you want to deactivate this user?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			$.ajax({
			type: "POST",
			url: "../php/updateAdminActivationbyId.php",
			data: "id="+idData+"&data=Inactive",
			success: function(data){
			
			if(data == 1){
				setTimeout(function() {
				swal({title: "Good Job!",text: "You activated a user",icon: "success",showclosebutton :true})
				.then(function() {
					location.reload();
				}); }, 1000);
			}else{
				swal({title: "Sorry!",text: "There was a problem in activating the user",icon: "error",showclosebutton :true})
			}
			}
		});	
				
			}else{
			swal.close()
			}
		});
	}else if (data == "Deleted"){
	swal({
		title: "Are you sure you want to delete this user?",
  		text: "Make sure to check first!",
  		icon: "warning",
  		buttons: [true,"Yes, I am sure"],
		})
		.then(function(isConfirm) {
			if (isConfirm){
			$.ajax({
			type: "POST",
			url: "../php/updateAdminActivationbyId.php",
			data: "id="+idData+"&data=Deleted",
			success: function(data){
			
			if(data == 1){
				setTimeout(function() {
				swal({title: "Good Job!",text: "You deleted a user",icon: "success",showclosebutton :true})
				.then(function() {
					location.reload();
				}); }, 1000);
			}else{
				swal({title: "Sorry!",text: "There was a problem in activating the user",icon: "error",showclosebutton :true})
			}
			}
		});	
				
			}else{
			swal.close()
			}
		});
	}else{
		swal({title: "Sorry!",text: "There was a problem!",icon: "error",showclosebutton :true})
	}
	
}


</script>


</body>
</html>

  <div class="modal fade" id="myModal" role="dialog" style="z-index:9500">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="border:1px solid;">
        <div class="modal-header bg-light-blue-gradient" style="padding:30px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div><h3 class="modal-title"><center>Admin Information</center></</h3></div>
        </div>
        <div class="modal-body">
  <div>
  <div class="row">
  <div class="col-md-3 col-lg-3 " align="center"> <img id="productimg" alt="User Pic" style="width:300px;display:block; height: auto; border:2px solid #113c94;" src="" class="img-responsive responsive-image "> </div>
  <div class=" col-md-9 col-lg-9 "> 
  <table class="mytable table" id="tableinfo">
        <thead class="bg-light-blue-gradient">  
        <tr>
        	<th class="col-md-2">Name</th>
        	<th class="col-md-9">Information</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        	<td >User</td>
            <td id="usertd"></td>
        </tr>
        <tr>
        	<td>Address</td>
            <td id="addresstd"></td>
        </tr>
        <tr>
        	<td>Birthday</td>
            <td id="birthdaytd"></td>
        </tr>
        <tr>
        	<td>Number</td>
            <td id="numbertd"></td>
        </tr>
        </tbody>
  </table>
  </div>

        <div class="modal-footer">
        
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
