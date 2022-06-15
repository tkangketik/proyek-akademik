<div class="content">
	<div>
		<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
		<h2>Detail</h2>
	</div>
	<?php 
	if (isset($_GET['id_pasien'])) {
	$id = $_GET['id_pasien'];
	$data = $db->query("SELECT * FROM pasien WHERE KodePsn = '$id'")->fetch_array();
	?>
	<table class="table table-striped">
		<tr>	
			<td width="30%">Kode Pasien</td>
			<td><?= $data['KodePsn'] ?></td>
		</tr>
		<tr>	
			<td>Nama Pasien</td>
			<td><?= $data['NamaPsn'] ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><?= $data['AlamatPsn'] ?></td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td><?= $data['GenderPsn'] ?></td>
		</tr>
		<tr>
			<td>Tanggal Lahir</td>
			<td><?= date('d F Y',strtotime($data['TanggalLahir'])) ?></td>
		</tr>
		<tr>
			<td>Umur</td>
			<td>
				<?php
					$tanggal_lahir =new DateTime($data['TanggalLahir']);
					$today = new DateTime();
					$umur = $today->diff($tanggal_lahir);
					if ($umur->y > 0) {
						echo $umur->y." Tahun";
					} else {
						echo $umur->m." Bulan";
					}
				?> 
			</td>
		</tr>
		<tr>
			<td>Nomor Telepon</td>
			<td><?= $data['TeleponPsn'] ?></td>
		</tr>
		<tr>
			<td colspan="2"><a href="?pasien=edit&&id_pasien=<?= $id ?>" class="btn btn-primary"><span class="fa fa-edit"></span> edit</a><a href="?pasien=del&&id_pasien=<?= $id ?>" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</a></td>
		</tr>
	</table>
	<?php } else {
	$id = $_GET['id_pendf'];
	$data = $db->query("SELECT * FROM pendaftaran F, pasien P, dokter D, poliklinik K WHERE F.KodePsn = P.KodePsn AND F.KodeDkt = D.KodeDkt AND F.KodePlk = K.KodePlk AND F.NomorPendf = '$id'")->fetch_array();	
	?>
		<table class="table table-striped">
		<tr>
			<td width="30%">Nomor Pendaftaran</td>
			<td><?= $data['NomorPendf'] ?></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td><?= $data['Ket'] ?></td>
		</tr>
		<tr>	
			<td>Nama Pasien</td>
			<td><a href="?pasien=detail&id_pasien=<?= $data['KodePsn'] ?>"><?= $data['NamaPsn'] ?></a></td>
		</tr>
		<tr>
			<td>Dokter</td>
			<td><a href="?dokter=detail&id=<?= $data['KodeDkt'] ?>"><?= $data['NamaDkt'] ?></a></td>
		</tr>
		<tr>
			<td>Poliklinik</td>
			<td><?= $data['NamaPlk'] ?></td>
		</tr>
		<tr>
			<td>Tanggal Daftar</td>
			<td><?= $data['TanggalPendf'] ?></td>
		</tr>
		<tr>
			<td colspan="2">
				<a href="?pasien=pendaftaran_edit&&id_pendf=<?= $id ?>" class="btn btn-primary"><span class="fa fa-edit"></span> Edit</a>
				<a href="?pasien=del&&id_pendf=<?= $id ?>" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</a>
			</td>
		</tr>
	</table>
	<?php } ?>
</div>