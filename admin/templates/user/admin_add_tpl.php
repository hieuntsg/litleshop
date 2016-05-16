<script language="javascript" src="media/scripts/my_script.js"></script>
<script language="javascript">
function js_submit(){
	if(isEmpty(document.frm.username, "Chưa nhập tên đăng nhập.")){
		return false;
	}
	
	if(isEmpty(document.frm.oldpassword, "Chưa nhập mật khẩu cũ.")){
		return false;
	}
	
	if(!isEmpty(document.frm.new_pass) && document.frm.new_pass.value.length<5){
		alert("Mật khẩu phải nhiều hơn 4 ký tự.");
		document.frm.new_pass.focus();
		return false;
	}
	
	if(!isEmpty(document.frm.new_pass) && document.frm.new_pass.value!=document.frm.renew_pass.value){
		alert("Nhập lại mật khẩu mới không chính xác.");
		document.frm.renew_pass.focus();
		return false;
	}
	
	if(!isEmpty(document.frm.email) && !check_email(document.frm.email.value)){
		alert('Email không hợp lệ.');
		document.frm.email.focus();
		return false;
	}
}
</script>
<h3>Tài khoản</h3>

<form name="frm" method="post" action="index.php?com=user&act=admin_edit" enctype="multipart/form-data" class="nhaplieu" onSubmit="return js_submit();">

	<b>Tên đăng nhập</b> <input type="text" name="username" id="username" value="<?=$item['username']?>" class="input" /><span class="require">*</span><br />
	<b>Mật khẩu</b> <input type="password" name="oldpassword" id="oldpassword" value="" class="input" /><span class="require">*</span><br />
	<b>Mật khẩu mới</b> <input type="password" name="new_pass" id="new_pass" value="" class="input" /><br />
	<b>Nhập lại mật khẩu mới</b> <input type="password" name="renew_pass" value="" class="input" /><br /><br />
	
	<!--<b>Họ tên</b> <input type="text" name="ten" id="ten" value="<?=$item['ten']?>" class="input" /><br />
	<b>Email</b> <input type="text" name="email" id="email" value="<?=$item['email']?>" class="input" /><br />
	<b>Yahoo nickname</b> <input type="text" name="nick_yahoo" value="<?=$item['nick_yahoo']?>" class="input" /><br />
	<b>Skype nickname</b> <input type="text" name="nick_skype" value="<?=$item['nick_skype']?>" class="input" /><br />
	<b>Điện thoại</b> <input type="text" name="dienthoai" value="<?=$item['dienthoai']?>" class="input" /><br />
-->
	<!--
	<b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br>
	
	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br />
	-->
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php'" class="btn" />
</form>