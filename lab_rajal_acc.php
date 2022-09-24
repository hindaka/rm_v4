<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$bulan = isset($_POST['bulan']) ? ($_POST['bulan']) : '';
$tahun = isset($_POST['tahun']) ? ($_POST['tahun']) : '';
$gabung = $tahun . "-" . $bulan . "%";

$lab = $db->query("SELECT UPPER(l.asal) asal,
COUNT(CASE WHEN rp.domisili='Dalam kota' THEN 1 END) AS 'dalam',
COUNT(CASE WHEN rp.domisili='Luar kota' THEN 1 END) AS 'luar'
FROM lab l INNER JOIN registerpasien rp ON(l.`id_register`=rp.`id_pasien`) WHERE l.tanggal LIKE '" . $gabung . "' AND l.`pasien`='rajal' AND (l.`status`='1' OR l.status='2') AND l.`ket`<>'batal' GROUP BY l.asal");
$lab_data = $lab->fetchAll(PDO::FETCH_ASSOC);
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
                    <small>Lab Rawat Jalan</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rekap Data Lab Rawat Jalan</h3>
                        <span class="pull-right">
                            <!-- <a href="rekap_bayi_lahir.php?awal=<?php echo $awal_fix; ?>&akhir=<?php echo $akhir_fix; ?>" class="btn btn-success btn-sm"><i class="fa fa-send"></i> Export</a> -->
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr class="info">
                                        <th rowspan="2" style="text-align:center;">POLIKLINIK</th>
                                        <th colspan="2" style="text-align:center;">DOMISILI</th>
                                    </tr>
                                    <tr class="info">
                                        <th style="text-align:center;">Dalam Kota</th>
                                        <th style="text-align:center;">Luar Kota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($lab_data as $l) {
                                            echo '<tr>
                                                <td>'.$l['asal'].'</td>
                                                <td>'.$l['dalam'].'</td>
                                                <td>'.$l['luar'].'</td>
                                            </tr>';
                                        }
                                     ?>
                                </tbody>
                            </table>
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