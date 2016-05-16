<?php
session_start();
$_SESSION['id_old']=0;
if(!defined('_source')) die("Error");
if(isset($_GET['id'])){
	$id =  addslashes($_GET['id']);
	
	/*if($id<>0){
		//$_SESSION['id_old']=$id;
		echo 'ngu mai';
	}
	if($id==$_SESSION['id_old']){
		$_SESSION['id_old']=$id;
		echo 'ngu';
	}*/

	$sql_lanxem = "UPDATE #_product SET luotxem=luotxem+1  WHERE id ='".$id."'";
	$d->query($sql_lanxem);
	
	#product detail
	//$id =  addslashes($_GET['id']);
	$sql = "select * from #_product where hienthi=1 and id='".$id."'";
	$d->query($sql);
	$result_detail = $d->result_array();
	$title_bar=$result_detail[0]['ten'];
	
	$d->reset();
	$sql="select * from #_mausac where id_product='".$result_detail[0]['id']."'";
		$d->query($sql);
		$color = $d->result_array();
	
	
	#product order
	$d->reset();
	if($result_detail[0]['id_list']<>0){
		$sql = "select * from #_product where hienthi=1 and id <>'".$id."' and id_list='".$result_detail[0]['id_list']."' order by stt,ngaytao desc limit 0,9";
	}
	else if($result_detail[0]['id_cat']<>0){
		$sql = "select * from #_product where hienthi=1 and id <>'".$id."' and id_cat='".$result_detail[0]['id_cat']."' order by stt,ngaytao desc limit 0,9";
	    $result_detail[0]['id_cat'];
	}
	$d->query($sql);
	$result_product = $d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=12;
	$maxP=5;
	$paging=paging_home($result_product, $url, $curPage, $maxR, $maxP);
	$result_product=$paging['source'];
	
}elseif(isset($_GET['idc'])){
	$id =  addslashes($_GET['idc']);
	$sql="select * from #_product_cat where tenkhongdau='$id' limit 0,1 ";
	$d->query($sql);

	

	$loaitin=$d->result_array();
	$title_bar=$loaitin[0]['ten'];
	$title_tcat=$loaitin[0]['ten'];
	$id_spcat = $loaitin[0]['id'].'-0-0';
	$sql = "select * from #_product where hienthi=1 and id_cat='".$loaitin[0]['id']."'   order by stt,id asc";
	$d->query($sql);
	$result_product = $d->result_array();

	/*$sql_sp1 = "select * from #_product where hienthi=1 and id_cat = 19 and noibat <> 0 order by stt,id asc";
	$d->query($sql_sp1);
	$result_them = $d->result_array();*/
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=16;
	$maxP=5;
	$paging=paging_home($result_product, $url, $curPage, $maxR, $maxP);
	$result_product=$paging['source'];
}


elseif(isset($_GET['idl'])){
	$id =  addslashes($_GET['idl']);

	$sql="select * from #_product_list where id='$id' limit 0,1 ";
	$d->query($sql);
	$loaitin=$d->result_array();
	//print_r($loaitin);exit;
	$id_cat =$loaitin[0]['id_cat'];
	$sql_cat ="select ten from #_product_cat where id='$id_cat' limit 0,1";
	$d->query($sql_cat);
	$cat=$d->result_array();
	//$ten_cat = $cat[0]['ten'];
	
	$id_spcat = $id_cat.'-'.$id.'-0';
	//$title_bar=$cat[0]['ten'].' - '.$loaitin[0]['ten'].' - ';
	$title_bar= $loaitin[0]['ten'];
	$title_tcat=$loaitin[0]['ten'];
	$sql_product = "select * from #_product where hienthi=1 and id_list='".$loaitin[0]['id']."'   order by stt,id asc";
	$d->query($sql_product);
	$result_product = $d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=16;
	$maxP=5;
	$paging=paging_home($result_product, $url, $curPage, $maxR, $maxP);
	$result_product=$paging['source'];
}


elseif($_REQUEST['idi']!='')
{
	$id =  addslashes($_GET['idi']);
	$sql="select * from #_product_item where id='$id' limit 0,1 ";
	$d->query($sql);
	$loaitin=$d->result_array();
	$title_bar=$loaitin[0]['ten'];
	$title_tcat=$loaitin[0]['ten'];

	$sql_cat ="select id from #_product_list where id=".$loaitin[0]['id_list']." limit 0,1";
	$d->query($sql_cat);
	$id_list=$d->fetch_array();

	$sql_cat ="select id from #_product_cat where id=".$loaitin[0]['id_cat']." limit 0,1";
	$d->query($sql_cat);
	$id_cat=$d->fetch_array();


	$id_spcat = $id_cat['id'].'-'.$id_list['id'].'-'.$id;	 
	$sql_product = "select * from #_product where hienthi=1 and id_item='".$loaitin[0]['id']."'   order by stt,id asc";
	$d->query($sql_product);
	$result_product = $d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=16;
	$maxP=5;
	$paging=paging_home($result_product, $url, $curPage, $maxR, $maxP);
	$result_product=$paging['source'];
	
}

else{	
	$sql_sp = "select * from #_product where hienthi=1 order by stt,id asc";
	$d->query($sql_sp);
	$result_product = $d->result_array();

	


	$title_bar='Sản phẩm';
	$title_tcat='Sản phẩm';
	$id_spcat = "0-0-0";
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=16;
	$maxP=5;
	$paging=paging_home($result_product, $url, $curPage, $maxR, $maxP);
	$result_product=$paging['source'];

}
?>