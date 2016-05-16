<?php  if(!defined('_source')) die("Error");
	$d->reset();
	$sql_sp="select * from #_product where hienthi=1 and banchay<>0 order by stt, id desc ";
	$d->query($sql_sp);
	$result_product=$d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=18;
	$maxP=5;
	$paging=paging_home($result_product, $url, $curPage, $maxR, $maxP);
	$result_product=$paging['source'];

?>