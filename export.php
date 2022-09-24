<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$gabung=isset($_GET["gabung"]) ? $_GET['gabung'] : '';
$tipeigd=isset($_GET["tipeigd"]) ? $_GET['tipeigd'] : '';
//mysql data pasien
$h2=$db->query("SELECT * FROM igd ig LEFT JOIN registerpasien rp ON(ig.id_register=rp.id_pasien) WHERE ig.status='2' AND ig.tipeigd='$tipeigd' AND ig.tanggaligd LIKE '%$gabung%'");
$data2=$h2->fetchAll();
//EXCEL
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=register-igd-".$tipeigd."-".$gabung.".xls");
?>
Laporan Rekam Medis <?php echo $tipeigd; ?> per <?php echo $gabung; ?>
<table id="example1" class="table table-bordered table-striped" border="1">
                    <thead>
                      <tr>
						<th>No.</th>
						<th>Tanggal</th>
						<th>Jam datang</th>
						<th>Jam pelayanan</th>
                        <th>No. RM</th>
						<th>Domisili</th>
						<th>Kunjungan</th>
                        <th>Nama pasien</th>
                        <th>Umur</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
                        <th>Nama suami/ayah</th>
                        <th>Umur</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
						<th>Alamat</th>
						<th>Agama</th>
						<th>ANC</th>
						<th>Rujukan dari</th>
						<th>Diagnosa utama</th>
						<th>DPJP</th>
						<th>Apgar score</th>
						<th>IMD</th>
						<th>Cara keluar</th>
						<th>Transfusi</th>
                      </tr>
                    </thead>
                    <tbody>
											<?php
											$nomer=1;
											foreach($data2 as $r2){
												echo "<tr>
																<td>".$nomer."</td>
																<td>".$r2['tanggaldaftar']."</td>
																<td>".$r2['jamm']."</td>
																<td>".$r2['jamp']."</td>
																<td>".$r2['nomedrek']."</td>
																<td>".$r2['domisili']."</td>
																<td>".$r2['tipepasien']."</td>
																<td>".$r2['nama']."</td>
																<td>".$r2['umur']."</td>
																<td>".$r2['pendistri']."</td>
																<td>".$r2['pistri']."</td>
																<td>".$r2['namaayah']."</td>
																<td>".$r2['usuami']."</td>
																<td>".$r2['pendsuami']."</td>
																<td>".$r2['psuami']."</td>
																<td>".$r2['alamat']."</td>
																<td>".$r2['agama']."</td>
																<td>".$r2['anc']."</td>
																<td>".$r2['rujukan']."</td>
																<td>".$r2['diagnosaa']."</td>
																<td>".$r2['dpjp']."</td>
																<td>".$r2['ascore']."</td>
																<td>".$r2['imd']."</td>
																<td>".$r2['carakeluar']."</td>
																<td>".$r2['darah']."</td>
															</tr>";
											}
											?>
                    </tbody>
                  </table>
