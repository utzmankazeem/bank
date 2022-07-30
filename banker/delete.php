<?php
	include '../db/config.php';
	$customer_id = $_GET['id'];

	$delete = mysqli_query($db, "DELETE FROM customer WHERE customer_id='".$customer_id."'")
		or die(mysqli_error($db));
		header("location:view.php");
?>