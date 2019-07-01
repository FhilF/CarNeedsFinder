<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Untitled Document</title>
<script src="../bootstrap/js/sweetalert2.js"></script>
<script src="../bootstrap/js/sweetalert2.all.js"></script>
<link rel="stylesheet" href="../bootstrap/css/sweetalert2.css" />
<link rel="stylesheet" href="../bootstrap/css/sweetalert2.min.css" />
<script src="../bootstrap/js/jquery-3.2.1.min.js"></script>
<script src="../bootstrap/js/jquery.easing.min.js"></script>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="../bootstrap/js/jquery-multi-step-form.js" type="text/javascript"></script>
<link href="../bootstrap/css/jquery-multi-step-form.css" media="screen" rel="stylesheet" type="text/css"/>
</head>
<style>
    * {margin: 0; padding: 0;}

    html {
	    height: 100%;
	    background: url('../images/bg.png');
	    background: 
		    linear-gradient(rgba(196, 102, 0, 0.2), rgba(155, 89, 182, 0.2)), 
		    url(../images/bg.png);
    }

    body {
	    font-family: arial, verdana;
    }
	
	.swal2-container {
  z-index: 10000;
}
.swal2-popup {
  font-size: 1.6rem !important;
  
}

.text-justify-xs {
    text-align: justify;
}

/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {
    .text-justify-sm {
        text-align: justify;
    }
}

/* Medium devices (desktops, 992px and up) */
@media (min-width: 992px) {
    .text-justify-md {
        text-align: justify;
    }
}

