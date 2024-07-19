<?php
$perintah = new oop();
$redirect = "?menu=tarif";
$table = "tarif";
@$where = " kd_tarif = '$_GET[kd]'";
@$field = array('kd_tarif' => $_POST['kd_tarif'], 'daya' => $_POST['daya'], 'tarif' => $_POST['tarif']);

$sqlkode = mysql_fetch_array(mysql_query("SELECT * FROM tarif ORDER BY kd_tarif DESC"));
$kode = substr($sqlkode['kd_tarif'],5,3)+1;
$kdtarif = sprintf("TAR"."%05s",$kode);

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
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">Input Tarif</div>
        <div class="panel-body">
          <div class="form-group">
            <label>Kode</label>
            <input type="text" class="form-control" name="kd_tarif" value="<?php if(@$_GET['kd']==""){echo $kdtarif;}else{echo $edit['kd_tarif'];} ?>" readonly>
          </div>
          <div class="form-group">
            <label>Daya</label>
            <input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="daya" value="<?php echo @$edit[1] ?>" placeholder="Daya" required>
          </div>
          <div class="form-group">
            <label>Tarif</label>
            <input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="tarif" value="<?php echo @$edit[2] ?>" placeholder="Tarif" required>
          </div>
          <div class="form-group">
           <a href="?menu=tarif" class="btn btn-default">Reset</a>
            <?php if (@$_GET['kd']==""){ ?>
              <input type="submit" value="Simpan" class="btn btn-primary" name="simpan">
            <?php }else{ ?>
              <input type="submit" value="Update" class="btn btn-warning" name="update">
            <?php } ?>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-7">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Data Tarif</h4>
        </div>
        <div class="panel-body">
          <table id="tabel" class="table table-hover">
            <thead>
              <th>Kode Tarif</th>
              <th>Daya</th>
              <th>Tarif</th>
              <th>Aksi</th>
            </thead>
           <?php 
               $tampung = mysql_query("SELECT * FROM tarif");
                    $no = 0;
                    while ($print = mysql_fetch_array($tampung)) {
                      $no++;
            ?>
            <tr>
              <td><?php echo $print[0]; ?></td>
              <td><?php echo $print[1]; ?></td>
              <td><?php echo $print[2]; ?></td>
              <td>
                <a href="?menu=tarif&edit&kd=<?php echo $print['0']; ?>" type="button" name="edit" class="btn btn-default glyphicon glyphicon-pencil"></a><!-- 
                <a href="?menu=tarif&hapus&kd=<?php echo $print['0']; ?>" type="button" name="hapus" class="btn btn-default glyphicon glyphicon-trash"  onclick="return confirm('Hapus Data ?')"></a> -->
              </td>
            </tr>
            <?php } ?>
             <tfoot>
              <th>Kode Tarif</th>
              <th>Daya</th>
              <th>Tarif</th>
              <th>Aksi</th>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
