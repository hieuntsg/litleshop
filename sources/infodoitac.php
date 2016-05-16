<?php  if(!defined('_source')) die("Error");
if(isset($_GET['id'])){
	#tin tuc chi tiet
	$id =  addslashes($_GET['id']);
	$sql = "select ten,mota,noidung from #_infodoitac where hienthi=1 and id='".$id."'";
	$d->query($sql);
	$tintuc_detail = $d->result_array();
	$title_bar=$tintuc_detail[0]['ten'].' - ';
	#các tin cu hon
	$sql_khac = "select ten,tenkhongdau,ngaytao,id from #_infodoitac where hienthi=1 and id <>'".$id."' order by stt,ngaytao desc limit 0,5";
	$d->query($sql_khac);
	$tintuc_khac = $d->result_array();
	
}elseif(isset($_GET['idc'])){
	$id =  addslashes($_GET['idc']);
	$sql="select ten,id from #_infodoitac_item where tenkhongdau='$id' limit 0,1 ";
	$d->query($sql);
	$loaitin=$d->result_array();
	$title_bar=$loaitin[0]['ten'].' - ';
	$title_tcat=$loaitin[0]['ten'];
	$sql_tintuc = "select ten,tenkhongdau,mota,thumb,id from #_infodoitac where hienthi=1 and id_item='".$loaitin[0]['id']."'  order by stt,ngaytao desc";
	$d->query($sql_tintuc);
	$tintuc = $d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=9;
	$maxP=5;
	$paging=paging_home($tintuc, $url, $curPage, $maxR, $maxP);
	$tintuc=$paging['source'];
}else{
	$title_bar='Đối tác - ';		
	$title_tcat='Tin tức';	
	$sql_tintuc = "select ten,tenkhongdau,mota,thumb,id from #_infodoitac where hienthi=1 order by stt,ngaytao desc";
	$d->query($sql_tintuc);
	$tintuc = $d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=9;
	$maxP=5;
	$paging=paging_home($tintuc, $url, $curPage, $maxR, $maxP);
	$tintuc=$paging['source'];
}
$tintuc1=$tintuc;
?>