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
$table = 'diag';

// Table's primary key
$primaryKey = 'id_diagnosa';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
// $columns = array(
//     array(
//       'db' => 'id_obat',
//       'dt' => 0,
//       'formatter' => function($d,$row){
//           return "<input class='minimal chk' id='pilihObat' type='checkbox' name='pilihObat[]' value='".$row['id_obat']."'>";
//         }
//     ),
//     array( 'db' => 'nama',  'dt' => 1 ),
//     array( 'db' => 'jenis',   'dt' => 2 ),
// );
$columns = array(
    array(
      'db' => 'id_diagnosa',
      'dt' => 'id_diagnosa'
    ),
    array( 'db' => 'diagnosa',  'dt' => 'diagnosa' ),
    array( 'db' => 'icd',   'dt' => 'icd' ),
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
 require( '../ssp.class.php' );

$where = "aktif='y' AND slug_icd='icd10' AND eksklusi_statistik='n'";

echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null, $where )
);
