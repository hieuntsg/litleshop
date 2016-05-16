<?php

include ("configajax.php");

$act = $_REQUEST['act'];
switch ($act) {
    case "comment":
        comment();
        break;
	case "step1":
        step1();
        break;
	case "load-quan":
        loadquan();
        break;
    
}
function comment() {
    global $config_url, $d,$row_setting;
	
    $sodt = $_POST['dienthoai'];
    $ten = $_POST['hoten'];
    $email = $_POST['email'];
    $tieude = $_POST['tieude'];
	$noidung = $_POST['noidung'];
	$rating = $_POST['rating'];
	$id_sp = $_POST['id_sp'];


    //validate dữ liệu
    $sodt = trim(strip_tags($sodt));
    $ten = trim(strip_tags($ten));
    $email = trim(strip_tags($email));
    $tieude = trim(strip_tags($tieude));
	$noidung = trim(strip_tags($noidung));
    $_SESSION['email_reg'] = $email;

    $coloi = false;
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
        $coloi = true;
        $error_email = "Email không đúng định dạng <br>";
    }

    if ($sodt == NULL) {
        $coloi = true;
        $error_sodt = "Chưa nhập số điện thoại<br>";
    }

    if ($ten == NULL) {
        $coloi = true;
        $error_ten = "Chưa nhập họ tên <br>";
    }

    if ($email == NULL) {
        $coloi = true;
        $error_email = "Chưa nhập địa chỉ email <br>";
    }

    if ($tieude == NULL) {
        $coloi = true;
        $error_diachi = "Chưa nhập tiêu đề bình luận <br>";
    }
	if ($noidung == NULL) {
        $coloi = true;
        $error_username = "Chưa nhập nội dung bình luận <br>";
    }

    $thongbao = ' <div class="error_mess">' . $error_hoten . $error_username . $error_diachi . $error_sodt . '</div>';
	
    if ($coloi == FALSE) {
		$d->reset();
        $data["ngaytao"] = time();
		$data["hoten"]=$ten;
		$data["email"]=$email;
		$data["dienthoai"]=$sodt;
		$data["ten"]=$tieude;
		$data["noidung"]=$noidung;
		$data["danhgia"]=$rating;
		$data["id_sp"]=$id_sp;
		$d->setTable("comment");
		if($d->insert($data)){
			$rs["id"]=1;
			$rs["thongbao"]="<span style='color:red;'>Cảm ơn bạn đã nhận xét sản phẩm này. Nhận xét của bạn sẽ được duyệt và đăng lên trong thời gian sớm nhất. </span>";
		}
		else{
			$rs["id"]=0;
			$rs["thongbao"]= "<span style='color:red;'>Nhận xét thất bại. </span>";
		}
    } else {
        $rs["id"]=0;
		$rs["thongbao"]= $thongbao;
    }
	echo json_encode($rs);
}
function step1(){
	global $d, $row_setting;
	
	$chon = $_POST['chon'];
	$username = $_POST['email'];
    $password = $_POST['pass'];
	if($chon==2){
		$_SESSION["thanhtoan"]["email"]=$username;
		$rs["id"]=1;
		$rs["thongbao"]="";
		$rs["url"]="thanh-toan.html";
	}else{
		/* $username = mysql_real_escape_string($username); */
		$matkhau = mysql_real_escape_string($matkhau);
		$sql = "select * from #_member where email='" . $username . "'";
		$d->query($sql);
		if ($d->num_rows() == 1) {
			$row = $d->fetch_array();
			if ($row['hienthi'] ==1) {
				if ($row['password'] == md5($password)) {
					$_SESSION[$login_name] = true;
					$_SESSION['login_web']['id'] = $row['id'];
					$_SESSION['login_web']['username'] = $row['email'];
					$_SESSION['login_web']['ten'] = $row['ten_vi'];
					$_SESSION['login_web']['com'] = $row['com'];
					$rs["id"]=1;
					$rs["thongbao"]="<span style='color:#f00;'>Đăng nhập thành công!. Hệ thống sẽ chuyển trang trong giây lát. </span>";
					$rs["url"]="thanh-toan.html";
				} else{
					$rs["id"]=0;
					$rs["thongbao"]="<span style='color:#f00'>Mật khẩu đăng nhập chưa đúng.</span><a href='quen-mat-khau.html'>Quên mật khẩu</a>";
				}
			} else{
				$rs["id"]=0;
				$rs["thongbao"]="<span style='color:#f00'>" . _taikhoanchuakichhoat . "</span>";
			}
		} else{
			$rs["id"]=0;
			$rs["thongbao"]="<span style='color:#f00'>Tài khoản không tồn tại </span>";
		}
	}
	echo json_encode($rs);
}
function loadquan(){
	global $d;
	
	$province=$_POST["id"];
	$district=$_POST["idi"];
	echo $district;
	$d->reset();
	$sql="select * from #_district where provinceid='".$province."' order by districtid desc";
	$d->query($sql);
	$rs=$d->result_array();
	$data='<option value=""> -- Chọn quận huyên -- </option>';
	foreach($rs as $v){
		$data.='<option value="'.$v["districtid"].'"'; if($v["districtid"]==$district) $data.="selected";$data.= '>'.$v["type"].' '.$v["name"].'</option>';
	}
	
	echo $data;
}
?>