<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$id_register = isset($_GET['reg']) ? $_GET['reg'] : '';
$asal = isset($_GET['asal']) ? $_GET['asal'] : '';

$get_reg = $db->query("SELECT k.*,r.nomedrek,r.nama,r.tanggallahir,r.nmdokter,dok.id_dokter FROM klinik k INNER JOIN registerpasien r ON(k.id_register=r.id_pasien) INNER JOIN nmdokter dok ON(dok.nama=r.nmdokter) WHERE r.id_pasien='".$id_register."'");
$data = $get_reg->fetch(PDO::FETCH_ASSOC);
$pemeriksaan_fisik = '<ul>
<li>Keadaan Umum : '.$data['keadaan_umum'].'</li>
<li>Tekanan Darah : '.$data['tensi'].' mmHg </li>
<li>Respirasi : '.$data['respirasi'].' x permenit</li>
<li>Suhu : '.$data['suhu'].' Celcius</li>
<li>Nadi : '.$data['nadi'].' x permenit</li>
</ul>';
$anamnesa=$data['kp'];
$id_dokter = $data['id_dokter'];
$nama_dokter = $data['nmdokter'];
$pemeriksaan_penunjang = "";
$terapi="";
$diagnosa_utama=$data['diagnosaa'];
$utama10="";
$diagnosa_tambahan=$data['dt'];
$tambahan10="";
$icd9="";
$tindakan_data="";
$tindakan_custom="";
$rencana_data;
$cara_keluar="";
$cara_pulang="";
$alasan_rujuk="";
$ranap="";
$id_klinik =$data['id_klinik'];
$get_pulang = $db->query("SELECT * FROM registerpasien_pulang WHERE id_register='".$id_register."'");
$pulang= $get_pulang->fetch(PDO::FETCH_ASSOC);
$tanggal_pulang = $pulang['tgl_pulang'];

