<?php 
	@session_start(); 
	if (empty($_SESSION['nama'])) {
  echo "<script>alert('Login Dahulu!!');document.location.href='../'</script>"; 
	}
	  $sql = mysql_query("SELECT * from subayar ORDER BY kd_pelanggan");
	  $sql2 =mysql_query("SELECT * from bbayar ORDER BY kd_pelanggan");
  
?>

<div class="row row-offcanvas row-offcanvas-right">
	
	<div class="col-xs-6 col-sm-6">
		
		<div class="panel panel-default">
		<div class="panel-heading">
		    <h4>Data Pelanggan yang Telah Melunasi Tagihan</h4> 
		</div>		
		<div class="panel-body">	

			<div class="box-header">
      				<a target='_blank' href="pln/ekspor_pelanggan_sudah_bayar.php" class="btn btn-primary"><i class="glyphicon glyphicon-paste"></i> Excel</a>
		            <a target='_blank' href="pln/print_laporan_sbayar.php" type="submit" name="cetak" class="btn btn-warning"><div class="glyphicon glyphicon-print" ></div> Print</a>
      		</div>
      		<br>
      		<div class="box-body table-responsive">
	                <table id="table" class="table table-bordered table-striped">
	            		<thead>
	            		<tr>
	            			<th>Kode Pelanggan</th>
	            			<th>Nama</th>
	            			<th>No Meter</th>
	            			<th>Alamat</th>
	            			<th>Bulan Tagihan</th>
	            			<th>Tahun Bayar</th>
	            		</tr>
	            		</thead>
	            		<?php while ($sudah = mysql_fetch_array($sql)) {?>
	            		<tr>
	            			<td><?php echo $sudah['kd_pelanggan']; ?></td>
	            			<td><?php echo ucfirst($sudah['nama']); ?></td>
	            			<td><?php echo $sudah['no_meter']; ?></td>
	            			<td><?php echo $sudah['alamat']; ?></td>
	            			<td><?php echo $sudah['bulan']; ?></td>
	            			<td><?php echo $sudah['tahun']; ?></td>
	            		</tr>	
	            		<?php } ?>    
	                </table>
	        </div>

		</div>

		<div class="panel-footer">
			
		</div>

		</div>

	</div>

	<div class="col-xs-6 col-sm-6">
		
		<div class="panel panel-default">
		<div class="panel-heading">
		    <h4>Data Pelanggan yang Belum Melunasi Tagihan</h4> 
		</div>		
		<div class="panel-body">	

			<div class="box-header">
      				<a target='_blank' href="pln/ekspor_pelanggan_belum_bayar.php" class="btn btn-primary"><i class="glyphicon glyphicon-paste"></i> Excel</a>
		            <a target='_blank' href="pln/print_laporan_bbayar.php" type="submit" name="cetak" class="btn btn-warning"><div class="glyphicon glyphicon-print" ></div> Print</a>
      		</div>
      		<br>
      		<div class="box-body table-responsive">
	                <table id="example2" class="table table-bordered table-striped">
	                	<thead>
	            		<tr>
	            			<th>Kode Pelanggan</th>
	            			<th>Nama</th>
	            			<th>No Meter</th>
	            			<th>Alamat</th>
	            			<th>Bulan Tagihan</th>
	            		</tr>
	            		</thead> 
	            		<?php while ($belum = mysql_fetch_array($sql2)) { ?>
	            		<tr>
	            			<td><?php echo $belum['kd_pelanggan'] ?></td>
	            			<td><?php echo $belum['nama'] ?></td>
	            			<td><?php echo $belum['no_meter'] ?></td>
	            			<td><?php echo $belum['alamat'] ?></td>
	            			<td><?php echo $belum['bulan'] ?></td>
	            		</tr>
	            		<?php } ?>   
	                </table>
	        </div>

		</div>

		<div class="panel-footer">
			
		</div>

		</div>

	</div>
</div>