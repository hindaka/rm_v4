<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$list_data = $db->query("SELECT id_diagnosa,diagnosa,icd FROM diag WHERE slug_icd='icd10' AND aktif='y'");
$data = $list_data->fetchAll(PDO::FETCH_ASSOC);
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
		<style media="screen">
		.modal-header-info {
				color:#fff;
				padding:9px 15px;
				border-bottom:1px solid #eee;
				background-color: #5bc0de;
			}
			.modal-header-warning {
					color:#fff;
					padding:9px 15px;
					border-bottom:1px solid #eee;
					background-color: #f1c40f;
				}
				.modal-header-danger {
						color:#fff;
						padding:9px 15px;
						border-bottom:1px solid #eee;
						background-color: #d35400;
					}
		</style>
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
            Pengaturan Diagnosa
            <small>ICD 10</small>
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
              <h3 class="box-title">Pengaturan Diagnosa ICD 10</h3>
              <div class="pull-right">
                <button type="button" class="btn btn-success" name="button" id="tdiag" data-toggle="modal" data-target="#formDiagnosa"><i class="fa fa-plus"></i> Tambah Data Diagnosa</button>
              </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-striped table bordered">
                    <thead>
                      <tr class="info">
                        <th>Nama ICD</th>
                        <th>Kode ICD</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
											<?php
												foreach ($data as $row) {
													echo "<tr>
														<td>".$row['diagnosa']."</td>
														<td>".$row['icd']."</td>
														<td>
															<button type=\"button\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#exampleModal\" data-id=\"".$row['id_diagnosa']."\" data-nama=\"".$row['diagnosa']."\" data-kode=\"".$row['icd']."\"><i class=\"fa fa-pencil\"></i> Edit</button>
															<button type=\"button\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#deleteModal\" data-id=\"".$row['id_diagnosa']."\" data-nama=\"".$row['diagnosa']."\" data-kode=\"".$row['icd']."\"><i class=\"fa fa-cut\"></i> Hapus</button>
														</td>
													</tr>";
												}
											?>
                    </tbody>
                  </table>
                </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
					<div class="modal fade" id="formDiagnosa" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header modal-header-info">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h5 class="modal-title" id="">Form Tambah Data ICD</h5>
					      </div>
					      <div class="modal-body">
									<form class="" action="" method="post">
										<div class="form-group">
										  <label for="nama_icd">Nama ICD</label>
										  <input type="text" class="form-control" id="nama_icd" name="nama_icd" placeholder="Masukan Nama ICD Disini." required>
										</div>
										<div class="form-group">
										  <label for="kode_icd">Kode ICD</label>
										  <input type="text" class="form-control" id="kode_icd" name="kode_icd" placeholder="Masukan Kode ICD disini." required>
										</div>
									</form>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-success" onclick="simpanIcd()">Simpan</button>
					      </div>
					    </div>
					  </div>
					</div>
					<!-- modal edit -->
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header modal-header-warning">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
				        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
				      </div>
				      <div class="modal-body">
				        <form>
									<div class="form-group">
										<label for="nama_icd">Nama ICD</label>
										<input type="text" class="form-control" id="nama_icd1" name="nama_icd" placeholder="Masukan Nama ICD Disini." required>
									</div>
									<div class="form-group">
										<label for="kode_icd">Kode ICD</label>
										<input type="text" class="form-control" id="kode_icd1" name="kode_icd" placeholder="Masukan Kode ICD disini." required>
										<input type="hidden" name="id_diagnosa" id="id_diagnosa1" name="id_diagnosa">
									</div>
				        </form>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-success" onclick="updateIcd()">Simpan</button>
				      </div>
				    </div>
				  </div>
				</div>
				<!-- delete modal -->
				<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header modal-header-danger">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h5 class="modal-title" id="exampleModalLabel">New message</h5>
						</div>
						<div class="modal-body">
							<label for="">Apakah Anda Yakin Menghapus data diagnosa dibawah ini :</label>
							<form>

								<div class="form-group">
									<label for="nama_icd">Nama ICD : </label>
									<input type="text" class="form-control" id="nama_icd2" name="nama_icd" placeholder="Masukan Nama ICD Disini." readonly>
								</div>
								<div class="form-group">
									<label for="kode_icd">Kode ICD</label>
									<input type="text" class="form-control" id="kode_icd2" name="kode_icd" placeholder="Masukan Kode ICD disini." readonly>
									<input type="hidden" name="id_diagnosa" id="id_diagnosa2" name="id_diagnosa">
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
							<button type="button" class="btn btn-danger" onclick="hapusIcd()"><i class="fa fa-cut"></i> Hapus</button>
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
    <!-- DATA TABES SCRIPT -->
    <script src="../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			function simpanIcd(){
				var nama = $("#nama_icd").val();
				var kode = $("#kode_icd").val();
				var links = window.location.href;
				if(nama==""){
					alert('Nama Diagnosa Tidak Boleh Kosong');
					return false;
				}
				if(kode==""){
					alert('Kode Diagnosa Tidak Boleh Kosong');
					return false;
				}
				$.ajax({
					type:'POST',
					url:'tambahICD.php',
					data:'nama='+nama+'&kode='+kode+'&icd=icd10',
					success:function(data){
						alert(data);
						window.location=links;
						// return false;
					}
				});
			}
			function updateIcd(){
				var id = $("#id_diagnosa1").val();
				var nama = $("#nama_icd1").val();
				var kode = $("#kode_icd1").val();
				var links = window.location.href;
				if(nama==""){
					alert('Nama Diagnosa Tidak Boleh Kosong');
					return false;
				}
				if(kode==""){
					alert('Kode Diagnosa Tidak Boleh Kosong');
					return false;
				}
				$.ajax({
					type:'POST',
					url:'updateICD.php',
					data:'id='+id+'&nama='+nama+'&kode='+kode+'&icd=icd10',
					success:function(data){
						alert(data);
						window.location=links;
						// return false;
					}
				});
			}
			function hapusIcd(){
				var id = $("#id_diagnosa2").val();
				var nama = $("#nama_icd2").val();
				var kode = $("#kode_icd2").val();
				var links = window.location.href;
				if(nama==""){
					alert('Nama Diagnosa Tidak Boleh Kosong');
					return false;
				}
				if(kode==""){
					alert('Kode Diagnosa Tidak Boleh Kosong');
					return false;
				}
				$.ajax({
					type:'POST',
					url:'hapusICD.php',
					data:'id='+id+'&nama='+nama+'&kode='+kode+'&icd=icd10',
					success:function(data){
						alert(data);
						window.location=links;
						// return false;
					}
				});
			}
		</script>
		<script type="text/javascript">
		$('#exampleModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') // Extract info from data-* attributes
			var nama = button.data('nama') // Extract info from data-* attributes
			var kode = button.data('kode') // Extract info from data-* attributes
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('Form Ubah Data Diagnosa')
			modal.find('.modal-body #id_diagnosa1').val(id)
			modal.find('.modal-body #nama_icd1').val(nama)
			modal.find('.modal-body #kode_icd1').val(kode)
		})
		</script>
		<script type="text/javascript">
		$('#deleteModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') // Extract info from data-* attributes
			var nama = button.data('nama') // Extract info from data-* attributes
			var kode = button.data('kode') // Extract info from data-* attributes
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('Konfirmasi Penghapusan Data Diagnosa')
			modal.find('.modal-body #id_diagnosa2').val(id)
			modal.find('.modal-body #nama_icd2').val(nama)
			modal.find('.modal-body #kode_icd2').val(kode)
		})
		</script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
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
