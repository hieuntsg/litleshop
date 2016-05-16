<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "company/item_add";
		break;
	case "save":
		save_gioithieu();
		break;
		
	default:
		$template = "index";
}

function get_gioithieu(){
	global $d, $item;

	$sql = "select * from #_company limit 0,1";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_gioithieu(){
	global $d;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=company&act=capnhat");
	
	$data['ten'] = $_POST['ten'];
	$data['diachi'] = $_POST['diachi'];
	$data['dienthoai'] = $_POST['dienthoai'];
	$data['email'] = $_POST['email'];
	$data['face'] = $_POST['face'];
	$data['taikhoang'] = $_POST['taikhoang'];
	
	$d->reset();
	$d->setTable('company');
	if($d->update($data)){
		transfer("Dữ liệu đã được cập nhật", "index.php?com=company&act=capnhat");
		header("Location:index.php?com=company&act=capnhat");
		}
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=company&act=capnhat");
}



?>