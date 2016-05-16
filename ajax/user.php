<?php

include ("configajax.php");

$act = $_REQUEST['act'];
switch ($act) {
    case "login":
        login();
        break;
    case "order":
        get_item($_SESSION['login_web']['id']);
        break;
    case "reg":
        dangky_tv();
        break;
    case "lostpw":
        resetpass();
        break;
    case "info":

        if (!empty($_POST))
            changeinfo($_SESSION['login_web']['id']);
        get_item($_SESSION['login_web']['id']);
        break;
    case "doi-avatar":
        get_item($_SESSION['login_web']['id']);
        if (!empty($_POST))
            changeavatar($_SESSION['login_web']['id'], $item['username']);
        get_item($_SESSION['login_web']['id']);
        $template = "user_doiavatar";
        break;

    case "doimatkhau":
        if (!empty($_POST))
            changemk($_SESSION['login_web']['id']);
        get_item($_SESSION['login_web']['id']);
        break;

    case "logout":
        logout();
        break;
    default:
        $template = "index";
}

function get_item($id) {
    global $d, $item, $config_url, $lang;
    if (!$id)
        transfer("Bạn chưa đăng nhập!", "http://" . $config_url . "/dang-nhap.html");

    $sql = "select * from #_user where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không tồn tại", "http://" . $config_url . "/dang-nhap.html");
    $item = $d->fetch_array();
}


