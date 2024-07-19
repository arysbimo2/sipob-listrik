<?php
	include '../library/controllers.php';
  date_default_timezone_set('Asia/Jakarta');
 $perintah 	= new oop();
 $db		= 'silistrik';
 $perintah->koneksi($db);
 session_start();
 if (empty($_SESSION['namaA'])) {
  echo "<script>alert('Login Dahulu!!');document.location.href='../'</script>";
  }
  if (@$_GET['menu'] == 'logout') {
   $_SESSION['namaA'] = '';
   session_unset();
   echo "<script>document.location.href='../'</script>";
 }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>SI-PPOB Listrik |  <?php
           switch (@$_GET['menu']) {

          case 'pembayaran':
            echo "Pembayaran";
            break;

          default:
            echo "Home";
            break;
        }
         ?></title>

  	<link rel="stylesheet" type="text/css" href="../public/dist/css/bootstrap-theme.css">
  	<link rel="stylesheet" type="text/css" href="../public/dist/css/bootstrap-theme.min.css">
  	<link rel="stylesheet" type="text/css" href="../public/dist/css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../public/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public/dT/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public/dT/css/dataTables.css">
    <style type="text/css">
    	body {
  padding-top: 20px;
  padding-bottom: 20px;
}

.navbar {
  margin-bottom: 20px;
}

    </style>
</head>
<body>

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid" style=" background-color: #eaeaea; ">
          <div class="navbar-header" >
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?menu=home" ><b>SI</b> - PPOB Listrik</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="?menu=pembayaran">Pembayaran</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href=""><?php echo $_SESSION['namaA']; ?></a></li>
              <li><a href="?menu=logout">Keluar</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

       <?php
           switch (@$_GET['menu']) {

          case 'pembayaran':
            include 'agen/pembayarans.php';
            break;

          default:
            include 'agen/home.php';
            break;
        }
         ?>

    </div> <!-- /container -->
    <script src="../public/dT/js/jquery-1.11.1.min.js"></script>
    <script src="../public/dT/js/bootstrap.min.js"></script>
    <script src="../public/dT/js/jquery.dataTables.min.js"></script>
    <script src="../public/dT/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#tagihan').dataTable();
        });
    </script>
</body>
</html>
