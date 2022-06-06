<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="../../css/register.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="../../multimedia/img/wave.png">
	<div class="container">
		<div class="img">
			<img src="../multimedia/img/bg.svg">
		</div>
		<div class="login-content">
			<form action="../../controller/authController/sign_up.php" method = "post">
				<img src="../../multimedia/img/avatar.svg">
				<h2 class="title">Create New Account</h2>
                <div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>FirstName</h5>
           		   		<input type="text" name="first_name" class="input" required>
           		   </div>
           		</div>
                   <div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>LastName</h5>
           		   		<input type="text" name="last_name" class="input" required>
           		   </div>
           		</div>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" name="user_name" class="input" required>
           		   </div>
           		</div>
				   
                <div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-envelope"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
           		   		<input type="email" name = 'email' class="input" required>
           		   </div>
           		</div>
                   <div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Phone Number</h5>
           		   		<input type="tel" name="phone" class="input" required>
           		   </div>
           		</div>
                   
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name = 'password' class="input" required>
            	   </div>
            	</div>
            	<input type="submit" name = 'register' class="btn" value="Register" required>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../../javascript/register.js"></script>
</body>
</html>
