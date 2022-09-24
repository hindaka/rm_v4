<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$ruang = isset($_GET['ruangan']) ? $_GET['ruangan'] : '';
$awal = isset($_GET['tanggalAwal']) ? $_GET['tanggalAwal'] : '';
$akhir = isset($_GET['tanggalAkhir']) ? $_GET['tanggalAkhir'] : '';
$akhir_plus_one = date('Y-m-d', strtotime($akhir . ' +1 day'));
$awal_fix = str_replace("-","",$awal);
$akhir_fix = str_replace("-","",$akhir);
$get_imunisasi = $db->query("SELECT * FROM riwayat_imunisasi r INNER JOIN registerpasien rp ON(r.id_register=rp.id_pasien) WHERE ktujuan LIKE '".$ruang."' AND r.created_at BETWEEN '".$awal."' AND '".$akhir_plus_one."'");
$data = $get_imunisasi->fetchAll(PDO::FETCH_ASSOC);
//EXCEL
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=register-imunisasi-".$ruang.".xls");
?>
Data Register Imunisasi POLI (<?php echo strtoupper($ruang); ?>) / (PERIODE : <?php echo $awal." - ".$akhir; ?>)<br>
<table id="example1" border="1" cellpadding="5" cellspacing="5">
	<thead>
		<tr class="info">
			<th>Tanggal Imunisasi</th>
			<th>No. RM</th>
			<th>Nama</th>
			<th>Tanggal Lahir</th>
			<th>Jenis Kelamin</th>
			<th>Alamat</th>
			<th>Kelurahan</th>
			<th>Kecamatan</th>
			<th>Domisili</th>
			<th>Jenis Imunisasi</th>
			<th>Umur</th>
			<th>Nama Penanggungjawab</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($data as $r2) {
		echo "<tr>
						<td>".$r2['waktu_pemberian']."</td>
						<td>".$r2['nomedrek']."</td>
						<td>".$r2['nama']."</td>
						<td>".$r2['tanggallahir']."</td>
						<td>".$r2['kelamin']."</td>
						<td>".$r2['alamat']."</td>
						<td>".$r2['kelurahan']."</td>
						<td>".$r2['kecamatan']."</td>
						<td>".$r2['domisili']."</td>
						<td>".$r2['jenis_imunisasi']."</td>
						<td>".$r2['umur']."</td>
						<td>".$r2['namapp']."</td>
				</tr>";
	}
	?>
	</tbody>
</table>
