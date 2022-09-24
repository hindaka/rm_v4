<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$ruang = isset($_GET['ruangan']) ? $_GET['ruangan'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$awal = isset($_GET['tanggalAwal']) ? $_GET['tanggalAwal'] : '';
$akhir = isset($_GET['tanggalAkhir']) ? $_GET['tanggalAkhir'] : '';
$akhir_plus_one = date('Y-m-d', strtotime($akhir . ' +1 day'));
$awal_fix = str_replace("-","",$awal);
$akhir_fix = str_replace("-","",$akhir);
if($filter=='masuk'){
  $text = "Filter Berdasarkan Tanggal Masuk Pasien Ke Ruangan";
	//filter berdasarkan tanggal masuk
  if($ruang=='nifas4'){
    $query = $db->query("SELECT n4.*,n4.kelas as kelas_rawat,rp.* FROM nifas4 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='2' AND n4.tipenifas4='bayi' AND CAST(CONCAT(SUBSTRING(n4.tanggalmasuk,7,4),SUBSTRING(n4.tanggalmasuk,4,2),SUBSTRING(n4.tanggalmasuk,1,2)) AS UNSIGNED) >= '".$awal_fix."' AND CAST(CONCAT(SUBSTRING(n4.tanggalmasuk,7,4),SUBSTRING(n4.tanggalmasuk,4,2),SUBSTRING(n4.tanggalmasuk,1,2)) AS UNSIGNED) <= '".$akhir_fix."'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
  }elseif ($ruang=='nifas3') {
    $query = $db->query("SELECT n3.*,n3.kelas as kelas_rawat,rp.* FROM nifas3 n3 INNER JOIN registerpasien rp ON(n3.id_register=rp.id_pasien) WHERE n3.status='2' AND n3.tipenifas3='bayi' CAST(CONCAT(SUBSTRING(n3.tanggalmasuk,7,4),SUBSTRING(n3.tanggalmasuk,4,2),SUBSTRING(n3.tanggalmasuk,1,2)) AS UNSIGNED) >= '".$awal_fix."' AND CAST(CONCAT(SUBSTRING(n3.tanggalmasuk,7,4),SUBSTRING(n3.tanggalmasuk,4,2),SUBSTRING(n3.tanggalmasuk,1,2)) AS UNSIGNED) <= '".$akhir_fix."'");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
  }else{

  }
}elseif ($filter=='keluar') {
  //filter berdasarkan tanggal keluar
  $text = "Filter Berdasarkan Tanggal Keluar Pasien dari Ruangan";
	if($ruang=='nifas4'){
    $query = $db->query("SELECT n4.*,n4.kelas as kelas_rawat,rp.* FROM nifas4 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='2' AND n4.tipenifas4='bayi' tanggalkeluar BETWEEN '".$awal."' AND '".$akhir_plus_one."' ORDER BY tanggalkeluar ASC");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
  }elseif ($ruang=='nifas3') {
    $query = $db->query("SELECT n3.*,n3.kelas as kelas_rawat,rp.* FROM nifas3 n3 INNER JOIN registerpasien rp ON(n3.id_register=rp.id_pasien) WHERE n3.status='2' AND n3.tipenifas3='bayi' tanggalkeluar BETWEEN '".$awal."' AND '".$akhir_plus_one."' ORDER BY tanggalkeluar ASC");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
  }else{

  }
}else{
  header("Location: rawat_gabung.php");
}
//EXCEL
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=register-rawat-gabung-".$ruang.".xls");
?>
Data Register Rawat Gabung (<?php echo strtoupper($ruang); ?>) / (PERIODE : <?php echo $awal." - ".$akhir; ?>)<br>
<?php
echo $text; ?>
	<!-- nifas4 & nifas3 -->
	<table id="example1" class="table table-bordered table-striped table-hover" border=1>
		<thead>
			<tr class="info">
<th>Tanggal Masuk</th>
<th>Tanggal Keluar</th>
<th>Lama Rawat</th>
<th>No. RM</th>
<th>Nama</th>
<th>Alamat</th>
<th>Domisili</th>
<th>Jam masuk</th>
				<th>Pendidikan</th>
<th>Pekerjaan</th>
				<th>Asal ruangan</th>
<th>Umur pasien</th>
<th>Umur suami</th>

<th>Rujukan dari</th>
<th>Tanggal daftar</th>
				<th>Cara keluar</th>
<th>Cara bayar</th>
<th>DPJP</th>
<th>Cara Persalinan</th>
<th>Tanggal Lahir bayi</th>
<th>Jenis Kelamin bayi</th>
<th>Jam lahir Bayi</th>
<th>BB Bayi</th>
<th>Panjang bayi</th>
<th>A/S</th>
<th>Kelas</th>
<th>Gol.darah</th>
<th>Nilai Kritis</th>
<th>Jenis Darah & Jumlah Labu</th>
<th>Diagnosa Awal</th>
<th>Diagnosa Akhir</th>
<th>Indikasi meninggal</th>
			</tr>
		</thead>
		<tbody>
<?php
foreach ($data as $r2) {

if($r2['tanggalkeluar']=="0000-00-00 00:00:00"){
$check = $db->query("SELECT COUNT(*) as total FROM log_trans_pasien WHERE id_register='".$r2['id_register']."' AND keluar LIKE '%".$r2['carakeluar']."%'");
$ch = $check->fetch(PDO::FETCH_ASSOC);
if($ch['total']==0){
$tgl_out = $r2['tanggalkeluar'];
$lama_rawat = "unknown";
}else{
$get_data = $db->query("SELECT * FROM log_trans_pasien WHERE id_register='".$r2['id_register']."' AND keluar LIKE '%".$r2['carakeluar']."%'");
$data = $get_data->fetch(PDO::FETCH_ASSOC);
$masuk = explode('/',$r2['tanggalmasuk']);
$tgl_in = $masuk[2]."-".$masuk[1]."-".$masuk[0]." ".$r2['jamm'];
$tgl_out = $data['tgl_trans_log'];
$diff = date_diff(date_create($tgl_out), date_create($tgl_in));
$hari = $diff->format('%d');
$jam = $diff->format('%h');
if(($hari==0)&&($jam<=24)){
$lama_rawat = "1 Hari";
}else{
$lama_rawat=$diff->format('%d Hari %h Jam %i Menit %s Detik');
}
}
}else{
$masuk = explode('/',$r2['tanggalmasuk']);
$tgl_in = $masuk[2]."-".$masuk[1]."-".$masuk[0]." ".$r2['jamm'];
$tgl_out = $r2['tanggalkeluar'];
$diff = date_diff(date_create($tgl_out), date_create($tgl_in));
$hari = $diff->format('%d');
$jam = $diff->format('%h');
if(($hari==0)&&($jam<=24)){
$lama_rawat = "1 Hari";
}else{
$lama_rawat=$diff->format('%d Hari %h Jam %i Menit %s Detik');
}
}

echo "<tr>
<td>".$r2['tanggalmasuk']."</td>
<td>".$tgl_out."</td>
<td>".$lama_rawat."</td>
<td>".$r2['nomedrek']."</td>
<td>".$r2['nama']."</td>
<td>".$r2['alamat']."</td>
<td>".$r2['domisili']."</td>
<td>".$r2['jamm']."</td>
<td>".$r2['pendistri']."</td>
<td>".$r2['pistri']."</td>
<td>".$r2['asal']."</td>
<td>".$r2['umur']."</td>
<td>".$r2['usuami']."</td>

<td>".$r2['rujukan']."</td>
<td>".$r2['tanggaldaftar']."</td>
<td>".$r2['carakeluar']."</td>
<td>".$r2['jpasien']."</td>
<td>".$r2['dpjp']."</td>
<td>".$r2['carap']."</td>
<td>".$r2['ttl']."</td>
<td>".$r2['jk']."</td>
<td>".$r2['jl']."</td>
<td>".$r2['bb']."</td>
<td>".$r2['tinggi']."</td>
<td>".$r2['ascore']."</td>
<td>".$r2['kelas_rawat']."</td>
<td>".$r2['gol']."</td>
<td>".$r2['nilai_kritis']."</td>
<td>".$r2['jenis']."</td>
<td>".$r2['diagnosam']."</td>
<td>".$r2['diagnosaa']."</td>
<td>".$r2['paeh']."</td>
</tr>";
}
?>
		</tbody>
	</table>
