<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<hr>
	<form method="post">
		<div class="form-group col-7">
		   	<label>Nomor Pendaftaran</label>
		   	<input type="text" id="pendf" name="pendf" class="form-control" placeholder="Masukan Nomor Pendaftaran">
		</div>
		<div id="btnCek" class="btn btn-default">SearchData</div>
		<div id="Cek" style="display: none;">
			<fieldset>
				<legend>Pendaftaran Data</legend>
				<div style="height: 200px; overflow-y: auto;">
				<div class="form-group col-3">
					<input type="Search" id="Search" class="form-control" onkeyup="TableSearch()" placeholder="Cari.." title="Type in a name" class="form-control">
				</div>
				<table class="table table-hover" id="Table">
					<thead>
						<th>Nomor Daftar</th>
						<th>Tanggal Daftar</th>
						<th>Pasien</th>
						<th>Dokter</th>
					</thead>
					<tbody>
					<?php
						$qw = $db->query("SELECT * FROM pendaftaran F, pasien P, dokter D WHERE F.KodePsn = P.KodePsn AND F.KodeDkt = D.KodeDkt ORDER BY F.NomorPendf DESC");
							while($data = $db->fetch_array($qw)) {

							$NomorPendf = $data['NomorPendf'];
							$cekbayar = $db->query("SELECT * FROM pembayaran WHERE NomorPendf = $NomorPendf");
							if ($db->num_rows($cekbayar) == 0){ 
						?>
						<tr>
							<td><?= $data['NomorPendf'] ?></td>
							<td><?= date('d F Y',strtotime($data['TanggalPendf'])) ?></td>
							<td><?= $data['NamaPsn'] ?></td>
							<td><?= $data['NamaDkt'] ?></td>
						</tr>
						<?php }} ?>
					</tbody>
				</table>
				</div>
			</fieldset>
		</div>
		<div class="form-group">
			<label>Jumlah Bayar</label>
			<input type="number" name="TotalHarga" id="TotalHarga" value="0" class="form-control" readonly>
		</div>
		<div class="form-group">
			<label>Bayar</label>
			<input type="number" min="0" name="bayar" value="0" id="bayar" placeholder="Masukan Bayar" value="0" class="form-control">
		</div>
		<div class="form-group">
			<label>Kembali</label>
			<input type="number" min="0" name="kembali" value="0" id="kembali" placeholder="Masukan Bayar" value="0" class="form-control" readonly>
		</div>
				
		<input type="submit" id="save" value="Save" name="save" class="btn btn-default" disabled="">
	</form>
</div>
<!-- Script -->
<script type="text/javascript">
	function no_pendf(val){
		$.ajax({
			url: 'addons/action.php?cek=pembayaran',
			type: 'get',
			data: {data:val},
			success: function (data) {
				$('#TotalHarga').val(data);
			}
		});
	}
	$('#bayar').on('keyup',function(){
		var TotalHarga = $('#TotalHarga').val();
		var kembali = this.value - TotalHarga;
		if (kembali < 0) {
			$('#kembali').val(0);
			$('#save').attr('disabled','').removeClass('btn-info').addClass('btn-default');
		} else {
			$('#kembali').val(kembali);
			$('#save').removeAttr('disabled').removeClass('btn-default').addClass('btn-info');
		}
	});
	$('#pendf').on('keyup',function(){
		no_pendf(this.value);
	});

	$('tr').on('click',function(){
		data = $(this).find('td:nth-child(1)').text();
		$('#pendf').val(data);
		no_pendf(data);
		$("#Cek").slideUp("fash");
	});
</script>

<?php
	if (isset($_POST['save'])) {
		//cek resep
		$JumlahByr = $_POST['TotalHarga'];
		$bayar = $_POST['bayar'];
		$kembali = $_POST['kembali'];
		$pendf = $_POST['pendf'];
		$TanggalByr = date('Y-m-d');

		$sql = $db->query("INSERT INTO pembayaran (NomorPendf,TanggalByr,JumlahByr, bayar, kembali) VALUES ('$pendf','$TanggalByr','$JumlahByr', $bayar, $kembali)");
	}