<?php
include "cek_user.php";
include "../inc/anggota_check.php";
//get data
$awal = isset($_GET['awal']) ? $_GET['awal'] : '';
$akhir = isset($_GET['akhir']) ? $_GET['akhir'] : '';
$akhir_up = date('Y-m-d', strtotime($akhir . ' +1 day'));
$status = isset($_GET['status']) ? $_GET['status'] : '';
$list_data = $db->query("SELECT rp.tanggaldaftar,pul.tgl_pulang,rp.nomedrek,rp.nama,rp.kelamin,rp.tanggallahir,rp.domisili,rp.ktujuan,pul.jpasien,pul.diagnosa_akhir,rf.diagnosa_utama,rf.kode_icd,rf.diagnosa_tambahan,pul.asal,pul.cara_keluar FROM registerpasien_pulang pul INNER JOIN registerpasien rp ON(pul.id_register=rp.id_pasien) INNER JOIN registerpasien_final rf ON(rf.id_pulang=pul.id_pulang) WHERE pul.jenis_rawat='ranap' AND pul.final='y' AND tgl_pulang between '".$awal."' and '".$akhir_up."'");
$data = $list_data->fetchAll(PDO::FETCH_ASSOC);
//EXCEL
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_coding_ranap-".$awal."-".$akhir.".xls");
?>
Rekap Coding Rawat Inap <?php echo $awal; ?> sampai dengan <?php echo $akhir; ?>
<table id="example1" class="table table-striped table bordered" border=1>
  <thead>
    <tr class="info">
      <th>No</th>
      <th>Tanggal Daftar</th>
      <th>Tanggal Pulang</th>
      <th>Nomedrek</th>
      <th>Nama Pasien</th>
			<th>Jenis Kelamin</th>
      <th>tanggallahir</th>
      <th>Usia</th>
      <th>Domisili</th>
      <th>Kunjungan</th>
      <th>Diagnosa Lengkap</th>
      <th>Diagnosa Utama(Coding)</th>
			<th>Kode Icd</th>
      <th>Diagnosa Tambahan(Coding)</th>
			<th>Cara Bayar</th>
      <th>Posisi Pulang</th>
      <th>cara keluar</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no=1;
      foreach ($data as $row) {
        $list = explode("/",$row['tanggallahir']);
        $dateOfBirth = $list[0]."-".$list[1]."-".$list[2];
        $list_today = explode("/",$row['tanggaldaftar']);
        $today = $list_today[0]."-".$list_today[1]."-".$list_today[2];
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        $umur = $diff->format('%y Tahun %m Bulan %d Hari');
        echo "<tr>
          <td>".$no++."</td>
          <td>".$row['tanggaldaftar']."</td>
          <td>".$row['tgl_pulang']."</td>
          <td>".$row['nomedrek']."</td>
          <td>".$row['nama']."</td>
					<td>".$row['kelamin']."</td>
          <td>".$row['tanggallahir']."</td>
          <td>".$umur."</td>
          <td>".$row['domisili']."</td>
          <td>".$row['ktujuan']."</td>
          <td>".$row['diagnosa_akhir']."</td>
          <td>".$row['diagnosa_utama']."</td>
					<td>".$row['kode_icd']."</td>
          <td>".$row['diagnosa_tambahan']."</td>
					<td>".$row['jpasien']."</td>
          <td>".$row['asal']."</td>
          <td>".$row['cara_keluar']."</td>
        </tr>";
      }
    ?>
  </tbody>
</table>
