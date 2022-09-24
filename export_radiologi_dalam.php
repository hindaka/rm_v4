<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$get_data = $db->prepare("SELECT r.tanggal,p.nomedrek,p.nama,p.domisili,p.kelamin,p.alamat,r.asal,r.dokter,rp.jenisperiksa FROM `radiologi` r INNER JOIN pasien p ON(r.nomedrek=p.nomedrek) INNER JOIN radiologi_p rp ON(r.id_radiologi=rp.id_radiologi) WHERE SUBSTRING(tanggal,4,2)=:bulan AND SUBSTRING(tanggal,7,4)=:tahun AND r.status='2'");
$get_data->bindParam(":bulan",$bulan,PDO::PARAM_STR);
$get_data->bindParam(":tahun",$tahun,PDO::PARAM_STR);
$get_data->execute();
$data = $get_data->fetchAll(PDO::FETCH_ASSOC);
//EXCEL
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=register_radiologi_dalam-".$bulan."-".$tahun.".xls");
?>
Data Register Radiologi bulan <?php echo $bulan; ?> tahun <?php echo $tahun; ?>
<table border="1">
	<thead>
		<tr class="bg-blue">
			<th>Tanggal Radiologi</th>
			<th>No.Rekam Medis</th>
			<th>Nama Pasien</th>
			<th>Asal Pasien</th>
			<th>Alamat</th>
			<th>Domisi</th>
			<th>Dokter</th>
			<th>Pemeriksaan</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($data as $row) {
				echo '<tr>
							<td>'.$row['tanggal'].'</td>
							<td>\''.$row['nomedrek'].'</td>
							<td>'.$row['nama'].'</td>
							<td>'.$row['asal'].'</td>
							<td>'.$row['alamat'].'</td>
							<td>'.$row['domisili'].'</td>
							<td>'.$row['dokter'].'</td>
							<td>'.$row['jenisperiksa'].'</td>
						</tr>';
			}
		?>
	</tbody>
</table>
