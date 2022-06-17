<div class="content">
    <div>
        <button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
        <h2>Detail | <a href="?pdf=Pasien&id=<?= $_GET['id']; ?>" class="btn btn-default"><span class="fa fa-print"></span> Print</a>
    </div>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = $db->query("SELECT * FROM enkripsi INNER JOIN pasien on enkripsi.KodePsn = pasien.KodePsn INNER JOIN resep on enkripsi.KodePsn = resep.KodePsn INNER JOIN dokter on resep.KodeDkt = dokter.KodeDkt WHERE id = '$id'")->fetch_array();
    ?>
        <table class="table table-striped">
            <tr>
                <td width="30%">Kode Pasien</td>
                <td><?= $data['KodePsn'] ?></td>
            </tr>
            <tr>
                <td>Nama Pasien</td>
                <td><?= $data['NamaPsn'] ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?= $data['AlamatPsn'] ?></td>
            </tr>
            <tr>
                <td>Nama Dokter</td>
                <td>dr. <?= $data['NamaDkt'] ?></td>
            </tr>
            <tr>
                <td>Hasil Enkripsi</td>
                <td><code><?= $data['hasil'] ?></code></td>
            </tr>
            <!-- <tr>
                <td colspan="2"><a href="?pasien=edit&&id_pasien=<?= $id ?>" class="btn btn-primary"><span class="fa fa-edit"></span> edit</a><a href="?pasien=del&&id_pasien=<?= $id ?>" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</a></td>
            </tr> -->
        </table>
    <?php } else {
        $id = $_GET['id_pendf'];
        $data = $db->query("SELECT * FROM pendaftaran F, pasien P, dokter D, poliklinik K WHERE F.KodePsn = P.KodePsn AND F.KodeDkt = D.KodeDkt AND F.KodePlk = K.KodePlk AND F.NomorPendf = '$id'")->fetch_array();
    ?>
        <table class="table table-striped">
            <tr>
                <td width="30%">Nomor Pendaftaran</td>
                <td><?= $data['NomorPendf'] ?></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td><?= $data['Ket'] ?></td>
            </tr>
            <tr>
                <td>Nama Pasien</td>
                <td><a href="?pasien=detail&id_pasien=<?= $data['KodePsn'] ?>"><?= $data['NamaPsn'] ?></a></td>
            </tr>
            <tr>
                <td>Dokter</td>
                <td><a href="?dokter=detail&id=<?= $data['KodeDkt'] ?>"><?= $data['NamaDkt'] ?></a></td>
            </tr>
            <tr>
                <td>Poliklinik</td>
                <td><?= $data['NamaPlk'] ?></td>
            </tr>
            <tr>
                <td>Tanggal Daftar</td>
                <td><?= $data['TanggalPendf'] ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="?pasien=pendaftaran_edit&&id_pendf=<?= $id ?>" class="btn btn-primary"><span class="fa fa-edit"></span> Edit</a>
                    <a href="?pasien=del&&id_pendf=<?= $id ?>" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</a>
                </td>
            </tr>
        </table>
    <?php } ?>
</div>