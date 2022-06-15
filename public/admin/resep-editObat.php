<?php
$id	= $_GET['id'];
$data = $db->query("SELECT * FROM resep WHERE NomorResep='$id'")->fetch_array();
$sqldet = $db->query("SELECT * FROM detail WHERE NomorResep='$id'");
?>
<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Add<hr></h1>
	<form method="post">
		<div class="form-group">
			<label>Nomor Resep</label>
			<input type="number" value="<?= $id ?>" class="form-control" readonly>
		</div>
		<?php foreach ($sqldet as $key => $value): ?>
		<div class="form-add">
			<div class="form-group col-3">
				<label>Obat</label>
				<select name="KodeObat[]" class="form-control">
					<option hidden>Pilih Obat</option>
					<?php
					$qw = $db->get('obat');
					while ($rows = $db->fetch_array($qw)) {
						$kd= $rows['KodeObat'];
					?>
					<option <?php if($rows["JumlahObat"] == 0){ echo "Hidden=''"; } elseif($rows["JumlahObat"]<=10) {
						echo "class='alert-warning' title='Stok Hampir'"; } if($value['KodeObat']==$kd ){ echo 'selected';} ?> value="<?= $kd ?>"><?= $rows['NamaObat'].'['.$rows['JumlahObat'].'] | '.$rows['HargaObat']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-3">
				<label>Jumlah Obat</label>
				<input type="number" name="jumlah[]" id="jumlah" value="<?= $value['Jumlah'] ?>" min="1" placeholder="Masukan jumlah obat" class="form-control">
			</div>
			<div class="form-group col-3">
				<label>Dosis</label>
				<input type="text" name="dosis[]" value="<?= $value['Dosis'] ?>" placeholder="Masukan Dosis" class="form-control">
			</div>
		</div>
		<?php endforeach ?>
		<button type="submit" id="submit" name="save" class="btn btn-warning"><i class="fa fa-edit"></i> Update</button>
	</form>
</div>

<?php
	if (isset($_POST['save'])) {

		//send data
		$noResep = $id;
		$KodeObat = $_POST['KodeObat'];
		$dosis = $_POST['dosis'];
		$jumlah = $_POST['jumlah'];
		$tanggal = date("Y-m-d");
		$totalharga = 0;

		//insert detail
		foreach ($KodeObat as $key => $value) {
			$cekObat = $db->query("SELECT * FROM obat WHERE KodeObat = '$value'");
			$cekDet = $db->query("SELECT * FROM detail WHERE NomorResep = $noResep AND KodeObat = '$value'");
			$rowObat = $db->fetch_array($cekObat);
			$rowDet = $db->fetch_array($cekDet);

			$id_det = $rowDet['id_det'];
			$jumlahObat = $jumlah[$key];

			if ($jumlahObat < $rowDet['Jumlah']) {
				$obatResult = $rowObat['JumlahObat'] + ($rowDet['Jumlah'] - $jumlahObat);
			} elseif ($jumlahObat == $rowDet['Jumlah']){
				$obatResult = $rowObat['JumlahObat'];
			} else {
				$obatResult = $rowObat['JumlahObat'] - $jumlahObat;
				if ($obatResult < 0) {
					$jumlahObat = $jumlahObat + $obatResult;
					$obatResult = 0;
				}
			}

			//subtotal
			$harga = $rowObat['HargaObat'] * $jumlah[$key];
			
			//update obat
			//$db->query("UPDATE obat SET JumlahObat = '$obatResult' WHERE KodeObat = '$value'") or die(mysqli_error());

			//update Detail Resep
			//$db->query("UPDATE detail SET Jumlah='$jumlahObat', Dosis = '$dosis[$key]', Subtotal = '$harga' WHERE id_det = '$id_det'");
		
		//total harga obat

			$totalharga = $totalharga + $harga;
		}
		$kembali = $data['Bayar'] - $totalharga;

		if ($kembali < 0) {
			$kembali = 0;
		}
		//update Detail Resep
		$db->query("UPDATE resep SET TotalHarga = '$totalharga', Kembali = '$kembali' WHERE NomorResep = '$noResep'");
		$session->set_flashdata('msg','<div id="popup">Data has been update</div>');
		refresh('?resep=detail&id='.$id);
	}