<?php
$id	= $_GET['id'];
$data = $db->query("SELECT * FROM detail WHERE id_det='$id'")->fetch_array();

$kodeobat = $data['KodeObat'];
$subtotal = $data['SubTotal'];

//resep cek
$noResep = $data['NomorResep'];
$dataResep = $db->query("SELECT * FROM resep WHERE NomorResep='$noResep'")->fetch_array();
$totalharga = $dataResep['TotalHarga'] - $subtotal;
$kembali = $dataResep['Bayar'] - $totalharga;

//obat cek
$dataobat = $db->query("SELECT * FROM obat WHERE KodeObat='$kodeobat'")->fetch_array();
$jumlahObat = $dataobat['JumlahObat'] + $data['Jumlah'];

//update Obat
$db->query("UPDATE obat SET JumlahObat = '$jumlahObat' WHERE KodeObat = '$kodeobat'");

//update resep
$db->query("UPDATE resep SET TotalHarga = '$totalharga', Kembali = '$kembali' WHERE NomorResep = '$noResep'");

//delete Detail3
$db->query("DELETE FROM detail WHERE id_det='$id'");

$session->set_flashdata('msg','<div id="popup">Data has been deleted</div>');
refresh('?resep=detail&id='.$noResep);