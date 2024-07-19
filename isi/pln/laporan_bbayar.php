<?php 
	@session_start(); 
	if (empty($_SESSION['nama'])) {
  echo "<script>alert('Login Dahulu!!');document.location.href='../'</script>"; 
	}
	  $sql2 =mysql_query("SELECT * from bbayar ORDER BY kd_pelanggan")
  
?>
<div class="row row-offcanvas row-offcanvas-right">

<div class="col-xs-12 col-sm-12">
		
		<div class="panel panel-default">
		<div class="panel-heading">
		    <h4>Data Pelanggan yang Belum Melunasi Tagihan</h4> 
		</div>		
		<div class="panel-body">	

			<div class="box-header">
      				<a target='_blank' href="pln/ekspor_pemasukan.php" class="btn btn-primary"><i class="glyphicon glyphicon-paste"></i> Excel</a>
		            <a target='_blank' href="pln/print_laporan_pemasukan.php" type="submit" name="cetak" class="btn btn-warning"><div class="glyphicon glyphicon-print" ></div> Print</a>
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
	            			<td>
	            				<?php $sql3 = mysql_query("SELECT bulan from bbayar where kd_pelanggan = '$belum[kd_pelanggan]'");
	            					$nos= 0;
	            					while ($belum_b = mysql_fetch_array($sql3)) {
	            						echo $belum_b[$nos].' ';
	            					} ?>
	            			</td>
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