function dangky_tv() {
    global $config_url, $d, $thongbao, $username, $hoten, $ngaysinh, $email, $diachi, $sodt, $nguoigioithieu, $host, $userhost, $passhost, $province, $district,$row_setting;
    //tiếp nhận dữ liệu
    $_SESSION['thongbao'] = "dangky";
    /* $username = $_POST['username']; */
    $matkhau = $_POST['matkhau'];
    $golaimatkhau = $_POST['golaimatkhau'];
    $sodt = $_POST['sodt'];
    $ten = $_POST['ten'];
    $sex = $_POST['sex'];
    $ngaysinh = $_POST['ngaysinh'];
    $email = $_POST['email'];
    $diachi = $_POST['diachi'];
	$province = $_POST['province'];
	$district = $_POST['district'];
    $capt = $_POST['capt'];



    //validate dữ liệu
    /* $username = trim(strip_tags($username)); */
    $matkhau = trim(strip_tags($matkhau));
    $golaimatkhau = trim(strip_tags($golaimatkhau));
    $sodt = trim(strip_tags($sodt));
    $ten = trim(strip_tags($ten));
    $sex = trim(strip_tags($sex));
    $ngaysinh = strtotime($ngaysinh);
    $email = trim(strip_tags($email));
    $diachi = trim(strip_tags($diachi));
	$province = trim(strip_tags($province));
	$district = trim(strip_tags($district));
    $capt = trim(strip_tags($capt));
    $_SESSION['email_reg'] = $email;

    if (get_magic_quotes_gpc() == false) {
        /* $username = mysql_real_escape_string($username); */
        $matkhau = mysql_real_escape_string($matkhau);
        $golaimatkhau = mysql_real_escape_string($golaimatkhau);
        $sodt = mysql_real_escape_string($sodt);
    }
    $coloi = false;
    /* if ($username == NULL) {
        $coloi = true;
        $error_username = "Chưa điền tên đăng nhập <br>";
    } */
    /* if (strlen($username) < 6) {
        $coloi = true;
        $error_username = "Tài khoản đăng nhập có ít nhất 6 kí tự <br>";
    } */
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
        $coloi = true;
        $error_email = "Email không đúng định dạng <br>";
    }
    if ($matkhau == NULL) {
        $coloi = true;
        $error_matkhau = "Chưa nhập mật khẩu. Mật khẩu có ít nhất 6 kí tự <br>";
    }
    if ($golaimatkhau == NULL) {
        $coloi = true;
        $error_golaimatkhau = "Chưa nhập mật khẩu <br>";
    }

    if (strlen($matkhau) < 6) {
        $coloi = true;
        $error_matkhau = "Mật khẩu phải ít nhất 6 kí tự<br>";
    }
    if ($matkhau != $golaimatkhau) {
        $coloi = true;
        $error_golaimatkhau = "Xác nhận lại mật khẩu không đúng<br>";
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

    if ($diachi == NULL) {
        $coloi = true;
        $error_diachi = "Chưa nhập địa chỉ <br>";
    }

    /* if ($coloi == FALSE) {
        // kiem tra ten trung		
        $d->reset();
        $d->setTable('member');
        $d->setWhere('username', $username);
        $d->select();
        if ($d->num_rows() > 0) {
            $coloi = true;
            $error_username = _taikhoandasudung . "<br>";
        }
    } */
    if ($coloi == FALSE) {
        // kiem tra email trung
        $d->reset();
        $d->setTable('member');
        $d->setWhere('email', $email);
        $d->select();
        if ($d->num_rows() > 0) {
            $coloi = true;
            $error_username = "<br>Email bạn nhập đã có người dùng";
        }
    }
    if ($_SESSION['captcha_code'] != $capt) {
        $coloi = true;
        echo "<br/><i>Sai mã bảo vệ</i>"; // xử lý lỗi
    }
    $thongbao = ' <div class="error_mess">' . $error_matkhau . $error_golaimatkhau . $error_hoten . $error_username . $error_ngaysinh . $error_diachi . $error_sodt . $error_nguoigioithieu . $error_captcha . '</div>';

    if ($coloi == FALSE) {


        $randomkey = ChuoiNgauNhien(32);
        $matkhau_old = $matkhau;
        $matkhau = md5($matkhau);
        $magioithieu = ChuoiNgauNhien(6);
		$tenkhongdau=changeTitle($ten);
        $ngaydangky = time();

        


        include_once "../phpmailer/class.phpmailer.php";
        //Khởi tạo đối tượng
        $mail = new PHPMailer();
        //Thiet lap thong tin nguoi gui va email nguoi gui
        $mail->IsSMTP(); // Gọi đến class xử lý SMTP
        $mail->SMTPAuth = true;                  // Sử dụng đăng nhập vào account
        $mail->Host = $host;     // Thiết lập thông tin của SMPT
        $mail->Username = $userhost; // SMTP account username
        $mail->Password = $passhost;            // SMTP account password

        $mail->SetFrom($userhost, $row_setting['website']);

        //Thiết lập thông tin người nhận
        $mail->AddAddress("$email", $row_setting['website']);

        /* =====================================
         * THIET LAP NOI DUNG EMAIL
         * ===================================== */

        //Thiết lập tiêu đề
        $mail->Subject = 'Đăng kí tài khoản tại ' . $row_setting['website'];

        //Thiết lập định dạng font chữ
        $mail->CharSet = "utf-8";

        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";

        $body = _xinchao . " $ten.<br/>" . 'Đăng kí tài khoản tại ' . $row_setting['website'];
		
		$body = '<table>';
			$body .= '
				<tr>
					<th colspan="2">&nbsp;</th>
				</tr>
				<tr>
					<th colspan="2">Xác nhận tài khoản từ website '.$row_setting['website'].'</th>
				</tr>
				<tr>
					<th colspan="2">&nbsp;</th>
				</tr>
				<tr>
					'.$row_setting['website'].' chào bạn .<br />
					Cảm ơn bạn đã đăng ký thành viên trên '.$row_setting['website'].' . Để tài khoản thành viên có hiệu lực, bạn vui lòng nhấn vào liên kết dưới đây:<br />
					<a href="http://'.$config_url.'/user/kich-hoat-tai-khoan/'.md5($username).'/'.md5(time()).'.html">kích hoạt tài khoản</a><br />
					Tài khoản truy cập :'.$email.'<br />
					Mật khẩu :'.$matkhau_old.'<br />
					Nếu không phải bạn đã đăng ký tài khoản, xin vui lòng bỏ qua email này.<br />
					Cảm ơn bạn đã sử dụng dịch vụ của '.$row_setting['website'].'<br />
					Mọi thắc mắc hoặc quan tâm về tài khoản, xin vui lòng liên hệ:<br />
					 
					'.$row_setting['website'].'<br />
					Địa Chỉ : '.$row_setting['diachi_vi'].'<br />
					Hotline : '.$row_setting['hotline'].' Email : '.$row_setting['email'].' Website : '.$row_setting['website'].'<br />
					Lưu ý: Đây chỉ là thư thông báo. Các hồi đáp lại thông báo này sẽ không được theo dõi hoặc giải đáp.<br />
				</tr>
				<tr>';
			$body .= '</table>';
        //Thiết lập nội dung chính của email
        $mail->MsgHTML($body);

        if (!$mail->Send()) {
            $rs["id"]=0;
			$rs["thongbao"]= "<span style='color:red;'>Có lỗi xảy! </span>";
            //transfer( "Xin lỗi em chịu ko nỗi! ","index.html");
        } else {
			$sql = "INSERT INTO  table_member (username,password,old_password,ten_vi, tenkhongdau,dienthoai,email,province, district,diachi,gioitinh,ngaysinh,com,ngaytao)
				  VALUES ('$username','$matkhau','$matkhau_old','$ten', '$tenkhongdau','$sodt','$email','$province','$district','$diachi','$sex','$ngaysinh','user','$ngaydangky')";
			mysql_query($sql) or die(mysql_error());
			$iduser = mysql_insert_id();

            $rs["id"]=1;
			$rs["thongbao"]="<span style='color:red;'>Đăng ký thành công!. Hệ thống sẽ chuyển trang trong giây lát. </span>";
        }
    } else {
        $rs["id"]=0;
		$rs["thongbao"]= $thongbao;
    }
	echo json_encode($rs);
}

