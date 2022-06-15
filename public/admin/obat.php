<div class="content">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div style="padding-bottom:10px;">
				<h2>Obat
					<a href="?obat=add" title="add" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Create</a></h2>
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
			<table class="table" id="table">
				<thead>
					<th>#</th>
					<th>Nama</th>
					<th>Jenis</th>
					<th>Kategori</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$qw = $db->query("SELECT * FROM obat");
						while($data = $db->fetch_array($qw)) {
					?>
					<tr <?php if($data['JumlahObat'] == 0){ echo "class='alert-danger' title='Stok Habis'"; } elseif($data['JumlahObat'] <= 10) { echo "class='alert-warning' title='Stok Hampir Habis'"; } ?>>
						<td><?= $no++ ?></td>
						<td><?= $data['NamaObat'] ?></td>
						<td><?= $data['JenisObat'] ?></td>
						<td><?= $data['Kategori'] ?></td>
						<td>Rp. <?= number_format($data['HargaObat'] , 0 , '' , '.') ?></td>
						<td><?= $data['JumlahObat'] ?></td>
						<td>
							<a href="?obat=edit&&id=<?= $data['KodeObat'] ?>" class="btn btn-warning"><span class="fa fa-edit"></span> edit</a>
							<?php if ($_SESSION['level']==1): ?>
							<a href="?obat=del&&id=<?= $data['KodeObat'] ?>" class="btn btn-danger"><span class="fa fa-trash"></span> delete</a>
						<?php endif; ?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>