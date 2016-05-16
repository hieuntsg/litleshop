<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "capnhat":
		get_tuvan();
		$template = "tuvan/item_add";
		break;
	case "save":
		save_tuvan();
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

function get_tuvan(){
	global $d, $item;

	$sql = "select * from #_tuvan limit 0,1";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_tuvan(){
	global $d;
	$file_name=fns_Rand_digit(0,9,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=tuvan&act=capnhat");
	if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG',_upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('tuvan');			
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['tuvan']);
			}
		}
	
	$data['mota'] = $_POST['mota'];
	$data['ten'] = $_POST['ten'];
	$data['keyword'] = $_POST['keyword'];
	$data['description'] = $_POST['description'];
	$data['noidung'] = $_POST['noidung'];
	$d->reset();
	$d->setTable('tuvan');
	if($d->update($data))
		transfer("Dữ liệu được cập nhật", "index.php?com=tuvan&act=capnhat");
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=tuvan&act=capnhat");
}

?>