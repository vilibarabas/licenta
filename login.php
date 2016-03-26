<!DOCTYPE html>
  <?php
    include "controller/controller.php";
    $controller = new Controller('login');
    
  ?>
<!-- 

<form action="" method="post" name="Login_Form">
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
    <tr>
      <td colspan="2" align="left" valign="top"><h3>Login</h3></td>
    </tr>
    <tr>
      <td align="right" valign="top">Username</td>
      <td><input name="Username" type="text" class="Input"></td>
    </tr>
    <tr>
      <td align="right">Password</td>
      <td><input name="Password" type="password" class="Input"></td>
    </tr>
    <tr>
      <td> </td>
      <td><input name="Submit" type="submit" value="Login" class="Button3"></td>
    </tr> 
  </table>
</form> -->
<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="img/profile_img.jpg" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin"  method="post" name="Login_Form">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" name="Username" class="form-control" placeholder="User Name" required autofocus>
                <input type="password" name="Password" class="form-control" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> I'm Awesome, Remember Me!
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="Submit">Login!</button>
                <a href="register.php">Register</a>
            </form>
        </div>
    </div>

<?php
     
   
	if(isset($_POST['Submit']))
  {      
		$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
		$Password = isset($_POST['Password']) ? $_POST['Password'] : '';
		
      		
    $rez = $controller->verifyUsers($Username, $Password);
		
    if(!empty($rez))
    {
  		if ($rez[0]->acces_index != 0)
      {
  			$_SESSION['UserData'] = $rez[0];
  			header("location:index.php");
  		}
      elseif($rez[0]->acces_index == 0)
      {
        echo '<div id="message" class="alert alert-warning">

              <a href="#" class="close" data-dismiss="alert">&times;</a>

              <strong>Warning!</strong> Inca nu au fost completate toate datele necesare!
          </div>';
      }
    }
    else
    {
			echo '<div id="message" class="alert alert-danger">

              <a href="#" class="close" data-dismiss="alert">&times;</a>

              <strong>Error!</strong> Date de logare invalide!
          </div>';
		}
	}
?>