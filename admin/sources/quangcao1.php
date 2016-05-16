<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "man_photo":
		get_photos();
		$template = "quangcao1/photos";
		break;
	case "add_photo":
		$template = "quangcao1/photo_add";
		break;
	case "edit_photo":
		get_photo();
		$template = "quangcao1/photo_edit";
		break;
	case "save_photo":
		save_photo();
		break;
	case "delete_photo":
		delete_photo();
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
function get_photos(){
	global $d, $items, $paging;
	
	#----------------------------------------------------------------------------------------
	
		if($_REQUEST['hienthi']!='')
		{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_quangcao1 where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_quangcao1 SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sql UPDATE_ORDER");
		}
		else
		{
		 $sqlUPDATE_ORDER = "UPDATE table_quangcao1 SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sql UPDATE_ORDER");
		}	
		}

$sql = "select * from #_quangcao1";	
	if((int)$_REQUEST['id_cat']!='')
	{
	$sql.=" where id_cat=".(int)$_REQUEST['id_cat']."";
	}
	
	if((int)$_REQUEST['id_list']!='')
	{
	$sql.=" and id_list=".(int)$_REQUEST['id_list']."";
	}
	if((int)$_REQUEST['id_item']!='')
	{
	$sql.=" and id_item=".(int)$_REQUEST['id_item']."";
	}
	$sql.=" order by stt,id desc";
	
	$d->query($sql);
	$items = $d->result_array();

	/*$d->setTable('quangcao1');
	$d->setOrder('stt,id desc');
	$d->select('*');
	$d->query();
	$items = $d->result_array();*/
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=quangcao1&act=man_photo&id_cat=".$_REQUEST['id_cat']."&id_list=".$_REQUEST['id_list']."&id_item=".$_REQUEST['id_item']."&curPage=".$_REQUEST['curPage']."";
	$maxR=10;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];

}
function get_photo(){
	global $d, $item, $list_cat;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=quangcao1&act=man_photo");
	
	$d->setTable('quangcao1');
	
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=quangcao1&act=man_photo");
	$item = $d->fetch_array();
	$d->reset();
}
function save_photo(){
	global $d;
	$file_name=fns_Rand_digit(0,9,6);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=quangcao1&act=man_photo");
	
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){ // cap nhat
			//print_r($_POST['prolist']);exit;
			if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG', _upload_sanpham,$file_name)){
				$data['photo'] = $photo;
				$data['thumb'] = create_thumb($data['photo'], 496, 680, _upload_sanpham,$file_name,1);				
				$d->setTable('quangcao1');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);				
				}
			}
		
			foreach ($_POST['prolist'] as $key => $value) {
						if(count($_POST['prolist'])  == 1)
							$data['id_product'] = $value;
						else{
							
							$data['id_product'] .= $value.',';
							
						}
					}	
			$data['id_cat'] = $_POST['id_cat'];
			$data['id_list'] = $_POST['id_list'];
			$data['id_item'] = $_POST['id_item'];
			$data['stt'] = $_POST['stt'];
			$data['ten'] = $_POST['ten'];
			$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
			$data['vitri'] = $_POST['vitri'];
			
			$d->reset();
			$d->setTable('quangcao1');
			$d->setWhere('id', $id);
			if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=quangcao1&act=man_photo");
			header("Location:index.php?com=quangcao1&act=man_photo");
	}else{ // them moi
		
			
				if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG', _upload_sanpham,$file_name))
					{
						$data['photo'] = $photo;					
						$data['thumb'] = create_thumb($data['photo'], 496, 680, _upload_sanpham,$file_name,1);		
					}
				foreach ($_POST['prolist'] as $key => $value) {
						if(count($_POST['prolist'])  == 1)
							$data['id_product'] = $value;
						else{
							
							$data['id_product'] .= $value.',';
							
						}
					}	
						$data['id_cat'] = $_POST['id_cat'];
						$data['id_list'] = $_POST['id_list'];
						$data['id_item'] = $_POST['id_item'];
						$data['stt'] = $_POST['stt'];
						$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
						$data['ten'] = $_POST['ten'];
						$data['mota'] = $_POST['mota'];
						$data['vitri'] = $_POST['vitri'];

					
						
						$d->setTable('quangcao1');
						if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=quangcao1&act=man_photo");	
			
			header("Location:index.php?com=quangcao1&act=man_photo");
		
	}
}


function delete_photo(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->setTable('quangcao1');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=quangcao1&act=man_photo");
		$row = $d->fetch_array();
		delete_file(_upload_sanpham.$row['photo']);
		delete_file(_upload_sanpham.$row['thumb']);		
		if($d->delete())
		
			header("Location:index.php?com=quangcao1&act=man_photo");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=quangcao1&act=man_photo");
	}elseif (isset($_GET['listid'])==true){

		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_quangcao1 where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);
			}
			$sql = "delete from #_quangcao1 where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=quangcao1&act=man_photo");
	} 
	else transfer("Không nhận được dữ liệu", "index.php?com=quangcao1&act=man_photo");
}

?>

	
