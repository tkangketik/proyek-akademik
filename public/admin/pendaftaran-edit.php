<?php

$NomorPendf = $_GET['id_pendf'];
$row = $db->query("SELECT * FROM pendaftaran WHERE NomorPendf='$NomorPendf'")->fetch_array();
?>
<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Add<hr></h1>
	<form method="post">
	    <div class="form-group">
	    	<label>Pasien</label>
	    	<input type="text" name="kodepsn" placeholder="Masukan Kode Pasien" value="<?= $row['KodePsn'] ?>" class="form-control">
	    </div>
	    <div class="form-group">
	    	<label>Keterangan</label>
	    	<select name="ket" class="form-control">
	    		<option <?php if($row['Ket'] == "Rawat Jalan"){ echo "selected"; } ?>>Rawat Jalan</option>
	    		<option <?php if($row['Ket'] == "Rawat Inap"){ echo "selected"; } ?>>Rawat Inap</option>
	    	</select>
	    </div>
	    <div class="form-group">
	    		<label>Poliklinik</label>
	    		<select name="kodeplk" onchange="select(this.value);" class="form-control">
	    			<option hidden value="">Pilih Poliklinik</option>
	    			<?php $qw = $db->query('SELECT * FROM poliklinik');
	    			while ($data = $db->fetch_array($qw)) { ?>
	    			<option <?php if($row['KodePlk'] == $data['KodePlk']){ echo "selected"; } ?> value='<?= $data["KodePlk"] ?>';><?= $data["NamaPlk"] ?></option>
	    			<?php } ?>
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
	    			<?php $kodeplk = $row['KodePlk']; $qw = $db->query("SELECT * FROM dokter WHERE KodePlk = '$kodeplk'");
	    			while ($data = $db->fetch_array($qw)) { ?>
	    			<option <?php if($row['KodeDkt'] == $data['KodeDkt']){ echo "selected"; } ?> value='<?= $data["KodeDkt"] ?>';><?= $data["NamaDkt"] ?></option>
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

		//pendaftaran
		$ket = $_POST['ket'];
		$kodedkt = $_POST['kodedkt'];
		$kodeplk = $_POST['kodeplk'];
		$kodepsn = $_POST['kodepsn'];

		$sql = $db->query("UPDATE pendaftaran SET KodeDkt='$kodedkt', KodePsn='$kodepsn', KodePlk='$kodeplk', Ket='$ket' WHERE NomorPendf='$NomorPendf'");
		refresh('?pasien=pendaftaran');
	}