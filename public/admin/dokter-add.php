<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Add<hr></h1>
	<form method="post">
		<div class="form-group">
	    	<label>Nama</label>
	    	<input type="text" name="nama" placeholder="Masukan Nama" class="form-control" required>
	    </div>
	    <div class="form-group">
	    	<label>Spesialis</label>
	    	<input type="text" name="spesialis" placeholder="Masukan Spesialis" class="form-control" required>
	    </div>
		<div class="form-group">
	    	<label>Alamat</label>
	    	<textarea name="alamat" class="form-control" placeholder="Masukan Alamat" required></textarea>
	    </div>
	    <div class="form-group">
	    	<label>Nomor Telepon</label>
	    	<input type="number" name="telp" placeholder="Masukan Nomor Telepon" class="form-control" required>
	    </div>
	    <div class="form-group">
	    	<label>Tarif</label>
	    	<input type="number" name="tarif" placeholder="Masukan Tarif" class="form-control" required>
	    </div>
	    <div class="form-group">
	    	<label>Poliklinik</label>
	    	<select name="kodeplk" class="form-control">
	    		<?php $qw = $db->query('SELECT * FROM poliklinik');
	    		while ($data = $db->fetch_array($qw)) { ?>
	    		<option value="<?php echo $data['KodePlk']; ?>"><?php echo $data['NamaPlk']; ?></option>
	    		<?php } ?>
	    	</select>
	    </div>
	    <div class="form-group">
	    	<input type="submit" name="save" value="Save" class="btn btn-primary">
	    </div>
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

		//create dokter
		$sql2 = $db->query("INSERT INTO dokter(NamaDkt,Spesialis,AlamatDkt,TeleponDkt,KodePlk,Tarif) VALUES ('$nama','$spesialis','$alamat','$telp','$kodeplk','$tarif')");
		refresh('?dokter=list');
	}