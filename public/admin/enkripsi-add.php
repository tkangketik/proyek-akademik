<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<h1>Add
		<hr>
	</h1>
	<form method="post">
		<div class="form-group col-7">
			<label>Nama</label>
			<input type="text" id="kodepsn" name="kodepsn" placeholder="ID Pasien" class="form-control" required>
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
							<th>No. Pasien</th>
							<th>Nama</th>
							<th>Alamat</th>
						</thead>
						<tbody>
							<?php
							$qw = $db->query("SELECT * FROM pasien ORDER BY KodePsn DESC");
							while ($data = $db->fetch_array($qw)) {
							?>
								<tr>
									<td><?= $data['KodePsn'] ?></td>
									<td><?= $data['NamaPsn'] ?></td>
									<td><?= $data['AlamatPsn'] ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</fieldset>
		</div>
		<div class="form-group">
			<label>Pesan yang dienkripsi</label>
			<textarea name="hasil"><?php echo $_GET['hasil']; ?></textarea>
		</div>
		<div class="form-group">
			<label>Kunci</label>
			<input type="password" name="kunci" min="1" placeholder="Masukan Kunci" class="form-control" value="<?php echo $_GET['kunci']; ?>" required>
		</div>
		<div class="form-group">
			<input type="submit" name="save" value="Save" class="btn btn-primary">
		</div>
	</form>
</div>
<script>
	$('tr').on('click', function() {
		data = $(this).find('td:nth-child(1)').text();
		$('#kodepsn').val(data);
		$("#Cek").slideUp("fash");
	});
</script>
<?php
if (isset($_POST['save'])) {
	$kodepsn = $_POST['kodepsn'];
	$hasil = $_POST['hasil'];
	$kunci = $_POST['kunci'];

	$sql = $db->query("INSERT INTO enkripsi(KodePsn,hasil,kunci) VALUES ('$kodepsn','$hasil','$kunci')");
	// $InsertData = array(
	// 	'KodePsn' => $_POST['kodepsn'],
	// 	'hasil' => $_POST['hasil'],
	// 	'kunci' => $_POST['kunci'],
	// );

	// $sql = $db->insert('enkripsi', $InsertData);
	refresh('?enkripsi=list');
}
