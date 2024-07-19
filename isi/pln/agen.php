<?php
$perintah = new oop();
$redirect = "?menu=agen";
$table = "agen";
@$where = " id = '$_GET[kd]'";
@$field = array('nama' => $_POST['nama'],
'jk' => $_POST['jk'],
'telp' => $_POST['telp'],
'username' => $_POST['username'],
'password' => $_POST['password'],);

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
      <div class="panel-heading"><?php if (@$_GET['kd'] == null) { echo "Input"; }else{ echo "Edit"; } ?> Agen</div>
      <div class="panel-body">
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" name="nama" value="<?php echo @$edit[1] ?>" placeholder="Nama" required>
        </div>
        <?php
          if(@$edit['jk']=="L"){
            $l = "checked";
          }elseif(@$edit['jk']=="P"){
            $p = "checked";
          }else {
            $l="";
            $p="";
          }
         ?>
        <div class="form-group">
          <label>Jenis Kelamin</label>
          <br>
          <label class="radio-inline">
            <input type="radio" name="jk" value="L" <?php echo @$l; ?>> Laki-laki
          </label>
          <label class="radio-inline">
            <input type="radio" name="jk" value="P" <?php echo @$p; ?>> Perempuan
          </label>
        </div>
        <div class="form-group">
          <label>Telpon</label>
          <input type="text" class="form-control" maxlength="15" name="telp" onkeypress="return event.charCode >=47 && event.charCode <=57 " value="<?php echo @$edit['telp'] ?>" placeholder="No. Telpon" required>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" maxlength="40" name="username" value="<?php echo @$edit['username'] ?>" placeholder="Username" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" maxlength="40" name="password" value="<?php echo @$edit['password'] ?>" placeholder="Password" required>
        </div>
        <div class="form-group">
          <a href="?menu=agen" class="btn btn-default">Reset</a>
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
          <h4>Data Agen</h4>
      </div>
      <div class="panel-body" style="overflow:auto;">
        <table id="tabel" class="table table-hover">
          <thead>
            <th>Nama</th>
            <th>JK</th>
            <th>Telpon</th>
            <th>Username</th>
            <th>Password</th>
            <th>Aksi</th>
          </thead>
          <?php 
               $tampung = mysql_query("SELECT * FROM agen");
                    $no = 0;
                    while ($print = mysql_fetch_array($tampung)) {
                      $no++;
            ?>
            <tr>
              <td><?php echo $print[1]; ?></td>
              <td><?php echo $print[2]; ?></td>
              <td><?php echo $print[3]; ?></td>
              <td><?php echo $print[4]; ?></td>
              <td><?php echo md5($print[5]); ?></td>
              <td>
                <a href="?menu=agen&edit&kd=<?php echo $print['0']; ?>" type="button" name="edit" class="btn btn-default glyphicon glyphicon-pencil"></a>
                <a href="?menu=agen&hapus&kd=<?php echo $print['0']; ?>" type="button" name="hapus" class="btn btn-default glyphicon glyphicon-trash"  onclick="return confirm('Hapus Data ?')"></a>
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
