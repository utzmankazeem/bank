<?php
	session_start();
	include '../db/config.php';


	unset($_SESSION['banker_id']);
	unset($_SESSION['banker_name']);
	header('location:banker_login.php');
?>