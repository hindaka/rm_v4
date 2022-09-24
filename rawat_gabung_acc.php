<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$ruang = isset($_GET['ruangan']) ? $_GET['ruangan'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$awal = isset($_GET['tanggalAwal']) ? $_GET['tanggalAwal'] : '';
$akhir = isset($_GET['tanggalAkhir']) ? $_GET['tanggalAkhir'] : '';
$akhir_plus_one = date('Y-m-d', strtotime($akhir . ' +1 day'));
$awal_fix = str_replace("-","",$awal);
$akhir_fix = str_replace("-","",$akhir);
if($filter=='masuk'){
  $text = "Filter Berdasarkan Tanggal Masuk Pasien Ke Ruangan";
	//filter berdasarkan tanggal masuk
  if($ruang=='nifas4'){
    $query = $db->query("SELECT n4.*,n4.kelas as kelas_rawat,rp.* FROM nifas4 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='2' AND n4.tipenifas4='bayi' AND CAST(CONCAT(SUBSTRING(n4.tanggalmasuk,7,4),SUBSTRING(n4.tanggalmasuk,4,2),SUBSTRING(n4.tanggalmasuk,1,2)) AS UNSIGNED) >= '".$awal_fix."' AND CAST(CONCAT(SUBSTRING(n4.tanggalmasuk,7,4),SUBSTRING(n4.tanggalmasuk,4,2),SUBSTRING(n4.tanggalmasuk,1,2)) AS UNSIGNED) <= '".$akhir_fix."'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
  }elseif ($ruang=='nifas3') {
    $query = $db->query("SELECT n3.*,n3.kelas as kelas_rawat,rp.* FROM nifas3 n3 INNER JOIN registerpasien rp ON(n3.id_register=rp.id_pasien) WHERE n3.status='2' AND n3.tipenifas3='bayi' CAST(CONCAT(SUBSTRING(n3.tanggalmasuk,7,4),SUBSTRING(n3.tanggalmasuk,4,2),SUBSTRING(n3.tanggalmasuk,1,2)) AS UNSIGNED) >= '".$awal_fix."' AND CAST(CONCAT(SUBSTRING(n3.tanggalmasuk,7,4),SUBSTRING(n3.tanggalmasuk,4,2),SUBSTRING(n3.tanggalmasuk,1,2)) AS UNSIGNED) <= '".$akhir_fix."'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
  }else{

  }
}elseif ($filter=='keluar') {
  //filter berdasarkan tanggal keluar
  $text = "Filter Berdasarkan Tanggal Keluar Pasien dari Ruangan";
	if($ruang=='nifas4'){
    $query = $db->query("SELECT n4.*,n4.kelas as kelas_rawat,rp.* FROM nifas4 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='2' AND n4.tipenifas4='bayi' tanggalkeluar BETWEEN '".$awal."' AND '".$akhir_plus_one."' ORDER BY tanggalkeluar ASC");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
  }elseif ($ruang=='nifas3') {
    $query = $db->query("SELECT n3.*,n3.kelas as kelas_rawat,rp.* FROM nifas3 n3 INNER JOIN registerpasien rp ON(n3.id_register=rp.id_pasien) WHERE n3.status='2' AND n3.tipenifas3='bayi' tanggalkeluar BETWEEN '".$awal."' AND '".$akhir_plus_one."' ORDER BY tanggalkeluar ASC");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
  }else{

  }
}else{
  header("Location: rawat_gabung.php");
}
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
		<!-- daterange picker -->
    <link href="../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<!-- iCheck for checkboxes and radio inputs -->
    <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
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
            Register Ruangan Rawat Inap
          </h1>
					<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Register Ruangan</li>
          </ol>
				</section>

        <!-- Main content -->
        <section class="content">

					<!-- general form elements -->
					<!-- left column -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="fa fa-user"></i>
      <h3 class="box-title"><?php echo strtoupper($ruang); ?> <small><?php echo $text; ?></small></h3>
			<a class="btn btn-success pull-right" href="export_rawat_gabung.php?ruangan=<?php echo $ruang; ?>&filter=<?php echo $filter; ?>&tanggalAwal=<?php echo $awal; ?>&tanggalAkhir=<?php echo $akhir; ?>"><i class="fa fa-download"></i> Export to Excel</a>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                  <!-- nifas4 & nifas3 -->
                  <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr class="info">
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Lama Rawat</th>
            <th>No. RM</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Domisili</th>
            <th>Jam masuk</th>
                        <th>Pendidikan</th>
            <th>Pekerjaan</th>
                        <th>Asal ruangan</th>
            <th>Umur pasien</th>
            <th>Umur suami</th>

            <th>Rujukan dari</th>
            <th>Tanggal daftar</th>
                        <th>Cara keluar</th>
            <th>Cara bayar</th>
            <th>DPJP</th>
            <th>Cara Persalinan</th>
            <th>Tanggal Lahir bayi</th>
            <th>Jenis Kelamin bayi</th>
            <th>Jam lahir Bayi</th>
            <th>BB Bayi</th>
            <th>Panjang bayi</th>
            <th>A/S</th>
            <th>Kelas</th>
            <th>Gol.darah</th>
            <th>Nilai Kritis</th>
            <th>Jenis Darah & Jumlah Labu</th>
            <th>Diagnosa Awal</th>
            <th>Diagnosa Akhir</th>
            <th>Indikasi meninggal</th>
                      </tr>
                    </thead>
                    <tbody>
  <?php
  foreach ($data as $r2) {

  if($r2['tanggalkeluar']=="0000-00-00 00:00:00"){
    $check = $db->query("SELECT COUNT(*) as total FROM log_trans_pasien WHERE id_register='".$r2['id_register']."' AND keluar LIKE '%".$r2['carakeluar']."%'");
    $ch = $check->fetch(PDO::FETCH_ASSOC);
    if($ch['total']==0){
      $tgl_out = $r2['tanggalkeluar'];
      $lama_rawat = "unknown";
    }else{
      $get_data = $db->query("SELECT * FROM log_trans_pasien WHERE id_register='".$r2['id_register']."' AND keluar LIKE '%".$r2['carakeluar']."%'");
      $data = $get_data->fetch(PDO::FETCH_ASSOC);
      $masuk = explode('/',$r2['tanggalmasuk']);
      $tgl_in = $masuk[2]."-".$masuk[1]."-".$masuk[0]." ".$r2['jamm'];
      $tgl_out = $data['tgl_trans_log'];
      $diff = date_diff(date_create($tgl_out), date_create($tgl_in));
      $hari = $diff->format('%d');
      $jam = $diff->format('%h');
      if(($hari==0)&&($jam<=24)){
        $lama_rawat = "1 Hari";
      }else{
        $lama_rawat=$diff->format('%d Hari %h Jam %i Menit %s Detik');
      }
    }
  }else{
    $masuk = explode('/',$r2['tanggalmasuk']);
    $tgl_in = $masuk[2]."-".$masuk[1]."-".$masuk[0]." ".$r2['jamm'];
    $tgl_out = $r2['tanggalkeluar'];
    $diff = date_diff(date_create($tgl_out), date_create($tgl_in));
    $hari = $diff->format('%d');
    $jam = $diff->format('%h');
    if(($hari==0)&&($jam<=24)){
      $lama_rawat = "1 Hari";
    }else{
      $lama_rawat=$diff->format('%d Hari %h Jam %i Menit %s Detik');
    }
  }

  echo "<tr>
    <td>".$r2['tanggalmasuk']."</td>
    <td>".$tgl_out."</td>
    <td>".$lama_rawat."</td>
    <td>".$r2['nomedrek']."</td>
      <td>".$r2['nama']."</td>
      <td>".$r2['alamat']."</td>
      <td>".$r2['domisili']."</td>
    <td>".$r2['jamm']."</td>
    <td>".$r2['pendistri']."</td>
      <td>".$r2['pistri']."</td>
      <td>".$r2['asal']."</td>
      <td>".$r2['umur']."</td>
    <td>".$r2['usuami']."</td>

    <td>".$r2['rujukan']."</td>
    <td>".$r2['tanggaldaftar']."</td>
    <td>".$r2['carakeluar']."</td>
    <td>".$r2['jpasien']."</td>
    <td>".$r2['dpjp']."</td>
    <td>".$r2['carap']."</td>
    <td>".$r2['ttl']."</td>
    <td>".$r2['jk']."</td>
    <td>".$r2['jl']."</td>
    <td>".$r2['bb']."</td>
    <td>".$r2['tinggi']."</td>
    <td>".$r2['ascore']."</td>
    <td>".$r2['kelas_rawat']."</td>
    <td>".$r2['gol']."</td>
    <td>".$r2['nilai_kritis']."</td>
    <td>".$r2['jenis']."</td>
    <td>".$r2['diagnosam']."</td>
    <td>".$r2['diagnosaa']."</td>
    <td>".$r2['paeh']."</td>
  </tr>";
  }
  ?>
                    </tbody>
                  </table>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
				</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!-- static footer -->
	  <?php include "footer.php" ; ?>
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<!-- date-picker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
		<!-- typeahead -->
    <script src="../plugins/typeahead/typeahead.bundle.js" type="text/javascript"></script>
		<!-- iCheck 1.0.1 -->
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
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
