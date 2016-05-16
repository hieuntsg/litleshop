<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
if(isset($_REQUEST['id'])){
$id=$_REQUEST['id'];}
switch($act){

	case "man":
		get_items();
		$template = "sanpham/items";
		break;
	case "add":		
		$template = "sanpham/item_add";
		break;
	case "edit":		
		get_item();
		$template = "sanpham/item_add";
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
		$template = "sanpham/cats";
		break;
	case "add_cat":		
		$template = "sanpham/cat_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "sanpham/cat_add";
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
		$template = "sanpham/danhmucs";
		break;
	case "add_danhmuc":		
		$template = "sanpham/danhmuc_add";
		break;
	case "edit_danhmuc":		
		get_danhmuc();
		$template = "sanpham/danhmuc_add";
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
		$template = "sanpham/lists";
		break;
	case "add_list":		
		$template = "sanpham/list_add";
		break;
	case "edit_list":		
		get_list();
		$template = "sanpham/list_add";
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
	if($_REQUEST['hot']!='')
	{
	$id_up = $_REQUEST['hot'];
	$sql_sp = "SELECT id,hot FROM table_product where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['hot'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_product SET hot ='$time' WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_product SET hot =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	}
	#-------------------------------------------------------------
		if($_REQUEST['banchay']!='')
	{
	$id_up = $_REQUEST['banchay'];
	$sql_sp = "SELECT id,banchay FROM table_product where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['banchay'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_product SET banchay ='$time' WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_product SET banchay =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	}
	#----------------------------------------------------------------------------------------
		if($_REQUEST['noibat']!='')
		{
			//alert('aaaa');
		$id_up = $_REQUEST['noibat'];
		$id_sp = $_REQUEST['id'];
		$id_cat = $_REQUEST['id_cat'];
		if($id_cat == 16)
			$ccat = 19;
		else
			$ccat = 16;

		$sql1="select * from table_product where id = ".$id_sp."";
		$d->query($sql1);
		$items_add = $d->fetch_array();

		$sql2="select * from table_mausac1 where id_product = ".$id_sp."";
		$d->query($sql2);
		$pic_add = $d->result_array();

		$sql3="select * from table_mausac where id_product = ".$id_sp."";
		$d->query($sql3);
		$size_add = $d->result_array();



		//print_r($size_add)."<br>";
		//print_r($pic_add);exit;

		//print_r($items_add);exit;
		/*if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG', _upload_sanpham,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 496, 680, _upload_sanpham,$file_name,1);		
		}*/
		$dir = _upload_sanpham;
		copy($dir.$items_add['photo'],$dir.'add_'.$items_add['photo']);
		copy($dir.$items_add['thumb'],$dir.'add_'.$items_add['thumb']);	
		$data['photo'] = 'add_'.$items_add['photo'];
		$data['thumb'] = 'add_'.$items_add['thumb'];
		$data['id_cat'] = $ccat;	
		//$data['id_list'] = (int)$_POST['id_list'];
		//$data['id_item'] = (int)$_POST['id_item'];		
		$data['ten'] = $items_add['ten'];	
		$data['tenkhongdau'] = $items_add['tenkhongdau'];	
		$data['maso'] = $items_add['maso'];	
		$data['mota'] = $items_add['mota'];
		$data['danhgia'] = $items_add['danhgia'];		
		$data['gia'] = $items_add['gia'];	
		$data['gia2'] = $items_add['gia2'];
		$data['xuatxu'] = $items_add['xuatxu'];
		$data['mausac'] = $items_add['mausac'];
		$data['kichthuoc'] = $items_add['kichthuoc'];
		$data['kieudan'] = $items_add['kieudan'];
		$data['soluong'] = $items_add['soluong'];
		$data['noidung'] = $items_add['noidung'];
		$data['keyword'] = $items_add['keyword'];
		$data['description'] = $items_add['description'];					
		$data['stt'] = 1;//$items_add['stt'];
		$data['hienthi'] = isset($items_add['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('product');
		if(!$d->insert($data))
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=sanpham&act=man");

		$idpronew = mysql_insert_id();

		foreach ($size_add as $ksize => $vsize) {
			$data1['ten']  =  $vsize['ten'];
			//$data['tenkhongdau']  =  changeTitle($_POST['nameten']);
			$data1['id_product']  = $idpronew;
			$data1['stt']  =  $vsize['stt'];
			
			$d->setTable('mausac');
			if(!$d->insert($data1))
				transfer("Lưu dữ liệu bị lỗi", "index.php?com=sanpham&act=man");
		}

		foreach ($pic_add as $kpic => $vpic) {
			$data2['ten']  =  $vpic['ten'];
			$data2['id_product']  = $idpronew;
			$data2['stt']  =  $vpic['stt'];
			$dir = _upload_sanpham;
			copy($dir.$vpic['photo'],$dir.'addt_'.$vpic['photo']);
			copy($dir.$vpic['thumb'],$dir.'addt_'.$vpic['thumb']);	
			$data2['photo'] = 'addt_'.$vpic['photo'];
			$data2['thumb'] = 'addt_'.$vpic['thumb'];
			
			$d->setTable('mausac1');
			if(!$d->insert($data2))
				transfer("Lưu dữ liệu bị lỗi", "index.php?com=sanpham&act=man");
		}

		

			/*redirect("index.php?com=sanpham&act=man&id_cat=".$_REQUEST['id_cat']."&id_list=".$_REQUEST['id_list']."&id_item=".$_REQUEST['id_item']."&curPage=".$_REQUEST['curPage']."");*/
		/*else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=sanpham&act=man");*/
		/*$sql_sp = "SELECT id,noibat FROM table_product where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$time=time();*/
		/*$hienthi=$cats[0]['noibat'];
			if($hienthi==0)
			{
			$sqlUPDATE_ORDER = "UPDATE table_product SET noibat ='$time' WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
			}
			else
			{
			$sqlUPDATE_ORDER = "UPDATE table_product SET noibat =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
			}	*/
		}
	#-------------------------------------------------------------------------------
	
	#----------------------------------------------------------------------------------------
		if($_REQUEST['khuyenmai']!='')
		{
		$id_up = $_REQUEST['khuyenmai'];
		$sql_sp = "SELECT id,khuyenmai FROM table_product where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$time=time();
		$khuyenmai=$cats[0]['khuyenmai'];
			if($khuyenmai==0)
			{
			$sqlUPDATE_ORDER = "UPDATE table_product SET khuyenmai ='$time' WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
			}
			else
			{
			$sqlUPDATE_ORDER = "UPDATE table_product SET khuyenmai =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
			}	
		}
	#-------------------------------------------------------------------------------
	
	#----------------------------------------------------------------------------------------
	
		if($_REQUEST['hienthi']!='')
		{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_product where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_product SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sql UPDATE_ORDER");
		}
		else
		{
		 $sqlUPDATE_ORDER = "UPDATE table_product SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sql UPDATE_ORDER");
		}	
		}
	#-------------------------------------------------------------------------------
	$sql = "select * from #_product";	
	if($_POST['masp']!=''){
        	$sql.=" where  ten like '%".$_POST['masp']."%'";
    }
    else{
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
}
	$sql.=" order by stt,id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	
	$url="index.php?com=sanpham&act=man&id_cat=".$_REQUEST['id_cat']."&id_list=".$_REQUEST['id_list']."&id_item=".$_REQUEST['id_item']."&curPage=".$_REQUEST['curPage']."";
	$maxR=10;
	$maxP=20;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item(){
	global $d, $item ,$rs_img;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=sanpham&act=man");
	
	$sql = "select * from #_product where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=sanpham&act=man");
	$item = $d->fetch_array();	

	$d->reset();
	$sql_images="select * from #_mausac1 where id_product='".$id."'";
	$d->query($sql_images);
	$rs_img=$d->result_array();
}

function save_item(){
	global $d;
	$file_name=fns_Rand_digit(0,9,12);
	$file_name1=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=sanpham&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG', _upload_sanpham,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 496, 680, _upload_sanpham,$file_name,1);		
			$d->setTable('product');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);	
				delete_file(_upload_sanpham.$row['thumb']);				
			}
		}
		
		
		$data['id_cat'] = (int)$_POST['id_cat'];	
		$data['id_list'] = (int)$_POST['id_list'];
		$data['id_item'] = (int)$_POST['id_item'];		
		$data['ten'] = $_POST['ten'];
		$data['mota'] = $_POST['mota'];	
		$data['danhgia'] = $_POST['danhgia'];	
		$data['tenkhongdau'] = changeTitle($_POST['ten']);	
		$data['maso'] = $_POST['maso'];	
		$data['gia'] = $_POST['gia'];
		$data['gia2'] = $_POST['gia2'];
		$data['xuatxu'] = $_POST['xuatxu'];
		$data['mausac'] = $_POST['mausac'];
		$data['kichthuoc'] = $_POST['kichthuoc'];
		$data['kieudan'] = $_POST['kieudan'];
		$data['soluong'] = $_POST['soluong'];
		$data['keyword'] = $_POST['keyword'];
		$data['description'] = $_POST['description'];		
		$data['noidung'] = $_POST['noidung'];					
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		$d->setTable('product');
		$d->setWhere('id', $id);
		if($d->update($data)){
			$count=count($_FILES['multiple']['name']);
			if($count>=1){
				for($i=0;$i<$count;$i++){
					if($_FILES['multiple']['name'][$i]!=''){
						$tempFile = $_FILES['multiple']['tmp_name'][$i];          //3
						$targetPath = _upload_sanpham;  //4
						$targetFile =  $targetPath.$file_name1 . $i. $_FILES['multiple']['name'][$i];  //5	

						move_uploaded_file($tempFile,$targetFile); //6
						$data1['photo']=$file_name1 . $i.$_FILES['multiple']['name'][$i];
						$data1['id_product']=$id;
						
						$d->setTable("mausac1");
						$d->insert($data1);
					}
				}
			}
			/*redirect("index.php?com=sanpham&act=man&id_cat=".$_POST['id_cate']."&curPage=".$_REQUEST['curPage']."");*/
			redirect("index.php?com=sanpham&act=man&id_cat=".$_REQUEST['id_cat']."&id_list=".$_REQUEST['id_list']."&id_item=".$_REQUEST['id_item']."&curPage=".$_REQUEST['curPage']."");
		}	
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=sanpham&act=man");
	}else{
	if($_POST['id_cat'] == 0){
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG', _upload_sanpham,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 496, 680, _upload_sanpham,$file_name,1);		
		}
			
		$data['id_cat'] = 16;			
		$data['ten'] = $_POST['ten'];	
		$data['tenkhongdau'] = changeTitle($_POST['ten']);	
		$data['maso'] = $_POST['maso'];	
		$data['mota'] = $_POST['mota'];
		$data['danhgia'] = $_POST['danhgia'];		
		$data['gia'] = $_POST['gia'];	
		$data['gia2'] = $_POST['gia2'];
		$data['xuatxu'] = $_POST['xuatxu'];
		$data['mausac'] = $_POST['mausac'];
		$data['kichthuoc'] = $_POST['kichthuoc'];
		$data['kieudan'] = $_POST['kieudan'];
		$data['soluong'] = $_POST['soluong'];
		$data['noidung'] = $_POST['noidung'];
		$data['keyword'] = $_POST['keyword'];
		$data['description'] = $_POST['description'];					
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('product');
		if($d->insert($data)){
			$id = mysql_insert_id();
			$count=count($_FILES['multiple']['name']);
			if($count>=1){
				for($i=0;$i<$count;$i++){
					if($_FILES['multiple']['name'][$i]!=''){
						$tempFile = $_FILES['multiple']['tmp_name'][$i];        
						$targetPath = _upload_sanpham;  
						$targetFile =  $targetPath.$file_name1 . $i. $_FILES['multiple']['name'][$i];  	
								 
						move_uploaded_file($tempFile,$targetFile); 
						$data2['photo']=$file_name1 . $i.$_FILES['multiple']['name'][$i];
						$data2['id_product']=$id;
						
						$d->setTable("mausac1");

						$d->insert($data2);
					}
				}
			}
		}

		if($photo1 = upload_image("file", 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG', _upload_sanpham,$file_name.'hai')){
			$data1['photo'] = $photo1;		
			$data1['thumb'] = create_thumb($data1['photo'], 496, 680, _upload_sanpham,$file_name.'hai',1);		
		}
			
		$data1['id_cat'] = 19;			
		$data1['ten'] = $_POST['ten'];	
		$data1['tenkhongdau'] = changeTitle($_POST['ten']);	
		$data1['maso'] = $_POST['maso'];	
		$data1['mota'] = $_POST['mota'];
		$data1['danhgia'] = $_POST['danhgia'];		
		$data1['gia'] = $_POST['gia'];	
		$data1['gia2'] = $_POST['gia2'];
		$data1['xuatxu'] = $_POST['xuatxu'];
		$data1['mausac'] = $_POST['mausac'];
		$data1['kichthuoc'] = $_POST['kichthuoc'];
		$data1['kieudan'] = $_POST['kieudan'];
		$data1['soluong'] = $_POST['soluong'];
		$data1['noidung'] = $_POST['noidung'];
		$data1['keyword'] = $_POST['keyword'];
		$data1['description'] = $_POST['description'];					
		$data1['stt'] = $_POST['stt'];
		$data1['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data1['ngaytao'] = time();
		$d->setTable('product');
		if($d->insert($data1)){
			$id = mysql_insert_id();
			$count=count($_FILES['multiple']['name']);
			if($count>=1){
				for($i=0;$i<$count;$i++){
					if($_FILES['multiple']['name'][$i]!=''){
						$tempFile = $_FILES['multiple']['tmp_name'][$i];        
						$targetPath = _upload_sanpham;  
						$targetFile =  $targetPath.$file_name1 . $i. $_FILES['multiple']['name'][$i];  	
								 
						move_uploaded_file($tempFile,$targetFile); 
						$data3['photo']=$file_name1 . $i.$_FILES['multiple']['name'][$i];
						$data3['id_product']=$id;
						
						$d->setTable("mausac1");

						$d->insert($data3);
					}
				}
			}
			redirect("index.php?com=sanpham&act=man&curPage=".$_REQUEST['curPage']."");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=sanpham&act=man");
			

	}else{	
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG', _upload_sanpham,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 496, 680, _upload_sanpham,$file_name,1);		
		}
			
		$data['id_cat'] = (int)$_POST['id_cat'];	
		$data['id_list'] = (int)$_POST['id_list'];
		$data['id_item'] = (int)$_POST['id_item'];		
		$data['ten'] = $_POST['ten'];	
		$data['tenkhongdau'] = changeTitle($_POST['ten']);	
		$data['maso'] = $_POST['maso'];	
		$data['mota'] = $_POST['mota'];
		$data['danhgia'] = $_POST['danhgia'];		
		$data['gia'] = $_POST['gia'];	
		$data['gia2'] = $_POST['gia2'];
		$data['xuatxu'] = $_POST['xuatxu'];
		$data['mausac'] = $_POST['mausac'];
		$data['kichthuoc'] = $_POST['kichthuoc'];
		$data['kieudan'] = $_POST['kieudan'];
		$data['soluong'] = $_POST['soluong'];
		$data['noidung'] = $_POST['noidung'];
		$data['keyword'] = $_POST['keyword'];
		$data['description'] = $_POST['description'];					
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('product');
		if($d->insert($data)){
		$id = mysql_insert_id();
			$count=count($_FILES['multiple']['name']);
			//echo $_FILES['multiple']['name'];exit;
			if($count>=1){
				for($i=0;$i<$count;$i++){
					if($_FILES['multiple']['name'][$i]!=''){
						$tempFile = $_FILES['multiple']['tmp_name'][$i];          //3
						$targetPath = _upload_sanpham;  //4
						$targetFile =  $targetPath.$file_name1 . $i. $_FILES['multiple']['name'][$i];  //5	
						//echo $targetFile;exit;		 
						move_uploaded_file($tempFile,$targetFile); //6
						$data1['photo']=$file_name1 . $i.$_FILES['multiple']['name'][$i];
						//echo  $data1['photo'];exit;
						$data1['id_product']=$id;
						
						$d->setTable("mausac1");

						$d->insert($data1);
					}
				}
			}
			//redirect("index.php?com=sanpham&act=man&id_cat=".$_POST['id_cate']."");	

			redirect("index.php?com=sanpham&act=man&id_cat=".$_REQUEST['id_cat']."&id_list=".$_REQUEST['id_list']."&id_item=".$_REQUEST['id_item']."&curPage=".$_REQUEST['curPage']."");
		}	
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=sanpham&act=man");
	}//end post id_cat
  } // end else save
}