function changemk($id) {
    global $d, $error_passold, $error_matkhau, $error_golaimatkhau, $error_email;
    //tiếp nhận dữ liệu
    $_SESSION['thongbao'] = 'doimatkhau';
    $passold = $_POST['matkhau'];
    $matkhau = $_POST['matkhaumoi'];
    $golaimatkhau = $_POST['golaimatkhau'];
    $capt = $_POST['capt'];



    //validate dữ liệu
    $capt = trim(strip_tags($capt));
    $passold = trim(strip_tags($passold));
    $matkhau = trim(strip_tags($matkhau));
    $golaimatkhau = trim(strip_tags($golaimatkhau));
    if (get_magic_quotes_gpc() == false) {
        $passold = mysql_real_escape_string($passold);
        $matkhau = mysql_real_escape_string($matkhau);
        $golaimatkhau = mysql_real_escape_string($golaimatkhau);
    }
    $coloi = false;
    if ($passold == NULL) {
        $coloi = true;
        echo "<span style='color:red;'>" . _chuanhappasscu . " </span>";
    }
    if ($golaimatkhau == NULL && $matkhau != NULL) {
        $coloi = true;
        echo "<span style='color:red;'>" . _chuanhappassmoi . " </span>";
    }
    if ($matkhau != NULL && strlen($matkhau) < 6) {
        $coloi = true;
        echo "<span style='color:red;'>" . _matkhauitnhat6kytu . " </span>";
    }
    if ($matkhau != $golaimatkhau && $matkhau != NULL) {
        $coloi = true;
        echo "<span style='color:red;'>" . _golaimatkhausai . " </span>";
    }
    if ($_SESSION['captcha_code'] != $capt) {
        $coloi = true;
        echo "<span style='color:red;'>" . _saimabaove . " </span>"; // xử lý lỗi
    }


    if ($coloi == FALSE) {
        //$randomkey = ChuoiNgauNhien(32);
        $passold = md5($passold);
        $sql = "select id from table_user where id ='$id' and password='$passold'";
        $rs = mysql_query($sql) or die(mysql_error());
        if (isset($rs) == false || mysql_num_rows($rs) == 0) {
            echo "<span style='color:red;'>" . _saimatkhaucu . "</span>";
            $coloi = true;
        }
    }
    if ($coloi == FALSE) {

        if ($matkhau != NULL) {
            $matkhau = md5($matkhau);
            $sql = "update table_user set password='$matkhau' where id ='$id'";
            mysql_query($sql) or die(mysql_error());
        }

        echo "<script language='javascript'>window.location = 'thongbao.php' </script>";
    }
}

