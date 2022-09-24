<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$awal = isset($_GET['awal']) ? $_GET['awal']:'';
$akhir= isset($_GET['akhir']) ? $_GET['akhir']:'';
// $akhir = date('Y-m-d',strtotime('+1 day',strtotime($akr)));
//mysql data pasien
$dt = $db->query("SELECT rp.nomedrek,rp.nama,ksl.tujuan,ksl.gol_darah,sl.nama_barang,ksl.keluar,ksl.tanggal,ksl.tanggal_selesai,ksl.selisih,ksl.id_kartu,ksl.reaksi,ksl.ket,rp.domisili,SUM(ksl.keluar) as total FROM kartu_stok_labu ksl LEFT JOIN registerpasien rp ON(ksl.id_register=rp.id_pasien) INNER JOIN stok_lab sl ON(ksl.id_stok_lab=sl.id_stok_lab) WHERE ksl.status='keluar' AND ksl.tanggal BETWEEN '$awal' AND '$akhir' GROUP BY rp.nomedrek ORDER BY rp.nama asc");
$data=$dt->fetchAll();
$nama = "LabuDarahPeriode-".$awal."-".$akhir;
//EXCEL
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$nama.xls");
?>
Data Rekap Labu Darah Keluar
<table class="table table-bordered table-striped" border="1">
	<thead>
		<tr class="info">
			<th width="20">No.</th>
			<th>Nomedrek</th>
			<th>Nama</th>
			<th>Domisili</th>
			<th>Tujuan</th>
			<th>Gol Darah</th>
			<th>Tipe Darah</th>
			<th>Jumlah</th>
			<th>Tanggal Keluar</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$nomor = 1;
		foreach ($data as $key) {
			echo "
			<tr>
				<td>".$nomor++."</td>
				<td>`".$key['nomedrek']."</td>
				<td>".$key['nama']."</td>
				<td>".$key['domisili']."</td>
				<td>".$key['tujuan']."</td>
				<td>".$key['gol_darah']."</td>
				<td>".$key['nama_barang']."</td>
				<td>".$key['total']."</td>
				<td>".$key['tanggal']."</td>
			</tr>
			";
		}
		?>
	</tbody>
</table>
