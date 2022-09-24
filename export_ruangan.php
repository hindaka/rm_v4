<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$ruang = isset($_GET['ruangan']) ? $_GET['ruangan'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$awal = isset($_GET['tanggalAwal']) ? $_GET['tanggalAwal'] : '';
$akhir = isset($_GET['tanggalAkhir']) ? $_GET['tanggalAkhir'] : '';
$akhir_plus_one = date('Y-m-d', strtotime($akhir . ' +1 day'));
$awal_fix = str_replace("-", "", $awal);
$akhir_fix = str_replace("-", "", $akhir);
if ($filter == 'masuk') {
	$text = "Filter Berdasarkan Tanggal Masuk Pasien Ke Ruangan";
	//filter berdasarkan tanggal masuk
	if ($ruang == 'lantai12') {
		$query = $db->query("SELECT n4.tanggalmasuk,n4.tanggalkeluar,n4.diagnosaa,n4.diagnosam,n4.jamp,n4.jamm,n4.dpjp,n4.asal,n4.carakeluar,n4.id_register,n4.carap,n4.kelas as kelas_pasien,rp.* FROM lantai12 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='2' AND n4.tanggalmasuk BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "'");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 12 (Presiden, Suju & VIP)";
	} else if ($ruang == 'lantai11') {
		$query = $db->query("SELECT n4.tanggalmasuk,n4.tanggalkeluar,n4.diagnosaa,n4.diagnosam,n4.jamp,n4.jamm,n4.dpjp,n4.asal,n4.carakeluar,n4.id_register,n4.carap,n4.kelas as kelas_pasien,rp.* FROM lantai11 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='2' AND CAST(CONCAT(SUBSTRING(n4.tanggalmasuk,1,4),SUBSTRING(n4.tanggalmasuk,6,2),SUBSTRING(n4.tanggalmasuk,9,2)) AS UNSIGNED) >= '" . $awal_fix . "' AND CAST(CONCAT(SUBSTRING(n4.tanggalmasuk,1,4),SUBSTRING(n4.tanggalmasuk,6,2),SUBSTRING(n4.tanggalmasuk,9,2)) AS UNSIGNED) <= '" . $akhir_fix . "'");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 11 (Ranap IPD & Bedah)";
	} elseif ($ruang == 'nifas4') {
		$query = $db->query("SELECT n4.tanggalmasuk,n4.tanggalkeluar,n4.diagnosaa,n4.diagnosam,n4.jamp,n4.jamm,n4.dpjp,n4.asal,n4.carakeluar,n4.id_register,n4.carap,n4.kelas as kelas_pasien,rp.* FROM nifas4 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='2' AND CAST(CONCAT(SUBSTRING(n4.tanggalmasuk,7,4),SUBSTRING(n4.tanggalmasuk,4,2),SUBSTRING(n4.tanggalmasuk,1,2)) AS UNSIGNED) >= '" . $awal_fix . "' AND CAST(CONCAT(SUBSTRING(n4.tanggalmasuk,7,4),SUBSTRING(n4.tanggalmasuk,4,2),SUBSTRING(n4.tanggalmasuk,1,2)) AS UNSIGNED) <= '" . $akhir_fix . "'");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 10 (Ranap Ibu)";
	} elseif ($ruang == 'anak') {
		$query = $db->query("SELECT a.*,a.kelas as kelas_anak,rp.* FROM anak a LEFT JOIN registerpasien rp ON(a.id_register=rp.id_pasien) WHERE a.status='2' AND CAST(CONCAT(SUBSTRING(a.tanggalmasuk,7,4),SUBSTRING(a.tanggalmasuk,4,2),SUBSTRING(a.tanggalmasuk,1,2)) as UNSIGNED) >= '" . $awal_fix . "' AND CAST(CONCAT(SUBSTRING(a.tanggalmasuk,7,4),SUBSTRING(a.tanggalmasuk,4,2),SUBSTRING(a.tanggalmasuk,1,2)) as UNSIGNED) <='" . $akhir_fix . "'");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 9 (Ranap Anak)";
	} elseif ($ruang == 'lantai8') {
		$query = $db->query("SELECT p.*,rp.*,p.kelas as 'kelas_pasien' FROM `lantai8` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND CAST(CONCAT(SUBSTRING(p.tanggalmasuk,7,4),SUBSTRING(p.tanggalmasuk,4,2),SUBSTRING(p.tanggalmasuk,1,2)) AS UNSIGNED) >='" . $awal_fix . "' AND CAST(CONCAT(SUBSTRING(p.tanggalmasuk,7,4),SUBSTRING(p.tanggalmasuk,4,2),SUBSTRING(p.tanggalmasuk,1,2)) AS UNSIGNED) <='" . $akhir_fix . "'");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text = "Lantai 8 (Ranap)";
	} elseif ($ruang == 'vk') {
		$query = $db->query("SELECT p.dpjpp,p.bidan,p.ttl,p.tanggalmasuk,p.tanggalkeluar,p.diagnosaa,p.diagnosam,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,rp.*,p.kelas as 'kelas_pasien' FROM `vk` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND p.tanggalmasuk BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "'");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 7 (Ruang Bersalin)";
	} elseif ($ruang == 'peri') {
		$query = $db->query("SELECT p.*,rp.*,p.kelas as 'kelas_peri' FROM `peri` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND p.tanggalmasuk BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "'");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 7 (Perinatologi)";
	} elseif ($ruang == 'ok') {
		$query = $db->query("SELECT p.ttl,p.tanggalok as tanggalmasuk,p.tanggalkeluar,p.diagnosaa,p.diagnosam,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,p.operasi,p.tindakan,rp.* FROM `ok` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND p.tanggalok BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "'");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 5 (Ruang Operasi)";
	} elseif ($ruang == 'icu') {
		$query = $db->query("SELECT p.tanggalicu as tanggalmasuk,p.tanggalkeluar,p.diagnosaa,p.diagnosam,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,rp.* FROM `icu` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND p.tanggalicu BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "'");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 4 (ICU)";
	} elseif ($ruang == 'nicu') {
		$query = $db->query("SELECT p.*,rp.*,p.kelas as 'kelas_pasien' FROM `nicu` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND p.tanggalmasuk BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "'");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 4 (NICU)";
	} elseif ($ruang == 'picu') {
		$query = $db->query("SELECT p.*,rp.*,p.kelas as 'kelas_pasien' FROM `picu` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND p.tanggalmasuk BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "'");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 4 (PICU)";	
	} elseif ($ruang == 'igd') {
		$query = $db->query("SELECT p.ttl,p.tanggaligd as tanggalmasuk,p.tanggalkeluar,p.diagnosa_awal as diagnosam,p.diagnosa_akhir as diagnosaa,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,rp.*,p.kelas as 'kelas_pasien' FROM `igd` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND CAST(CONCAT(SUBSTRING(p.tanggaligd,7,4),SUBSTRING(p.tanggaligd,4,2),SUBSTRING(p.tanggaligd,1,2)) AS UNSIGNED) >='" . $awal_fix . "' AND CAST(CONCAT(SUBSTRING(p.tanggaligd,7,4),SUBSTRING(p.tanggaligd,4,2),SUBSTRING(p.tanggaligd,1,2)) AS UNSIGNED) <='" . $akhir_fix . "'");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai Ground (IGD)";
	} else {
	}
} elseif ($filter == 'keluar') {
	//filter berdasarkan tanggal keluar
	$text = "Filter Berdasarkan Tanggal Keluar Pasien dari Ruangan";
	if ($ruang == 'lantai12') {
		$query = $db->query("SELECT n4.tanggalmasuk,n4.tanggalkeluar,n4.diagnosaa,n4.diagnosam,n4.jamp,n4.jamm,n4.dpjp,n4.asal,n4.carakeluar,n4.id_register,n4.carap,n4.kelas as kelas_pasien,rp.* FROM lantai12 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='2' AND tanggalkeluar BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "' ORDER BY tanggalkeluar ASC");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 12 (Ranap Presiden, Suju & VIP)";
	} else if ($ruang == 'lantai11') {
		$query = $db->query("SELECT n4.tanggalmasuk,n4.tanggalkeluar,n4.diagnosaa,n4.diagnosam,n4.jamp,n4.jamm,n4.dpjp,n4.asal,n4.carakeluar,n4.id_register,n4.carap,n4.kelas as kelas_pasien,rp.* FROM lantai11 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='2' AND tanggalkeluar BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "' ORDER BY tanggalkeluar ASC");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 11 (Ranap IPD & Bedah)";
	} else if ($ruang == 'nifas4') {
		$query = $db->query("SELECT n4.tanggalmasuk,n4.tanggalkeluar,n4.diagnosaa,n4.diagnosam,n4.jamp,n4.jamm,n4.dpjp,n4.asal,n4.carakeluar,n4.id_register,n4.carap,n4.kelas as kelas_pasien,rp.* FROM nifas4 n4 INNER JOIN registerpasien rp ON(n4.id_register=rp.id_pasien) WHERE n4.status='2' AND tanggalkeluar BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "' ORDER BY tanggalkeluar ASC");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 10 (Ranap Ibu)";
	} elseif ($ruang == 'anak') {
		$query = $db->query("SELECT a.*,a.kelas as kelas_anak,rp.* FROM anak a LEFT JOIN registerpasien rp ON(a.id_register=rp.id_pasien) WHERE a.status='2' AND tanggalkeluar BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "' ORDER BY tanggalkeluar ASC");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 9 (Ranap Anak)";
	} elseif ($ruang == 'lantai8') {
		$query = $db->query("SELECT p.*,rp.*,p.kelas as 'kelas_pasien' FROM `lantai8` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND tanggalkeluar BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "' ORDER BY tanggalkeluar ASC");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 8 (Ranap)";
	} elseif ($ruang == 'vk') {
		$query = $db->query("SELECT p.dpjpp,p.bidan,p.ttl,p.tanggalmasuk,p.tanggalkeluar,p.diagnosaa,p.diagnosam,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,rp.*,p.kelas as 'kelas_pasien' FROM `vk` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND tanggalkeluar BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "' ORDER BY tanggalkeluar ASC");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 7 (Ruang Bersalin)";
	} elseif ($ruang == 'peri') {
		$query = $db->query("SELECT p.*,rp.*,p.kelas as 'kelas_peri' FROM `peri` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND tanggalkeluar BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "' ORDER BY tanggalkeluar ASC");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 7 (Perinatologi)";
	} elseif ($ruang == 'ok') {
		$query = $db->query("SELECT p.ttl,p.tanggalok as tanggalmasuk,p.tanggalkeluar,p.diagnosaa,p.diagnosam,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,p.operasi,p.tindakan,rp.* FROM `ok` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND tanggalkeluar BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "' ORDER BY tanggalkeluar ASC");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 5 (Ruang Operasi)";
	} elseif ($ruang == 'icu') {
		$query = $db->query("SELECT p.tanggalicu as tanggalmasuk,p.tanggalkeluar,p.diagnosaa,p.diagnosam,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,rp.* FROM `icu` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND tanggalkeluar BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "' ORDER BY tanggalkeluar ASC");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 4 (ICU)";
	} elseif ($ruang == 'nicu') {
		$query = $db->query("SELECT p.*,rp.*,p.kelas as 'kelas_pasien' FROM `nicu` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND tanggalkeluar BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "' ORDER BY tanggalkeluar ASC");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 4 (NICU)";
	} elseif ($ruang == 'picu') {
		$query = $db->query("SELECT p.*,rp.*,p.kelas as 'kelas_pasien' FROM `picu` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND tanggalkeluar BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "' ORDER BY tanggalkeluar ASC");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai 4 (PICU)";
	} elseif ($ruang == 'igd') {
		$query = $db->query("SELECT p.ttl,p.tanggaligd as tanggalmasuk,p.tanggalkeluar,p.diagnosa_awal as diagnosam,p.diagnosa_akhir as diagnosaa,p.dpjp,p.jamm,p.jamp,p.asal,p.id_register,p.carakeluar,rp.*,p.kelas as 'kelas_pasien' FROM `igd` p INNER JOIN registerpasien rp ON(rp.id_pasien=p.id_register) WHERE p.status=2 AND tanggalkeluar BETWEEN '" . $awal . "' AND '" . $akhir_plus_one . "' ORDER BY tanggalkeluar ASC");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		$text_ruangan = "Lantai Ground (IGD)";
	} else {
	}
} else {
	header("Location: reg_ruangan.php");
}
//EXCEL
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=register-ruangan-" . $ruang . ".xls");
?>
Data Register Ruangan (<?php echo strtoupper($ruang); ?>) / (PERIODE : <?php echo $awal . " - " . $akhir; ?>)<br>
<?php
echo $text; ?>
<table border="1">
	<thead>
		<tr class="info">
			<th>Tanggal Masuk</th>
			<th>Tanggal Keluar</th>
			<th>Lama Rawat</th>
			<th>No. RM</th>
			<th>Nama</th>
			<th>Jenis Kelamin</th>
			<th>Alamat</th>
			<th>Telepon</th>
			<th>Kelurahan</th>
			<th>Kecamatan</th>
			<th>Domisili</th>
			<th>Jam masuk</th>
			<th>Pendidikan</th>
			<th>Pekerjaan</th>
			<th>Asal ruangan</th>
			<th>Umur pasien</th>
			<th>Umur suami</th>
			<th>Rujukan dari</th>
			<th>Tanggal daftar</th>
			<th>Cara Persalinan</th>
			<th>Kelas</th>
			<th>Jenis Operasi</th>
			<th>Tindakan</th>
			<th>Cara keluar</th>
			<th>Cara bayar</th>
			<th>DPJP</th>
			<th>DPJP Penolong</th>
			<th>Bidan Penolong</th>
			<th>Diagnosa Awal</th>
			<th>Diagnosa Akhir</th>
			<th>Tanggal Lahir Bayi</th>
			<th>BB</th>
			<th>Afgar Score</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($data as $r2) {
			if (strlen($r2['tanggalmasuk']) == 10) {
				if ($ruang == 'lantai11') {
					if($pos = strpos($r2['tanggalmasuk'],'/')){
						$masuk = explode("/", $r2['tanggalmasuk']);
						$tgl_in = $masuk[2] . "-" . $masuk[1] . "-" . $masuk[0] . " " . $r2['jamm'];
					}else{
						$tgl_in = $r2['tanggalmasuk'] . " " . $r2['jamm'];
					}
				} else {
					if($pos = strpos($r2['tanggalmasuk'],'/')){
						$masuk = explode("/", $r2['tanggalmasuk']);
						$tgl_in = $masuk[2] . "-" . $masuk[1] . "-" . $masuk[0] . " " . $r2['jamm'];
					}else{
						$tgl_in = $r2['tanggalmasuk'] . " " . $r2['jamm'];
					}
				}
			} else {
				$masuk = $r2['tanggalmasuk'];
				$tgl_in = $masuk;
			}
			if ($r2['tanggalkeluar'] == "0000-00-00 00:00:00") {
				$check = $db->query("SELECT COUNT(*) as total FROM log_trans_pasien WHERE id_register='" . $r2['id_register'] . "' AND keluar LIKE '%" . $r2['carakeluar'] . "%'");
				$ch = $check->fetch(PDO::FETCH_ASSOC);
				if ($ch['total'] == 0) {
					$tgl_out = $r2['tanggalkeluar'];
					$lama_rawat = "unknown";
				} else {
					$get_data = $db->query("SELECT * FROM log_trans_pasien WHERE id_register='" . $r2['id_register'] . "' AND keluar LIKE '%" . $r2['carakeluar'] . "%'");
					$data = $get_data->fetch(PDO::FETCH_ASSOC);
					$tgl_out = $data['tgl_trans_log'];
					$diff = date_diff(date_create($tgl_out), date_create($tgl_in));
					$hari = $diff->format('%d');
					$jam = $diff->format('%h');
					if (($hari == 0) && ($jam <= 24)) {
						$lama_rawat = "1 Hari";
					} else {
						$lama_rawat = $diff->format('%d Hari %h Jam %i Menit %s Detik');
					}
				}
			} else {
				$tgl_out = $r2['tanggalkeluar'];
				$diff = date_diff(date_create($tgl_out), date_create($tgl_in));
				$hari = $diff->format('%d');
				$jam = $diff->format('%h');
				if (($hari == 0) && ($jam <= 24)) {
					$lama_rawat = "1 Hari";
				} else {
					$lama_rawat = $diff->format('%d Hari %h Jam %i Menit %s Detik');
				}
			}
			$carap = isset($r2['carap']) ? $r2['carap'] : '-';
			$kelas_pasien = isset($r2['kelas_pasien']) ? $r2['kelas_pasien'] : '-';
			$jenis_operasi = isset($r2['operasi']) ? $r2['operasi'] : '-';
			$tindakan = isset($r2['tindakan']) ? $r2['tindakan'] : '';
			$dpjpp = isset($r2['dpjpp']) ? $r2['dpjpp'] : '';
			$bidan = isset($r2['bidan']) ? $r2['bidan'] : '';
			$ttl = isset($r2['ttl']) ? $r2['ttl'] : '';
			$bb = isset($r2['bb']) ? $r2['bb'] : '';
			$afgar = isset($r2['ascore']) ? $r2['ascore'] : '';
			$afgar_format = str_replace("//","/",$afgar);
			echo "<tr>
		<td>" . $r2['tanggalmasuk'] . "</td>
		<td>" . $tgl_out . "</td>
		<td>" . $lama_rawat . "</td>
		<td>" . $r2['nomedrek'] . "</td>
		<td>" . $r2['nama'] . "</td>
		<td>" . $r2['kelamin'] . "</td>
		<td>" . $r2['alamat'] . "</td>
		<td>" . $r2['telpp'] . "</td>
		<td>" . $r2['kelurahan'] . "</td>
		<td>" . $r2['kecamatan'] . "</td>
		<td>" . $r2['domisili'] . "</td>
		<td>" . $r2['jamm'] . "</td>
		<td>" . $r2['pendistri'] . "</td>
		<td>" . $r2['pistri'] . "</td>
		<td>" . $r2['asal'] . "</td>
		<td>" . $r2['umur'] . "</td>
		<td>" . $r2['usuami'] . "</td>
		<td>" . $r2['rujukan'] . "</td>
		<td>" . $r2['tanggaldaftar'] . "</td>
		<td>" . $carap . "</td>
		<td>" . $kelas_pasien . "</td>
		<td>" . $jenis_operasi . "</td>
		<td>" . $tindakan . "</td>
		<td>" . $r2['carakeluar'] . "</td>
		<td>" . $r2['jpasien'] . "</td>
		<td>" . $r2['dpjp'] . "</td>
		<td>" . $dpjpp . "</td>
		<td>" . $bidan . "</td>
		<td>" . $r2['diagnosam'] . "</td>
		<td>" . $r2['diagnosaa'] . "</td>
		<td>" . $ttl . "</td>
		<td>" . $bb . "</td>
		<td>" . $afgar_format . "</td>
	</tr>";
		}
		?>
	</tbody>
</table>