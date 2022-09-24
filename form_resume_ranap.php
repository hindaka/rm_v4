<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$id_register = isset($_GET['reg']) ? $_GET['reg'] : '';

$get_reg = $db->query("SELECT * FROM registerpasien WHERE id_pasien='".$id_register."'");
$identitas = $get_reg->fetch(PDO::FETCH_ASSOC);
$get_pulang = $db->query("SELECT * FROM registerpasien_pulang WHERE id_register='".$id_register."'");
$pulang = $get_pulang->fetch(PDO::FETCH_ASSOC);
$get_dokter = $db->query("SELECT * FROM nmdokter WHERE nama NOT IN('Perawat','Bidan','-')");
$data_dokter = $get_dokter->fetchAll(PDO::FETCH_ASSOC);
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
		<!-- select2 -->
		<link href="../plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="../plugins/datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
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
            Dokumen Resume Pasien Keluar
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Dokumen</li>
            <li class="active">Resume Pasien Keluar</li>
          </ol>
        </section>


         <!-- Main content -->
        <section class="content">
         <div class="row">
         	<div class="col-md-12">
         	 <div class="box box-primary">
         	 	<div class="box-header">
         	 		<h4>Form Resume Pasien Keluar</h4>
         	 	</div>
						<form class="" action="resume_ranap_acc.php" method="post">
							<input type="hidden" name="reg" value="<?php echo $id_register; ?>">
						<div class="box-body">
							<div class="row form-inline">
								<div class="col-md-6">
									<div class="form-group">
									  <label for="">Tanggal/Jam Masuk : <?php echo $identitas['tanggaldaftar']; ?> / <?php echo $identitas['jamdatang']; ?></label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									  <label for="">Tanggal/Jam Keluar : <span style="color:red">*</span></label>
									  <input type="text" name="tanggal_keluar" class="form-control" id="tanggal_keluar" value="<?php echo $pulang['tgl_pulang'] ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">Ruang Rawat Terakhir :  <span style="color:red">*</span></label>
									  <input type="text" name="rawat_terakhir" class="form-control" id="rawat_terakhir" placeholder="Masukan Ruang Perawatan Terakhir" value="<?php echo strtoupper($pulang['asal']); ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">INDIKASI RAWAT INAP : <span style="color:red">*</span></label>
									  <textarea name="indikasi_ranap" id="indikasi_ranap"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">RINGKASAN RIWAYAT PENYAKIT : <span style="color:red">*</span></label>
									  <textarea name="ringkasan_penyakit" id="ringkasan_penyakit"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">PEMERIKSAAN FISIK : <span style="color:red">*</span></label>
									  <textarea name="pemeriksaan_fisik" id="pemeriksaan_fisik"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">PEMERIKSAAN PENUNJANG : <span style="color:red">*</span></label>
									  <textarea name="pemeriksaan_penunjang" id="pemeriksaan_penunjang"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">TERAPI/PENGOBATAN SELAMA DI RUMAH SAKIT :</label>
									  <textarea name="terapi_obat" id="terapi_obat"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">REAKSI OBAT :</label>
										<?php
											echo '<input type="radio" name="reaksi_obat" value="ya" id="reaksi_ya"> Ya &nbsp;&nbsp;
												<input type="radio" name="reaksi_obat" value="tidak" id="reaksi_tidak"> Tidak';
										?>
									</div>
								</div>
								<div class="col-md-12">Bila Ya :
										<span class="pull-right">
											<button type="button" class="btn-sm" id="removeRow"><i class="fa fa-minus"></i></button>
											<button type="button" class="btn-sm" id="addRow"><i class="fa fa-plus"></i></button>
										</span><br>
										<table id="terapi_obat_table" class="table table-bordered" width="100%">
											<thead>
												<tr class="info">
													<th>No</th>
													<th>NAMA OBAT</th>
													<th>MANIFESTASI KLINIKS</th>
													<th>KETERANGAN</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">DIET :</label>
									  <textarea name="diet" id="diet"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">HASIL KONSULTASI :</label>
									  <textarea name="hasil_konsul" id="hasil_konsul"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-md-6 col-xs-12">
									<div class="form-group">
									  <label for="">DIAGNOSA UTAMA : <span style="color:red">*</span></label>
									  <textarea name="diagnosa_utama" id="diagnosa_utama"><?php echo $pulang['diagnosa_akhir']; ?></textarea>
									</div>
								</div>
								<div class="col-md-6 col-md-6 col-xs-12">
									<div class="form-group">
									  <label for="">ICD 10 :</label>
									  <textarea name="icd10_utama" id="icd10_utama"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-md-6 col-xs-12">
									<div class="form-group">
									  <label for="">DIAGNOSA TAMBAHAN : <span style="color:red">*</span></label>
									  <textarea name="diagnosa_tambahan" id="diagnosa_tambahan"></textarea>
									</div>
								</div>
								<div class="col-md-6 col-md-6 col-xs-12">
									<div class="form-group">
									  <label for="">ICD 10 :</label>
									  <textarea name="icd10_tambahan" id="icd10_tambahan"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-md-6 col-xs-12">
									<div class="form-group">
										<label for="">TINDAKAN / PROSEDUR / OPERASI : <span style="color:red">*</span></label>
										<textarea name="tindakan" id="tindakan"></textarea>
									</div>
								</div>
								<div class="col-md-6 col-md-6 col-xs-12">
									<div class="form-group">
										<label for="">ICD 9 CM :</label>
										<textarea name="icd9" id="icd9"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">INTRUKSI PERAWATAN LANJUTAN / EDUKASI :</label>
									  <textarea name="edukasi" id="edukasi"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">CARA PULANG :</label>
											<?php
											echo '<input type="radio" name="cara_pulang" value="izin dokter" required> Izin Dokter &nbsp;&nbsp;
											<input type="radio" name="cara_pulang" value="pindah rs" required> Pindah RS &nbsp;&nbsp;
											<input type="radio" name="cara_pulang" value="permintaan sendiri" required> Permintaan Sendiri &nbsp;&nbsp;
											<input type="radio" name="cara_pulang" value="melarikan diri" required> Melarikan Diri &nbsp;&nbsp;';

											?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">KONDISI SAAT PULANG :</label>
											<?php
													echo '<input type="radio" name="kondisi" value="sembuh" required> Sembuh &nbsp;&nbsp;
													<input type="radio" name="kondisi" value="perbaikan" required> Perbaikan &nbsp;&nbsp;
													<input type="radio" name="kondisi" value="tidak sembuh" required> Tidak Sembuh &nbsp;&nbsp;
													<input type="radio" name="kondisi" value="meninggal < 48 jam" required> Meninggal < 48 jam &nbsp;&nbsp;
													<input type="radio" name="kondisi" value="meninggal > 48 jam" required> Meninggal > 48 jam &nbsp;&nbsp;';
											?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">TERAPI PULANG :</label>
											<span class="pull-right">
												<button type="button" class="btn-sm" id="removePulang"><i class="fa fa-minus"></i></button>
												<button type="button" class="btn-sm" id="addPulang"><i class="fa fa-plus"></i></button>
											</span><br>
											<table id="terapi_pulang" class="table table-bordered" width="100%">
												<thead>
													<tr class="info">
														<th>No</th>
														<th>NAMA OBAT</th>
														<th>JUMLAH</th>
														<th>DOSIS</th>
														<th>FREKUENSI</th>
														<th>CARA PEMBERIAN</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									  <label for="">KONTROL KE : <span style="color:red">*</span></label>
									  <input type="text" class="form-control" name="kontrol" id="kontrol">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									  <label for="">TANGGAL KONTROL : <span style="color:red">*</span></label>
									  <input type="text" class="form-control" name="tanggal_kontrol" id="tanggal_kontrol">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">Dokter Penanggungjawab <span style="color:red">*</span></label>
									  <select name="dpjp" id="dpjp" class="form-control selectDokter" required>
											<option value=""></option>
											<?php
												foreach ($data_dokter as $dokter) {
													echo '<option value="'.$dokter['id_dokter'].'">'.$dokter['nama'].'</option>';
												}
											?>
									  </select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="">PROGNOSIS *) :</label>
								</div>
								<div class="col-md-9">
									<div class="form-group">
									  <label for="">Ad Vitam : </label>
										<?php
												echo '<input type="radio" name="prognosis_v" value="ad bonam"> ad bonam &nbsp;&nbsp;
												<input type="radio" name="prognosis_v" value="ad malam"> ad malam &nbsp;&nbsp;
												<input type="radio" name="prognosis_v" value="dubia ad bonam"> dubia ad bonam &nbsp;&nbsp;
												<input type="radio" name="prognosis_v" value="dubia ad malam"> dubia ad malam &nbsp;&nbsp;';
										?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									&nbsp;
								</div>
								<div class="col-md-9">
									<div class="form-group">
									  <label for="">Ad Functionam :</label>
										<?php
												echo '<input type="radio" name="prognosis_f" value="ad bonam"> ad bonam &nbsp;&nbsp;
												<input type="radio" name="prognosis_f" value="ad malam"> ad malam &nbsp;&nbsp;
												<input type="radio" name="prognosis_f" value="dubia ad bonam"> dubia ad bonam &nbsp;&nbsp;
												<input type="radio" name="prognosis_f" value="dubia ad malam"> dubia ad malam &nbsp;&nbsp;';
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<div class="row">
								<div class="col-xs-12">
									<button type="submit" class="btn btn-md btn-success pull-right">SIMPAN & CETAK</button>
								</div>
							</div>
						</div>
					</div>
					</form>
         	</div>
         </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!-- static footer -->
	  <?php include "footer.php"; ?><!-- /.static footer -->
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
		<!-- <script src="../plugins/tags_plugin/jqueryui.js"></script> -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<!-- date-picker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
		<script src="../plugins/datetimepicker/js/moment-with-locales.js" type="text/javascript"></script>
		<script src="../plugins/datetimepicker/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
	<!-- select2 -->
    <script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
	<!-- iCheck 1.0.1 -->
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../plugins/fastclick/fastclick.min.js'></script>
		<!-- signature pad -->
		<!-- <script src="../plugins/signature_pad-master/docs/js/signature_pad.umd.js"></script>
		<script src="../plugins/signature_pad-master/docs/js/custom_sign.js"></script> -->
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
		<!-- <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
		<script src="../plugins/ckeditor5/ckeditor5-build-classic/ckeditor.js"></script>
		<script>
			ClassicEditor.create( document.querySelector( '#indikasi_ranap' ), {
					toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
				}).then( editor => {
					window.editor = editor;
				}).catch( err => {
					console.error( err.stack );
				});
			ClassicEditor.create( document.querySelector( '#ringkasan_penyakit' ), {
					toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
				}).then( editor => {
					window.editor = editor;
				}).catch( err => {
					console.error( err.stack );
				});
			ClassicEditor.create( document.querySelector( '#pemeriksaan_fisik' ), {
					toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
				}).then( editor => {
					window.editor = editor;
				}).catch( err => {
					console.error( err.stack );
				});
			ClassicEditor.create( document.querySelector( '#pemeriksaan_penunjang' ), {
					toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
				}).then( editor => {
					window.editor = editor;
				}).catch( err => {
					console.error( err.stack );
				});
			ClassicEditor.create( document.querySelector( '#terapi_obat' ), {
					toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
				}).then( editor => {
					window.editor = editor;
				}).catch( err => {
					console.error( err.stack );
				});
			ClassicEditor.create( document.querySelector( '#diet' ), {
					toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
				}).then( editor => {
					window.editor = editor;
				}).catch( err => {
					console.error( err.stack );
				});
			ClassicEditor.create( document.querySelector( '#hasil_konsul' ), {
					toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
				}).then( editor => {
					window.editor = editor;
				}).catch( err => {
					console.error( err.stack );
				});
			ClassicEditor.create( document.querySelector( '#diagnosa_utama' ), {
					toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
				}).then( editor => {
					window.editor = editor;
				}).catch( err => {
					console.error( err.stack );
				});
			ClassicEditor.create( document.querySelector( '#icd10_utama' ), {
					toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
				}).then( editor => {
					window.editor = editor;
				}).catch( err => {
					console.error( err.stack );
				});
			ClassicEditor.create( document.querySelector( '#diagnosa_tambahan' ), {
					toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
				}).then( editor => {
					window.editor = editor;
				}).catch( err => {
					console.error( err.stack );
				});
			ClassicEditor.create( document.querySelector( '#icd10_tambahan' ), {
					toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
				}).then( editor => {
					window.editor = editor;
				}).catch( err => {
					console.error( err.stack );
				});
			ClassicEditor.create( document.querySelector( '#tindakan' ), {
					toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
				}).then( editor => {
					window.editor = editor;
				}).catch( err => {
					console.error( err.stack );
				});
			ClassicEditor.create( document.querySelector( '#icd9' ), {
					toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
				}).then( editor => {
					window.editor = editor;
				}).catch( err => {
					console.error( err.stack );
				});
			ClassicEditor.create( document.querySelector( '#edukasi' ), {
					toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
				}).then( editor => {
					window.editor = editor;
				}).catch( err => {
					console.error( err.stack );
				});
		</script>
		<script type="text/javascript">
		$(document).ready(function () {
			var i=1;
			//daftar reaksi obat
		$("#addRow").click(function(event){
			var markup = '<tr id="r'+i+'">';
			markup +='<td><input type="checkbox" name="record"></td>';
			markup +='<td><input type="text" class="form-control" name="namaobat[]" id="namaobat" placeholder="masukan nama obat"></td>';
			markup +='<td><input type="text" class="form-control" name="manifes[]" id="manifes" placeholder="manifestasi kliniks"></td>';
			markup +='<td><input type="text" class="form-control" name="ket[]" id="keterangan" placeholder="keterangan"></td></tr>';
			$("#terapi_obat_table tbody").append(markup);
			i++;
		});
		// Find and remove selected table rows
    $("#removeRow").click(function(){
        $("#terapi_obat_table tbody").find('input[name="record"]').each(function(){
        	if($(this).is(":checked")){
							console.log(this);
                $(this).closest("tr").remove();
            }
        });
    });
		//terapi pulang
		$("#addPulang").click(function(event){
			var pulang = '<tr id="r'+i+'">';
			pulang +='<td><input type="checkbox" name="del"></td>';
			pulang +='<td><input type="text" class="form-control" name="obatpulang[]" id="obatpulang" placeholder="masukan nama obat"></td>';
			pulang +='<td><input type="text" class="form-control" name="jumlah[]" id="jumlah" placeholder="Masukan Jumlah Obat"></td>';
			pulang +='<td><input type="text" class="form-control" name="dosis[]" id="dosis" placeholder="Dosis"></td>';
			pulang +='<td><input type="text" class="form-control" name="frekuensi[]" id="frekuensi" placeholder="Frekuensi"></td>';
			pulang +='<td><input type="text" class="form-control" name="carapemberian[]" id="cara_pemberian" placeholder="Cara Pemberian"></td>';
			pulang +='</tr>'
			$("#terapi_pulang tbody").append(pulang);
			i++;
		});
		// Find and remove selected table rows
    $("#removePulang").click(function(){
        $("#terapi_pulang tbody").find('input[name="del"]').each(function(){
        	if($(this).is(":checked")){
							console.log(this);
                $(this).closest("tr").remove();
            }
        });
    });

			});
			</script>
    <script type="text/javascript">
		$('#dpjp').select2({
			placeholder: "Masukan Nama Dokter Penanggungjawab",
			width : 'resolve',
			allowClear : true
		});
		$('input[type="radio"].minimal-red').iCheck({
      radioClass: 'icheckbox_minimal-red'
    });
      $('#tanggal_kontrol').datetimepicker({
				format: 'YYYY-MM-DD HH:mm:ss'
			});
			$('#tanggal_keluar').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true
		  });
    </script>
  </body>
</html>
