<?php 
 $perintah  = new oop();
 @session_start();
 $table = 'pembayaran';
 $table2 = 'penggunaan';
 $field2 = array('status' => 1 );
 $table3 = 'tagihan';
 $field3 = array('status' => 1 );
@$where = " kd_penggunaan = '$_GET[kd_penggunaan]'";
@$where2 = " kd_tagihan = '$_GET[kd_tagihan]'";
 $redirect = "agen/struk.php";
 $date1 = date('Ymdhis');
 $date2 = date('Y-m-d');
$kd_bayar = "BYR".$date1;
 @$_SESSION['struk'] = $kd_bayar;
 $field = array(
  'kd_bayar' => $kd_bayar ,
  'kd_pelanggan' => @$_POST['kd_pelanggan'] ,
  'kd_penggunaan' => @$_POST['kd_penggunaan'] ,
  'tanggal' => $date2 ,
  'bulan_bayar' => date('M') ,
  'biaya_admin' => @$_POST['biaya_admin'] ,
  'total' => @$_POST['total'] ,
  'bayar' => @$_POST['bayar'] ,
  'kembalian' => @$_POST['kembalian'] ,
  'agen' => @$_SESSION['namaA']  
);


  if (isset($_POST['bbayar'])) {
   if (@$_POST['bayar']=='0'|| @$_POST['bayar'] == '' || @$_POST['total'] > @$_POST['bayar']) {
      $_SESSION['pesan'] = 'Bayaran Harus Terisi Dengan Benar ! Tidak Boleh kurang ataupun kosong !';
    }else{ 
     $perintah->ubah2($table2,$field2,$where,'#');
    $perintah->ubah2($table3,$field3,$where2,'#');
    $perintah->simpan2($table,$field,$redirect);
     @$_SESSION['pesan'] = '';
    }
  }

 
 if (isset($_POST['Pelanggan'])) {
  $sql4 = mysql_query("SELECT * FROM tagihan WHERE kd_pelanggan = '$_POST[Pelanggan]' AND status ='0'");
  $cek  = mysql_fetch_array($sql4);
  if ($cek == '') {
    $_SESSION['pesan'] = 'Mohon Maaf,Pelanggan ini tidak memiliki tagihan yang belum terbayar !';
  }else{
  $sql1 = mysql_query("SELECT * FROM pelanggan join tarif on tarif.kd_tarif = pelanggan.kd_tarif WHERE kd_pelanggan = '$_POST[Pelanggan]'");
  $data = mysql_fetch_array($sql1);
  }
 }
 
 ?>
