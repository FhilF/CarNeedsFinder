<?php
session_start();
if ($_SESSION['account'] != '1'){
	header('Location: ../loginAdmin.php');
}else{
$idadmin = $_SESSION['idadmin'];
$name = $_SESSION['name'];
$image = $_SESSION['image'];	
}

$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = basename($_SERVER['PHP_SELF'], ".php");
?>
<style>
.btn-edit { 
  color: #FFFFFF; 
  background-color: #214685; 
  border-color: #130269; 
} 
 
.btn-edit:hover, 
.btn-edit:focus, 
.btn-edit:active, 
.btn-edit.active, 
.open .dropdown-toggle.btn-edit { 
  color: #FFFFFF; 
  background-color: #233C7A; 
  border-color: #130269; 
} 
 
.btn-edit:active, 
.btn-edit.active, 
.open .dropdown-toggle.btn-edit { 
  background-image: none; 
} 
 
.btn-edit.disabled, 
.btn-edit[disabled], 
fieldset[disabled] .btn-edit, 
.btn-edit.disabled:hover, 
.btn-edit[disabled]:hover, 
fieldset[disabled] .btn-edit:hover, 
.btn-edit.disabled:focus, 
.btn-edit[disabled]:focus, 
fieldset[disabled] .btn-edit:focus, 
.btn-edit.disabled:active, 
.btn-edit[disabled]:active, 
fieldset[disabled] .btn-edit:active, 
.btn-edit.disabled.active, 
.btn-edit[disabled].active, 
fieldset[disabled] .btn-edit.active { 
  background-color: #214685; 
  border-color: #130269; 
} 
 
.btn-edit .badge { 
  color: #214685; 
  background-color: #FFFFFF; 
}

#history {
    overflow-y: scroll;
    height: 100px;
    resize: none;
}

.well-gradient{
background: rgba(235,233,249,1);
background: -moz-linear-gradient(top, rgba(235,233,249,1) 0%, rgba(216,223,234,0.92) 17%, rgba(175,189,212,0.76) 51%, rgba(59,88,152,0.52) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(235,233,249,1)), color-stop(17%, rgba(216,223,234,0.92)), color-stop(51%, rgba(175,189,212,0.76)), color-stop(100%, rgba(59,88,152,0.52)));
background: -webkit-linear-gradient(top, rgba(235,233,249,1) 0%, rgba(216,223,234,0.92) 17%, rgba(175,189,212,0.76) 51%, rgba(59,88,152,0.52) 100%);
background: -o-linear-gradient(top, rgba(235,233,249,1) 0%, rgba(216,223,234,0.92) 17%, rgba(175,189,212,0.76) 51%, rgba(59,88,152,0.52) 100%);
background: -ms-linear-gradient(top, rgba(235,233,249,1) 0%, rgba(216,223,234,0.92) 17%, rgba(175,189,212,0.76) 51%, rgba(59,88,152,0.52) 100%);
background: linear-gradient(to bottom, rgba(235,233,249,1) 0%, rgba(216,223,234,0.92) 17%, rgba(175,189,212,0.76) 51%, rgba(59,88,152,0.52) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ebe9f9', endColorstr='#3b5898', GradientType=0 );

border:solid #5872a7;
}
#data.table.table-bordered{
    border:1px solid #006aa7;
	
    margin-top:20px;
  }
#data.table.table-bordered > thead > tr > th{
    border:1px solid #006aa7;
}
#data.table.table-bordered > tbody > tr > td{
    border:1px solid #006aa7;
}

#tableinfo.table.table-bordered{
    border:2px solid #0d8513;
	
    margin-top:20px;
  }
#tableinfo.table.table-bordered > thead > tr > th{
    border:2px solid #0d8513;
}
#tableinfo.table.table-bordered > tbody > tr > td{
    border:2px solid #0d8513;
}

