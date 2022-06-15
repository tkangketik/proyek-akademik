<?php 
$id = $_GET['id_pasien'];
$data = $db->query("SELECT * FROM pasien WHERE KodePsn = '$id'")->fetch_array();
?>
<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Edit<hr></h1>
	<form method="post">
		<fieldset>
			<legend>Data Pasien</legend>
			<div class="form-group">
	    		<label>Nama Pasien</label>
	    		<input type="text" name="nama" placeholder="Masukan Nama Pasien" value="<?= $data['NamaPsn']; ?>" class="form-control" required>
	    	</div>
			<div class="form-group">
	    		<label>Alamat</label>
	    		<textarea name="alamat" class="form-control" placeholder="Masukan Alamat" required><?= $data['AlamatPsn']; ?></textarea>
	    	</div>
			<div class="form-group">
				<label>Jenis Kelamin</label>
				<select name="gender" class="form-control">
					<option <?php if ($data['GenderPsn'] == 'Laki-Laki') { echo 'selected'; } ?> value="Laki-Laki">Laki-Laki</option>
					<option <?php if ($data['GenderPsn'] == 'Perempuan') { echo 'selected'; } ?> value="Perempuan">Perempuan</option>
				</select>
			</div>
	    	<div class="form-group">
	    		<label>Tanggal Lahir</label>
	    		<input type="date" name="tanggal_lahir" placeholder="Masukan Usia Pasien" class="form-control" value="<?= $data['TanggalLahir']; ?>" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Nomor Telepon</label>
	    		<input type="text" name="telp" placeholder="Masukan Nomor Telepon" value="<?= $data['TeleponPsn']; ?>" class="form-control" required>
	    	</div>
	    <div class="form-group">
	    	<input type="submit" name="save" value="Save" class="btn btn-primary">
	    </div>
	</form>
</div>
<?php
	if (isset($_POST['save'])) {
		//pasien
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$gender = $_POST['gender'];

		$tanggal_lahir =$_POST['tanggal_lahir'];

		//update pasien
		$sql = $db->query("UPDATE pasien SET NamaPsn='$nama',AlamatPsn='$alamat',GenderPsn='$gender',TanggalLahir='$tanggal_lahir',TeleponPsn='$telp' WHERE KodePsn = '$id'");
		refresh('?pasien=list');
	}