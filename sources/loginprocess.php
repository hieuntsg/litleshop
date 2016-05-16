<?php
 session_start();
   	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../admin/lib/');
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."class.database.php";
	include_once _lib."functions.php";
	include_once _lib."function_user.php";
	include_once _lib."functions_giohang.php";
	$d = new database($config['database']);


if(!empty($_POST['islogin']) ){
	$manglogin['error_email_login_cart']='';
	$manglogin['error_password_login_cart']='';
	$manglogin['notecommon']='';
	$manglogin['success']=0;
	
	$email_login_cart=$_POST['email_login'];
	$pass_login_cart=$_POST['pass_login'];
	$email_login_cart = trim(strip_tags($email_login_cart));
	$pass_login_cart = trim(strip_tags($pass_login_cart));
	$coloi=false;

		
	/*if ($email_login != NULL) { 
		if (filter_var($email_login,FILTER_VALIDATE_EMAIL)==false) { 
			$coloi=true; 
			$manglogin['error_email_login']="Email không đúng";
		} 
	}*/

		$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');	

	if ($coloi==false) {
		$pass_login_cart=md5($pass_login_cart);
		$sql = "select * from #_thanhvien where email='".$email_login_cart."' and password='".$pass_login_cart."'";
		$d->query($sql);
		
		if($d->num_rows() == 1){
			$row = $d->fetch_array();
			if($row['role'] <> 0){			
				if($row['password'] == $pass_login_cart){
					if($row['khoa'] == 1){
						$manglogin['notecommon'] = "Tài khoản đang tạm khóa,vui lòng liên hệ số 0948.011.101";
					}else{
					$_SESSION['mem_login']['mem_mail'] = $row['email'];
					$_SESSION['mem_login']['phone'] = $row['dienthoai'];
					$_SESSION['mem_login']['address'] = $row['diachi'];
					$_SESSION['mem_login']['name'] = $row['hoten'];
					$_SESSION['mem_login']['iduser'] = $row['id'];
					$_SESSION['mem_login']['mem_level'] = $row['role'];
					if(isset($_SESSION['back'])) $url=$_SESSION['back']; else $url='trang-chu.html';
					//$manglogin['notecommon'] = "Đăng nhập thành công";
					$manglogin['success'] =1;
					}
				}else{ $manglogin['notecommon'] = "Mật khẩu không đúng"; };
			}else{ 
				$manglogin['notecommon'] = "Tài khoản chưa xác thực";
			};
		}else{
			$manglogin['notecommon'] = "Tài khoản không đúng";
		};		
		
	}	
	

	echo json_encode($manglogin);
}


if(!empty($_POST['isloginmobilerights']) ){
	$mangloginmobile['error_email_login_mobile']='';
	$mangloginmobile['error_password_login_mobile']='';
	$mangloginmobile['notecommonmobile']='';
	$mangloginmobile['successmobile']=0;
	
	$email_login_mobile=$_POST['email_login_mobile_right'];
	$pass_login_mobile=$_POST['pass_login_mobile_right'];
	
	$email_login_mobile = trim(strip_tags($email_login_mobile));
	$pass_login_mobile = trim(strip_tags($pass_login_mobile));
	
	$coloi=false;
	if ($email_login_mobile == NULL) { 
		$coloi=true;
		$mangloginmobile['error_email_login_mobile'] = "Chưa nhập email";
			
	}	
	if ($pass_login_mobile == NULL) { 
		$coloi=true;
		$mangloginmobile['error_password_login_mobile'] = "Chưa nhập mật khẩu";
	}
	
	if ($email_login_mobile != NULL) { 
			if(!filter_var($email_login_mobile, FILTER_VALIDATE_EMAIL)){	
				$coloi=true; 
				$mangloginmobile['error_email_login_mobile']="Email không đúng";
			} 
	}		
		
	/*if ($email_login != NULL) { 
		if (filter_var($email_login,FILTER_VALIDATE_EMAIL)==false) { 
			$coloi=true; 
			$manglogin['error_email_login']="Email không đúng";
		} 
	}*/

		$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');	

	if ($coloi==false) {
		$pass_login_mobile=md5($pass_login_mobile);
		$sql = "select * from #_thanhvien where email='".$email_login_mobile."' and password='".$pass_login_mobile."'";
		$d->query($sql);
		
		if($d->num_rows() == 1){
			$row = $d->fetch_array();
			if($row['role'] <> 0){			
				if($row['password'] == $pass_login_mobile){
					$_SESSION['mem_login']['mem_mail'] = $row['email'];		
					$_SESSION['mem_login']['mem_level'] = $row['role'];
					if(isset($_SESSION['back'])) $url=$_SESSION['back']; else $url='"'.$lang.'"/index.php';
					//$manglogin['notecommon'] = "Đăng nhập thành công";
					$mangloginmobile['successmobile'] =1;
					
				}else{ $mangloginmobile['notecommonmobile'] = "Mật khẩu không đúng"; };
			}else{ 
				$mangloginmobile['notecommonmobile'] = "Tài khoản chưa xác thực";
			};
		}else{
			$mangloginmobile['notecommonmobile'] = "Tài khoản không đúng";
		};		
		
	}	
	

	echo json_encode($mangloginmobile);
}


