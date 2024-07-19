<?php
include '../../library/controllers.php';
$perintah = new oop();
$db = 'silistrik';
$perintah->koneksi($db);
 $sql = mysql_query("SELECT * from subayar ORDER BY kd_pelanggan");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan</title>
	<link rel="stylesheet" type="text/css" href="../../public/dist/css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="../../public/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../public/dist/css/bootstrap.min.css">
</head>
<!-- onload="window.print()" -->
<body onload="window.print()">
	<div class="container">
		<table style="margin-bottom:-20px;">
		<tr>
			<td rowspan="2"><img src="../../public/images/pln.png" width="100px" height="105px;"></td>
			<td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
			<td colspan="1" rowspan="2">
				<h3>PT. PPOB LISTRIK INDONESIA</h3>
				<h4>Jl.Merdeka No.11 RT003/002</h4>
				<h6>Call Center : 021-5522987 , Website : www.ppob.id</h6>
			</td>
		</tr>
		<tr>
			<td>&nbsp</td>
			<td>&nbsp</td>
			<td>&nbsp</td>
			<td >
				 
			</td>
		</tr>
	</table>
	<hr style="border: 1px solid black;">
		<h1 align="center">Data Pelanggan yang Tidak Memiliki Tunggakan</h1>
		<br>
		<table id="tagihan" class="table table-bordered table-striped">
	                    <thead>
	                        <tr>
	            			<th>Kode Pelanggan</th>
	            			<th>Nama</th>
	            			<th>No Meter</th>
	            			<th>Alamat</th>
	            			<th>Bulan</th>
	            			<th>Tahun</th>
	            			</tr>
	                    </thead>
	                    <tbody>
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
	                    </tbody>
	                </table>
	</div>
</body>
</html>