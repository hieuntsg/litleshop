<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "man":
		get_items();
		$template = "thanhvien/items";
		break;
	case "add":
		$template = "thanhvien/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "thanhvien/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
		
	#==================================================
	case "editphi":		
		get_item();		
		$template = "thanhvien/phi";
		break;
	case "savephi":
		save_phi();
		break;	
	
	case "manvip":
		get_itemsvip();
		$template = "thanhvien/itemsvip";
		break;
	case "addvip":
		$template = "thanhvien/item_addvip";
		break;
	case "editvip":		
		get_item();		
		$template = "thanhvien/item_addvip";
		break;
	case "codelogin":		
		get_item();		
		$template = "thanhvien/code_vip";
		break;	
	case "savecodevip":
		save_itemcodevip();
		break;
	case "savevip":
		save_itemvip();
		break;
	case "delete":
		delete_item();
		break;	
	#===================================================	

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
	
	
	if(@$_REQUEST['khoa']!='')
	{
	$id_up = @$_REQUEST['khoa'];
	$sql_sp = "SELECT id,khoa FROM table_thanhvien where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['khoa'];
	//echo "id:". $spdc1;
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_thanhvien SET khoa =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_thanhvien SET khoa =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
	
	if(@$_REQUEST['comment']!='')
	{
	$id_up = @$_REQUEST['comment'];
	$sql_sp = "SELECT id,combinhluan FROM table_thanhvien where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['combinhluan'];
	//echo "id:". $spdc1;
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_thanhvien SET combinhluan =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_thanhvien SET combinhluan =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}	
	
	$sql = "select * from #_thanhvien";

	$sql.=" order by id desc limit 0,20";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	if($_REQUEST['id_cat']!='')$url="index.php?com=thanhvien&act=manvip&id_cat=".$_REQUEST['id_cat'];
	else $url="index.php?com=thanhvien&act=man";
	$maxR=25;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}
	
function get_itemsvip(){
	global $d, $items, $paging;
	
	
	if(@$_REQUEST['khoa']!='')
	{
	$id_up = @$_REQUEST['khoa'];
	$sql_sp = "SELECT id,khoa FROM table_thanhvien where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['khoa'];
	//echo "id:". $spdc1;
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_thanhvien SET khoa =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_thanhvien SET khoa =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
	
	$sql = "select * from #_thanhvien where comvip='vip' or loaidangki='1'";
	if(isset($_REQUEST['id_cat'])){
	if((int)$_REQUEST['id_cat']!='')
	{
	$sql.=" where  	id_item=".$_REQUEST['id_cat']."";
	}}
	$sql.=" order by id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	if($_REQUEST['id_cat']!='')$url="index.php?com=thanhvien&act=man&vip&id_cat=".$_REQUEST['id_cat'];
	else $url="index.php?com=thanhvien&act=manvip";
	$maxR=25;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=man");
	
	$sql = "select * from #_thanhvien where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=thanhvien&act=man");
	$item = $d->fetch_array();
}
function save_itemcodevip(){
	global $d;
	$file_name=fns_Rand_digit(0,9,9);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=codelogin");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);
		$data['email']=$_POST['email'];
		$email=$_POST['email'];
		if(!empty($_POST['email'])){
			$madangnhap=$email.$file_name;
			$data['madangnhap'] = $madangnhap;

		}
		
		$d->setTable('thanhvien');
		$d->setWhere('id', $id);
		if($d->update($data)){
				transfer("Tạo mã đăng nhập thành công", "index.php?com=thanhvien&act=codelogin&id=".$id);
		}else{
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=thanhvien&act=codelogin&id=".$id);
			}
	}
}

