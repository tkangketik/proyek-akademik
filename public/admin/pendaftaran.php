<div class="content">
	<a href="?pasien=list" class="btn btn-default"><i class="fa fa-caret-left"></i> Data Pasien</a>
	<br><br>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div style="padding-bottom:10px;">
				<h2>Daftar List
					<a href="?pasien=pendaftaran_add" title="Pendaftaran Pasien" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Create new</a>
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
					<th>Nomor Daftar</th>
					<th>Tanggal Daftar</th>
					<th>Pasien</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$qw = $db->query("SELECT * FROM pendaftaran D, pasien P WHERE D.KodePsn = P.KodePsn ORDER BY D.NomorPendf DESC");
						while($data = $db->fetch_array($qw)) {
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $data['NomorPendf'] ?></td>
						<td><?= date('d F Y',strtotime($data['TanggalPendf'])) ?></td>
						<td><a href="?pasien=detail&&id_pasien=<?= $data['KodePsn'] ?>"><?= $data['NamaPsn'] ?></a></td>
						<td>
							<a href="?pasien=detail&&id_pendf=<?= $data['NomorPendf'] ?>" class="btn btn-info"><span class="fa fa-info"></span> detail</a>
							<a href="?pasien=pendaftaran_edit&&id_pendf=<?= $data['NomorPendf'] ?>" class="btn btn-warning"><span class="fa fa-edit"></span> Edit</a>
							<?php if ($_SESSION['level']==2): ?>
							<a href="?pasien=del&&id_pendf=<?= $data['NomorPendf'] ?>" class="btn btn-danger"><span class="fa fa-trash"></span> delete</a>
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
		refresh("?pdf=Pendaftaran&&tgl=".$_POST['tgl']);
	}