</style>

  <header class="main-header">

    <a href="Home.php" class="logo">
      <span class="logo-mini"><b>CN</b>F</span>
      <span class="logo-lg" style="font-family:Arial, Helvetica, sans-serif"><strong>CarNeeds</strong>Finder</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation" bs-navbar>
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        

          <li class="dropdown messages-menu" onclick="seenShopReportMessage();">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bullhorn"></i>
              <span class="label label-warning" id="shopreportcount"></span>
            </a>
            <ul class="dropdown-menu" style="width:330px;">
              <li class="header" style="font-weight:bold"><center>User Shop Report</center></li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu" id="shopreport">
                  
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href="#">Messages</a></li>
            </ul>
          </li>
          
          <li class="dropdown messages-menu" onclick="seenReviewReportMessage();">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-commenting-o"></i>
              <span class="label label-warning" id="reviewreportcount"></span>
            </a>
            <ul class="dropdown-menu" style="width:330px;">
              <li class="header" style="font-weight:bold"><center>Feedback Report</center></li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu" id="rateandfeedback">

                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href="#">Messages</a></li>
            </ul>
          </li>
          
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../uploads/profiles/<?php echo $image ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $name ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="../uploads/profiles/<?php echo $image ?>" width="60" height="60" class="img-circle" alt="User Image">
                <p>
                  <?php echo $name ?><br>
				 <small>Administrator</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <a href="../loginAdmin.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="glyphicon glyphicon-inbox"></i><span class="label label-warning" id="notifcount"></span></a>
            
          </li>
            
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../uploads/profiles/<?php echo $image ?>" width="60" height="60" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $name ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree" >
      <li class="header">Main Navigation</li>
        <li class="<?php if ($page=="Home") {echo "active"; } else  {echo "noactive";}?>"><a href="Home.php"><i class="fa fa-desktop"></i> <span>Home</span></a></li>
        
        
        <?php if($_SESSION['activation'] == "Main"){
			echo '<li><a href="registerAdmin.php"><i class="glyphicon glyphicon-user"></i> <span>Register Admin</span></a></li>';
			
		}?>
      <li class="<?php if ($page=="listAdmin" || $page=="listShopOwner" || $page=="listUser" ) {echo "active"; } else  {echo "noactive";}?> treeview">
          <a href="#"><i class="fa fa-user-o"></i> <span>Users</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
          	<li class="<?php if ($page=="listAdmin") {echo "active"; } else  {echo "noactive";}?>"><a href="listAdmin.php"><i class="fa fa-group"></i><span>Admins</span></a></li>
            <li class="<?php if ($page=="listShopOwner") {echo "active"; } else  {echo "noactive";}?>"><a href="listShopOwner.php"><i class="fa fa-drivers-license-o"></i><span>Shop Owners</span></a></li>
          </ul>
        </li>
        <li class="header" ng-controller="HeaderController">Shop Menu</li>
        <li id="shopList" class="<?php if ($page=="gasStation" || $page=="autoMechanic" || $page=="carAccessories" || $page=="carWash" || $page=="tireSupply" || $page=="carAircon") {echo "active"; } else  {echo "noactive";}?> treeview">
          <a href="#">
            <i class="fa fa-folder-open-o"></i> <span>Active Shops</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($page=="gasStation") {echo "active"; } else  {echo "noactive";}?>"><a href="gasStation.php"><i class="fa fa-tint"></i> Gas Station</a></li>
            <li class="<?php if ($page=="autoMechanic") {echo "active"; } else  {echo "noactive";}?>"><a href="autoMechanic.php"><i class="fa fa-wrench"></i> Auto Mechanic</a></li>
            <li class="<?php if ($page=="carAccessories") {echo "active"; } else  {echo "noactive";}?>"><a href="carAccessories.php"><i class="ion ion-pricetag"></i> Car Accessories</a></li>
            <li class="<?php if ($page=="carWash") {echo "active"; } else  {echo "noactive";}?>"><a href="carWash.php"><i class="fa fa-bath"></i> Car Wash</a></li>
            <li class="<?php if ($page=="tireSupply") {echo "active"; } else  {echo "noactive";}?>"><a href="tireSupply.php"><i class="glyphicon glyphicon-cd"></i> Tire Supply</a></li>
            <li class="<?php if ($page=="carAircon") {echo "active"; } else  {echo "noactive";}?>"><a href="carAircon.php"><i class="fa fa-cog"></i> Car Aircon</a></li>
          </ul>
        </li>
        <li class="<?php if ($page=="inactiveShops" || $page=="markedShops" || $page=="revisionShops" ||$page=="resubmittedShops") {echo "active"; } else  {echo "noactive";}?> treeview">
          <a href="#">
            <i class="fa fa-send-o"></i> <span>Pending Shops</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($page=="inactiveShops") {echo "active"; } else  {echo "noactive";}?>"><a href="inactiveShops.php"><i class="fa fa-folder-o"></i> Inactive Shops</a></li>
            <li class="<?php if ($page=="markedShops" ) {echo "active"; } else  {echo "noactive";}?>"><a href="markedShops.php"><i class="glyphicon glyphicon-eye-open"></i> Marked Shops</a></li>
            <li class="<?php if ($page=="resubmittedShops" || $page=="revisionShops") {echo "active"; } else  {echo "noactive";}?>"><a href="resubmittedShops.php"><i class="glyphicon glyphicon-folder-open"></i> Resubmitted Shops</a></li>
            
          </ul>
        </li>
        <li class="<?php if ($page=="userShopReports") {echo "active"; } else  {echo "noactive";}?>"><a href="userShopReports.php"><i class="fa fa-bullhorn"></i> <span>User Shop Reports</span></a></li>
        <li class="<?php if ($page=="feedbackReports") {echo "active"; } else  {echo "noactive";}?>"><a href="feedbackReports.php"><i class="fa fa-commenting-o"></i> <span>Feedback Reports</span></a></li>
        <li class="<?php if ($page=="deletedShops") {echo "active"; } else  {echo "noactive";}?>"><a href="deletedShops.php"><i class="glyphicon glyphicon-trash"></i> <span>Deleted Shops</span></a></li>
      </ul>
    </section>
  </aside>


