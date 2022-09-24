<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$id_pulang = isset($_POST['id_pulang']) ? trim($_POST['id_pulang']) : '';
$icd9 = isset($_POST['icd']) ? trim($_POST['icd']) : '';
$arr_icd9 = explode(",", $icd9);
$total_data = count($arr_icd9);
if ($total_data > 0) {
	for ($i = 0; $i < $total_data; $i++) {
		$split = explode("|", $arr_icd9[$i]);
		$nama_prosedur = trim($split[0]);
		$icd_prosedur = trim($split[1]);
		$check = $db->query("SELECT COUNT(*) as total FROM registerpasien_prosedur WHERE id_pulang='" . $id_pulang . "' AND nama_prosedur='" . $nama_prosedur . "' AND icd_prosedur='" . $icd_prosedur . "'");
		$c = $check->fetch(PDO::FETCH_ASSOC);
		if ($c['total'] == 0) {
			//insert into register_final
			$final = $db->prepare("INSERT INTO `registerpasien_prosedur`(`id_pulang`, `nama_prosedur`, `icd_prosedur`)VALUES (:pul,:nama,:icd)");
			$final->bindParam(":pul", $id_pulang, PDO::PARAM_INT);
			$final->bindParam(":nama", $nama_prosedur, PDO::PARAM_STR);
			$final->bindParam(":icd", $icd_prosedur, PDO::PARAM_STR);
			$final->execute();
		} 
	}
}
$str = "Data Berhasil Disimpan";
$feedback = [
	"title"=>"Berhasil!",
	"msg"=>"Data Berhasil disimpan",
	"icon"=>"success",
];
echo json_encode($feedback);
