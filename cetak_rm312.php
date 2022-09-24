<?php
include "cek_user.php";
include "../inc/anggota_check.php";
$id_dokumen = isset($_GET['cetak']) ? $_GET['cetak'] : '';
$data_dokumen = $db->query("SELECT * FROM rm_rak_ansietas rm INNER JOIN registerpasien rp ON(rm.id_register=rp.id_pasien) WHERE rm.id_rm_ansietas='".$id_dokumen."'");
$dokumen = $data_dokumen->fetch(PDO::FETCH_ASSOC);
$ansietas = json_decode($dokumen['ansietas'],true);
$tujuan = json_decode($dokumen['tujuan'],true);
$intervensi = json_decode($dokumen['intervensi'],true);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>RM 3.12 Rencana Asuhan Keperawatan Ansietas</title>
<style type="text/css">
html  {
	 font-family: arial; font-size: 11px;
}
</style>
</head>

<body onload="window.print();window.close();">
<table width="100%">
	<tr>
		<td><strong>RS KHUSUS IBU  DAN ANAK KOTA BANDUNG</strong></td>
		<td align="right"><strong>RM 3.12</strong></td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td width="378" align="center" valign="top">
			<p><h3>RENCANA ASUHAN KEPERAWATAN<br>ANSIETAS</h3></p>
		</td>
    <td width="321" valign="top">
			<table>
				<tr>
					<td>Nama</td>
					<td>: <?php echo $dokumen['nama']; ?></td>
				</tr>
				<tr>
					<td>No.RM</td>
					<td>: <?php echo $dokumen['nomedrek']; ?></td>
				</tr>
				<tr>
					<td>Tanggal Lahir</td>
					<td>: <?php echo $dokumen['tanggallahir']; ?></td>
				</tr>
			</table>
		</td>
  </tr>
