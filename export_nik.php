<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$awal = isset($_GET['awal']) ? trim($_GET['awal']) : '';
$akhir = isset($_GET['awal']) ? trim($_GET['akhir']) : '';
$akhir_fix = date('Y-m-d',strtotime("+1 day", strtotime($akhir)));
// $data_disduk = $db->prepare("SELECT ld.tanggal_penarikan,p.nomedrek,p.ktp,p.nama FROM `log_disduk` ld INNER JOIN disduk_ktp dk ON(ld.id_log_disduk=dk.id_log_disduk) INNER JOIN pasien p ON(dk.nik=p.ktp) WHERE ld.response='sukses' AND ld.tipe_data='pasien' AND ld.tanggal_penarikan BETWEEN :awal AND :akhir ORDER BY ld.tanggal_penarikan ASC");
$data_disduk = $db->prepare("SELECT ld.tanggal_penarikan,p.nomedrek,p.ktp,p.nama FROM `log_disduk` ld INNER JOIN pasien p ON(ld.ktp=p.ktp) WHERE ld.response='sukses' AND ld.tipe_data='pasien' AND ld.tanggal_penarikan BETWEEN :awal AND :akhir ORDER BY ld.tanggal_penarikan ASC");
$data_disduk->bindParam(":awal",$awal);
$data_disduk->bindParam(":akhir",$akhir_fix);
$data_disduk->execute();
$log = $data_disduk->fetchAll(PDO::FETCH_ASSOC);
//EXCEL
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_penggunaan_nik-".$awal."-".$akhir.".xls");
?>
Rekap Penggunaan NIK <?php echo $awal; ?> sampai dengan <?php echo $akhir; ?>
<table border="1" cellspacing="5" cellpadding="5">
	<tr>
		<th>Tanggal Penarikan</th>
		<th>No.KTP</th>
		<th>No.Rekam Medis</th>
		<th>Nama Pasien</th>
	</tr>
</thead>
<tbody>
	<?php
		foreach ($log as $row) {
			echo "<tr>
				<td>".$row['tanggal_penarikan']."</td>
				<td>'".$row['ktp']."</td>
				<td>".$row['nomedrek']."</td>
				<td>".$row['nama']."</td>
			</tr>";
		}
	?>
</tbody>
</table>
