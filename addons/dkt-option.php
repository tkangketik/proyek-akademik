	<option hidden>Pilih Dokter</option>
<?php 
	require_once 'koneksi.php';
	$kd = $_GET['kodeplk'];
	$result = $mysqli->query("SELECT * FROM dokter WHERE KodePlk = '$kd'");
	while ($row = $result->fetch_array()) {
	?>
	<option value="<?= $row['KodeDkt'] ?>"><?= $row['NamaDkt'] ?> | spesialis : <?= $row['Spesialis'] ?></option>
<?php } ?>