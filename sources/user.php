<?php	if(!defined('_source')) die("Error");
$title_bar = "Tài khoản";
$p = (isset($_REQUEST['p'])) ? addslashes($_REQUEST['p']) : "";
switch($act){
	case "login":
		if(!empty($_POST)) login();
		$template = "user_login";
		break;
	case "reg":		
		if(!empty($_POST)) dangky();
		$template = "dangky";
		break;	
	case "lostpw":
		if(!empty($_POST)) resetpass();
		$template = "user_doimk";
		break;	
	case "thong-tin-tai-khoan":		
			if(!empty($_POST)) changeinfo($_SESSION['mem_login']['mem_mail']);
			get_item($_SESSION['mem_login']['mem_mail']);		
			$template = "user_info";		
		break;
	case "doi-avatar":
				get_item($_SESSION['login']['id']);	
				if(!empty($_POST)) changeavatar($_SESSION['login']['id'],$item['username']);								
				get_item($_SESSION['login']['id']);	
				$template = "user_doiavatar";
				break;
				
	case "doi-mat-khau":
				if(!empty($_POST)) changemk($_SESSION['mem_login']['mem_mail']);
				get_item($_SESSION['mem_login']['mem_mail']);					
				$template = "user_lostpw";
				break;
		
	case "logout":
		logout();		
		break;		
	default:
		$template = "index";
}

function get_item($id){
	global $d, $info_user;	
	if(empty($id)){
		transfer(_banchuadangnhap, "index.html");
	}
	$sql = "select * from #_thanhvien where email='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("<?=_dulieukhongtontai?>", "index.php?com=user&act=login");
	$info_user = $d->fetch_array();
}

function login(){
	global $d, $login_name,$error_login;	
	$username = $_POST['username'];
	$password = $_POST['password'];	
	$sql = "select * from #_user where username='".$username."'";
	$d->query($sql);	
	if($d->num_rows() == 1){
		$row = $d->fetch_array();
		if($row['role'] != 0){			
			if($row['password'] == md5($password)){
				$_SESSION[$login_name] = true;
				$_SESSION['login']['id'] = $row['id'];				
				if(isset($_SESSION['back'])) $url=$_SESSION['back']; else $url='index.php';
				//transfer("Đăng nhập thành công",$url);
				
				
			}else $error_login=_matkhaukhongdung;
		}else $error_login=_taikhoanchuakichhoat;
	}else $error_login=_tendangnhapkhongtontai;
}

