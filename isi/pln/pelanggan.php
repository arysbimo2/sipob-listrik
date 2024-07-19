  <?php
$perintah = new oop();
$redirect = "?menu=pelanggan";
$table = "pelanggan";
$meter = date('dmyhis');
@$where = " kd_pelanggan = '$_GET[kd]'";
@$field = array('kd_pelanggan' => $_POST['kd_pelanggan'],
 'no_meter' => $_POST['no_meter'],
  'nama' => $_POST['nama'],
  'alamat' => $_POST['alamat'],
  'kd_tarif' => $_POST['kd_tarif'],
  'tenggang_waktu' => $_POST['tenggang_waktu'],);
if (!empty($_SESSION['name'])) {
  echo "<script>alert('Login Dahulu!!');document.location.href='../'</script>"; 
}

$sqlkode = mysql_fetch_array(mysql_query("SELECT * FROM pelanggan ORDER BY kd_pelanggan DESC"));
$kode = substr($sqlkode['kd_pelanggan'],5,3)+1;
$kdpel = sprintf("PEL"."%05s",$kode);

if (isset($_POST['simpan'])) {
  $perintah->simpan($table,$field,$redirect);
}
if (isset($_GET['hapus'])) {
	$perintah->hapus($table,$where,$redirect);
}
if (isset($_GET['edit'])) {
  $edit=$perintah->edit($table,$where);
}
if (isset($_POST['update'])) {
  $perintah->ubah($table,$field,$where,$redirect);
}
 ?>
<form method="post">
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">Input Pelanggan</div>
        <div class="panel-body">
          <div class="form-group">
            <label>ID Pelanggan</label>
            <input type="text" class="form-control" name="kd_pelanggan" value="<?php if(@$_GET['kd']==""){echo $kdpel;}else{echo $edit['kd_pelanggan'];} ?>" readonly>
          </div>
          <div class="form-group">
            <label>No. Meter</label>
            <input type="text" class="form-control" name="no_meter" value="<?php if(@$edit != null){echo @$edit[1]; }else{echo $meter; } ?>" readonly="" placeholder="No. Meter" required>
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" value="<?php echo @$edit[2] ?>" placeholder="Nama" required>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" cols="80" value="" placeholder="Alamat"><?php echo @$edit[3] ?></textarea>
          </div>
          <div class="form-group">
            <label>Tarif</label>
            <select class="form-control" name="kd_tarif">
              <?php
              $sql = mysql_query("SELECT * FROM tarif");
              while ($tampil = mysql_fetch_array($sql)) { ?>
                <option value="<?php echo $tampil[0] ?>"><?php echo $tampil[0] ?>(<?php echo $tampil[1]; ?> VA /<?php echo $tampil[2]; ?> KWH)</option>
              <?php
              }
               ?>
            </select>
          </div>
          <input type="hidden" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="tenggang_waktu" value="<?php echo date('d') ?>" placeholder="Tenggang Waktu" required>
          <!-- <div class="form-group">
            <label>Tenggang Waktu</label>
            <input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="tenggang_waktu" value="<?php echo @$edit[5] ?>" placeholder="Tenggang Waktu" required>
          </div> -->
          <div class="form-group">
            <a href="?menu=pelanggan" class="btn btn-default">Reset</a>
            <?php if (@$_GET['kd']==""){ ?>
              <input type="submit" value="Simpan" class="btn btn-primary" name="simpan">
            <?php }else{ ?>
              <input type="submit" value="Update" class="btn btn-warning" name="update">
            <?php } ?>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Data Pelanggan</h4>
        </div>
        <div class="panel-body" style="overflow:auto;">
          <table id="tabel" class="table table-hover">
            <thead>
              <th>ID Pelanggan</th>
              <th>No. Meter</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Tarif</th>
              <th>Tenggang Waktu</th>
              <th>Aksi</th>
            </thead>
            <?php 
               $tampung = mysql_query("SELECT * FROM pelanggan");
               $no = 0;
               while ($print = mysql_fetch_array($tampung)) {
                $no++;
            ?>
            <tr>
              <td><?php echo $print[0]; ?></td>
              <td><?php echo $print[1]; ?></td>
              <td><?php echo $print[2]; ?></td>
              <td><?php echo $print[3]; ?></td>
              <td><?php echo $print[4]; ?></td>
              <td><?php echo $print[5]; ?></td>
              <td>
                <a href="?menu=pelanggan&edit&kd=<?php echo $print['0']; ?>" type="button" name="edit" class="btn btn-default glyphicon glyphicon-pencil"></a>
                <a href="?menu=pelanggan&hapus&kd=<?php echo $print['0']; ?>" type="button" name="hapus" class="btn btn-default glyphicon glyphicon-trash"  onclick="return confirm('Hapus Data ?')"></a>
              </td>
            </tr>
           
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
