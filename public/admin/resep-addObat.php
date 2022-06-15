<?php
$id	= $_GET['id'];
$data = $db->query("SELECT * FROM resep WHERE NomorResep='$id'")->fetch_array();
?>
<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Add<hr></h1>
	<form method="post">
		<div class="form-group">
			<label>Nomor Pendaftaran</label>
			<input type="number" value="<?= $id ?>" class="form-control" readonly>
		</div>

		<div class="form-add">
			<h2>Detail Obat <a class="add_button" href="javascript:void(0)"><i class="btn btn-success fa fa-plus"></i></a></h2>
			<div class="form-group col-3">
				<label>Obat</label>
				<select name="KodeObat[]" onchange="maxjumlah(this.value)" class="form-control">
					<option hidden>Pilih Obat</option>
					<?php
					$qw = $db->get('obat');
					while ($rows = $db->fetch_array($qw)) {
						$kd= $rows['KodeObat'];
					?>
					<option <?php if($rows["JumlahObat"] == 0){ echo "Hidden=''"; } elseif($rows["JumlahObat"]<=10) {
						echo "class='alert-warning' title='Stok Hampir'";
					} ?> value="<?= $kd ?>"><?= $rows['NamaObat'].'['.$rows['JumlahObat'].'] | '.$rows['HargaObat']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-3">
				<label>Jumlah Obat</label>
				<input type="number" name="jumlah[]" id="jumlah" value="1" min="1" placeholder="Masukan jumlah obat" class="form-control">
			</div>
			<div class="form-group col-3">
				<label>Dosis</label>
				<input type="text" name="dosis[]" placeholder="Masukan Dosis" class="form-control">
			</div>
		</div>
		<input type="submit" id="submit" value="Save" name="save" class="btn btn-info" >
	</form>
</div>
<!-- Script -->
<script type="text/javascript">
$(document).ready(function(){
  	var fieldHTML = '<div class="form-chili"><div class="form-group col-3"><select name="KodeObat[]" class="form-control"><option hidden>Pilih Obat</option><?php $qw = $db->get("obat"); while ($rows = $db->fetch_array($qw)) { $kd= $rows["KodeObat"]; ?><option <?php if($rows["JumlahObat"] == 0){ ?> Disabled="" class="alert-danger" title="Stok Habis"<?php } elseif($rows["JumlahObat"]<=10) { ?> class="alert-warning" title="Stok Hampir"" <?php } ?> value="<?= $kd ?>"><?= $rows["NamaObat"] ?> [<?= $rows['JumlahObat']?>]| <?= $rows["HargaObat"] ?></option><?php } ?></select></div><div class="form-group col-3"><input type="number" name="jumlah[]" value="1" min="1" placeholder="Masukan Jumlah Obat" class="form-control"></div><div class="form-group col-3"><input type="text" name="dosis[]" placeholder="Masukan Dosis" class="form-control"></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="btn btn-warning fa fa-minus"></i></a></div>'; //New input field html 
  $(".add_button").click(function(){ //Once add button is clicked
          $(".form-add").append(fieldHTML); // Add field html
  });
  $(".form-add").on('click', '.remove_button', function(e){ //Once remove button is clicked
      e.preventDefault();
      $(this).parent('.form-chili').remove(); //Remove field html
      x--; //Decrement field counter
  });

});
$('tr').on('click',function(){
	data = $(this).find('td:nth-child(1)').text();
	$('#pendf').val(data);
	$("#Cek").slideUp("fash");
});
</script>

<?php
	if (isset($_POST['save'])) {

		//send data
		$noResep = $id;
		$KodeObat = $_POST['KodeObat'];
		$dosis = $_POST['dosis'];
		$jumlah = $_POST['jumlah'];
		$tanggal = date("Y-m-d");
		$totalharga = 0;

		//total harga obat
		foreach ($KodeObat as $key => $value) {
			$cekObat = $db->query("SELECT * FROM obat WHERE KodeObat = '$value'");
			$rowObat = $db->fetch_array($cekObat);
			$jumlahObat = $jumlah[$key];

			$obatResult = $rowObat['JumlahObat'] - $jumlahObat;
			if ($obatResult < 0) {
				$jumlahObat = $jumlahObat + $obatResult;
				$obatResult = 0;
			}

			$harga = $rowObat['HargaObat'] * $jumlahObat;
			$totalharga = $totalharga + $harga;
		}
		$totalharga = $totalharga + $data['TotalHarga'];
		$kembali = $data['Bayar'] - $totalharga;

		if ($kembali < 0) {
			$kembali = 0;
		}
		//Update resep
		$db->query("UPDATE resep SET TotalHarga = '$totalharga', Kembali = '$kembali' WHERE NomorResep = '$noResep'");

		//insert detail
		foreach ($KodeObat as $key => $value) {
			$cekObat = $db->query("SELECT * FROM obat WHERE KodeObat = '$value'");
			$rowObat = $db->fetch_array($cekObat);
			$jumlahObat = $jumlah[$key];

			$obatResult = $rowObat['JumlahObat'] - $jumlahObat;
			if ($obatResult < 0) {
				$jumlahObat = $jumlahObat + $obatResult;
				$obatResult = 0;
			}
			$db->query("UPDATE obat SET JumlahObat = '$obatResult' WHERE KodeObat = '$value'") or die(mysqli_error());
			
			//subtotal
			$harga = $rowObat['HargaObat'] * $jumlah[$key];

			$cekDet = $db->query("SELECT * FROM detail WHERE NomorResep = $noResep AND KodeObat = '$value'");
			if ($db->num_rows($cekDet) == 0) {
				$detailData = array('NomorResep' => $noResep,
									'KodeObat' => $value,
									'Jumlah' => $jumlahObat,
									'Dosis' => $dosis[$key],
									'Subtotal' => $harga
									);
				$sql2 = $db->insert('detail', $detailData);
			} else {
				$dataDet = $db->fetch_array($cekDet);
				$id_det = $dataDet['id_det'];
				$jumlahObat = $dataDet['Jumlah'] + $jumlahObat;
				$harga = $dataDet['SubTotal'] + $harga;
				$db->query("UPDATE detail SET Jumlah='$jumlahObat', Dosis = '$dosis[$key]', Subtotal = '$harga' WHERE id_det = '$id_det'");
			}
		}
		$session->set_flashdata('msg','<div id="popup">Data has been update</div>');
		refresh('?resep=detail&id='.$id);
	}