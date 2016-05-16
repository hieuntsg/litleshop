<?php  if(!defined('_source')) die("Error");		
	// thanh tieu de
	$title_bar .= "Thanh toán";
	
	if(!empty($_POST)){
	$sql="select * from #_company ";
	$d->query($sql);
	$com=$d->fetch_array();
	

		$hoten=$_POST['ten'];
		$dienthoai=$_POST['dienthoai'];
		$diachi=$_POST['diachi'];
		$email=$_POST['email'];
		$noidung=$_POST['noidung'];
		$iduserdk=$_POST['iduser'];		
		
		//validate dữ liệu
	
	$hoten = trim(strip_tags($hoten));
	$dienthoai = trim(strip_tags($dienthoai));	
	$diachi = trim(strip_tags($diachi));	
	$email = trim(strip_tags($email));	
	$noidung = trim(strip_tags($noidung));	

	if (get_magic_quotes_gpc()==false) {
		$hoten = mysql_real_escape_string($hoten);
		$dienthoai = mysql_real_escape_string($dienthoai);
		$diachi = mysql_real_escape_string($diachi);
		$email = mysql_real_escape_string($email);
		$noidung = mysql_real_escape_string($noidung);						
	}


	$coloi=false;		
	if ($hoten == NULL) { 
		$coloi=true; $error_hoten = "Bạn chưa nhập họ tên<br>";
	} 
	if ($dienthoai == NULL) { 
		$coloi=true; $error_dienthoai = "Bạn chưa nhập điện thoại<br>";
	}
	if ($diachi == NULL) { 
		$coloi=true; $error_diachi = "Bạn chưa nhập địa chỉ<br>";
	}	
	
	if ($email == NULL) { 
		$coloi=true; $error_email = "Bạn chưa nhập email<br>";
	}elseif (filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE) { 
		$coloi=true; $error_email="Bạn nhập email không đúng<br>";
	}
		
	if ($coloi==FALSE) {
									
			$body.='<table border="0" cellpadding="5px" cellspacing="1px" style="font-size:12px; background-color:#ffae00; font-family:opensans_b; padding:10px;" width="100%">';
			if(is_array($_SESSION['cart']))
			{
            $body.='<tr bgcolor="#ffae00">
            	<td align="center" style="color:#FFF;padding:10px">STT</td>
            	<td align="center" style="color:#FFF;padding:10px">Tên</td>
            	<td align="center" style="color:#FFF;padding:10px">Giá</td>
            	<td align="center" style="color:#FFF;padding:10px">SL/Size</td>
            	<td align="center" style="color:#FFF;padding:10px">Tổng giá</td>
            	</tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$size=$_SESSION['cart'][$i]['size'];					
					$pname=get_product_name($pid);
					$sqlxl = "update table_product set soluong=soluong-".$q." where id = ".$pid."" ;
					mysql_query($sqlxl) or die(mysql_error());					
					if($q==0) continue;
            		$body.='<tr bgcolor="#FFFFFF">
            		<td style="padding:10px" align="center">'.($i+1).'</td>';
            		$body.='<td style="padding:10px" align="center">'.$pname.'</td>';
                    $body.='<td style="padding:10px" align="center">'.number_format(get_price($pid),0, ',', '.').'&nbsp;₫</td>';
                    $body.='<td style="padding:10px" align="center">'.$q.'<br>Size:'.$size.'</td>';                 
                    $body.='<td style="padding:10px" align="center">'.number_format(get_price($pid)*$q,0, ',', '.') .'&nbsp;₫</td>
                    </tr>';
				}
				$body.='<tr><td colspan="5" style="padding:5px">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              <td style="text-align:left;"> '; 
               $body.=' <strong>Tổng giá bán:'. number_format(get_order_total(),0, ',', '.') .' &nbsp;₫</strong></td>
              <td colspan="5" align="right">&nbsp;</td>
             </tr>
             </table>   
                </td></tr>';
            }
			else{
				$body.='<tr bgColor="#FFFFFF"><td>Không có sản phẩm trong giỏ hàng</td>';
			}
       $body.='</table>';
  			
			$mahoadon=strtoupper (ChuoiNgauNhien(8));
			$ngaydangky=time();
			$tonggia=get_order_total();
			
			$sql = "INSERT INTO  table_donhang (iduser,madonhang,hoten,dienthoai,diachi,email,httt,tonggia,noidung,donhang,ngaytao,trangthai ) 
				  VALUES ('$iduserdk','$mahoadon','$hoten','$dienthoai','$diachi','$email','$httt','$tonggia','$noidung','$body','$ngaydangky','1')";	
			mysql_query($sql) or die(mysql_error());
			$iduser = mysql_insert_id();
										
					
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
                //$mail->AddAddress($com['email']);   			
				$mail->AddCC($com['email']);
				$mail->CharSet = ("UTF-8");
                $mail->Subject  = "Thông tin mã đơn hàng ".$mahoadon."";
				$mail->MsgHTML($body);
                $mail->Body     = $body;		
                $mail->WordWrap = 50;  
               	$mail->Send();//echo $com['email'].'-'.$email;exit;	
		//$_SESSION['cart']= false;

             //define('GUSER', 'testmailweb.ptit@gmail.com'); // tài khoản đăng nhập Gmail
			//define('GPWD', '01021989as'); // mật khẩu cho cái mail này  
						
			/*function smtpmailer($to, $from, $from_name, $subject, $body) { 
				global $error;
				
				$mail = new PHPMailer();  // tạo một đối tượng mới từ class PHPMailer
				$mail -> CharSet  =  'UTF-8' ;
				$mail->IsSMTP(); // bật chức năng SMTP
				$mail->SMTPDebug = 1;  // kiểm tra lỗi : 1 là  hiển thị lỗi và thông báo cho ta biết, 2 = chỉ thông báo lỗi
				$mail->SMTPAuth = true;  // bật chức năng đăng nhập vào SMTP này
			//	$mail->SMTPSecure = 'ssl'; // sử dụng giao thức SSL vì gmail bắt buộc dùng cái này
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
			
			if (smtpmailer($email, $com['email'],'trumsi.vn', 'Thông tin mã đơn hàng "'.$mahoadon.'" từ website trumsi.vn', $body)) {
				smtpmailer($com['email'], $com['email'],'trumsi.vn', 'Thông tin mã đơn hàng "'.$mahoadon.'" vừa xác nhận', $body);
				unset($_SESSION['cart']);
				transfer("Thông tin đơn hàng đã được gửi.<br>Cảm ơn.", "trang-chu.html");
			}
			else
			{
				transfer("Thông tin đơn hàng không gửi được.<br>Vui lòng kiểm tra lại.", "trang-chu.html");
			}*/
		unset($_SESSION['cart']);		
		transfer("Thông tin đơn hàng đã được gửi", "trang-chu.html");
			
		}
	
	}
?>