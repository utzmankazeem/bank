<?php 
	include 'header.php';
 ?>
<body>

		<p><h3>Utz Plc...banking as : <i><?php echo$banker_id." ".$banker_name ?></i></h3> </p>
		<hr>

		<ul>
			<ol><a href="home.php">home</a></ol>
			<ol><a href="add.php">add customer</a></ol>
			<ol><a href="view.php">view</a></ol>
			<ol><a href="logout.php">logout</a></ol>
			<ol><a href="test.php">test</a></ol>
		</ul>
		<hr>
		
		<?php

			$query= mysqli_query($db, "SELECT * FROM customer WHERE banker_id='".$banker_id."'")or die(mysqli_error($db));
				$rec = mysqli_num_rows($query) ?>

		<!-- <?php echo"You have :<strong>".$rec."</strong> numbers of product" ?> -->

			<h4>Numbers of Customers</h4>
				<i><?php echo$rec ?></i>

</body>
</html>