<?php  if(!defined('_source')) die("Error");
if(isset($_GET['id'])){
	#Detail
	$id =  addslashes($_GET['id']);
	$sql = "select photo from #_hinhanh where hienthi=1 and id_photo='".$id."'";
	$d->query($sql);
	$result_detail = $d->result_array();

	
}else{
	$title_bar='Abum hình ảnh - ';		
	$sql = "select ten,tenkhongdau,photo,id from table_alpum where hienthi=1  order by stt,ngaytao desc";
	$d->query($sql);
	$result_hinhanh = $d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=20;
	$maxP=5;
	$paging=paging_home($result_hinhanh, $url, $curPage, $maxR, $maxP);
	$result_hinhanh=$paging['source'];
}
?>