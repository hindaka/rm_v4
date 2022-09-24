<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$full_today = date('Y-m-d H:i:s');
$id_register = isset($_POST['reg']) ? $_POST['reg'] : '';
$id_dokter = isset($_POST['dpjp']) ? $_POST['dpjp'] : '';
$tanggal_keluar = isset($_POST['tanggal_keluar']) ? $_POST['tanggal_keluar'] : date('Y-m-d H:i:s');
$rawat_terakhir = isset($_POST['rawat_terakhir']) ? $_POST['rawat_terakhir'] : '';
$indikasi_ranap = isset($_POST['indikasi_ranap']) ? htmlentities($_POST['indikasi_ranap']) : '';
$ringkasan_penyakit = isset($_POST['ringkasan_penyakit']) ? htmlentities($_POST['ringkasan_penyakit']) : '';
$pemeriksaan_fisik = isset($_POST['pemeriksaan_fisik']) ? htmlentities($_POST['pemeriksaan_fisik']) : '';
$pemeriksaan_penunjang = isset($_POST['pemeriksaan_penunjang']) ? htmlentities($_POST['pemeriksaan_penunjang']) : '';
$terapi_obat = isset($_POST['terapi_obat']) ? htmlentities($_POST['terapi_obat']) : '';
$reaksi_obat = isset($_POST['reaksi_obat']) ? $_POST['reaksi_obat'] : '';
$diet = isset($_POST['diet']) ? htmlentities($_POST['diet']) : '';
$hasil_konsul = isset($_POST['hasil_konsul']) ? htmlentities($_POST['hasil_konsul']) : '';
$diagnosa_utama = isset($_POST['diagnosa_utama']) ? htmlentities($_POST['diagnosa_utama']) : '';
$icd10_utama = isset($_POST['icd10_utama']) ? htmlentities($_POST['icd10_utama']) : '';
$diagnosa_tambahan = isset($_POST['diagnosa_tambahan']) ? htmlentities($_POST['diagnosa_tambahan']) : '';
$icd10_tambahan = isset($_POST['icd10_tambahan']) ? htmlentities($_POST['icd10_tambahan']) : '';
$tindakan = isset($_POST['tindakan']) ? htmlentities($_POST['tindakan']) : '';
$icd9 = isset($_POST['icd9']) ? htmlentities($_POST['icd9']) : '';
$edukasi = isset($_POST['edukasi']) ? htmlentities($_POST['edukasi']) : '';
$cara_pulang = isset($_POST['cara_pulang']) ? $_POST['cara_pulang'] : '';
$kondisi = isset($_POST['kondisi']) ? $_POST['kondisi'] : '';
$kontrol = isset($_POST['kontrol']) ? $_POST['kontrol'] : '';
$tanggal_kontrol = isset($_POST['tanggal_kontrol']) ? $_POST['tanggal_kontrol'] : '';
$tanggal_kontrol= date('Y-m-d H:i:s',strtotime($tanggal_kontrol));
$prognosis_v = isset($_POST['prognosis_v']) ? $_POST['prognosis_v'] : 'kosong';
$prognosis_f = isset($_POST['prognosis_f']) ? $_POST['prognosis_f'] : 'kosong';
$get_reg = $db->prepare("SELECT * FROM registerpasien WHERE id_pasien=:id_register");
$get_reg->bindParam(":id_register",$id_register);
$get_reg->execute();
$reg = $get_reg->fetch(PDO::FETCH_ASSOC);
$split = explode("/",$reg['tanggaldaftar']);
$tanggal_masuk = $split[2]."-".$split[1]."-".$split[0]." ".$reg['jamdatang'];
//terapi obat
$nama_obat = isset($_POST['namaobat']) ? $_POST['namaobat'] : '';
$manifes = isset($_POST['manifes']) ? $_POST['manifes'] : '';
$ket = isset($_POST['ket']) ? $_POST['ket'] : '';
$group = array();
$daftar_reaksi_obat = array();
if(($nama_obat!='')&&(count($nama_obat)>0)){
	for ($i=0; $i < count($nama_obat) ; $i++) {
		$group[$i] = array(
			'namaobat' => $nama_obat[$i],
			'manifes' => $manifes[$i],
			'ket' => $ket[$i]
		);
		array_push($daftar_reaksi_obat,$group[$i]);
	}
}
$daftar_reaksi_obat = json_encode($daftar_reaksi_obat);
//terapi_pulang
$obatpulang = isset($_POST['obatpulang']) ? $_POST['obatpulang'] : '';
$jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
$dosis = isset($_POST['dosis']) ? $_POST['dosis'] : '';
$frekuensi = isset($_POST['frekuensi']) ? $_POST['frekuensi'] : '';
$carapemberian = isset($_POST['carapemberian']) ? $_POST['carapemberian'] : '';
$new_group = array();
$terapi_pulang = array();
if(($obatpulang!='')&&(count($obatpulang)>0)){
	for ($j=0; $j < count($obatpulang) ; $j++) {
		$new_group[$j] = array(
			'obatpulang' => $obatpulang[$j],
			'jumlah' => $jumlah[$j],
			'dosis' => $dosis[$j],
			'frekuensi' => $frekuensi[$j],
			'carapemberian' => $carapemberian[$j],
		);
		array_push($terapi_pulang,$new_group[$j]);
	}
}
$terapi_pulang = json_encode($terapi_pulang);
$ins = $db->prepare("INSERT INTO `rm_resume_pasien_ranap`
	(`id_register`, `id_dokter`, `tanggal_masuk`,
		`tanggal_keluar`, `ruang_terakhir`,
		`indikasi_ranap`,
		`ringkasan_penyakit`, `pemeriksaan_fisik`, `pemeriksaan_penunjang`,
		`terapi_pengobatan`, `reaksi_obat`, `daftar_reaksi_obat`, `diet`,
		`hasil_konsultasi`, `diagnosa_utama`, `icd10_utama`,
		`diagnosa_tambahan`, `icd10_tambahan`, `tindakan`, `icd9`,
		`edukasi`, `cara_pulang`, `kondisi_pulang`, `terapi_pulang`,
		`kontrol_ke`, `tanggal_kontrol`, `prognosis_ad_vitam`,
		`prognosis_ad_functionam`,`created_at`)
		VALUES(
			:id_register,:id_dokter,:tanggal_masuk,
			:tanggal_keluar,:ruang_terakhir,
			:indikasi_ranap,
		:ringkasan_penyakit,:pemeriksaan_fisik,:pemeriksaan_penunjang,:terapi_pengobatan,:reaksi_obat,:daftar_reaksi_obat,:diet,
	:hasil_konsultasi,:diagnosa_utama,:icd10_utama,
:diagnosa_tambahan,:icd10_tambahan,:tindakan,:icd9,
:edukasi,:cara_pulang,:kondisi_pulang,:terapi_pulang,
:kontrol_ke,:tanggal_kontrol,:prognosis_v,
:prognosis_f,:created_at)");
$ins->bindParam(":id_register",$id_register,PDO::PARAM_INT);
$ins->bindParam(":id_dokter",$id_dokter,PDO::PARAM_INT);
$ins->bindParam(":tanggal_masuk",$tanggal_masuk,PDO::PARAM_STR);
$ins->bindParam(":tanggal_keluar",$tanggal_keluar,PDO::PARAM_STR);
$ins->bindParam(":ruang_terakhir",$rawat_terakhir,PDO::PARAM_STR);
$ins->bindParam(":indikasi_ranap",$indikasi_ranap,PDO::PARAM_STR);
$ins->bindParam(":ringkasan_penyakit",$ringkasan_penyakit,PDO::PARAM_STR);
$ins->bindParam(":pemeriksaan_fisik",$pemeriksaan_fisik,PDO::PARAM_STR);
$ins->bindParam(":pemeriksaan_penunjang",$pemeriksaan_penunjang,PDO::PARAM_STR);
$ins->bindParam(":terapi_pengobatan",$terapi_obat,PDO::PARAM_STR);
$ins->bindParam(":reaksi_obat",$reaksi_obat,PDO::PARAM_STR);
$ins->bindParam(":daftar_reaksi_obat",$daftar_reaksi_obat,PDO::PARAM_STR);
$ins->bindParam(":diet",$diet,PDO::PARAM_STR);
$ins->bindParam(":hasil_konsultasi",$hasil_konsul,PDO::PARAM_STR);
$ins->bindParam(":diagnosa_utama",$diagnosa_utama,PDO::PARAM_STR);
$ins->bindParam(":icd10_utama",$icd10_utama,PDO::PARAM_STR);
$ins->bindParam(":diagnosa_tambahan",$diagnosa_tambahan,PDO::PARAM_STR);
$ins->bindParam(":icd10_tambahan",$icd10_tambahan,PDO::PARAM_STR);
$ins->bindParam(":tindakan",$tindakan,PDO::PARAM_STR);
$ins->bindParam(":icd9",$icd9,PDO::PARAM_STR);
$ins->bindParam(":edukasi",$edukasi,PDO::PARAM_STR);
$ins->bindParam(":cara_pulang",$cara_pulang,PDO::PARAM_STR);
$ins->bindParam(":kondisi_pulang",$kondisi,PDO::PARAM_STR);
$ins->bindParam(":terapi_pulang",$terapi_pulang,PDO::PARAM_STR);
$ins->bindParam(":kontrol_ke",$kontrol,PDO::PARAM_STR);
$ins->bindParam(":tanggal_kontrol",$tanggal_kontrol,PDO::PARAM_STR);
$ins->bindParam(":prognosis_v",$prognosis_v,PDO::PARAM_STR);
$ins->bindParam(":prognosis_f",$prognosis_f,PDO::PARAM_STR);
$ins->bindParam(":created_at",$full_today,PDO::PARAM_STR);
$ins->execute();
$id_resume= $db->lastInsertId();
echo "<script language=\"JavaScript\">window.location = \"cetak_resume_pasien_keluar.php?rm=".$id_resume."&reg=".$id_register."\"</script>";

?>