function dangky(){
	global $d,$thongbao,$username,$hoten,$ngaysinh,$email,$diachi,$sodt,$nguoigioithieu,
	$error_username,$error_matkhau,$error_golaimatkhau, $error_hoten, $error_email , $error_diachi, $error_sodt;	

	
	//tiếp nhận dữ liệu

	$username = $_POST['username'];	
	$matkhau = $_POST['matkhau'];
	$golaimatkhau = $_POST['golaimatkhau'];
	$hoten = $_POST['hoten'];	
	$email = $_POST['email'];
	$gioitinh = $_POST['gioitinh'];
	
	//$ngay = $_POST['day_aics_birthday'];
	//$thang = $_POST['month_aics_birthday'];
	//$nam = $_POST['year_aics_birthday'];
	
	$diachi=$_POST['diachi'];
	$sodt=$_POST['dienthoai'];
	
	
	
	//validate dữ liệu
	$username = trim(strip_tags($username));
	$matkhau = trim(strip_tags($matkhau));
	$golaimatkhau = trim(strip_tags($golaimatkhau));
	$hoten = trim(strip_tags($hoten));
	$email = trim(strip_tags($email));	
	$diachi = trim(strip_tags($diachi));	
	$sodt = trim(strip_tags($sodt));	
	
	

	//settype($ngay,"int");
	//settype($thang,"int");
	//settype($nam,"int");	
	
	$ngaydangky = date("Y-m-d H:i:s");	
	settype($gioitinh,"int");
	if (get_magic_quotes_gpc()==false) {
		$username = mysql_real_escape_string($username);
		$matkhau = mysql_real_escape_string($matkhau);
		$golaimatkhau = mysql_real_escape_string($golaimatkhau);
		$hoten = mysql_real_escape_string($hoten);
		$email = mysql_real_escape_string($email);		
		$diachi = mysql_real_escape_string($diachi);
		$sodt = mysql_real_escape_string($sodt);		
		
	}
	$ngaysinh=$ngay.'/'.$thang.'/'.$nam;
	$coloi=false;	
	if ($username == NULL) { 
		//$coloi=true; $error_username = "Yêu cầu nhập tên đăng nhập";
	} 
	if ($matkhau == NULL) { 
		$coloi=true; $error_matkhau = "Yêu cầu nhập mật khẩu(>=6 char)<br>";
	}
	if ($golaimatkhau == NULL) { 
		$coloi=true; $error_golaimatkhau = "Yêu cầu nhập lại mật khẩu";
	}	
	if (strlen($username) < 3 ) { 
	//$coloi=true; $error_username = "Tên đăng nhập ít nhất 3 kí tự";
	} 
	if (strlen($matkhau) < 6 ) { 
		$coloi=true; $error_matkhau = "Mật khẩu ít nhất 6 kí tự";
	} 
	if ($matkhau != $golaimatkhau ) { 
		$coloi=true; $error_golaimatkhau = "Yêu cầu nhập lại mật khẩu";
	} 
	if ($hoten == NULL) { 
		//$coloi=true; $error_hoten = "Yêu cầu nhập họ tên";
	}
	if ($email == NULL) { 
		$coloi=true; $error_email = "Yêu cầu nhập email";
	}		
	if (filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE) { 
		$coloi=true; $error_email="Email chưa đúng định dạng";
	}
//	if ($ngaysinh == NULL) { 
//		$coloi=true; $error_ngaysinh = _chuanhapngaysinh."<br>";
	//}
	//kiểm tra ngày	
/*	$Ngay_arr = explode("/",$ngaysinh); // array(17,11,2010)
	if (count($Ngay_arr)==3) {
		$ngay = $Ngay_arr[0]; //17
		$thang = $Ngay_arr[1]; //11
		$nam = $Ngay_arr[2]; //2010
		if (checkdate($thang,$ngay,$nam)==false){ $coloi=true; $error_ngaysinh = _chuanhapdungngaysinh."<br>";} else $ngaysinh=$nam."-".$thang."-".$ngay;
	}else {  $coloi=true; $error_ngaysinh = _chuanhapdungngaysinh."<br>"; }	
	*/
	if ($diachi == NULL) { 
		//$coloi=true; $error_diachi = "Yêu cầu nhập địa chỉ";
	}
	
	if ($sodt == NULL) { 
		//$coloi=true; $error_sodt = "Yêu cầu nhập số điện thoại";
	}	
		
/*	if ($_SESSION['captcha_code'] != $_POST['capt']) {
		   $coloi=true;
		   $error_captcha=_mabaovesai."<br/>"; // xử lý lỗi
		   
	} */
	
		
	/*if($coloi==FALSE){
	// kiem tra ten trung		
		$d->reset();
		$d->setTable('thanhvien');
		$d->setWhere('username', $username);
		$d->select();
		if($d->num_rows()>0) { $coloi=true; $error_username = "Tài khoản đã có người dùng";}
	}*/
	if($coloi==FALSE){
	// kiem tra email trung
		$d->reset();
		$d->setTable('thanhvien');
		$d->setWhere('email', $email);
		$d->select();
		if($d->num_rows()>0) { $coloi=true; $error_email = "Email đã có người dùng"; }
	}
	$thongbao=' <div class="error_mess">'.$error_username.$error_matkhau.$error_golaimatkhau.$error_hoten.$error_email.$error_ngaysinh.$error_diachi.$error_sodt.$error_nguoigioithieu.$error_captcha.'</div>';		
	if ($coloi==FALSE) {
			
			
			
			$randomkey = ChuoiNgauNhien(32);
			$matkhau_old=$matkhau;
			$matkhau=md5($matkhau);
			$ngaysinh=strtotime($ngaysinh);
			$magioithieu=ChuoiNgauNhien(6);
			$ngaydangky=time();
			
			$sql = "INSERT INTO  table_thanhvien (username,password,hoten,dienthoai,email,diachi,gioitinh,role,typelog,ngaydangki,randomkey)
				  VALUES ('$username','$matkhau','$hoten','$sodt','$email','$diachi','$gioitinh','1','normal','$ngaydangky','$randomkey')";	
			mysql_query($sql) or die(mysql_error());
			$iduser = mysql_insert_id();
		//	$tieude = "Kích hoạt tài khoản";
			//$link = "http://". $_SERVER['SERVER_NAME']."/active.php";		
		//	$link = $link . "?id=$iduser&rd=$randomkey";
					$_SESSION['mem_login']['mem_mail'] = $email;
					$_SESSION['mem_login']['phone'] = $sodt;
					$_SESSION['mem_login']['address'] = $diachi;
					$_SESSION['mem_login']['name'] = $hoten;
					$_SESSION['mem_login']['iduser'] = $iduser;		
					$_SESSION['mem_login']['mem_level'] = '1';		

			transfer("Chúc mừng bạn đã đăng kí thành công", "index.html");		
		}
	
		
}

