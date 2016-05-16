<?php  if(!defined('_source')) die("Error");
	$d->reset();
	$sql_sp="select * from #_product where hienthi=1 order by luotxem desc, stt, id desc ";
	$d->query($sql_sp);
	$spxnn=$d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=6;
	$maxP=5;
	$paging=paging_home($spxnn, $url, $curPage, $maxR, $maxP);
	$spxnn=$paging['source'];

?>