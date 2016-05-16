
	<?	
	$title_bar='Liên hệ';
	$title_tcat='Liên hệ';
	//$ten=$_POST['ten'];
//	$diachi=$_POST['diachi'];
	//$dienthoai=$_POST['dienthoai'];
	//$email=$_POST['email'];
	//$tieude=$_POST['tieude1'];
	//$noidung=$_POST['noidung'];
	if(!empty($_POST)){
	$data['ten'] = $_POST['ten'];
	$data['diachi'] = $_POST['diachi'];
	$data['dienthoai'] = $_POST['dienthoai'];
	$data['email'] = $_POST['email'];
	$data['tieude'] = $_POST['tieude1'];
	$data['noidung'] = $_POST['noidung'];
	$data['id_sanpham'] = $_REQUEST['id'];
	$data['ngaytao'] = time();
	$d->setTable('contact');
	$d->insert($data); 
		$body = '<table>';
		$body .= '
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th colspan="2">Thư liên hệ từ website trumsi.vn</th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th>Họ tên :</th><td>'.$_POST['ten'].'</td>
			</tr>
			<tr>
				<th>Địa chỉ :</th><td>'.$_POST['diachi'].'</td>
			</tr>
			<tr>
				<th>Điện thoại :</th><td>'.$_POST['dienthoai'].'</td>
			</tr>
			<tr>
				<th>Email :</th><td>'.$_POST['email'].'</td>
			</tr>
			
			<tr>
				<th>Tiêu đề :</th><td>'.$_POST['tieude1'].'</td>
			</tr>
			<tr>
				<th>Nội dung :</th><td>'.$_POST['noidung'].'</td>
			</tr>';
		$body .= '</table>';
	$d->reset();
	$sql_company="select * from table_company limit 0,1";
	$d->query($sql_company);
	$result_company=$d->result_array();
	$email_company=$result_company[0]['email'];
	
	
	/*include('class.phpmailer.php');
                $mail = new PHPMailer();  
                $mail->IsSMTP();  // telling the class to use SMTP
                $mail->Mailer = "smtp";
                $mail->Host = "112.213.84.126";
                $mail->Port = 25;
                $mail->SMTPAuth = true; // turn on SMTP authentication
                $mail->Username = "banghecafe"; // SMTP username
                $mail->Password = "NDn3R2M0"; // SMTP password
                $mail->From     = "banghecafe@banghecafecaocap.com";
                $mail->AddAddress($email_company);  			
				$mail->AddCC($email_company, $email_company);
				$mail->CharSet = ("UTF-8");
                $mail->Subject  = "Tin liên hệ";
				$mail->MsgHTML($body);
                $mail->Body     = $body;		
                $mail->WordWrap = 50;  
               $mail->Send();*/
			    
			transfer("Bạn đã gửi liên hệ thành công", "trang-chu.html");
	}  
?>