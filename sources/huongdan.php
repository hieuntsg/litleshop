<?php  if(!defined('_source')) die("Error");
	$d->setTable('hd');
	$d->select("noidung,mota");
	if($d->num_rows()>0){
		$row = $d->fetch_array();
		$noidung_about= $row['noidung'];
	}
	
	// thanh tieu de
	$title_bar="";
	$title_bar .= "Chất lượng quốc tế";
?>