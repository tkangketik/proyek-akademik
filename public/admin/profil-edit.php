<?php 
$id = $_GET['id'];
$qw = $db->query("SELECT * FROM petugas P, login L WHERE P.id_login = L.id_login AND P.Uid = '$id'");
$data = $db->fetch_array($qw);?>
<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Edit<hr></h1>
	<form method="post">
		<div class="form-group">
			<label>Nama</label>
			<input type="text" name="name" value="<?= $data['NamaUser']  ?>" placeholder="Masukan Nama" class="form-control">
		</div>
		<div class="form-group">
			<label>Username</label>
			<input type="text" name="username" value="<?= $data['username']  ?>" placeholder="Masukan Username" class="form-control">
		</div>
		<div class="form-group">
			<label>Alamat</label>
			<textarea name="address" placeholder="Masukan Alamat=" class="form-control"><?= $data['AlamatUser']; ?></textarea>
		</div>
		<div class="form-group">
			<label>Jenis Kelamin</label>
			<select name="gender" class="form-control">
				<option <?php if($data['GenderUser'] == 'Laki-Laki') { echo 'selected'; } ?> value="Laki-Laki">Laki-Laki</option>
				<option <?php if($data['GenderUser'] == 'Perempuan') { echo 'selected'; } ?> value="Perempuan">Perempuan</option>
			</select>
		</div>
		<div class="form-group">
			<label>Nomor Telepon</label>
			<input type="text" class="form-group-addons" value="+64" readonly>
			<div class="col-11">
				<input type="number" name="phone" value="<?= $data['TelpUser']; ?>" placeholder="Masukan Nomor Telepon" class="form-control">
			</div>
		</div>
		<input type="submit" value="Save" name="save" class="btn btn-primary">
	</form>
</div>
<?php
	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$username = $_POST['username'];
		$address = $_POST['address'];
		$gender = $_POST['gender'];
		$phone_num = $_POST['phone'];
		$db->query("UPDATE login SET username='$username' WHERE id_login='$id'");
		$db->query("UPDATE petugas SET NamaUser='$name',AlamatUser='$address',GenderUser='$gender',TelpUser='$phone_num' WHERE Uid='$id'");
		header('location:?page=profil');
	}