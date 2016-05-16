<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "man":
		get_items();
		$template = "hotline/items";
		break;
	case "add":
		$template = "hotline/item_add";
		break;
	case "edit":
		get_item();
		$template = "hotline/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
		
	default:
		$template = "index";
}


function get_items(){
	global $d, $items, $paging;
	
	$sql = "select * from #_hotline";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=hotline&act=man";
	$maxR=10;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=hotline&act=man");
	
	$sql = "select * from #_hotline where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=hotline&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=hotline&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){ // cap nhat
		$id =  themdau($_POST['id']);
		$data['ten'] = $_POST['ten'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('hotline');
		$d->setWhere('id', $id);
		if($d->update($data))
			header("Location:index.php?com=hotline&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=hotline&act=man");
	}else{ // them moi
		$data['ten'] = $_POST['ten'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('hotline');
		if($d->insert($data))
			header("Location:index.php?com=hotline&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=hotline&act=man");
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		
		// xoa item
		$sql = "delete from #_hotline where id='".$id."'";
		if($d->query($sql))
			header("Location:index.php?com=hotline&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=hotline&act=man");
	}else transfer("Không nhận được dữ liệu", "index.php?com=hotline&act=man");
}
#--------------------------------------------------------------------------------------------- photo

?>

	
