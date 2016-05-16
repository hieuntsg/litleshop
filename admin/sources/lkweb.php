<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "man":
		get_items();
		$template = "lkweb/items";
		break;
	case "add":
		$template = "lkweb/item_add";
		break;
	case "edit":
		get_item();
		$template = "lkweb/item_add";
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
	
	$sql = "select * from #_lkweb order by stt,ten";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=lkweb&act=man";
	$maxR=10;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item(){
	global $d, $item;
	@$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=lkweb&act=man");
	
	$sql = "select * from #_lkweb where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=lkweb&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d;
	$file_name=fns_Rand_digit(0,9,8);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=lkweb&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);
		
		if($photo = upload_image("file", 'jpg|png|gif', _upload_hinhanh,$file_name)){
			$data['image'] = $photo;
			
			$d->setTable('lkweb');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);
			}
		}
		
		
		$data['ten'] = $_POST['ten'];
		$data['url'] = $_POST['url'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('lkweb');
		$d->setWhere('id', $id);
		if($d->update($data))
			transfer("Dữ liệu đã được cập nhật", "index.php?com=lkweb&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=lkweb&act=man");
	}else{
	
		if($photo = upload_image("file", 'jpg|png|gif', _upload_hinhanh,$file_name)){
			$data['image'] = $photo;
		}
		
		$data['ten'] = $_POST['ten'];
		$data['url'] = $_POST['url'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('lkweb');
		if($d->insert($data))
			transfer("Dữ liệu đã được lưu", "index.php?com=lkweb&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=lkweb&act=man");
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$sql = "delete from #_lkweb where id='".$id."'";
		if($d->query($sql))
			transfer("Dữ liệu đã được xóa", "index.php?com=lkweb&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=lkweb&act=man");
	}else transfer("Không nhận được dữ liệu", "index.php?com=lkweb&act=man");
}

?>