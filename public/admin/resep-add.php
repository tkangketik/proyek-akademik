<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Add<hr></h1>
	<form method="post">
		<div class="form-group col-10">
			<label>Nomor Pendaftaran</label>
			<input type="number" name="pendf" id="pendf" maxlength="11" placeholder="Masukan Nomor Pendaftaran" class="form-control" required readonly>
		</div>
		<div id="btnCek" class="btn btn-default">SearchData</div>

		<!-- Cek Data -->
		<div id="Cek" style="display: none;">
			<fieldset>
				<legend>Data Pendaftaran</legend>
				<div style="height: 200px; overflow-y: auto;">
				<div class="form-group col-3">
					<input type="Search" id="Search" class="form-control" onkeyup="TableSearch()" placeholder="Cari.." title="Type in a name" class="form-control">
				</div>
				<table class="table table-hover" id="Table">
					<thead>
						<th>Nomor Daftar</th>
						<th>Pasien</th>
						<th>Dokter</th>
						<th>Poliklinik</th>
					</thead>
					<tbody>
						<?php
							$no = 1;
							$qw = $db->query("SELECT * FROM pendaftaran F, pasien P, dokter D, poliklinik K WHERE F.KodePsn = P.KodePsn AND F.KodeDkt = D.KodeDkt AND F.KodePlk = K.KodePlk ORDER BY F.NomorPendf DESC");
							while($data = $db->fetch_array($qw)) {

							$KodePsn = $data['KodePsn'];
							$KodeDkt = $data['KodeDkt'];
							$KodePlk = $data['KodePlk'];
							$cekresep = $db->query("SELECT * FROM resep WHERE KodePsn = $KodePsn AND KodeDkt = $KodeDkt AND KodePlk = $KodePlk");
						
						if ($db->num_rows($cekresep) == 0){ ?>
						<tr>
							<td><?= $data['NomorPendf'] ?></td>
							<td><?= $data['NamaPsn'] ?></td>
							<td><?= $data['NamaDkt'] ?></td>
							<td><?= $data['NamaPlk'] ?></td>
						</tr>
						<?php }} ?>
					</tbody>
				</table>
				</div>
			</fieldset>
		</div>

		<div class="form-add">
			<h2>Detail Obat <a class="add_button" href="javascript:void(0)"><i class="btn btn-success fa fa-plus"></i></a></h2>
			<div class="form-chili">
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
		</div>
		<input type="submit" id="submit" value="Save" name="save" class="btn btn-default">
	</form>
</div>
<!-- Script -->
<script type="text/javascript">
$(document).ready(function(){
	var x = 1;
  $(".add_button").click(function(){ //Once add button is clicked
  		i = x++;
  		var fieldHTML = '<div class="form-chili"><div class="form-group col-3"><select name="KodeObat[]" class="form-control"><option hidden>Pilih Obat</option><?php $qw = $db->get("obat"); while ($rows = $db->fetch_array($qw)) { $kd= $rows["KodeObat"]; ?><option <?php if($rows["JumlahObat"] == 0){ ?> Disabled="" class="alert-danger" title="Stok Habis"<?php } elseif($rows["JumlahObat"]<=10) { ?> class="alert-warning" title="Stok Hampir"" <?php } ?> value="<?= $kd ?>"><?= $rows["NamaObat"] ?> [<?= $rows['JumlahObat']?>]| <?= $rows["HargaObat"] ?></option><?php } ?></select></div><div class="form-group col-3"><input type="number" name="jumlah[]" value="1" min="1" placeholder="Masukan Jumlah Obat" class="form-control"></div><div class="form-group col-3"><input type="text" name="dosis[]" placeholder="Masukan Dosis" class="form-control"></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="btn btn-warning fa fa-minus"></i></a></div>'; //New input field html 
        $(".form-add").append(fieldHTML); // Add field html
  });
  $(".form-add").on('click', '.remove_button', function(e){ //Once remove button is clicked
      e.preventDefault();
      $(this).parent('.form-chili').remove(); //Remove field html
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
		//cek resep
		$qwResep = $db->query('SELECT NomorResep FROM resep ORDER BY NomorResep DESC LIMIT 0, 1');
		$rowResep = $db->fetch_array($qwResep);
		$noResep = $rowResep['NomorResep']+1;

		//send data
		$nopendf = $_POST['pendf'];
		$KodeObat = $_POST['KodeObat'];
		$dosis = $_POST['dosis'];
		$jumlah = $_POST['jumlah'];
		$tanggal = date("Y-m-d");
		$totalharga = 0;

		//cek poliklinik
		$cekpendf = $db->query("SELECT * FROM pendaftaran WHERE NomorPendf = '$nopendf'");
		$rowpendf = $db->fetch_array($cekpendf);
		$KodeDkt = $rowpendf['KodeDkt'];
		$KodePsn = $rowpendf['KodePsn'];
		$KodePlk = $rowpendf['KodePlk'];

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

		//insert resep
		$resepData = array(	'NomorResep' => $noResep,
							'TanggalResep' => $tanggal,
							'KodeDkt' => $KodeDkt,
							'KodePsn' => $KodePsn,
							'KodePlk' => $KodePlk,
							'TotalHarga' => $totalharga,
							'Bayar' => 0,
							'Kembali' => 0
							);
		$sql = $db->insert('resep', $resepData);
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
			$harga = $rowObat['HargaObat'] * $jumlahObat;


			$detailData = array('NomorResep' => $noResep,
								'KodeObat' => $value,
								'Jumlah' => $jumlahObat,
								'Dosis' => $dosis[$key],
								'Subtotal' => $harga
								);
			$sql2 = $db->insert('detail', $detailData);

		}
		
		$session->set_flashdata('msg','<div id="popup">Created Data Successful</div>');
		refresh('?resep=detail&id='.$noResep);
	}