function changemk($id){
	global $d,$error_matkhaucu, $error_matkhau, $error_golaimatkhau,$matkhau,$passold,$golaimatkhau;		
	//tiếp nhận dữ liệu
	$passold = $_POST['matkhaucu'];
	$matkhau = $_POST['matkhau'];
	$golaimatkhau = $_POST['golaimatkhau'];	

	//validate dữ liệu
	$passold = trim(strip_tags($passold));
	$matkhau = trim(strip_tags($matkhau));
	$golaimatkhau = trim(strip_tags($golaimatkhau));

	if (get_magic_quotes_gpc()==false) {
		$passold = mysql_real_escape_string($passold);
		$matkhau = mysql_real_escape_string($matkhau);
		$golaimatkhau = mysql_real_escape_string($golaimatkhau);	
	}
	$coloi=false;		
	if ($passold == NULL) { 
		$coloi=true; $error_matkhaucu = "Chưa nhập mật khẩu cũ";
	} 	
	if ( $passold!=NULL && strlen($passold) < 6 ) { 
		$coloi=true; $error_matkhaucu = "Mật khẩu ít nhất 6 kí tự";
	} 
	if ($matkhau == NULL) { 
		$coloi=true; $error_matkhau = "Chưa nhập mật khẩu mới";
	} 	
	
	if ($golaimatkhau == NULL && $matkhau!=NULL) { 
		$coloi=true; $error_golaimatkhau = "Chưa nhập lại mật khẩu mới";
	}	

	if ( $matkhau!=NULL && strlen($matkhau) < 6 ) { 
		$coloi=true; $error_matkhau = "Mật khẩu ít nhất 6 kí tự";
	} 
	if ($matkhau != $golaimatkhau && $matkhau!=NULL ) { 
		$coloi=true; $error_golaimatkhau = "Mật khẩu mới nhập lại không đúng";
	} 

	

	
	if ($coloi==FALSE) {
	//$randomkey = ChuoiNgauNhien(32);
	$passold=md5($passold);
	$sql="select id from table_thanhvien where email ='$id' and password='$passold'";	
	$rs=mysql_query($sql) or die(mysql_error());
	if (isset($rs)==false || mysql_num_rows($rs)==0) 
			 { $error_matkhaucu="Mật khẩu cũ không đúng";$coloi=true; }
	}
	if ($coloi==FALSE){
		
		if($matkhau!=NULL){
			$matkhau=md5($matkhau);
			$sql="update table_thanhvien set password='$matkhau' where email ='$id'";
			mysql_query($sql) or die(mysql_error());
				transfer("Cập nhật mật khẩu thành công", "doi-mat-khau.html");
		}
		
	}
}

function changeinfo($id){
	global $d,$thongbao,$username,$hoten,$ngaysinh,$email,$diachi,$sodt,$nguoigioithieu,$gioitinh,
	$error_username,$error_hoten, $error_diachi, $error_sodt;	

	
	//tiếp nhận dữ liệu

	//$username = $_POST['username'];

	$hoten = $_POST['hoten'];	

	$gioitinh = $_POST['gioitinh'];
	
	//$ngay = $_POST['day_aics_birthday'];
	//$thang = $_POST['month_aics_birthday'];
	//$nam = $_POST['year_aics_birthday'];
	
	$diachi=$_POST['diachi'];
	$sodt=$_POST['dienthoai'];
	
	
	
	//validate dữ liệu
	//$username = trim(strip_tags($username));
	$hoten = trim(strip_tags($hoten));
	$diachi = trim(strip_tags($diachi));	
	$sodt = trim(strip_tags($sodt));	
	
	

	//settype($ngay,"int");
	//settype($thang,"int");
	//settype($nam,"int");	
	
	$ngaydangky = date("Y-m-d H:i:s");	
	settype($gioitinh,"int");
	if (get_magic_quotes_gpc()==false) {
		//$username = mysql_real_escape_string($username);

		$hoten = mysql_real_escape_string($hoten);
		
		$diachi = mysql_real_escape_string($diachi);
		$sodt = mysql_real_escape_string($sodt);		
		
	}
	$ngaysinh=$ngay.'/'.$thang.'/'.$nam;
	$coloi=false;	
	if ($username == NULL) { 
		//$coloi=true; $error_username = "Yêu cầu nhập tên biệt danh";
	}

	if ($hoten == NULL) { 
		//$coloi=true; $error_hoten = "Yêu cầu nhập họ tên";
	}



	if ($diachi == NULL) { 
		//$coloi=true; $error_diachi = "Yêu cầu nhập địa chỉ";
	}
	
	if ($sodt == NULL) { 
		//$coloi=true; $error_sodt = "Yêu cầu nhập số điện thoại";
	}	
		
	if ($coloi==FALSE) {
			
			

			$ngaysinh=strtotime($ngaysinh);
			$magioithieu=ChuoiNgauNhien(6);
			$ngaydangky=time();
			$sql="update table_thanhvien set hoten ='$hoten',gioitinh='$gioitinh',diachi='$diachi',dienthoai ='$sodt'  where email ='$id'";	
			mysql_query($sql) or die(mysql_error());

			transfer("Cập nhật tài khoản thành công", "cap-nhat-tai-khoan.html");		
		}

}

