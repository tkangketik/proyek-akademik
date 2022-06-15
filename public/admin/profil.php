<div class="content">
	<h2 align="center"><?php if ($_SESSION['login type'] == 'petugas') { echo $rowlog['NamaUser']; } else { echo $rowlog['NamaDkt']; } ?></h2>
	<h5 align="center" style="color:grey;">
		<?php if($_SESSION['level'] == 0){
			echo "Administrator";
		} elseif($_SESSION['level'] == 1){
			echo "Data Obat";
		} elseif($_SESSION['level'] == 2){
			echo "Pendaftaran Dan Penerimaan Pasien Baru";
		} elseif($_SESSION['level'] == 3){
			echo "Apotek";
		} else {
			echo "Pembayaran";
		} ?>
	</h5>
	<a href="?page=profil edit&&id=<?= $_SESSION['id'] ?>" title="edit" class="btn btn-default"><i class="fa fa-pencil"></i>Edit Profil</a>
	<hr>
	<table style="margin-left: 5%;" class="table col-5">
		<tr>
			<td>Username</td>
			<td><?= $rowlog['username']; ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><?= $rowlog['AlamatUser']; ?></td>
		</tr>
		<tr>
			<td>Gender</td>
			<td><?= $rowlog['GenderUser']; ?></td>
		</tr>
		<tr>
			<td>No. Telepon</td>
			<td>+64 <?= $rowlog['TelpUser']; ?></td>
		</tr>
	</table>
</div>