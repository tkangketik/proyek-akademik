<?php 
echo $session->flashdata('msg');
$id = $_GET['id'];
$qw = $db->query("SELECT * FROM resep R, pasien P, dokter D, poliklinik Poli WHERE R.KodePlk = Poli.KodePlk AND R.KodeDkt = D.KodeDkt AND R.KodePsn = P.KodePsn AND R.NomorResep = '$id'");
$data = $db->fetch_array($qw);
$noresep = $data['NomorResep'];
?>
<div class="content">
	<div>
		<a href="?resep=list" class="btn btn-default"><i class="fa fa-caret-left"></i> back</a>

		<h2>Detail | <a href="?pdf=note&id=<?= $id ?>&nama=<?= $data['NamaPsn'] ?>" class="btn btn-default"><span class="fa fa-print"></span> Note</a><a href="?resep=bayar&id=<?= $id ?>" class="btn btn-primary"><span class="fa fa-money"></span> Bayar</a></h2>
	</div>
	<table class="table">
		<tr>
			<td width="20%">Nomor Resep</td>
			<td><?= $data['NomorResep']; ?></td>
		</tr>
		<tr>
			<td>Pasien</td>
			<td><a title="data pasien" href="?pasien=detail&&id_pasien=<?= $data['KodePsn'] ?>"> <?= $data['NamaPsn']; ?></a></td>
		</tr>
		<tr>
			<td>Dokter</td>
			<td><a title="data dokter" href="?dokter=detail&&id=<?= $data['KodeDkt'] ?>"><?= $data['NamaDkt']; ?></a></td>
		</tr>
		<tr>
			<td>Poliklinik</td>
			<td><?= $data['NamaPlk']; ?></td>
		</tr>
		<tr>
			<td>Status</td>
			<td><?php if ($data['Bayar'] == 0) {
				echo("belum membayar");
			} else { echo("Sudah membayar"); } ?></td>
		</tr>
	</table>
	<fieldset>
		<legend>Obat Detail <a href="?resep=addObat&&id=<?= $data['NomorResep'] ?>" class="btn btn-success"><span class="fa fa-plus"></span> Add</a> <a href="?resep=editObat&&id=<?= $data['NomorResep'] ?>" class="btn btn-warning"><span class="fa fa-edit"></span> Edit</a></legend>
		<table class="table"">
			<thead>
				<th width="20%">Obat</th>
				<th>Dosis</th>
				<th>Harga Satuan</th>
				<th>Jumlah Obat</th>
				<th>SubTotal</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php
				$qwobat = $db->query("SELECT * FROM detail D, obat O WHERE D.NomorResep = $noresep AND D.KodeObat = O.KodeObat");
				while ($rowObat = $db->fetch_array($qwobat)){ ?>
				<tr>
					<td><?= $rowObat['NamaObat']; ?></td>
					<td><?= $rowObat['Dosis']; ?></td>
					<td>Rp. <?= number_format($rowObat['HargaObat'] , 0 , '' , '.') ?></td>
					<td><?= $rowObat['Jumlah']; ?></td>
					<td>Rp. <?= number_format($rowObat['SubTotal'] , 0 , '' , '.') ?></td>
					<td><div onclick="deleteDet(<?= $rowObat['id_det']; ?>)" class="btn btn-danger"><i class="fa fa-trash"></i></div></td>
				</tr>
				<?php } ?>
				<tr style="border-top: 2px solid grey;">
					<td colspan="4">Total Harga</td>
					<td colspan="2">Rp. <?= number_format($data['TotalHarga'] , 0 , '' , '.') ?></td>
				</tr>
				<tr>
					<td colspan="4">Bayar</td>
					<td colspan="2">Rp. <?= number_format($data['Bayar'] , 0 , '' , '.') ?></td>
				</tr>
				<tr>
					<td colspan="4">Kembali</td>
					<td colspan="2">Rp. <?= number_format($data['Kembali'] , 0 , '' , '.') ?></td>
				</tr>
			</tbody>
		</table>
	</fieldset>
</div>

<script>
	function deleteDet(val){
		$.ajax({
				url: 'index.php',
				type: 'GET',
				data: {resep:'delObat', id:val},
				success: function (data) {
					document.location=''	
				}
			});
	}
</script>