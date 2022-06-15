<?php 
$id = $_GET['id'];
$data = $db->query("SELECT * FROM petugas P, login L WHERE P.id_login = L.id_login AND P.Uid = '$id'")->fetch_array();
?>
<div class="content">
	<div>
		<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
		<h2>Detail</h2>
	</div>
	<table class="table">
		<tr>
			<td width="30%">Nama</td>
			<td><span class="fa fa-circle" style="color:<?php if($data['online']=='true'){ echo 'lime'; } else { echo 'red'; } ?>"></span><?= $data['NamaUser']; ?></td>
		</tr>
		<tr>
			<td>Username</td>
			<td><?= $data['username']; ?></td>
		</tr>
		<tr>
			<td>Level</td>
			<td>
				<?php if ($data['Level'] == 1) {
					echo $data['Level']." - Data Obat";
				} elseif($data['Level'] == 2){
					echo $data['Level']." - Pendaftaran Dan Penerimaan Pasien Baru";
				} elseif($data['Level'] == 3){
					echo $data['Level']." - Apotek";
				} elseif($data['Level'] == 4) {
					echo $data['Level']." - Pembayaran";
				} else {
					echo $data['Level']." - Admin";
				} ?>
			</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><?= $data['AlamatUser']; ?></td>
		</tr>
		<tr>
			<td>Gender</td>
			<td><?= $data['GenderUser']; ?></td>
		</tr>
		<tr>
			<td>No. Telepon</td>
			<td><?= $data['TelpUser']; ?></td>
		</tr>
		<tr>
			<td>Status</td>
			<td><?= $data['status']; ?></td>
		</tr>
		<tr>
			<td colspan="2"><a href="?user=edit&&id=<?= $id ?>" class="btn btn-primary"><span class="fa fa-edit"></span> edit</a><a href="?user=del&&id=<?= $id ?>" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</a></td>
		</tr>
	</table>
</div>