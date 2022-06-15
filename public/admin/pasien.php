<?= $session->flashdata('msg'); ?>
<div class="content">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div style="padding-bottom:10px;">
				<h2>Pasien
					<a href="?pasien=add" title="Pendaftaran Pasien Baru" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Create New</a>
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
				<input type="Search" id="Search" onkeyup="TableSearch()" placeholder="Cari Nama Pasien.." title="Type in a name" class="form-control">
			</div>
			<a href="?pasien=pendaftaran" class="btn btn-primary"><span class="fa fa-list-alt"></span> Data Pendaftar</a>
			<table class="table table-striped" id="Table">
				<thead>
					<th>#</th>
					<th>Nama</th>
					<th>Jenis Kelamin</th>
					<th>Umur</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$qw = $db->query("SELECT * FROM pasien ORDER BY KodePsn DESC");
						while($data = $db->fetch_array($qw)) {
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $data['NamaPsn'] ?></td>
						<td><?= $data['GenderPsn'] ?></td>
						<td>
							<?php
								$tanggal_lahir =new DateTime($data['TanggalLahir']);
								$today = new DateTime();
								$umur = $today->diff($tanggal_lahir);
								if ($umur->y > 0) {
									echo $umur->y." Tahun";
								} else {
									echo $umur->m." Bulan";
								}
							 ?> 
						</td>
						<td>
							<a href="?pasien=detail&id_pasien=<?= $data['KodePsn'] ?>" class="btn btn-info"><span class="fa fa-info"></span> detail</a>
							<a href="?pasien=edit&id_pasien=<?= $data['KodePsn'] ?>" class="btn btn-warning"><span class="fa fa-edit"></span> edit</a>
							<?php if ($_SESSION['level']==2): ?>
							<a href="?pasien=del&id_pasien=<?= $data['KodePsn'] ?>" class="btn btn-danger"><span class="fa fa-trash"></span> delete</a>
							<?php endif ?>
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