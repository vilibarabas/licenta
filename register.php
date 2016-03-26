<!DOCTYPE html>
<html>
	<head>
	<title>Login</title>
	  <?php
	    include "controller/controller.php";
	    $controller = new Controller('register');
	  ?>
	</head>

	<body>
		<div class="container">
		    <div class="card card-container">
		        <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
		        
		        <p id="profile-name" class="profile-name-card">Register</p>
		        <br>
		        <form class="form-signin"  method="post" name="Register_Form">
		            
		            <input type="text" id="nume" class="form-control" placeholder="Nume" required autofocus>
		            <input type="text" id="prenume" class="form-control" placeholder="Prenume" required autofocus>
		            <input type="text" id="Username" class="form-control" placeholder="User Name" required autofocus>
		            <input type="password" id="password" class="form-control" placeholder="Password" required>
		            <input type="password" id="Confirm_Password" class="form-control" placeholder="Confirm Password" required>
		            
		            <button class="btn btn-lg btn-primary btn-block btn-signin" type="button" id="register">Register!</button>
		            <a href="login.php">Login</a>
		        </form>
		        <div id="load_container"></div>
		    </div>
		</div>

	</body>
</html>