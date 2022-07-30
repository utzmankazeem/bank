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
			width: 35%;
			border-radius: 30px;
			top: 100px;
			left:20px; 
			position: absolute;

		}
		article{
			width: 50%;
			border: 2px dotted green;
			border-radius: 5px;
			padding: 5%;
			top: 100px;
			right: 30px;
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
						while ($r = mysqli_fetch_array($select)) { 
							extract($r)		?>					
						
			
		<aside>
			<img src="../images/<?php echo$filename ?>" width="200" height="200">
		</aside>
		<article>
			<?php echo"<p>Name ".$customer_name ." <p>Account Number : ". $customer_acc." <p> Account Balance : ".$current_balance ?> 
			<hr>
		</article>
			<?php } ?>
		</section> 
</body>
</html>