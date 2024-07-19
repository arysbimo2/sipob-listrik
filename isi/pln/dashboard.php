<?php
@session_start(); 
if (empty($_SESSION['nama'])) {
  echo "<script>alert('Login Dahulu!!');document.location.href='../'</script>"; 
}
 ?>
       <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-12">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron" align="center">

            <h1>
              <img src="../public/images/pln.png" style="width: 10%;height: 30%;" alt="..." class="img-rounded">    Selamat Datang <?php echo $_SESSION['nama'] ?>!!
            </h1>
            <p>Selamat Bekerja dan Semoga Harimu Menyenangkan!!</p>
          </div>
         
        </div>
        <!--/.col-xs-12.col-sm-9-->

        <!-- <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="#" class="list-group-item active">Link</a>
            <a href="#" class="list-group-item">Link</a>
          </div>
        </div> -->
        <!--/.sidebar-offcanvas-->
      </div>
      <!--/row--> 