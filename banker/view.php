<?php 
	include 'header.php';
 ?>
<body>

		<p><h3>Utz Plc...banking as : <i><?php echo$banker_id." ".$banker_name ?></i></h3></p>
		<hr>
		<ul>
			<ol><a href="home.php">home</a></ol>
			<ol><a href="add.php">add customer</a></ol>
			<ol><a href="view.php">view</a></ol>
			<ol><a href="logout.php">logout</a></ol>
		</ul>
		<hr>




		<table border="1">

			<tr>
				<th>Name</th>
				<th>Phone</th>
				<th>mail</th>
				<th>Sex</th>
				<th>Nation</th>
				<th>Acc type</th>
				<th>Balance</th>
				<th>Acc Number</th>
				<th>Passport</th>
				<th>Delete</th>
			</tr>
			<tr>
				<?php $select = mysqli_query($db, "SELECT * FROM customer 
													WHERE banker_id='".$banker_id."'") ?>
				<?php while ($rec = mysqli_fetch_array($select)) {
							extract($rec) ?>
					<td><?php echo $firstname."-".$lastname ?></td>
					<td><?php echo $mobile ?></td>
					<td><?php echo $email ?></td>
					<td><?php echo $gender ?></td>
					<td><?php echo $country ?></td>
					<td><?php echo $account_type ?></td>
					<td><?php echo $current_balance ?></td>
					<td><?php echo $account_number ?></td>
					<td><img src="../images/<?php echo$filename ?>" width="100px" height="100px"></td>
					<td><a href="delete.php?id=<?php echo$rec[0] ?>">Delete</td>
			</tr>
			<?php } ?>
		</table>







</body>
</html>