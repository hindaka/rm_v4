<?php
include "../cek_user.php";
include "../../inc/anggota_check.php";
$id_petugas = $r1['mem_id'];
$alasan_rujuk = isset($_POST['alasan_rujuk']) ? $_POST['alasan_rujuk'] : '';
$id_periksa = isset($_POST['id_periksa']) ? $_POST['id_periksa'] : '';
$id_register = isset($_POST['reg']) ? $_POST['reg'] : '';
$id_dokter = isset($_POST['id_dokter']) ? $_POST['id_dokter'] : '0';
$poli = isset($_POST['poli']) ? $_POST['poli'] : '';
$anamnesa = isset($_POST['anamnesa']) ? htmlentities($_POST['anamnesa']) :'';
$pemeriksaan_fisik = isset($_POST['pemeriksaan_fisik']) ? htmlentities($_POST['pemeriksaan_fisik']) :'';
$pemeriksaan_penunjang = isset($_POST['pemeriksaan_penunjang']) ? htmlentities($_POST['pemeriksaan_penunjang']) : '';
$terapi = isset($_POST['terapi']) ? htmlentities($_POST['terapi']) : '';
$diagnosa_utama = isset($_POST['diagnosa_utama']) ? htmlentities($_POST['diagnosa_utama']) : '';
$utama10 = isset($_POST['utama10']) ? htmlentities($_POST['utama10']) : '';
$diagnosa_tambahan = isset($_POST['diagnosa_tambahan']) ? htmlentities($_POST['diagnosa_tambahan']) : '';
$tambahan10 = isset($_POST['tambahan10']) ? htmlentities($_POST['tambahan10']) : '';
$tindakan = isset($_POST['tindakan']) ? $_POST['tindakan'] : '';
$tindakan_custom = isset($_POST['tindakan_custom']) ? $_POST['tindakan_custom'] : '';
$tindakan9 = isset($_POST['tindakan9']) ? htmlentities($_POST['tindakan9']) : '';
$rencana = isset($_POST['rencana']) ? $_POST['rencana'] : '';
$cara_keluar = isset($_POST['cara_keluar']) ? $_POST['cara_keluar'] : '';
$cara_pulang = isset($_POST['cara_pulang']) ? $_POST['cara_pulang'] : '';
$alasan_rujuk = isset($_POST['alasan_rujuk']) ? $_POST['alasan_rujuk'] : '';
$ranap = isset($_POST['ranap']) ? $_POST['ranap'] : '';
$today = isset($_POST['tgl_pulang']) ? $_POST['tgl_pulang'] : 'Y-m-d H:i:s'; 
try {
  $check_data = $db->query("SELECT COUNT(*) as total FROM rm_resume_pasien_rajal WHERE id_register='".$id_register."' AND id_klinik='".$id_periksa."'");
  $check = $check_data->fetch(PDO::FETCH_ASSOC);
  if($check['total']>0){
    $up = $db->prepare("UPDATE rm_resume_pasien_rajal
      SET poli=:poli,id_dokter=:id_dokter,anamnesa=:anamnesa,pemeriksaan_fisik=:pemeriksaan_fisik,
      pemeriksaan_penunjang=:pemeriksaan_penunjang,terapi=:terapi,
      diagnosa_utama=:diagnosa_utama,utama10=:utama10,
      diagnosa_tambahan=:diagnosa_tambahan,tambahan10=:tambahan10,
      tindakan=:tindakan,tindakan_custom=:tindakan_custom,tindakan9=:tindakan9,rencana=:rencana,
      cara_keluar=:cara_keluar,cara_pulang=:cara_pulang,alasan_rujuk=:alasan_rujuk,ranap=:ranap
      WHERE id_register=:id");
		$up->bindParam(":poli",$poli,PDO::PARAM_STR);
		$up->bindParam(":id_dokter",$id_dokter,PDO::PARAM_INT);
    $up->bindParam(":anamnesa",$anamnesa,PDO::PARAM_STR);
    $up->bindParam(":pemeriksaan_fisik",$pemeriksaan_fisik,PDO::PARAM_STR);
    $up->bindParam(":pemeriksaan_penunjang",$pemeriksaan_penunjang,PDO::PARAM_STR);
    $up->bindParam(":terapi",$terapi,PDO::PARAM_STR);
    $up->bindParam(":diagnosa_utama",$diagnosa_utama,PDO::PARAM_STR);
    $up->bindParam(":utama10",$utama10,PDO::PARAM_STR);
    $up->bindParam(":diagnosa_tambahan",$diagnosa_tambahan,PDO::PARAM_STR);
    $up->bindParam(":tambahan10",$tambahan10,PDO::PARAM_STR);
    $up->bindParam(":tindakan",$tindakan,PDO::PARAM_STR);
		$up->bindParam(":tindakan_custom",$tindakan_custom,PDO::PARAM_STR);
    $up->bindParam(":tindakan9",$tindakan9,PDO::PARAM_STR);
    $up->bindParam(":rencana",$rencana,PDO::PARAM_STR);
    $up->bindParam(":cara_keluar",$cara_keluar,PDO::PARAM_STR);
    $up->bindParam(":cara_pulang",$cara_pulang,PDO::PARAM_STR);
    $up->bindParam(":alasan_rujuk",$alasan_rujuk,PDO::PARAM_STR);
    $up->bindParam(":ranap",$ranap,PDO::PARAM_STR);
    $up->bindParam(":id",$id_register,PDO::PARAM_INT);
    $up->execute();
  }else{
    $stmt = $db->prepare("INSERT INTO `rm_resume_pasien_rajal`(`id_register`,
      `id_klinik`,`id_dokter`,`poli`,`anamnesa`, `pemeriksaan_fisik`,
      `pemeriksaan_penunjang`, `terapi`, `diagnosa_utama`,
      `utama10`, `diagnosa_tambahan`, `tambahan10`,
      `tindakan`,`tindakan_custom`, `tindakan9`, `rencana`,
      `cara_keluar`, `cara_pulang`, `alasan_rujuk`,
      `ranap`, `created_at`) VALUES
      (:id_register,:id_klinik,:id_dokter,:poli,:anamnesa,:pemeriksaan_fisik,:pemeriksaan_penunjang,:terapi,:diagnosa_utama,:utama10,:diagnosa_tambahan,
        :tambahan10,:tindakan,:tindakan_custom,:tindakan9,:rencana,:cara_keluar,:cara_pulang,:alasan_rujuk,:ranap,:created_at)");
    $stmt->bindParam(":id_register",$id_register,PDO::PARAM_INT);
    $stmt->bindParam(":id_klinik",$id_periksa,PDO::PARAM_INT);
		$stmt->bindParam(":id_dokter",$id_dokter,PDO::PARAM_INT);
		$stmt->bindParam(":poli",$poli,PDO::PARAM_STR);
    $stmt->bindParam(":anamnesa",$anamnesa,PDO::PARAM_STR);
    $stmt->bindParam(":pemeriksaan_fisik",$pemeriksaan_fisik,PDO::PARAM_STR);
    $stmt->bindParam(":pemeriksaan_penunjang",$pemeriksaan_penunjang,PDO::PARAM_STR);
    $stmt->bindParam(":terapi",$terapi,PDO::PARAM_STR);
    $stmt->bindParam(":diagnosa_utama",$diagnosa_utama,PDO::PARAM_STR);
    $stmt->bindParam(":utama10",$utama10,PDO::PARAM_STR);
    $stmt->bindParam(":diagnosa_tambahan",$diagnosa_tambahan,PDO::PARAM_STR);
    $stmt->bindParam(":tambahan10",$tambahan10,PDO::PARAM_STR);
    $stmt->bindParam(":tindakan",$tindakan,PDO::PARAM_STR);
		$stmt->bindParam(":tindakan_custom",$tindakan_custom,PDO::PARAM_STR);
    $stmt->bindParam(":tindakan9",$tindakan9,PDO::PARAM_STR);
    $stmt->bindParam(":rencana",$rencana,PDO::PARAM_STR);
    $stmt->bindParam(":cara_keluar",$cara_keluar,PDO::PARAM_STR);
    $stmt->bindParam(":cara_pulang",$cara_pulang,PDO::PARAM_STR);
    $stmt->bindParam(":alasan_rujuk",$alasan_rujuk,PDO::PARAM_STR);
    $stmt->bindParam(":ranap",$ranap,PDO::PARAM_STR);
    $stmt->bindParam(":created_at",$today,PDO::PARAM_STR);
    $stmt->execute();
  }
  $feedback = array(
    "status"=>"sukses",
    "title"=>"Berhasil!!",
    "text"=>"Data Berhasil disimpan",
    "status"=>"success"
  );
  echo json_encode($feedback);
} catch (PDOException $e) {
  $error = $e->getMessage();
  $feedback = array(
    "status"=>"error",
    "title"=>"Gagal!!",
    "text"=>"Data Gagal Disimpan",
    "status"=>"error"
  );
  echo json_encode($feedback);
}
