<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
if(isset($_REQUEST['id'])){
$id=$_REQUEST['id'];}
switch($act){

	case "man":
		get_items();
		$template = "danhgiasp/items";
		break;
	case "add":		
		$template = "danhgiasp/item_add";
		break;
	case "edit":		
		get_item();
		$template = "danhgiasp/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	#===================================================	
	case "man_cat":
		get_cats();
		$template = "danhgiasp/cats";
		break;
	case "add_cat":		
		$template = "danhgiasp/cat_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "danhgiasp/cat_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;
		#===================================================	
	case "man_danhmuc":
		get_danhmucs();
		$template = "danhgiasp/danhmucs";
		break;
	case "add_danhmuc":		
		$template = "danhgiasp/danhmuc_add";
		break;
	case "edit_danhmuc":		
		get_danhmuc();
		$template = "danhgiasp/danhmuc_add";
		break;
	case "save_danhmuc":
		save_danhmuc();
		break;
	case "delete_danhmuc":
		delete_danhmuc();
		break;
	#===================================================	
	case "man_list":
		get_lists();
		$template = "danhgiasp/lists";
		break;
	case "add_list":		
		$template = "danhgiasp/list_add";
		break;
	case "edit_list":		
		get_list();
		$template = "danhgiasp/list_add";
		break;
	case "save_list":
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;
	default:
		$template = "index";
}

#====================================
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}

function get_items(){
	global $d, $items, $paging;	
	
	#----------------------------------------------------------------------------------------
	
		if($_REQUEST['hienthi']!='')
		{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_danhgiasp where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_danhgiasp SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sql UPDATE_ORDER");
		}
		else
		{
		 $sqlUPDATE_ORDER = "UPDATE table_danhgiasp SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sql UPDATE_ORDER");
		}	
		}
	#-------------------------------------------------------------------------------
	$sql = "select * from #_danhgiasp";	
	if((int)$_REQUEST['id_sp']!='')
	{
	$sql.=" where id_sp=".(int)$_REQUEST['id_sp']."";
	}
	
	$sql.=" order by id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	
	$url="index.php?com=danhgiasp&act=man";
	$maxR=15;
	$maxP=20;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=danhgiasp&act=man");
	
	$sql = "select * from #_danhgiasp where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=danhgiasp&act=man");
	$item = $d->fetch_array();	
}
function delete_item(){
	global $d;
	if($_REQUEST['id_cat']!='')
	{ $id_catt="&id_cat=".$_REQUEST['id_cat'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select * from #_danhgiasp where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);			
			}
		$sql = "delete from #_danhgiasp where id='".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=danhgiasp&act=man".$id_catt."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=danhgiasp&act=man");
	}
	elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_danhgiasp where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);
			}
			$sql = "delete from #_danhgiasp where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=danhgiasp&act=man");} else transfer("Không nhận được dữ liệu", "index.php?com=danhgiasp&act=man");
		
}