<script>
$(document).ready(function(){
    $('#getPending').on( "click", function() {
        $('#sidebarheader').html("Pending Applications");
		
    });
	
	$('#getResubmit').on( "click", function() {
        $('#sidebarheader').html("Resubmit Count");
		
    });
});

countReviewReportMessage();
fetchReportReviewbyState();
fetchShopReports();
countShopReport();
function countReviewReportMessage(){
	$.ajax({
		type: "POST",
		url: "../php/countShopReviewReport.php",
		success: function(data){
		if (data == 0){
		$('#reviewreportcount').html("");
		}else{
		$('#reviewreportcount').html(data);
		}
		
		}
	});
}
function seenReviewReportMessage(){
	$.ajax({
		type: "POST",
		url: "../php/updateShopReviewAdminState.php",
		success: function(data){
				countReviewReportMessage();
				
		}
	});
}

function seenShopReportMessage(){
	$.ajax({
		type: "POST",
		url: "../php/updateShopReportAdminState.php",
		success: function(data){
				countShopReport();
				
		}
	});
}


	
function fetchReportReviewbyState(){
	var output = '';
	var active = '';
	$.ajax({
		type: "POST",
		url: "../php/fetchRateandReviewReportbyState.php",
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
				if (shop[i].adminstate == 0){
					active = '#f4f4f4';
				}else{
					active = '#ffffff';	
				}
				
				output += '<li style="background-color:'+ active +'">' +
                    '<a href="#">' +
                      '<div class="pull-left">' + 
                        '<img src="../uploads/profiles/admin.png" class="img-circle" alt="User Image">'+
                      '</div>'+
                      '<h4>'+
                        shop[i].firstname + " " +shop[i].lastname+
                        '<small><i class="fa fa-calendar"></i>&nbsp;'+shop[i].datereported+'</small>'+
						
                      '</h4>'+
					  '<small>'+shop[i].shopname+'</small>'+
                      '<p class="wordWrap" style="white-space: nowrap; width:250px; overflow: hidden;text-overflow: ellipsis; ">'+ shop[i].rate +'<span class="glyphicon glyphicon-star"></span>&nbsp;-&nbsp;'+ shop[i].comment +'</p>'+
                    '</a>'+
                  '</li>';

								
									  

						}
						$('#rateandfeedback').html(output);
		
		}

	
	});
	
	}
	
	
	function countShopReport(){
	var shopOwnerId = $('#id').val();
	$.ajax({
		type: "POST",
		url: "../php/countShopReport.php",
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
		if (shop[i].countreport == 0){
		$('#shopreportcount').html("");
		}else{
		$('#shopreportcount').html(shop[i].countreport);
		}
		
			}
		}
	});
}
function fetchShopReports(){
	var active;
	var shopOwnerId = $('#id').val();
	var output = '';
	$.ajax({
		type: "POST",
		url: "../php/fetchShopReportbyReportState.php",
		data: "shopState=0",
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
				
				if (shop[i].adminstate == 0){
					active = '#f4f4f4';
				}else{
					active = '#ffffff';	
				}
				output += '<li style="background-color:'+ active +'">' +
                    '<a href="userShopReports.php">' +
                      '<div class="pull-left">' + 
                        '<img src="../uploads/profiles/admin.png" class="img-circle" alt="User Image">'+
                      '</div>'+
                      '<h4>'+shop[i].reportername+
                        '<small><i class="fa fa-calendar"></i>&nbsp;'+shop[i].datetime+'</small>'+
						
                      '</h4>'+
					  '<small>'+ shop[i].shopname +'</small>'+
                      '<p class="wordWrap" style="white-space: nowrap; width:250px; overflow: hidden;text-overflow: ellipsis;">'+shop[i].report +'</p>'+
                    '</a>'+
                  '</li>';

								$("#shopreport").html(output);
									  

						}
		
		}

	
	});
	
	}

