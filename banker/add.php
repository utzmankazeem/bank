<?php 
	include 'header.php';
 ?>
<body>

		<p><h3>Utz Plc...banking as : <i><?php echo$banker_id." ".$banker_name ?></i></h3></p>
		<hr>
		<ul>
			<ol><a href="home.php">home</a></ol>
			<ol><a href="add.php">add customer</a></ol>
			<ol><a href="view.php">view</a></ol>
			<ol><a href="logout.php">logout</a></ol>
		</ul>
		<hr>


	<?php
		$max_size = 4000000;
		$extension = array("image/jpg", "image/jpeg", "image/png");
		
		if (array_key_exists('submit', $_POST)) {
				
				if (!in_array($_FILES['pic']['type'], $extension)) {
					$e[] = "files not supported";
				}
				if ($_FILES['pic']['size'] >$max_size) {
					$e[] = "filesize is bigger than".$max_size."mb";
				} 
				$filename = str_replace(" ", "_", $_FILES['pic']['name']);
				$destination = '../images/' .$filename;
								
				if (!move_uploaded_file($_FILES['pic']['tmp_name'], $destination)) {
					$e[] = "File not added";
				}
				if (empty($_POST['fname'])) {
					$e['fn'] = "enter firstname";
				} else {
					$fn = mysqli_real_escape_string($db, $_POST['fname']);
				}
				if (empty($_POST['lname'])) {
					$e['ln'] = "lastname";
				} else {
					$ln = mysqli_real_escape_string($db, $_POST['lname']);
				}
				if (empty($_POST['phone'])) {
					$e['ph'] = "enter phone line";
				} else {
					$ph = mysqli_real_escape_string($db, $_POST['phone']);
				}
				if (empty($_POST['mail'])) {
					$e['m'] = "provide email";
				} else {
					$m = mysqli_real_escape_string($db, $_POST['mail']);
				}
				if (empty($_POST['sex'])) {
					$e['sex'] = "select gender";
				} else {
					$sex = mysqli_real_escape_string($db, $_POST['sex']);
				}
				if (empty($_POST['cty'])) {
					$e['cty'] = "enter country";
				} else {
					$cty = mysqli_real_escape_string($db, $_POST['cty']);
				}
				if (empty($_POST['acc'])) {
					$e['acc'] = "select acc type";
				} else {
					$acc = mysqli_real_escape_string($db, $_POST['acc']);
				}
				if (empty($_POST['obal'])) {
					$e['ob'] = "enter opening balance";
				} else {
					$ob = mysqli_real_escape_string($db, $_POST['obal']);
				}
				if (empty($_POST['pass'])) {
					$e['ps'] = "enter pasword";
				} else {
					$ps = mysqli_real_escape_string($db, $_POST['pass']);
				}
				if (empty($e)) {
						$num = rand(8888888, 9999999) ;
						$pre = 501;
						$acc_num = $pre.$num;
						
						$insert = mysqli_query($db, "INSERT INTO customer VALUES(NULL,
																				'".$fn."',
																				'".$ln."',
																				'".$ph."',
																				'".$m."',
																				'".$sex."',
																				'".$filename."',
																				'".$cty."',
																				'".$acc."',
																				'".$ob."',
																				'".$ob."',
																				'".$acc_num."',
																				NOW(),
																				'".$ps."',
																				'".$banker_id."')
																") or die(mysqli_error($db));
						$suc ="customer added";
						header("location:add.php?suc=$suc");
				}  /*else {
						$er ="customer not added";
						header("location:add.php?er=$er");
				}*/
		}
		if (isset($_GET['suc'])) {
			echo $_GET['suc'];
		}
		/*if (isset($_GET['er'])) {
			echo $_GET['er'];
		}*/
	?>
		<form action=""	method="post" enctype="multipart/form-data">
			
			<p><?php text("fname", "Firstname") ?>
				<?php if(isset($e['fn'])) echo$e['fn'] ?>
			</p>
			<p><?php text("lname", "Lasstname") ?>
				<?php if(isset($e['ln'])) echo$e['ln'] ?>
			</p>
			<p><?php text("phone", "Mobile", "number") ?>
				<?php if(isset($e['ph'])) echo$e['ph'] ?>
			</p>
			<p><?php text("mail", "Email", "email") ?>
				<?php if(isset($e['m'])) echo$e['m'] ?>
			</p>
			<p>Gender : <?php radio("sex", "Male", "M") ?><?php radio("sex", "Female", "F") ?>
				<?php if(isset($e['sex'])) echo$e['sex'] ?>
			</p>
			<p>Passport Photo<input type="file" name="pic"></p>
			<p>Country :<select name="cty">
				<?php $ctr = array("Nigeria", "Ghana", "Lome", "Burkina", "South Africa", "Kenya", "Rwanda") ?></p>
						<option value="">Select country</option>
				<?php foreach ($ctr as $ct) { ?>
					<option value="<?php echo$ct?>"><?php echo$ct ?></option>
				<?php } ?>
						</select><?php if(isset($e['cty'])) echo$e['cty'] ?>
			</p>
			<p>Account Type :<select name="acc">
				<?php $act = array("Fixed", "Savings", "Dom", "Current") ?></p>
						<option value="">Account type</option>
				<?php foreach ($act as $ac) { ?>
					<option value="<?php echo$ac ?>"><?php echo$ac ?></option>
				<?php } ?>
						</select><?php if(isset($e['acc'])) echo$e['acc'] ?>
			</p>
			<p><?php text("obal", "Opening Balance", "number") ?>
				<?php if(isset($e['ob'])) echo$e['ob'] ?>
			</p>
			<p><?php text("pass", "Password") ?>
				<?php if(isset($e['ps'])) echo$e['ps'] ?>
			</p>
			<p><?php submit("submit", "Submit") ?><?php submit("reset", "Reset") ?></p>
		</form>
</body>
</html>