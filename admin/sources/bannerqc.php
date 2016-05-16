<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	
	case "capnhat":
		get_banner();
		$template = "bannerqc/logo_add";
		break;
	case "save":
		save_banner();
		break;
	#====================================
	case "man_banner":
		get_banner_giua();
		$template = "bannerqc/banner_giua_add";
		break;
	case "save_banner_giua":
		save_banner_giua();
		break;
	
	case "man_phai":
		get_banner_phai();
		$template = "bannerqc/banner_phai_add";
		break;
	case "save_banner_phai":
		save_banner_phai();
		break;
		
	case "man_duoi":
		get_banner_duoi();
		$template = "bannerqc/banner_duoi_add";
		break;
	case "save_banner_duoi":
		save_banner_duoi();
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


function get_banner(){
	global $d, $item;

	$sql = "select * from #_photo where com='banner_top'";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_banner(){
	global $d;
	$file_name=fns_Rand_digit(0,9,3);
	$sql = "select * from #_photo where com='banner_top'";
	$d->query($sql);
	$item = $d->fetch_array();
	$id=$item['id'];
	//echo dump($id);
	
	if($id){ // cap nhat
		if($photo = upload_image("file", 'swf|png|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('photo');
			$d->setWhere('id', $id);
			$d->select();
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['photo']);
		}
		$data['photo'] = $photo;
		//echo dump($id);
		$d->setTable('photo');
		$d->setWhere('id', $id);
		$d->setWhere('com','banner_top');
		if($d->update($data))
			redirect("index.php?com=bannerqc&act=capnhat");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=bannerqc&act=capnhat");
	}else{ // them moi
		$data['photo'] = upload_image("file", 'swf|png|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name);
		if(!$data['photo']) $data['photo']="";
		
		$data['com']='banner_top';
		$d->setTable('photo');
		if($d->insert($data))
		redirect("index.php?com=bannerqc&act=capnhat");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=bannerqc&act=capnhat");
	
}
}


function get_banner_giua(){
	global $d, $item_banner;

	$sql = "select * from #_photo where com='banner_giua'";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item_banner = $d->fetch_array();
}

function save_banner_giua(){
	global $d;
	$file_name=fns_Rand_digit(0,9,5);
	$sql = "select * from #_photo where com='banner_giua'";
	$d->query($sql);
	$item = $d->fetch_array();
	$id=$item['id'];
	//echo dump($id);
	
	if($id){ // cap nhat
		if($photo = upload_image("file", 'swf|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('photo');
			$d->setWhere('id', $id);
			$d->select();
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['photo']);
		}
		$data['photo'] = $photo;
		//echo dump($id);
		$d->setTable('photo');
		$d->setWhere('id', $id);
		$d->setWhere('com','banner_giua');
		if($d->update($data))
			redirect("index.php?com=bannerqc&act=man_banner");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=bannerqc&act=man_banner");
	}else{ // them moi
		$data['photo'] = upload_image("file", 'swf|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name);
		if(!$data['photo']) $data['photo']="";
		
		$data['com']='banner_giua';
		$d->setTable('photo');
		if($d->insert($data))
			//transfer("Dữ liệu đã được lưu", "index.php?com=bannerqc&act=man_banner");
			redirect("index.php?com=bannerqc&act=man_banner");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=bannerqc&act=man_banner");
	
}
}

function get_banner_phai(){
	global $d, $item_banner;

	$sql = "select * from #_photo where com='banner_phai'";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item_banner = $d->fetch_array();
}

function save_banner_phai(){
	global $d;
	$file_name=fns_Rand_digit(0,9,7);
	$sql = "select * from #_photo where com='banner_phai'";
	$d->query($sql);
	$item = $d->fetch_array();
	$id=$item['id'];
	//echo dump($id);
	
	if($id){ // cap nhat
		if($photo = upload_image("file", 'gif|jpg|png', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('photo');
			$d->setWhere('id', $id);
			$d->select();
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['photo']);
		}
		$data['photo'] = $photo;
		//echo dump($id);
		$d->setTable('photo');
		$d->setWhere('id', $id);
		$d->setWhere('com','banner_phai');
		if($d->update($data))
			redirect("index.php?com=bannerqc&act=man_phai");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=bannerqc&act=man_phai");
	}else{ // them moi
		$data['photo'] = upload_image("file", 'gif|jpg|png', _upload_hinhanh,$file_name);
		if(!$data['photo']) $data['photo']="";
		
		$data['com']='banner_phai';
		$d->setTable('photo');
		if($d->insert($data))
			//transfer("Dữ liệu đã được lưu", "index.php?com=bannerqc&act=man_banner");
			redirect("index.php?com=bannerqc&act=man_phai");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=bannerqc&act=man_phai");
	
}
}

function get_banner_duoi(){
	global $d, $item_banner;

	$sql = "select * from #_photo where com='doitac'";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item_banner = $d->fetch_array();
}

function save_banner_duoi(){
	global $d;
	$file_name=fns_Rand_digit(0,9,7);
	$sql = "select * from #_photo where com='doitac'";
	$d->query($sql);
	$item = $d->fetch_array();
	$id=$item['id'];
	//echo dump($id);
	
	if($id){ // cap nhat
		if($photo = upload_image("file", 'gif|jpg|png', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('photo');
			$d->setWhere('id', $id);
			$d->select();
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['photo']);
		}
		$data['photo'] = $photo;
		//echo dump($id);
		$d->setTable('photo');
		$d->setWhere('id', $id);
		$d->setWhere('com','doitac');
		if($d->update($data))
			redirect("index.php?com=bannerqc&act=man_duoi");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=bannerqc&act=man_duoi");
	}else{ // them moi
		$data['photo'] = upload_image("file", 'gif|jpg|png', _upload_hinhanh,$file_name);
		if(!$data['photo']) $data['photo']="";
		
		$data['com']='doitac';
		$d->setTable('photo');
		if($d->insert($data))
			//transfer("Dữ liệu đã được lưu", "index.php?com=bannerqc&act=man_banner");
			redirect("index.php?com=bannerqc&act=man_duoi");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=bannerqc&act=man_duoi");
	
}
}


?>