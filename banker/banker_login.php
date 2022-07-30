
<?php
	session_start();
	include '../db/config.php';
	include '../db/func.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>

		<?php

			if (array_key_exists('login', $_POST)) {
					
					if (empty($_POST['name'])) {
						$e['name'] = "enter banker's name";
					} else {
						$name = mysqli_real_escape_string($db, $_POST['name']);
					}
					if (empty($_POST['password'])) {
						$e['pass'] = "enter password";
					} else {
						$pass = mysqli_real_escape_string($db, $_POST['password']);
					}
					if (empty($e)) {
						
						$select = mysqli_query($db, "SELECT * FROM banker WHERE banker_name='".$name."' AND sec_pass='".md5($pass)."'")
											or die(mysqli_error($db));
								if (mysqli_num_rows($select) == 1){
									$r = mysqli_fetch_array($select);

									$_SESSION['banker_id'] = $r[0];
									$_SESSION['banker_name'] = $r[1];

									header('location:home.php');
								}else{
									$er = "invalid details";
									header("location:banker_login.php?er=$er");
								}
					}
			}

			if(isset($_GET['er'])) {
				echo "<i>".$_GET['er']."</i>";
			}
		?>


	<form action="" method="post">
		
			<p><?php text("name", "Banker Name") ?>
				<?php if(isset($e['name'])) echo$e['name'] ?>
			</p>
			<p><?php text("password", "Password") ?>
				<?php if(isset($e['pass'])) echo$e['pass'] ?>
			</p>
			<p><?php submit("login", "Login") ?><?php submit("reset", "Reset") ?></p>
	</form>

</body>
</html>