if(!empty($_POST['issiginonemobile']) ){
	$coloi=false;
	$mang_sigin_mobile['success_sig_mob']=0;
	$mang_sigin_mobile['error_sigin_mobile_common']="";
	$email_sigmobile=$_POST['emails_sigmobiles'];
	$pass_sigmobile=$_POST['matkhaus_sigmobiles'];
	$hoten_sigmobile=$_POST['hoten_sigmobiles'];
	$ngaydangki=time();
	$pass=md5($pass);
	$roles=1;
	if(!$email_sigmobile){
		$d->reset();
		$sql_checktv="select count(*) as dem from table_thanhvien where email='".$email_sigmobile."'";
		$d->query($sql_checktv);
		$result_checktv=$d->result_array();
		if($result_checktv[0]['dem']>0){
			$coloi=true;
			$mang_sigin_mobile['error_sigin_mobile_common']="Tài khoản email đã từng sử dụng";
		}
	}
	if($coloi==false){
		$sql = "INSERT INTO  table_thanhvien (email,password,hoten,ngaydangki) VALUES ('$email_sigmobile','$pass_sigmobile','$hoten_sigmobile','$ngaydangki')";	
		$d->query($sql);
			$d->reset();
			$sql_tv="select id,email from table_thanhvien where email='".$email_sigmobile."'";
			$d->query($sql_tv);
			$result_tv=$d->result_array();
			$_SESSION['mem_login']['mem_mail'] =$result_tv[0]['email'];
			$mang_sigin_mobile['success_sig_mob']=1;
	}
	echo json_encode($mang_sigin_mobile);
}



if(!empty($_POST['issiginone']) ){
	$coloi=false;
	$email=$_POST['emails'];
	$pass=$_POST['matkhaus'];
	$ngaysinh=$_POST['ngaysinh'];
	$gioitinhs=$_POST['gioitinhs'];
	$ngaydangki=time();
	$pass=md5($pass);
	$roles=1;
	if(!$email){
		$d->reset();
		$sql_checksitv="select count(*) as dem from table_thanhvien where email='".$email."'";
		$d->query($sql_checksitv);
		$result_checksitv=$d->result_array();
		if($result_checksitv[0]['dem']>0){
			$coloi=true;
			$mang_sigin_cart['error_sigin_common']="Tài khoản email đã từng sử dụng";
		}
	}
	if($coloi==false){
		$sql = "INSERT INTO  table_thanhvien (email,password,ngaysinh,role,gioitinh,ngaydangki) VALUES ('$email','$pass','$ngaysinh','1','$gioitinhs','$ngaydangki')";	
		$d->query($sql);
			$d->reset();
			$sql_tv="select id,email from table_thanhvien where email='".$email."'";
			$d->query($sql_tv);
			$result_tv=$d->result_array();
			$_SESSION['mem_login']['mem_mail'] =$result_tv[0]['email'];
	 }

}
if(!empty($_POST['islogoutmobile']) ){
		$_SESSION['mem_login']['mem_mail']=array();
		
}

