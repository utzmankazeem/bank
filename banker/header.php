<?php
	session_start();
	include '../db/sec.php';
	include '../db/func.php';
	protect();
	$banker_id = $_SESSION['banker_id'];
	$banker_name = $_SESSION['banker_name'];
?>


<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		ul, ol {
			display: inline-block;
		}
		ul, ol, a {
			text-decoration: none;
			letter-spacing: 1px;
		}
		table, tr, td {
			text-align:center;
		}
	</style>
	<title>utzbank</title>
</head>