<?php

		include '../db/config.php';

		unset($_SESSION['account_id']);
		unset($_SESSION['account_number']);
		header("location:user_login.php")
?>