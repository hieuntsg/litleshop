<?php  if(!defined('_source')) die("Error");
if(isset($_GET['id'])){
	#tin tuc chi tiet
	$id =  addslashes($_GET['id']);
	$sql = "select * from #_news where hienthi=1 and id='".$id."'";
	$d->query($sql);
	$tintuc_detail = $d->result_array();
	$title_bar=$tintuc_detail[0]['ten'].' - ';
	#các tin cu hon
	$sql_khac = "select ten,tenkhongdau,ngaytao,id from #_news where hienthi=1 and id <>'".$id."' order by stt,ngaytao desc limit 0,5";
	$d->query($sql_khac);
	$tintuc_khac = $d->result_array();
	
}elseif(isset($_GET['idc'])){
	$id =  addslashes($_GET['idc']);
	$sql="select ten,id from #_news_item where tenkhongdau='$id' limit 0,1 ";
	$d->query($sql);
	$loaitin=$d->result_array();
	$title_bar=$loaitin[0]['ten'];
	$title_tcat=$loaitin[0]['ten'];
	$sql_tintuc = "select * from #_news where hienthi=1 and id_item='".$loaitin[0]['id']."'  order by stt,ngaytao desc";
	$d->query($sql_tintuc);
	$result_source = $d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=6;
	$maxP=5;
	$paging=paging_home($result_source, $url, $curPage, $maxR, $maxP);
	$result_source=$paging['source'];
}else{
	$title_bar='Tin tức';
	$title_tcat='Tin tức';		
	$sql = "select * from #_news where hienthi=1 order by stt,ngaytao asc";
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