<?= $session->flashdata('msg'); ?>
<div class="content">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div style="padding-bottom:10px;">
				<h2>Petugas
					<a href="?user=add" title="add" class="btn btn-primary pull-right"><span class="fa fa-user-plus"></span> Create</a></h2>
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
				<input type="Search" id="Search" class="form-control" onkeyup="TableSearch()" placeholder="Search.." title="Type in a name" class="form-control">
			</div>
			<table class="table table-striped" id="Table">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th>Username</th>
					<th>Account Status</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$id = $_SESSION['id'];
						$qw = $db->query("SELECT * FROM petugas P, login L WHERE P.id_login = L.id_login");
						while($data = $db->fetch_array($qw)) {

						if($data['status'] == 'active'){
							if($data['online']=='true'){
								$onlinestat = 'online';
								$color = 'lime'; 
							} else {
								$onlinestat = 'offline';
								$color = 'red'; 
							}
						} else {
							$onlinestat = 'suspend';
							$color = 'grey';
						}

					?>
					<tr>
						<td><?= $no++ ?></td>
						<td id="OnlineStat_<?= $data['id_login'] ?>">
							<?php if ($data['Uid'] == $id):
							echo "<span title='online' class='fa fa-circle' style='color:lime'></span> ".$data['NamaUser'];
							else: ?>
							<?= "<span title=".$onlinestat." class='fa fa-circle' style='color:".$color."'></span> ".$data['NamaUser']; endif; ?>

						</td>
						<td><?= $data['username'] ?></td>
						<?php if ($data['Uid'] == $id): ?>
						<td><div class="btn btn-success" onclick="alert('You can not change your account status')">active</div></td>
						<td>
							<a href="?page=profil" class="btn btn-primary">Profil</a>
						</td>
						<?php else: ?>
						<td>
							<div id="statusLog" class="btn btn-<?php if($data['status']=='active'){ echo 'success'; } else { echo 'warning'; } ?>" onclick="stat(<?= $data['Uid'] ?>,<?php if($data['status']=='active'){ echo '0'; } else { echo '1'; } ?>)"><?= $data['status'] ?></div>
						</td>
						<td>
							<a href="?user=detail&&id=<?= $data['Uid'] ?>" class="btn btn-info"><span class="fa fa-info"></span> detail</a>
							<a href="?user=edit&&id=<?= $data['Uid'] ?>" class="btn btn-warning"><span class="fa fa-edit"></span> edit</a>
							<a href="?user=del&&id=<?= $data['id_login'] ?>" class="btn btn-danger"><span class="fa fa-trash"></span> delete</a>
						</td>
						<?php endif ?>
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
<script>
function stat(id,val) {
  $.ajax({
      url: '?user=status',
      type: 'get',
      data: "id="+id+"&val="+val,
      success: function (data) {
        viewdata()
      }
    });
}
function viewdata() {
	$.ajax({
		url: 'addons/table.php?table=user',
		type: 'get',
		data: {},
		success: function (data) {
			$('tbody').html(data);
	
		}
	});
}
</script>