
<?php
	session_start();
	include '../db/config.php';
	include '../db/func.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php

		if (array_key_exists('login', $_POST)) {
			
			if (empty($_POST['acc'])) {
				$e['acc'] = "enter account number";
			}else {
				$acc = mysqli_real_escape_string($db, $_POST['acc']);
			}
			if (empty($_POST['pass'])) {
				$e['pass'] = "enter password";
			}else {
				$pass = mysqli_real_escape_string($db, $_POST['pass']);
			}
			if (empty($e)) {
				
				$select = mysqli_query($db, "SELECT * FROM customer WHERE account_number='".$acc."' AND password='".$pass."'") 
						or die(mysqli_error($db));						
						if (mysqli_num_rows($select) == 1 ) {
							$r = mysqli_fetch_array($select);
								
								$_SESSION['account_id'] = $r[0];
								$_SESSION['customer_name'] = $r[1]."-".$r[2];
								$_SESSION['account_number'] = $r[11];
								


								header("location:home.php");
							}else{
								$er = "invalid details";
								header("location:user_login.php?er=$er");
					}
			}
		}
		if (isset($_GET['er'])) {
			echo$_GET['er'];
		}
	?>

		<form action=""	method="post">
				
				<p><?php text("acc", "Account Number") ?>
					<?php if(isset($e['acc'])) echo$e['acc'] ?>
				</p>
				<p><?php text("pass", "Password") ?>
					<?php if(isset($e['pass'])) echo$e['pass'] ?>
				</p>
				<p><?php submit("login", "Login") ?><?php submit("reset", "Reset") ?></p>
		</form>
</body>
</html>