<?php
date_default_timezone_set('Asia/Jakarta');
@session_start();
$perintah = new oop();
$redirect = "?menu=penggunaan";
$table = "penggunaan";
$table2 = "tagihan";
@$where = " kd_penggunaan = '$_GET[kd]'";
$sqlkode = mysql_fetch_array(mysql_query("SELECT * FROM penggunaan ORDER BY kd_penggunaan DESC"));
$kode = substr($sqlkode['kd_penggunaan'],5,3)+1;
$kdpel = sprintf("PGN"."%05s",$kode);
$tgn = date('dmYHis');
$kd_tagihan = "TGN".$tgn;

if (isset($_POST['kd_pelanggan'])) {
  $sql = mysql_query("SELECT pelanggan.kd_pelanggan, pelanggan.no_meter, pelanggan.nama, tarif.kd_tarif, tarif.daya, tarif.tarif from pelanggan
    INNER JOIN tarif on pelanggan.kd_tarif = tarif.kd_tarif WHERE kd_pelanggan = '$_POST[kd_pelanggan]'");
  $ambil = mysql_fetch_array($sql);
  $sqls = mysql_query("SELECT MAX(meter_akhir) AS kode, kd_pelanggan FROM penggunaan WHERE kd_pelanggan = '$ambil[0]'");
  $cek_ambil = mysql_fetch_assoc($sqls);
  
}
@$field = array(
  'kd_penggunaan' => $_POST['kd_penggunaan'] ,
  'kd_pelanggan' => $_POST['kd_pelanggan'] ,
  'bulan' => $_POST['bulan'] ,
  'tahun' => $_POST['tahun'] ,
  'meter_awal' => $_POST['meter_awal'] ,
  'meter_akhir' => $_POST['meter_akhir'],
  'status' => '0'  
);
@$field2 = array(
  'kd_tagihan' => $kd_tagihan ,
  'kd_penggunaan' => $_POST['kd_penggunaan'] ,
  'kd_pelanggan' => $_POST['kd_pelanggan'] ,
  'bulan' => $_POST['bulan'] ,
  'tahun' => $_POST['tahun'] ,
  'jumlah_meter' => $_POST['jumlah_meter'] ,
  'total_tagihan' => $_POST['total_tagihan'] ,
  'status' => '0'  
);
$field3 = array('status' => '1' );
  if (isset($_POST['simpan'])) {
    if ($_POST['meter_akhir'] < $_POST['meter_awal']) {
      $_SESSION['pesan'] = 'Meteran Akhir Lebih Kecil dari Meter Awal..!';
    }else{
      $try = mysql_query("SELECT bulan, tahun FROM penggunaan WHERE kd_pelanggan = '$_POST[kd_pelanggan]' order by kd_penggunaan DESC");
      $cek_try = mysql_fetch_array($try);
      if ($_POST['bulan'] == $cek_try['bulan']) {
        if ($_POST['tahun'] == $cek_try['tahun']) {
          $_SESSION['pesan'] = 'Anda Sudah Menambahkan Data Penggunaan Pelanggan ini..! <br> Harap Reset dan Pilih Pelanggan Lain';
        }else{
          echo "Tahun yg beda";
        $perintah->simpan($table,$field,$redirect);
        $perintah->simpan("tagihan",$field2,$redirect);
        }
      }else{
      $perintah->simpan($table,$field,$redirect);
      $perintah->simpan("tagihan",$field2,$redirect);
      }
    }
  }

  if (isset($_GET['hapus'])) {
  $perintah->ubah($table,$field3,$where,$redirect);
}
 ?>
<form method="post">
 <?php if (@$_SESSION['pesan'] != '') {?>
  <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" onclick="alert()" aria-label="Close"><span aria-hidden="true">×</span></button>
      <h4>Error!</h4>
      <p><?php echo @$_SESSION['pesan'] ?></p>
      <p>
      </p>
  </div>
 <?php } ?>
<div class="row">
  <div class="col-md-5">
    <div class="row">
      <div class="col-md-12">
        
      <?php if (isset($_POST['kd_pelanggan'])) {  
        // @$sql2 = mysql_query("SELECT * FROM pelanggan where kd_pelanggan = $_POST['kd_pelanggan']");
        ?>
        <div class="panel panel-default">
      <div class="panel-heading">Input Penggunaan</div>
      <div class="panel-body">
        <div class="row">
        <div class="form-group col-md-6">
            <label>Kode Penggunaan</label>
            <input type="text" class="form-control" name="kd_penggunaan" value="<?php echo $kdpel; ?>" readonly>
          </div>
          <div class="form-group col-md-6">
            <label>Tanggal</label>
            <input type="text" class="form-control" name="tanggal" value="<?php echo date('d-M-Y') ?>" placeholder="Nama" readonly>
            <input type="hidden" name="bulan" value="<?php echo date('M') ?>">
            <input type="hidden" name="tahun" value="<?php echo date('Y') ?>">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Pelanggan</label>
            <input type="text" class="form-control"   value="<?php echo $ambil[0]."-".ucfirst($ambil[2]) ?>" readonly>
            <input type="hidden" name="kd_pelanggan" value="<?php echo $ambil[0] ?>">
          </div>
          <div class="form-group col-md-6">
            <label>Tarif</label>
            <input type="text" class="form-control" name="tarif2" id="tarif2" value="<?php  echo @$ambil['daya'] ?>VA/<?php  echo @$ambil['tarif'] ?>KWH" readonly>
            <input type="hidden" name="tarif" id="tarif" value="<?php  echo @$ambil['tarif'] ?>">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Meteran Awal</label>
            <input type="text" class="form-control" name="meter_awal" id="meter_awal" value="<?php if(@$cek_ambil['kode'] == ''){ echo '0'; }else{ echo @$cek_ambil['kode'] ;} ?>" readonly>
          </div>
          <div class="form-group col-md-6">
            <label>Meteran Akhir</label>
            <input type="text" class="form-control" name="meter_akhir" id="meter_akhir"  onkeypress=" return event.charCode >= 47 && event.charCode <= 57" onkeyup="jumlah()" placeholder='Masukan Meteran Akhir'>
          </div>
        </div>
          <div class="form-group">
          <label>Jumlah Meter</label>
          <input type="text" class="form-control" name="jumlah_meter" id="jumlah_meter" value="" readonly>
        </div>  
          <div class="form-group">
          <label>Total Tagihan</label>
          <input type="text" class="form-control" id="total_tagihan" name="total_tagihan" value="" readonly placeholder="0">
        </div>
        <div class="form-group">
          <a href="?menu=penggunaan" class="btn btn-default">Reset</a>
            <input type="submit" value="Simpan" class="btn btn-primary" name="simpan">
        </div>
    </div>
    </div>

      <?php }else{ ?>



        <div class="panel panel-default">
          <div class="panel-heading">Input Penggunaan</div>
          <div class="panel-body">
            <label>Kode Pelanggan</label>
            <input type="text" list="pelanggan" class="form-control border-primary" id="kd_pelanggan" name="kd_pelanggan" onchange="submit()" placeholder="Masukkan Kode Pelanggan " autofocus="" required="" value="">
            <datalist  id="pelanggan">
            <?php  if (isset($_POST['Pelanggan'])) { ?> <?php echo @$data['kd_pelanggan']; ?>
            <?php } ?>
            <?php 
            $sql = mysql_query("SELECT * FROM pelanggan");
            while ($tampung = mysql_fetch_array($sql)) {?>
              <option value="<?php echo($tampung['kd_pelanggan']) ?>"><?php echo ucfirst(@$tampung['nama']); ?></option>
           <?php } ?>
           </datalist>
          </div>
        </div>

      <?php } ?>
      </div>
    </div>
  </div>

  <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
          <h4>Data Penggunaan</h4>
      </div>
      <div class="panel-body" style="overflow:auto;">
        <table id="tabel" class="table table-hover">
          <thead>
            <th>Kode</th>
            <th>Pelanggan</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Meter Awal</th>
            <th>Meter Akhir</th>
            <th>Aksi</th>
          </thead>
          <?php
              $tampung = mysql_query("SELECT * FROM penggunaan JOIN pelanggan ON pelanggan.kd_pelanggan = penggunaan.kd_pelanggan where penggunaan.status = '0' ORDER by kd_penggunaan DESC");
               $no = 0;
               while ($print = mysql_fetch_array($tampung)) {
                $no++;
          ?>
          <tr>
            <td><?php echo $print[0]; ?></td>
            <td><?php echo ucfirst($print['nama']); ?></td>
            <td><?php echo $print[2]; ?></td>
            <td><?php echo $print[3]; ?></td>
            <td><?php echo $print[4]; ?></td>
            <td><?php echo $print[5]; ?></td>
            <td>
              <!-- <a href="?menu=penggunaan&edit&kd=<?php echo $print['0']; ?>" type="button" name="edit" class="btn btn-default glyphicon glyphicon-pencil"></a> -->
              <a href="?menu=penggunaan&hapus&kd=<?php echo $print['0']; ?>" type="button" name="hapus" class="btn btn-default glyphicon glyphicon-trash"  onclick="return confirm('Hapus Data ?')"></a>
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
<script type="text/javascript">
  function jumlah(){
    var a = parseInt(document.getElementById('meter_akhir').value);
    var b = parseInt(document.getElementById('meter_awal').value);
    var c = a - b;
    if (a < b) { document.getElementById('jumlah_meter').value = ''; }
    if (a > b ) { document.getElementById('jumlah_meter').value = c; }
    var ha = parseInt(document.getElementById('tarif').value);
    var hb = parseInt(document.getElementById('jumlah_meter').value);
    var hc = ha * hb;
    document.getElementById('total_tagihan').value = hc;
  }
  function alert() {
    <?php @$_SESSION['pesan'] = ''; ?>;
    document.location.href='?menu=penggunaan';
  }
</script>