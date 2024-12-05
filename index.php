<?php 
require("config/db_connection.php");
session_start();

if (isset($_SESSION['id'])) { 
    if ($_SESSION['role'] == "admin") {
        header("location: admin/dashboard.php");
        exit;
    } else {
        header("location: receptionist/dashboard.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/fontawesome.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="icon" href="assets/img/icon.png">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/toastr.css">
    
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/toastr.min.js"></script>
    <script type="text/javascript" src="config/toastr_config.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="assets/img/wave.png">
	<div class="container">
		<div class="img">
			<img src="assets/img/bg.svg">
		</div>
		<div class="login-content">
			<form id="loginForm">
				<img src="assets/img/logo1.png">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" id="username" autofocus required>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" id="password" required>
            	   </div>
            	</div>
            	<input type="submit" class="btn text-white" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/login.js"></script>
	<script>
    $(document).ready(function() {
        $('#loginForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get the values of username and password
            var username = $('#username').val();
            var password = $('#password').val();

            // Make an AJAX request to login.php
            $.ajax({
                url: 'login.php',
                type: 'POST',
                data: {
                    username: username,
                    password: password
                },
                success: function(response) {
                    // Assuming the response is a success message or a redirection URL
                    if (response === 'receptionist') {
                        toastr.success('Login successful!');
                        window.location.href = 'receptionist/dashboard.php';
                    } else if (response === 'admin') {
                        toastr.success('Login successful!');
                        window.location.href = 'admin/dashboard.php';
                    } else if (response === 'defaultPassword') {
                        window.location.href = 'registerPassword.php';
                    }  else if (response === 'inactive') {
                        toastr.error('Account deactivated!');
                    } else {
                        toastr.error('Invalid username or password');
                    }
                },
                error: function() {
                    alert('Error logging in. Please try again later.');
                }
            });
        });
    });
</script>

</body>
</html>
