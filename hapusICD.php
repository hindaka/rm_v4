<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$id = isset($_POST['id']) ? $_POST['id'] : '';
$nama_icd = isset($_POST['nama']) ? $_POST['nama'] : '';
$kode_icd = isset($_POST['kode']) ? $_POST['kode'] : '';
$slug_icd = isset($_POST['icd']) ? $_POST['icd'] : '';
//insert into table diag
$diag = $db->prepare("UPDATE diag SET aktif='n' WHERE id_diagnosa=:id");
$diag->bindParam(":id",$id);
$diag->execute();
$push =array();
$sukses = "Data Diagnosa Berhasil dihapus";
echo $sukses;
