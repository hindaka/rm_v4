<?php
include "cek_user.php";
include "../inc/anggota_check.php";

//get var
$id_tigd=isset($_GET["id"]) ? $_GET['id'] : '';
$id_igd=isset($_GET["igd"]) ? $_GET['igd'] : '';
try{
	$db->beginTransaction();
	//delete
	$result = $db->query("DELETE FROM tindakanigd WHERE id_tigd='$id_tigd'");
	$result2 = $db->query("DELETE FROM invoiceranap WHERE id_tindakan='$id_tigd' AND asal='IGD'");
	$result3 = $db->query("OPTIMIZE TABLE tindakanigd, invoiceranap");
	//delete data from invoice_all_det WHERE id_tindakan and asal = igd
	$del = $db->prepare("DELETE FROM invoice_all_det WHERE id_tindakan=:id_tindakan AND asal='igd'");
	$del->bindParam(":id_tindakan",$id_tigd,PDO::PARAM_INT);
	$del->execute() or die("FAIL TO DELETE RECORD IN INV_DET");
	//get sum from invoice_all_det
	$get_register = $db->prepare("SELECT id_register FROM igd WHERE id_igd=:id");
	$get_register->bindParam(":id",$id_igd,PDO::PARAM_INT);
	$get_register->execute();
	$reg = $get_register->fetch(PDO::FETCH_ASSOC);

	$get_id_inv = $db->prepare("SELECT id_invoice_all FROM invoice_all WHERE id_register=:id_register AND status_inv='belum dibayar'");
	$get_id_inv->bindParam(":id_register",$reg['id_register'],PDO::PARAM_INT);
	$get_id_inv->execute();
	$inv = $get_id_inv->fetch(PDO::FETCH_ASSOC);

	$total = $db->prepare("SELECT SUM(harga*volume) as total_tagihan FROM invoice_all_det WHERE id_invoice_all=:id_inv");
	$total->bindParam(":id_inv",$inv['id_invoice_all'],PDO::PARAM_INT);
	$total->execute();
	$tagihan = $total->fetch(PDO::FETCH_ASSOC);

	//update total_tagihan @ invoice_all
	$up_inv = $db->prepare("UPDATE invoice_all SET total_tagihan=:total WHERE id_invoice_all=:id_inv");
	$up_inv->bindParam(":total",$tagihan['total_tagihan'],PDO::PARAM_INT);
	$up_inv->bindParam(":id_inv",$inv['id_invoice_all'],PDO::PARAM_INT);
	$up_inv->execute();

	$db->commit();
	//action
	if ($result) {
	echo "<script language=\"JavaScript\">window.location = \"tindakan.php?id=$id_igd&status=4\"</script>";
	} else {
	$db->rollBack();
	echo "gagal";
	}
}catch(PDOException $pdoe){
	echo "Error : ".$pdoe->getMessage();
	$db->rollBack();
	exit();
}
?>
