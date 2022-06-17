<?php
if (!isset($_SESSION['id'])) {
	refresh('index.php');
} else {
	$idLog = $_SESSION['id'];
	$cekLog = $db->query("SELECT * FROM login WHERE id_login = $idLog");
	$rowLog = $db->fetch_array($cekLog);
	if ($rowLog['status'] == "non active") {
		$session->destroy();
		refresh('index.php');
	}
}
if (isset($_GET['title'])) {
	$title = $_GET['title'];
} else {
	$title = 'proyek akademik';
}
require_once 'public/include/header.php';
if (isset($_GET['page'])) {
	switch ($_GET['page']) {
		case 'home':
			include admin . 'index.php';
			break;

		case 'logout':
			$id = $_SESSION['id'];
			$sql = $db->query("UPDATE login SET online='false' WHERE id_login='$id'");
			$session->destroy();
			refresh('index.php');
			break;

		case 'welcome':
			include admin . 'welcome.php';
			break;

		case 'profil':
			include admin . 'profil.php';
			break;

		case 'profil edit':
			include admin . 'profil-edit.php';
			break;

		default:
			include 'public/error/404 error.php';
			break;
	}
} elseif (isset($_GET['user'])) {
	switch ($_GET['user']) {
		case 'list':
			include admin . 'user.php';
			break;

		case 'detail':
			include admin . 'user-detail.php';
			break;

		case 'add':
			include admin . 'user-add.php';
			break;

		case 'edit':
			include admin . 'user-edit.php';
			break;

		case 'del':
			$id = $_GET['id'];
			$qw = $db->query("DELETE FROM login WHERE id_login = '$id'");
			$session->set_flashdata('msg', '<div id="popup">Delete Data Success..</div>');
			header('location:?user=list');
			break;

		case 'status':
			$id = $_GET['id'];
			if ($_GET['val'] == '0') {
				echo $stat = "non active";
			} else {
				echo $stat = "active";
			};
			$cek = $db->query("SELECT * FROM login L, petugas P WHERE P.id_login = L.id_login AND P.Uid = '$id'")->fetch_assoc();
			$id_login = $cek['id_login'];
			$sql = $db->query("UPDATE login SET status='$stat' WHERE id_login='$id_login'");
			break;

		default:
			include 'public/error/404 error.php';
			break;
	}
} elseif (isset($_GET['pasien'])) {
	switch ($_GET['pasien']) {
		case 'list':
			include admin . 'pasien.php';
			break;

		case 'pendaftaran':
			include admin . 'pendaftaran.php';
			break;

		case 'pendaftaran_add':
			include admin . 'pendaftaran-add.php';
			break;

		case 'pendaftaran_edit':
			include admin . 'pendaftaran-edit.php';
			break;

		case 'detail':
			include admin . 'pasien-detail.php';
			break;

		case 'add':
			include admin . 'pasien-add.php';
			break;

		case 'edit':
			include admin . 'pasien-edit.php';
			break;

		case 'del':
			if ($_GET['id_pasien']) {
				$id = $_GET['id_pasien'];
				$qw = $db->query("DELETE FROM pasien WHERE kodePsn = '$id'");
				$session->set_flashdata('msg', '<div id="popup">Delete Data Success..</div>');
				header('location:?pasien=list');
			} else {
				$id = $_GET['id_pendf'];
				$qw = $db->query("DELETE FROM pendaftaran WHERE NomorPendf = '$id'");
				$session->set_flashdata('msg', '<div id="popup">Delete Data Success..</div>');
				header('location:?pasien=list');
			}
			break;

		default:
			include 'public/error/404 error.php';
			break;
	}
} elseif (isset($_GET['resep'])) {
	switch ($_GET['resep']) {
		case 'list':
			include admin . 'resep.php';
			break;

		case 'detail':
			include admin . 'resep-detail.php';
			break;

		case 'add':
			include admin . 'resep-add.php';
			break;

		case 'bayar':
			include admin . 'resep-bayar.php';
			break;

		case 'addObat':
			include admin . 'resep-addObat.php';
			break;

		case 'editObat':
			include admin . 'resep-editObat.php';
			break;

		case 'delObat':
			include admin . 'resep-delObat.php';
			break;

		case 'del':
			$id = $_GET['id'];
			$qw = $db->query("DELETE FROM resep WHERE NomorResep = '$id'");
			$session->set_flashdata('msg', '<div id="popup">Delete Data Success..</div>');
			header('location:?resep=list');
			break;

		default:
			include 'public/error/404 error.php';
			break;
	}
} elseif (isset($_GET['dokter'])) {
	switch ($_GET['dokter']) {
		case 'list':
			include admin . 'dokter.php';
			break;

		case 'add':
			include admin . 'dokter-add.php';
			break;

		case 'edit':
			include admin . 'dokter-edit.php';
			break;

		case 'detail':
			include admin . 'dokter-detail.php';
			break;

		case 'del':
			$id = $_GET['id'];
			$qw = $db->query("DELETE FROM dokter WHERE KodeDkt = '$id'");
			header('location:?dokter=list');
			break;

		default:
			include 'public/error/404 error.php';
			break;
	}
} elseif (isset($_GET['enkripsi'])) {
	switch ($_GET['enkripsi']) {
		case 'list':
			include admin . 'enkripsi.php';
			break;

		case 'add':
			include admin . 'enkripsi-add.php';
			break;

		case 'edit':
			include admin . 'enkripsi-edit.php';
			break;

		case 'detail':
			include admin . 'enkripsi-detail.php';
			break;

		case 'encrypt':
			include admin . 'enkripsi-enc.php';
			break;

		case 'decrypt':
			include admin . 'enkripsi-dec.php';
			break;

		case 'list-acc':
			include admin . 'enkripsi-list-acc.php';
			break;

		case 'req-acc':
			include admin . 'enkripsi-req-acc.php';
			break;
		
		case 'cari';
			include admin . 'func_search.php';
			break;

		case 'res-acc':
			include admin . 'enkripsi-res-acc.php';
			break;
			case 'res-deny':
				include admin . 'enkripsi-res-deny.php';
				break;

		case 'del':
			$id = $_GET['id'];
			$qw = $db->query("DELETE FROM enkripsi WHERE id = '$id'");
			header('location:?enkripsi=list');
			break;

		default:
			include 'public/error/404 error.php';
			break;
	}
} elseif (isset($_GET['obat'])) {
	switch ($_GET['obat']) {
		case 'list':
			include admin . 'obat.php';
			break;

		case 'add':
			include admin . 'obat-add.php';
			break;

		case 'edit':
			include admin . 'obat-edit.php';
			break;

		case 'del':
			$id = $_GET['id'];
			$qw = $db->query("DELETE FROM obat WHERE KodeObat = '$id'");
			header('location:?obat=list');
			break;

		default:
			include 'public/error/404 error.php';
			break;
	}
} elseif (isset($_GET['poliklinik'])) {
	switch ($_GET['poliklinik']) {
		case 'list':
			include admin . 'poliklinik.php';
			break;

		case 'edit':
			include admin . 'poliklinik-edit.php';
			break;

		default:
			include 'public/error/404 error.php';
			break;
	}
} elseif (isset($_GET['pembayaran'])) {
	switch ($_GET['pembayaran']) {
		case 'list':
			include admin . 'pembayaran.php';
			break;

		case 'add':
			include admin . 'pembayaran-add.php';
			break;

		case 'del':
			$id = $_GET['id'];
			$qw = $db->query("DELETE FROM pembayaran WHERE NomorByr = '$id'");
			header('location:?pembayaran=list');
			break;

		default:
			include 'public/error/404 error.php';
			break;
	}
} elseif (isset($_GET['stat'])) {
	switch ($_GET['stat']) {
		case 'onload':
			$id = $_SESSION['id'];
			$cek = $db->query("SELECT * FROM login L, petugas P WHERE P.id_login = L.id_login AND P.Uid = '$id'")->fetch_assoc();
			$id_login = $cek['id_login'];
			$sql = $db->query("UPDATE login SET online='true' WHERE id_login='$id_login'");
			break;

		case 'unload':
			$id = $_SESSION['id'];
			$cek = $db->query("SELECT * FROM login L, petugas P WHERE P.id_login = L.id_login AND P.Uid = '$id'")->fetch_assoc();
			$id_login = $cek['id_login'];
			$sql = $db->query("UPDATE login SET online='false' WHERE id_login='$id_login'") or die('error');
			break;
	}
} else {
	include('public/error/404 error.php');
}
require_once 'public/include/footer.php';