function save_phi(){
	global $d;
	$file_name=fns_Rand_digit(0,9,9);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu","index.php?com=thanhvien&act=editphi&id=".$id);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$ngaysuaphi=time();
		$id =  themdau($_POST['id']);
		$data['id_banggianam']=$_POST['chonphi'];
		$data['ngaydongphi']=$_POST['ngaydongphi'];
		$data['ngaysuaphi']=$ngaysuaphi;
		$d->setTable('thanhvien');
		$d->setWhere('id', $id);
		if($d->update($data)){
			$d->reset();
			$sql_banggianam1="select id_banggianam from table_thanhvien where id='".$id."'";
			$d->query($sql_banggianam1);
			$result_banggianam1=$d->result_array();		
		
			$d->reset();
			$sql_banggianam="select * from table_banggianam where id='".$result_banggianam1[0]['id_banggianam']."'";
			$d->query($sql_banggianam);
			$result_banggianam=$d->result_array();
		
			$d->reset();
			$sql_date="select DATE_ADD(ngaydongphi, INTERVAL ".$result_banggianam[0]['nam']." YEAR) as ngay from table_thanhvien where id= '".$items[$i]['id']."'";
			$d->query($sql_date);
			$result_date=	$d->result_array();
			
			$d->reset();
			$sql_thoihan="update table_thanhvien set thoihanxem='".$result_date[0]['ngay']."' where id='".$id."'";
			$d->query($sql_thoihan);
			
			
			transfer("Sửa mức phí thành công",  "index.php?com=thanhvien&act=editphi&id=".$id);
		}else{
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=thanhvien&act=editphi&id=".$id);
			}
	}
}
function save_itemvip(){
	global $d;
	$file_name=fns_Rand_digit(0,9,8);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=edit");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'JPG|jpg|png|gif',_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 120,80, _upload_tintuc,$file_name);
			$d->setTable('hoasi');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				
			}
		}
		$sql4="select quydinhlephi from table_user limit 0,1";
		$d->query($sql4);
		$result_qdlp=$d->result_array();
		$data['sotiendong'] = (int)$_POST['sotiendong'];
		$data['ngaysua'] = time();
		$data['ngaydongphi'] =  $_POST['ngaydongphi'];
		$data['comvip'] = isset($_POST['comvip']) ? 'vip' : '';
		$data['khoa'] = isset($_POST['khoa']) ? 1 : 0;
		
		if($data['ngaydongphi']=="0000-00-00" && $data['sotiendong']!="")
		{	
				transfer("Chưa có ngày đóng phí", "index.php?com=thanhvien&act=editvip&id=".$id);
		}
		$d->setTable('thanhvien');
		$d->setWhere('id', $id);
		if($d->update($data)){
				if($data['sotiendong'] >= 20000000){
					$sql1="update table_thanhvien set role=4 where id='".$id."'";
					$d->query($sql1);
				}elseif($data['sotiendong'] > $result_qdlp[0]['quydinhlephi']){
					$sql2="update table_thanhvien set role=3 where id='".$id."'";
					$d->query($sql2);
				}else{
					$sql3="update table_thanhvien set role=1 where id='".$id."'";
					$d->query($sql3);
				}
				transfer("Cập nhật dữ liệu thành công", "index.php?com=thanhvien&act=editvip&id=".$id);
		}else{
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=thanhvien&act=editvip&id=".$id);
			}
	}else{
		
		if($photo = upload_image("file", 'JPG|jpg|png|gif',_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 120, 80, _upload_tintuc,$file_name);
		}
		$data['tenhoasi'] = $_POST['tenhoasi'];
		$data['name'] = $_POST['name'];
		$data['diachi'] = $_POST['diachi'];
		$data['address'] = $_POST['address'];
		$data['history'] = $_POST['history'];
		$data['tieusu'] = $_POST['tieusu'];		
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
	
		$d->setTable('hoasi');
		if($d->insert($data))
			redirect("index.php?com=hoasi&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=hoasi&act=man");
	}
}
function save_item(){
	global $d;
	$file_name=fns_Rand_digit(0,9,8);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=edit");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'JPG|jpg|png|gif',_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 120,80, _upload_tintuc,$file_name);
			$d->setTable('hoasi');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				
			}
		}
		$sql4="select quydinhlephi from table_user limit 0,1";
		$d->query($sql4);
		$result_qdlp=$d->result_array();
		$data['sotiendong'] = (int)$_POST['sotiendong'];
		$data['ngaysua'] = time();
		$data['comvip'] = isset($_POST['comvip']) ? 'vip' : '';
		$data['ngaydongphi'] =  $_POST['ngaydongphi'];
		
		if($data['ngaydongphi']=="0000-00-00" && $data['sotiendong']!="")
		{	
				transfer("Chưa có ngày đóng phí", "index.php?com=thanhvien&act=edit&id=".$id);
		}
		$d->setTable('thanhvien');
		$d->setWhere('id', $id);
		if($d->update($data)){
				if($data['sotiendong'] >= 20000000){
					$sql1="update table_thanhvien set role=4 where id='".$id."'";
					$d->query($sql1);
				}elseif($data['sotiendong'] > $result_qdlp[0]['quydinhlephi']){
					$sql2="update table_thanhvien set role=3 where id='".$id."'";
					$d->query($sql2);
				}else{
					$sql3="update table_thanhvien set role=1 where id='".$id."'";
					$d->query($sql3);
				}
				transfer("Cập nhật dữ liệu thành công", "index.php?com=thanhvien&act=edit&id=".$id);
		}else{
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=thanhvien&act=edit&id=".$id);
			}
	}else{
		
		if($photo = upload_image("file", 'JPG|jpg|png|gif',_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 120, 80, _upload_tintuc,$file_name);
		}
		$data['tenhoasi'] = $_POST['tenhoasi'];
		$data['name'] = $_POST['name'];
		$data['diachi'] = $_POST['diachi'];
		$data['address'] = $_POST['address'];
		$data['history'] = $_POST['history'];
		$data['tieusu'] = $_POST['tieusu'];		
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
	
		$d->setTable('hoasi');
		if($d->insert($data))
			redirect("index.php?com=hoasi&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=hoasi&act=man");
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_thanhvien where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
			}
			$sql = "delete from #_thanhvien where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			redirect("index.php?com=thanhvien&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=thanhvien&act=man");
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_thanhvien where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				
			}
			$sql = "delete from #_thanhvien where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=thanhvien&act=man");} else transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=man");
}
//===========================================================
function get_cats(){
	global $d, $items, $paging;
	$sql = "select * from #_news_item order by stt";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=tintuc&act=man_cat";
	$maxR=20;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}



?>