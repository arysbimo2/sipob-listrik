<?php
$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'silistrik'; 

$pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=ekspor_pelanggan_belum_bayar.xls");
?>


<h3>Data Pelanggan yang Memiliki Tunggakan</h3>
		
<table border="1" cellpadding="5">
	<thead>
	<tr>
		<th>No</th>
		<th>Kode Pelanggan</th>
		<th>Nama</th>
		<th>Alamat</th>
		<th>Bulan Tagihan</th>
	</tr>
	</thead>
	<?php
	$sql = $pdo->prepare("SELECT * FROM bbayar");
	$sql->execute(); 
	


	$no = 1; 
	while($data = $sql->fetch()){ 
	$sql2 = $pdo->prepare("SELECT * FROM bbayar where nama = '$data[nama]'");
	$sql2->execute();
	$nos = 0 ;
	$bulan = $sql2->fetch();
		echo "<tr>";
		echo "<td>".$no."</td>";
		echo "<td>".$data['kd_pelanggan']."</td>";
		echo "<td>".$data['nama']."</td>";
		echo "<td>".$data['alamat']."</td>";
		echo "<td>".$data['bulan']."</td>";
		echo "</tr>";
		
		$no++; 
	}
	?>
</table>
