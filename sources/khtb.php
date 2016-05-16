<?php  if(!defined('_source')) die("Error");
if(isset($_GET['id'])){
	$d->reset();
	#tin tuc chi tiet
	$id =  addslashes($_GET['id']);
	$sql = "select * from #_khtb where hienthi=1 and id='".$id."'";
	$d->query($sql);
	$tintuc_detail = $d->result_array();
	$title_bar=$tintuc_detail[0]['ten'];
	#các tin cu hon
	$sql_khac = "select * from #_khtb where hienthi=1 and id <>'".$id."' order by stt,ngaytao desc limit 0,5";
	$d->query($sql_khac);
	$tintuc_khac = $d->result_array();
	
}else{
	$title_bar='Thắc mắc và hướng dẫn';
	$d->reset();		
	$sql = "select * from #_khtb where hienthi=1 order by stt,ngaytao desc";
	$d->query($sql);
	$result_source = $d->result_array();
	
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=10;
	$maxP=5;
	$paging=paging_home($result_source, $url, $curPage, $maxR, $maxP);
	$result_source=$paging['source'];
}
?>