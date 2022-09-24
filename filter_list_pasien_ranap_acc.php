<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$ruang = isset($_GET['ruangan']) ? $_GET['ruangan'] : '';
// $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
// $awal = isset($_GET['tanggalAwal']) ? $_GET['tanggalAwal'] : '';
// $akhir = isset($_GET['tanggalAkhir']) ? $_GET['tanggalAkhir'] : '';
// $akhir_plus_one = date('Y-m-d', strtotime($akhir . ' +1 day'));
// $awal_fix = str_replace("-","",$awal);
// $akhir_fix = str_replace("-","",$akhir);
$text = "Filter Berdasarkan Tanggal Masuk Pasien Ke Ruangan";
//filter berdasarkan tanggal masuk
if ($ruang == 'lantai12') {
	$query = $db->query("SELECT n4.tanggalmasuk,n4.tanggalkeluar,n4.diagnosaa,n4.diagnosam,n4.jamp,n4.jamm,n4.dpjp,n4.asal,n4.carakeluar,n4.id_register,n4.carap,n4.kelas as kelas_pasien,rp.* FROM lantai12 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='1'");
	$data = $query->fetchAll(PDO::FETCH_ASSOC);
	$text_ruangan = "Rawat Inap Presiden Suite, Junior Suite, VIP (Lantai 12)";
} elseif ($ruang == 'lantai11') {
	$query = $db->query("SELECT p.tanggalmasuk,p.tanggalkeluar,p.diagnosaa,p.diagnosam,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,rp.*,p.kelas as 'kelas_pasien' FROM `lantai11` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status='1'");
	$data = $query->fetchAll(PDO::FETCH_ASSOC);
	$text_ruangan = "Lantai 11 (Ruang IPD/BEDAH)";
} elseif ($ruang == 'lantai8') {
	$query = $db->query("SELECT n4.tanggalmasuk,n4.tanggalkeluar,n4.diagnosaa,n4.diagnosam,n4.jamp,n4.jamm,n4.dpjp,n4.asal,n4.carakeluar,n4.id_register,n4.carap,n4.kelas as kelas_pasien,rp.* FROM lantai8 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='1'");
	$data = $query->fetchAll(PDO::FETCH_ASSOC);
	$text_ruangan = "Lantai 8 (Ranap Isolasi)";
} elseif ($ruang == 'nifas4') {
	$query = $db->query("SELECT n4.tanggalmasuk,n4.tanggalkeluar,n4.diagnosaa,n4.diagnosam,n4.jamp,n4.jamm,n4.dpjp,n4.asal,n4.carakeluar,n4.id_register,n4.carap,n4.kelas as kelas_pasien,rp.* FROM nifas4 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='1'");
	$data = $query->fetchAll(PDO::FETCH_ASSOC);
	$text_ruangan = "Lantai 10 (Ranap Ibu)";
} elseif ($ruang == 'anak') {
	$query = $db->query("SELECT a.*,a.kelas as kelas_anak,rp.* FROM anak a LEFT JOIN registerpasien rp ON(a.id_register=rp.id_pasien) WHERE a.status='1'");
	$data = $query->fetchAll(PDO::FETCH_ASSOC);
	$text_ruangan = "Lantai 9 (Ranap Anak)";
} elseif ($ruang == 'lantai8') {
	$query = $db->query("SELECT p.*,rp.*,p.kelas as 'kelas_pasien' FROM `lantai8` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status='1'");
	$data = $query->fetchAll(PDO::FETCH_ASSOC);
	$text = "Lantai 8 (Ranap)";
} elseif ($ruang == 'vk') {
	$query = $db->query("SELECT p.tanggalmasuk,p.tanggalkeluar,p.diagnosaa,p.diagnosam,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,rp.*,p.kelas as 'kelas_pasien' FROM `vk` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status='1'");
	$data = $query->fetchAll(PDO::FETCH_ASSOC);
	$text_ruangan = "Lantai 7 (Ruang Bersalin)";
} elseif ($ruang == 'peri') {
	$query = $db->query("SELECT p.*,rp.*,p.kelas as 'kelas_peri' FROM `peri` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND p.tanggalmasuk BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "'");
	$data = $query->fetchAll(PDO::FETCH_ASSOC);
	$text_ruangan = "Lantai 7 (Perinatologi)";
} elseif ($ruang == 'ok') {
	$query = $db->query("SELECT p.tanggalok as tanggalmasuk,p.tanggalkeluar,p.diagnosaa,p.diagnosam,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,p.operasi,p.tindakan,rp.* FROM `ok` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status='1'");
	$data = $query->fetchAll(PDO::FETCH_ASSOC);
	$text_ruangan = "Lantai 5 (Ruang Operasi)";
} elseif ($ruang == 'icu') {
	$query = $db->query("SELECT p.tanggalicu as tanggalmasuk,p.tanggalkeluar,p.diagnosaa,p.diagnosam,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,rp.* FROM `icu` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status='1'");
	$data = $query->fetchAll(PDO::FETCH_ASSOC);
	$text_ruangan = "Lantai 4 (ICU)";
} elseif ($ruang == 'nicu') {
	$query = $db->query("SELECT p.*,rp.*,p.kelas as 'kelas_pasien' FROM `nicu` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status='1'");
	$data = $query->fetchAll(PDO::FETCH_ASSOC);
	$text_ruangan = "Lantai 4 (NICU)";
} elseif ($ruang == 'igd') {
	$query = $db->query("SELECT p.tanggaligd as tanggalmasuk,p.tanggalkeluar,p.diagnosa_awal as diagnosam,p.diagnosa_akhir as diagnosaa,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,rp.*,p.kelas as 'kelas_pasien' FROM `igd` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status='1'");
	$data = $query->fetchAll(PDO::FETCH_ASSOC);
	$text_ruangan = "Lantai Ground (IGD)";
} else {
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

<body class="<?php echo $skin_default; ?>">
	<div class="wrapper">
		<?php
		include("header.php");
		include "menu_index.php";
		?>
		<div class="content-wrapper">
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
						<h3 class="box-title"><?php echo strtoupper($text_ruangan); ?> <small><?php echo $text; ?></small></h3>
						<!-- <a class="btn btn-success pull-right" href="export_ruangan.php?ruangan=<?php echo $ruang; ?>&filter=<?php echo $filter; ?>&tanggalAwal=<?php echo $awal; ?>&tanggalAkhir=<?php echo $akhir; ?>"><i class="fa fa-download"></i> Export to Excel</a> -->
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr class="info">
										<th>Tanggal Masuk</th>
										<th>Lama Rawat</th>
										<th>No. RM</th>
										<th>Nama</th>
										<th>Jenis Kelamin</th>
										<th>Alamat</th>
										<th>Kelurahan</th>
										<th>Kecamatan</th>
										<th>Domisili</th>
										<th>Jam masuk</th>
										<th>Pendidikan</th>
										<th>Pekerjaan</th>
										<th>Asal ruangan</th>
										<th>Umur pasien</th>
										<th>Umur suami</th>
										<th>Rujukan dari</th>
										<th>Tanggal daftar</th>
										<th>Cara Persalinan</th>
										<th>Kelas</th>
										<th>Jenis Operasi</th>
										<th>Tindakan</th>
										<th>Cara keluar</th>
										<th>Cara bayar</th>
										<th>DPJP</th>
										<th>Diagnosa Awal</th>
										<th>Diagnosa Akhir</th>
										<th>BB</th>
										<th>Afgar Score</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($data as $r2) {
										if (strlen($r2['tanggalmasuk']) == 10) {
											if ($ruang == 'lantai11') {
												$tgl_in = $r2['tanggalmasuk'] . " " . $r2['jamm'];
											} else {
												$masuk = explode("/", $r2['tanggalmasuk']);
												$tgl_in = $masuk[2] . "-" . $masuk[1] . "-" . $masuk[0] . " " . $r2['jamm'];
											}
										} else {
											$masuk = $r2['tanggalmasuk'];
											$tgl_in = $masuk;
										}
										$tgl_out = date('Y-m-d');
										$diff = date_diff(date_create($tgl_out), date_create($tgl_in));
										$hari = $diff->format('%d');
										$jam = $diff->format('%h');
										if (($hari == 0) && ($jam <= 24)) {
											$lama_rawat = "1 Hari";
										} else {
											$lama_rawat = $diff->format('%d Hari %h Jam %i Menit %s Detik');
										}
										$carap = isset($r2['carap']) ? $r2['carap'] : '-';
										$kelas_pasien = isset($r2['kelas_pasien']) ? $r2['kelas_pasien'] : '-';
										$jenis_operasi = isset($r2['operasi']) ? $r2['operasi'] : '-';
										$tindakan = isset($r2['tindakan']) ? $r2['tindakan'] : '';
										$bb = isset($r2['bb']) ? $r2['bb'] : '';
										$afgar = isset($r2['ascore']) ? $r2['ascore'] : '';
										echo "<tr>
										<td>" . $r2['tanggalmasuk'] . "</td>
										<td>" . $lama_rawat . "</td>
										<td>" . $r2['nomedrek'] . "</td>
										<td>" . $r2['nama'] . "</td>
										<td>" . $r2['kelamin'] . "</td>
										<td>" . $r2['alamat'] . "</td>
										<td>" . $r2['kelurahan'] . "</td>
										<td>" . $r2['kecamatan'] . "</td>
										<td>" . $r2['domisili'] . "</td>
										<td>" . $r2['jamm'] . "</td>
										<td>" . $r2['pendistri'] . "</td>
										<td>" . $r2['pistri'] . "</td>
										<td>" . $r2['asal'] . "</td>
										<td>" . $r2['umur'] . "</td>
										<td>" . $r2['usuami'] . "</td>
										<td>" . $r2['rujukan'] . "</td>
										<td>" . $r2['tanggaldaftar'] . "</td>
										<td>" . $carap . "</td>
										<td>" . $kelas_pasien . "</td>
										<td>" . $jenis_operasi . "</td>
										<td>" . $tindakan . "</td>
										<td>" . $r2['carakeluar'] . "</td>
										<td>" . $r2['jpasien'] . "</td>
										<td>" . $r2['dpjp'] . "</td>
										<td>" . $r2['diagnosam'] . "</td>
										<td>" . $r2['diagnosaa'] . "</td>
										<td>" . $bb . "</td>
										<td>" . $afgar . "</td>
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
		<?php include "footer.php"; ?>
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
		$(function() {
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