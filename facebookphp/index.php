<?php
session_start();
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../admin/lib/');
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."functions.php";
	include_once _lib."function_user.php";
	include_once _lib."class.database.php";
	include_once _lib."file_requick.php";
include_once("config.php");
//include_once("includes/functions.php");
//destroy facebook session if user clicks reset
if(!$fbuser){
	$fbuser = null;
	$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
	$output = '<a href="'.$loginUrl.'"><img src="images/fb_login.png"></a>'; 	
}else{
	$user = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
	//print_r($user);exit;
	global $d;
	//kiem tra ton tai id_facebook
	$id = $user['id'];
	//echo $user['id'];
	$d->reset();
	$sql="select * from table_thanhvien where id_facebook='".$id."'";
	$d->query($sql);
	$kttt = $d->fetch_array();
	//print_r($kttt);exit;
	if($kttt == ''){
		$d->reset();
		$time = time();
		if($user['gender'] == 'male'){ $gt = 1;}else{$gt=0;}
		$sql="insert into table_thanhvien(id_facebook,hoten,email,gioitinh,ngaydangki,typelog) values ('".$id."','".$user['first_name'].' '.$user['last_name']."','".$user['email']."','".$gt."','".$time."','facebook')";
		$d->query($sql);
		
		$sql="select * from table_thanhvien where id_facebook='".$user['id']."'";
		$d->query($sql);
		$lay_taikhoan = $d->fetch_array();

		 $_SESSION['mem_login']['mem_mail'] = $lay_taikhoan['email'];

		 $_SESSION['mem_login']['phone'] = $lay_taikhoan['dienthoai'];
		 $_SESSION['mem_login']['address'] = $lay_taikhoan['diachi'];
		 $_SESSION['mem_login']['name'] = $lay_taikhoan['hoten'];
		 $_SESSION['mem_login']['iduser'] = $lay_taikhoan['id'];
		redirect("http://$config_url/index.html");
	 }
	 else{
	 	//echo "Đã tồn tại id facebook";exit;
		 $d->reset();
		 $sql="select * from table_thanhvien where id_facebook='".$user['id']."'";
		 $d->query($sql);
		 $lay_taikhoan = $d->fetch_array();
		 $_SESSION['mem_login']['mem_mail'] = $lay_taikhoan['email'];

		 $_SESSION['mem_login']['phone'] = $lay_taikhoan['dienthoai'];
		 $_SESSION['mem_login']['address'] = $lay_taikhoan['diachi'];
		 $_SESSION['mem_login']['name'] = $lay_taikhoan['hoten'];
		 $_SESSION['mem_login']['iduser'] = $lay_taikhoan['id'];

		 redirect("http://$config_url/index.html");
		
	 }
	//print_r($user_profile);exit;
	/*$user = new Users();
	$user_data = $user->checkUser('facebook',$user_profile['id'],$user_profile['first_name'],$user_profile['last_name'],$user_profile['email'],$user_profile['gender'],$user_profile['locale'],$user_profile['picture']['data']['url']);
	if(!empty($user_data)){
		$output = '<h1>Facebook Profile Details </h1>';
		$output .= '<img src="'.$user_data['picture'].'">';
        $output .= '<br/>Facebook ID : ' . $user_data['oauth_uid'];
        $output .= '<br/>Name : ' . $user_data['fname'].' '.$user_data['lname'];
        $output .= '<br/>Email : ' . $user_data['email'];
        $output .= '<br/>Gender : ' . $user_data['gender'];
        $output .= '<br/>Locale : ' . $user_data['locale'];
        $output .= '<br/>You are login with : Facebook';
        $output .= '<br/>Logout from <a href="logout.php?logout">Facebook</a>'; 
	}else{
		$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
	}*/
}
?>
