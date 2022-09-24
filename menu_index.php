      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $r1["nama"]; ?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header text-blue">CODING</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i> <span>Coding Diagnosa</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="filter_bln_rajal.php"><i class="fa fa-circle-o"></i> Pasien Rawat Jalan</a></li>
                <li><a href="filter_bln_ranap.php"><i class="fa fa-circle-o"></i> Pasien Rawat Inap</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i> <span>Rekap Coding Diagnosa</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="filter_rajal.php"><i class="fa fa-circle-o"></i>Rekap Coding Pasien Rawat Jalan</a></li>
                <li><a href="filter_ranap.php"><i class="fa fa-circle-o"></i>Rekap Coding Pasien Rawat Inap</a></li>
              </ul>
            </li>
            <li class="header text-purple">DATA PASIEN</li>
            <li><a href="filter_list_pasien_ranap.php"><i class="fa fa-list"></i>Pasien yang sedang dirawat</a></li>
            <li><a href="list_lama_rawat.php"><i class="fa fa-list"></i>Perhitungan Lama dirawat</a></li>
            <li><a href="indikator_pelayanan.php"><i class="fa fa-list"></i>Indikator Pelayanan</a></li>
            <li class="header text-green">DOKUMEN</li>
            <li><a href="filter_resume_keluar.php"><i class="fa fa-book"></i> Resume Keluar Pasien</a></li>
            <li><a href="nik_filter.php"><i class="fa fa-search"></i> Laporan Penggunaan NIK</a></li>
            <?php if ($role == 'administrator') : ?>
              <li class="header text-blue">PENGATURAN</li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-lock"></i> <span>Pengaturan Diagnosa ICD</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="diagnosa_icd10.php"><i class="fa fa-circle-o"></i>ICD 10</a></li>
                  <li><a href="diagnosa_icd9.php"><i class="fa fa-circle-o"></i>ICD 9</a></li>
                </ul>
              </li>
              <li><a href="eksklusi_diagnosa.php"><i class="fa fa-gear"></i>Pengaturan Eksklusi Diagnosa</a></li>
              <li><a href="nik_filter.php"><i class="fa fa-search"></i> Laporan Penggunaan NIK</a></li>
            <?php endif; ?>
            <li class="header text-maroon">REKAP DATA</li>
            <li><a href="bayi_lahir.php"><i class="fa fa-search"></i> Rekap Data Bayi Lahir</a></li>
            <li><a href="pasien_die.php"><i class="fa fa-search"></i> Rekap Data Pasien Meninggal</a></li>
            <li><a href="iku.php"><i class="fa fa-search"></i> IKU (Kateter,Infus,Injeksi)</a></li>
            <li><a href="lab_rajal.php"><i class="fa fa-search"></i> REKAP LAB RAJAL</a></li>
            <li><a href="rekap_pasien_sum.php"><i class="fa fa-search"></i> REKAP PASIEN NON COVID</a></li>
            <li><a href="pasien_rajal.php"><i class="fa fa-users"></i> Data Pasien Rawat Jalan</a></li>
            <li><a href="pasien_ranap.php"><i class="fa fa-users"></i> Data Pasien Rawat Inap</a></li>
            <li><a href="labu_darah.php"><i class="fa fa-users"></i> Data Pengeluaran Labu Darah</a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-list"></i> <span>Rekap Data Radiologi</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="radiologi_dalam.php"><i class="fa fa-list"></i> Pasien Dalam RS</a></li>
                <li><a href="radiologi_luar.php"><i class="fa fa-list"></i> Pasien Luar RS</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-list"></i> <span>Data Statistik</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="statistik_filter.php"><i class="fa fa-list"></i> Data Statistik</a></li>
              </ul>
            </li>
            <li><a href="reg_ruangan.php"><i class="fa fa-search"></i> Data Register Ruangan</a></li>
            <li><a href="rawat_gabung.php"><i class="fa fa-search"></i> Data Register Bayi Rawat Gabung</a></li>
            <li><a href="reg_imunisasi.php"><i class="fa fa-search"></i> Data Register Imunisasi</a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i> <span>Laporan Rekam Medis</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="rl31.php"><i class="fa fa-circle-o"></i> RL 3.1 Rawat Inap</a></li>
                <li><a href="rl32.php"><i class="fa fa-circle-o"></i> RL 3.2 Rawat Darurat</a></li>
                <li><a href="rl34.php"><i class="fa fa-circle-o"></i> RL 3.4 Kebidanan</a></li>
                <li><a href="rl35.php"><i class="fa fa-circle-o"></i> RL 3.5 Perinatologi</a></li>
                <li><a href="rl36.php"><i class="fa fa-circle-o"></i> RL 3.6 Pembedahan</a></li>
                <li><a href="rl37.php"><i class="fa fa-circle-o"></i> RL 3.7 Radiologi</a></li>
                <li><a href="rl38.php"><i class="fa fa-circle-o"></i> RL 3.8 Laboratorium</a></li>
                <li><a href="rl39.php"><i class="fa fa-circle-o"></i> RL 3.9 Rehab Medik</a></li>
                <li><a href="rl310.php"><i class="fa fa-circle-o"></i> RL 3.10 Pelayanan Khusus</a></li>
                <li><a href="rl311.php"><i class="fa fa-circle-o"></i> RL 3.11 Kesehatan Jiwa</a></li>
                <li><a href="rl312.php"><i class="fa fa-circle-o"></i> RL 3.12 Keluarga Berencana</a></li>
                <li><a href="rl313.php"><i class="fa fa-circle-o"></i> RL 3.13 Obat</a></li>
                <li><a href="rl314.php"><i class="fa fa-circle-o"></i> RL 3.14 Rujukan</a></li>
                <li><a href="rl315.php"><i class="fa fa-circle-o"></i> RL 3.15 Cara Bayar</a></li>
                <li><a href="rl4a.php"><i class="fa fa-circle-o"></i> RL 4.A Penyakit Rawat Inap</a></li>
                <li><a href="rl4b.php"><i class="fa fa-circle-o"></i> RL 4.B Penyakit Rawat Jalan</a></li>

                <li><a href="rl53.php"><i class="fa fa-circle-o"></i> RL 5.3 10 Penyakit rawat Inap</a></li>
                <li><a href="rl54.php"><i class="fa fa-circle-o"></i> RL 5.4 10 Penyakit rawat Jalan</a></li>
              </ul>
            </li>
            <li class="header text-orange">UTILITIES</li>
            <li><a href="../ubah_session.php"><i class="fa fa-exchange"></i> Ubah Modul</a></li>
            <li><a href="../logout.php"><i class="fa fa-lock"></i> Logout</a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>