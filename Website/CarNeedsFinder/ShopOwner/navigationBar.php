<?php
session_start();
if ($_SESSION['shopOwner'] != '1'){
	header('Location: ../index.php');
}else{
$id = $_SESSION['idShopOwner'];
$name = $_SESSION['nameShopOwner'];
$email = $_SESSION['emailShopOwner'];
$image = $_SESSION['imageShopOwner'];	

}

$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = basename($_SERVER['PHP_SELF'], ".php");
?>

<html>
<head>
   <meta name="google-signin-client_id" content="113230825694-lcat8m1v6ubgkb142nj3qegft7h49h4s.apps.googleusercontent.com">
</head>
<style>
hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #222d32;
    margin: 1em 0;
    padding: 0; 
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

.bg-myblue-color{background:#246280 !important;background:-webkit-gradient(linear, left bottom, left top, color-stop(0, #1b4254), color-stop(1, #222d32)) !important;background:-ms-linear-gradient(bottom, #1b4254, #222d32) !important;background:-moz-linear-gradient(center bottom, #1b4254 0, #222d32 100%) !important;background:-o-linear-gradient(#222d32, #1b4254) !important;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#222d32', endColorstr='#1b4254', GradientType=0) !important;color:#fff}


.bg-darkblue-gradient{background:#2c7699 !important;background:-webkit-gradient(linear, left bottom, left top, color-stop(0, #2c7699), color-stop(1, #88c2dd)) !important;background:-ms-linear-gradient(bottom, #2c7699, #88c2dd) !important;background:-moz-linear-gradient(center bottom, #2c7699 0, #88c2dd 100%) !important;background:-o-linear-gradient(#88c2dd, #2c7699) !important;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#88c2dd', endColorstr='#2c7699', GradientType=0) !important;color:#fff}
</style>
<body>

  <header class="main-header">
<input type="hidden" id="id" name="id" value="<?php echo $id ?>" />
    <a href="../homeShopOwner.php" class="logo">
      <span class="logo-mini" style="font-family:Arial, Helvetica, sans-serif; font-style:italic"><b>CN</b>F</span>
      <span class="logo-lg" style="font-family:Arial, Helvetica, sans-serif; font-style:italic"><strong>CarNeeds</strong>Finder</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
	  <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu" onClick="seenMessage()">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-warning" id="notifcount"></span>
            </a>
            <ul class="dropdown-menu" style="width:360px;">
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" >
                  

                </ul>
              </li>
              <li class="footer"><a href="#">Your Messages</a></li>
            </ul>
          </li>
	  
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu">
            <ul class="dropdown-menu">
              <li>
                <ul class="menu">
                  <li>
                    <a href="#">
                      <div class="pull-left">
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $image ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $name ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo $image ?>" width="60" height="60" class="img-circle" alt="User Image">
                <p>
                  <?php echo $name ?><br>
                  <strong><small><?php echo $email ?></small></strong>
				 <small>Shop Owner</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <a onClick="signOut();" class="btn btn-default btn-flat">Sign out</a>
                  <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
                </div>
              </li>
            </ul>
          </li>
          <li>
           
            
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $image ?>" width="60" height="60" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $name ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Main Navigation</li>
        <li class="<?php if ($page=="Home") {echo "active"; } else  {echo "noactive";}?>"><a href="Home.php"><i class="fa fa-desktop"></i> <span>Home</span></a></li>
        <li class="header">Shop Menu</li>
        <li class="<?php if ($page=="activeShop" || $page=="shopExtras") {echo "active"; } else  {echo "noactive";}?>"><a href="activeShop.php"><i class="fa fa-folder-open-o"></i> <span>Active Shops</span></a></li>
        <li class="<?php if ($page=="inactiveShop") {echo "active"; } else  {echo "noactive";}?>"><a href="inactiveShop.php"><i class="fa fa-gears"></i> <span>Pending Shops</span></a></li>
        <li class="<?php if ($page=="revisionShop") {echo "active"; } else  {echo "noactive";}?>"><a href="revisionShop.php"><i class="fa fa-pencil-square-o"></i> <span>For Revision</span></a></li>
		<li class="<?php if ($page=="reviewShop") {echo "active"; } else  {echo "noactive";}?>"><a href="reviewShop.php"><i class="glyphicon glyphicon-user"></i> <span>User Reviews</span></a></li>
        <li><a href="registerShop.php"><i class="fa fa-pencil"></i> <span>Register Shop</span></a></li>
        
     </ul>
    </section>
  </aside>
  <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
</body>
</html>
    
<script>
	
	function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        console.log('User signed out.');
		
		window.location.href = "logoutShopOwner.php";
      });
  }
  
  	function onLoad() {
      gapi.load('auth2', function() {
        gapi.auth2.init();
      });
    }
	
countMessage();
fetchAdminReview();
function countMessage(){
	var shopOwnerId = $('#id').val();
	$.ajax({
		type: "POST",
		url: "../php/countMessageNotif.php",
		data: "idShopOwner="+shopOwnerId,
		success: function(data){
		if (data == 0){
		$('#notifcount').html("");
		}else{
		$('#notifcount').html(data);
		}
		
		}
	});
}
function seenMessage(){
	var shopOwnerId = $('#id').val();
	$.ajax({
		type: "POST",
		url: "../php/editMessageState.php",
		data: "idShopOwner="+shopOwnerId,
		success: function(data){
				countMessage()
		}
	});
}

function fetchAdminReview(){
	var d = new Date();
	var month = d.getMonth();
	var day = d.getDate();
	var output1 = d.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day;
	var shopOwnerId = $('#id').val();
	var output = '';
	$.ajax({
		type: "POST",
		url: "../php/fetchMessagebyMonth.php",
		data: "month="+output1+"&idShopOwner="+shopOwnerId,
		success: function(data){
		var shop = JSON.parse(data);
			for(var i in shop){
				output += '<li>' +
				'<li>' +
                    '<a href="#">' +
                      '<div class="pull-left">' + 
                        '<img src="../uploads/profiles/admin.png" class="img-circle" alt="User Image">'+
                      '</div>'+
                      '<h4>'+
                        'CNF Admin'+
                        '<small><i class="fa fa-calendar"></i>&nbsp;'+shop[i].date+'</small>'+
						
                      '</h4>'+
					  '<small>'+shop[i].shopname+'</small>'+
                      '<p class="wordWrap">'+ shop[i].comment +'</p>'+
                    '</a>'+
                  '</li>';

								$(".menu").html(output);
									  

						}
		
		}

	
	});
	
	}
</script>
