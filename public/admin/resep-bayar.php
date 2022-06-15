<?php
$id = $_GET['id'];
$data = $db->query("SELECT * FROM resep WHERE NomorResep='$id'")->fetch_array();
?>
<div class='content'>
	<button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
	<hr>
	<form method="post">
		<div class="form-group">
			<label>Total Harga</label>
			<input type="number" id="TotalHarga" value="<?= $data['TotalHarga'] ?>" class="form-control" readonly>
		</div>
		<div class="form-group">
			<label>Bayar</label>
			<input type="number" min="0" name="bayar" value="<?= $data['Bayar'] ?>" id="bayar" placeholder="Masukan Bayar" value="0" class="form-control">
		</div>
		<div class="form-group">
			<label>Kembali</label>
			<input type="number" min="0" name="kembali" value="<?= $data['Kembali'] ?>" id="kembali" placeholder="Masukan Bayar" value="0" class="form-control" readonly>
		</div>
		<input type="submit" id="save" value="Save" name="save" class="btn btn-default" disabled="">
	</form>
</div>
<!-- Script -->
<script type="text/javascript">
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
</script>

<?php
	if (isset($_POST['save'])) {
		//cek resep
		$bayar = $_POST['bayar'];
		$kembali = $_POST['kembali'];

		$db->query("UPDATE resep SET Bayar = '$bayar',Kembali = '$kembali' WHERE NomorResep = '$id'");
		
		refresh('?resep=detail&id='.$id);
	}