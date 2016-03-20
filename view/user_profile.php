<table class="table table-striped">
	<tr>
	  <th scope="row"><img id="profile_img" src="img/profile_img.jpg"></th>
	</tr>
	<tr>
	  <th scope="row">Name: </th>
	  <td><?php echo $_SESSION['UserData']->name; ?></td>
	</tr>
	<tr>
	  <th scope="row">Departament: </th>
	  <td><?php echo $_SESSION['UserData']->department; ?></td>
	</tr>
	<tr>
	  <th scope="row">Functie: </th>
	   <td><?php echo $_SESSION['UserData']->functie; ?></td> 
	</tr>
</table>