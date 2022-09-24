<?php
include "cek_user.php";
include "../inc/anggota_check.php";
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
		<!-- iCheck for checkboxes and radio inputs -->
		<link rel="stylesheet" href="../plugins/iCheck/all.css">
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
				<?php if (isset($_GET['status']) && ($_GET['status'] == "1")) { ?><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-check"></i>Berhasil</h4>Data Supplier Berhasil ditambahkan</center></div>
			<?php } else if (isset($_GET['status']) && ($_GET['status'] == "2")) { ?><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-check"></i>Berhasil</h4>Data Supplier Berhasil diubah</center></div>
		<?php } else if (isset($_GET['status']) && ($_GET['status'] == "3")) { ?><div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-ban"></i>Peringatan!</h4>Supplier Sudah Terdaftar, Cek DATA SUPPLIER !</center></div>
	<?php } else if (isset($_GET['status']) && ($_GET['status'] == "4")) { ?><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><center><h4><i class="icon fa fa-ban"></i>Peringatan!</h4>Terjadi kesalahan pada sistem.<br> Perhatikan Kembali penulisan data inputan.</center></div>
				<?php } ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Pengaturan
            <small>Data Diagnosa untuk Statistik</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
					<div class="row">
						<div class="col-md-6">
							<div class="box">
		            <div class="box-header with-border">
		              <h3 class="box-title"><i class="fa fa-book"></i> Data Diagnosa ICD 10 Keseluruhan</h3>
									<span class="pull-right">
										<!-- <input type="checkbox" onClick="testing(this)" /> Toggle all on the page -->
										 <button class="btn btn-sm btn-success" type="button" onclick="getCheck()"><i class="fa fa-send"></i> Eksklusikan Diagnosa</button>
									</span>
		            </div>
		            <div class="box-body">
									<div class="table-responsive">
										<table id="example1" class="table table-bordered table-hover" width="100%">
											<thead>
												<tr class="info">
													<th>#</th>
													<th>Kode ICD</th>
                          <th>Diagnosa</th>
												</tr>
											</thead>
										</table>
									</div>
		            </div>
		          </div>
						</div>
						<div class="col-md-6">
							<div class="box">
		            <div class="box-header with-border">
		              <h3 class="box-title"><i class="fa fa-book"></i> Data Eksklusi Diagnosa</h3>
									<span class="pull-right">
										<button class="btn btn-sm btn-warning" type="button" onclick="getBackCheck()"><i class="fa fa-undo"></i> Inklusikan Diagnosa</button>
									</span>
		            </div>
		            <div class="box-body">
									<div class="table-responsive">
										<table id="example2" class="table table-bordered table-hover" width="100%">
											<thead>
												<tr class="info">
													<th>#</th>
													<th>Kode ICD</th>
													<th>Diagnosa</th>
												</tr>
											</thead>
										</table>
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
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
		<!-- iCheck 1.0.1 -->
		<script src="../plugins/iCheck/icheck.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    <!-- page script -->
		<script type="text/javascript">
			function reloadTable(){
				// window.location = "fornas.php";
				$('#example1').DataTable().ajax.reload();
				$('#example2').DataTable().ajax.reload();
			}
			function getCheck(){
				/* declare an checkbox array */
				var chkArray = [];

				/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
				$(".chk:checked").each(function() {
					chkArray.push($(this).val());
				});

				/* we join the array separated by the comma */
				var selected;
				selected = chkArray.join(',') ;

				/* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
				if(selected.length > 0){
					// alert("You have selected " + selected);
					console.log(selected);
					//ajax goes here
					$.ajax({
							type: "POST",
							url: "set_diagnosa_eksklusi.php",
							data: {
								'check_data' : selected,
							},
							dataType : 'json',
							success: function (respon) {
								// console.log("SUCCESS : ", respon);
								alert(respon);
								// call notification
								reloadTable();
							},
							error: function (e) {
									// $("#result").text(e.responseText);
									console.log("ERROR : ", e.responseText);
									reloadTable();
							}
					});
				}else{
					alert("Silakan pilih ceklis satu/lebih Diagnosa terlebih dahulu");
				}
			}
			function getBackCheck(){
				/* declare an checkbox array */
				var chkArray = [];

				/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
				$(".chk_back:checked").each(function() {
					chkArray.push($(this).val());
				});

				/* we join the array separated by the comma */
				var selected;
				selected = chkArray.join(',') ;

				/* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
				if(selected.length > 0){
					// alert("You have selected " + selected);
					console.log(selected);
					//ajax goes here
					$.ajax({
							type: "POST",
							url: "set_diagnosa_undo.php",
							data: {
								'check_data' : selected,
							},
							dataType : 'json',
							success: function (respon) {
								// console.log("SUCCESS : ", respon);
								alert(respon);
								// call notification
								reloadTable();
							},
							error: function (e) {
									// $("#result").text(e.responseText);
									console.log("ERROR : ", e.responseText);
									reloadTable();
							}
					});
				}else{
					alert("Silakan pilih ceklis satu/lebih Diagnosa terlebih dahulu");
				}
			}
		</script>
		<script type="text/javascript">
			$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
				checkboxClass: 'icheckbox_minimal-green',
				radioClass: 'iradio_minimal-green'
			});
			$('input[type="checkbox"].minimal, input[type="radio"].minimal').css('position','relative');
			function testing(source) {
			  checkboxes = document.getElementsByName('pilihDiagnosa');
				console.log(checkboxes[1]);
			  for(var i=0, n=checkboxes.length;i<n;i++) {
			    checkboxes[i].checked= source.checked;
			  }
			}
		</script>
    <script type="text/javascript">
      $(function () {
				var master_diagnosa = $('#example1').DataTable({
					"processing" : true,
					"serverSide" : true,
					"ajax": "ajax_data/data_master_diagnosa.php",
					"columns":[
						{
							"data" : 'id_diagnosa',
							"render": function ( data, type, full, meta ) {
								return '<input class=\"minimal chk\" id=\"pilihDiagnosa\" type=\"checkbox\" name=\"pilihDiagnosa\" value=\"'+data+'\">';
								}
						},
            {"data" : 'icd'},
						{
							"data" : 'diagnosa',
							"render": function(data, type, full, meta){
								return data;
							}
						},

					],
					"order": [[1, 'asc']],
				});
				var master_fornas = $('#example2').DataTable({
					"processing" : true,
					"serverSide" : true,
					"ajax": "ajax_data/data_master_eksklusi.php",
          "order": [[1, 'asc']],
				});
      });
    </script>

  </body>
</html>