function delete_item(){
	global $d;
	if($_REQUEST['id_cat']!='')
	{ $id_catt="&id_cat=".$_REQUEST['id_cat'];
	}
	if($_REQUEST['id_list']!='')
	{ $id_listt="&id_list=".$_REQUEST['id_list'];
	}
	if($_REQUEST['id_item']!='')
	{ $id_itemt="&id_item=".$_REQUEST['id_item'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id'])){

		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select * from #_product where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);
				$d->reset();
				$sql="select * from #_mausac1 where id_product='".$row['id']."' order by id";
				$d->query($sql);
				if($d->num_rows()>0){
					$rs=$d->result_array();
					foreach($rs as $v){
						delete_file(_upload_sanpham . $rs['photo']);
						$sql = "delete from #_mausac1 where id='" . $v["id"] . "'";
						$d->query($sql);
					}
				}				
			}
		$sql = "delete from table_product where id='".$id."'";
		//echo $sql;exit;
		$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=sanpham&act=man".$id_catt.$id_listt.$id_itemt."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=sanpham&act=man");
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select id,thumb, photo from #_product where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);
				$d->reset();
					$sql="select * from #_mausac1 where id_product='".$row['id']."' order by id";
					$d->query($sql);
					if($d->num_rows()>0){
						$rs=$d->result_array();
						foreach($rs as $v){
							delete_file(_upload_sanpham . $rs['photo']);
							$sql = "delete from #_mausac1 where id='" . $v["id"] . "'";
							$d->query($sql);
						}
					}
			}
			$sql = "delete from #_product where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=sanpham&act=man".$id_catt.$id_listt.$id_itemt."");
	} 
	else transfer("Không nhận được dữ liệu", "index.php?com=sanpham&act=man");
		
}

