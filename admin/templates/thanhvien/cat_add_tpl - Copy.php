<h3>Thêm danh mục</h3>

<form name="frm" method="post" action="index.php?com=tintuc&act=save_cat" enctype="multipart/form-data" class="nhaplieu">
	<b>Tên</b> <input type="text" name="ten" value="<?=$item['name_vi']?>" class="input" /><br />
	 <b>Keyword</b> <input type="text" name="keyword" value="<?=@$item['keyword']?>" class="input" /><br /><br>
	  <b>Description </b> <div><textarea type="text" cols="50" rows="5" name="description" ><?=@$item['description']?></textarea></div>         
    <b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br>

	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br />   	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=tintuc&act=man_cat'" class="btn" />
</form>