$get_rujukan = $db->query("SELECT * FROM register_rujukan WHERE id_register='".$id_register."'");
$rujukan = $get_rujukan->fetch(PDO::FETCH_ASSOC);
$poli = "slug_kategori LIKE '%".$asal."%'";
$get_tindakan = $db->query("SELECT DISTINCT(nama) as nama FROM tarif WHERE ".$poli." AND aturan_tarif='PERWAL 2018' AND aktif='y' AND nama NOT LIKE '%Klinik dokter%' ");
$tindakan = $get_tindakan->fetchAll(PDO::FETCH_ASSOC);
$today = date('Y-m-d');
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
		<link href="../plugins/datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
		<!-- select2 -->
		<link href="../plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
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
      <div class="content-wrapper">
        <?php if (isset($_GET['status']) && ($_GET['status'] == "duplicate")) { ?><div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-ban"></i>Peringatan</h4>Pemeriksaan sudah terdaftar!!</center></div>
      <?php }else if (isset($_GET['status']) && ($_GET['status'] == "success_delete")) { ?><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-check"></i>Berhasil</h4>Pemeriksaan Berhasil dihapus!!</center></div>
    <?php }else if (isset($_GET['status']) && ($_GET['status'] == "fail_delete")) { ?><div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-ban"></i>Peringatan</h4>Pemeriksaan gagal dihapus!!</center></div>
      <?php }?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            RESUME PASIEN
            <small>RAWAT JALAN</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>RESUME PASIEN</li>
            <li class="active">RAWAT JALAN</li>
          </ol>
        </section>


         <!-- Main content -->
        <section class="content">
					<div class="alert alert-info">Field yang bertanda <span style="color:red">*</span> <b>WAJIB</b> diisi dengan <b>BAIK & BENAR</b>!</div>
            <div class="row">
							<div class="col-xs-12">
								<div class="box box-primary">
									<div class="box-header">
										<i class="fa fa-stethoscope"></i>
					  				<h3 class="box-title">FORM RESUME RAWAT JALAN</h3>
									</div>
									<div class="box-body">
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group form-inline">
												  <label for="">Klinik : </label>
												  <input type="text" name="poli" class="form-control" id="poli" value="<?php echo ucwords($asal); ?>" readonly>
													<input type="hidden" name="reg" id="reg" value="<?php echo $id_register; ?>">
													<input type="hidden" name="id_klinik" id="id_klinik" value="<?php echo $id_klinik; ?>">
													<input type="hidden" name="id_dokter" id="id_dokter" value="<?php echo $id_dokter; ?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12 col-md-6">
												<div class="form-group">
												  <label for="">Rujukan : <span style="color:red">*</span></label>
												  <input type="text" name="rujukan" autocomplete="off" class="form-control" id="rujukan" value="<?php echo $rujukan['asal_rujukan']; ?>" readonly>
												</div>
											</div>
											<div class="col-xs-12 col-md-6">
												<div class="form-group">
												  <label for="">Tanggal Rujukan : <span style="color:red">*</span></label>
												  <input type="text" name="rujukan" autocomplete="off" class="form-control" id="tanggal_rujukan" value="<?php echo $rujukan['tanggal_rujukan']; ?>" readonly>
												</div>
											</div>
											<div class="col-xs-12">
												<div class="form-group">
												  <label for="">Diagnosa Rujukan: <span style="color:red">*</span></label>
												  <input type="text" autocomplete="off" class="form-control" name="diagnosa_rujukan" id="diagnosa_rujukan" value="<?php echo $rujukan['diagnosa_rujukan']; ?>" readonly>
												</div>
											</div>
											<div class="col-xs-12 col-md-6">
												<div class="form-group">
												  <label for="">Dokter : <span style="color:red">*</span></label>
												  <input type="text" name="dokter" autocomplete="off" class="form-control" id="dokter" value="<?php echo $nama_dokter; ?>" readonly>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
												  <label for="">Anamnesa <span style="color:red">*</span></label>
												  <textarea name="anamnesa" id="anamnesa" required><?php echo $anamnesa; ?></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
												  <label for="">Pemeriksan Fisik <span style="color:red">*</span></label>
												  <textarea name="pemeriksaan_fisik" id="pemeriksaan_fisik" required><?php echo $pemeriksaan_fisik; ?></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
												  <label for="">Pemeriksan Penunjang <span style="color:red">*</span></label>
												  <textarea name="pemeriksaan_penunjang" id="pemeriksaan_penunjang" required><?php echo $pemeriksaan_penunjang; ?></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
												  <label for="">Terapi <span style="color:red">*</span></label>
												  <input type="text" name="terapi" id="terapi" class="form-control" value="<?php echo $terapi; ?>" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
												  <label for="">Diagnosa Utama : <span style="color:red">*</span></label>
													<textarea name="diagnosa_utama" id="diagnosa_utama" required><?php echo $diagnosa_utama; ?></textarea>
												</div>
											</div>
											<div class="col-xs-6">
												<div class="form-group">
												  <label for="">ICD 10 :</label>
												  <textarea name="utama10" id="utama10"><?php echo $utama10; ?></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
												  <label for="">Diagnosa Tambahan : <span style="color:red">*</span></label>
													<textarea name="diagnosa_tambahan" id="diagnosa_tambahan" required><?php echo $diagnosa_tambahan; ?></textarea>
												</div>
											</div>
											<div class="col-xs-6">
												<div class="form-group">
												  <label for="">ICD 10 :</label>
												  <textarea name="tambahan10" id="tambahan10"><?php echo $tambahan10; ?></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
												  <label for="">Tindakan : <span style="color:red">*</span></label>
													<input type="hidden" name="tindakan_list" id="tindakan_list" value="<?php echo $tindakan_data; ?>">
													<select name="tindakan" id="tindakan" class="form-control tindakan_list" multiple="multiple" style="width:100%;">
														<option value=""></option>
														<?php
															foreach ($tindakan as $t) {
																echo '<option value="'.$t['nama'].'">'.$t['nama'].'</option>';
															}
														 ?>
													</select>
													<label for="">Input dibawah ini yang tidak ada dalam list tindakan : <span style="color:red">**</span></label>
													<textarea name="tindakan_custom" id="tindakan_custom" class="form-control"><?php echo $tindakan_custom; ?></textarea>
												</div>
											</div>
											<div class="col-xs-6">
												<div class="form-group">
												  <label for="">ICD 9 CM :</label>
												  <textarea name="icd9" id="icd9"><?php echo $icd9; ?></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
												  <label for="">Rencana Tindak Lanjut <span style="color:red">*</span></label>
													<input type="hidden" name="rencana_list" id="rencana_list" value="<?php echo $rencana_data; ?>">
												  <select name="rencana" id="rencana" class="form-control rencana" multiple="multiple" style="width:100%;">
												  	<option value=""></option>
														<option value="konsultasi dokter spesialisas penyakit dalam">Konsultasi Dokter Spesialis Penyakit Dalam</option>
														<option value="konsultasi dokter spesialisas obgyn">Konsultasi Dokter Spesialis Obgyn</option>
														<option value="konsultasi dokter spesialisas anak">Konsultasi Dokter Spesialis Anak</option>
														<option value="konsultasi dokter spesialisas bedah">Konsultasi Dokter Spesialis Bedah</option>
														<option value="konsultasi dokter spesialisas tht">Konsultasi Dokter Spesialis Tht</option>
														<option value="konsultasi dokter spesialisas neurologi">Konsultasi Dokter Spesialis Neurologi</option>
														<option value="konsultasi dokter spesialisas anastesi">Konsultasi Dokter Spesialis Anastesi</option>
														<option value="kuretase elektif">Kuretase Elektif</option>
														<option value="kuretase cyto">Kuretase Cyto</option>
														<option value="operasi elektif">Operasi Elektif</option>
														<option value="operasi cyto">Operasi Cyto</option>
														<option value="terminasi">Terminasi</option>
												  </select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
												  <label for="">Tanggal Pulang <span style="color:red">*</span></label>
												  <input type="text" class="form-control" id="tgl_pulang" name="tgl_pulang" value="<?php echo $tanggal_pulang; ?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
												  <label for="">Cara Keluar <span style="color:red">*</span></label>
												  <select name="cara_keluar" id="cara_keluar" class="form-control" required>
														<?php
																echo '<option value="">--- Pilih Cara Keluar ---</option>
																<option value="pulang">Pulang</option>
																<option value="ranap">Rawat Inap</option>';
														?>
												  </select>
												</div>
											</div>
											<div class="col-xs-12" id="carpul">
												<div class="form-group">
												  <label for="">Cara Pulang <span style="color:red">*</span></label><br>
													<?php
															echo '<input type="radio" name="cara_pulang" id="cara_pulang_p" value="pulang">Pulang <br>
															<input type="radio" name="cara_pulang" id="cara_pulang_r" value="rujuk">Rujuk, alasan
															<input type="text" name="alasan_rujuk" id="alasan_rujuk" class="form-control" value="'.$alasan_rujuk.'"> <br>
															<input type="radio" name="cara_pulang" id="cara_pulang_rb" value="rujuk balik">Rujuk Balik';
													?>
												</div>
											</div>
											<div class="col-xs-12" id="ranap">
												<div class="form-group">
												  <label for="">Ruang Rawat Inap : <span style="color:red">*</span></label><br>
													<?php
															echo '<input type="radio" name="ranap" id="ranap_bersalin" value="bersalin"> Bersalin&nbsp;&nbsp;&nbsp;
															<input type="radio" name="ranap" id="ranap_igd" value="igd"> IGD&nbsp;&nbsp;&nbsp;
															<input type="radio" name="ranap" id="ranap_perawatan" value="perawatan"> Perawatan&nbsp;&nbsp;&nbsp;
															<input type="radio" name="ranap" id="ranap_anak" value="anak"> Anak&nbsp;&nbsp;&nbsp;
															<input type="radio" name="ranap" id="ranap_peri" value="perinatologi"> Perinatologi&nbsp;&nbsp;&nbsp;';
													?>
												</div>
											</div>
										</div>
									</div>
									<div class="box-footer">
										<button id="submitBtn" class="btn btn-md btn-success"><i class="fa fa-save"></i> Simpan & Cetak</button>
									</div>
								</div>
							</div>
						</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!-- static footer -->
	  <?php include "footer.php"; ?><!-- /.static footer -->
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<!-- date-picker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
		<script src="../plugins/datetimepicker/js/moment-with-locales.js" type="text/javascript"></script>
		<script src="../plugins/datetimepicker/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
	<!-- iCheck 1.0.1 -->
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
		<script src="../plugins/ckeditor5/ckeditor5-build-classic/ckeditor.js"></script>
		<script src="../plugins/select2/select2.full.min.js"></script>
		<script src="../plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				let anamnesa;
				let pemeriksaan_fisik;
				let pemeriksaan_penunjang;
				let diagnosa_utama,utama10;
				let diagnosa_tambahan,tambahan10;
				let icd9;
				var tindakan_list = $('#tindakan_list').val();
				var rencana_list = $('#rencana_list').val();
				var cara_keluar = $('#cara_keluar').val();
				if(cara_keluar=='pulang'){
					$('#carpul').show();
					$('#ranap').hide();
				}else if(cara_keluar=='ranap'){
					$('#carpul').hide();
					$('#ranap').show();
				}else{
					$('#carpul').hide();
					$('#ranap').hide();
				}
				if(tindakan_list!=''){
					tindakan_list = tindakan_list.split(",");
					$(".tindakan_list").val(tindakan_list).trigger('change');
				}
				if(rencana_list!=''){
					rencana_list = rencana_list.split(",");
					$(".rencana").val(rencana_list).trigger('change');
				}
				function swal_alert(judul,text_notif,ikon,tombol){
					 var block = swal({
						title: judul,
						text: text_notif,
						icon: ikon,
						button: tombol,
					});
					return block;
				}
				function change_page(id,reg,url){
					window.location.href=url+".php?id="+id+"&reg="+reg;
				}
				$(".tindakan_list").select2({
					placeholder : 'Pilih Tindakan',
					allowClear : true,
					width : 'resolve'
				});
				$(".rencana").select2({
					placeholder : 'Pilih Rencana Tindakan',
					allowClear : true,
					width : 'resolve'
				});
				ClassicEditor.create( document.querySelector( '#anamnesa' ), {
						toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
					}).then( editor1 => {
						window.editor = editor1;
						anamnesa = editor1;
					}).catch( err => {
						console.error( err.stack );
					});
				ClassicEditor.create( document.querySelector( '#pemeriksaan_fisik' ), {
						toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
					}).then( editor2 => {
						window.editor = editor2;
						pemeriksaan_fisik = editor2;
					}).catch( err => {
						console.error( err.stack );
					});
				ClassicEditor.create( document.querySelector( '#pemeriksaan_penunjang' ), {
						toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
					}).then( editor3 => {
						window.editor = editor3;
						pemeriksaan_penunjang = editor3;
					}).catch( err => {
						console.error( err.stack );
					});
				ClassicEditor.create( document.querySelector( '#diagnosa_utama' ), {
						toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
					}).then( editor4 => {
						window.editor = editor4;
						diagnosa_utama = editor4;
					}).catch( err => {
						console.error( err.stack );
					});
				ClassicEditor.create( document.querySelector( '#utama10' ), {
						toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
					}).then( editor5 => {
						window.editor = editor5;
						utama10 = editor5;
					}).catch( err => {
						console.error( err.stack );
					});
				ClassicEditor.create( document.querySelector( '#diagnosa_tambahan' ), {
						toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
					}).then( editor6 => {
						window.editor = editor6;
						diagnosa_tambahan = editor6;
					}).catch( err => {
						console.error( err.stack );
					});
				ClassicEditor.create( document.querySelector( '#tambahan10' ), {
						toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
					}).then( editor7 => {
						window.editor = editor7;
						tambahan10 = editor7;
					}).catch( err => {
						console.error( err.stack );
					});
				ClassicEditor.create( document.querySelector( '#icd9' ), {
						toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
					}).then( editor8 => {
						window.editor = editor8;
						icd9 = editor8;
					}).catch( err => {
						console.error( err.stack );
					});
				$("#cara_keluar").on('change',function(e){
					e.preventDefault();
					var caker = this.value;
					var block_carpul = $('#carpul');
					var block_ranap = $('#ranap');
					if(caker=='pulang'){
						block_carpul.show();
						$('#cara_pulang_p').prop('required',true);
						$('#cara_pulang_r').prop('required',true);
						$('#cara_pulang_rb').prop('required',true);
						block_ranap.hide();
						$('#ranap_bersalin').prop('required',false);
						$('#ranap_perawatan').prop('required',false);
						$('#ranap_anak').prop('required',false);
						$('#ranap_peri').prop('required',false);
					}else if(caker=='ranap'){
						block_carpul.hide();
						$('#cara_pulang_p').prop('required',false);
						$('#cara_pulang_r').prop('required',false);
						$('#cara_pulang_rb').prop('required',false);
						block_ranap.show();
						$('#ranap_bersalin').prop('required',true);
						$('#ranap_perawatan').prop('required',true);
						$('#ranap_anak').prop('required',true);
						$('#ranap_peri').prop('required',true);
					}else{
						block_carpul.hide();
						$('#cara_pulang_p').prop('required',false);
						$('#cara_pulang_r').prop('required',false);
						$('#cara_pulang_rb').prop('required',false);
						block_ranap.hide();
						$('#ranap_bersalin').prop('required',false);
						$('#ranap_perawatan').prop('required',false);
						$('#ranap_anak').prop('required',false);
						$('#ranap_peri').prop('required',false);
					}
				});
		    $("#submitBtn").click(function (event) {
		        event.preventDefault();
						var fd = new FormData();
						var poli = $('#poli').val();
						var id_periksa = $('#id_klinik').val();
						var id_register = $('#reg').val();
						var id_dokter = $('#id_dokter').val();
						var poli = $('#poli').val();
						var anam = anamnesa.getData();
						var pfisik = pemeriksaan_fisik.getData();
						var pPenunjang = pemeriksaan_penunjang.getData();
						var terapi = $('#terapi').val();
						var dUtama = diagnosa_utama.getData();
						var dUtama10 = utama10.getData();
						var dTambahan = diagnosa_tambahan.getData();
						var dTambahan10 = tambahan10.getData();
						var tindakan = $('#tindakan').val();
						var tindakanctm = $('#tindakan_custom').val();
						var tindakan9 = icd9.getData();
						var rencana = $('#rencana').val();
						var cara_keluar = $('#cara_keluar').val();
						var tgl_pulang = $('#tgl_pulang').val();
						if(cara_keluar=='pulang'){
							var pl = $('input[name="cara_pulang"]:checked').val();
							var alasan_rujuk = $('#alasan_rujuk').val();
							fd.append('cara_pulang',pl);
							fd.append('alasan_rujuk',alasan_rujuk);
						}else if(cara_keluar=='ranap'){
							var rp = $('input[name="ranap"]:checked').val();
							fd.append('ranap',rp);
						}
						fd.append('poli',poli);
						fd.append('id_dokter',id_dokter);
						fd.append('id_periksa',id_periksa);
						fd.append('reg',id_register);
						fd.append('poli',poli);
						fd.append('anamnesa',anam);
						fd.append('pemeriksaan_fisik',pfisik);
						fd.append('pemeriksaan_penunjang',pPenunjang);
						fd.append('terapi',terapi);
						fd.append('diagnosa_utama',dUtama);
						fd.append('utama10',dUtama10);
						fd.append('diagnosa_tambahan',dTambahan);
						fd.append('tambahan10',dTambahan10);
						fd.append('tindakan',tindakan);
						fd.append('tindakan_custom',tindakanctm);
						fd.append('tindakan9',tindakan9);
						fd.append('rencana',rencana);
						fd.append('cara_keluar',cara_keluar);
						fd.append('tgl_pulang',tgl_pulang);
						//ajax
						$.ajax({
 								type: "POST",
 								url: "ajax_data/resume_rajal.php",
 								data: fd,
 								contentType: false,
 								cache: false,
 								processData:false,
 								success: function (respon) {
									console.log(respon);
 									res = JSON.parse(respon);
									swal_alert(res.title,res.text,res.status,'Tutup')
									.then((value)=>{
										change_page(id_periksa,id_register,'cetak_resume_pasien_rajal');
									});
 								},
 								error: function (e) {
 										console.log("ERROR : ", e.responseText);
 								}
 						});
				 });
				 $('#tgl_pulang').datetimepicker({
	 				format: 'YYYY-MM-DD HH:mm:ss'
	 			});
			});
		</script>
  </body>
</html>
