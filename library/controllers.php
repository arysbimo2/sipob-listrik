<?php
error_reporting(0);
class oop{
	function koneksi($db)
	{
		$server		="localhost";
		$username	="root";
		$password	="";
		mysql_connect($server,$username,$password);
		mysql_select_db($db)or die("<b>ERROR</b><br>Database Tidak Ditemukan!!");
	}
	function id($table,$kode,$awal)
	{
		//Otomatis Id
		  $cari_id = mysql_query("SELECT MAX(".$kode.") as kode FROM ".$table); //Mencari Id
		  $tm_cari = mysql_fetch_array($cari_id);
		  $kode = substr($tm_cari[0], 2,4); //mengambil string
		  $tambah = $kode + 1;
		   if ($tambah < 10) {
		    $id = $awal."000".$tambah;
		    return $id;
		   }else if($tambah < 100){
		    $id = $awal."00".$tambah;
		    return $id;
		   }elseif ($tambah < 1000) {
		   	$id = $awal."0".$tambah;
		    return $id;
		   }else{
		   	$id = $awal.$tambah;
		    return $id;
		   }
	}
	function simpan($table,array $field,$menu)
	{
		$sql = "INSERT INTO ".$table." SET";
		foreach ($field as $key => $value) {
			$sql.=" $key = '$value' ,";
		}
		$sql 	=rtrim($sql,',');
		$jalan	=mysql_query($sql);
		if ($jalan) {
			echo "<script>alert('Berhasil Disimpan!');document.location.href='$menu'</script>";
		}else{
			$a 	=mysql_error();
			echo "<script>alert('Gagal Disimpan!');</script>";
			echo $a;

		}
	}
  function simpan2($table,array $field,$menu)
  {
    $sql = "INSERT INTO ".$table." SET";
    foreach ($field as $key => $value) {
      $sql.=" $key = '$value' ,";
    }
    $sql  =rtrim($sql,',');
    $jalan  =mysql_query($sql);
    if ($jalan) {
      echo "<script>alert('Berhasil Terbayar !');document.location.href='$menu';</script>";
    }else{
      $a  =mysql_error();
      echo "<script>alert('Gagal Disimpan!');</script>";
      echo $a;

    }
  }
    function hapus($table, $where,$redirect){
      $sql = "DELETE FROM ".$table." WHERE ".$where;
      $jalan = mysql_query($sql);
      if($jalan){
        echo "<script>alert('Berhasil Di Hapus !');document.location.href='$redirect'</script>";
      }else{
        echo mysql_error();
      }
    }


    function ubah($table, array $field, $where, $redirect){
      $sql = "UPDATE $table SET";
      foreach ($field as $key => $value){
        $sql.=" $key = '$value',";
      }
      $sql = rtrim($sql, ',');
      $sql.="WHERE $where";
      $jalan = mysql_query($sql);
      if($jalan){
        echo "<script>alert('Berhasil !');document.location.href='$redirect'</script>";
      }else{
        echo mysql_error();
      }
    }


    function ubah2($table, array $field, $where, $redirect){
      $sql = "UPDATE $table SET";
      foreach ($field as $key => $value){
        $sql.=" $key = '$value',";
      }
      $sql = rtrim($sql, ',');
      $sql.="WHERE $where";
      $jalan = mysql_query($sql);
      if($jalan){

      }else{
        echo mysql_error();
      }
    }


    function edit($table,$where){
      $sql="SELECT * FROM $table WHERE $where";
      $a = mysql_query($sql);
      $tampil = mysql_fetch_array($a);
      return $tampil;
    }


    function upload($foto){
      $alamat=$foto['tmp_name'];
      $namafile=$foto['name'];
      move_uploaded_file($alamat,"foto/$namafile");
      return $namafile;
    }
    function login($table,$username,$password,$nama_form){
      @session_start();
      $sql="SELECT * FROM $table WHERE username ='$username' AND password='$password' ";
      $jalan=mysql_query($sql);
      $tampil=mysql_fetch_array($jalan);
      $cek=mysql_num_rows($jalan);
      if ($cek>0) {
        $_SESSION['username']=$username;
        echo "<script>alert('Selamat Datang'".$username."'!!');document.location.href='".$nama_form."'</script>";
      }else {
        echo "<script>alert('Login Gagal!! Cek Username atau Password!!');document.location.href='?'</script>";
      }
    }
}

?>
