<?php
require_once "koneksi.php";
session_start();

switch ($_GET['table']) {
	case 'poliklinik':
		$no = 1;
		$qw = $mysqli->query("SELECT * FROM poliklinik");
		while($data = $qw->fetch_array()) {
		?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $data['NamaPlk'] ?></td>
			<td>
				<a href="?poliklinik=edit&&id=<?= $data['KodePlk'] ?>" class="btn btn-primary"><span class="fa fa-edit"></span> edit</a>
				<div onclick="delete_data(<?= $data['KodePlk'] ?>)" class="btn btn-danger"><span class="fa fa-trash"></span> delete</div>
			</td>
		</tr>
		<?php } return;
		break;
	
	case 'pembayaran':
		$no = 1;
		$qw = $mysqli->query("SELECT * FROM pembayaran B, pendaftaran F, dokter D, pasien P WHERE B.NomorPendf = F.NomorPendf AND F.KodeDkt = D.KodeDkt AND F.KodePsn = P.KodePsn ORDER BY B.NomorByr DESC");
		while($data = $qw->fetch_array()) {
		?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $data['NamaPsn'] ?></td>
			<td><?= $data['NamaDkt'] ?></td>
			<td><?= date('d F Y',strtotime($data['TanggalByr'])) ?></td>
			<td>Rp. <?= number_format($data['JumlahByr'] , 0 , '' , '.') ?></td>
<!-- 			<td>
				<a href="?pembayaran=del&&id=<?= $data['NomorByr'] ?>" class="btn btn-danger"><span class="fa fa-trash"></span> delete</a>
			</td> -->
		</tr>
		<?php } return;
		break;
	case 'user':
			$no = 1;
			$id = $_SESSION['id'];
			$qw = $mysqli->query("SELECT * FROM petugas P, login L WHERE P.id_login = L.id_login");
			while($data = $qw->fetch_array()) {

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
				<?= "<span title=".$onlinestat." class='fa fa-circle' style='color:".$color."'></span> ".$data['NamaUser'] ?>
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
		<?php } return;
		break;
}