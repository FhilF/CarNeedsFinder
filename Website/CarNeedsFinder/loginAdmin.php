<?php
session_start();
unset($_SESSION["account"]);
?>
<!DOCTYPE html>
<html>
<head>


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Log in</title>
  <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/js/sweetalert.min.js"></script>
  <link rel="stylesheet" href="bootstrap/css/sweetalert.min.css" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bootstrap/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-purple.min.css">
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>CarNeedsFinder</b><br>
	<p><small>Administrator</small></p>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form method="post" id="loginform" name="loginform">
      <div class="form-group has-feedback">
        <input type="email" id="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


  </div>
  <!-- /.login-box-body -->
</div>
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script>
$(document).ready(function() {
  $('#loginform').submit(function(e) {
    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/fetchLoginAdmin.php',
       data: $(this).serialize(),
       success: function(data)
       {
          if (data == 2) {
			swal({title: "Sorry!", text: "Inactive Account", icon: "error"});
          }
          else if (data == 1){
			window.location = 'Admin/Home.php';
            
          }else if (data == 0){
			 swal({title: "Sorry!", text: "Invalid Credentials", icon: "error"});
		  }else if (data == 3){
			 swal({title: "Sorry!", text: "Please fill up the form", icon: "error"});
		  }else{
			 swal({title: "Sorry!", text: "There was a problem in logging in", icon: "error"});
		  }
		  
		  
		  
       }
   });
 });
});
</script>
</body>
</html>
