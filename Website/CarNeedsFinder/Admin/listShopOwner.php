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
      <p style="font-size:30px; font-weight:bolder" id="pageHeader">Shop Owners</p>
    </section>
    <section class="content container-fluid">
    
<table id="data" class="display responsive nowrap dataTable no-footer dtr-inline collapsed table table-bordered table-striped textcenter" style="width:100%; border-color:black;">
        <thead class="bg-light-blue-gradient">
            <tr>
                <th>Name</th>
                <th>Email</th>
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
	$('#pageHeader').html(myheader);
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
		type: "GET",
		url: "../php/fetchAllShopOwner.php",
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
			
							output += '<tr>' +
										
										'<td style="max-width:150px; class="col-md-6"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden"><a target="_blank" rel="noopener noreferrer" href="shopOwnerInformation.php?cnf='+'\''+window.btoa(shop[i].idshopowner)+'\''+'">'+ shop[i].name +'</a></span></td>' +
										'<td style="max-width:150px; class="col-md-6"><span style=" text-overflow: ellipsis; break-word: break-word ; display: block;  overflow: hidden">'+ shop[i].email +'</span></td>' +
									
								      '</tr>';
									  
									  
						}
						$("#mytable").html(output);
	$( "#data" ).DataTable();
    },
    error: function() {
        location.reload();
    }
	
	});
	
	}
	

</script>


</body>
</html>
