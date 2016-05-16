<h3>Thêm mới hotline</h3>

<form name="frm" method="post" action="index.php?com=hotline&act=save" enctype="multipart/form-data" class="nhaplieu">

    <b>Hotline</b>
	<input type="text" name="dienthoai" value="<?=@$item['dienthoai']?>" class="input" /><br />  
	
	
	
	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br />
	
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=hotline&act=man'" class="btn" />
</form>