</table>
<table border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td width="38" valign="top"><p align="center"><strong>NO</strong></p></td>
    <td width="274" valign="top"><p align="center"><strong>DIAGNOSA KEPERAWATAN</strong></p></td>
    <td width="151" valign="top"><p align="center"><strong>TUJUAN</strong></p></td>
    <td width="236" valign="top"><p align="center"><strong>INTERVENSI</strong></p></td>
  </tr>
  <tr>
    <td width="38" valign="top"><p align="center">1</p></td>
    <td width="274" valign="top">Ansietas berhubungan    dengan:
     <table border="0">
			<?php
				if(in_array("Ancaman Kematian",$ansietas)){
					echo "<tr><td>&#10004;</td><td>Ancaman Kematian</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Ancaman Kematian</td></tr>";
				}
				if(in_array("Stresor",$ansietas)){
					echo "<tr><td>&#10004;</td><td>Stresor</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Stresor</td></tr>";
				}
				if(in_array("Perubahan Status",$ansietas)){
					echo "<tr><td>&#10004;</td><td>Perubahan status</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Perubahan status</td></tr>";
				}
			?>
      </table><br>
      Ditandai dengan :<br>
      DO :
      <table border="0" width="100%">
      <tr>
				<td width="100px">&#x25CF; Suhu</td>
				<td> : <input size="5" type="text" name="suhu" id="suhu" value="<?php echo $dokumen['suhu']; ?>">°C</td>
			</tr>
			<tr>
				<td width="100px">&#x25CF; Tekanan Darah</td>
				<td> : <input size="5" type="text" name="tekanan_darah" id="tekanan_darah" value="<?php echo $dokumen['tekanan_darah']; ?>">mmHg</td>
			</tr>
			<tr>
				<td width="100px">&#x25CF; Nadi</td>
				<td> : <input size="5" type="text" name="nadi" id="nadi" value="<?php echo $dokumen['nadi']; ?>"> x/menit</td>
			</tr>
			<tr>
				<td width="100px">&#x25CF; Respirasi</td>
				<td> : <input size="5" type="text" name="respirasi" id="respirasi" value="<?php echo $dokumen['respirasi']; ?>"> x/menit</td>
			</tr>
      </table>
      <p>DS : <input type="text" name="ds" id="ds" value="<?php echo $dokumen['ds']; ?>"></p>
		</td>
    <td width="151" valign="top">Dalam <?php echo $dokumen['tujuan_jam']; ?> x 24 jam, ansietas    teratasi dengan karakteristik:

	    <table border="0">
				<?php
				if(in_array("TTV dalam batas normal",$tujuan)){
					echo "<tr><td>&#10004;</td><td>TTV dalam batas normal</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>TTV dalam batas normal</td></tr>";
				}
				if(in_array("Klien dapat beristirahat",$tujuan)){
					echo "<tr><td>&#10004;</td><td>Klien dapat beristirahat</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Klien dapat beristirahat</td></tr>";
				}
				if(in_array("Wajah Klien Tenang",$tujuan)){
					echo "<tr><td>&#10004;</td><td>Wajah Klien Tenang</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Wajah Klien Tenang</td></tr>";
				}
				if(in_array("Klien tampak tenang",$tujuan)){
					echo "<tr><td>&#10004;</td><td>Klien tampak tenang</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Klien tampak tenang</td></tr>";
				}
				?>
			<tr>
				<td valign="top">&#x25A1;</td>
				<td>______________________</td>
			</tr>
			<tr>
				<td valign="top">&#x25A1;</td>
				<td>______________________</td>
			</tr>
	    </table>

		</td>
		<td>
			<table border="0">
				<?php
				if(in_array("Gunakan pendekatan yang tenang dan meyakinkan",$intervensi)){
					echo "<tr><td>&#10004;</td><td>Gunakan pendekatan yang tenang dan meyakinkan</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Gunakan pendekatan yang tenang dan meyakinkan</td></tr>";
				}
				if(in_array("Jelaskan semua prosedur termasuk sensasi yang akan dirasakan yang mungkin akan dialami klien selama prosedur",$intervensi)){
					echo "<tr><td>&#10004;</td><td>Jelaskan semua prosedur termasuk sensasi yang akan dirasakan yang mungkin akan dialami klien selama prosedur</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Jelaskan semua prosedur termasuk sensasi yang akan dirasakan yang mungkin akan dialami klien selama prosedur</td></tr>";
				}
				if(in_array("Berikan informasi faktual terkait diagnosis, perawatan dan prognosis",$intervensi)){
					echo "<tr><td>&#10004;</td><td>Berikan informasi faktual terkait diagnosis, perawatan dan prognosis</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Berikan informasi faktual terkait diagnosis, perawatan dan prognosis</td></tr>";
				}
				if(in_array("Dorong keluarga untuk mendampingi klien dengan cara yang tepat",$intervensi)){
					echo "<tr><td>&#10004;</td><td>Dorong keluarga untuk mendampingi klien dengan cara yang tepat</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Dorong keluarga untuk mendampingi klien dengan cara yang tepat</td></tr>";
				}
				if(in_array("Bantu klien mengidentifikasi situasi yang memicu kecemasan",$intervensi)){
					echo "<tr><td>&#10004;</td><td>Bantu klien mengidentifikasi situasi yang memicu kecemasan</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Bantu klien mengidentifikasi situasi yang memicu kecemasan</td></tr>";
				}
				if(in_array("Instruksikan klien untuk menggunkan teknik relaksasi",$intervensi)){
					echo "<tr><td>&#10004;</td><td>Instruksikan klien untuk menggunkan teknik relaksasi</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Instruksikan klien untuk menggunkan teknik relaksasi</td></tr>";
				}
				if(in_array("Dengarkan klien",$intervensi)){
					echo "<tr><td>&#10004;</td><td>Dengarkan klien</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Dengarkan klien</td></tr>";
				}
				if(in_array("Dukung penggunaan mekanisme koping yang sesuai",$intervensi)){
					echo "<tr><td>&#10004;</td><td>Dukung penggunaan mekanisme koping yang sesuai</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Dukung penggunaan mekanisme koping yang sesuai</td></tr>";
				}
				if(in_array("Pertimbangkan kemampuan klien dalam mengambil keputusan",$intervensi)){
					echo "<tr><td>&#10004;</td><td>Pertimbangkan kemampuan klien dalam mengambil keputusan</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Pertimbangkan kemampuan klien dalam mengambil keputusan</td></tr>";
				}
				if(in_array("Atur penggunaan obat-obatan untuk mengurangi kecemasan secara tepat",$intervensi)){
					echo "<tr><td>&#10004;</td><td>Atur penggunaan obat-obatan untuk mengurangi kecemasan secara tepat</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Atur penggunaan obat-obatan untuk mengurangi kecemasan secara tepat</td></tr>";
				}
				if(in_array("Berada di sisi klien untuk meingkatkan rasa aman dan mengurangi kecemasan",$intervensi)){
					echo "<tr><td>&#10004;</td><td>Berada di sisi klien untuk meingkatkan rasa aman dan mengurangi kecemasan</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Berada di sisi klien untuk meingkatkan rasa aman dan mengurangi kecemasan</td></tr>";
				}
				if(in_array("Berikan usapan pada punggung atau leher dengan cara yang tepat",$intervensi)){
					echo "<tr><td>&#10004;</td><td>Berikan usapan pada punggung atau leher dengan cara yang tepat</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Berikan usapan pada punggung atau leher dengan cara yang tepat</td></tr>";
				}
				if(in_array("Puji/kuatkan perilaku yang baik secara tepat",$intervensi)){
					echo "<tr><td>&#10004;</td><td>Puji/kuatkan perilaku yang baik secara tepat</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Puji/kuatkan perilaku yang baik secara tepat</td></tr>";
				}
				if(in_array("Dorong verbalisasi perasaan, persepsi dan ketakutan",$intervensi)){
					echo "<tr><td>&#10004;</td><td>Dorong verbalisasi perasaan, persepsi dan ketakutan</td></tr>";
				}else{
					echo "<tr><td>&#x25A1;</td><td>Dorong verbalisasi perasaan, persepsi dan ketakutan</td></tr>";
				}
				?>
				<tr>
		     <td valign="top">&#x25A1;</td>
				 <td>________________________<br><br>________________________</td>
			 </tr>
	    </table>
		</td>
  </tr>
</table>
<p>
<div align="right">
  <p align="right">Bandung, <?php echo date('d F Y',strtotime($dokumen['created_at'])); ?> Pukul <?php echo date('H:i',strtotime($dokumen['created_at'])); ?></p>
  <p align="right">&nbsp;</p>
  <p align="right">&nbsp;</p>
  <p align="right">(_________________________ )<br>
    <em>Tanda Tangan dan Nama Lengkap Perawat</em></p>
</div>
</p>
</body>
</html>
