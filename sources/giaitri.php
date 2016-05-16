<?php  if(!defined('_source')) die("Error");

	$title_bar='Thư viện video - ';	
	$sql_tintuc = "select ten,id from #_giaitri_item where hienthi=1 order by id desc";
	$d->query($sql_tintuc);
	$result_video_item = $d->result_array();
	

?>