#====================================
function get_danhmucs(){
	global $d, $items, $paging;

	#----------------------------------------------------------------------------------------
	
		if($_REQUEST['hienthi']!='')
		{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_product_item where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_product_item SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sql UPDATE_ORDER");
		}
		else
		{
		 $sqlUPDATE_ORDER = "UPDATE table_product_item SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sql UPDATE_ORDER");
		}	
		}
	
	$sql = "select * from #_product_item";
	
	if((int)$_REQUEST['id_cat']!='')
	{
	$sql.=" where id_cat=".$_REQUEST['id_cat']."";
	}
	if((int)$_REQUEST['id_list']!='')
	{
	$sql.=" and id_list=".$_REQUEST['id_list']."";
	}
	$sql.=" order by id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=sanpham&act=man_danhmuc&id_cat=".$_REQUEST['id_cat']."&id_list=".$_REQUEST['id_list']." ";
	$maxR=15;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_danhmuc(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=sanpham&act=man_danhmuc");
	
	$sql = "select * from #_product_item where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=sanpham&act=man_danhmuc");
	$item = $d->fetch_array();
}

function save_danhmuc(){
	global $d;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=sanpham&act=man_danhmuc");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){		
	if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_sanpham,$file_name)){
				$data['photo'] = $photo;	
						
				$d->setTable('product_item');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_sanpham.$row['photo']);	
							
				}
			}
		$data['ten'] = $_POST['ten'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);		
		$data['id_cat'] = $_POST['id_cat'];	
		$data['id_list'] = $_POST['id_list'];
		$data['keyword'] = $_POST['keyword'];
		$data['description'] = $_POST['description'];			
		
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('product_item');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=sanpham&act=man_danhmuc&id_cat=".$_REQUEST['id_cat']."&id_list=".$_REQUEST['id_list']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=sanpham&act=man_danhmuc");
	}else{		
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_sanpham,$file_name)){
			$data['photo'] = $photo;		
				
		}	
		$data['id_cat'] = $_POST['id_cat'];
		$data['id_list'] = $_POST['id_list'];
		$data['keyword'] = $_POST['keyword'];
		$data['description'] = $_POST['description'];	
		
		$data['ten'] = $_POST['ten'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('product_item');
		if($d->insert($data))
			redirect("index.php?com=sanpham&act=man_danhmuc&id_cat=".$_POST['id_cat']."&id_list=".$_POST['id_list']."");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=sanpham&act=man_danhmuc");
	}
}

