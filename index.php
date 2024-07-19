<?php
include 'library/controllers.php';
$perintah = new oop();
$db = 'silistrik';
$perintah->koneksi($db);
session_start();


@$username = $_POST['username'];
@$password = $_POST['password'];
$nama_form = '#';

  if (isset($_POST['simpan'])) {
   if ($_POST['akses'] == 'pln') {
      $sql = "SELECT * FROM user where username = '$username' && password = '$password'";
      $jalan=mysql_query($sql);
      $tampil=mysql_fetch_array($jalan);
      $cek=mysql_num_rows($jalan);
      $_SESSION['nama'] = $tampil[1];

      if ($cek>0) {
        echo "<script>alert('Selamat Datang $tampil[1]!');document.location.href='isi/'</script></script>";
      }else{
        echo "<script>alert('Login Gagal!! Cek Username atau Password!!');document.location.href='?'</script>";
      }
   }elseif($_POST['akses'] == 'agen'){
     $sql = "SELECT * FROM agen where username = '$username' && password = '$password'";
      $jalan=mysql_query($sql);
      $tampil=mysql_fetch_array($jalan);
      $cek=mysql_num_rows($jalan);
      $_SESSION['namaA'] = $tampil[1];

      if ($cek>0) {
        echo "<script>alert('Selamat Datang $tampil[1]!');document.location.href='isi/index2.php'</script></script>";
      }else{
        echo "<script>alert('Login Gagal!! Cek Username atau Password!!');document.location.href='?'</script>";
      }
   }else{
    echo "<script>alert('Username atau password tidak ditemukan!!');document.location.href='?error_Auth'</script>";
   }

  }

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>SI - PPOB Listrik | Login</title>
  	<link rel="stylesheet" type="text/css" href="public/dist/css/bootstrap-theme.css">
  	<link rel="stylesheet" type="text/css" href="public/dist/css/bootstrap-theme.min.css">
  	<link rel="stylesheet" type="text/css" href="public/dist/css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="public/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/dT/css/dataTables.bootstrap.css">
 </head>
 <body style="background-color: #337ab7;">
  	 <div class="container" >
  	 	<div class="row" style="margin-top: 10%;">
  	 		<div class="col-md-4"></div>
  	 		<div class="col-xs-6 col-sm-4">
	  	 		<div class="jumbotron">
	  	 		 	<p align="center"><img src="public/images/pln.png" style="width: 50%;height: 30%;" alt="..." class="img-rounded"></p>
	 	<form method="post">
	            <div class="form-group">
	                <label for="username">Username</label>
	                <input type="text" class="form-control" required="" name="username" id="username" placeholder="Masukan Username">
	            </div>
	            <div class="form-group">
	                <label for="password">Password</label>
	                <input type="password" class="form-control" required="" name="password" id="password" placeholder="Masukan Password">
	            </div>
	            <div class="form-group">
	                <label>Akses</label>
	                <select class="form-control" name="akses">
	                  <option>--Pilih Akses--</option>
	                  <option value="agen">Agen</option>
	                  <option value="pln">Admin</option>
	                </select>
	            </div>
                <input type="submit" name="simpan" value="Login" class="btn btn-primary">
        </form>
           		</div>
      		</div>
  	 		<div class="col-md-4"></div>
  	 	</div>
  	 </div>
    <script src="public/dist/js/bootstrap.min.js"></script>
  </body>
 </html>
