<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Register<hr></h1>
	<form method="post">
	    <div class="form-group col-10">
	    	<label>Pasien</label>
	    	<input type="text" name="kodepsn" id="kodepsn" placeholder="Masukan Kode Pasien" class="form-control">
	    </div>
	    <div id="btnCek" class="btn btn-default">SearchData</div>
		<div id="Cek" style="display: none;">
			<fieldset>
				<legend>Data Pasien</legend>
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
							$qw = $db->query("SELECT * FROM pasien ORDER BY KodePsn DESC");
							while($data = $db->fetch_array($qw)) {
						?>
						<tr>
							<td><?= $data['KodePsn'] ?></td>
							<td><?= $data['NamaPsn'] ?></td>
							<td><?= $data['AlamatPsn'] ?></td>
							<td><?= $data['TeleponPsn'] ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				</div>
			</fieldset>
		</div>
	    <div class="form-group">
	    	<label>Keterangan</label>
	    	<select name="keterangan" class="form-control">
	    		<option>Pilih keterangan</option>
	    		<option>Rawat Jalan</option>
	    		<option>Rawat Inap</option>
	    	</select>
	    </div>
	    <div class="form-group">
	    		<label>Poliklinik</label>
	    		<select name="kodeplk" onchange="select(this.value);" class="form-control">
	    			<option hidden value="">Pilih Poliklinik</option>
	    			<?php $qw = $db->query('SELECT * FROM poliklinik');
	    			while ($data = $db->fetch_array($qw)) {
	    			echo '<option value='.$data["KodePlk"].';>'.$data["NamaPlk"].'</option>';
	    			} ?>
	    		</select>
	    	</div>
	    	<div class="form-group">
	    		<label>Dokter</label>
	    		<select name="kodedkt" id="dkt" class="form-control">
	    			<option hidden value="">Pilih Dokter</option>
	    		</select>
	    	</div>
	    <div style="color:grey;font-size: 12px;margin-top: 2em;">*Biaya Pendaftaran Rp50.000</div>
	    <div class="form-group">
	    	<input type="submit" name="save" value="Save" class="btn btn-primary">
	    </div>
	</form>
</div>

<script>
	function select(val){
		$.ajax({
			url: 'addons/dkt-option.php',
			type: 'get',
			data: {kodeplk:val},
			success: function (data) {
				$("#dkt").empty();
				$('#dkt').append(data);
			}
		});
	};
	$('tr').on('click',function(){
		data = $(this).find('td:nth-child(1)').text();
		$('#kodepsn').val(data);
		$("#Cek").slideUp("fash");
	});
</script>
<?php
	if (isset($_POST['save'])) {

		//pendaftaran
		$ket = $_POST['keterangan'];
		$tanggal = date("Y-m-d H:i:s");
		$kodedkt = $_POST['kodedkt'];
		$kodeplk = $_POST['kodeplk'];
		$kodepsn = $_POST['kodepsn'];

		$sql = $db->query("INSERT INTO pendaftaran(TanggalPendf,KodeDkt,KodePsn,KodePlk,Ket) VALUES ('$tanggal','$kodedkt','$kodepsn','$kodeplk','$ket')");
		refresh('?pasien=pendaftaran');
	}