function delete_danhmuc(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);		
		$d->reset();		
		
			$sql = "delete from #_product_item where id='".$id."'";
			$d->query($sql);
		
		
		if($d->query($sql))
			redirect("index.php?com=sanpham&act=man_danhmuc&id_cat=".$_REQUEST['id_cat']."&id_list=".$_REQUEST['id_list']."&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=sanpham&act=man_danhmuc&id_cat=".$_REQUEST['id_cat']."");
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			
				$sql = "delete from #_product_item where id='".$id."'";
				$d->query($sql);
			
		} redirect("index.php?com=sanpham&act=man_danhmuc");} else transfer("Không nhận được dữ liệu", "index.php?com=sanpham&act=man_danhmuc");
}

/*------------------------------------------*/

function get_cats(){
	global $d, $items, $paging;
	
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_product_list where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_list SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_list SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}

	if($_REQUEST['hot']!='')
	{
	$id_up = $_REQUEST['hot'];
	$sql_sp = "SELECT id,hot FROM table_product_list where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hot'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_list SET hot=1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_list SET hot=0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}

	$sql = "select * from #_product_list";
	if(isset($_REQUEST['id_cat']))	{
	if((int)$_REQUEST['id_cat']!='')
	{
	$sql.=" where id_cat=".$_REQUEST['id_cat']."";
	}}
	$sql.=" order by id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=sanpham&act=man_cat&id_cat=".$_REQUEST['id_cat']."";
	$maxR=20;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_cat(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=sanpham&act=man_cat");
	
	$sql = "select * from #_product_list where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=sanpham&act=man_cat");
	$item = $d->fetch_array();
}

