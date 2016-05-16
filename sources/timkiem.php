
<?php  if(!defined('_source')) die("Error");

	
	$title_bar='Tìm kiếm';		
	$sql_tk = "select * from #_product where hienthi=1 and (tenkhongdau like '%".$_GET['search']."%' or maso like '%".$_GET['search']."%') order by id desc ";
	$d->query($sql_tk);
	$tk= $d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=12;
	$maxP=5;
	$paging=paging_home($tk, $url, $curPage, $maxR, $maxP);
	$tk=$paging['source'];

?>