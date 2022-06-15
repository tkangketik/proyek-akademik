<div class="content" align="center">
	<?= $session->flashdata('welcome') ?>
	<?php if ($_SESSION['level'] == 0){ ?>
	<a href="?user=list">
		<div class="card col-3" align="center">
			<div class="card-heading"><h1><i class="fa fa-user"></i></h1>Petugas</div>
			<div class="card-body">
				<h1 style="display:inline-block;"><?= $db->get('petugas')->num_rows; ?></h1>Rows
			</div>
		</div>
	</a>
	<a href="?dokter=list">
		<div class="card col-3" align="center">
			<div class="card-heading"><h1><i class="fa fa-user-md"></i></h1>Dokter</div>
			<div class="card-body">
				<h1 style="display:inline-block;"><?= $db->get('dokter')->num_rows; ?></h1>Rows
			</div>
		</div>
	</a>
	<a href="?poliklinik=list">
		<div class="card col-3" align="center">
			<div class="card-heading"><h1><i class="fa fa-hospital-o"></i></h1>Poliklinik</div>
			<div class="card-body">
				<h1 style="display:inline-block;"><?= $db->get("poliklinik")->num_rows; ?></h1>Rows
			</div>
		</div>
	</a>
	<?php } if ($_SESSION['level'] == 0 || $_SESSION['level'] == 1){ ?>
	<a href="?obat=list">
		<div class="card col-3" align="center">
			<div class="card-heading"><h1><i class="fa fa-medkit"></i></h1>Obat</div>
			<div class="card-body">
				<h1 style="display:inline-block;"><?= $db->get("obat")->num_rows; ?></h1>Rows
			</div>
		</div>
	</a>
	<?php } if ($_SESSION['level'] == 0 || $_SESSION['level'] == 2){ ?>
	<a href="?pasien=list">
		<div class="card col-3" align="center">
			<div class="card-heading"><h1><i class="fa fa-users"></i></h1>Pasien</div>
			<div class="card-body">
				<h1 style="display:inline-block;"><?= $db->get("pasien")->num_rows; ?> </h1>Rows
			</div>
		</div>
	</a>
	<a href="?pasien=pendaftaran">
		<div class="card col-3" align="center">
			<div class="card-heading"><h1><i class="fa fa-list-alt"></i></h1>Pendaftaran</div>
			<div class="card-body">
				<h1 style="display:inline-block;"><?= $db->get("pendaftaran")->num_rows; ?> </h1>Rows
			</div>  
		</div>
	</a>
	<?php } if ($_SESSION['level'] == 0 || $_SESSION['level'] == 3){ ?>
	<a href="?enkripsi=list">
		<div class="card col-3" align="center">
			<div class="card-heading"><h1><i class="fa fa-newspaper-o"></i></h1>Enkripsi&Dekripsi</div>
			<div class="card-body">
			<h1 style="display:inline-block;"><?= $db->get("enkripsi")->num_rows; ?></h1>Rows
			</div>
		</div>
	</a>
	<?php } if ($_SESSION['level'] == 0 || $_SESSION['level'] == 3){ ?>
	<a href="?resep=list">
		<div class="card col-3" align="center">
			<div class="card-heading"><h1><i class="fa fa-newspaper-o"></i></h1>Resep</div>
			<div class="card-body">
				<h1 style="display:inline-block;"><?= $db->get("resep")->num_rows; ?> </h1>Rows
			</div>
		</div>
	</a>
	<?php } if ($_SESSION['level'] == 0 || $_SESSION['level'] == 4){ ?>
	<a href="?pembayaran=list">
		<div class="card col-3" align="center">
			<div class="card-heading"><h1><i class="fa fa-money"></i></h1>Pembayaran</div>
			<div class="card-body">
				<h1 style="display:inline-block;"><?= $db->get("pembayaran")->num_rows; ?> </h1>Rows
			</div>
		</div>
	</a>
	<?php } ?>
</div>
