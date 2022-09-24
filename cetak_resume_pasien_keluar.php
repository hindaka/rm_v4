<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$id_resume = isset($_GET['rm']) ? $_GET['rm'] : '';
$id_register = isset($_GET['reg']) ? $_GET['reg'] : '';

$get_reg = $db->query("SELECT * FROM registerpasien WHERE id_pasien='".$id_register."'");
$identitas = $get_reg->fetch(PDO::FETCH_ASSOC);
$get_resume = $db->query("SELECT * FROM rm_resume_pasien_ranap rm INNER JOIN nmdokter dok ON(dok.id_dokter=rm.id_dokter) WHERE rm.id_doc_resume='".$id_resume."'");
$resume = $get_resume->fetch(PDO::FETCH_ASSOC);
	if($resume['cara_pulang']=='izin dokter'){
		$carpul ="&#10004; Izin Dokter &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#x25A1; Pindah RS &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#x25A1; Permintaan Sendiri &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#x25A1; Melarikan diri &nbsp;&nbsp;";
	}else if($resume['cara_pulang']=='pindah rs'){
		$carpul ="&#x25A1; Izin Dokter &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#10004; Pindah RS &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#x25A1; Permintaan Sendiri &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#x25A1; Melarikan diri &nbsp;&nbsp;";
	}else if($resume['cara_pulang']=='permintaan sendiri'){
		$carpul ="&#x25A1; Izin Dokter &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#x25A1; Pindah RS &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#10004; Permintaan Sendiri &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#x25A1; Melarikan diri &nbsp;&nbsp;";
	}else if($resume['cara_pulang']=='melarikan diri'){
		$carpul ="&#x25A1; Izin Dokter &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#x25A1; Pindah RS &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#x25A1; Permintaan Sendiri &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#10004; Melarikan diri &nbsp;&nbsp;";
	}else{
		$carpul ="&#x25A1; Izin Dokter &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#x25A1; Pindah RS &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#x25A1; Permintaan Sendiri &nbsp;&nbsp;";
		$carpul.="&nbsp;&nbsp;&#x25A1; Melarikan diri &nbsp;&nbsp;";
	}

	if($resume['kondisi_pulang']=='sembuh'){
		$kondisi ="&#10004; Sembuh &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Perbaikan &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Tidak Sembuh &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Meninggal < 48 jam &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Meninggal > 48 jam &nbsp;&nbsp;";
	}else if($resume['kondisi_pulang']=='perbaikan'){
		$kondisi ="&#x25A1; Sembuh &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#10004; Perbaikan &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Tidak Sembuh &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Meninggal < 48 jam &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Meninggal > 48 jam &nbsp;&nbsp;";
	}else if($resume['kondisi_pulang']=='tidak sembuh'){
		$kondisi ="&#x25A1; Sembuh &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Perbaikan &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#10004; Tidak Sembuh &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Meninggal < 48 jam &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Meninggal > 48 jam &nbsp;&nbsp;";
	}else if($resume['kondisi_pulang']=='meninggal < 48 jam'){
		$kondisi ="&#x25A1; Sembuh &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Perbaikan &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Tidak Sembuh &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#10004; Meninggal < 48 jam &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Meninggal > 48 jam &nbsp;&nbsp;";
	}else if($resume['kondisi_pulang']=='meninggal > 48 jam'){
		$kondisi ="&#x25A1; Sembuh &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Perbaikan &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Tidak Sembuh &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Meninggal < 48 jam &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#10004; Meninggal > 48 jam &nbsp;&nbsp;";
	}else{
		$kondisi ="&#x25A1; Sembuh &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Perbaikan &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Tidak Sembuh &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Meninggal < 48 jam &nbsp;&nbsp;";
		$kondisi.="&nbsp;&nbsp;&#x25A1; Meninggal > 48 jam &nbsp;&nbsp;";
	}
	if($resume['reaksi_obat']=='ya'){
		$reaksi_obat = "&nbsp;&nbsp;&#10004; Ya &nbsp;&nbsp;";
		$reaksi_obat .= "&nbsp;&nbsp;&#x25A1; Tidak &nbsp;&nbsp;";
	}else if($resume['reaksi_obat']=='tidak'){
		$reaksi_obat = "&nbsp;&nbsp;&#x25A1; Ya &nbsp;&nbsp;";
		$reaksi_obat .= "&nbsp;&nbsp;&#10004; Tidak &nbsp;&nbsp;";
	}else{
		$reaksi_obat = "&nbsp;&nbsp;&#x25A1; Ya &nbsp;&nbsp;";
		$reaksi_obat .= "&nbsp;&nbsp;&#x25A1; Tidak &nbsp;&nbsp;";
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- <meta http-equiv="refresh" content="0;url=dtunggu.php" /> -->
<title>RM 3.35 Resume Pasien Keluar</title>
<style type="text/css">
@page{
	margin-left: 2cm;
}
body {
	font-size: 11px;
}
.kanan{
	border-right: 1px solid black;
}
.kiri{
	border-left: 1px solid black;
}
.atas{
	border-top: 1px solid black;
}
.bawah{
	border-bottom: 1px solid black;
}
.pad-all{
	padding: 5px 5px 5px 5px;
}
.text-center{
	text-align: center;
}
.text-right{
	text-align: right;
}
table td{
	padding-left : 10px;
	padding-bottom :5px;
}
.low-bold{
	font-size: 9px;
	font-weight: bold;
}
.head-bold{
	font-size: 18px;
	font-weight: bold;
}
.bold{
	font-weight: bold;
}
</style>
</head>

<body onload="window.print();window.close();">
	<!-- block KOP dokumen -->
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="4" class="low-bold">RS KHUSUS IBU DAN  ANAK KOTA BANDUNG</td>
			<td class="text-right low-bold">RM 3.35</td>
		</tr>
		<tr>
			<td class="atas kiri bawah text-center head-bold" rowspan="3" colspan="2" width="50%"><strong>RESUME PASIEN KELUAR</strong></td>
			<td class="atas kiri" width="20%">Nama</td>
			<td class="atas kanan" colspan="2" width="30%"> :  <?php echo $identitas['nama']; ?> </td>
		</tr>
		<tr>
			<td class="kiri">No.Rekam Medis</td>
			<td class="kanan" colspan="2"> :  <?php echo $identitas['nomedrek']; ?></td>
		</tr>
		<tr>
			<td class="kiri bawah">Tanggal Lahir</td>
			<td class="kanan bawah" colspan="2"> :  <?php echo $identitas['tanggallahir']; ?></td>
		</tr>
		<tr>
			<td class="kiri" colspan="2">Tanggal/Jam Masuk : <?php echo $identitas['tanggaldaftar']." ".$identitas['jamdatang']; ?></td>
			<td>Tanggal/Jam Keluar</td>
			<td class="kanan" colspan="2">: <?php echo date('d/m/Y H:i:s',strtotime($resume['tanggal_keluar'])); ?></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5">Ruang Rawat Terakhir : <?php echo $resume['ruang_terakhir']; ?></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><b>INDIKASI RAWAT INAP :</b></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><?php echo html_entity_decode($resume['indikasi_ranap']); ?></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><b>RINGKASAN RIWAYAT PENYAKIT :</b></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><?php echo html_entity_decode($resume['ringkasan_penyakit']); ?></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><b>PEMERIKSAAN FISIK :</b></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><?php echo html_entity_decode($resume['pemeriksaan_fisik']); ?></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><b>PEMERIKSAAN PENUNJANG :</b></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><?php echo html_entity_decode($resume['pemeriksaan_penunjang']); ?></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><b>TERAPI/PENGOBATAN SELAMA DI RUMAH SAKIT :</b></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><?php echo html_entity_decode($resume['terapi_pengobatan']); ?></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5">
				<b>REAKSI OBAT :</b>
				<?php echo $reaksi_obat; ?>
			</td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5" style="padding-right:5px;">
				Bila Ya:<br>
				<table border="1" cellpadding="0" cellspacing="0" width=100%>
					<thead>
						<tr>
							<th>No</th>
							<th>NAMA OBAT</th>
							<th>MANIFESTASI KLINIS</th>
							<th>KETERANGAN</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=1;
						$daftar_reaksi_obat = json_decode($resume['daftar_reaksi_obat'],true);
							if(!empty($daftar_reaksi_obat)){
								foreach ($daftar_reaksi_obat as $data) {
									echo '<tr>
										<td align="center">'.$i++.'</td>
										<td>'.$data['namaobat'].'</td>
										<td>'.$data['manifes'].'</td>
										<td>'.$data['ket'].'</td>
									</tr>';
								}
							}else{ ?>
								<tr>
									<td style="text-align:center;">-</td>
									<td style="text-align:center;">-</td>
									<td style="text-align:center;">-</td>
									<td style="text-align:center;">-</td>
								</tr>
							<?php } ?>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><b>DIET :</b></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><?php echo html_entity_decode($resume['diet']); ?></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><b>HASIL KONSULTASI :</b></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><?php echo html_entity_decode($resume['hasil_konsultasi']); ?></td>
		</tr>
		<tr>
			<td class="kiri" colspan="3">
				<b>DIAGNOSIS UTAMA :</b>
		 </td>
			<td class="kanan" colspan="2">
				<b>ICD 10 :</b>
			</td>
		</tr>
		<tr>
			<td class="kiri" colspan="3" valign="top">
				<?php echo html_entity_decode($resume['diagnosa_utama']); ?>
		 </td>
			<td class="kanan" colspan="2" valign="top">
				<?php echo html_entity_decode($resume['icd10_utama']); ?>
			</td>
		</tr>
		<tr>
			<td class="kiri" colspan="3">
				<b>DIAGNOSIS TAMBAHAN :</b>
		 </td>
			<td class="kanan" colspan="2">
				<b>ICD 10 :</b>
			</td>
		</tr>
		<tr>
			<td class="kiri" colspan="3" valign="top">
				<?php echo html_entity_decode($resume['diagnosa_tambahan']); ?>
		 </td>
			<td class="kanan" colspan="2" valign="top">
				<?php echo html_entity_decode($resume['icd10_tambahan']); ?>
			</td>
		</tr>
		<tr>
			<td class="kiri" colspan="3">
				<b>TINDAKAN / PROSEDUR / OPERASI :</b>
		 </td>
			<td class="kanan" colspan="2">
				<b>ICD 9 CM :</b>
			</td>
		</tr>
		<tr>
			<td class="kiri" colspan="3" valign="top">
				<?php echo html_entity_decode($resume['tindakan']); ?>
		 </td>
			<td class="kanan" colspan="2" valign="top">
				<?php echo html_entity_decode($resume['icd9']); ?>
			</td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5"><b>INTRUKSI PERAWATAN LANJUTAN / EDUKASI :</b></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5" valign="top"><?php echo html_entity_decode($resume['edukasi']); ?></td>
		</tr>
		<tr>
			<td class="kiri" width="20%">
				<b>CARA PULANG :</b>
			</td>
			<td class="kanan" colspan="4"><?php echo $carpul; ?></td>
		</tr>
		<tr>
			<td class="kiri" width="25%">
				<b>KONDISI SAAT PULANG :</b>
			</td>
			<td class="kanan" colspan="4"><?php echo $kondisi; ?></td>
		</tr>
		<tr>
			<td class="kiri kanan" colspan="5" style="padding-right:5px;">
				<b>TERAPI PULANG :</b>
				<table border="1" cellpadding="0" cellspacing="0" width=100%>
					<thead>
						<tr>
							<th>No</th>
							<th>NAMA OBAT</th>
							<th>JUMLAH</th>
							<th>DOSIS</th>
							<th>FREKUENSI</th>
							<th>CARA PEMBERIAN</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$j=1;
						$terapi_pulang = json_decode($resume['terapi_pulang'],true);
							if(!empty($terapi_pulang)){
								foreach ($terapi_pulang as $t) {
									echo '<tr>
										<td>'.$j++.'</td>
										<td>'.$t['obatpulang'].'</td>
										<td>'.$t['jumlah'].'</td>
										<td>'.$t['dosis'].'</td>
										<td>'.$t['frekuensi'].'</td>
										<td>'.$t['carapemberian'].'</td>
									</tr>';
								}
							}else{ ?>
								<tr>
									<td style="text-align:center;">-</td>
									<td style="text-align:center;">-</td>
									<td style="text-align:center;">-</td>
									<td style="text-align:center;">-</td>
									<td style="text-align:center;">-</td>
									<td style="text-align:center;">-</td>
								</tr>
							<?php } ?>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
		<td class="kiri" colspan="3"><b>KONTROL KE :</b> <span style="background-color:yellow;font-weight:bold;"><?php echo strtoupper($resume['kontrol_ke']); ?></span></td>
			<td class="kanan" colspan="2"><span style="background-color:yellow;font-weight:bold;">Tanggal : <?php echo date('d/m/Y',strtotime($resume['tanggal_kontrol'])); ?> Pukul : <?php echo date('H:i:s',strtotime($resume['tanggal_kontrol'])); ?></span></td>
		</tr>
		<tr>
			<td class="kiri kanan" style="padding-top:5px;padding-bottom:5px;font-weight:bold;" colspan="5">APABILA DALAM KEADAAN EMERGENSI DAPAT MENGHUBUNGI : <span style="background-color:yellow;">IGD RSKIA Kota Bandung (Telp. 022 – 5200505)</span></td>
		</tr>
		<tr>
			<td class="kiri" colspan="1"><b>PROGNOSIS *) :</b></td>
			<td class="kanan" colspan="4">
				<b>Ad Vitam :</b>
				<?php
					if($resume['prognosis_ad_vitam']=='ad bonam'){
						$prog_v ="&#10004; Ad Bonam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#x25A1; Ad Malam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#x25A1; Dubia Ad Bonam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#x25A1; Dubia Ad Malam &nbsp;&nbsp;";
					}else if($resume['prognosis_ad_vitam']=='ad malam'){
						$prog_v ="&#x25A1; Ad Bonam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#10004; Ad Malam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#x25A1; Dubia Ad Bonam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#x25A1; Dubia Ad Malam &nbsp;&nbsp;";
					}else if($resume['prognosis_ad_vitam']=='dubia ad bonam'){
						$prog_v ="&#x25A1; Ad Bonam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#x25A1; Ad Malam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#10004; Dubia Ad Bonam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#x25A1; Dubia Ad Malam &nbsp;&nbsp;";
					}else if($resume['prognosis_ad_vitam']=='dubia ad malam'){
						$prog_v ="&#x25A1; Ad Bonam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#x25A1; Ad Malam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#x25A1; Dubia Ad Bonam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#10004; Dubia Ad Malam &nbsp;&nbsp;";
					}else{
						$prog_v ="&#x25A1; Ad Bonam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#x25A1; Ad Malam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#x25A1; Dubia Ad Bonam &nbsp;&nbsp;";
						$prog_v.="&nbsp;&nbsp;&#x25A1; Dubia Ad Malam &nbsp;&nbsp;";
					}
					echo $prog_v;
				?>
			</td>
		</tr>
		<tr>
			<td class="kiri bawah" colspan="1">&nbsp;</td>
			<td class="kanan bawah" colspan="4">
				<b>Ad Functionam :</b>
				<?php
				if($resume['prognosis_ad_functionam']=='ad bonam'){
					$prog_f ="&#10004; Ad Bonam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#x25A1; Ad Malam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#x25A1; Dubia Ad Bonam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#x25A1; Dubia Ad Malam &nbsp;&nbsp;";
				}else if($resume['prognosis_ad_functionam']=='ad malam'){
					$prog_f ="&#x25A1; Ad Bonam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#10004; Ad Malam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#x25A1; Dubia Ad Bonam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#x25A1; Dubia Ad Malam &nbsp;&nbsp;";
				}else if($resume['prognosis_ad_functionam']=='dubia ad bonam'){
					$prog_f ="&#x25A1; Ad Bonam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#x25A1; Ad Malam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#10004; Dubia Ad Bonam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#x25A1; Dubia Ad Malam &nbsp;&nbsp;";
				}else if($resume['prognosis_ad_functionam']=='dubia ad malam'){
					$prog_f ="&#x25A1; Ad Bonam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#x25A1; Ad Malam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#x25A1; Dubia Ad Bonam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#10004; Dubia Ad Malam &nbsp;&nbsp;";
				}else{
					$prog_f ="&#x25A1; Ad Bonam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#x25A1; Ad Malam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#x25A1; Dubia Ad Bonam &nbsp;&nbsp;";
					$prog_f.="&nbsp;&nbsp;&#x25A1; Dubia Ad Malam &nbsp;&nbsp;";
				}
				echo $prog_f;
				?>
			</td>
		</tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td colspan="3" align="center">Bandung, <?php echo date('d F Y',strtotime($resume['tanggal_keluar'])); ?></td>
			<!-- <td colspan="3" align="center">Bandung, <?php echo date('d F Y',strtotime($resume['last_update'])); ?> Pukul : <?php echo date('H:i:s',strtotime($resume['last_update'])); ?></td> -->
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td colspan="3" align="center">Dokter Penanggung Jawab Pelayanan / Dokter IGD</td>
			<!-- <td colspan="3" align="center">Dokter IGD</td> -->
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td colspan="3" align="center"><p>&nbsp;</p></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td colspan="3" align="center">(<?php echo $resume['nama']; ?>)</td>
		</tr>
	</table>
</body>
</html>
