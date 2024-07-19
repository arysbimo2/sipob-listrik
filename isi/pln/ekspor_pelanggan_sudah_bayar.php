<?php
$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'silistrik'; 

$pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=pelanggan_sudah_bayar.xls");
?>


<h3>Data Pelanggan Sudah Bayar</h3>
		
<table border="1" cellpadding="5">
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
	<?php
	$sql = $pdo->prepare("SELECT * FROM subayar");
	$sql->execute(); 
	

	$no = 1; 
	while($data = $sql->fetch()){ 
		echo "<tr>";
		echo "<td>".$no."</td>";
		echo "<td>".$data['kd_pelanggan']."</td>";
		echo "<td>".ucfirst($data['nama'])."</td>";
		echo "<td>".$data['alamat']."</td>";
		echo "<td>".$data['bulan']."</td>";
		echo "<td>".$data['tahun']."</td>";
		
		$no++; 
	}
	?>
</table>
