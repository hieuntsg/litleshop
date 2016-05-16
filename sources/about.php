<?php  if(!defined('_source')) die("Error");
	$d->setTable('about');
	$d->select("photo,noidung,mota");
	if($d->num_rows()>0){
		$row = $d->fetch_array();
		$noidung_about= $row['noidung'];
		$photo_about= $row['photo'];
	}
	
	// thanh tieu de
	$title_bar="";
	$title_bar .= "Giới thiệu";
?>