<?php 
$id = $_GET['id'];
$data = $db->query("SELECT * FROM poliklinik WHERE KodePlk = '$id'")->fetch_array();
?>
<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Edit<hr></h1>
	<form method="post">
	<div class="form-group">
		<label>Nama Poliklinik</label>
		<input type="text" name="nama" placeholder="Masukan Nama Poliklinik" value="<?php echo $data['NamaPlk'] ?>" class="form-control" required>
	</div>
	<input type="submit" value="Save" name="save" class="btn btn-primary">
	</form>
</div>
<?php
	if (isset($_POST['save'])) {
		$nama = $_POST['nama'];
		$sql = $db->query("UPDATE poliklinik SET NamaPlk='$nama' WHERE KodePlk='$id'");
		refresh('?poliklinik=list');
	}