</script>
<script>
countApplications()
fetchInactiveShop();
fetchResubmittedShop();






function countApplications(){
var inactive = "";
var resubmitted = "";
var total = "";
	$.ajax({
		type: "POST",
		url: "../php/countInactiveShop.php",
		success: function(data){
		var shop = JSON.parse(data);
		if (shop == 0){
		$('#inactivecount').html("");
		}else{
		$('#inactivecount').html(shop);
		}
		inactive = (shop);	
		}
	});
	
	$.ajax({
		type: "POST",
		url: "../php/countResubmittedShop.php",
		success: function(data){
		var shop = JSON.parse(data);
		if (shop == 0){
		$('#resubmittedcount').html("");
		}else{
		$('#resubmittedcount').html(shop);
		}
		resubmitted = (shop);
		
		
		total = inactive + resubmitted
		if(total == 0){
			$('#notifcount').html("");
		}else{
			$('#notifcount').html(total);
		}
		}
	});



	
}




function fetchInactiveShop(){
	var output = '';
	$.ajax({
		type: "GET",
		url: "../php/fetchInactiveShop.php",
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
				output += '<li>' +
            					'<a href="inactiveShops.php">'+
              					'<i class="menu-icon" style=""><img src="../uploads/'+shop[i].shopicon+'" class="img-circle" style="width:40px; height:40px;" /></i>'+
              					'<div class="menu-info">'+
                					'<h4 class="control-sidebar-subheading">'+ shop[i].shopname +'</h4>'+

                				'<p>'+shop[i].shopaddress+'</p>'+
             					 '</div>'+
            					'</a>'+
          					'</li>';
									  
									  $("#pendingapp").html(output);
									  

						}
		
		}

	
	});
	
	}

	
function fetchResubmittedShop(){
	var output = '';
	$.ajax({
		type: "GET",
		url: "../php/fetchResubmittedShop.php",
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
				output += '<li>' +
            					'<a href="resubmittedShops.php">'+
              					'<i class="menu-icon" style=""><img src="../uploads/'+shop[i].shopicon+'" class="img-circle" style="width:40px; height:40px;" /></i>'+
              					'<div class="menu-info">'+
                					'<h4 class="control-sidebar-subheading">'+ shop[i].shopname +'</h4>'+

                				'<p>'+shop[i].shopaddress+'</p>'+
             					 '</div>'+
            					'</a>'+
          					'</li>';
									  
									  $("#resubmittedapp").html(output);
									  

						}
		
		}

	
	});
	
	}
	
	
function HeaderController($scope, $location) 
{ 
    $scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();
    };
}
</script>