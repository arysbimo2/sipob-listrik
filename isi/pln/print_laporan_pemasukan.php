<?php
include '../../library/controllers.php';
$perintah = new oop();
$db = 'silistrik';
$perintah->koneksi($db);

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
<body >
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
		<h1 align="center">Data Pemasukan</h1>
		<br>
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
				               $totals = mysql_query("SELECT SUM(total_tagihan) From pemasukan");
				               $total = mysql_fetch_array($totals);
				                    $no = 1; 
								while($print = mysql_fetch_array($tampung)){ 
									echo "<tr>";
									echo "<td>".$no."</td>";
									echo "<td>".$print['kd_tagihan']."</td>";
									echo "<td>".$print['kd_penggunaan']."</td>";
									echo "<td>".$print['nama']."</td>";
									echo "<td>".$print['bulan']."</td>";
									echo "<td>".$print['tahun']."</td>";
									echo "<td>".$print['jumlah_meter']."</td>";
									echo "<td>Rp. ".number_format($print['total_tagihan'],0,',','.').",-</td>";
									echo "</tr>";
									
									$no++; 
								}
								echo "<tr>";
								echo "<td colspan='6'></td>";
								echo "<td style='text-align:center;'><b> Jumlah </b></td>";
								echo "<td>Rp. ".number_format($total[0],0,',','.').",-</td>";
								echo "</tr>";
								 ?>                                       
	                    </tbody>
	                </table>
	</div>
</body>
</html>