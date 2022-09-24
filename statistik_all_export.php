<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$awal = isset($_GET['awal']) ? trim($_GET['awal']) : '';
$akhir = isset($_GET['akhir']) ? trim($_GET['akhir']) : '';
$statistik = isset($_GET['statistik']) ? trim($_GET['statistik']) : '';
$filter_kelamin = false;
if ($statistik == "rajalAll") {
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) WHERE rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC");
	$q->bindParam(':awal', $awal, PDO::PARAM_STR);
	$q->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Dalam kota' AND rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC");
	$dalam_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Luar kota' AND rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC");
	$luar_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$title = "Seluruh Kasus Pada Pasien Rawat Jalan";
	$filter_kelamin = false;
} elseif ($statistik == "ranapAll") {
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) WHERE rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC");
	$q->bindParam(':awal', $awal, PDO::PARAM_STR);
	$q->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Dalam kota' AND rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC");
	$dalam_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Luar kota' AND rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC");
	$luar_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$title = "Seluruh Kasus Pada Pasien Rawat Inap";
	$filter_kelamin = false;
} elseif ($statistik == "10rajal") {
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd,COUNT( CASE WHEN r.kelamin='Laki-laki' THEN 1 ELSE NULL END) as laki,COUNT( CASE WHEN r.kelamin='Perempuan' THEN 1 ELSE NULL END) as perempuan,COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE rp.kasus='Baru' AND rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') GROUP BY f.kode_icd ORDER BY total DESC LIMIT 10");
	$q->bindParam(':awal', $awal, PDO::PARAM_STR);
	$q->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd,COUNT( CASE WHEN r.kelamin='Laki-laki' THEN 1 ELSE NULL END) as laki,COUNT( CASE WHEN r.kelamin='Perempuan' THEN 1 ELSE NULL END) as perempuan,COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE rp.kasus='Baru' AND r.domisili='Dalam kota' AND rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') GROUP BY f.kode_icd ORDER BY total DESC LIMIT 10");
	$dalam_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd,COUNT( CASE WHEN r.kelamin='Laki-laki' THEN 1 ELSE NULL END) as laki,COUNT( CASE WHEN r.kelamin='Perempuan' THEN 1 ELSE NULL END) as perempuan,COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE rp.kasus='Baru' AND r.domisili='Luar kota' AND rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') GROUP BY f.kode_icd ORDER BY total DESC LIMIT 10");
	$luar_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$title = "10 Kasus Terbanyak Pada Pasien Rawat Jalan (Kasus Baru)";
	$filter_kelamin = true;
} elseif ($statistik == "10ranap") {
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd,COUNT( CASE WHEN r.kelamin='Laki-laki' THEN 1 ELSE NULL END) as laki,COUNT( CASE WHEN r.kelamin='Perempuan' THEN 1 ELSE NULL END) as perempuan,COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') GROUP BY f.kode_icd ORDER BY total DESC LIMIT 10");
	$q->bindParam(':awal', $awal, PDO::PARAM_STR);
	$q->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd,COUNT( CASE WHEN r.kelamin='Laki-laki' THEN 1 ELSE NULL END) as laki,COUNT( CASE WHEN r.kelamin='Perempuan' THEN 1 ELSE NULL END) as perempuan,COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Dalam kota' AND rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') GROUP BY f.kode_icd ORDER BY total DESC LIMIT 10");
	$dalam_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd,COUNT( CASE WHEN r.kelamin='Laki-laki' THEN 1 ELSE NULL END) as laki,COUNT( CASE WHEN r.kelamin='Perempuan' THEN 1 ELSE NULL END) as perempuan,COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Luar kota' AND rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') GROUP BY f.kode_icd ORDER BY total DESC LIMIT 10");
	$luar_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$title = "10 Kasus Terbanyak Pada Pasien Rawat Inap";
	$filter_kelamin = true;
} elseif ($statistik == "21all") {
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) WHERE rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$q->bindParam(':awal', $awal, PDO::PARAM_STR);
	$q->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Dalam kota' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$dalam_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Luar kota' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$luar_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$title = "21 kasus Terbanyak Pada Pasien Rawat Jalan & Rawat Inap";
	$filter_kelamin = false;
} elseif ($statistik == "21rajal") {
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) WHERE rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$q->bindParam(':awal', $awal, PDO::PARAM_STR);
	$q->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Dalam kota' AND rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$dalam_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Luar kota' AND rp.jenis_rawat='rajal' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$luar_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$title = "21 kasus Terbanyak Pada Pasien Rawat Jalan";
	$filter_kelamin = false;
} elseif ($statistik == "21ranap") {
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) WHERE rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$q->bindParam(':awal', $awal, PDO::PARAM_STR);
	$q->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Dalam kota' AND rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$dalam_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Luar kota' AND rp.jenis_rawat='ranap' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$luar_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$title = "21 kasus Terbanyak Pada Pasien Rawat Inap";
	$filter_kelamin = false;
} else {
	$q = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) WHERE rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$q->bindParam(':awal', $awal, PDO::PARAM_STR);
	$q->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$dalam_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Dalam kota' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$dalam_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$dalam_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$luar_kota = $db->prepare("select f.diagnosa_utama,f.kode_icd, COUNT(f.diagnosa_utama) as total FROM registerpasien_final f INNER JOIN registerpasien_pulang rp ON(f.id_pulang=rp.id_pulang) INNER JOIN registerpasien r ON(r.id_pasien=rp.id_register) WHERE r.domisili='Luar kota' AND rp.tgl_pulang BETWEEN :awal AND :akhir AND f.kode_icd NOT IN(SELECT icd FROM diag WHERE eksklusi_statistik='y') Group BY f.kode_icd ORDER BY total DESC LIMIT 21");
	$luar_kota->bindParam(':awal', $awal, PDO::PARAM_STR);
	$luar_kota->bindParam(':akhir', $akhir, PDO::PARAM_STR);
	$title = "21 kasus Terbanyak Pada Pasien Rawat Jalan & Rawat Inap";
	$filter_kelamin = false;
}

$q->execute();
$luar_kota->execute();
$dalam_kota->execute();
$stat = $q->fetchAll(PDO::FETCH_ASSOC);
$dalam = $dalam_kota->fetchAll(PDO::FETCH_ASSOC);
$luar = $luar_kota->fetchAll(PDO::FETCH_ASSOC);
// EXCEL
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$title $awal - $akhir.xls");

?>
<table style="border-collapse: collapse; width: 100%;" border="0">
	<tbody>
		<tr>
			<td style="width: 100%;" colspan="9">
				<b><?php echo $title; ?></b>
			</td>
		</tr>
	</tbody>
</table>
<table id="example1" class="table table-hover table-striped" border="1">
	<thead>
		<tr class="info">
			<th>Kode ICD</th>
			<th>Diagnosa Utama</th>
			<?php
			if ($filter_kelamin == true) {
				echo "<th>Laki-laki</th>
				<th>Perempuan</th>";
			}
			?>
			<th>Jumlah Kasus</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($stat as $row) {
			if ($filter_kelamin == true) {
				echo "<tr>
				<td>" . $row['kode_icd'] . "</td>
					<td>" . $row['diagnosa_utama'] . "</td>
					<td>" . $row['laki'] . "</td>
					<td>" . $row['perempuan'] . "</td>
					<td>" . $row['total'] . "</td>
				</tr>";
			} else {
				echo "<tr>
					<td>" . $row['kode_icd'] . "</td>
						<td>" . $row['diagnosa_utama'] . "</td>
						<td>" . $row['total'] . "</td>
					</tr>";
			}
		}
		?>
	</tbody>
</table>