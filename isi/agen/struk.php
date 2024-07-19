<?php include '../../library/controllers.php';
$perintah =new oop();
$perintah->koneksi('silistrik');
date_default_timezone_set('Asia/Jakarta');
session_start();

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Struk</title>
	<style type="text/css">

  body{
    font-family: sans-serif;
  }
		.border{
			border-right: 1px solid black;`
			border-top: 1px solid black;`
			border-left: 1px solid black;`
			border-bottom: 1px solid black;`
		}
	</style>
	<link rel="stylesheet" type="text/css" href="../../public/dist/css/bootstrap-theme.css">

</head>

<body>
	<button id="print" onclick="document.getElementById('print').style.display='none';document.getElementById('back').style.display='none';window.print()"><i class="glyphicon glyphicon-paste"></i> Cetak</button>
	<button  id="back" onclick="document.location.href='../index2.php?menu=pembayaran'">Kembali</button>
				<?php $sql = mysql_query("SELECT * FROM struk where kd_bayar ='$_SESSION[struk]'");
				$tampung = mysql_fetch_array($sql); ?>
				<table align="center" style="border-right: 1px solid black;
											border-top: 1px solid black;
											border-left: 1px solid black;
											border-bottom: 1px solid black;">
					<tr>
						<td rowspan="2" align="center"><img style="height:50px;width: 50px;" src="../../public/images/petir.png"></td>
						<td colspan="9">PT. PPOB LISTRIK INDONESIA</td>
					</tr>
					<tr>
						<td colspan="9"><small>Jl.Merdeka No.11 RT003/002, Telp:021-4590400<br>Tangerang-Indonesia</small></td>
					</tr>
					<tr>
						<td rowspan="" colspan="10" style="font-size: 30px;"><b>Struk Pembayaran Tagihan Listrik </b></td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<td>ID PEL</td>
						<td>:</td>
						<td><?php echo $tampung['kd_pelanggan'] ?></td>
						<td style="width: 200px;"></td>
						<td>BL/TH</td>
						<td>:</td>
						<td><?php echo $tampung['bulan_bayar'].date('Y') ?></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>:</td>
						<td><?php echo ucfirst($tampung['nama']); ?></td>
						<td style="width: 200px;"></td>
						<td>Stand Meter</td>
						<td>:</td>
						<td><?php echo $tampung['meter_awal'].'-'.$tampung['meter_akhir'] ?></td>
					</tr>
					<tr>
						<td>No Meter</td>
						<td>:</td>
						<td><?php echo $tampung['no_meter']; ?></td>
						<td style="width: 50px;"></td>

					</tr>
					<tr>
						<td>Daya</td>
						<td>:</td>
						<td><?php echo $tampung['daya'].'VA/'.$tampung['tarif'].'KWH'; ?></td>
						<td style="width: 50px;"></td>

					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<td colspan="11" style="font-size: 18px;"><i><strong><small>PLN Menyatakan struk ini sebagai pembayaran yang sah, Mohon disimpan</small></strong></i></td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<td>Tagihan</td>
						<td>:</td>
						<td>Rp. <?php echo number_format($tampung['total_tagihan'],0,',','.'); ?>,-</td>
						<td width="20px;"></td>
						<td>Bayar</td>
						<td>:</td>
						<td>Rp. <?php echo number_format($tampung['bayar'],0,',','.'); ?>,-</td>
					</tr>
					<tr>
						<td>Biaya Administrasi</td>
						<td>:</td>
						<td>Rp. 5000,-</td>
						<td width="20px;"></td>
						<td>Kembalian</td>
						<td>:</td>
						<td>Rp. <?php echo number_format($tampung['kembalian'],0,',','.'); ?>,-</td>
					</tr>
					<tr>
						<td>Total Bayar</td>
						<td>:</td>
						<td>Rp. <?php echo number_format($tampung['total'],0,',','.'); ?>,-</td>
						<td colspan="8"></td>
					</tr>
					<tr>
						<td colspan="8"></td>
					</tr>
					<tr>
						<td colspan="8"></td>
					</tr>
					<tr style="height:10px;"></tr>
					<tr>
						<td colspan="11" align="center">Terima Kasih</td>
					</tr>
					<tr>
						<td colspan="11" align="center">"Rincian Tagihan Dapat Dilihat di www.ppob.id atau PPOB Terdekat"</td>
					</tr>
					<tr>
						<td colspan="11" align="center">INFORMASI HUB : 123</td>
					</tr>
					</tr>
					<tr>
						<td colspan="11" align="center"><small>SIPPOB/<?php echo $tampung['agen'].'/'.date('Y'); ?></small></td>
				</table>
					<center>Copyright&nbsp;&copy;&nbsp;Sistem Pembayaran Listrik.</center>&nbsp;
</body>
</html>
