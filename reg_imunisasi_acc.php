<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$ruang = isset($_GET['ruangan']) ? $_GET['ruangan'] : '';
$awal = isset($_GET['tanggalAwal']) ? $_GET['tanggalAwal'] : '';
$akhir = isset($_GET['tanggalAkhir']) ? $_GET['tanggalAkhir'] : '';
$akhir_plus_one = date('Y-m-d', strtotime($akhir . ' +1 day'));
$awal_fix = str_replace("-","",$awal);
$akhir_fix = str_replace("-","",$akhir);
$get_imunisasi = $db->query("SELECT * FROM riwayat_imunisasi r INNER JOIN registerpasien rp ON(r.id_register=rp.id_pasien) WHERE ktujuan LIKE '".$ruang."' AND r.created_at BETWEEN '".$awal."' AND '".$akhir_plus_one."'");
$data = $get_imunisasi->fetchAll(PDO::FETCH_ASSOC);
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
	  <?php
			include("header.php");
			include "menu_index.php";
		?>
      <div class="content-wrapper">
				<?php if (isset($_GET['status']) && ($_GET['status'] == "1")) { ?><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-check"></i>Berhasil</h4>Coding Rajal Berhasil disimpan.</center></div>
				<?php } else if (isset($_GET['status']) && ($_GET['status'] == "2")) { ?><div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-ban"></i>Peringatan</h4>Coding Rajal Gagal disimpan.</center></div>
		    <?php } ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
					<h1>
            Register Imunisasi <?php echo $ruang; ?>
          </h1>
					<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Register Imunisasi <?php echo $ruang; ?></li>
          </ol>
				</section>
        <!-- Main content -->
        <section class="content">
					<!-- general form elements -->
					<!-- left column -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="fa fa-user"></i>
				      <h3 class="box-title">Register Imunisasi <?php echo $ruang; ?></h3>
							<a class="btn btn-success pull-right" href="export_imunisasi.php?ruangan=<?php echo $ruang; ?>&tanggalAwal=<?php echo $awal; ?>&tanggalAkhir=<?php echo $akhir; ?>"><i class="fa fa-download"></i> Export to Excel</a>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped table-hover">
									<thead>
										<tr class="info">
											<th>Tanggal Imunisasi</th>
											<th>No. RM</th>
											<th>Nama</th>
											<th>Tanggal Lahir</th>
											<th>Jenis Kelamin</th>
											<th>Alamat</th>
											<th>Kelurahan</th>
											<th>Kecamatan</th>
											<th>Domisili</th>
											<th>Jenis Imunisasi</th>
											<th>Umur</th>
											<th>Nama Penanggungjawab</th>
										</tr>
									</thead>
									<tbody>
									<?php
									foreach ($data as $r2) {
										echo "<tr>
														<td>".$r2['waktu_pemberian']."</td>
														<td>".$r2['nomedrek']."</td>
														<td>".$r2['nama']."</td>
														<td>".$r2['tanggallahir']."</td>
														<td>".$r2['kelamin']."</td>
														<td>".$r2['alamat']."</td>
														<td>".$r2['kelurahan']."</td>
														<td>".$r2['kecamatan']."</td>
														<td>".$r2['domisili']."</td>
														<td>".$r2['jenis_imunisasi']."</td>
														<td>".$r2['umur']."</td>
														<td>".$r2['namapp']."</td>
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
      });
    </script>

  </body>
</html>
