<div id="item_accept_message">
</div>
<div class="table">
<table class="table">
	<tr>
		<th>Register nr.</th>
		<th>Name</th>
		<th>Department</th>
		<th>Item</th>
		<th>Team Leader</th>
		<th>Cantitate</th>
		<th>Install / Not posible</th>
	</tr>

<?php

	$item_queryes = $controller->model->getItemQuery($_SESSION['UserData']->department, $_SESSION['UserData']->acces_index);
	$row = array(2 => 'danger', 0 => 'warning', 1 => 'succs');
	$accept_leader = array(2 => 'decline', 0 => 'not processed', 1 => 'accept');
	if(!empty($item_queryes))
	{
		foreach($item_queryes as $itm)
		{
			echo "<tr class='". $row[$itm->team_leader_accept]."'>
				<td class='register_nr'>". $itm->nr."</td>
				<td class='user_name'>". $itm->userName."</td>
				<td class='department'>". $itm->department."</td>
				<td class='item_name'>". $itm->itemName."</td>
				<td >". $accept_leader[$itm->team_leader_accept]."</td>
				<td>1</td>
				<td><span class='done_button'><button class='btn btn-primary'>Done</button></span> <span class='delete_button'><button class='btn btn-danger'>Delete</button></span></td>
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