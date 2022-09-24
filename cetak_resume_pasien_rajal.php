<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$id_periksa=isset($_GET["id"]) ? $_GET['id'] : '';
$id_register = isset($_GET['reg']) ? $_GET['reg'] : '';
$get_head = $db->query("SELECT nama,nomedrek,tanggallahir FROM registerpasien WHERE id_pasien='".$id_register."'");
$head = $get_head->fetch(PDO::FETCH_ASSOC);
$get_resume = $db->query("SELECT rm.*,dok.nama FROM rm_resume_pasien_rajal rm INNER JOIN nmdokter dok ON(rm.id_dokter=dok.id_dokter) WHERE rm.id_register='".$id_register."' ORDER BY last_updated DESC LIMIT 1");
$resume = $get_resume->fetch(PDO::FETCH_ASSOC);
$poli = $resume['poli'];
$anamnesa=$resume['anamnesa'];
$pemeriksaan_fisik = $resume['pemeriksaan_fisik'];
$pemeriksaan_penunjang = $resume['pemeriksaan_penunjang'];
$terapi = $resume['terapi'];
$diagnosa_utama = $resume['diagnosa_utama'];
$utama10 = $resume['utama10'];
$diagnosa_tambahan = $resume['diagnosa_tambahan'];
$tambahan10 = $resume['tambahan10'];
$icd9 = $resume['tindakan9'];
$tindakan_data = ($resume['tindakan']=='null') ? "-" : $resume['tindakan'];
$tindakan_custom = $resume['tindakan_custom'];
$tindakan_data.=",".$tindakan_custom;
$rencana_data = ($resume['rencana']=='null') ? "-" : $resume['rencana'];
$cara_keluar = $resume['cara_keluar'];
$ranap = $resume['ranap'];
if($cara_keluar=='pulang'){
  $keluar = "&#x25FB; Rawat Inap";
  $bersalin = "&#x25FB; Bersalin";
  $perawatan ="&#x25FB; Perawatan";
  $anak = "&#x25FB; Anak";
	$igd = "&#x25FB; IGD";
  $perinatologi = "&#x25FB; Perinatologi";
}else if($cara_keluar=='ranap'){
  $keluar = "&#10004; Rawat Inap";
  if($ranap=='bersalin'){
    $bersalin = "&#10004; Bersalin";
    $perawatan ="&#x25FB; Perawatan";
    $anak = "&#x25FB; Anak";
		$igd = "&#x25FB; IGD";
    $perinatologi = "&#x25FB; Perinatologi";
  }else if($ranap=='igd'){
		$bersalin = "&#x25FB; Bersalin";
    $perawatan ="&#x25FB; Perawatan";
    $anak = "&#x25FB; Anak";
		$igd = "&#10004; IGD";
    $perinatologi = "&#x25FB; Perinatologi";
	}else if($ranap=='perawatan'){
    $bersalin = "&#x25FB; Bersalin";
    $perawatan ="&#10004; Perawatan";
    $anak = "&#x25FB; Anak";
		$igd = "&#x25FB; IGD";
    $perinatologi = "&#x25FB; Perinatologi";
  }else if($ranap=='anak'){
    $bersalin = "&#x25FB; Bersalin";
    $perawatan ="&#x25FB; Perawatan";
    $anak = "&#10004; Anak";
		$igd = "&#x25FB; IGD";
    $perinatologi = "&#x25FB; Perinatologi";
  }else if($ranap=='perinatologi'){
    $bersalin = "&#x25FB; Bersalin";
    $perawatan ="&#x25FB; Perawatan";
    $anak = "&#x25FB; Anak";
		$igd = "&#x25FB; IGD";
    $perinatologi = "&#10004; Perinatologi";
  }else{
    $bersalin = "&#x25FB; Bersalin";
    $perawatan ="&#x25FB; Perawatan";
    $anak = "&#x25FB; Anak";
		$igd = "&#x25FB; IGD";
    $perinatologi = "&#x25FB; Perinatologi";
  }
}else{
  $keluar = "&#x25FB; Rawat Inap";
  $bersalin = "&#x25FB; Bersalin";
  $perawatan ="&#x25FB; Perawatan";
  $perinatologi = "&#x25FB; Perinatologi";
}
$cara_pulang = $resume['cara_pulang'];
$alasan_rujuk = $resume['alasan_rujuk'];
if($cara_pulang=='pulang'){
  $pulang="&nbsp;&nbsp;&#10004; Pulang";
  $rujuk="&nbsp;&nbsp;&#x25FB; Rujuk, alasan ................................";
  $rujuk_balik ="&nbsp;&nbsp;&#x25FB; Rujuk Balik";
}else if($cara_pulang=='rujuk'){
  $pulang="&nbsp;&nbsp;&#x25FB; Pulang";
  $rujuk="&nbsp;&nbsp;&#10004; Rujuk, alasan ".$alasan_rujuk;
  $rujuk_balik ="&nbsp;&nbsp;&#x25FB; Rujuk Balik";
}else if($cara_pulang=='rujuk balik'){
  $pulang="&nbsp;&nbsp;&#x25FB; Pulang";
  $rujuk="&nbsp;&nbsp;&#x25FB; Rujuk, alasan ................................";
  $rujuk_balik ="&nbsp;&nbsp;&#10004; Rujuk Balik";
}else{
  $pulang="&nbsp;&nbsp;&#x25FB; Pulang";
  $rujuk="&nbsp;&nbsp;&#x25FB; Rujuk, alasan ................................";
  $rujuk_balik ="&nbsp;&nbsp;&#x25FB; Rujuk Balik";
}
$dokter = $resume['nama'];
$get_rujukan = $db->query("SELECT * FROM register_rujukan WHERE id_register='".$id_register."'");
$rujukan = $get_rujukan->fetch(PDO::FETCH_ASSOC);
$cetak_tgl = date('d F Y',strtotime($resume['created_at']));
$cetak_jam = date('H:i',strtotime($resume['created_at']));
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cetak Resume Pasien Rawat Jalan</title>
<style>
  .atas{
    border-top:1px solid black;
  }
  .bawah{
    border-bottom: 1px solid black;
  }
  .kiri{
    border-left: 1px solid black;
  }
  .kanan{
    border-right: 1px solid black;
  }
