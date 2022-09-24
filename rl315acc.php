<?php
include "cek_user.php";
include "../inc/anggota_check.php";
//ambil data filter
$bulan=$_POST["bulan"];
$tahun=$_POST["tahun"];
$gabung=$bulan."/".$tahun;
$set_slug = array('Membayar Sendiri','Asuransi Pemerintah','Asuransi Swasta',);
//pasien rawat jalan section
$tpr_bayar_sendiri =0;
$tpr_as_pem = 0;
$tpr_as_swa = 0;
$tpr_asr = 0;
$tpr_ks = 0;
$tpr_ktm = 0;
$tpr_lain = 0;
$tpr_grt = 0;
//mysql data pasien rajal
$h2=$db->query("SELECT '32prop' as 'kode_prop','Kota Bandung' as 'kota','3273260' as 'kode_rs','RSKIA Kota Bandung' as 'nama_rs',inv.jpasien,c.report_slug FROM invoice_all inv INNER JOIN cabar c ON(inv.jpasien=c.cabar) WHERE status_inv<>'belum dibayar' AND status_inv<>'gagal klaim' AND jenis_rawat='rajal' AND YEAR(tgl_inv)='$tahun' AND MONTH(tgl_inv)='$bulan'");
$data2=$h2->fetchAll();
//sorting
foreach ($data2 as $r2) {
	if($r2['report_slug']=='Membayar Sendiri'){
		$tpr_bayar_sendiri++;
	}elseif($r2['report_slug']=='Asuransi Pemerintah'){
		$tpr_as_pem++;
	}elseif($r2['report_slug']=='Asuransi Swasta'){
		$tpr_as_swa++;
	}elseif($r2['report_slug']=='Kartu Sehat'){
		$tpr_ks++;
	}elseif($r2['report_slug']=='Keterangan Tidak Mampu'){
		$tpr_ktm++;
	}else{
		$tpr_lain++;
	}
}
$tpr_asr = $tpr_as_pem+$tpr_as_swa;
$tpr_grt = $tpr_ks+$tpr_ktm+$tpr_lain;
// get rajal radiologi
$rd_bayar_sendiri = 0;
$rd_asr = 0;
$rd_as_pem = 0;
$rd_as_swa = 0;
$rd_grt = 0;
$rd_ks = 0;
$rd_ktm = 0;
$rd_lain = 0;

