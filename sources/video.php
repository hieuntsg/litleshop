
<?php  if(!defined('_source')) die("Error");

	$title_bar='Video - ';		
	$sql = "select ten,photo,id,mota from table_logodoitac where hienthi=1  order by id desc";
	$d->query($sql);
	$result_video= $d->result_array();


?>