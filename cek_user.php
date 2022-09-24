<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
include("../inc/pdo.conf.php");
include("../inc/version.php");
$mem_id       = $_SESSION['id_user'];
$namauser     = $_SESSION['namauser'];
$password     = $_SESSION['password'];
$id_pegawai   = $_SESSION['id_pegawai'];
$nama         = $_SESSION['nama'];
$modul        = $_SESSION['modul'];
$role         = $_SESSION['role'];

if ((empty($mem_id) || $mem_id == '0' || $mem_id == NULL || $mem_id == '') || (empty($namauser) || $namauser == NULL || $namauser == '') || (empty($password) || $password == NULL || $password == '') || (empty($id_pegawai) || $id_pegawai == NULL || $id_pegawai == '') || (empty($nama) || $nama == NULL || $nama == '' ) || (empty($modul) || $modul == NULL || $modul == '') || (empty($role) || $role == NULL || $role == '' ) ){
	unset($_SESSION['id_user']);
	unset($_SESSION['namauser']);
	unset($_SESSION['password']);
	unset($_SESSION['id_pegawai']);
	unset($_SESSION['nama']);
	unset($_SESSION['modul']);
	unset($_SESSION['role']);
	header("location:../index.php?status=2");
	exit;
} else {
	if ($modul != 'rm') {
		unset($_SESSION['id_user']);
		unset($_SESSION['namauser']);
		unset($_SESSION['password']);
		unset($_SESSION['id_pegawai']);
		unset($_SESSION['nama']);
		unset($_SESSION['modul']);
		unset($_SESSION['role']);
		header("location:../index.php?status=2");
		exit;
	}
}
