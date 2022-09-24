<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$awal = isset($_GET['awal']) ? $_GET['awal'] : '';
$akhir = isset($_GET['akhir']) ? $_GET['akhir'] : '';
//mysql data bayi
$data_bayi = $db->prepare("SELECT p.tanggalmasuk,p.tanggalkeluar,rp.nomedrek,rp.nama,rp.tanggallahir,rp.domisili,rt.nomedrek as medrek_ibu,rt.nama as nama_ibu,rt.rujukan as rujukan_ibu,p.asal,p.jk,p.bb,p.tinggi,p.carap,p.ascore,p.dpjp,p.status,p.carakeluar FROM `bayi_ibu` b INNER JOIN peri p ON(p.id_register=b.id_register_bayi) INNER JOIN registerpasien rp ON(rp.id_pasien=b.id_register_bayi) INNER JOIN registerpasien rt ON(rt.id_pasien=b.id_register_ibu) WHERE CAST(CONCAT(SUBSTRING(rp.tanggaldaftar,7,4),SUBSTRING(rp.tanggaldaftar,4,2),SUBSTRING(rp.tanggaldaftar,1,2)) as UNSIGNED) >= :awal AND CAST(CONCAT(SUBSTRING(rp.tanggaldaftar,7,4),SUBSTRING(rp.tanggaldaftar,4,2),SUBSTRING(rp.tanggaldaftar,1,2)) as UNSIGNED) <= :akhir");
$data_bayi->bindParam(":awal",$awal);
$data_bayi->bindParam(":akhir",$akhir);
$data_bayi->execute();
$bayi = $data_bayi->fetchAll(PDO::FETCH_ASSOC);
//EXCEL
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_bayi.xls");
?>
<table border="1">
  <thead>
    <tr>
      <th>Tanggal Masuk</th>
      <th>Tanggal Keluar</th>
      <th>Nomedrek</th>
      <th>Nama Bayi</th>
      <th>Tanggal Lahir</th>
      <th>Domisili</th>
			<th>Nomedrek Ibu</th>
			<th>Nama Ibu</th>
      <th>Rujukan Ibu</th>
      <th>Asal</th>
      <th>Jenis Kelamin</th>
      <th>Berat badan</th>
      <th>Tinggi Badan</th>
      <th>Afgar Score</th>
      <th>Cara Lahir</th>
      <th>DPJP</th>
      <th>Status</th>
      <th>Cara Keluar</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($bayi as $row) {
        echo "<tr>
          <td>".$row['tanggalmasuk']."</td>
          <td>".$row['tanggalkeluar']."</td>
          <td>".$row['nomedrek']."</td>
          <td>".$row['nama']."</td>
          <td>".$row['tanggallahir']."</td>
          <td>".$row['domisili']."</td>
					<td>".$row['medrek_ibu']."</td>
					<td>".$row['nama_ibu']."</td>
          <td>".$row['rujukan_ibu']."</td>
          <td>".$row['asal']."</td>
          <td>".$row['jk']."</td>
          <td>".$row['bb']."</td>
          <td>".$row['tinggi']."</td>
          <td>".$row['ascore']."</td>
          <td>".$row['carap']."</td>
          <td>".$row['dpjp']."</td>
          <td>".$row['status']."</td>
          <td>".$row['carakeluar']."</td>
        </tr>";
      }
    ?>
  </tbody>
</table>
