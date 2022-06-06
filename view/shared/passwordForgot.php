<!DOCTYPE html>
<html>
<head>
	<title>Password Forgot</title>
	<link rel="stylesheet" type="text/css" href="../../css/register.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="../../multimedia/img/wave.png">
	<div class="container">
		<div class="img">
			<img src="../../multimedia/img/bg.svg">
		</div>
		<div class="login-content">
			<form method = "post" action = "../controller/authController/passwordReset.php">
				<img src="../../multimedia/img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
           		   		<input type="text" class="input" name = "email">
           		   </div>
           		</div>

            	<input type="submit" class="btn" value="Submit" name = "password-reset-token">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
