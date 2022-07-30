<?php
	
	include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			background-color: #BE6079;
			font-family: sans-serif;
		}
		a {
			text-decoration: none;
			letter-spacing: 1px;
		}
		a:hover{
			background-color: black;
		}
		section{
			border: 5px solid #1C1D1B;
			width: 50%;
			height: 400px;		
			position: relative;
			text-align: center;
			font-size: 15px; 
			margin: 5% auto;
			/*box-sizing: border-box;*/
			color: gold;
		}
		aside{
			width: 70%;
			border: 2px dotted green;
			border-radius: 5px;
			padding: 5%;
			left: 60px;
			margin: 20px auto;
			position: absolute;
		}
	</style>

</head>
<body>
		<section>
		<a href="home.php">home</a>
		<a href="transfer.php">transfer</a>
		<a href="logout.php">logout</a>
		<hr>
		
		<?php 
				$select = mysqli_query($db, "SELECT * FROM customer WHERE account_number='".$customer_acc."'") or die(mysqli_error($db));
							$r = mysqli_fetch_array($select);
							$sender_account_balance = $r['current_balance'];
							$sender_acc_num = $r['account_number'];
							extract($r)		?>								
		<aside>
			<p style="color:green">
		<?php echo"<p>Name ".$customer_name ." <p>Account Number : ". $sender_acc_num." <p> Account Balance : ".$sender_account_balance ?>
			</p>

		<?php

				if (array_key_exists('send', $_POST)) {
					
					if (empty($_POST['acc_num']) || (empty($_POST['amount']))) {//MORNAL ERROR
						$em = "some fields are empty";
						header("location:transfer.php?em=$em");
					}elseif (!is_numeric($_POST['amount'])) {//IF AMOUNT IS EMPTY
						$em = "please enter correct value";
						header('location:transfer.php?em=$em');
					}elseif ($_POST['acc_num'] == $sender_acc_num) {//IF ACC NUMBER ARE SAME
						$em = "sora e' o";
						header("location:transfer.php?em=$em");
					}else {
						$reciepient_acc_num = mysqli_real_escape_string($db, $_POST['acc_num']); 
						$transfer_amount = mysqli_real_escape_string($db, $_POST['amount']);
					}
					// SELECTING FROM RECIPIENT ACCOUNT TABLE
					$reciever = mysqli_query($db, "SELECT customer_id, firstname, lastname, current_balance FROM customer WHERE account_number='".$reciepient_acc_num."'")or die(mysqli_error($db));
					if (mysqli_num_rows($reciever) == 1) {
						$reciepient = mysqli_fetch_array($reciever);

						$reciepient_id = $reciepient[0];
						$reciepient_name = $reciepient[1]." ".$reciepient[2];
						$reciepient_current_balance = $reciepient['current_balance'];
					//PERFORMING MATHEMATICAL TRANSACTION
					if ($sender_account_balance < $transfer_amount) {
						$em = "low account balance";
						header("location:transfer.php?em=$em");
					}else {
						$sender_new_balance = ($sender_account_balance - $transfer_amount);
						$reciepient_new_balance = ($transfer_amount + $reciepient_current_balance );

			//UPDATING SENDER ACCOUNT BALANCE
			$sender_update = mysqli_query($db, "UPDATE customer SET current_balance = '".$sender_new_balance."' WHERE account_number = '".$sender_acc_num."'")or die(mysqli_error($db));

			//UPDATNG RECIEVER ACCOUNT BALANCE
			$reciepient_update = mysqli_query($db, "UPDATE customer SET current_balance = '".$reciepient_new_balance."' WHERE account_number = '".$reciepient_acc_num."'")or die(mysqli_error($db));

						//INSERT FOR SENDER
						$sender_insert = mysqli_query($db, "INSERT INTO transaction VALUES(NULL,
																							NOW(),
																							'debit',
																							'self',
																							'".$reciepient_name."',
																							'".$sender_account_balance."',
																							'".$sender_new_balance."',
																							'".$transfer_amount."',
																'".$customer_id."')") or die(mysqli_error($db));
						//INSERT FOR RECIEVER
						$recipient_insert = mysqli_query($db, "INSERT INTO transaction VALUES(NULL,
																							NOW(),
																							'credit',
																							'".$customer_name."',
																							'self',
																							'".$reciepient_current_balance."',
																							'".$reciepient_new_balance."',
																							'".$transfer_amount."',
																'".$reciepient_id."')")	or die(mysqli_error($db));
						$suc = "Transfer Successful";
 						header("Location:transfer.php?suc=$suc");
					} 
						//IF TRANSFER IS NOT EQUAL TO ONE
				} else {
					 	$em = "Transfer not Successful";
						header("location:transfer.php?em=$em");
				}
			}//END OF MAIN IF
				if (isset($_GET['suc'])) {
				echo "<h4>".$_GET['suc']."</h4>";
				}

				if (isset($_GET['em'])) {
				echo "<h4>".$_GET['em']."</h4>";
				}
		?>
			


			<form action=""	method="post" style="color: #517D7F">
				
				<p><?php text("acc_num", "Account Number :", "number") ?></p>
				<p><?php text("amount", "Enter Amount :", "number") ?></p>
				<p><?php submit("send", "Submit") ?></p>
			</form>
		</aside>
		</section> 
</body>
</html>