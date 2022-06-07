<?php
	 session_start();
	 include "../../utils/prevent.php";
	 isAuthenticated();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
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
			<form method = "post" action = "../../controller/authController/changePassword.php">
				<img src="../multimedia/img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Password</h5>
           		   		<input type="password" class="input" name = "password">
           		   </div>
           		</div>
                <div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>New Password</h5>
           		    	<input type="password" name = 'new-password' class="input" required>
            	   </div>
            	</div>
                <div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Confirem Password</h5>
           		    	<input type="password" name = 'confirm-password' class="input" required>
            	   </div>
            	</div>
                   

            	<input type="submit" class="btn" value="Submit" name = "submit">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
