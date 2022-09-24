<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$nama_icd = isset($_POST['nama']) ? $_POST['nama'] : '';
$kode_icd = isset($_POST['kode']) ? $_POST['kode'] : '';
$slug_icd = isset($_POST['icd']) ? $_POST['icd'] : '';
$alias = isset($_POST['al']) ? $_POST['al'] : '';
$tampil = isset($_POST['tampil']) ? $_POST['tampil'] : '';
$aktif='y';
$list = explode(",",$tampil);
if(in_array("obgyn",$list)){
	$obgyn="ya";
}else{
	$obgyn="tidak";
}
if(in_array("anak",$list)){
	$anak="ya";
}else{
	$anak="tidak";
}
if(in_array("peri",$list)){
	$peri="ya";
}else{
	$peri="tidak";
}
if(in_array("ipd",$list)){
	$ipd="ya";
}else{
	$ipd="tidak";
}
if(in_array("neuro",$list)){
	$neuro="ya";
}else{
	$neuro="tidak";
}
if(in_array("tht",$list)){
	$tht="ya";
}else{
	$tht="tidak";
}
//check duplicate
$check_list = $db->query("SELECT count(*) as dup FROM diag WHERE icd='".$kode_icd."' AND slug_icd='".$slug_icd."' AND aktif='y'");
$check = $check_list->fetch(PDO::FETCH_ASSOC);
if($check['dup']>0){
	$sukses = "Penambahan Gagal, Data Diagnosa dengan kode ICD (".$kode_icd.") Sudah terdaftar";
}else{
	//insert into table diag
	$diag = $db->prepare("INSERT INTO `diag`(`diagnosa`,`istilah_pelayanan`, `icd`, `slug_icd`,`obgyn`,`peri`,`anak`,`ipd`,`neuro`,`tht`,`aktif`) VALUES (:diagnosa,:istilah_pelayanan,:icd,:slug_icd,:obgyn,:peri,:anak,:ipd,:neuro,:tht,:aktif)");
	$diag->bindParam(":diagnosa",$nama_icd,PDO::PARAM_STR);
	$diag->bindParam(":istilah_pelayanan",$alias,PDO::PARAM_STR);
	$diag->bindParam(":icd",$kode_icd,PDO::PARAM_STR);
	$diag->bindParam(":slug_icd",$slug_icd);
	$diag->bindParam(":obgyn",$obgyn,PDO::PARAM_STR);
	$diag->bindParam(":peri",$peri,PDO::PARAM_STR);
	$diag->bindParam(":anak",$anak,PDO::PARAM_STR);
	$diag->bindParam(":ipd",$ipd,PDO::PARAM_STR);
	$diag->bindParam(":neuro",$neuro,PDO::PARAM_STR);
	$diag->bindParam(":tht",$tht,PDO::PARAM_STR);
	$diag->bindParam(":aktif",$aktif);
	$diag->execute();
	$sukses = "Data Diagnosa dengan kode ICD (".$kode_icd.") Berhasil ditambahkan";
}
$feedback = array(
	"judul"=>"Berhasil!!",
	"msg"=>"Data Berhasil disimpan",
	"icon"=>"success",
	"button"=>"Tutup"
);
echo json_encode($feedback);
