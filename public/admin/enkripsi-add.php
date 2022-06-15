<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Add<hr></h1>
	<form method="post">
		<div class="form-group">
	    	<label>Nama</label>
	    	<input type="text" name="nama" placeholder="Masukan Nama" class="form-control" required>
	    </div>
	    <div class="form-group">
	    	<label>Pesan yang dienkripsi</label>
            <textarea name="hasil"><?php echo $_GET['hasil'];?></textarea>
	    </div>
	    <div class="form-group">
	    	<label>Kunci</label>
	    	<input type="password" name="kunci" min="1" placeholder="Masukan Kunci" class="form-control" value="<?php echo $_GET['kunci'];?>" required>
	    </div>
	    <div class="form-group">
	    	<input type="submit" name="save" value="Save" class="btn btn-primary">
	    </div>
	</form>
</div>
<?php
	if (isset($_POST['save'])) {
		$InsertData = array(
			'nama' => $_POST['nama'],
			'hasil' => $_POST['hasil'],
			'kunci' => $_POST['kunci'],
		);

		$sql = $db->insert('enkripsi',$InsertData);
		refresh('?enkripsi=list');
	}