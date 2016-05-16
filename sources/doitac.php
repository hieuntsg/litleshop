<?php  if(!defined('_source')) die("Error");
	$d->setTable('doitac');
	$d->select("noidung,mota");
	if($d->num_rows()>0){
		$row = $d->fetch_array();
		$noidung_about= $row['noidung'];
	}
	
	// thanh tieu de
	$title_bar="";
	$title_bar .= "Tư vấn miễn phí";
?>