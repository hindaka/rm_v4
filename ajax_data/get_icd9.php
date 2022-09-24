<?php
include "../cek_user.php";
include "../../inc/anggota_check.php";
if(!isset($_GET['term'])){
	$get_icd = $db->query("SELECT id_diagnosa,icd,diagnosa FROM diag");
}else{
	$search = $_GET['term'];
	// $get_icd = $db->query("SELECT id_codes,full_code,abbrev_desc FROM codes_icd WHERE full_code LIKE'%".$search."%' OR abbrev_desc LIKE '%".$search."%' LIMIT 20");
	$get_icd = $db->query("SELECT id_diagnosa,icd,diagnosa FROM diag WHERE slug_icd='icd9' AND (diagnosa LIKE '%".$search."%' OR icd LIKE '%".$search."%')");
}
$data_icd = $get_icd->fetchAll(PDO::FETCH_ASSOC);

$data = array();
foreach ($data_icd as $row) {
	$name = $row['diagnosa']." | ".$row['icd'] ;
	$data[] = array("id"=>$name, "text"=>$name);
}
echo json_encode($data);
?>
