<div class="content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div style="padding-bottom:10px;">
        <h2>Enkripsi & Dekripsi
          <a href="?enkripsi=encrypt" title="add" class="btn btn-primary pull-right"><span class="fa fa-lock"></span> Enkripsi Data</a>
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
      <?php $notif = $db->query("SELECT * FROM enkripsi where status=0");?>
      <?php if ($_SESSION['level'] == 0) { ?>
        <a href="?enkripsi=list-acc" title="add" class="btn btn-success"><span><?= $notif->num_rows; ?></span> Permintaan Akses</a></h2>
        <a href="?enkripsi=add" title="add" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah data</a></h2>
      <?php } else { ?>
        <a href="?enkripsi=add" title="add" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah data</a></h2>
      <?php } ?>
      <table class="table" id="table">
        <thead>
          <th>#</th>
          <th>Nama</th>
          <th>Hasil Keterangan Resep</th>
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
              <td>
                <?php if ($_SESSION['level'] == 0) { ?>
                  <a href="?enkripsi=decrypt&&msg=<?= $data['hasil'] ?>" class="btn btn-success"><span class="fa fa-unlock"></span> dekripsi</a>
                  <a href="?enkripsi=detail&&id=<?= $data['id'] ?>" class="btn btn-info"><span class="fa fa-info"></span> detail</a>
                  <a href="?enkripsi=edit&&id=<?= $data['id'] ?>" class="btn btn-warning"><span class="fa fa-edit"></span> edit</a>
                  <a href="?enkripsi=del&&id=<?= $data['id'] ?>" class="btn btn-danger"><span class="fa fa-trash"></span> delete</a>
                <?php } else if ($data['status'] == 0) { ?>
                  <form method="post" action="?enkripsi=req-acc&&id=<?= $data['id'] ?>">
                    <input type="hidden" name="req" value="1">
                    <button type="submit" class="btn btn-primary" name="save"><span class="fa fa-lock"></span> minta akses</button>
                  </form>
                <?php } else { ?>
                  <a href="?enkripsi=decrypt&&msg=<?= $data['hasil'] ?>&&kunci=<?= $data['kunci']?>" class="btn btn-success"><span class="fa fa-unlock"></span> dekripsi</a>
                  <a href="?enkripsi=detail&&id=<?= $data['id'] ?>" class="btn btn-info"><span class="fa fa-info"></span> detail</a>
                  <a href="?enkripsi=edit&&id=<?= $data['id'] ?>" class="btn btn-warning"><span class="fa fa-edit"></span> edit</a>
                  <a href="?enkripsi=del&&id=<?= $data['id'] ?>" class="btn btn-danger"><span class="fa fa-trash"></span> delete</a>
              </td>
            </tr>
        <?php }
              } ?>
        </tbody>

        </tbody>
      </table>
    </div>
  </div>
</div>