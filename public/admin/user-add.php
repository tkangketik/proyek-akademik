<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Add<hr></h1>
	<form method="post">
		<div class="form-group">
			<label>Nama</label>
			<input type="text" name="name" placeholder="Masukan Name" class="form-control">
		</div>
		<div class="form-group">
			<label>Username</label>
			<input type="text" name="username" placeholder="Masukan Username" class="form-control">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="password" placeholder="Masukan Password" class="form-control">
		</div>
		<div class="form-group">
			<label>Alamat</label>
			<textarea name="address" placeholder="Masukan Alamat" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<label>Level</label>
			<select name="level" class="form-control">
				<option hidden>Pilih Level</option>
				<option value="0">0 - Administrator</option>
				<option value="1">1 - Bagian Daftar Obat</option>
				<option value="2">2 - Pendaftaran Dan Penerimaan Pasien Baru</option>
				<option value="3">3 - Apotek</option>
				<option value="4">4 - Pembayaran</option>
			</select>
		</div>
		<div class="form-group">
			<label>Jenis Kelamin</label>
			<select name="gender" class="form-control">
				<option value="Laki-Laki">Laki-Laki</option>
				<option value="Perempuan">Perempuan</option>
			</select>
		</div>
		<div class="form-group">
			<label>Nomor Telepon</label>
			<input type="text" class="form-group-addons" value="+64" readonly>
			<div class="col-11">
				<input type="number" name="phone" placeholder="Masukan Nomor Telepon" class="form-control">
			</div>
		</div>
		<input type="submit" value="Save" name="save" class="btn btn-primary">
	</form>
</div>
<?php
	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$address = $_POST['address'];
		$level =  $_POST['level'];
		$gender = $_POST['gender'];
		$phone_num = $_POST['phone'];
		$sqlcek = $db->query("UPDATE petugas SET NamaUser='$name',AlamatUser='$address',GenderUser='$gender',TelpUser='$phone_num' WHERE Uid='$id'");
		if ($db->num_rows($sqlcek)) {
			# code...
		}
		$sql = $db->query("INSERT INTO login(username,password) VALUES ('$username','$password')");
		$sql1 = $db->query("SELECT * FROM login WHERE username = '$username' && password = '$password'");
		$dat1 = $db->fetch_array($sql1);
		$id_login = $dat1['id_login'];
		$sql2 = $db->query("INSERT INTO petugas(id_login, NamaUser, AlamatUser, GenderUser, TelpUser, Level) VALUES ('$id_login', '$name', '$address', '$gender', '$phone_num', '$level')");
		refresh('?user=list');
		$session->set_flashdata('msg','<div id="popup">Created Data Successful</div>');
	}