<?php 
require("config/db_connection.php");
session_start();

if ($_SESSION['password'] != "NXS123") {
    header("location: config/not_login-error.html");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/icon.png" />
    <!-- LOCAL STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/toastr.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- LOCAL SCRIPTS -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/toastr.min.js"></script>
    <script type="text/javascript" src="config/toastr_config.js"></script>

    <title>Register Password</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Poppins', sans-serif;
}

body{
	background: url("../img/bg.jpg");
	max-height: 100%;
	background-position: center;
	background-repeat: no-repeat;
	background-size: auto;
	margin-bottom: 10px;
	overflow: hidden;
}

.navbar{
	background: #023047;
}

#title_logo{
	max-width: 12vw;
	width: auto;
}
#school{
	font-size: 2vw;
	font-weight: bold;
	padding: 0;
}
#loc{
	font-size: 1.5vw;
	letter-spacing: 1vw;
	padding: 0;
}
#logo{
	max-width: 12vw;
	width: auto;
	padding-top: 15px;
}
.card{
	display: flex;
	border-radius: 20px;
	border: none;
	width: 50%;
}

form{
    width: 70%;
}

form div button {
    margin-top: 20px;
    width: 100%;
}

/*SWITCH*/
.switch {
	position: relative;
	display: inline-block;
	width: 45px;
	height: 20px;
}

.switch input { 
	opacity: 0;
	width: 0;
	height: 0;

}

.slider {
	position: absolute;
	cursor: pointer;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background-color: #fff;
	-webkit-transition: .4s;
	transition: .4s;

}

.slider:before {
	position: absolute;
	content: "";
	height: 15px;
	width: 15px;
	left: 2px;
	bottom: 3px;
	background-color: #6b6b6b;
	-webkit-transition: .4s;
	transition: .4s;
}

input:checked + .slider {
	border: 2px solid #d1d1d1;
	color: #d1d1d1;
	background-color: #6b6b6b;
}

input:checked + .slider:before {
	background-color: #fff;
}

input:focus + .slider {
	box-shadow: 0 0 1px #2196F3;
	
}

input:checked + .slider:before {
	-webkit-transform: translateX(26px);
	-ms-transform: translateX(26px);
	transform: translateX(26px);

}

/* Rounded sliders */
.slider.round {
	margin: -2px;
	border: 2px solid #d1d1d1;
	outline: none;
	border-radius: 34px;
}

.slider.round:before {
	border-radius: 50%;
}

.change-password-box form button:hover{
	background: none;
	border: 2px solid #ed682a;
}
</style>
<body>
    <main>
        <div class="container-fluid d-flex justify-content-center align-items-center">
            <div class="formBox d-flex justify-content-center align-items-center flex-column">
            <img class="mb-4" src="assets/img/logo1.png" alt="Logo" style="width: 250px; height: auto;">

                <form method="POST">
                    <input type="number" name="uid" value="<?php echo $_SESSION['id'] ?>" hidden>
                    <label for="password">New Password</label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="New Password"
                        required>
                    <label for="cpassword">Confirm Password</label>
                    <input id="cpassword" type="password" class="form-control mb-3" name="cpassword"
                        placeholder="Confirm Password" required>
                    <label class="switch">
                        <input type="checkbox" onclick="show_hide_password()">
                        <span class="slider round"></span>
                    </label>
                    <span>Show Password</span>
                    <div>
                    <button type="submit" name="register-password" class="btn">Register
                        Password</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        function show_hide_password() {
            var p = document.getElementById("password");
            var cp = document.getElementById("cpassword");
            if (p.type === "password") {
                p.type = "text";
            } else {
                p.type = "password";
            }
            if (cp.type === "password") {
                cp.type = "text";
            } else {
                cp.type = "password";
            }
        }

        $(document).ready(function () {
    $('form').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission
        let password = $('#password').val();
        let cpassword = $('#cpassword').val();

        if (password !== cpassword) {
            toastr.error('Passwords do not match!');
        } else {
            $.post('update-password.php', { password, cpassword }, function (response) {
                if (response.success) {
                    let role = response.role; // Backend should send back the user's role
                    if (role === 'admin') {
                        window.location.href = 'admin/dashboard.php';
                    } else if (role === 'receptionist') {
                        window.location.href = 'receptionist/dashboard.php';
                    }
                } else {
                    toastr.error(response.message);
                }
            }, 'json');
        }
    });
});

    </script>
    <!-- LOGIN VALIDATION END -->

    <!-- BOOTSTRAP 4 JS -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
