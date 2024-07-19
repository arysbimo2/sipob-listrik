<?php
include '../../library/controllers.php';
$perintah = new oop();
$db = 'silistrik';
$perintah->koneksi($db);
$sql2 =mysql_query("SELECT * from bbayar ORDER BY kd_pelanggan");
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
<!--  -->
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
		<h1 align="center">Data Pelanggan yang Memiliki Tunggakan</h1>
		<br>
		<table id="tagihan" class="table table-bordered table-striped">
	                    <thead>
	            		<tr>
	            			<th>Kode Pelanggan</th>
	            			<th>Nama</th>
	            			<th>No Meter</th>
	            			<th>Alamat</th>
	            			<th>Bulan Tagihan</th>
	            		</tr>
	            		</thead> 
	                    <tbody>
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
	                    </tbody>
	                </table>
	</div>
</body>
</html>