function save_cat(){
	global $d;
	$file_name=fns_Rand_digit(0,9,12);
	$file_name1=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=sanpham&act=man_cat");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){		
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_sanpham,$file_name)){
				$data['photo'] = $photo;	
						
				$d->setTable('product_list');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_sanpham.$row['photo']);	
									
				}
			}

		if($photoicon = upload_image("fileicon", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_sanpham,$file_name1)){
				$data['thumb'] = $photoicon;	
						
				$d->setTable('product_list');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_sanpham.$row['thumb']);	
									
				}
			}	
		$data['ten'] = $_POST['ten'];
		$data['title'] = $_POST['title'];
		$data['mota'] = mysql_escape_string($_POST['mota']);
		$data['keyword'] = $_POST['keyword'];
		$data['description'] = $_POST['description'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);		
		$data['id_cat'] = $_POST['id_cat'];			
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('product_list');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=sanpham&act=man_cat&id_cat=".$_REQUEST['id_cat']."&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=sanpham&act=man_cat");
	}else{
	if($_POST['id_cat'] == 0){
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_sanpham,$file_name)){
			$data['photo'] = $photo;				
		}

		if($photoicon = upload_image("fileicon", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_sanpham,$file_name1)){
			$data['thumb'] = $photoicon;				
		}			
		$data['id_cat'] = 19;
		$data['title'] = $_POST['title'];
		$data['ten'] = $_POST['ten'];
		$data['mota'] = mysql_escape_string($_POST['mota']);
		$data['keyword'] = $_POST['keyword'];
		$data['description'] = $_POST['description'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('product_list');
		if($d->insert($data)){}

		if($photo1 = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_sanpham,$file_name.'hai')){
			$data1['photo'] = $photo1;				
		}

		/*if($photoicon = upload_image("fileicon", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_sanpham,$file_name1)){
			$data['thumb'] = $photoicon;				
		}*/			
		$data1['id_cat'] = 16;
		$data1['title'] = $_POST['title'];
		$data1['ten'] = $_POST['ten'];
		$data1['mota'] = mysql_escape_string($_POST['mota']);
		$data1['keyword'] = $_POST['keyword'];
		$data1['description'] = $_POST['description'];
		$data1['tenkhongdau'] = changeTitle($_POST['ten']);
		$data1['stt'] = $_POST['stt'];
		$data1['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data1['ngaytao'] = time();
		
		$d->setTable('product_list');
		if($d->insert($data1))
			redirect("index.php?com=sanpham&act=man_cat");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=sanpham&act=man_cat");
		

	}else{	
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_sanpham,$file_name)){
			$data['photo'] = $photo;				
		}

		if($photoicon = upload_image("fileicon", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_sanpham,$file_name1)){
			$data['thumb'] = $photoicon;				
		}			
		$data['id_cat'] = $_POST['id_cat'];
		$data['title'] = $_POST['title'];
		$data['ten'] = $_POST['ten'];
		$data['mota'] = mysql_escape_string($_POST['mota']);
		$data['keyword'] = $_POST['keyword'];
		$data['description'] = $_POST['description'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('product_list');
		if($d->insert($data))
			redirect("index.php?com=sanpham&act=man_cat&id_cat=".$_REQUEST['id_cat']."");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=sanpham&act=man_cat");
	}
  }
}

