<?= $session->flashdata('msg'); ?>
<div class="content">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div style="padding-bottom:10px;">
				<h2>Resep
				
				<a href="?resep=add" title="add" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Create New</a>
				</h2>
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
			<!-- pdf create -->
			<div id="pdf_btn" class="btn btn-default"><span class="fa fa-file-pdf-o"></span> PDF</div>
			<div id="pdf_check">
				<hr>
				<form method="post">
					<div class="form-group">
						<input type="date" name="tgl" class="form-control">
					</div>
					<input type="submit" name="report" class="btn btn-default" value="Create Report">
				</form>
			</div>

			<table class="table" id="Table">
				<thead>
					<th>#</th>
					<th>Pasien</th>
					<th>Tanggal</th>
					<th>Total Harga</th>
					<th>Bayar</th>
					<th>Kembali</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$qw = $db->query("SELECT * FROM resep R, pasien P WHERE R.KodePsn = P.KodePsn ORDER BY R.TanggalResep DESC");
						
						while($data = $db->fetch_array($qw)) {
					?>
					<tr <?php if ($data['Bayar'] == 0): ?> class="alert-danger" title="Belum membayar" <?php endif ?>>
						<td><?= $no++ ?></td>
						<td><a title="data pasien" href="?pasien=detail&&id_pasien=<?= $data['KodePsn'] ?>"> <?= $data['NamaPsn']; ?></a></td>
						<td><?= date('d F Y',strtotime($data['TanggalResep'])) ?></td>
						<td>Rp. <?= number_format($data['TotalHarga'] , 0 , '' , '.') ?></td>
						<td>Rp. <?= number_format($data['Bayar'] , 0 , '' , '.') ?></td>
						<td>Rp. <?= number_format($data['Kembali'] , 0 , '' , '.') ?></td>
						<td>
							<a href="?resep=bayar&&id=<?= $data['NomorResep'] ?>" class="btn btn-primary"><span class="fa fa-money"></span> Bayar</a>
							<a href="?resep=detail&&id=<?= $data['NomorResep'] ?>" class="btn btn-info"><span class="fa fa-info"></span> detail</a>
							<?php if ($_SESSION['level']==3): ?>
							<a href="?resep=del&&id=<?= $data['NomorResep'] ?>" class="btn btn-danger"><span class="fa fa-trash"></span> delete</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div class='pagination-container'>
            	<nav>
					<ul class="pagination"></ul>
            	</nav>
        	</div>
		</div>
	</div>
</div>
<?php 
	if (isset($_POST['report'])) {
		refresh("?pdf=Apotek&&tgl=".$_POST['tgl']);
	}
?>