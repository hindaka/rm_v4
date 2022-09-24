<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$get_poli = $db->query("SELECT * FROM poliklinik WHERE aktif='ya'");
$data_poli = $get_poli->fetchAll(PDO::FETCH_ASSOC);
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
			include('header.php');
			include "menu_index.php";
		?>
      <div class="content-wrapper">
			<?php if (isset($_GET['status']) && ($_GET['status'] == "1")) { ?><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-check"></i>Berhasil</h4>Coding Rajal Berhasil disimpan.</center></div>
			<?php } else if (isset($_GET['status']) && ($_GET['status'] == "2")) { ?><div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-ban"></i>Peringatan</h4>Coding Rajal Gagal disimpan.</center></div>
		    <?php } ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
					<h1>
            Register Imunisasi
          </h1>
					<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Register Imunisasi</li>
          </ol>
				</section>

        <!-- Main content -->
        <section class="content">

					<!-- general form elements -->
					<!-- left column -->
					<div class="box">
						<!-- form start -->
						<form role="form" action="reg_imunisasi_acc.php" method="get">
							<div class="box-body">
								<div class="form-group">
								  <label for="ruang">Ruangan <span style="color:red">*</span></label>
								  <select class="form-control" name="ruangan" required>
										<option value="">Pilih Ruangan</option>
										<?php
											foreach ($data_poli as $poli) {
												echo '<option value="'.$poli['slug_poli'].'">'.$poli['nama_poli'].'</option>';
											}
										?>
								  </select>
								</div>
								<div class="form-group">
								  <label for="tanggalAwal">Tanggal Awal <span style="color:red">*</span></label>
								  <input type="date" name="tanggalAwal" class="form-control" id="tanggalAwal" required>
								</div>
								<div class="form-group">
								  <label for="tanggalAkhir">Tanggal Akhir <span style="color:red">*</span></label>
								  <input type="date" name="tanggalAkhir" class="form-control" id="tanggalAkhir" required>
								</div>
							</div><!-- /.box-body -->

							<div class="box-footer">
								<!-- <input type="hidden" name="id_pegawai" value="<?php echo $id; ?>"> -->
								<button type="submit" class="btn btn-primary">Cari</button>
							</div>
						</form>
					</div><!-- /.left column -->
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
      //Flat red color scheme for iCheck
      $('input[type="radio"].flat-blue').iCheck({
        radioClass: 'iradio_flat-blue'
      });
	  //Date range picker
      $('#tanggaldaftar').datepicker({
	    format: 'dd/mm/yyyy',
		todayHighlight: true,
		autoclose: true
	  });
	  //Date range picker
      $('#tanggalb').datepicker({
	    format: 'dd/mm/yyyy',
		todayHighlight: true,
		autoclose: true
	  });
    </script>

  </body>
</html>
