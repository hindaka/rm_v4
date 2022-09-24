<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$ruang = isset($_GET['ruangan']) ? $_GET['ruangan'] : '';
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
function bulanIndo($bulan)
{
    switch ($bulan) {
        case '01':
            $month = "Januari";
            break;
        case '02':
            $month = "Februari";
            break;
        case '03':
            $month = "Maret";
            break;
        case '04':
            $month = "April";
            break;
        case '05':
            $month = "Mei";
            break;
        case '06':
            $month = "Juni";
            break;
        case '07':
            $month = "Juli";
            break;
        case '08':
            $month = "Agustus";
            break;
        case '09':
            $month = "September";
            break;
        case '10':
            $month = "Oktober";
            break;
        case '11':
            $month = "November";
            break;
        case '12':
            $month = "Desember";
            break;
        default:
            $month = "unknown";
            break;
    }

    return $month;
}
//filter berdasarkan tanggal masuk
if ($ruang == 'lantai12') {
    $query = $db->query("SELECT n4.tanggalmasuk,n4.tanggalkeluar,n4.diagnosaa,n4.diagnosam,n4.jamp,n4.jamm,n4.dpjp,n4.asal,n4.carakeluar,n4.id_register,n4.carap,n4.kelas as kelas_pasien,rp.* FROM lantai12 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='2' AND YEAR(n4.tanggalkeluar)='" . $tahun . "' AND MONTH(n4.tanggalkeluar)='" . $bulan . "'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $text_ruangan = "Rawat Inap Presiden Suite, Junior Suite, VIP (Lantai 12)";
} elseif ($ruang == 'lantai11') {
    $query = $db->query("SELECT p.tanggalmasuk,p.tanggalkeluar,p.diagnosaa,p.diagnosam,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,rp.*,p.kelas as 'kelas_pasien' FROM `lantai11` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status='2' AND YEAR(p.tanggalkeluar)='" . $tahun . "' AND MONTH(p.tanggalkeluar)='" . $bulan . "'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $text_ruangan = "Lantai 11 (Ruang IPD/BEDAH)";
} elseif ($ruang == 'lantai8') {
    $query = $db->query("SELECT n4.tanggalmasuk,n4.tanggalkeluar,n4.diagnosaa,n4.diagnosam,n4.jamp,n4.jamm,n4.dpjp,n4.asal,n4.carakeluar,n4.id_register,n4.carap,n4.kelas as kelas_pasien,rp.* FROM lantai8 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='2' AND YEAR(n4.tanggalkeluar)='" . $tahun . "' AND MONTH(n4.tanggalkeluar)='" . $bulan . "'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $text_ruangan = "Lantai 8 (Ranap Isolasi)";
} elseif ($ruang == 'nifas4') {
    $query = $db->query("SELECT n4.tanggalmasuk,n4.tanggalkeluar,n4.diagnosaa,n4.diagnosam,n4.jamp,n4.jamm,n4.dpjp,n4.asal,n4.carakeluar,n4.id_register,n4.carap,n4.kelas as kelas_pasien,rp.* FROM nifas4 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='2' AND YEAR(n4.tanggalkeluar)='" . $tahun . "' AND MONTH(n4.tanggalkeluar)='" . $bulan . "'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $text_ruangan = "Lantai 10 (Ranap Ibu)";
} elseif ($ruang == 'anak') {
    $query = $db->query("SELECT a.*,a.kelas as kelas_anak,rp.* FROM anak a LEFT JOIN registerpasien rp ON(a.id_register=rp.id_pasien) WHERE a.status='2' AND YEAR(a.tanggalkeluar)='" . $tahun . "' AND MONTH(a.tanggalkeluar)='" . $bulan . "'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $text_ruangan = "Lantai 9 (Ranap Anak)";
} elseif ($ruang == 'lantai8') {
    $query = $db->query("SELECT p.*,rp.*,p.kelas as 'kelas_pasien' FROM `lantai8` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status='2' AND YEAR(n4.tanggalkeluar)='" . $tahun . "' AND MONTH(n4.tanggalkeluar)='" . $bulan . "'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $text = "Lantai 8 (Ranap)";
} elseif ($ruang == 'vk') {
    $query = $db->query("SELECT p.tanggalmasuk,p.tanggalkeluar,p.diagnosaa,p.diagnosam,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,rp.*,p.kelas as 'kelas_pasien' FROM `vk` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status='2' AND YEAR(n4.tanggalkeluar)='" . $tahun . "' AND MONTH(n4.tanggalkeluar)='" . $bulan . "'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $text_ruangan = "Lantai 7 (Ruang Bersalin)";
} elseif ($ruang == 'peri') {
    $query = $db->query("SELECT p.*,rp.*,p.kelas as 'kelas_peri' FROM `peri` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND p.tanggalmasuk BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $text_ruangan = "Lantai 7 (Perinatologi)";
} elseif ($ruang == 'ok') {
    $query = $db->query("SELECT p.tanggalok as tanggalmasuk,p.tanggalkeluar,p.diagnosaa,p.diagnosam,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,p.operasi,p.tindakan,rp.* FROM `ok` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status='2'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $text_ruangan = "Lantai 5 (Ruang Operasi)";
} elseif ($ruang == 'icu') {
    $query = $db->query("SELECT p.tanggalicu as tanggalmasuk,p.tanggalkeluar,p.diagnosaa,p.diagnosam,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,rp.* FROM `icu` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status='2'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $text_ruangan = "Lantai 4 (ICU)";
} elseif ($ruang == 'nicu') {
    $query = $db->query("SELECT p.*,rp.*,p.kelas as 'kelas_pasien' FROM `nicu` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status='2'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $text_ruangan = "Lantai 4 (NICU)";
} elseif ($ruang == 'igd') {
    $query = $db->query("SELECT p.tanggaligd as tanggalmasuk,p.tanggalkeluar,p.diagnosa_awal as diagnosam,p.diagnosa_akhir as diagnosaa,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,rp.*,p.kelas as 'kelas_pasien' FROM `igd` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status='2'");
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
                    Perhitungan Lama Rawat Pasien di ruangan
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Perhitungan Lama Rawat Pasien di ruangan</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- general form elements -->
                <!-- left column -->
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-user"></i>
                        <h3 class="box-title"><?php echo strtoupper($text_ruangan); ?><small> Perhitungan untuk bulan <?php echo bulanIndo($bulan)." ".$tahun; ?></small></h3>
                        <!-- <a class="btn btn-success pull-right" href="export_ruangan.php?ruangan=<?php echo $ruang; ?>&filter=<?php echo $filter; ?>&tanggalAwal=<?php echo $awal; ?>&tanggalAkhir=<?php echo $akhir; ?>"><i class="fa fa-download"></i> Export to Excel</a> -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="bg-blue">
                                        <th>#ID Kunjungan</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Lama Rawat</th>
                                        <th>No. RM</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $groups = array();
                                    //grouping by id_register
                                    foreach ($data as $r2) {
                                        $key = $r2['id_register'];
                                        if (array_key_exists($key, $groups)) {
                                            $groups[$key]['tanggalkeluar'] = $r2['tanggalkeluar'];
                                        } else {
                                            $groups[$key]['id_register'] = $r2['id_register'];
                                            $groups[$key]['tanggalmasuk'] = $r2['tanggalmasuk'];
                                            $groups[$key]['jamm'] = $r2['jamm'];
                                            $groups[$key]['tanggalkeluar'] = $r2['tanggalkeluar'];
                                            $groups[$key]['nomedrek'] = $r2['nomedrek'];
                                            $groups[$key]['nama_pasien'] = $r2['nama'];
                                            $groups[$key]['kelamin'] = $r2['kelamin'];
                                        }
                                    }
                                    $countLD = 0;
                                    foreach ($groups as $key => $val) {
                                        if (strlen($val['tanggalmasuk']) == 10) {
                                            if ($ruang == 'lantai11') {
                                                $tgl_in = $val['tanggalmasuk'] . " " . $val['jamm'];
                                            } else {
                                                $masuk = explode("/", $val['tanggalmasuk']);
                                                $tgl_in = $masuk[2] . "-" . $masuk[1] . "-" . $masuk[0] . " " . $val['jamm'];
                                            }
                                        } else {
                                            $masuk = $val['tanggalmasuk'];
                                            $tgl_in = $masuk;
                                        }
                                        $tgl_out = $val['tanggalkeluar'];
                                        $diff = date_diff(date_create($tgl_out), date_create($tgl_in));
                                        $hari = $diff->format('%d');
                                        $jam = $diff->format('%h');
                                        if (($hari == 0) && ($jam <= 24)) {
                                            $lama_rawat = "1 Hari";
                                            $countLD +=1;
                                        } else {
                                            $lama_rawat = $diff->format('%d Hari');
                                            $num = $diff->format('%d');
                                            $countLD +=$num;
                                        }

                                        echo "<tr>
                                        <td>" . $val['id_register'] . "</td>
                                            <td>" . $val['tanggalmasuk'] . "</td>
                                            <td>" . $tgl_out . "</td>
                                        	<td>" . $lama_rawat . "</td>
                                        	<td>" . $val['nomedrek'] . "</td>
                                            <td>" . $val['nama_pasien'] . "</td>
                                            <td>" . $val['kelamin'] . "</td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-blue" style="font-weight:bold;">
                                        <td colspan="3">Total</td>
                                        <td><?php echo $countLD; ?> Hari</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
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