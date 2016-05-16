<?php
$d->reset();
$sql="select * from #_product where hienthi=1 and id=".$item['id_sp'];
$d->query($sql);
$sp=$d->result_array();

?>
<h3> Đánh giá sản phẩm</h3>

<form name="frm" method="post" action="index.php?com=danhgiasp&act=save&curPage=<?=$_REQUEST['curPage']?>" enctype="multipart/form-data" class="nhaplieu">	
	<b>Họ Tên</b> <input type="text" name="ten" value="<?=$item['hoten']?>" class="input" /><br /> 
    <b>Tên sản phẩm</b> <input type="text" name="ten" value="<?=$sp[0]['ten']?>" class="input" /><br /> 
    <b>Số điện thoại</b> <input type="text" name="ten" value="<?=$item['dienthoai']?>" class="input" /><br /> 
    <b>Email</b> <input type="text" name="ten" value="<?=$item['email']?>" class="input" /><br /> 
    <b>Nội dung</b><div><textarea name="noidung" id="noidung" cols="50" rows="5"><?=$item['noidung']?></textarea></div> <br/>
    <b>Hiển thị tin</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br /><br />
	
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=danhgiasp&act=man'" class="btn" />
</form>