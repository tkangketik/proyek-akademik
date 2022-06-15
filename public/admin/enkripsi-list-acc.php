<div class="content">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div style="padding-bottom:10px;">
                <h2>Daftar Permintaan Akses
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
                    <th>Hasil Keterangan Resep</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <tbody>
                    <?php
                    $no = 1;
                    $qw = $db->query("SELECT * FROM enkripsi ORDER BY id DESC");
                    while ($data = $db->fetch_array($qw)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['hasil'] ?></td>
                            <td><?php if ($data['status'] == 0) { echo "belum disetujui"; } else { echo "setuju"; } ?></td>
                            <td>
                                <form method="post" action="?enkripsi=res-acc&&id=<?= $data['id'] ?>">
                            <input type="hidden" value="1" name="status">
                            <button type="submit" class="btn btn-success"><span class="fa fa-check"></span> setuju</button>
                            </form>
                            <form method="post" action="?enkripsi=res-deny&&id=<?= $data['id'] ?>">
                            <input type="hidden" value="0" name="status">
                            <button type="submit" class="btn btn-danger"><span class="fa fa-times"></span> tidak setuju</button>
                            </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>