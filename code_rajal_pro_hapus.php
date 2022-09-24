<?php
include "cek_user.php";
include "../inc/anggota_check.php";

$id_prosedur = isset($_POST['id']) ? trim($_POST['id']) : '';

$check = $db->query("SELECT COUNT(*) as total FROM registerpasien_prosedur WHERE id_prosedur='".$id_prosedur."'");
$c = $check->fetch(PDO::FETCH_ASSOC);
if($c['total']>0){
	//insert into register_final
	$final = $db->prepare("DELETE FROM registerpasien_prosedur WHERE id_prosedur=:id");
	$final->bindParam(":id",$id_prosedur);
	$final->execute();
	$str = "Data Prosedur Berhasil dihapus.";
}else{
	$str = "Data Prosedur Gagal Dihapus";
}
// $fix = $db->prepare("UPDATE registerpasien_pulang SET kasus=:kasus,final='y' WHERE id_pulang=:id");
// $fix->bindParam(":kasus",$kasus);
// $fix->bindParam(":id",$id_pulang);
// $fix->execute();
//update registerpasien_pulang final='y'
// $str = "Data Berhasil Disimpan";
echo $str;
