<?php 
$id = $_GET['id'];
$data = $db->query("SELECT * FROM obat WHERE KodeObat='$id'")->fetch_array();
?>
<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Edit<hr></h1>
	<form method="post">
		<div class="form-group">
			<label>Nama</label>
			<input type="text" name="nama" placeholder="Masukan Nama" class="form-control" value="<?= $data['NamaObat'] ?>" required> 
		</div>
		<div class="form-group">
	    	<label>Jenis</label>
	    	<input type="text" name="jenis" placeholder="Masukan Jenis Obat" value="<?= $data['JenisObat'] ?>" list="jenis" class="form-control">
	    	<datalist id="jenis">
	    		<option>Tablet</option>
	    		<option>Serbuk</option>
	    		<option>Pil</option>
	    		<option>Kapsul</option>
	    		<option>Kaplet</option>
	    		<option>Larutan</option>
	    		<option>Suspensi</option>
	    		<option>Extrack</option>
	    		<option>Salep</option>
	    		<option>Suppositoria</option>
	    		<option>Cair Tetes</option>
	    		<option>Injeksi</option>
	    	</datalist>
	    </div>
		<div class="form-group">
	    	<label>Kategori</label>
	    	<input type="text" name="kategori" list="kategori" class="form-control" value="<?= $data['Kategori'] ?>" placeholder="Masukan Katagori" required>
	    	<datalist id="kategori">
	    		<option>Obat Bebas</option>
	    		<option>Obat Bebas Terbatas</option>
	    		<option>Obat Keras</option>
	    		<option>Jamu</option>
	    		<option>Obat Herbal Terstandar</option>
	    		<option>Fitofarmaka</option>
	    	</datalist>
	    </div>
	    <div class="form-group">
	    	<label>Harga</label>
	    	<input type="number" name="harga" placeholder="Masukan Harga" class="form-control" value="<?= $data['HargaObat'] ?>" required>
	    </div>
	    <div class="form-group">
	    	<label>Jumlah</label>
	    	<input type="number" name="jumlah" placeholder="Masukan Jumlah" class="form-control" value="<?= $data['JumlahObat'] ?>" required>
	    </div>
		<input type="submit" value="Save" name="save" class="btn btn-primary">
	</form>
</div>
<?php
	if (isset($_POST['save'])) {
		$nama = $_POST['nama'];
		$jenis = $_POST['jenis'];
		$kategori = $_POST['kategori'];
		$harga = $_POST['harga'];
		$jumlah = $_POST['jumlah'];

		$sql = $db->query("UPDATE obat SET NamaObat='$nama',JenisObat='$jenis',Kategori='$kategori',HargaObat='$harga',JumlahObat='$jumlah' WHERE KodeObat='$id'");
		refresh('?obat=list');
	}