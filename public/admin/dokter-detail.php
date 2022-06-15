<?php 
$id = $_GET['id'];
$data = $db->query("SELECT * FROM dokter D, login L, poliklinik P WHERE D.KodePlk = P.KodePlk AND D.KodeDkt = '$id'")->fetch_array();
?>
<div class="content">
	<div>
		<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
		<h2>Detail</h2>
	</div>
	<table class="table table-striped">
		<tr>	
			<td>Nama</td>
			<td><?= $data['NamaDkt'] ?></td>
		</tr>
		<tr>
			<td>Spesialis</td>
			<td><?= $data['Spesialis'] ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><?= $data['AlamatDkt'] ?></td>
		</tr>
		<tr>
			<td>Nomor Telepon</td>
			<td><?= $data['TeleponDkt'] ?></td>
		</tr>
		<tr>
			<td>Poliklinik</td>
			<td><?= $data['NamaPlk'] ?></td>
		</tr>
		<tr>
			<td>Tarif</td>
			<td>Rp. <?= number_format($data['Tarif'] , 0 , '' , '.') ?></td>
		</tr>
		<tr>
			<td colspan="2"><a href="?dokter=edit&&id=<?= $id ?>" class="btn btn-primary"><span class="fa fa-edit"></span> edit</a><a href="?dokter=del&&id=<?= $id ?>" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</a></td>
		</tr>
	</table>
</div>