</style>
</head>

<body onload="window.print();window.close();">
  <table cellspacing="0" width="100%" border="0">
    <tr>
      <td colspan="4" style="font-size:12px;">RS KHUSUS IBU DAN ANAK KOTA BANDUNG</td>
    </tr>
    <tr>
      <td colspan="2" rowspan="3" style="text-align:center;" class="atas kiri bawah kanan">
        <div style="font-weight:bold;font-size:24px">RESUME RAWAT JALAN</div>
      </td>
      <td class="atas">Nama</td>
      <td class="atas kanan">: <?php echo $head['nama']; ?></td>
    </tr>
    <tr>
      <td>No.RM</td>
      <td class="kanan">: <?php echo $head['nomedrek']; ?></td>
    </tr>
    <tr>
      <td class="bawah">Tanggal Lahir</td>
      <td class="kanan bawah">: <?php echo $head['tanggallahir']; ?></td>
    </tr>
  </table>
  <table cellspacing="0" width="100%" border="0">
    <tr>
      <td width="25%" class="kiri">Klinik</td>
      <td>:</td>
      <td colspan="3" class="kanan"><?php echo $poli; ?></td>
    </tr>
		<tr>
			<td colspan="5" class="kiri kanan">&nbsp;</td>
		</tr>
    <tr>
      <td class="kiri">Rujukan</td>
      <td>:</td>
      <td colspan="3" class="kanan"><?php echo $rujukan['asal_rujukan']; ?></td>
    </tr>
    <tr>
      <td class="kiri">Tanggal Rujukan</td>
      <td>:</td>
      <td colspan="3" class="kanan"><?php echo date('d F Y',strtotime($rujukan['tanggal_rujukan'])); ?></td>
    </tr>
    <tr>
      <td class="kiri">Diagnosa Rujukan</td>
      <td>:</td>
      <td colspan="3" class="kanan"><?php echo $rujukan['diagnosa_rujukan']; ?></td>
    </tr>
    <tr>
      <td class="kiri">Anamnesa</td>
      <td>:</td>
      <td colspan="3" class="kanan"><?php echo html_entity_decode($anamnesa); ?></td>
    </tr>
    <tr>
      <td class="kiri">Pemeriksaan Fisik</td>
      <td>:</td>
      <td colspan="3" class="kanan"><?php echo html_entity_decode($pemeriksaan_fisik); ?></td>
    </tr>
    <tr>
      <td class="kiri">Pemeriksaan Penunjang</td>
      <td>:</td>
      <td colspan="3" class="kanan"><?php echo html_entity_decode($pemeriksaan_penunjang); ?></td>
    </tr>
    <tr>
      <td class="kiri">Terapi</td>
      <td>:</td>
      <td colspan="3" class="kanan"><?php echo $terapi; ?></td>
    </tr>
    <tr>
      <td class="kiri">Diagnosa Utama</td>
      <td>:</td>
      <td><?php echo html_entity_decode($diagnosa_utama); ?></td>
      <td>ICD 10:</td>
      <td class="kanan" width="20%"><?php echo html_entity_decode($utama10); ?></td>
    </tr>
    <tr>
      <td class="kiri">Diagnosa Tambahan</td>
      <td>:</td>
      <td><?php echo html_entity_decode($diagnosa_tambahan); ?></td>
      <td>ICD 10:</td>
      <td class="kanan" width="20%"><?php echo html_entity_decode($tambahan10); ?></td>
    </tr>
    <tr>
      <td class="kiri">Tindakan</td>
      <td>:</td>
      <td><?php echo html_entity_decode($tindakan_data); ?></td>
      <td>ICD 9 CM:</td>
      <td class="kanan" width="20%"><?php echo html_entity_decode($icd9); ?></td>
    </tr>
		<tr>
			<td colspan="5" class="kiri kanan">&nbsp;</td>
		</tr>
    <tr>
      <td class="kiri">Rencana Tindak Lanjut</td>
      <td>:</td>
      <td colspan="3" class="kanan"><?php echo html_entity_decode($rencana_data); ?></td>
    </tr>
    <tr>
      <td colspan="5" class="kiri kanan">Cara Pulang</td>
    </tr>
    <tr>
      <td class="kiri"><?php echo $pulang; ?></td>
      <td>&nbsp;</td>
      <td style="text-align:right;"><?php echo $keluar; ?></td>
      <td>&nbsp;</td>
      <td class="kanan">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="kiri"><?php echo $rujuk; ?></td>
      <td style="text-align:right;">Ruang :</td>
      <td colspan="2" class="kanan"><?php echo $bersalin; ?></td>
    </tr>
		<tr>
      <td class="kiri">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2" class="kanan"><?php echo $igd; ?></td>
    </tr>
    <tr>
      <td class="kiri"><?php echo $rujuk_balik; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2" class="kanan"><?php echo $perawatan; ?></td>
    </tr>
    <tr>
      <td class="kiri">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2" class="kanan"><?php echo $anak; ?></td>
    </tr>
    <tr>
      <td class="kiri bawah">&nbsp;</td>
      <td class="bawah">&nbsp;</td>
      <td class="bawah">&nbsp;</td>
      <td class="kanan bawah" colspan="2" ><?php echo $perinatologi; ?></td>
    </tr>
  </table>
  <br>
  <table cellspacing="0" width="100%" style="text-align:center" border="0">
    <tr>
      <td width="50%">&nbsp;</td>
      <td>Bandung, <?php echo $cetak_tgl; ?> Jam <?php echo $cetak_jam; ?></td>
    </tr>
    <tr>
      <td width="50%">&nbsp;</td>
      <td>Dokter Penanggung Jawab Pelayanan</td>
    </tr>
    <tr>
      <td width="50%">&nbsp;</td>
      <td style="height:100px">&nbsp;</td>
    </tr>
    <tr>
      <td width="50%">&nbsp;</td>
      <td>(<?php echo $dokter; ?>)</td>
    </tr>
  </table>
</body>
</html>
