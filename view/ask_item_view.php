<div id="item_accept_message">
</div>
<div class="table-responsive">
<table class="table">
	<tr>
		<th>Register nr.</th>
		<th>Name</th>
		<th>Department</th>
		<th>Item</th>
		<th>Cantitate</th>
		<th>Install / Not posible</th>
	</tr>

<?php

	$item_queryes = $controller->model->getItemQuery($_SESSION['UserData']->department, $_SESSION['UserData']->acces_index);
	
	if(!empty($item_queryes))
	{
		foreach($item_queryes as $itm)
		{
			echo "<tr>
				<td class='register_nr'>". $itm->nr."</td>
				<td class='user_name'>". $itm->userName."</td>
				<td class='department'>". $itm->department."</td>
				<td class='item_name'>". $itm->itemName."</td>
				<td>1</td>
				<td><span class='accept_button'><button class='btn btn-primary'>Accept</button></span> <span class='decline_button'><button class='btn btn-danger'>Decline</button></span></td>
			</tr>";
		}
	}
	else
	{
		echo '<p>Momentan nu exista nici o cerere de unitati!</p>';
	}
?>

</table>
</div>