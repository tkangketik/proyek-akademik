<?= $session->flashdata('msg'); ?>
<div class="content">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div style="padding-bottom:10px;">
				<h2>Poliklinik 
					<div id="addbtn" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Create</div>
				</h2>
			</div>
		</div>
		<div class="panel-body">
			<div id="alert"></div>
			<div id="add" style="display: none;">
				<div class="form-group">
	    			<label>Nama Poliklinik</label>
	    			<input type="text" id="nama" placeholder="Masukan Nama Poliklinik" class="form-control">
	    		</div>
	    		<div class="form-group">
	    			<input type="submit" onclick="adddata()" value="Save" class="btn btn-primary">
	    		</div>
	    		<hr>
			</div>
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
			<a href="?pdf=Poliklinik" class="btn btn-default"><span class="fa fa-file-pdf-o"></span> PDF</a>
			<table class="table table-striped" id="Table">
				<thead>
					<th>#</th>
					<th>Nama</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$qw = $db->query("SELECT * FROM poliklinik");
						while($data = $db->fetch_array($qw)) {
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $data['NamaPlk'] ?></td>
						<td>
							<a href="?poliklinik=edit&&id=<?= $data['KodePlk'] ?>" class="btn btn-warning"><span class="fa fa-edit"></span> edit</a>
							<div onclick="delete_data(<?= $data['KodePlk'] ?>)" class="btn btn-danger"><span class="fa fa-trash"></span> delete</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	function adddata(){
		var nama = $('#nama').val();
		if (nama == '') {
			$('#nama').addClass('alert-warning').attr('title');
		} else {
			$.ajax({
				url: 'addons/action.php?poliklinik',
				type: 'post',
				data: 'nama='+nama,
				success: function (data) {
					viewdata();
					$('#add').slideToggle('fash');
					$('#nama').val('');
				}
			});	
		}
	}
	function viewdata(){
		$.ajax({
			url: 'addons/table.php?table=poliklinik',
			type: 'get',
			data: {},
			success: function (data) {
				$('tbody').html(data);
		
			}
		});
	}
	function delete_data(id){
		$.ajax({
			url: 'addons/action.php?delete=poliklinik',
			type: 'post',
			data: 'id='+id,
			success: function (data) {
				viewdata();
			}
		});	
	}
</script>