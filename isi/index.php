<?php
	include '../library/controllers.php';
  date_default_timezone_set('Asia/Jakarta');
 $perintah  = new oop();
 $db    = 'silistrik';
 $perintah->koneksi($db);
@session_start();
if (empty($_SESSION['nama'])) {
  echo "<script>alert('Login Dahulu!!');document.location.href='../'</script>";
  }

 if (@$_GET['menu'] == 'logout') {
   $_SESSION['nama'] = '';
   session_destroy();
   echo "<script>document.location.href='../'</script>";
 }
 ?>
<!DOCTYPE html>
<html>
<head>

	<title>PLN |
    <?php
                   switch (@$_GET['menu']) {
                  case 'tarif':
                    echo "Tarif";
                    break;
                  case 'pelanggan':
                    echo "Pelanggan";
                    break;
                  case 'agen':
                    echo "Agen";
                    break;
                  case 'penggunaan':
                    echo 'Penggunaan';
                    break;
                  case 'user':
                    echo 'User';
                    break;
                  case 'l_pemasukan':
                    echo 'laporan Pemasukan';
                    break;
                  case 'l_sbayar':
                    echo 'Laporan Sudah Bayar';
                    break;
                  case 'l_bbayar':
                    echo 'Laporan Belum Bayar';
                    break;

                  default:
                    echo 'Dashboard';
                    break;
                }
     ?>
  </title>
  	<link rel="stylesheet" type="text/css" href="../public/dist/css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="../public/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../public/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../public/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public/dT/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public/dT/css/dataTables.css">
  	<style type="text/css">
  		/*
       * Style tweaks
       * --------------------------------------------------
       */
      html,
      body {
        overflow-x: hidden; /* Prevent scroll on narrow devices */
      }
      body {
        padding-top: 70px;
      }
      footer {
        padding: 30px 0;
      }

      /*
       * Off Canvas
       * --------------------------------------------------
       */
      @media screen and (max-width: 767px) {
        .row-offcanvas {
          position: relative;
          -webkit-transition: all .25s ease-out;
               -o-transition: all .25s ease-out;
                  transition: all .25s ease-out;
        }

        .row-offcanvas-right {
          right: 0;
        }

        .row-offcanvas-left {
          left: 0;
        }

        .row-offcanvas-right
        .sidebar-offcanvas {
          right: -50%; /* 6 columns */
        }

        .row-offcanvas-left
        .sidebar-offcanvas {
          left: -50%; /* 6 columns */
        }

        .row-offcanvas-right.active {
          right: 50%; /* 6 columns */
        }

        .row-offcanvas-left.active {
          left: 50%; /* 6 columns */
        }

        .sidebar-offcanvas {
          position: absolute;
          top: 0;
          width: 50%; /* 6 columns */
        }
      }

  	</style>
</head>
<body>
	<nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="?menu=dashboard"><b>SI</b> - PPOB Listrik</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li><a href="?menu=l_sbayar">Laporan Pelanggan</a></li>
              <!-- <li><a href="?menu=l_sbayar">Laporan Pelanggan Lunas</a></li> -->
              <!-- <li><a href="?menu=l_bbayar">Laporan Tunggakan Pelanggan</a></li> -->
              <li><a href="?menu=l_pemasukan">Laporan Pemasukan</a></li>
              </ul>
            </li>>
            <li><a href="?menu=penggunaan">Penggunaan</a></li>
            <li><a href="?menu=tarif">Tarif</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User Akun <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li><a href="?menu=agen">Agen</a></li>
              <li><a href="?menu=user">Administrator</a></li>
              <li><a href="?menu=pelanggan">Pelanggan</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="#"><?php echo $_SESSION['nama'] ?></a></li>
            <li><a href="?menu=logout">Keluar</a></li>
          </ul>
        </div>
        <!-- /.nav-collapse -->
      </div>
      <!-- /.container -->
    </nav>
    <!-- /.navbar -->

      <div class="container">
        <?php
           switch (@$_GET['menu']) {
          case 'tarif':
            include "pln/tarif.php";
            break;
          case 'pelanggan':
            include "pln/pelanggan.php";
            break;
          case 'agen':
            include "pln/agen.php";
            break;
          case 'penggunaan':
            include 'pln/penggunaans.php';
            break;
          case 'user':
            include 'pln/user.php';
            break;
          case 'l_pemasukan':
            include 'pln/laporan_pemasukan.php';
            break;
          case 'l_sbayar':
            include 'pln/laporan_sbayar.php';
            break;
          case 'l_bbayar':
            include 'pln/laporan_bbayar.php';
            break;

          default:
            include 'pln/dashboard.php';
            break;
        }
         ?>
      </div>
    <!--/.container-->
    <script src="../public/dT/js/jquery-1.11.1.min.js"></script>
    <script src="../public/dT/js/bootstrap.min.js"></script>
    <script src="../public/dT/js/jquery.dataTables.min.js"></script>
    <script src="../public/dT/js/dataTables.bootstrap.js"></script>

     <?php if(@$_GET['menu'] == 'tarif'){ ?>
      <script type="text/javascript">
        $(document).ready(function(){
          $('#tabel').DataTable();
        });
      </script>
    <?php } ?>
    <?php if(@$_GET['menu'] == 'pelanggan'){ ?>
      <script type="text/javascript">
        $(document).ready(function(){
          $('#tabel').DataTable();
        });
      </script>
    <?php } ?>
    <?php if(@$_GET['menu'] == 'agen'){ ?>
      <script type="text/javascript">
        $(document).ready(function(){
          $('#tabel').DataTable();
        });
      </script>
    <?php } ?>
    <?php if(@$_GET['menu'] == 'penggunaan'){ ?>
      <script type="text/javascript">
        $(document).ready(function(){
          $('#tabel').DataTable();
        });
      </script>
    <?php } ?>
    <?php if(@$_GET['menu'] == 'user'){ ?>
      <script type="text/javascript">
        $(document).ready(function(){
          $('#tabel').DataTable();
        });
      </script>
    <?php } ?>

    <?php if(@$_GET['menu'] == 'l_pemasukan'){ ?>
      <script type="text/javascript">
        $(document).ready(function(){
          $('#tagihan').DataTable();
        });
      </script>
    <?php } ?>

    <?php if(@$_GET['menu'] == 'l_pemasukan'){ ?>
      <script type="text/javascript">
        $(document).ready(function(){
          $('#tagihan').DataTable();
        });
      </script>
    <?php } ?>

    <?php if(@$_GET['menu'] == 'l_sbayar'){ ?>
      <script type="text/javascript">
        $(document).ready(function(){
          $('#table').DataTable();
          $('#example2').DataTable();
        });
      </script>
    <?php } ?>

    <?php if(@$_GET['menu'] == 'l_bbayar'){ ?>
      <script type="text/javascript">
        $(document).ready(function(){
          $('#example2').DataTable();
        });
      </script>
    <?php } ?>
</body>
</html>