/* Large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {
    .text-justify-lg {
        text-align: justify;
    }
}

.bg-myblue-color{background:#246280 !important;background:-webkit-gradient(linear, left bottom, left top, color-stop(0, #1b4254), color-stop(1, #222d32)) !important;background:-ms-linear-gradient(bottom, #1b4254, #222d32) !important;background:-moz-linear-gradient(center bottom, #1b4254 0, #222d32 100%) !important;background:-o-linear-gradient(#222d32, #1b4254) !important;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#222d32', endColorstr='#1b4254', GradientType=0) !important;color:#fff}
</style>

</head>
	<body>
	
<div id="multistepform">
	<ul id="multistepform-progressbar">
		<li class="active">Account Setup</li>
		<li>Personal Details</li>
	</ul>
    <form method="post" id="registerForm" name="registerForm" onsubmit="return submitForm();" >
	<div class="form">
        <h3 class="fs-subtitle">Step 1</h3>
		<h2 class="fs-title">Create your account</h2>
      <small class="text-danger"><span class="pull-left" id="emailalert"></span></small>
		<input type="email" id="email" name="email" placeholder="Email" class="myclass">
        <small class="text-danger"><span class="pull-left" id="passalert"></span></small>
		<input type="password" id="pass" name="pass" placeholder="Password" class="myclass mypass">
		<input type="password" id="cpass" name="cpass" placeholder="Confirm Password" class="myclass mypass">
        <hr />
		<input type="file" name="file" id="file" onchange="showMyImage(this)" accept="image/x-png,image/jpeg,image/jpg,image/png" data-max-size="5000000">
		<input type="button" name="check2" id="check2" class="button" value="Next" />
		<input type="hidden" name="next" id="clearcheck" class="next button" value="Next">
        
        
	</div>
	<div class="form">
        <h3 class="fs-subtitle">Step 2</h3>
		<h2 class="fs-title">Personal Details</h2>
		
		<input type="text" id="fname" name="fname" placeholder="First Name" class="myclass"/>
		<input type="text" id="lname" name="lname" placeholder="Last Name" class="myclass"/>
		<input type="number" id="phone" name="phone" placeholder="Phone" class="myclass"/>
        <input placeholder="Birthday" type="text" onfocus="(this.type='date')" name="bday" id="bday" class="myclass"> 
		<textarea id="address" name="address" placeholder="Address" class="myclass"></textarea>
		<input type="button" name="previous" class="previous button" value="Previous" />
        <input type="button" name="check" id="check" class="button" value="Submit" />
		<input hidden="hidden" type="submit" name="submit" id="submit" class="next button" value="Finish" />
        
	</div>
    </form>
</div>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script>
var regex;
$(document).ready(function(){
    $.multistepform({
        container:'multistepform',
        form_method:'GET',
    })
});

$(document).ready(function(){
var check = 0;
var checkEmail = 0;
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
$('#email').blur(function() {
	var email = $('#email').val();
		if (email == ""){
	 			$('#email').css({'border-color' : '#e60000'});
	 			checkEmail = 0;
				$('#emailalert').html('Please fill up the field');
		}else if (email !== ""){
		var dataEmail = "";
			if(isEmail(email)){
				$.ajax({
				type: "POST",
				url: "../php/fetchAdminEmail.php",
				data: "email="+email,
				success: function(data){
				var shop = JSON.parse(data);
				for(var i in shop){
					dataEmail = shop[i].email;
				}
			
				if (email !== dataEmail){
	 				$('#email').css({'border-color' : '#009933'});
	 				checkEmail = 1;
					$('#emailalert').html('');
 				}else{
	 				$('#email').css({'border-color' : '#e60000'});
	 				checkEmail = 0;
					$('#emailalert').html('Email is already taken');
 				}
 				
		
				}
			});
			}else{
				$('#email').css({'border-color' : '#e60000'});
				$('#emailalert').html('Please use a valid email');
	 			checkEmail = 0;
			}
		}
		console.log(checkEmail);
});	


$('.mypass').blur(function() {
	var pass = $('#pass').val();
	var lengthpass = $("#pass").val().length
	var cpass = $('#cpass').val();

 if (lengthpass < 8){
	 $('.mypass').css({'border-color' : '#e60000'});
	 $('#passalert').html('Password must have 8 or more than characters');
	 check = 0;
 }else if (pass == "" || cpass == ""){
	 $('.mypass').css({'border-color' : '#e60000'});
	 $('#passalert').html('Password does not match');
	 check = 0;
 }else if (pass === cpass && lengthpass >= 8){
	 $('.mypass').css({'border-color' : '#009933'});
	 $('#passalert').html('');
	 check = 1;
 }else{
	 $('.mypass').css({'border-color' : '#e60000'});
	 $('#passalert').html('');
	 check = 0;
 }
 console.log(check);
});

$('#check2').click(function(){
	if(checkEmail == 0 || check == 0){
		swal("Error!","Please fill up the details with the needed information","error");
		
	}else if( document.getElementById("file").files.length == 0 ){
    swal("Error!","Please upload a profile picture","error");
	}else{
		$('#clearcheck').click();
	}
	
	
});

$('#check').click(function() {
var fileInput = $('#file');
var maxSize = fileInput.data('max-size');
var emptyLength = $(".myclass").filter(function() {
    return this.value == "";
}).length;
 if (emptyLength > 0){
    swal("Error!","Please fill up all fields","error");
    return;
}else if(fileInput.get(0).files.length){
            var fileSize = fileInput.get(0).files[0].size; // in bytes
            if(fileSize>maxSize){
                swal("Error!","Your image exceeds maximum file size of 5mb","error");
                return false;
            }else{
	    var fname = $('#fname').val();
		var lname = $('#lname').val();
		var email = $('#email').val();
		var phone = $('#phone').val();
		var birthday = $('#bday').val();
		var address = $('#address').val();
		$('#firstnametd').html(fname);
		$('#lastnametd').html(lname);
		$('#emailtd').html(email);
		$('#phonetd').html(phone);
		$('#addresstd').html(address);
		$('#birthdaytd').html(birthday);
		$('#myModal1').modal('show');
	 
}
}else{
            alert('choose file, please');
            return false;
        }
		})

});


</script>
	<script type="text/javascript">
        function submitForm() {
            console.log("submit event");
            var fd = new FormData(document.getElementById("registerForm"));
            fd.append("label", "WEBUPLOAD");
            $.ajax({
              url: "../php/addAdmin.php",
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
                if (data == "error1"){
				setTimeout(function() {
                swal({title: "Sorry!", text: "There was a problem uploading your application form", type: "error"})
				.then(function() {
					location.reload();
				}); }, 1000);
				}else if (data == "success"){
				setTimeout(function() {
				swal({title: "Good Job!", text: "You succesfully registered your account. Please note that your account needs to be verified by the admin", type: "success"})
				.then(function() {
					window.location = "Home.php";
				}); }, 1000);
				}else{
					setTimeout(function() {
                swal({title: "Sorry!", text: "There was a problem uploading your application form", type: "error"})
				.then(function() {
					location.reload();
				}); }, 1000);
					
				}
            });
            return false;
        }
    </script>
<script>
 function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("shopimage");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
</script>

</body></html>

<div class="modal fade" id="myModal1" role="dialog" style="z-index:10000">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-myblue-color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div><h4 class="modal-title">Your Profile Picture</h4></div>
        </div>
        <div class="modal-body">
        	<div class="row">
            <div class="col-md-3 col-lg-3 " align="center"> <img id="shopimage" alt="User Pic" style="width:300px;display:block; height: auto; border:2px solid #1d4d63;" src="" class="img-responsive responsive-image "> </div>
  <div class=" col-md-9 col-lg-9 "> 
            
            <table class="table table-bordered table-striped">
            <thead class="bg-myblue-color">
            <tr>
            <th style=" width:30px; max-width:30px;"></th>
            <th class="col-md-10">Info</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td>Email</td>
            <td id="emailtd"></td>
            </tr>
            <tr>
            <td>Firstname</td>
            <td id="firstnametd"></td>
            </tr>
            <tr>
            <td>Lastname</td>
            <td id="lastnametd"></td>
            </tr>
            <tr>
            <td>Phone</td>
            <td id="phonetd"></td>
            </tr>
            <tr>
            <td>Birthday</td>
            <td id="birthdaytd"></td>
            </tr>
            <tr>
            <td>Address</td>
            <td id="addresstd"></td>
            </tr>
            </tbody>
            </table>
            </div>
            </div>	
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="submitform" onclick="document.getElementById('submit').click()">Submit</button>
        </div>
      </div>
    </div>
  </div>


