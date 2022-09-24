<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$id = isset($_POST['id']) ? $_POST['id'] : '';
$nama_icd = isset($_POST['nama']) ? $_POST['nama'] : '';
$kode_icd = isset($_POST['kode']) ? $_POST['kode'] : '';
$slug_icd = isset($_POST['icd']) ? $_POST['icd'] : '';
$alias = isset($_POST['al']) ? $_POST['al'] : '';
$tampil = isset($_POST['tampil']) ? $_POST['tampil'] : '';
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
$check_list = $db->query("SELECT count(*) as dup FROM diag WHERE icd='".$kode_icd."' AND id_diagnosa<>'".$id."' AND aktif='y'");
$check = $check_list->fetch(PDO::FETCH_ASSOC);
if($check['dup']>0){
	$sukses = "Update Gagal, Data Diagnosa dengan kode ICD (".$kode_icd.") Sudah terdaftar";
	$feedback = array(
		"judul"=>"Peringantan!!",
		"msg"=>$sukses,
		"icon"=>"warning",
		"button"=>"Tutup"
	);
}else{
	//insert into table diag
	$diag = $db->prepare("UPDATE diag SET diagnosa=:diagnosa,istilah_pelayanan=:istilah_pelayanan,icd=:icd,slug_icd=:slug_icd,obgyn=:obgyn,anak=:anak,peri=:peri,ipd=:ipd,neuro=:neuro,tht=:tht WHERE id_diagnosa=:id");
	$diag->bindParam(":diagnosa",$nama_icd,PDO::PARAM_STR);
	$diag->bindParam(":istilah_pelayanan",$alias,PDO::PARAM_STR);
	$diag->bindParam(":icd",$kode_icd,PDO::PARAM_STR);
	$diag->bindParam(":slug_icd",$slug_icd);
	$diag->bindParam(":obgyn",$obgyn,PDO::PARAM_STR);
	$diag->bindParam(":anak",$anak,PDO::PARAM_STR);
	$diag->bindParam(":peri",$peri,PDO::PARAM_STR);
	$diag->bindParam(":ipd",$ipd,PDO::PARAM_STR);
	$diag->bindParam(":neuro",$neuro,PDO::PARAM_STR);
	$diag->bindParam(":tht",$tht,PDO::PARAM_STR);
	$diag->bindParam(":id",$id);
	$diag->execute();
	$sukses = "Data Diagnosa Berhasil diubah";
	$feedback = array(
		"judul"=>"Berhasil!!",
		"msg"=>$sukses,
		"icon"=>"success",
		"button"=>"Tutup"
	);
}
echo json_encode($feedback);
