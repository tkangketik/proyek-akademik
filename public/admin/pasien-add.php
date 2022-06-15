<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Add<hr></h1>
	<form method="post">
		<div class="form-group">
	    	<label>Nama Pasien</label>
	    	<input type="text" name="nama" placeholder="Masukan Nama Pasien" class="form-control" required>
	    </div>
		<div class="form-group">
	    	<label>Alamat</label>
	    	<textarea name="alamat" class="form-control" placeholder="Masukan Alamat" required></textarea>
	    </div>
		<div class="form-group">
			<label>Jenis Kelamin</label>
			<select name="gender" class="form-control">
				<option value="Laki-Laki">Laki-Laki</option>
				<option value="Perempuan">Perempuan</option>
			</select>
		</div>
	    <div class="form-group">
	    	<label>Tanggal Lahir</label>
	    	<input type="date" name="tanggal_lahir" value="1" min="1" placeholder="Masukan Usia Pasien" class="form-control" required>
	    </div>
	    <div class="form-group">
	    	<label>Nomor Telepon</label>
	    	<input type="number" min="0" name="telp" placeholder="Masukan Nomor Telepon" class="form-control" required>
	    </div>
	    <fieldset>
	    	<legend>Pendaftaran</legend>
			<div class="form-group">
				<label>Keterangan</label>
				<select name="keterangan" class="form-control">
		    		<option>Rawat Jalan</option>
		    		<option>Rawat Inap</option>
	    		</select>
			</div>
			<div class="form-group">
				<label>Poliklinik</label>
				<select name="kodeplk" onchange="select(this.value);" class="form-control">
					<option hidden value="">Pilih Poliklinik</option>
					<?php $qw = $db->query('SELECT * FROM poliklinik');
					while ($data = $db->fetch_array($qw)) {
					echo '<option value='.$data["KodePlk"].';>'.$data["NamaPlk"].'</option>';
					} ?>
				</select>
			</div>
			<script>
				function select(val){
					$.ajax({
						url: 'addons/dkt-option.php',
						type: 'get',
						data: {kodeplk:val},
						success: function (data) {
							$("#dkt").empty();
							$('#dkt').append(data);
						}
					});
				};
			</script>
			<div class="form-group">
				<label>Dokter</label>
				<select name="kodedkt" id="dkt" class="form-control">
					<option hidden value="">Pilih Dokter</option>
				</select>
			</div>
			<div style="color:grey;font-size: 12px;margin-top: 2em;">*Biaya Pendaftaran Rp50.000</div>
		</fieldset>
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
		/*$today = new DateTime();

		$umur = $today->diff($tanggal_lahir);*/

		$telp = $_POST['telp'];

		//pendaftaran
		$ket = $_POST['keterangan'];
		$tanggal = date("Y-m-d");
		$kodedkt = $_POST['kodedkt'];
		$kodeplk = $_POST['kodeplk'];

		//create pasien
		$sql = $db->query("INSERT INTO pasien(NamaPsn,AlamatPsn,GenderPsn,TanggalLahir,TeleponPsn) VALUES ('$nama','$alamat','$gender','$tanggal_lahir','$telp')");

		//get pasien
		$pasien = $db->query("SELECT * FROM pasien ORDER BY KodePsn DESC LIMIT 0, 1")->fetch_array();
		$kodepsn = $pasien['KodePsn'];

		//Create Pendftaran
		$sql2 = $db->query("INSERT INTO pendaftaran(TanggalPendf,KodeDkt,KodePsn,KodePlk,Ket) VALUES ('$tanggal','$kodedkt','$kodepsn','$kodeplk','$ket')") or die('Query Error');
		refresh('?pasien=pendaftaran');
	}