function changeinfo($id) {
    global $d, $error_passold, $error_matkhau, $error_golaimatkhau;
    //tiếp nhận dữ liệu	
    $_SESSION['thongbao'] = "info";
    $hoten = $_POST['ten'];
    $gioitinh = $_POST['gioitinh'];
    $sdt = $_POST['sodt'];
    $ngaysinh = $_POST['ngaysinh'];
    $diachi = $_POST['diachi'];
    $capt = $_POST['capt'];



    //validate dữ liệu
    $hoten = trim(strip_tags($hoten));
    $sdt = trim(strip_tags($sdt));
    $diachi = trim(strip_tags($diachi));
    $ngaysinh = strtotime($ngaysinh);
    $capt = trim(strip_tags($capt));

    settype($gioitinh, "int");

    if (get_magic_quotes_gpc() == false) {
        $hoten = mysql_real_escape_string($hoten);
        $sdt = mysql_real_escape_string($sdt);
        $diachi = mysql_real_escape_string($diachi);
    }
    $coloi = false;
    if ($hoten == NULL) {
        $coloi = true;
        echo "<span style='color:red;'>" . _fill_name . "</span>";
    }
    if ($sdt == NULL) {
        $coloi = true;
        echo "<span style='color:red;'>" . _chuanhapsodienthoai . "</span>";
    }
    if ($diachi == NULL) {
        $coloi = true;
        echo "<span style='color:red;'>" . _chuanhapdiachi . "</span>";
    }
    if ($_SESSION['captcha_code'] != $capt) {
        $coloi = true;
        echo "<span style='color:red;'>" . _saimabaove . "</span>"; // xử lý lỗi
    }
    if ($coloi == FALSE) {
        $sql = "update table_user set ten ='$hoten',sex='$gioitinh',diachi='$diachi',dienthoai ='$sdt',ngaysinh='$ngaysinh'  where id ='$id'";
        mysql_query($sql) or die(mysql_error());
        echo "<script language='javascript'>window.location = 'thongbao.php' </script>";
    }
}

function changeavatar($id, $file_name) {
    global $d, $error_avatar;

    if ($photo = upload_image("file", 'jpg|png|gif', _upload_avatar_l, $file_name)) {
        $thumb = create_thumb($photo, 128, 128, _upload_avatar_l, $file_name, 1);
        $sql = "update table_user set photo ='$photo',thumb='$thumb' where id ='$id'";
        mysql_query($sql) or die(mysql_error());
    } else
        $error_avatar = 'Upload bị lỗi';
}

function history($id) {
    global $d, $item_history;
    if (!$id)
        transfer("Bạn chưa đăng nhập!", "dang-nhap.html");

    $sql = "select * from #_history where id_user ='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không tồn tại", "dang-nhap.html");
    $item_history = $d->result_array();
}

