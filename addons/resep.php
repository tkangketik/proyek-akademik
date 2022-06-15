<?php
	require_once 'koneksi.php';
	switch ($_GET['resep']) {
		case 'cek no_pendf':
			$no_pendf = $_GET['data'];
			$sql = $mysqli->query("SELECT * FROM pendaftaran WHERE NomorPendf = '$no_pendf'");
			if (mysqli_num_rows($sql) == 1) {
				$row = $sql->fetch_array();
				$sql = $mysqli->query("SELECT * FROM resep WHERE KodePsn = '$row[3]' AND KodeDkt = '$row[2]' AND KodePlk = '$row[4]'");
				if (mysqli_num_rows($sql) == 1) {
					echo 2;
				} else {
					echo 1;
				}
			} else {
				echo 0;
			}
			break;

		case 'jumlah':
			$id = $_GET['id'];
			$sql = $mysqli->query("SELECT * FROM obat WHERE KodeObat = '$id'");
			$row = $db->fetch_array($sql);
			echo $row['JumlahObat'];
			break;
		
		default:
			# code...
			break;
	}