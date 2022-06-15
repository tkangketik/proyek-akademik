<?= $session->flashdata('msg'); ?>
<div class="content">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div style="padding-bottom:10px;">
				<h2>Pembayaran <a href="?pembayaran=add" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Create New</a>
			</div>
		</div>
		<div class="panel-body">
			<div class="form-group col-3">
				<label>Rows</label>
				<select name="Row" id="maxRows" class="form-control">
					<option value="5000">Show All</option>
					<option value="20">20</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
					<option value="250">250</option>
					<option value="500">500</option>
				</select>
			</div>
			<div class="form-group col-3">
				<input type="Search" id="Search" class="form-control" onkeyup="TableSearch()" placeholder="Cari.." title="Type in a name" class="form-control">
			</div>
			<?php if ($_SESSION['level']==0): ?>
			<div id="pdf_btn" class="btn btn-default"><span class="fa fa-file-pdf-o"></span> PDF</div>
			<?php endif ?>
			<div id="pdf_check">
				<hr>
				<form method="post">
					<div class="form-group">
						<input type="date" name="tgl" class="form-control">
					</div>
						<input type="submit" name="report" class="btn btn-default" value="Create Report">
				</form>
			</div>
			<table class="table table-striped" id="Table">
				<thead>
					<th>#</th>
					<th>Pasien</th>
					<th>Dokter</th>
					<th>Tanggal</th>
					<th>Biaya</th>
					<th>Bayar</th>
					<th>Kembali</th>
					<!-- <th>Action</th> -->
				</thead>
				<tbody>
					<?php
						$no = 1;
						$qw = $db->query("SELECT * FROM pembayaran B, pendaftaran F, dokter D, pasien P WHERE B.NomorPendf = F.NomorPendf AND F.KodeDkt = D.KodeDkt AND F.KodePsn = P.KodePsn ORDER BY B.NomorByr DESC");
						while($data = $db->fetch_array($qw)) {
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $data['NamaPsn'] ?></td>
						<td><?= $data['NamaDkt'] ?></td>
						<td><?= date('d F Y',strtotime($data['TanggalByr'])) ?></td>
						<td>Rp. <?= number_format($data['JumlahByr'] , 0 , '' , '.') ?></td>
						<td>Rp. <?= number_format($data['bayar'] , 0 , '' , '.') ?></td>
						<td>Rp. <?= number_format($data['kembali'] , 0 , '' , '.') ?></td>
						<!-- <td>
							<div onclick="delete_data(<?= $data['NomorByr'] ?>)" class="btn btn-danger"><span class="fa fa-trash"></span> delete</div>
						</td> -->
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	function adddata(){
		var pendf = $('#pendf').val();
		var bayar = $('#bayar').val();
		if (pendf == '') {
			alert();
		} else {
			$.ajax({
				url: 'addons/action.php?pembayaran',
				type: 'post',
				data: 'pendf='+pendf+'$bayar='+bayar,
				success: function (data) {
					viewdata();
					$('#add').slideToggle('fash');
					$('#pendf').val('');
				}
			});	
		}
	}
	function viewdata(){
		$.ajax({
			url: 'addons/table.php?table=pembayaran',
			type: 'get',
			data: {},
			success: function (data) {
				$('tbody').html(data);
		
			}
		});
	}
	function delete_data(id){
		$.ajax({
			url: 'addons/action.php?delete=pembayaran',
			type: 'post',
			data: 'id='+id,
			success: function (data) {
				viewdata();
			}
		});
	}

	

</script>
<?php

	if (isset($_POST['report'])) {
		refresh("?pdf=Pembayaran&&tgl=".$_POST['tgl']);
	}