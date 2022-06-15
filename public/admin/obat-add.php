<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Add<hr></h1>
	<form method="post">
		<div class="form-group">
	    	<label>Nama</label>
	    	<input type="text" name="nama" placeholder="Masukan Nama" class="form-control" required>
	    </div>
	    <div class="form-group">
	    	<label>Jenis</label>
	    	<input type="text" name="jenis" placeholder="Masukan Jenis Obat" list="jenis" class="form-control">
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
	    	<input type="text" name="kategori" list="kategori" class="form-control" placeholder="Masukan Katagori" required>
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
	    	<input type="number" name="harga" min="1" placeholder="Masukan Harga" class="form-control" required>
	    </div>
	    <div class="form-group">
	    	<label>Jumlah</label>
	    	<input type="number" name="jumlah" min="1" placeholder="Masukan Jumlah" class="form-control" required>
	    </div>
	    <div class="form-group">
	    	<input type="submit" name="save" value="Save" class="btn btn-primary">
	    </div>
	</form>
</div>
<?php
	if (isset($_POST['save'])) {
		$InsertData = array(
			'NamaObat' => $_POST['nama'],
			'JenisObat' => $_POST['jenis'],
			'Kategori' => $_POST['kategori'],
			'HargaObat' => $_POST['harga'],
			'JumlahObat' => $_POST['jumlah']
		);

		$sql = $db->insert('obat',$InsertData);
		refresh('?obat=list');
	}