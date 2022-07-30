<?php 
	include 'header.php';
 ?>
<body>

		<p><h3>Utz Plc...banking as : <i><?php echo$banker_id." ".$banker_name ?></i></h3> </p>
		<hr>

		<ul>
			<ol><a href="banker_home.php">home</a></ol>
			<ol><a href="add.php">add customer</a></ol>
			<ol><a href="view.php">view</a></ol>
			<ol><a href="logout.php">logout</a></ol>
		</ul>
		<hr>
		<?php

					$query = mysqli_query($db, "SELECT c.firstname, t.transaction_type, COUNT(*) FROM customer c JOIN transaction t
												WHERE c.customer_id = t.transaction_id AND c.banker_id = $banker_id ")
									or die(mysqli_error($db));

			?>


			<table border="1">
					
					<tr>
						<th>Name</th><th>Customer ID</th><th>Number of transactions</th>
					</tr>
					<tr>
						<?php while($r = mysqli_fetch_array($query)) { ?>

							<td><?php echo $r[0] ?></td>
							<td><?php echo $r[1] ?></td>
							<td><?php echo $r[2] ?></td>
						</tr>
					<?php } ?>

</body>
</html>