$sql_radio=$db->query("SELECT '32prop' as 'kode_prop','Kota Bandung' as 'kota','3273260' as 'kode_rs','RSKIA Kota Bandung' as 'nama_rs',inv.jpasien,c.report_slug FROM invoice_all inv INNER JOIN cabar c ON(inv.jpasien=c.cabar) INNER JOIN registerpasien rp ON(inv.id_register=rp.id_pasien) WHERE status_inv<>'belum dibayar' AND status_inv<>'gagal klaim' AND inv.jenis_rawat='rajal' AND rp.ktujuan='radio' AND YEAR(tgl_inv)='$tahun' AND MONTH(tgl_inv)='$bulan'");
$radio=$sql_radio->fetchAll();
foreach ($radio as $rad) {
	if($r2['report_slug']=='Membayar Sendiri'){
		$rd_bayar_sendiri++;
	}elseif($r2['report_slug']=='Asuransi Pemerintah'){
		$rd_as_pem++;
	}elseif($r2['report_slug']=='Asuransi Swasta'){
		$rd_as_swa++;
	}elseif($r2['report_slug']=='Kartu Sehat'){
		$rd_ks++;
	}elseif($r2['report_slug']=='Keterangan Tidak Mampu'){
		$rd_ktm++;
	}else{
		$rd_lain++;
	}
}
$rd_asr = $rd_as_pem+$rd_as_swa;
$rd_grt = $rd_ks+$rd_ktm+$rd_lain;
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
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
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
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
		<!-- pesan feedback -->
	    <?php if ((isset($_GET['status'])) && ($_GET['status'] == "1")) { ?><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-check"></i>Berhasil</h4>Data pasien telah diubah</center></div>
	    <?php } else if ((isset($_GET['status'])) && ($_GET['status'] == "2")) { ?><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-ban"></i>Peringatan!</h4>Data pasien gagal diubah</center></div>
	    <?php } ?>
	    <!-- end pesan -->
        <section class="content-header">
          <h1>
            Laporan
            <small>RL 3.15</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Laporan RL 3.15</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                  <i class="fa fa-user"></i>
				  <h3 class="box-title">Laporan RL 3.15 Tahun/Bulan : (<?php echo $tahun."/".$bulan; ?>)</h3>
					<a href="register_rl31.php?bulan=<?php echo $bulan; ?>&tahun=<?php echo $tahun; ?>" class="btn btn-success pull-right"><i class="fa fa-download"></i> Export ke Excel</a>
                </div><!-- /.box-header -->
                <div class="box-body">
									<div class="table-responsive">
										<table id="example1" class="table table-bordered table-striped">
	                    <thead>
	                      <tr class="info">
													<th>Kode Propinsi</th>
													<th>Kab/Kota</th>
													<th>Kode RS</th>
													<th>Nama RS</th>
	                        <th>Tahun</th>
													<th>No</th>
													<th>Cara Pembayaran</th>
													<th>Pasien Ranap JPK</th>
													<th>Pasien Ranap JLD</th>
	                        <th>Jumlah Pasien Rajal</th>
													<th>Jumlah Pasien Rajal Lab</th>
		                       <th>Jumlah Pasien Rajal Radiologi</th>
	                        <th>Jumlah Pasien Rajal LL</th>
	                      </tr>
	                    </thead>
	                    <tbody>
												<!-- membayar sendiri -->
												<tr>
	                        <td>32prop</td>
													<td>Kota Bandung</td>
													<td>3273260</td>
													<td>RSKIA Kota Bandung</td>
	                        <td><?php echo $tahun; ?></td>
													<td>1</td>
													<td>Membayar Sendiri</td>
													<td>0</td>
													<td>0</td>
	                        <td><?php echo $tpr_bayar_sendiri; ?></td>
													<td>0</td>
		                      <td><?php echo $rd_bayar_sendiri; ?></td>
	                        <td>0</td>
	                      </tr>
												<!-- end membayar sendiri -->
												<!-- Asuransi : Asuransi Pemerintah + Asuransi swasta -->
												<tr class="success">
	                        <td>32prop</td>
													<td>Kota Bandung</td>
													<td>3273260</td>
													<td>RSKIA Kota Bandung</td>
	                        <td><?php echo $tahun; ?></td>
													<td>2</td>
													<td>Asuransi :</td>
													<td>0</td>
													<td>0</td>
	                        <td><?php echo $tpr_asr; ?></td>
													<td>0</td>
		                      <td><?php echo $rd_asr; ?></td>
	                        <td>0</td>
	                      </tr>
												<!-- end Asuransi -->
												<!-- Asuransi Pemerintah -->
												<tr>
	                        <td>32prop</td>
													<td>Kota Bandung</td>
													<td>3273260</td>
													<td>RSKIA Kota Bandung</td>
	                        <td><?php echo $tahun; ?></td>
													<td>2.1</td>
													<td>Asuransi Pemerintah</td>
													<td>0</td>
													<td>0</td>
	                        <td><?php echo $tpr_as_pem; ?></td>
													<td>0</td>
		                      <td><?php echo $rd_as_pem; ?></td>
	                        <td>0</td>
	                      </tr>
												<!-- end Asuransi Pemerintah -->
												<!-- asuransi swasta -->
												<tr>
	                        <td>32prop</td>
													<td>Kota Bandung</td>
													<td>3273260</td>
													<td>RSKIA Kota Bandung</td>
	                        <td><?php echo $tahun; ?></td>
													<td>2.2</td>
													<td>Asuransi Swasta</td>
													<td>0</td>
													<td>0</td>
	                        <td><?php echo $tpr_as_swa; ?></td>
													<td>0</td>
		                      <td><?php echo $rd_as_swa; ?></td>
	                        <td>0</td>
	                      </tr>
												<!-- end asuransi swasta -->
												<!-- Cost Sharing -->
												<tr>
	                        <td>32prop</td>
													<td>Kota Bandung</td>
													<td>3273260</td>
													<td>RSKIA Kota Bandung</td>
	                        <td><?php echo $tahun; ?></td>
													<td>3</td>
													<td>Keringanan (Cost Sharing)</td>
													<td>0</td>
													<td>0</td>
	                        <td>0</td>
													<td>0</td>
		                      <td>0</td>
	                        <td>0</td>
	                      </tr>
												<!-- end Cost Sharing -->
												<!-- Gratis -->
												<tr class="success">
	                        <td>32prop</td>
													<td>Kota Bandung</td>
													<td>3273260</td>
													<td>RSKIA Kota Bandung</td>
	                        <td><?php echo $tahun; ?></td>
													<td>4</td>
													<td>Gratis :</td>
													<td>0</td>
													<td>0</td>
	                        <td><?php echo $tpr_grt; ?></td>
													<td>0</td>
		                      <td><?php echo $rd_grt; ?></td>
	                        <td>0</td>
	                      </tr>
												<!-- end gratis -->
												<!-- kartu Sehat -->
												<tr>
	                        <td>32prop</td>
													<td>Kota Bandung</td>
													<td>3273260</td>
													<td>RSKIA Kota Bandung</td>
	                        <td><?php echo $tahun; ?></td>
													<td>4.1</td>
													<td>Kartu Sehat</td>
													<td>0</td>
													<td>0</td>
	                        <td><?php echo $tpr_ks; ?></td>
													<td>0</td>
		                      <td><?php echo $rd_ks; ?></td>
	                        <td>0</td>
	                      </tr>
												<!-- end kartu sehat -->
												<!-- Keterangan tidak mampu -->
												<tr>
	                        <td>32prop</td>
													<td>Kota Bandung</td>
													<td>3273260</td>
													<td>RSKIA Kota Bandung</td>
	                        <td><?php echo $tahun; ?></td>
													<td>4.2</td>
													<td>Keterangan Tidak Mampu</td>
													<td>0</td>
													<td>0</td>
	                        <td><?php echo $tpr_ktm; ?></td>
													<td>0</td>
		                      <td><?php echo $rd_ktm; ?></td>
	                        <td>0</td>
	                      </tr>
												<!-- end keterangan tidak mampu -->
												<!-- Lain-Lain -->
												<tr>
	                        <td>32prop</td>
													<td>Kota Bandung</td>
													<td>3273260</td>
													<td>RSKIA Kota Bandung</td>
	                        <td><?php echo $tahun; ?></td>
													<td>4.3</td>
													<td>Lain-Lain</td>
													<td>0</td>
													<td>0</td>
	                        <td><?php echo $tpr_lain; ?></td>
													<td>0</td>
		                      <td><?php echo $rd_lain; ?></td>
	                        <td>0</td>
	                      </tr>
												<!-- end lain-lain -->
	                    </tbody>
	                  </table>
									</div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!-- static footer -->
			<?php include("footer.php"); ?>
	  <!-- /.static footer -->
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