function resetpass() {
    global $d, $error_captcha, $error_email, $host, $userhost, $passhost;
    //tiếp nhận dữ liệu	
    $_SESSION['thongbao'] = "resetpass";
    $email = $_POST['email'];
    $user = $_POST['username'];

    $email = trim(strip_tags($email));
    if (get_magic_quotes_gpc() == false) {
        $email = mysql_real_escape_string($email);
    }
    $coloi = false;
    if ($email == NULL) {
        $coloi = true;
        echo "<span style='color:red;'>" . _fill_email . "</span>";
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
        $coloi = true;
        echo "<span style='color:red;'>" . _loiemail . "</span>";
    }
    if ($_SESSION['captcha_code'] != $_POST['capt']) {
        $coloi = true;
        echo "<span style='color:red;'>" . _saimabaove . "</span>"; // xử lý lỗi
    }
    // kiem tra email trung
    $d->reset();
    $d->query("select * from #_user where email='" . $email . "' and username='" . $user . "'");

    if ($d->num_rows() != 1) {
        $coloi = true;
        echo "<span style='color:red;'>" . _emailchuadangky . "!</span>";
    }

    if ($coloi == FALSE) {
        $randomkey = ChuoiNgauNhien(8);
        $d->reset();

        $data['password'] = md5($randomkey);
        $d->reset();
        $d->setTable('user');
        $d->setWhere('username', $user);
        if ($d->update($data)) {


            include_once "../phpmailer/class.phpmailer.php";
            //Khởi tạo đối tượng
            $mail = new PHPMailer();
            //Thiet lap thong tin nguoi gui va email nguoi gui

            $mail->IsSMTP(); // Gọi đến class xử lý SMTP
            $mail->SMTPAuth = true;                  // Sử dụng đăng nhập vào account
            $mail->Host = $host;     // Thiết lập thông tin của SMPT
            $mail->Username = $userhost; // SMTP account username
            $mail->Password = $passhost;            // SMTP account password

            $mail->SetFrom($userhost, $row_setting['website']);

            //Thiết lập thông tin người nhận
            $mail->AddAddress("$email", $row_setting['website']);

            /* =====================================
             * THIET LAP NOI DUNG EMAIL
             * ===================================== */

            //Thiết lập tiêu đề
            $mail->Subject = _yeucaulaylaimatkhautai . $row_setting['website'];

            //Thiết lập định dạng font chữ
            $mail->CharSet = "utf-8";

            $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";

            $body = _bandayeucaulaylaimatkhautai . $row_setting['website'] . 'Mật khẩu mới của bạn là:' . $randomkey;

            //Thiết lập nội dung chính của email
            $mail->MsgHTML($body);

            if (!$mail->Send()) {
                echo "<span style='color:red;'>Xin lỗi em chịu ko nỗi! </span>";
            } else {

                echo "<script language='javascript'>window.location = 'thongbao.php' </script>";
            }
        }
    }
}

function thanhviennb($solg) {
    global $d;
    $sql = "select username,photo,magioithieu from #_user where active=1 and noibat>0 order by username limit 0,$solg";
    $d->query($sql);
    return $d->result_array();
}

function huongdandk() {
    global $d;
    $sql = "select noidung_vi,noidung_en from #_hddk";
    $d->query($sql);
    return $d->result_array();
}

function logout() {
    unset($_SESSION['login_web']);
    transfer(_dangxuatthanhcong, "index.html");
}
function login() {
    global $d, $login_name, $error_login;
    $username = $_POST['username'];
    $password = $_POST['matkhau'];
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
				$rs["thongbao"]="<span style='color:#fff;'>Đăng nhập thành công!. Hệ thống sẽ chuyển trang trong giây lát. </span>";
                $rs["url"]=getCurrentPageURL();
            } else{
                $rs["id"]=0;
				$rs["thongbao"]="<span style='color:#fff'>" . _saitendangnhap . "</span><br><a href='quen-mat-khau.html'>Quên mật khẩu</a>";
			}
        } else{
            $rs["id"]=0;
			$rs["thongbao"]="<span style='color:#fff'>" . _taikhoanchuakichhoat . "</span>";
		}
    } else{
        $rs["id"]=0;
		$rs["thongbao"]="<span style='color:#fff'>Tài khoản không tồn tại </span>";
	}
	echo json_encode($rs);
}

?>
