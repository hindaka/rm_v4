<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$awal = isset($_GET['awal']) ? trim($_GET['awal']) : '';
$akhir = isset($_GET['akhir']) ? trim($_GET['akhir']) : '';
$statistik = isset($_GET['statistik']) ? trim($_GET['statistik']) : '';
$filter_kelamin = false;
if($statistik=="rajalAll"){
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) WHERE rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC");
	$q->bindParam(':awal',$awal,PDO::PARAM_STR);
	$q->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Dalam kota' AND rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC");
	$dalam_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Luar kota' AND rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC");
	$luar_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$title = "Seluruh Kasus Pada Pasien Rawat Jalan";
	$filter_kelamin = false;
}elseif($statistik=="ranapAll"){
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) WHERE rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC");
	$q->bindParam(':awal',$awal,PDO::PARAM_STR);
	$q->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Dalam kota' AND rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC");
	$dalam_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Luar kota' AND rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC");
	$luar_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$title = "Seluruh Kasus Pada Pasien Rawat Inap";
	$filter_kelamin = false;
}elseif($statistik=="10rajal"){
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd,COUNT( CASE WHEN r.kelamin='Laki-laki' THEN 1 ELSE NULL END) as laki,COUNT( CASE WHEN r.kelamin='Perempuan' THEN 1 ELSE NULL END) as perempuan,COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE rp.kasus='Baru' AND rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') GROUP BY f.kode_icd ORDER BY total DESC LIMIT 10");
	$q->bindParam(':awal',$awal,PDO::PARAM_STR);
	$q->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd,COUNT( CASE WHEN r.kelamin='Laki-laki' THEN 1 ELSE NULL END) as laki,COUNT( CASE WHEN r.kelamin='Perempuan' THEN 1 ELSE NULL END) as perempuan,COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE rp.kasus='Baru' AND r.domisili='Dalam kota' AND rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') GROUP BY f.kode_icd ORDER BY total DESC LIMIT 10");
	$dalam_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd,COUNT( CASE WHEN r.kelamin='Laki-laki' THEN 1 ELSE NULL END) as laki,COUNT( CASE WHEN r.kelamin='Perempuan' THEN 1 ELSE NULL END) as perempuan,COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE rp.kasus='Baru' AND r.domisili='Luar kota' AND rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') GROUP BY f.kode_icd ORDER BY total DESC LIMIT 10");
	$luar_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$title = "10 Kasus Terbanyak Pada Pasien Rawat Jalan (Kasus Baru)";
	$filter_kelamin = true;
}elseif($statistik=="10ranap"){
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd,COUNT( CASE WHEN r.kelamin='Laki-laki' THEN 1 ELSE NULL END) as laki,COUNT( CASE WHEN r.kelamin='Perempuan' THEN 1 ELSE NULL END) as perempuan,COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') GROUP BY f.kode_icd ORDER BY total DESC LIMIT 10");
	$q->bindParam(':awal',$awal,PDO::PARAM_STR);
	$q->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd,COUNT( CASE WHEN r.kelamin='Laki-laki' THEN 1 ELSE NULL END) as laki,COUNT( CASE WHEN r.kelamin='Perempuan' THEN 1 ELSE NULL END) as perempuan,COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Dalam kota' AND rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') GROUP BY f.kode_icd ORDER BY total DESC LIMIT 10");
	$dalam_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd,COUNT( CASE WHEN r.kelamin='Laki-laki' THEN 1 ELSE NULL END) as laki,COUNT( CASE WHEN r.kelamin='Perempuan' THEN 1 ELSE NULL END) as perempuan,COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Luar kota' AND rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') GROUP BY f.kode_icd ORDER BY total DESC LIMIT 10");
	$luar_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$title = "10 Kasus Terbanyak Pada Pasien Rawat Inap";
	$filter_kelamin = true;
}elseif($statistik=="21all"){
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) WHERE rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$q->bindParam(':awal',$awal,PDO::PARAM_STR);
	$q->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Dalam kota' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$dalam_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Luar kota' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$luar_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$title = "21 kasus Terbanyak Pada Pasien Rawat Jalan & Rawat Inap";
	$filter_kelamin = false;
}elseif($statistik=="21rajal"){
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) WHERE rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$q->bindParam(':awal',$awal,PDO::PARAM_STR);
	$q->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Dalam kota' AND rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$dalam_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Luar kota' AND rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$luar_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$title = "21 kasus Terbanyak Pada Pasien Rawat Jalan";
	$filter_kelamin = false;
}elseif($statistik=="21ranap"){
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) WHERE rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$q->bindParam(':awal',$awal,PDO::PARAM_STR);
	$q->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Dalam kota' AND rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$dalam_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Luar kota' AND rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$luar_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$title = "21 kasus Terbanyak Pada Pasien Rawat Inap";
	$filter_kelamin = false;
}else{
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) WHERE rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$q->bindParam(':awal',$awal,PDO::PARAM_STR);
	$q->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Dalam kota' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$dalam_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Luar kota' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$luar_kota->bindParam(':awal',$awal,PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir',$akhir,PDO::PARAM_STR);
	$title = "21 kasus Terbanyak Pada Pasien Rawat Jalan & Rawat Inap";
	$filter_kelamin = false;
}
// $split1 = explode("-",$awal);
// $split2 = explode("-",$akhir);
// $new_awal = $split1[0].$split1[1].$split1[2];
// $new_akhir = $split2[0].$split2[1].$split2[2];
$q->execute();
$luar_kota->execute();
$dalam_kota->execute();
$stat = $q->fetchAll(PDO::FETCH_ASSOC);
$dalam = $dalam_kota->fetchAll(PDO::FETCH_ASSOC);
$luar = $luar_kota->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SIMRS <?php echo $version; ?> | <?php echo $r1["tipe"]; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../plugins/font-awesome/4.3.0/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="../plugins/ionicons/2.0.0/ionicon.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-black">
    <div class="wrapper">

      <!-- static header -->
	  <header class="main-header">
        <a href="index.php" class="logo"><b>SIMRS</b><?php echo $version; ?></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="../dist/img/user3-128x128.jpg" class="img-circle" alt="user image"/>
                          </div>
                          <h4>
                            AdminLTE Design Team
                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="../dist/img/user4-128x128.jpg" class="img-circle" alt="user image"/>
                          </div>
                          <h4>
                            Developers
                            <small><i class="fa fa-clock-o"></i> Today</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="../dist/img/user3-128x128.jpg" class="img-circle" alt="user image"/>
                          </div>
                          <h4>
                            Sales Department
                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="../dist/img/user4-128x128.jpg" class="img-circle" alt="user image"/>
                          </div>
                          <h4>
                            Reviewers
                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-red"></i> 5 new members joined
                        </a>
                      </li>

                      <li>
                        <a href="#">
                          <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-user text-red"></i> You changed your username
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Create a nice theme
                            <small class="pull-right">40%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">40% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Some task I need to do
                            <small class="pull-right">60%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">60% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Make beautiful transitions
                            <small class="pull-right">80%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">80% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $r1["nama"]; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $r1["nama"]; ?> - <?php echo $r1["tipe"]; ?>
                      <small>Member sejak <?php echo $r1["tanggal"]; ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header><!-- ./static header -->
	  <?php include "menu_index.php"; ?>
      <div class="content-wrapper">
				<?php if (isset($_GET['status']) && ($_GET['status'] == "1")) { ?><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-check"></i>Berhasil</h4>Coding Rajal Berhasil disimpan.</center></div>
			<?php } else if (isset($_GET['status']) && ($_GET['status'] == "2")) { ?><div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-ban"></i>Peringatan</h4>Coding Rajal Gagal disimpan.</center></div>
		    <?php } ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Analytic
            <small>Statistik</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box">
		            <div class="box-header with-border">
		              <h3 class="box-title"><b><?php echo $title; ?></b></h3>
		            </div>
		            <div class="box-body">
						<a href="statistik_all_export.php?statistik=<?php echo $statistik?>&awal=<?php echo $awal ?>&akhir=<?php echo $akhir ?>" target="_blank" class="btn btn-success pull-right"><i class="fa fa-download"></i> Export ke Excel</a><br><br>
									<div class="table-responsive">
										<table id="example1" class="table table-bordered table-hover table-striped">
											<thead>
												<tr class="info">
													<th>Kode ICD</th>
													<th>Diagnosa Utama</th>
													<?php
														if($filter_kelamin==true){
																echo "<th>Laki-laki</th>
																<th>Perempuan</th>";
														}
													?>
													<th>Jumlah Kasus</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach ($stat as $row) {
														if($filter_kelamin==true){
															echo "<tr>
															<td>".$row['kode_icd']."</td>
																<td>".$row['diagnosa_utama']."</td>
																<td>".$row['laki']."</td>
																<td>".$row['perempuan']."</td>
																<td>".$row['total']."</td>
															</tr>";
														}else{
															echo "<tr>
															<td>".$row['kode_icd']."</td>
																<td>".$row['diagnosa_utama']."</td>
																<td>".$row['total']."</td>
															</tr>";
														}

													}
												 ?>
											</tbody>
										</table>
									</div>
		            </div><!-- /.box-body -->
		          </div><!-- /.box -->
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 div colx-xs-12">
							<div class="box">
		            <div class="box-header with-border">
		              <h3 class="box-title"><b><?php echo $title; ?> DALAM KOTA</b></h3>
		            </div>
		            <div class="box-body">
									<div class="table-responsive">
										<table id="dalam" class="table table-bordered table-hover table-striped">
											<thead>
												<tr class="info">
													<th>Kode ICD</th>
													<th>Diagnosa Utama</th>
													<?php
														if($filter_kelamin==true){
																echo "<th>Laki-laki</th>
																<th>Perempuan</th>";
														}
													?>
													<th>Jumlah Kasus</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach ($dalam as $row) {
														if($filter_kelamin==true){
															echo "<tr>
															<td>".$row['kode_icd']."</td>
																<td>".$row['diagnosa_utama']."</td>
																<td>".$row['laki']."</td>
																<td>".$row['perempuan']."</td>
																<td>".$row['total']."</td>
															</tr>";
														}else{
															echo "<tr>
															<td>".$row['kode_icd']."</td>
																<td>".$row['diagnosa_utama']."</td>
																<td>".$row['total']."</td>
															</tr>";
														}
													}
												 ?>
											</tbody>
										</table>
									</div>
		            </div><!-- /.box-body -->
		          </div><!-- /.box -->
						</div>
						<div class="col-md-6 div colx-xs-12">
							<div class="box">
		            <div class="box-header with-border">
		              <h3 class="box-title"><b><?php echo $title; ?> LUAR KOTA</b></h3>
		            </div>
		            <div class="box-body">
									<div class="table-responsive">
										<table id="luar" class="table table-bordered table-hover table-striped">
											<thead>
												<tr class="info">
													<th>Kode ICD</th>
													<th>Diagnosa Utama</th>
													<?php
														if($filter_kelamin==true){
																echo "<th>Laki-laki</th>
																<th>Perempuan</th>";
														}
													?>
													<th>Jumlah Kasus</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach ($luar as $row) {
														if($filter_kelamin==true){
															echo "<tr>
															<td>".$row['kode_icd']."</td>
																<td>".$row['diagnosa_utama']."</td>
																<td>".$row['laki']."</td>
																<td>".$row['perempuan']."</td>
																<td>".$row['total']."</td>
															</tr>";
														}else{
															echo "<tr>
															<td>".$row['kode_icd']."</td>
																<td>".$row['diagnosa_utama']."</td>
																<td>".$row['total']."</td>
															</tr>";
														}
													}
												 ?>
											</tbody>
										</table>
									</div>
		            </div><!-- /.box-body -->
		          </div><!-- /.box -->
						</div>
					</div>


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!-- static footer -->
	  <?php include "footer.php"; ?><!-- /.static footer -->
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").DataTable({
					"order": [[2, 'desc']],
				});
				$("#dalam").DataTable({
					"order": [[2, 'desc']],
				});
				$("#luar").DataTable({
					"order": [[2, 'desc']],
				});
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>

  </body>
</html>
