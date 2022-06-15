<?php
require_once 'koneksi.php';

if (isset($_GET['poliklinik'])) {
	$nama = $_POST['nama'];
	$sql = $mysqli->query("INSERT INTO poliklinik (NamaPlk) VALUES ('$nama')");
}

if (isset($_GET['pembayaran'])) {
	
}
switch (isset($_GET['cek'])) {
	case 'pembayaran':
		$no_pendf = $_GET['data'];
		$sql = $mysqli->query("SELECT * FROM pendaftaran P, dokter D WHERE P.KodeDkt = D.KodeDkt AND P.NomorPendf = $no_pendf");
		$data = $sql->fetch_array();
		echo $data['Tarif'] + $data['Biaya'];
		break;
}

switch (isset($_GET['delete'])) {
	case 'poliklinik':
		$id = $_POST['id'];
		$sql = $mysqli->query("DELETE FROM poliklinik WHERE KodePlk = '$id'");
		break;
	case 'pembayaran':
		$id = $_POST['id'];
		$sql = $mysqli->query("DELETE FROM pembayaran WHERE NomorByr = '$id'");
		break;
}