if(!empty($_POST['issigintwo1']) ){

	$hoten=$_POST['hoten'];
	$thanhpho=$_POST['thanhpho_sigin'];
	$quanhuyen=$_POST['quanhuyen_sigin'];
	$phuong=$_POST['phuong_sigin'];
	$sonha=$_POST['sonha'];
	$duong=$_POST['duong'];
	$lau=$_POST['lau'];
	$dienthoai=$_POST['dienthoai'];		
	
	$email=$_SESSION['mem_login']['mem_mail'];
	$d->reset();
	$sql_dctv="update table_thanhvien set hoten='$hoten', id_city='$thanhpho', id_huyen='$quanhuyen', id_phuong='$phuong', sonha='$sonha', duong='$duong', dienthoai='$dienthoai', lau='$lau' where email='$email'";
	$d->query($sql_dctv);

}


if(!empty($_POST['thanhpho'])){
	$id_thanhpho= $_POST['thanhpho'];
		$sql = "select * from table_huyen where id_city='".$id_thanhpho."'";	
		$d->query($sql);
		$result_huyen=$d->result_array();
		

		for($qh=0;$qh<count($result_huyen);$qh++){
				echo '<option value='.$result_huyen[$qh]['id'].'>'.$result_huyen[$qh]['ten'].'</option>';
		}		
}

if(!empty($_POST['quanhuyen'])){
	$id_quanhuyen= $_POST['quanhuyen'];
		$sql = "select * from table_phuong where id_huyen='".$id_quanhuyen."'";	
		$d->query($sql);
		$result_phuong=$d->result_array();
		

		for($p=0;$p<count($result_phuong);$p++){
				echo '<option value='.$result_phuong[$p]['id'].'>'.$result_phuong[$p]['ten'].'</option>';
		}		
}



if(!empty($_POST['statuspay'])){
		$giaohang=$_POST['giaohang'];
		$thanhtoan=$_POST['thanhtoan'];
		$ghichu=$_POST['ghichu'];
		$ngaytao=time();
		$email_pay=$_SESSION['mem_login']['mem_mail'];
		$tong_dh=$_POST['tong_donhang'];
		echo $tong_dh;
		$d->reset();
		$sql = "INSERT INTO  table_cart (id_thanhvien,id_phuongthucgiaohang,id_phuongthucthanhtoan,ghichu,ngaytao,tongdonhang) 
		 VALUES ('$email_pay','$giaohang','$thanhtoan','$ghichu','$ngaytao','$tong_dh')";
		$d->query($sql);
		
		$d->reset();
		$sql_khac = "select * from table_cart where id_thanhvien='".$email_pay."' order by id desc limit 0,1";
		$d->query($sql_khac);
		$id_cart = $d->result_array();		
		$idcart1= $id_cart[0]['id'];
		
		$max=count($_SESSION['cart']);
				for($ic=0;$ic<$max;$ic++){
					$pid=$_SESSION['cart'][$ic]['productid'];
					$q=$_SESSION['cart'][$ic]['qty'];
					$size=$_SESSION['cart'][$ic]['size'];
					$money=$_SESSION['cart'][$ic]['price'];
					
					if($q==0) continue;
					$sql_cart = "INSERT INTO  table_order (id_product,id_cart,soluong,money,ngaytao,id_size) 
					  VALUES ('$pid','$idcart1','$q','$money','$ngaytao','$size')";
					mysql_query($sql_cart) or die(mysql_error());
				}
		$_SESSION['cart']=array();		
		
}


if(!empty($_POST['logout'])){
	$_SESSION['mem_login']=array();
}





?>