<?php if (@$_GET['kd_pelanggan'] != '') {?>

  <form method="POST">
    <div class="row">
      <?php if (@$_SESSION['pesan'] != '') {?>
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" onclick="alert()" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4>Error!</h4>
          <p><?php echo @$_SESSION['pesan'] ?></p>
          <p>
          </p>
        </div>  
      <?php } ?>
      <div class="col-md-3"></div>

      
      <?php 
      $sql5 = mysql_query(" SELECT tagihan.*, pelanggan.kd_pelanggan,pelanggan.kd_tarif,tarif.* FROM tagihan JOIN pelanggan ON pelanggan.kd_pelanggan = tagihan.kd_pelanggan JOIN tarif ON tarif.kd_tarif = pelanggan.kd_tarif where kd_tagihan = '$_GET[kd_tagihan]'");
      $sql6 = mysql_query("SELECT nama FROM pelanggan where kd_pelanggan = '$_GET[kd_pelanggan]'");
      $np   = mysql_fetch_array($sql6);
      $tgn = mysql_fetch_array($sql5);
       ?>
      <div class="col-md-6">
    <div class="panel panel-default">
          <div class="panel-heading">Pembayaran <?php echo $_GET['kd_tagihan']."-".ucfirst($np[0]);  ?></div>
          <input type="hidden" name="kd_pelanggan" value="<?php echo @$_GET['kd_pelanggan'] ?>">
          <input type="hidden" name="kd_penggunaan" value="<?php  echo @$_GET['kd_penggunaan'] ?>">

          <div class="panel-body">

              <div class="row">
                
                <div class="col-md-6">
                  <div class="form-group">
                  <label>Waktu Penggunaan</label>
                  <input type="text" class="form-control" name="waktu_penggunaan" value="<?php echo $tgn['bulan'].'-'.$tgn['tahun']; ?>" readonly>
                  <input type="hidden" name="bulan_bayars" value="<?php echo $tgn['bulan']; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label>Jumlah Meter</label>
                      <input type="text" class="form-control" name="j_meter" value="<?php echo $tgn['jumlah_meter'] ?>" readonly>
                   </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                  <label>Tarif/KWH</label>
                  <input type="text" class="form-control" name="tarifperkwh" value="<?php echo $tgn['tarif']; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Biaya Admin</label>
                      <input type="text" class="form-control" value="Rp.5.000,-" readonly>
                      <input type="hidden" name="biaya_admin" value="5000">
                  </div>
                </div>
              </div>

          <div class="form-group">
              <label>Total Akhir</label>
              <input type="text" class="form-control" value="<?php echo 'Rp.'.number_format($tgn['total_tagihan']+5000,0,',','.').',-'; ?>" readonly>
              <input type="hidden" id="total_akhir" name="total" value="<?php echo $tgn['total_tagihan']+5000; ?>">
          </div>
          <div class="form-group">
              <label>Bayar</label>
              <input type="text" autofocus="" id="bayar" onkeypress=" return event.charCode >= 47 && event.charCode <= 57" onkeyup="jumlah()" class="form-control" name="bayar" >
          </div>
          <div class="form-group">
              <label>Kembalian</label>
              <input type="text" id="kembalian" class="form-control" name="kembalian" placeholder="0" readonly>
          </div>
            


          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-md-12">
                <input type="submit" id="bbayar" name="bbayar" value="BAYAR" class="btn btn-danger btn-lg btn-block">
              <a href="?menu=pembayaran" class="btn btn-default btn-lg btn-block">Reset</a>
              </div>
            </div>
          </div>

    </div>


    </div>
      <div class="col-md-3"></div>

  </div>


      
    </div>
  </form>

<?php }else{ ?>


<form method="post">
	<div class="row">

 <?php if (@$_SESSION['pesan'] != '') {?>
	<div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" onclick="alert()" aria-label="Close"><span aria-hidden="true">×</span></button>
      <h4>Error!</h4>
      <p><?php echo @$_SESSION['pesan'] ?></p>
      <p>
      </p>
  	</div>	
 <?php } ?>

	<div class="col-md-4">
		<div class="panel panel-default">
          <div class="panel-heading"><?php if (isset($_POST['Pelanggan'])) {  echo 'Data Pelanggan'; }else{ echo 'Input Data Pelanggan'; } ?></div>
          <div class="panel-body">

            <div class="form-group">
            <label for="kd_pelanggan">Kode Pelanggan</label>
            <input type="text" list="pelanggan" autofocus="" class="form-control border-primary"  name="Pelanggan" onchange="submit()" id="kd_pelanggan"  placeholder="Masukkan Kode Pelanggan " required="" value="<?php  
            if (isset($_POST['Pelanggan'])) { echo @$data['kd_pelanggan'];}else{ echo '';} ?>" <?php  if (isset($_POST['Pelanggan'])) {  echo "readonly"; }else{ echo '';} ?>>
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

        <?php if (isset($_POST['Pelanggan'])) { ?>
        		<?php if ($cek == '') { ?>
        
        </div>
        		
        		<?php }else{ ?>


            <div class="form-group">
	            <label>Nama</label>
	            <input type="text" class="form-control"   value="<?php echo ucfirst(@$data['nama']); ?>" readonly>
         	</div>
            <div class="form-group">
	            <label>Tarif</label>
	            <input type="text" class="form-control"   value="<?php echo @$data['daya'].'VA/'.@$data['tarif'].'KWH'; ?>" readonly>
         	</div>
            <div class="form-group">
	            <label>Alamat</label>
	            <textarea class="form-control" readonly=""><?php echo ucfirst(@$data['alamat']); ?></textarea>
         	</div>


          </div>
          <div class="panel-footer">
          	<div class="row">
          		<div class="col-md-12">
          		<a href="?menu=pembayaran" class="btn btn-default pull-right">Reset</a>
          		</div>
          	</div>
          </div>

        		<?php } ?>
        <?php }else{ ?>
        </div>
        <?php } ?>


    </div>
	</div>

    <?php if (isset($_POST['Pelanggan'])) { ?>
    	<?php if ($cek == '') { ?>
    	

    	<?php }else{ ?>
    	
    	<div class="col-md-8">

      <div class="panel panel-default">
        <div class="panel-heading" align="center">Data Tagihan <?php echo  ucfirst($data['nama']); ?></div>
      </div>
      <div class="panel-body" style="overflow:auto;">
        <table class="table">
            <th>Kode Tagihan</th>
            <th>Kode Penggunaan</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Jumlah Meter</th>
            <th>Jumlah Tagihan</th>
            <th>Aksi</th>
            <?php 
            $sql2 = mysql_query("SELECT * FROM tagihan WHERE kd_pelanggan = '$data[kd_pelanggan]' AND status != '1'");
            while ($tagihan = mysql_fetch_array($sql2)) {
             ?>
             <tr>
               <td><?php echo $tagihan['kd_tagihan']; ?></td>
               <td><?php echo $tagihan['kd_penggunaan'] ?></td>
               <td><?php echo $tagihan['bulan'] ?></td>
               <td><?php echo $tagihan['tahun']; ?></td>
               <td><?php echo $tagihan['jumlah_meter']; ?></td>
               <td><?php echo "Rp.".number_format($tagihan['total_tagihan']).",-"; ?></td>
               <td><a href="?menu=pembayaran&&kd_tagihan=<?php echo $tagihan['kd_tagihan']; ?>&&kd_pelanggan=<?php echo $tagihan['kd_pelanggan'];  ?>&&kd_penggunaan=<?php echo $tagihan['kd_penggunaan']; ?>" class="btn btn-danger">Bayar</a></td>
             </tr>
             <?php } ?>
        </table> 
      </div>
      <div class="panel-footer">
        <table>
          <tr>
            <?php 
            $sql3 = mysql_query("SELECT sum(total_tagihan) FROM tagihan WHERE kd_pelanggan = '$data[kd_pelanggan]' && status = '0'");
            $total = mysql_fetch_array($sql3);
            ?>
            <td>Jumlah</td>
            <td>:</td>
            <td><span class="btn btn-default" style="background-color: #9a1208; color: #FFF;" disabled>Rp.<?php echo number_format($total[0]); ?>,-</span></td>
          </tr>
        </table>
      </div>

    </div>

    	<?php } ?>

    <?php } ?>
</form>




<?php } ?>

<script type="text/javascript">
	function alert() {
    <?php @$_SESSION['pesan'] = ''; ?>
  }
  function jumlah(){
    var a = parseInt(document.getElementById('bayar').value);
    var b = parseInt(document.getElementById('total_akhir').value);
    var c = a - b;
    if (a < b) { document.getElementById('kembalian').value = ''; }
    if (a > b ) { document.getElementById('kembalian').value = c; }
    
  }
</script>