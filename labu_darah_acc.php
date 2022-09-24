<?php
include "cek_user.php";
include "../inc/anggota_check.php";
date_default_timezone_set('Asia/Jakarta');
$awal = isset($_GET['awal']) ? $_GET['awal']:'';
$akr= isset($_GET['akhir']) ? $_GET['akhir']:'';
$akhir = date('Y-m-d',strtotime('+1 day',strtotime($akr)));
$fil = $db->query("SELECT ksl.id_stok_lab,sl.nama_barang,SUM(ksl.keluar) as total FROM stok_lab sl LEFT JOIN kartu_stok_labu ksl ON (ksl.id_stok_lab=sl.id_stok_lab) WHERE ksl.tanggal BETWEEN '$awal' AND '$akhir' OR ksl.tanggal IS NULL GROUP BY sl.id_stok_lab ORDER BY sl.nama_barang ASC");
$tip = $fil->fetchAll();
$to = $db->query("SELECT SUM(ksl.keluar) as subtotal FROM kartu_stok_labu ksl WHERE ksl.tanggal BETWEEN '$awal' AND '$akhir' AND id_register<>''");
$total = $to->fetch(PDO::FETCH_ASSOC);

$dt = $db->query("SELECT rp.nomedrek,rp.nama,ksl.tujuan,ksl.gol_darah,sl.nama_barang,ksl.keluar,ksl.tanggal,ksl.tanggal_selesai,ksl.selisih,ksl.id_kartu,ksl.reaksi,ksl.ket,SUM(ksl.keluar) as total FROM kartu_stok_labu ksl LEFT JOIN registerpasien rp ON(ksl.id_register=rp.id_pasien) INNER JOIN stok_lab sl ON(ksl.id_stok_lab=sl.id_stok_lab) WHERE ksl.status='keluar' AND ksl.tanggal BETWEEN '$awal' AND '$akhir' GROUP BY rp.nomedrek ORDER BY rp.nama asc");
$data=$dt->fetchAll();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SIMRS <?php echo $version_lab;?> | <?php echo $r1["nama"]; ?></title>
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
  <body class="<?= $skin_lab;?>">
    <div class="wrapper">

      <!-- static header -->
	  <?php include "header.php" ;?>
	  <?php include "menu_index.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
		<!-- pesan feedback -->
	    <?php if (isset($_GET['status']) && ($_GET['status'] == "1")) { ?><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-check"></i>Berhasil</h4>Data telah diupdate</center></div>
			<?php } else if (isset($_GET['status']) && ($_GET['status'] == "2")) { ?><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-check"></i>Berhasil</h4>Data pasien telah diproses</center></div>
			<?php } else if (isset($_GET['status']) && ($_GET['status'] == "3")) { ?><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-ban"></i>Peringatan!</h4>Data pasien gagal diubah</center></div>
			<?php } else if (isset($_GET['status']) && ($_GET['status'] == "4")) { ?><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-ban"></i>Peringatan!</h4>Data Hasil Tidak Ditemukan atau Belum selesai</center></div>
	    <?php } ?>
	    <!-- end pesan -->
        <section class="content-header">
          <h1>
            &nbsp
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Daftar rekapitulasi</li>
          </ol>
        </section>
				<section class="content">
          <div class="row">
            <div class="col-xs-6">
              <div class="box box-primary">
                <div class="box-header">
                  <i class="fa fa-user"></i>
				  			<h3 class="box-title">Data Rekap Berdasarkan Tipe Domisili</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="" class="table table-bordered table-striped" width="100%">
                    <thead>
											<tr class="bg-blue">
												<td width="20"><b>No.</td>
												<td width="600"><b>Domisili</td>
												<td width="20" align="center" valign="middle"><b>Total</td>
											</tr>
                    </thead>
										<tbody>
											<?php
											$nomer=1;
                      $ct = $db->query("SELECT rp.domisili,COUNT(*) as total FROM kartu_stok_labu ksl INNER JOIN registerpasien rp ON (ksl.id_register=rp.id_pasien) WHERE ksl.status='keluar' AND ksl.tanggal BETWEEN '$awal' AND '$akhir' GROUP BY rp.domisili");
                      $count = $ct->fetchAll();
											foreach ($count as $row) {
												echo "
												<tr>
  												<td>".$nomer++."</td>
  												<td>".$row['domisili']."</td>
  												<td align=\"center\">".$row['total']."</td>
												</tr>
												";
											}
											?>
										</tbody>
										<tfoot>
											<tr class="bg-red">
												<td colspan="2" align="right"><b>Jumlah</td>
												<td align="center"><?php echo $total['subtotal'];?></td>
											</tr>
										</tfoot>
									</table>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="box box-primary">
                <div class="box-header">
                  <i class="fa fa-heart"></i>
				  			<h3 class="box-title">Data Rekap Berdasarkan Tipe Darah</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="" class="table table-bordered table-striped" width="100%">
                    <thead>
											<tr class="bg-blue">
												<td width="20"><b>No.</td>
												<td width="600"><b>Tipe Darah</td>
												<td width="20"  align="center" valign="middle"><b>Total</td>
											</tr>
                    </thead>
										<tbody>
											<?php
											$nomer=1;
											foreach ($tip as $key) {
												if ($key['total']==NULL) {
													$to = "0";
												} else {
													$to = $key['total'];
												}
												echo "
												<tr>
												<td>".$nomer++."</td>
												<td>".$key['nama_barang']."</td>
												<td align=\"center\">".$to."</td>
												</tr>
												";
											}
											?>
										</tbody>
										<tfoot>
											<tr class="bg-red">
												<td colspan="2" align="right"><b>Jumlah</td>
												<td align="center"><?php echo $total['subtotal'];?></td>
											</tr>
										</tfoot>
									</table>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                  <i class="fa fa-user"></i>
									<h3 class="box-title">Data Rekap Labu Darah Keluar</h3>
								<?php
                echo "<button onclick=\"window.location.href='export_labu_darah.php?awal=$awal&akhir=$akhir'\" class=\"btn btn-info btn-sm btn-sm pull-right\"><i class=\"fa fa-external-link-square\"></i> Export ke Excel</button>";
								?>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example3" class="table table-bordered table-striped" width="100%">
                    <thead>
											<tr class="bg-red">
												<th width="20">No.</th>
												<th width="40">Nomedrek</th>
												<th width="80">Nama</th>
												<th>Tujuan</th>
												<th width="20">Gol Darah</th>
												<th width="160">Tipe Darah</th>
												<th width="20">Jumlah</th>
												<th width="120">Tanggal Keluar</th>
											</tr>
                    </thead>
										<tbody>
											<?php
											$nomor = 1;
											foreach ($data as $key) {
												echo "
												<tr>
													<td>".$nomor++."</td>
													<td>".$key['nomedrek']."</td>
													<td>".$key['nama']."</td>
													<td>".$key['tujuan']."</td>
													<td>".$key['gol_darah']."</td>
													<td>".$key['nama_barang']."</td>
													<td>".$key['total']."</td>
													<td>".$key['tanggal']."</td>
												</tr>
												";
											}
											?>
										</tbody>
									</table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
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
        $("#example1").dataTable();
        $("#example2").dataTable();
        $("#example3").dataTable();
      });
    </script>
  </body>
</html>
