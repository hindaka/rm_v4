<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$check_all = isset($_POST['check_data']) ? $_POST['check_data'] : '';
$split_data = explode(',',$check_all);
if(is_array($split_data)){
		$total_data = count($split_data);
		for ($i=0; $i < $total_data ; $i++) {
			$execute = $db->query("UPDATE diag SET eksklusi_statistik='y' WHERE iD_diagnosa='".$split_data[$i]."'");
		}
		echo json_encode("Data Diagnosa Berhasil dieksklusikan");
}else{
		echo json_encode("Pengaturan Data Diagnosa Gagal dilakukan!");
}
