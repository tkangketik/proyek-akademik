<?php
require "assets/fpdf/fpdf.php";
class myPDF extends FPDF
{
	function header()
	{
		$this->SetFont('Arial', 'B', 30);
		$this->Cell(0, 5, 'Apotek', 0, 0, 'C');
		$this->Ln();
		$this->SetFont('Times', '', 12);
		switch ($_GET['pdf']) {
			case 'note':
				$this->Cell(276, 10, 'Nama Pasien : ' . $_GET['nama'], 0, 0, 'L');
				break;

			default:
				$this->Cell(276, 10, 'Laporan ' . $_GET['pdf'], 0, 0, 'L');
				break;
		}
		$this->SetFont('Times', '', 12);
		$this->ln(5);
		switch ($_GET['pdf']) {
			case 'note':
				$this->Cell(276, 10, 'Tanggal : ' . date('d F Y'), 0, 0, 'L');
				break;

			case 'Note':
				$this->Cell(276, 10, 'Tanggal : ' . date('d F Y'), 0, 0, 'L');
				break;

			case 'Poliklinik':
				$this->Cell(276, 10, 'Tanggal : ' . date('d F Y'), 0, 0, 'L');
				break;

			case 'Dokter':
				$this->Cell(276, 10, 'Tanggal : ' . date('d F Y'), 0, 0, 'L');
				break;

			case 'Pasien':
				$this->Cell(276, 10, 'Tanggal : ' . date('d F Y'), 0, 0, 'L');
				break;

			case 'Enkripsi':
				$this->Cell(276, 10, 'Tanggal : ' . date('d F Y'), 0, 0, 'L');
				break;

			case 'Obat':
				$this->Cell(276, 10, 'Tanggal : ' . date('d F Y'), 0, 0, 'L');
				break;

			default:
				$this->Cell(276, 10, 'Tanggal : ' . date('d F Y', strtotime($_GET['tgl'])), 0, 0, 'L');
				break;
		}
		$this->Ln(20);
	}
	function footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial', '', 8);
		$this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}
	function headerTable()
	{
		$this->SetFont('Times', 'B', 12);
		switch ($_GET['pdf']) {
			case 'Pembayaran':
				$this->Cell(20, 10, '#', 1, 0, 'C');
				$this->Cell(60, 10, 'Pasien', 1, 0, 'C');
				$this->Cell(60, 10, 'Poliklinik', 1, 0, 'C');
				$this->Cell(60, 10, 'Dokter', 1, 0, 'C');
				$this->Cell(60, 10, 'Bayar', 1, 0, 'C');
				break;

			case 'Pendaftaran':
				$this->Cell(20, 10, '#', 1, 0, 'C');
				$this->Cell(60, 10, 'Pasien', 1, 0, 'C');
				$this->Cell(60, 10, 'Dokter', 1, 0, 'C');
				$this->Cell(60, 10, 'Poliklinik', 1, 0, 'C');
				$this->Cell(60, 10, 'Keterangan', 1, 0, 'C');
				break;

			case 'Apotek':
				$this->Cell(20, 10, '#', 1, 0, 'C');
				$this->Cell(60, 10, 'Pasien', 1, 0, 'C');
				$this->Cell(60, 10, 'Obat', 1, 0, 'C');
				$this->Cell(60, 10, 'Total Harga', 1, 0, 'C');
				$this->Cell(30, 10, 'Bayar', 1, 0, 'C');
				$this->Cell(30, 10, 'Kembali', 1, 0, 'C');
				break;

			case 'Poliklinik':
				$this->Cell(20, 10, '#', 1, 0, 'C');
				$this->Cell(60, 10, 'Poliklinik', 1, 0, 'C');
				break;

			case 'note':
				$this->Cell(45, 10, 'Obat', 1, 0, 'C');
				$this->Cell(45, 10, 'Harga Satuan', 1, 0, 'C');
				$this->Cell(45, 10, 'Jumlah Obat', 1, 0, 'C');
				$this->Cell(45, 10, 'Subtotal', 1, 0, 'C');
				break;

			case 'Pasien':
				$this->Cell(60, 10, 'Nama Pasien', 1, 0, 'L');
				$this->Cell(60, 10, 'Alamat Pasien', 1, 0, 'L');
				$this->Cell(60, 10, 'Nama Dokter', 1, 0, 'L');
				$this->Cell(60, 10, 'Pesan', 1, 0, 'L');
				break;

			case 'Poliklinik':
				$this->Cell(20, 10, '#', 1, 0, 'C');
				$this->Cell(60, 10, 'Poliklinik', 1, 0, 'C');
				break;

			case 'Dokter':
				$this->Cell(20, 10, '#', 1, 0, 'C');
				$this->Cell(60, 10, 'Nama', 1, 0, 'L');
				$this->Cell(60, 10, 'Spesialis', 1, 0, 'L');
				$this->Cell(60, 10, 'Alamat', 1, 0, 'L');
				$this->Cell(60, 10, 'Nama Poli', 1, 0, 'L');
				break;

			case 'Enkripsi':
				$this->Cell(20, 10, '#', 1, 0, 'C');
				$this->Cell(60, 10, 'Nama Pasien', 1, 0, 'L');
				$this->Cell(60, 10, 'Alamat Pasien', 1, 0, 'L');
				$this->Cell(60, 10, 'Nama Dokter', 1, 0, 'L');
				$this->Cell(60, 10, 'Pesan', 1, 0, 'L');
				break;
		}
		$this->Ln();
	}
	function viewTable($db)
	{
		$this->SetFont('Times', '', 12);
		switch ($_GET['pdf']) {
			case 'Pembayaran':
				$no = 1;
				$tgl = $_GET['tgl'];
				$sql = $db->query("SELECT * FROM pembayaran B, pendaftaran F, dokter D, pasien P, poliklinik K WHERE B.NomorPendf = F.NomorPendf AND F.KodeDkt = D.KodeDkt AND F.KodePsn = P.KodePsn AND F.KodePlk = K.KodePlk AND B.TanggalByr = '$tgl' ORDER BY B.NomorByr DESC");
				while ($data = $db->fetch_array($sql)) {
					$this->Cell(20, 10, $no++, 1, 0, 'C');
					$this->Cell(60, 10, $data['NamaPsn'], 1, 0, 'L');
					$this->Cell(60, 10, $data['NamaPlk'], 1, 0, 'L');
					$this->Cell(60, 10, 'Dr. ' . $data['NamaDkt'], 1, 0, 'L');
					$this->Cell(60, 10, 'Rp. ' . number_format($data['JumlahByr'], 0, '', '.'), 1, 0, 'L');
					$this->Ln();
				}
				break;

			case 'Pendaftaran':
				$no = 1;
				$tgl = $_GET['tgl'];
				$sql = $db->query("SELECT * FROM pendaftaran F, pasien P, Dokter D, Poliklinik K WHERE F.KodePsn = P.KodePsn AND F.KodeDkt = D.KodeDkt AND F.KodePlk = K.KodePlk AND F.TanggalPendf = '$tgl' ORDER BY F.NomorPendf DESC");
				while ($data = $db->fetch_array($sql)) {
					$this->Cell(20, 10, $no++, 1, 0, 'C');
					$this->Cell(60, 10, $data['NamaPsn'], 1, 0, 'L');
					$this->Cell(60, 10, 'Dr. ' . $data['NamaDkt'], 1, 0, 'L');
					$this->Cell(60, 10, $data['NamaPlk'], 1, 0, 'L');
					$this->Cell(60, 10, $data['Ket'], 1, 0, 'L');
					$this->Ln();
				}
				break;

			case 'Apotek':
				$no = 1;
				$tgl = $_GET['tgl'];
				$sql = $db->query("SELECT * FROM resep R, pasien P WHERE R.KodePsn = P.KodePsn AND R.TanggalResep = '$tgl'");
				while ($data = $db->fetch_array($sql)) {
					$this->Cell(20, 10, $no++, 1, 0, 'C');
					$this->Cell(60, 10, $data['NamaPsn'], 1, 0, 'L');
					$noresep = $data['NomorResep'];
					$Namaobat = '';
					$qwobat = $db->query("SELECT O.NamaObat FROM detail D, obat O WHERE D.NomorResep = $noresep AND D.KodeObat = O.KodeObat");
					while ($rowObat = $db->fetch_array($qwobat)) {
						if ($Namaobat == NULL) {
							$Namaobat = $rowObat[0];
						} else {
							$Namaobat = $Namaobat . ", " . $rowObat[0];
						}
					}
					$this->Cell(60, 10, $Namaobat, 1, 0, 'L');
					$this->Cell(60, 10, $data['TotalHarga'], 1, 0, 'L');
					$this->Cell(30, 10, $data['Bayar'], 1, 0, 'L');
					$this->Cell(30, 10, $data['Kembali'], 1, 0, 'L');
					$this->Ln();
				}
				break;

			case 'note':
				$noresep = $_GET['id'];
				$rows = $db->query("SELECT * FROM resep WHERE NomorResep = $noresep")->fetch_array();
				$sql2 = $db->query("SELECT * FROM detail D, obat O WHERE D.NomorResep = $noresep AND D.KodeObat = O.KodeObat");
				while ($data = $db->fetch_array($sql2)) {
					$this->Cell(45, 10, $data['NamaObat'], 1, 0, 'L');
					$this->Cell(45, 10, 'Rp. ' . number_format($data['HargaObat'], 0, '', '.'), 1, 0, 'L');
					$this->Cell(45, 10, number_format($data['Jumlah'], 0, '', '.'), 1, 0, 'L');
					$this->Cell(45, 10, 'Rp. ' . number_format($data['SubTotal'], 0, '', '.'), 1, 0, 'L');
					$this->Ln();
				}
				$this->Cell(135, 10, 'Total Harga ', 1, 0, 'L');
				$this->Cell(45, 10, 'Rp. ' . number_format($rows['TotalHarga'], 0, '', '.'), 1, 0, 'L');
				$this->Ln();
				$this->Cell(135, 10, 'Bayar ', 1, 0, 'L');
				$this->Cell(45, 10, 'Rp. ' . number_format($rows['Bayar'], 0, '', '.'), 1, 0, 'L');
				$this->Ln();
				$this->Cell(135, 10, 'Kembali ', 1, 0, 'L');
				$this->Cell(45, 10, 'Rp. ' . number_format($rows['Kembali'], 0, '', '.'), 1, 0, 'L');
				$this->Ln();
				break;

			case 'Pasien':
				$id = $_GET['id'];
				$no = 1;
				$sql = $db->query("SELECT * FROM enkripsi INNER JOIN pasien on enkripsi.KodePsn = pasien.KodePsn INNER JOIN resep on enkripsi.KodePsn = resep.KodePsn INNER JOIN dokter on resep.KodeDkt = dokter.KodeDkt WHERE id = '$id'");
				while ($data = $db->fetch_array($sql)) {
					$this->Cell(60, 10, $data['NamaPsn'], 1, 0, 'L');
					$this->Cell(60, 10, $data['AlamatPsn'], 1, 0, 'L');
					$this->Cell(60, 10, $data['NamaDkt'], 1, 0, 'L');
					$this->Cell(60, 10, $data['hasil'], 1, 0, 'L');
					$this->ln();
				}
				break;

			case 'Poliklinik':
				$no = 1;
				$sql = $db->query("SELECT * FROM poliklinik");
				while ($data = $db->fetch_array($sql)) {
					$this->Cell(20, 10, $no++, 1, 0, 'C');
					$this->Cell(60, 10, $data['NamaPlk'], 1, 0, 'L');
					$this->ln();
				}
				break;

			case 'Dokter':
				$no = 1;
				$sql = $db->query("SELECT * FROM dokter D, poliklinik P WHERE D.KodePlk = P.KodePlk");
				while ($data = $db->fetch_array($sql)) {
					$this->Cell(20, 10, $no++, 1, 0, 'C');
					$this->Cell(60, 10, $data['NamaDkt'], 1, 0, 'L');
					$this->Cell(60, 10, $data['Spesialis'], 1, 0, 'L');
					$this->Cell(60, 10, $data['AlamatDkt'], 1, 0, 'L');
					$this->Cell(60, 10, $data['NamaPlk'], 1, 0, 'L');
					$this->ln();
				}
				break;

			case 'Enkripsi':
				$no = 1;
				$sql = $db->query("SELECT * FROM enkripsi INNER JOIN pasien on enkripsi.KodePsn = pasien.KodePsn INNER JOIN resep on enkripsi.KodePsn = resep.KodePsn INNER JOIN dokter on resep.KodeDkt = dokter.KodeDkt");
				while ($data = $db->fetch_array($sql)) {
					$this->Cell(20, 10, $no++, 1, 0, 'C');
					$this->Cell(60, 10, $data['NamaPsn'], 1, 0, 'L');
					$this->Cell(60, 10, $data['AlamatPsn'], 1, 0, 'L');
					$this->Cell(60, 10, $data['NamaDkt'], 1, 0, 'L');
					$this->Cell(60, 10, $data['hasil'], 1, 0, 'L');
					$this->ln();
				}
				break;
		}
	}
}

$pdf = new myPDF();
$pdf->AliasNbPages();
switch ($_GET['pdf']) {
	case 'note':
		$pdf->AddPage('P', 'A4', 0);
		break;

	default:
		$pdf->AddPage('L', 'A4', 0);
		break;
}
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();
