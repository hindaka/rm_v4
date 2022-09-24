<?php
include "cek_user.php";
include "../inc/anggota_check.php";

$id_pulang = isset($_GET['pul']) ? trim($_GET['pul']) : '';
$bulan = isset($_GET['bln']) ? $_GET['bln'] : '';
$tahun = isset($_GET['thn']) ? $_GET['thn'] : '';
$jpasien = isset($_GET['jpasien']) ? $_GET['jpasien'] : '';

$check = $db->query("SELECT COUNT(*) as total FROM registerpasien_pulang WHERE id_pulang='".$id_pulang."'");
$c = $check->fetch(PDO::FETCH_ASSOC);
if($c['total']>0){
	//insert into register_final
	$final = $db->prepare("UPDATE registerpasien_pulang SET final='y' WHERE id_pulang=:id");
	$final->bindParam(":id",$id_pulang);
	$final->execute();
  echo "<script language=\"JavaScript\">window.location = \"coding_rajal.php?bulan=".$bulan."&tahun=".$tahun."&jpasien=".$jpasien."&status=1\"</script>";
}else{
  echo "<script language=\"JavaScript\">window.location = \"coding_rajal.php?bulan=".$bulan."&tahun=".$tahun."&jpasien=".$jpasien."&status=2\"</script>";
}
