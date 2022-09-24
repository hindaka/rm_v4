<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$id_pulang = isset($_GET['pul']) ? $_GET['pul'] : '';
$awal = isset($_GET['awal']) ? $_GET['awal'] : '';
$akhir = isset($_GET['akhir']) ? $_GET['akhir'] : '';
$list_data = $db->prepare("SELECT rp.nomedrek,rp.tanggallahir,rp.tanggaldaftar,rp.nama,pul.*,IFNULL(rf.diagnosa_utama,'') as diagnosa_utama,IFNULL(rf.kode_icd,'') as kode_icd, IFNULL(rf.diagnosa_tambahan,'') as diagnosa_tambahan FROM registerpasien_pulang pul INNER JOIN registerpasien rp ON(pul.id_register=rp.id_pasien) LEFT JOIN registerpasien_final rf ON(rf.id_pulang=pul.id_pulang) WHERE pul.jenis_rawat='ranap' AND pul.id_pulang=:id");
$list_data->bindParam(":id",$id_pulang);
$list_data->execute();
$data = $list_data->fetch(PDO::FETCH_ASSOC);
$full_diagnosa = $data['diagnosa_utama']." | ".$data['kode_icd'];
//check invoice
$inv = $db->prepare("SELECT invd.jperiksa,invd.created_at FROM invoice_all ia INNER JOIN invoice_all_det invd ON(invd.id_invoice_all=ia.id_invoice_all) WHERE ia.id_register=:reg AND jenis_rawat='rajal'");
$inv->bindParam(":reg",$data['id_register']);
$inv->execute();
$inv_all = $inv->fetchAll(PDO::FETCH_ASSOC);
//data prosedur
$prosedur = $db->prepare("SELECT * FROM registerpasien_prosedur WHERE id_pulang=:id");
$prosedur->bindParam(":id",$id_pulang,PDO::PARAM_INT);
$prosedur->execute();
$list_prosedur = $prosedur->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="../plugins/tags_plugin/jqueryui.css" type="text/css">
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
                      <small>Member sejak <?php echo $r1["tanggal"]; ?></small>
                    </p>
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Coding Diagnosa
            <small>Rawat Inap</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
					<div class="alert alert-info">
						<b>Halaman ini dipergunakan untuk Coding Diagnosa/prosedur Pasien Rawat Inap.</b><br>
						<span style="color:red">**</span><b style="color:black">Jangan Lupa Klik Tombol Selesai agar data tersimpan ke dalam Rekap Coding Ranap.</b>
					</div>
          <div style="height:350px;overflow:auto;background-color:#ecf0f1;">
            <div class="col-xs-6">
              <!-- Default box -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Form Coding Pasien Rawat Inap</h3>
                </div>
                  <div class="box-body">
										<div class="row">
											<div class="col-xs-4">
												<div class="form-group">
			                      <label for="tanggaldaftar">Tanggal Daftar</label>
			                      <input type="text" class="form-control" id="tanggaldaftar" name="tanggaldaftar" placeholder="Tanggal Daftar" value="<?php echo $data['tanggaldaftar'] ?>" readonly>
			                    </div>
											</div>
											<div class="col-xs-4">
												<div class="form-group">
		                      <label for="cara_bayar">Cara Bayar</label>
		                      <input type="text" class="form-control" id="cara_bayar" name="cara_bayar" placeholder="Cara Bayar" value="<?php echo $data['jpasien']; ?>" readonly>
		                    </div>
											</div>
											<div class="col-xs-4">
													<div class="form-group">
			                      <label for="tanggallahir">Tanggal Lahir</label>
			                      <input type="text" class="form-control" id="tanggallahir" name="tanggallahir" placeholder="Tanggal Lahir" value="<?php echo $data['tanggallahir'] ?>" readonly>
			                    </div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
		                      <label for="nomedrek">Nomedrek</label>
		                      <input type="hidden" name="id_pulang" value="<?php echo $id_pulang ?>">
		                      <input type="text" class="form-control" id="nomedrek" name="nomedrek" value="<?php echo $data['nomedrek']; ?>" readonly>
		                    </div>
											</div>
											<div class="col-xs-6">
												<div class="form-group">
		                      <label for="nama">Nama Pasien</label>
		                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pasien" value="<?php echo $data['nama'] ?>" readonly>
		                    </div>
											</div>
										</div>
                    <div class="form-group">
                      <label for="diagnosa">Diagnosa Akhir</label>
                      <input type="text" class="form-control" id="diagnosa" name="diagnosa" placeholder="Diagnosa akhir" value="<?php echo $data['diagnosa_akhir']; ?>" readonly>
                    </div>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
						<div class="col-xs-6">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Data Tindakan</h3>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table id="example1" class="table table-responsive table-striped">
											<thead>
												<tr class="info">
													<th>Tanggal Tindakan</th>
													<th>Nama</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach ($inv_all as $row) {
														echo "<tr>
															<td>".$row['created_at']."</td>
															<td>".$row['jperiksa']."</td>
														</tr>";
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
          </div>
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="box box-success">
								<div class="box-header with-border">
									<h3 class="box-title">Diagnosa</h3>
									<div class="pull-right">
										<button type="button" name="button" class="btn btn-primary" onclick="simpanDiagnosa()"><i class="fa fa-save"></i> Simpan Diagnosa</button>
									</div>
								</div>
								<form class="" action="#" method="post">
									<div class="box-body">
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
		                      <label for="kasus">Kasus <span style="color:red">*</span></label>
													<input type="hidden" name="id_pulang" id="id_pulang" value="<?php echo $data['id_pulang']; ?>">
		                      <select class="form-control" name="kasus" id="kasus" required>
														<?php
															if($data['kasus']=="Baru"){
																echo "<option value=\"\">Pilih Kasus</option>
																<option value=\"-\">-</option>
																<option value=\"Baru\" selected>Baru</option>
																<option value=\"Lama\">Lama</option>";
															}elseif ($data['kasus']=="Lama") {
																echo "<option value=\"\">Pilih Kasus</option>
																<option value=\"-\">-</option>
																<option value=\"Baru\">Baru</option>
																<option value=\"Lama\" selected>Lama</option>";
															}elseif($data['kasus']=='-'){
																echo "<option value=\"\">Pilih Kasus</option>
																<option value=\"-\" selected>-</option>
																<option value=\"Baru\">Baru</option>
																<option value=\"Lama\">Lama</option>";
															}else{
																echo "<option value=\"\">Pilih Kasus</option>
																<option value=\"-\">-</option>
																<option value=\"Baru\">Baru</option>
																<option value=\"Lama\">Lama</option>";
															}
														?>
		                      </select>
		                    </div>
											</div>
											<div class="col-xs-6">
												<div class="form-group">
		                      <label for="diagnosa_utama">Diagnosa Utama <span style="color:red;">*</span></label>
		                      <input type="text" class="form-control" id="diagnosa_utama" name="diagnosa_utama" autocomplete="off" placeholder="Masukan Diagnosa Utama" value="<?php echo $full_diagnosa; ?>" required>
		                    </div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
													<label for="diagnosa_tambahan">Diagnosa Tambahan </label>
													<textarea id="tags" name="diagnosa_tambahan" class="form-control" rows="2" cols="80"><?php echo $data['diagnosa_tambahan']; ?></textarea>
													<!-- <input id="tags" class="form-control" name="diagnosa_tambahan" placeholder="Diagnosa Tambahan" autocomplete="off"> -->
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- end block diagnosa -->
						<div class="col-xs-12 col-md-6">
							<div class="box box-warning">
								<div class="box-header">
									<h3 class="box-title">Tindakan</h3>
									<div class="pull-right">
										<form class="form-inline" action="index.html" method="post">
											<input type="text" id="icd9" name="icd_9" class="form-control" autocomplete="off">
											<button type="button" name="button" class="btn btn-primary" onclick="tambahTindakan()"><i class="fa fa-plus"></i> Tambah</button>
										</form>
									</div>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table id="example3" class="table table-hover table-striped table-bordered">
											<thead>
												<tr>
													<th>Nama</th>
													<th>ICD</th>
													<th>aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach ($list_prosedur as $pro) {
													echo "<tr>
														<td>".$pro['nama_prosedur']."</td>
														<td>".$pro['icd_prosedur']."</td>
														<td><a class='btn btn-danger' onclick='hapus(".$pro['id_prosedur'].")'><i class='fa fa-cut'></i> Hapus</a></td>
													</tr>";
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="box-footer">
									<div class="row">
										<div class="col-md-3 pull-right">
											<a href="rekap_coding_ranap.php?pul=<?php echo $id_pulang; ?>&awal=<?php echo $awal ?>&akhir=<?php echo $akhir ?>&status=1" class="btn btn-success btn-md"><i class="fa fa-check"></i> Selesai</a>
										</div>
									</div>
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
    <script src="../plugins/tags_plugin/jqueryui.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    <script src="../plugins/typeahead/typeahead.bundle.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
		$( function() {
	    var availableTags = [
	      <?php
			  //ambil data pemeriksaan
			  $get_d=$db->query("SELECT diagnosa,icd FROM diag WHERE slug_icd='icd10'");
				foreach ($get_d as $dc) {
					$d10=$dc["diagnosa"];
				  echo "'$d10 (".$dc['icd'].")',";
				}
		  ?>];
	    function split( val ) {
	      return val.split( /,\s*/ );
	    }
	    function extractLast( term ) {
	      return split( term ).pop();
	    }

	    $( "#tags" )
	      // don't navigate away from the field on tab when selecting an item
	      .on( "keydown", function( event ) {
	        if ( event.keyCode === $.ui.keyCode.TAB &&
	            $( this ).autocomplete( "instance" ).menu.active ) {
	          event.preventDefault();
	        }
	      })
	      .autocomplete({
	        minLength: 0,
	        source: function( request, response ) {
	          // delegate back to autocomplete, but extract the last term
	          // var results = response( $.ui.autocomplete.filter(
	          //   availableTags, extractLast( request.term ) ) );
						var results = $.ui.autocomplete.filter(
	            availableTags, extractLast( request.term ) );
							response(results.slice(0, 10));
	        },
	        focus: function() {
	          // prevent value inserted on focus
	          return false;
	        },
	        select: function( event, ui ) {
	          var terms = this.value.split(",");
						var test = jQuery.inArray( ui.item.value, terms );
						if(test!="-1"){
							// remove the current input
							terms.pop();
							terms.push( "" );
						 	this.value = terms.join( "," );
							alert(ui.item.value+" Sudah berada didalam diagnosa tambahan");
						}else{
							// remove the current input
							terms.pop();
							// // add the selected item
							terms.push( ui.item.value );
							// // add placeholder to get the comma-and-space at the end
		          terms.push( "" );
		          this.value = terms.join( "," );
						}
	          return false;
	        }
	      });
	  } );
		</script>
		<script type="text/javascript">
			function simpanDiagnosa(){
				var kasus = $("#kasus").val();
				var du = $("#diagnosa_utama").val();
				var dt = $("#tags").val();
				var id_pulang = $("#id_pulang").val();
				var links = window.location.href;
				if(kasus==''){
					alert("Kasus belum dipilih");
					return false;
				}
				if(du==""){
					alert("Diagnosa Utama Belum diisi.");
					return false;
				}
				//ajax post data
				$.ajax({
					type:'POST',
					url:'code_ranap.php',
					data:'id_pulang='+id_pulang+'&diagnosa_utama='+du+'&diagnosa_tambahan='+dt+'&kasus='+kasus,
					success:function(data){
						alert(data);
						// alert("Data Diagnosa Berhasil disimpan");
						window.location=links;
						// return false;
					}
				});
			}
			//icd prosedur
			function tambahTindakan(){
				// alert("test");
				var icd9 = $("#icd9").val();
				var id_pulang = $("#id_pulang").val();
				var links = window.location.href;
				if(icd9==""){
					alert("ICD Tindakan belum diisi !!");
					return false;
				}
				//ajax post data
				$.ajax({
					type:'POST',
					url:'code_ranap_pro.php',
					data:'id_pulang='+id_pulang+'&icd='+icd9,
					success:function(data){
						alert(data);
						// alert("Data Diagnosa Tindakan Berhasil disimpan");
						window.location=links;
						// return false;
					}
				});
			}
			function hapus(id){
				var links = window.location.href;
		    var r = confirm("Data yang sudah dihapus tidak dapat dikembalikan,\nApakah Anda yakin?");
		    if (r == true) {
					$.ajax({
						type:'POST',
						url:'code_ranap_pro_hapus.php',
						data:'id='+id,
						success:function(data){
							alert(data);
							// alert("Data Diagnosa Tindakan Berhasil disimpan");
							window.location=links;
							// return false;
						}
					});
		    } else {
		        return false;
		    }

			}
		</script>
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
				$("#example3").dataTable();
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
    <script type="text/javascript">
    //typeahead picker
      $('#diagnosa_utama').typeahead({
      source: [
    <?php
    //ambil data pemeriksaan
    $h2=$db->query("SELECT * FROM diag WHERE slug_icd='icd10'");
    $data2 = $h2->fetchAll(PDO::FETCH_ASSOC);
    foreach($data2 as $r2){
      $diagnosa=$r2["diagnosa"];
      echo "'$diagnosa | ".$r2['icd']."',";
    }
    ?>]
    });
		//typeahead picker
      $('#icd9').typeahead({
      source: [
    <?php
    //ambil data pemeriksaan
    $h3=$db->query("SELECT * FROM diag WHERE slug_icd='icd9'");
    $data3 = $h3->fetchAll(PDO::FETCH_ASSOC);
    foreach($data3 as $r3){
      $diagnosa=$r3["diagnosa"];
      echo "'$diagnosa | ".$r3['icd']."',";
    }
    ?>]
    });
    </script>

  </body>
</html>