function changeavatar($id,$file_name){
	global $d,$error_avatar;
	
	if($photo = upload_image("file", 'jpg|png|gif', _upload_avatar_l,$file_name)){
		$thumb = create_thumb($photo, 128, 128, _upload_avatar_l,$file_name,1);		
		$sql="update table_user set photo ='$photo',thumb='$thumb' where id ='$id'";
		mysql_query($sql) or die(mysql_error());	
	}else $error_avatar='Upload bị lỗi';
}

function history($id){
	global $d, $item_history;	
	if(!$id)
		transfer(_banchuadangnhap, "index.php?com=user&act=login");
	
	$sql = "select * from #_history where id_user ='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongtontai, "index.php?com=user&act=login");
	$item_history = $d->result_array();
}


function resetpass(){
	//echo 'aaaa';exit;
	global $d, $error_captcha,$error_email;
		//tiếp nhận dữ liệu	
	$email = $_POST['email'];
	/*$sql="select * from #_company ";
	$d->query($sql);
	$com=$d->fetch_array();*/
	@define (_chuanhapemail,'Chưa nhập Email');
	@define (_emailkhongdung,'Email chưa đúng');
	@define (_emailkhongtontai,'Email không tồn tại');
	$email = trim(strip_tags($email));	
	if (get_magic_quotes_gpc()==false) {
		$email = mysql_real_escape_string($email);	
	}
	$coloi=false;		
	if ($email == NULL) { 
		$coloi=true; $error_email = "<br>"._chuanhapemail;
	}	
	if (filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE) { 
		$coloi=true; $error_email="<br>"._emailkhongdung;
	} 
	if ($_SESSION['captcha_code'] != $_POST['capt']) {
		   $coloi=true;
		   $error_captcha="<br/><i>"._saimabaove."</i>"; // xử lý lỗi
		   
		} 		
	// kiem tra email trung
		$d->reset();
		$d->setTable('thanhvien');
		$d->setWhere('email', $email);
		$d->select();
		if($d->num_rows() !=1) { $coloi=true; $error_email = "<br>"._emailkhongtontai; }
					
	if ($coloi==FALSE) {
	$randomkey = ChuoiNgauNhien(12);		
	$d->reset();

		$data['randomkey'] = $randomkey;
		$d->reset();
		$data['password'] = md5($randomkey);
		$d->setTable('thanhvien');
		$d->setWhere('email', $email);
		if($d->update($data)){						
			

			include('class.phpmailer.php');
                $mail = new PHPMailer();  
                $mail->IsSMTP();  // telling the class to use SMTP
                $mail->Mailer = "smtp";
                $mail->Host = "112.213.84.126";
                $mail->Port = 25;
                $mail->SMTPAuth = true; // turn on SMTP authentication
                $mail->Username = "trumsitr"; // SMTP username
                $mail->Password = "k6bjGK9R"; // SMTP password
                $mail->From     = "trumsitr@trumsi.vn";
                $mail->AddAddress($email);  			
				$mail->AddCC($email,$email);
				$mail->CharSet = ("UTF-8");
                $mail->Subject  = "Thông tin mật khẩu";
				$mail->MsgHTML($body);
                $mail->Body     = 'Mật khẩu mới : <b>'.$randomkey.'</b>';		
                $mail->WordWrap = 50;  
               	$mail->Send();
        	    	
               	$yc = "<span style='font-family:Tahoma'>Yêu cầu của bạn đã được gửi!<br>Bạn cần vào mail $email để lấy mật khẩu mới<br><br>Vui lòng kiểm tra hộp thư spam nếu chưa nhận được mật khẩu.</span>";	
				transfer($yc, "index.html");

				//define('GUSER', 'testmailweb.ptit@gmail.com'); // tài khoản đăng nhập Gmail
			//define('GPWD', '01021989as'); // mật khẩu cho cái mail này  
						
			/*function smtpmailer($to, $from, $from_name, $subject, $body) { 
				global $error;
				
				$mail = new PHPMailer();  // tạo một đối tượng mới từ class PHPMailer
				$mail -> CharSet  =  'UTF-8' ;
				$mail->IsSMTP(); // bật chức năng SMTP
				$mail->SMTPDebug = 1;  // kiểm tra lỗi : 1 là  hiển thị lỗi và thông báo cho ta biết, 2 = chỉ thông báo lỗi
				$mail->SMTPAuth = true;  // bật chức năng đăng nhập vào SMTP này
			
				$mail->SMTPSecure = 'ssl'; // sử dụng giao thức SSL vì gmail bắt buộc dùng cái này
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 465; 
				$mail->Username = GUSER;  
				$mail->Password = GPWD;           
				$mail->SetFrom($from, $from_name);
				$mail->Subject = $subject;
				$mail->MsgHTML($body);
				$mail->Body = $body;
				$mail->AddAddress($to);
				if(!$mail->Send()) {
					$error = 'Gởi mail bị lỗi: '.$mail->ErrorInfo; 
					return false;
				} else {
					$error = 'Thư của bạn đã được gởi đi ';
					return true;
				}
			}  
			$yc = "<span style='font-family:Tahoma'>Yêu cầu của bạn đã được gửi!<br>Bạn cần vào mail $email để lấy mật khẩu mới<br><br>Vui lòng kiểm tra hộp thư spam nếu chưa nhận được mật khẩu.</span>";
			if (smtpmailer($email, '','trumsi.vn', 'Thông tin lấy lại mật khẩu', 'Mật khẩu mới : '.$randomkey)) {

				transfer($yc, "trang-chu.html");
			}
			else
			{
				transfer("Thông tin không gửi được.<br>Vui lòng kiểm tra lại.", "trang-chu.html");
			}  */
		}
	}		
}

