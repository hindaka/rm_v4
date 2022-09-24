<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'registerpasien';

// Table's primary key
$primaryKey = 'id_pasien';
$awal = $_GET['awal'];
$akhir = $_GET['akhir'];
$split1 = explode("-",$awal);
$split2 = explode("-",$akhir);
$new_awal = $split1[0].$split1[1].$split1[2];
$new_akhir = $split2[0].$split2[1].$split2[2];
//get parameter
// $id_resep = isset($_GET['r']) ? $_GET['r'] : '';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
  array( 'db' => '`rp`.`nomedrek`', 'dt' => 'nomedrek', 'field' => 'nomedrek', 'as' =>'nomedrek'),
  array( 'db' => '`rp`.`tanggaldaftar`', 'dt' => 'tanggaldaftar', 'field' => 'tanggaldaftar', 'as' =>'tanggaldaftar'),
  array( 'db' => '`rp`.`jamdatang`', 'dt' => 'jamdatang', 'field' => 'jamdatang', 'as' =>'jamdatang'),
  array( 'db' => '`rp`.`nama`', 'dt' => 'nama', 'field' => 'nama', 'as' =>'nama'),
  array( 'db' => '`rp`.`tanggallahir`', 'dt' => 'tanggallahir', 'field' => 'tanggallahir', 'as' =>'tanggallahir'),
  array( 'db' => '`rp`.`kelamin`', 'dt' => 'kelamin', 'field' => 'kelamin', 'as' =>'kelamin'),
  array( 'db' => '`rp`.`pend_pasien`', 'dt' => 'pend_pasien', 'field' => 'pend_pasien', 'as' =>'pend_pasien'),
  array( 'db' => '`rp`.`alamat`', 'dt' => 'alamat', 'field' => 'alamat', 'as' =>'alamat'),
  array( 'db' => '`rp`.`domisili`', 'dt' => 'domisili', 'field' => 'domisili', 'as' =>'domisili'),
  array( 'db' => '`rp`.`agama`', 'dt' => 'agama', 'field' => 'agama', 'as' =>'agama'),
  array( 'db' => '`rp`.`tipepasien`', 'dt' => 'tipepasien', 'field' => 'tipepasien', 'as' =>'tipepasien'),
  array( 'db' => '`rp`.`ktujuan`', 'dt' => 'ktujuan', 'field' => 'ktujuan', 'as' =>'ktujuan'),
  array( 'db' => '`rp`.`jpasien`', 'dt' => 'jpasien', 'field' => 'jpasien', 'as' =>'jpasien'),
  array( 'db' => '`rp`.`kelurahan`', 'dt' => 'kelurahan', 'field' => 'kelurahan', 'as' =>'kelurahan'),
  array( 'db' => '`rp`.`kecamatan`', 'dt' => 'kecamatan', 'field' => 'kecamatan', 'as' =>'kecamatan'),
  array( 'db' => '`rp`.`rujukan`', 'dt' => 'rujukan', 'field' => 'rujukan', 'as' =>'rujukan'),
  array( 'db' => '`rp`.`nmdokter`', 'dt' => 'nmdokter', 'field' => 'nmdokter', 'as' =>'nmdokter'),
  array( 'db' => '`rg`.`diagnosa_akhir`', 'dt' => 'diagnosa_akhir', 'field' => 'diagnosa_akhir', 'as' =>'diagnosa_akhir'),
  array( 'db' => 'IFNULL(`f`.`diagnosa_utama`,\'Belum Dicoding\')', 'dt' => 'diagnosa_coding', 'field' => 'diagnosa_coding', 'as' =>'diagnosa_coding'),
  array( 'db' => 'IFNULL(`f`.`kode_icd`,\'\')', 'dt' => 'kode_icd', 'field' => 'kode_icd', 'as' =>'kode_icd'),
  array( 'db' => '`k`.`keterangan`', 'dt' => 'keterangan', 'field' => 'keterangan', 'as' =>'keterangan'),
);

// SQL server connection information
require_once('../../inc/set_env.php');
$sql_details = array(
    'user' => $userPdo,
    'pass' => $passPdo,
    'db'   => $dbPdo,
    'host' => $hostPdo
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('../ssp.customized.class.php' );

$joinQuery = " FROM `registerpasien` AS `rp` INNER JOIN `klinik` AS `k` ON(`rp`.`id_pasien`=`k`.`id_register`)";
$joinQuery .="  LEFT JOIN `registerpasien_pulang` AS `rg` ON(`rp`.`id_pasien`=`rg`.`id_register`)";
$joinQuery .= " LEFT JOIN `registerpasien_final` AS `f` ON(`rg`.`id_pulang`=`f`.`id_pulang`)";
$extraWhere = " CAST(CONCAT(SUBSTRING(`rp`.`tanggaldaftar`,7,4),SUBSTRING(`rp`.`tanggaldaftar`,4,2),SUBSTRING(`rp`.`tanggaldaftar`,1,2)) AS UNSIGNED ) >= '".$new_awal."' AND CAST(CONCAT(SUBSTRING(`rp`.`tanggaldaftar`,7,4),SUBSTRING(`rp`.`tanggaldaftar`,4,2),SUBSTRING(`rp`.`tanggaldaftar`,1,2)) AS UNSIGNED ) <= '".$new_akhir."' AND rp.ktujuan<>'bayi'";
$groupBy = "";
$having = "";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);
