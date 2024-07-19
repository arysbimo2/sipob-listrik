<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'silistrik';

$pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=pemasukan.xls");
?>


<h3>Data Pemasukan</h3>

<table border="1" cellpadding="5">
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
	<?php
	$sql = $pdo->prepare("SELECT * FROM pemasukan");
	$sql->execute();


	$sql2 = $pdo->prepare("SELECT SUM(total_tagihan) FROM pemasukan");
	$sql2->execute();
	$total = $sql2->fetch();

	$no = 1;
	while($data = $sql->fetch()){
		echo "<tr>";
		echo "<td>".$no."</td>";
		echo "<td>".$data['kd_tagihan']."</td>";
		echo "<td>".$data['kd_penggunaan']."</td>";
		echo "<td>".$data['nama']."</td>";
		echo "<td>".$data['bulan']."</td>";
		echo "<td>".$data['tahun']."</td>";
		echo "<td>".$data['jumlah_meter']."</td>";
		echo "<td>Rp. ".number_format($data['total_tagihan'],0,',','.').",-</td>";
		echo "</tr>";

		$no++;
	}
	echo "<tr>";
	echo "<td colspan='6'></td>";
	echo "<td style='text-align:center;'><b> Jumlah </b></td>";
	echo "<td>Rp. ".number_format($total[0],0,',','.').",-</td>";
	echo "</tr>";
	?>
</table>