function thanhviennb($solg){
	global $d;
	$sql="select username,photo,magioithieu from #_user where active=1 and noibat>0 order by username limit 0,$solg";
	$d->query($sql);
	return $d->result_array();
}

function huongdandk(){
	global $d;
	$sql="select noidung_vi,noidung_en from #_hddk";
	$d->query($sql);
	return $d->result_array();
}



function getfamyli($id){
	global $d;
	$sql="select id,username,photo from #_user where id_user = '$id' order by username";
	$d->query($sql);
	return $d->result_array();	
}

function changemoney($id){
	global $d,$thongbao;		
	//tiếp nhận dữ liệu
	if($id){
		$money = $_POST['money'];
		$typemoney = $_POST['typemoney'];
					
		//validate dữ liệu
		$money = trim(strip_tags($money));
		$typemoney = trim(strip_tags($typemoney));
		
		
		settype($money,"int");
		settype($typemoney,"int");	
		$coloi=false;		
		if ($money <0 ) { 
			$coloi=true; $error_moneyvnd = "Bạn chưa nhập số tiền cần chuyển<br>";
		} 	
					
		$thongbao=' <div class="error_mess">'.$error_moneyvnd.'</div>';		
		if ($coloi==FALSE) {		
				
				if($typemoney==1){
					
					$sql="select money_vnd from table_user where id ='$id'";
					$d->query($sql);
					$row=$d->fetch_array();
					
					if($row['money_vnd']<$money)
						transfer("Số tiền bạn có trong tài khoản không dủ<br/>", "index.php?com=user&act=changemoney");	
					else{
						$sotienkv=$money*10;
						$sql="update table_user set 	money_vnd=	money_vnd-'$money' , 	money_kv=	money_kv+ '$sotienkv'  where id ='$id'";
						mysql_query($sql) or die(mysql_error());
						transfer("Chuyển tiền thành công<br/>", "index.php");
					}
					
				}elseif($typemoney==2){
					
					$sql="select money_kv from table_user where id ='$id'";
					$d->query($sql);
					$row=$d->fetch_array();
					
					if($row['money_kv']<$money)
						transfer("Số tiền bạn có trong tài khoản không dủ<br/>", "index.php?com=user&act=changemoney");	
					else{
						$sotienvnd=$money/10;
						$sql="update table_user set money_vnd=	money_vnd+'$sotienvnd' , 	money_kv=	money_kv- '$money'  where id ='$id'";
						mysql_query($sql) or die(mysql_error());
						transfer("Chuyển tiền thành công<br/>", "index.php");
					}
					
				}
				
						
			}
	}else{
		transfer(_banchuadangnhap."<br/>", "index.php");		
	}
	
		
}

?>