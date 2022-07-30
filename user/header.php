<?php

	session_start();
	include '../db/protect.php';
	include '../db/func.php';
	secure();
	$customer_id = $_SESSION['account_id'];
	$customer_name = $_SESSION['customer_name'];
	$customer_acc = $_SESSION['account_number'];
	

?>

