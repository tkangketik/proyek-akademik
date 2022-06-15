<?= $session->flashdata('msg'); ?>
<div class="content">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div style="padding-bottom:10px;">
				<h2>Dokter
				<a href="?dokter=add" title="add" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Create</a>
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
				<input type="Search" id="Search" class="form-control" placeholder="Cari.." title="Type in a name" class="form-control">
			</div>
			<a href="?pdf=Dokter" class="btn btn-default"><span class="fa fa-file-pdf-o"></span> PDF</a>
			<table class="table table-striped" id="Table">
				<thead>
					<th>#</th>
					<th>Nama</th>
					<th>Spesialis</th>
					<th>Poliklinik</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$qw = $db->query("SELECT * FROM dokter D, poliklinik P WHERE D.KodePlk = P.KodePlk");
						while($data = $db->fetch_array($qw)) {
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td>Dr. <?= $data['NamaDkt'] ?></td>
						<td><?= $data['Spesialis'] ?></td>
						<td><?= $data['NamaPlk'] ?></td>
						<td>
							<a href="?dokter=detail&&id=<?= $data['KodeDkt'] ?>" class="btn btn-info"><span class="fa fa-info"></span> detail</a>
							<a href="?dokter=edit&&id=<?= $data['KodeDkt'] ?>" class="btn btn-warning"><span class="fa fa-edit"></span> edit</a>
							<a href="?dokter=del&&id=<?= $data['KodeDkt'] ?>" class="btn btn-danger"><span class="fa fa-trash"></span> delete</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>