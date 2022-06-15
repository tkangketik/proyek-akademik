<?php 
$id = $_GET['id'];
$data = $db->query("SELECT * FROM dokter WHERE KodeDkt = '$id'")->fetch_array();
?>
<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Edit<hr></h1>
	<form method="post">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama" placeholder="Masukan Nama" value="<?php echo $data['NamaDkt'] ?>" class="form-control" required>
	</div>

	<div class="form-group">
		<label>Spesialis</label>
		<input type="text" name="spesialis" placeholder="Masukan spesialis" value="<?php echo $data['Spesialis'] ?>" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<textarea name="alamat" class="form-control" cols="3" rows="3" placeholder="Masukan Alamat" required><?php echo $data['AlamatDkt'] ?></textarea>
	</div>
	<div class="form-group">
		<label>Nomor Telepon</label>
		<input type="number" name="telp" placeholder="Masukan Nomor Telepon" value="<?php echo $data['TeleponDkt'] ?>" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Tarif</label>
		<input type="number" name="tarif" placeholder="Masukan Nomor Telepon" value="<?php echo $data['Tarif'] ?>" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Poliklinik</label>
		<select name="kodeplk" class="form-control">
			<?php
			$qw = $db->query("SELECT KodePlk, NamaPlk FROM poliklinik");
			while($dataPlk = $db->fetch_array($qw)) { ?>
			<option <?php if($data['KodePlk'] == $dataPlk['KodePlk']){ echo "selected"; } ?> value="<?php echo $dataPlk['KodePlk']; ?>"><?php echo $dataPlk['NamaPlk']; ?></option>
			<?php } ?>
		</select>
	</div>
		<input type="submit" value="Save" name="save" class="btn btn-primary">
	</form>
</div>
<?php
	if (isset($_POST['save'])) {
		$nama = $_POST['nama'];
		$spesialis = $_POST['spesialis'];
		$alamat = $_POST['alamat'];
		$telp = $_POST['telp'];
		$tarif = $_POST['tarif'];
		$kodeplk = $_POST['kodeplk'];
		
		$sql2 = $db->query("UPDATE dokter SET NamaDkt='$nama',Spesialis='$spesialis',AlamatDkt='$alamat',TeleponDkt='$telp',Tarif='$tarif',kodeplk='$kodeplk' WHERE KodeDkt='$id'");
		refresh('?dokter=list');
	}