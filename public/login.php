<?php
	if (isset($_SESSION['id'])) {
		refresh('index.php?page=home');
	}
	if (isset($_POST['submit'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$qw = $db->query("SELECT * FROM login WHERE username = '$username' && password = md5('$password')");
		if ($db->num_rows($qw) == 1) {
			$haslog = $db->fetch_array($qw);
			if ($haslog['status'] == 'non active') {
					$session->set_flashdata('msg','<div class="alert alert-danger"><span class="fa fa-warning"></span>Your account is currently disabled!</div>');
			} else {
				$id = $haslog['id_login'];
				$data = $db->query("SELECT * FROM petugas WHERE id_login='$id'");
				$row = $db->fetch_array($data);
				$session->set_userdata(array('id' => $row['Uid'], 'login type' => 'petugas', 'level' =>	 $row['Level']));
				$session->set_flashdata('welcome','<div id="popup">Welcome '.$row["NamaUser"].'</div>')	;
				refresh('?page=home');
			}
		} else {
			$session->set_flashdata('msg','<div class="alert alert-danger"><span class="fa fa-warning"></span> Username or password wrong!</div>');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.steps.css">
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome/css/font-awesome.css">
	<!-- jquery -->
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
</head>
<body>
	<div class="header">
		<div class="title">
			<a class="logo" style="cursor: text;">Apotek</a>
		</div>
	</div>
	<div class="login-content">
		<div class="login-header"><span class="fa fa-lock"></span> Sign In</div>
		<div class="login-body">
			<?= $session->flashdata('msg'); ?>
			<form method="post">
				<div class="form-group">					
					<input type="text" name="username" placeholder="username" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="password" name="password" placeholder="password" class="form-control" required>
				</div>
				<input type="submit" name="submit" value="login" class="btn btn-primary">
			</form>
		</div>
	</div>
	<?php echo $session->flashdata('welcome'); ?>
	<footer class="footer">&copy<?= date('Y') ?>. All Rights Reserved</footer>
</body>
</html>