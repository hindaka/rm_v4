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
$table = 'list_ranap';

// Table's primary key
$primaryKey = 'id_list_ranap';
$awal = $_GET['awal'];
$akhir = $_GET['akhir'];

//get parameter
// $id_resep = isset($_GET['r']) ? $_GET['r'] : '';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
  array( 'db' => '`rg`.`diagnosa_akhir`', 'dt' => 'diagnosa_akhir', 'field' => 'diagnosa_akhir', 'as' =>'diagnosa_akhir'),
  array( 'db' => 'IFNULL(`f`.`diagnosa_utama`,\'Belum Dicoding\')', 'dt' => 'diagnosa_coding', 'field' => 'diagnosa_coding', 'as' =>'diagnosa_coding'),
  array( 'db' => 'IFNULL(`f`.`kode_icd`,\'\')', 'dt' => 'kode_icd', 'field' => 'kode_icd', 'as' =>'kode_icd'),
  array( 'db' => '`lr`.`tgl_ranap`', 'dt' => 'tgl_ranap', 'field' => 'tgl_ranap', 'as' =>'tgl_ranap'),
  array( 'db' => '`lr`.`tgl_pulang`', 'dt' => 'tgl_pulang', 'field' => 'tgl_pulang', 'as' =>'tgl_pulang'),
  array( 'db' => '`lr`.`id_list_ranap`', 'dt' => 'id_list_ranap', 'field' => 'id_list_ranap', 'as' =>'id_list_ranap'),
  array( 'db' => '`lr`.`id_invoice_all`', 'dt' => 'id_invoice_all', 'field' => 'id_invoice_all', 'as' =>'id_invoice_all'),
  array( 'db' => '`rp`.`nomedrek`', 'dt' => 'nomedrek', 'field' => 'nomedrek', 'as' =>'nomedrek'),
  array( 'db' => '`rp`.`nama`', 'dt' => 'nama', 'field' => 'nama', 'as' =>'nama'),
  array( 'db' => '`rp`.`tanggallahir`', 'dt' => 'tanggallahir', 'field' => 'tanggallahir', 'as' =>'tanggallahir'),
  array( 'db' => '`rp`.`domisili`', 'dt' => 'domisili', 'field' => 'domisili', 'as' =>'domisili'),
  array( 'db' => '`rp`.`rujukan`', 'dt' => 'rujukan', 'field' => 'rujukan', 'as' =>'rujukan'),
  array( 'db' => '`rp`.`kelamin`', 'dt' => 'kelamin', 'field' => 'kelamin', 'as' =>'kelamin'),
  array( 'db' => '`rp`.`nmdokter`', 'dt' => 'nmdokter', 'field' => 'nmdokter', 'as' =>'nmdokter'),
  array( 'db' => '`lr`.`asal`', 'dt' => 'asal', 'field' => 'asal', 'as' =>'asal'),
  array( 'db' => '`lr`.`full_diagnosa`', 'dt' => 'full_diagnosa', 'field' => 'full_diagnosa', 'as' =>'full_diagnosa'),
  array( 'db' => '`rp`.`jpasien`', 'dt' => 'jpasien', 'field' => 'jpasien', 'as' =>'jpasien'),
  array( 'db' => '`lr`.`pulang`', 'dt' => 'pulang', 'field' => 'pulang', 'as' =>'pulang'),
  array( 'db' => '`rg`.`cara_keluar`', 'dt' => 'cara_keluar', 'field' => 'cara_keluar', 'as' =>'cara_keluar'),
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
// SELECT * FROM resep r INNER JOIN `warehouse_out` wo ON(r.id_resep=wo.id_resep) INNER JOIN warehouse_stok ws ON(wo.id_warehouse_stok=ws.id_warehouse_stok) INNER JOIN gobat g ON(ws.id_obat=g.id_obat) WHERE r.id_resep='113741'
$joinQuery = "FROM `list_ranap` AS `lr` INNER JOIN  `invoice_all` AS `ia` ON(`lr`.`id_invoice_all`=`ia`.`id_invoice_all`)";
$joinQuery .= " INNER JOIN `registerpasien` AS `rp` ON(`rp`.`id_pasien`=`ia`.`id_register`)";
$joinQuery .= " LEFT JOIN `registerpasien_pulang` AS `rg` ON(`rg`.`id_register`=`rp`.`id_pasien`)";
$joinQuery .= " LEFT JOIN `registerpasien_final` AS `f` ON(`rg`.`id_pulang`=`f`.`id_pulang`)";
$extraWhere = " `lr`.`tgl_ranap` BETWEEN '".$awal."' AND '".$akhir."'";
$groupBy = "";
$having = "";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);
