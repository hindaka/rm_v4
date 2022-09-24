<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$bulan = isset($_POST['bulan']) ? ($_POST['bulan']) : '';
$tahun = isset($_POST['tahun']) ? ($_POST['tahun']) : '';
$gabung = $tahun . "-" . $bulan . "%";
$combine = "%".$bulan."/".$tahun."%";
$ranap = $db->query("SELECT SUBSTRING(lr.`tgl_ranap`,1,10) AS tgl, COUNT(*) AS total FROM list_ranap lr INNER JOIN invoice_all ia ON(lr.`id_invoice_all`=ia.`id_invoice_all`) INNER JOIN registerpasien rp ON(ia.`id_register`=rp.`id_pasien`) WHERE YEAR(lr.`tgl_ranap`)='".$tahun."' AND MONTH(lr.`tgl_ranap`)='".$bulan."' AND rp.`covid19`='n' GROUP BY tgl");
$data_ranap = $ranap->fetchAll(PDO::FETCH_ASSOC);
$rajal = $db->query("SELECT CONCAT(SUBSTRING(rp.`tanggaldaftar`,7,4),SUBSTRING(rp.`tanggaldaftar`,4,2),SUBSTRING(rp.`tanggaldaftar`,1,2)) AS tgl,COUNT(*) AS total FROM klinik k INNER JOIN registerpasien rp ON(k.`id_register`=rp.`id_pasien`) WHERE rp.`tanggaldaftar` LIKE '".$combine."' AND rp.`covid19`='n' AND rp.`poli_biru`='n' GROUP BY tgl");
$data_rajal = $rajal->fetchAll(PDO::FETCH_ASSOC);
$igd = $db->query("SELECT CONCAT(SUBSTRING(rp.`tanggaldaftar`,7,4),SUBSTRING(rp.`tanggaldaftar`,4,2),SUBSTRING(rp.`tanggaldaftar`,1,2)) AS tgl,COUNT(*) AS total FROM igd i INNER JOIN registerpasien rp ON(i.`id_register`=rp.`id_pasien`) WHERE rp.`covid19`='n' AND rp.`tanggaldaftar` LIKE '".$combine."' GROUP BY tgl");
$data_igd = $igd->fetchAll(PDO::FETCH_ASSOC);
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

        <?php
        include "header.php";
        include "menu_index.php"; ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Rekap Data
                    <small>Pasien Non Covid</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rekap Data Pasien Non Covid</h3>
                        <span class="pull-right">
                            <!-- <a href="rekap_bayi_lahir.php?awal=<?php echo $awal_fix; ?>&akhir=<?php echo $akhir_fix; ?>" class="btn btn-success btn-sm"><i class="fa fa-send"></i> Export</a> -->
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h4>IGD NON COVID</h4>
                                <table id="igdNonCovid" class="table table-bordered">
                                    <thead>
                                        <tr class="info">
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($data_igd as $row) {
                                                echo '<tr>
                                                    <td>'.$row['tgl'].'</td>
                                                    <td>'.$row['total'].'</td>
                                                </tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                            <h4>RAJAL NON COVID</h4>
                                <table id="rajalNonCovid" class="table table-bordered">
                                    <thead>
                                        <tr class="warning">
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($data_rajal as $row) {
                                                echo '<tr>
                                                    <td>'.$row['tgl'].'</td>
                                                    <td>'.$row['total'].'</td>
                                                </tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                            <h4>RANAP NON COVID</h4>
                                <table id="ranapNonCovid" class="table table-bordered">
                                    <thead>
                                        <tr class="success">
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($data_ranap as $row) {
                                                echo '<tr>
                                                    <td>'.$row['tgl'].'</td>
                                                    <td>'.$row['total'].'</td>
                                                </tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    </form>
                </div><!-- /.box -->

            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        <!-- static footer -->
        <?php include "footer.php"; ?>
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
        $(function() {
            $("#example1").dataTable();
        });
    </script>

</body>

</html>