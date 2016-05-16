<?php

	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$d = new database($config['database']);
	switch($com){	
		case 'thoat':
			logout();
			break;
		case 'sigin':
			$source = "user";
			$act='reg';
			break;
		case 'quen-mat-khau':
			$source = "user";
			$act='lostpw';
			break;
		case 'cap-nhat-tai-khoan':
			$source = "user";
			$act='thong-tin-tai-khoan';
			break;
		case 'doi-mat-khau':
			$source = "user";
			$act='doi-mat-khau';
			break;
		case 'don-hang-thanh-vien':
			$source = "user_donhang";
			$template = isset($_GET['idl']) ? "userdonhang_detail" : "userdonhang";
			break;	
		case 'hinh-anh':
			$source = "hinhanh";
			$template = isset($_GET['id']) ? "hinhanh_detail" : "hinhanh";
			break;
		case 'ho-tro':
			$source = "hotro";
			$template = isset($_GET['id']) ? "hotro_detail" : "hotro";
			break;	
		
		case 'san-pham':
			$source="sanpham";
			$template = isset($_GET['id']) ? "sanpham_detail" : "sanpham";
			break;
		
		case 'san-pham-moi':
			
			$template = "spbanchay";
			break;
			
		case 'san-pham-khuyen-mai':
			$source="sanphamkhuyenmai";
			$template ="sanphamkhuyenmai";
			break;	
		case 'san-pham-xem-nhieu-nhat':
			$source="sanphamxnn";
			$template ="sanphamxnn";
			break;	
			

		case 'tin-tuc':
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;	
			case 'hoi-dap':
			$source = "hoidap";
			$template = isset($_GET['id']) ? "hoidap_detail" : "hoidap";
			break;			
		case 'video':
			$source = "video";
			$template ="video";
			break;			
		case 'album':
			$source = "alpum";
			$template = isset($_GET['id']) ? "alpum_detail" : "alpum";
			break;		
	
		case 'khuyen-mai':
			$source = "khuyenmai";
			$template = isset($_GET['id']) ? "khuyenmai_detail" : "khuyenmai";
			break;

		case 'lien-he':
			$source = "contact";
			$template = "contact";
			break;	
		case 'ban-do':
			$source = "bando";
			$template = "bando";
			break;	
	
			
		
			
		case 'gioi-thieu':
			$source = "about";
			$template = "about";
			break;	
			
		case 'gio-hang':
			$source = "giohang";
			$template = "giohang";
			break;	
	
			
		case 'giao-hang':
			$source = "htpp";
			$template = "htpp";
			break;	
		case 'tuyen-dung':
			$source = "tuvan";
			$template = "tuvan";
			break;
		case 'chat-luong':
			$source = "huongdan";
			$template = "huongdan";
			break;
		case 'thanh-toan-tt':
			$source = "tuyendung";
			$template = "tuyendung";
			break;
		case 'tu-van':
			$source = "doitac";
			$template = "doitac";
			break;			
		//case 'khach-hang-tieu-bieu':
//			$source = "khtb";
//			$template = isset($_GET['id']) ? "khtb_detail" : "khtb";
//			break;	
		case 'thac-mac-va-huong-dan':
			$source = "khtb";
			$template = isset($_GET['id']) ? "khtb_detail" : "khtb";
			break;		
		
		case 'tim-kiem':
			$source = "timkiem";
			$template = "timkiem";
			break;
		case 'thanh-toan':
			$source = "thanhtoan";
			$template = "thanhtoan";
			break;
	
												
		default: 
			$source = "index";
			$template = "index";
			break;
	}
	
	if($source!="") include _source.$source.".php";
	/*if(isset($_REQUEST['com'])){
		if($_REQUEST['com']=='logout')
		{
		session_unregister($login_name);
		header("Location:index.php");
		}
	}*/
	if(isset($_REQUEST['com'])){
		if($_REQUEST['com']=='logout')
		{
		$_SESSION['mem_login']['mem_mail']=array();
		header("Location:trang-chu.html");
		}
	}
	$sql_title = "select * from #_title limit 0,1";
	$d->query($sql_title);
	$row_title= $d->fetch_array();
	#  lay meta tim kiem
	$sql_meta = "select * from #_meta limit 0,1";
	$d->query($sql_meta);
	$row_meta= $d->fetch_array();	
?>
