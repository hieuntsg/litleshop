<?php	if(!defined('_source')) die("Error");

$act  =  (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "default":
		get_news();
		$template  =  "mausac1/news";
		break;
	case "add":
		$template  =  "mausac1/news_add";
		break;
	case "edit":		
		get_news_edit();		
		$template  =  "mausac1/news_add";
		break;
	case "save":
		save_news();
		break;
	case "delete":
		delete_news();
		break;
	default:
		$template  =  "order_num";
}

function fns_Rand_digit($min,$max,$num)
	{
		$result = '';
		for($i = 0;$i<$num;$i++){
			$result .= rand($min,$max);
		}
		return $result;	
	}


function get_news(){
	global $d, $news, $paging;
	
	
	
	$news_query = "SELECT * FROM #_mausac1 where id_product='".$_REQUEST['id_product']."' ORDER BY stt DESC";
	
	$d->query($news_query);
	$news = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url = getCurrentPageURL();
	$maxR = 20;
	$maxP = 4;
	$paging = paging($news, $url, $curPage, $maxR, $maxP);
	$news = $paging['source'];
}

function get_news_edit(){
	global $d, $news;
	$id_news = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id_news){
		transfer("Không nhận được dữ liệu", "index.php?com=mausac1&act=default&id_product=".$_REQUEST['id_product']);
	}
	$news_query =  "SELECT * FROM #_mausac1 WHERE id = '" . $id_news . "'";
	$d->query($news_query);
	if($d->num_rows() == 0) transfer("Dữ liệu không có thực", "index.php?com=mausac1&act=default&id_product=".$_REQUEST['id_product']);
	$news = $d->fetch_array();
}

function save_news(){
	global $d;
	$file_name = fns_Rand_digit(0,9,8);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=mausac1&act=default&id_product=".$_REQUEST['id_product']);
	$id_news = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id_news){
		$id_news = themdau($_POST['id']);
		
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG',_upload_sanpham,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 496, 680, _upload_sanpham,$file_name,1);
			$d->setTable('mausac1');
			$d->setWHERE('id', $id_news);
			$d->SELECT();
			if($d->num_rows() > 0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham . $row['photo']);
				delete_file(_upload_sanpham . $row['thumb']);
			}
		}
		
		$data['ten']  =  $_POST['ten'];
		$data['tenkhongdau']  =  changeTitle($_POST['nameten']);
		$data['id_product']  =  $_REQUEST['id_product'];
		$data['stt']  =  $_POST['order_num'];
		
		
		$d->setTable('mausac1');
		$d->setWHERE('id', $id_news);
		if($d->update($data))
				redirect("index.php?com=mausac1&act=default&id_product=".$_REQUEST['id_product']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=mausac1&act=default&id_product=".$_REQUEST['id_product']);
	}else{
		
		if($photo  =  upload_image("file", 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG',_upload_sanpham,$file_name)){
			$data['photo']  =  $photo;
			
			$data['thumb'] = create_thumb($data['photo'], 496, 680, _upload_sanpham,$file_name,1);
		}
		$data['ten']  =  $_POST['ten'];
		$data['tenkhongdau']  =  changeTitle($_POST['nameten']);
		$data['id_product']  = $_REQUEST['id_product'];
		$data['stt']  =  $_POST['order_num'];
		
		$d->setTable('mausac1');
		if($d->insert($data))
			redirect("index.php?com=mausac1&act=default&id_product=".$_REQUEST['id_product']);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=mausac1&act=default&id_product=".$_REQUEST['id_product']);
	}
}

function delete_news(){
	global $d;
	
	if(isset($_GET['id'])){
		$id = themdau($_GET['id']);
		
		$d->reset();
		$sql  =  "SELECT * FROM #_mausac1 WHERE id = '" . $id . "'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row  =  $d->fetch_array()){
				delete_file(_upload_sanpham . $row['photo']);
				delete_file(_upload_sanpham . $row['thumb']);
			}
			$sql  =  "delete FROM #_mausac1 WHERE id = '" . $id . "'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			redirect("index.php?com=mausac1&act=default&id_product=".$_REQUEST['id_product']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=mausac1&act=default&id_product=".$_REQUEST['id_product']);
	}else transfer("Không nhận được dữ liệu", "index.php?com=mausac1&act=default&id_product=".$_REQUEST['id_product']);
}

$news_active  =  'style="color:#f66;"';
?>