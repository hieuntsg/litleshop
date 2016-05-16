<h3>Hình ảnh</h3>

<form name="frm" method="post" action="index.php?com=slider&act=save_photo&id=<?=$_REQUEST['id'];?>" enctype="multipart/form-data" class="nhaplieu">
     <b>Hình hiện tại:</b>   <img src="<?=_upload_hinhanh.$item['photo']?>" width="300" />
    
    <br />
	<b>Hình ảnh </b> <input type="file" name="file" />  width:1200px - hieght:452px  <?=_hinhanh_type?><br />
     <b>Link</b> <input type="text" name="ten" value="<?=@$item['ten']?>" class="input" /><br />	
    <!-- <b>Link</b> <input type="text" name="link" value="<?=@$item['link']?>" class="input" /><br />	-->
	<b>Số thứ tự </b> <input type="text" name="stt" value="<?=$item['stt']?>" style="width:30px" />	<br />
	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=$item['hienthi'] ? 'checked="checked"' : ""?> /> <br /><br />
	
	<input type="hidden" name="id" value="<?=$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=slider&act=man_photo'" class="btn" />
</form>