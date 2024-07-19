	<?php
	@session_start();
	if (empty($_SESSION['nama'])) {
  echo "<script>alert('Login Dahulu!!');document.location.href='../'</script>";
	}
	 ?>
	<div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-12">
        	<div class="panel panel-default">
      			<div class="panel-heading">
		        <h4>Data Pemasukan Pembayaran</h4>
		   		 </div>
      		<div class="panel-body">
      			<div class="box-header">
      				<a target='_blank' href="pln/ekspor_pemasukan.php" class="btn btn-primary"><i class="glyphicon glyphicon-paste"></i> Excel</a>
		            <a target='_blank' href="pln/print_laporan_pemasukan.php" type="submit" name="cetak" class="btn btn-warning"><div class="glyphicon glyphicon-print" ></div> Print</a>
      			</div>
      				<br>
	          <div class="box-body table-responsive">
	                <table id="tagihan" class="table table-bordered table-striped">
	                    <thead>
	                        <tr>
	                        	<th>No</th>
	                            <th>Kode Tagihan</th>
	                            <th>Kode Penggunaan</th>
	                            <th>Nama Pelanggan</th>
	                            <th>Bulan Tagihan</th>
	                            <th>Tahun Tagihan</th>
	                            <th>Jumlah Meter</th>
	                            <th>Total Tagihan</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                       <?php
				               $tampung = mysql_query("SELECT * FROM pemasukan");
				               $totals = mysql_query("SELECT SUM(total_tagihan) FROM pemasukan");
				               $total = mysql_fetch_array($totals);
				                    $no = 0;
				                    while ($print = mysql_fetch_array($tampung)) {
				                      $no++;
				            ?>
				            <tr>
				              <td><?php echo $no;?></td>
				              <td><?php echo $print['kd_tagihan']; ?></td>
				              <td><?php echo $print['kd_penggunaan']; ?></td>
				              <td><?php echo $print['nama']; ?></td>
				              <td><?php echo $print['bulan']; ?></td>
				              <td><?php echo $print['tahun']; ?></td>
	                          <td><?php echo $print['jumlah_meter']; ?></td>
	                          <td>Rp. <?php echo number_format($print['total_tagihan'],0,',','.'); ?>,-</td>
				            </tr>
				            <?php } ?>
	                    </tbody>
	                    <!-- <tfoot>
	                        <tr>
	                            <th>Kode Tagihan</th>
	                            <th>Kode Penggunaan</th>
	                            <th>Nama Pelanggan</th>
	                            <th>Bulan Tagihan</th>
	                            <th>Tahun Tagihan</th>
	                            <th>Jumlah Meter</th>
	                            <th>Total Tagihan</th>
	                        </tr>
	                    </tfoot> -->
	                </table>
	            </div>
	        </div>
	    	<div class="panel-footer">
	    		<span class='btn btn-lg btn-block' disabled> Jumlah Pemasukan Rp. <?php echo number_format($total[0],0,',','.'); ?>,-</span>
	    	</div>
	    </div>
        </div>
    </div>