function delete_cat(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);		
		$d->reset();		
		
			$sql = "delete from #_product_list where id='".$id."'";
			$d->query($sql);
		
		
		if($d->query($sql))
			redirect("index.php?com=sanpham&act=man_cat");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=sanpham&act=man_cat");
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			
				$sql = "delete from #_product_list where id='".$id."'";
				$d->query($sql);
			
		} redirect("index.php?com=sanpham&act=man_cat");} else transfer("Không nhận được dữ liệu", "index.php?com=sanpham&act=man_cat");
}
/*---------------------------------*/
function get_lists(){
	global $d, $items, $paging;
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_product_cat where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_cat SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_cat SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	
	if($_REQUEST['hot']!='')
	{
	$id_up = $_REQUEST['hot'];
	$sql_sp = "SELECT id,hot FROM table_product_cat where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hot'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_cat SET hot=1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_cat SET hot=0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	
	$sql = "select * from #_product_cat";			
	$sql.=" order by stt,id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=sanpham&act=man_list";
	$maxR=20;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_list(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=sanpham&act=man_list");
	
	$sql = "select * from #_product_cat where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=sanpham&act=man_list");
	$item = $d->fetch_array();	
}

function save_list(){
	global $d;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=sanpham&act=man_list");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){	
	if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_sanpham,$file_name)){
				$data['photo'] = $photo;	
				//$data['thumb'] = create_thumb($data['photo'], 185, 100, _upload_sanpham,$file_name,1);		
				$d->setTable('product_cat');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_sanpham.$row['photo']);	
					//delete_file(_upload_sanpham.$row['thumb']);				
				}
			}				
		$data['ten'] = $_POST['ten'];
		$data['keyword'] = $_POST['keyword'];
		$data['description'] = $_POST['description'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('product_cat');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=sanpham&act=man_list&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=sanpham&act=man_list");
	}else{				
		$data['ten'] = $_POST['ten'];
		
		
		$data['keyword'] = $_POST['keyword'];
		$data['description'] = $_POST['description'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('product_cat');
		if($d->insert($data))
			redirect("index.php?com=sanpham&act=man_list");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=sanpham&act=man_list");
	}
}

function delete_list(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);		
		$d->reset();		
		
			$sql = "delete from #_product_cat where id='".$id."'";
			$d->query($sql);
		
		
		if($d->query($sql))
			redirect("index.php?com=sanpham&act=man_list");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=sanpham&act=man_list");
	}else transfer("Không nhận được dữ liệu", "index.php?com=sanpham&act=man_list");
}
?>