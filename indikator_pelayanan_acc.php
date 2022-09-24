<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$bed = isset($_GET['tt']) ? $_GET['tt'] : '';
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
$hari_bulan = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
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

//calculate lama rawat
$get_pasien_pulang = $db->query("SELECT lp.tgl_ranap,lp.tgl_pulang,rp.id_register,p.`nomedrek`,p.`nama`,rp.asal,rp.`diagnosa_akhir`,rp.cara_keluar FROM list_ranap lp INNER JOIN invoice_all ia ON(lp.`id_invoice_all`=ia.`id_invoice_all`) INNER JOIN registerpasien_pulang rp ON(ia.`id_register`=rp.`id_register`) INNER JOIN registerpasien p ON(rp.`id_register`=p.`id_pasien`) WHERE YEAR(lp.`tgl_pulang`)='" . $tahun . "' AND MONTH(lp.`tgl_pulang`)='" . $bulan . "'");
$data_all = $get_pasien_pulang->fetchAll(PDO::FETCH_ASSOC);
$groups = array();
foreach ($data_all as $row) {
    $key = $row['id_register'];
    if (!array_key_exists($key, $groups)) {
        $groups[$key]['tgl_ranap'] = $row['tgl_ranap'];
        $groups[$key]['tgl_pulang'] = $row['tgl_pulang'];
        $groups[$key]['nomedrek'] = $row['nomedrek'];
        $groups[$key]['nama'] = $row['nama'];
        $groups[$key]['asal'] = $row['asal'];
        $groups[$key]['cara_keluar'] = $row['cara_keluar'];
        $groups[$key]['diagnosa_akhir'] = $row['diagnosa_akhir'];
    }
}
//kalkulasi lama rawat
$countLD = 0;
$hariPerawatan = 0;
$pasien_plus_all = 0;
$pasien_plus_48 = 0;
$total_data = count($groups);
foreach ($groups as $key => $val) {
    $diff = date_diff(date_create($val['tgl_pulang']), date_create($val['tgl_ranap']));
    $hari = $diff->format('%d');
    $jam = $diff->format('%h');
    if (($hari == 0) && ($jam <= 24)) {
        $lama_rawat = "1";
        $countLD += 1;
        $hariPerawatan += 1;
    } else {
        $lama_rawat = $diff->format('%d');
        $countLD += $lama_rawat;
        $hariPerawatan += $lama_rawat + 1;
    }
    if ($val['cara_keluar'] == 'Meninggal') {
        $pasien_plus_all += 1;
        if ($jam >= 48) {
            $pasien_plus_48 += 1;
        }
    }
}
$bor = ($hariPerawatan / ($bed * $hari_bulan)) * 100;
$los = $hariPerawatan / $total_data;
$toi = (($bed * $hari_bulan) - $hariPerawatan) / $total_data;
$bto = $total_data / $bed;
$ndr = ($pasien_plus_48 / $total_data) * 100;
$gdr = ($pasien_plus_all / $total_data) * 100;
//standar ideal
$bor_bawah = 65;
$bor_atas = 85;
$los_bawah = 6;
$los_atas = 9;
$toi_bawah = 1;
$toi_atas = 3;
$bto_ideal = 30;
$ndr_ideal = 25;
$gdr_ideal = 45;
$nilai_efisien = 0;
//hitung ideal
if ($bor_bawah <= $bor && $bor_atas >= $bor) {
    $bor_text = "Ideal";
    $nilai_efisien += 1;
} else {
    $bor_text = "Belum Ideal";
}
if ($los_bawah <= $los && $los_atas >= $los) {
    $los_text = "Ideal";
    $nilai_efisien += 1;
} else {
    $los_text = "Belum Ideal";
}
if ($toi_bawah <= $bor && $toi_atas >= $bor) {
    $toi_text = "Ideal";
    $nilai_efisien += 1;
} else {
    $toi_text = "Belum Ideal";
}
if ($bto == $bto_ideal) {
    $bto_text = "Ideal";
    $nilai_efisien += 1;
} else {
    $bto_text = "Belum Ideal";
}
if ($nilai_efisien == 4) {
    $efisien_text = "EFISIEN";
} else {
    $efisien_text = "BELUM EFISIEN";
}
if ($ndr < $ndr_ideal) {
    $ndr_text = "Ideal";
} else {
    $ndr_text = "Belum Ideal";
}
if ($gdr < $gdr_ideal) {
    $gdr_text = "Ideal";
} else {
    $gdr_text = "Belum Ideal";
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
        include('header.php');
        include "menu_index.php";
        ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Indikator Pelayanan
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Indikator Pelayanan</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- general form elements -->
                <!-- left column -->
                <div class="box box-success">
                    <div class="box-header">
                        <i class="fa fa-list"></i>
                        <h3 class="box-title">Indikator Pelayanan Bulan <?php echo bulanIndo($bulan) . " Tahun " . $tahun; ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <fieldset>
                                    <legend><i class="fa fa-list"></i> Data Dasar</legend>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-condensed">
                                                    <tr>
                                                        <th class="bg-purple" width="50%">Jumlah Tempat Tidur</th>
                                                        <th><?php echo $bed; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-purple">Total Hari Perawatan</th>
                                                        <th><?php echo $hariPerawatan; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-purple">Jumlah Pasien Keluar</th>
                                                        <th><?php echo $total_data; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-purple">Total Lama dirawat</th>
                                                        <th><?php echo $countLD; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-purple">Jumlah Hari Bulan ini</th>
                                                        <th><?php echo $hari_bulan; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-purple">Pasien Meninggal > 48 jam</th>
                                                        <th><?php echo $pasien_plus_48; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-purple">Seluruh Pasien meninggal</th>
                                                        <th><?php echo $pasien_plus_all; ?></th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <fieldset>
                                    <legend>Hasil Perhitungan</legend>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-condensed">
                                                    <tr>
                                                        <th class="bg-green" width="25%">BOR</th>
                                                        <th><?php echo $bor; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-green">LOS</th>
                                                        <th><?php echo $los; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-green">TOI</th>
                                                        <th><?php echo $toi; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-green">BTO</th>
                                                        <th><?php echo $bto; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-green">-</th>
                                                        <th>-</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-green">NDR</th>
                                                        <th><?php echo $ndr; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-green">GDR</th>
                                                        <th><?php echo $gdr; ?></th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <fieldset>
                                    <legend>Indeks (<?php echo $efisien_text; ?>)</legend>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-condensed">
                                                    <tr>
                                                        <th class="bg-maroon" width="25%">BOR</th>
                                                        <th><?php echo $bor_text; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-maroon">LOS</th>
                                                        <th><?php echo $los_text; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-maroon">TOI</th>
                                                        <th><?php echo $toi_text; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-maroon">BTO</th>
                                                        <th><?php echo $bto_text; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-maroon">-</th>
                                                        <th>-</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-maroon">NDR</th>
                                                        <th><?php echo $ndr_text; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-maroon">GDR</th>
                                                        <th><?php echo $gdr_text; ?></th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>


                    </div><!-- /.box-body -->
                </div><!-- /.left column -->
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
    <script src="../plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- date-picker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

    <!-- iCheck 1.0.1 -->
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">

    </script>

</body>

</html>