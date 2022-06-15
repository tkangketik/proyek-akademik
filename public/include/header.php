<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome/css/font-awesome.css">
	<!-- jquery -->
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
</head>
<body>
<?php echo $session->flashdata('welcome'); ?>
	<div class="header">
		<div class="title">
			<div id="btn-nav"><i class="fa fa-bars"></i></div>
			<a href="?admin&page=home" class="logo">Apotek</a>
		</div>
		<div class="dropdown dropdown-hover pull-right">
			<div class="dropbtn">
			<?php $id_login = $_SESSION['id'];
			if ($_SESSION['login type'] == 'petugas') {
				$qwlog = $db->query("SELECT * FROM petugas P, login L WHERE P.id_login = L.id_login AND P.Uid = '$id_login'");
				$rowlog = $db->fetch_array($qwlog);
				echo $rowlog['NamaUser'];
			}
			?>	
			</div>
			<div class="dropdown-content">
				<a href="?page=profil"><i class="fa fa-user"></i> Profil</a>
				<a href="?page=logout"><i class="fa fa-sign-out"></i> Logout</a>
			</div>
		</div>
	</div>
	<div class="sidebar">
		<ul>
			<?php if ($_SESSION['level'] == '0'){ ?>
			<li><a href="?page=home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="?user=list" <?php if(isset($_GET['user'])){echo 'class="active"';} ?>><i class="fa fa-user"></i> Petugas</a></li>
			<li><a href="?dokter=list" <?php if(isset($_GET['dokter'])){echo 'class="active"';} ?>><i class="fa fa-user-md"></i> Dokter</a></li>
			<li><a href="?poliklinik=list" <?php if(isset($_GET['poliklinik'])){echo 'class="active"';} ?>><i class="fa fa-hospital-o"></i> poliklinik</a></li>
			<?php }if ($_SESSION['level'] == '0' OR $_SESSION['level'] == '1'){  ?>
			<li><a href="?obat=list" <?php if(isset($_GET['obat'])){echo 'class="active"';} ?>><i class="fa fa-medkit"></i> Obat</a></li>
			<?php } if ($_SESSION['level'] == '0' OR $_SESSION['level'] == '2'){ ?>
			<li><a href="?pasien=list" <?php if(isset($_GET['pasien'])){echo 'class="active"';} ?>><i class="fa fa-users"></i> pasien</a></li>
			<?php } if ($_SESSION['level'] == '0' OR $_SESSION['level'] == '3'){ ?>
			<li><a href="?resep=list" <?php if(isset($_GET['resep'])){echo 'class="active"';} ?>><i class="fa fa-newspaper-o"></i> Resep</a></li>
			<?php } if ($_SESSION['level'] == '0' OR $_SESSION['level'] == '4'){ ?>
			<li><a href="?pembayaran=list" <?php if(isset($_GET['pembayaran'])){echo 'class="active"';} ?>><i class="fa fa-money"></i> pembayaran</a></li>
			<?php } ?>
		</ul>
	</div>
	<div class="container">