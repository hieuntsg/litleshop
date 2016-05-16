<h3>Hình ảnh</h3>

<form name="frm" method="post" action="index.php?com=slider&act=save_photo" enctype="multipart/form-data" class="nhaplieu">		
  <?php for($i=0; $i<1; $i++){?>
	
	<b>Hình ảnh <?=$i+1?></b> <input type="file" name="file<?=$i?>" /> width:1200px - hieght:452px <?=_hinhanh_type?><br />	 <br />	      
	<b>Link</b> <input type="text" name="ten<?=$i?>" value="" class="input" /><br />	  	
    <!--<b>Link</b> <input type="text" name="link<?=$i?>" value="" class="input" /><br />	<br />	--> 
    <b>Số thứ tự </b> <input type="text" name="stt<?=$i?>" value="1" style="width:30px" />	<br /><br />	 
	<b>Hiển thị</b> <input type="checkbox" name="hienthi<?=$i?>" checked="checked" /> <br /><br />
	
<? }?>
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=slider&act=man_photo'" class="btn" />
</form>