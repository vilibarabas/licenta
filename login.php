<!DOCTYPE html>
  <?php
    include "controller/controller.php";
    $controller = new Controller();
  ?>


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
</form>


<?php
     
   
	if(isset($_POST['Submit']))
    {      
		$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
		$Password = isset($_POST['Password']) ? $_POST['Password'] : '';
		
		
        $rez = $controller->verifyUsers($Username, $Password);
		
		if (!empty($rez))
        {
			$_SESSION['UserData'] = $rez[0];
			header("location:index.php");
		}
        else
        {
			echo "<center><span style='color:red'>Invalid Login Details</span></center>";
		}
	}
?>