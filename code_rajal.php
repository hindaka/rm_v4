<?php
include "cek_user.php";
include "../inc/anggota_check.php";

$id_pulang = isset($_POST['id_pulang']) ? trim($_POST['id_pulang']) : '';
$du = isset($_POST['diagnosa_utama']) ? trim($_POST['diagnosa_utama']) : '';
$dt = isset($_POST['diagnosa_tambahan']) ? trim($_POST['diagnosa_tambahan']) : '';
$kasus = isset($_POST['kasus']) ? trim($_POST['kasus']) : '';
$split = explode("|",$du);
if(count($split)>1){
	$diagnosa = trim($split[0]);
	$kode_icd = trim($split[1]);
	$check_icd = $db->query("SELECT * FROM diag WHERE icd LIKE '".$kode_icd."'");
	$found = $check_icd->rowCount();
	if($found>0){
		$check = $db->query("SELECT COUNT(*) as total FROM registerpasien_final WHERE id_pulang='".$id_pulang."'");
		$c = $check->fetch(PDO::FETCH_ASSOC);
		if($c['total']==0){
			//insert into register_final
			$final = $db->prepare("INSERT INTO `registerpasien_final`(`id_pulang`, `diagnosa_utama`,`kode_icd`,`diagnosa_tambahan`)VALUES (:pul,:du,:icd,:dt)");
			$final->bindParam(":pul",$id_pulang,PDO::PARAM_INT);
			$final->bindParam(":du",$diagnosa,PDO::PARAM_STR);
			$final->bindParam(":icd",$kode_icd,PDO::PARAM_STR);
			$final->bindParam(":dt",$dt,PDO::PARAM_STR);
			$str = "Data Diagnosa Berhasil Disimpan";
		}else{
			// update registerpasien_final
			$final = $db->prepare("UPDATE registerpasien_final SET diagnosa_utama=:du,kode_icd=:icd,diagnosa_tambahan=:dt WHERE id_pulang=:id");
			$final->bindParam(":du",$diagnosa,PDO::PARAM_STR);
			$final->bindParam(":icd",$kode_icd,PDO::PARAM_STR);
			$final->bindParam(":dt",$dt,PDO::PARAM_STR);
			$final->bindParam(":id",$id_pulang);
			$str = "Data Diagnosa Berhasil Diperbaharui.";
		}
		$final->execute();
		//update registerpasien_pulang final='y'
		$fix = $db->prepare("UPDATE registerpasien_pulang SET kasus=:kasus WHERE id_pulang=:id");
		$fix->bindParam(":kasus",$kasus);
		$fix->bindParam(":id",$id_pulang);
		$fix->execute();
		// $str = "Data Berhasil Disimpan"
		// echo $str;
	}else{
		// icd tidak terdaftar
			$str="Diagnosa belum terdaftar, silakan daftarkan diagnosa terlebih dahulu";
	}
}else{
	$str="Diagnosa belum terdaftar, silakan daftarkan diagnosa terlebih dahulu";
}
echo $str;
