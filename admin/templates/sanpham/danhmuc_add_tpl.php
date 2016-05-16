<script language="javascript">
function goback() {
    history.back(-1);
}
</script>
<h3>Thêm danh mục</h3>
<script language="javascript">	

	function select_onchange1()
	{	
		//var b=document.getElementById("id_cat");
		var c=document.getElementById("id_cat");
		window.location ="index.php?com=sanpham&act=<?php if($_REQUEST['act']=='edit_danhmuc') echo 'edit_danhmuc'; else echo 'add_danhmuc';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>"+"&id_cat="+c.value;	
		return true;
	}
	function select_onchange2()
	{	
		var c=document.getElementById("id_cat");
		var b=document.getElementById("id_item");
		window.location ="index.php?com=sanpham&act=<?php if($_REQUEST['act']=='edit_danhmuc') echo 'edit_danhmuc'; else echo 'add_danhmuc';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_cat="+c.value+"&id_item="+b.value;	
		return true;
	}

</script>

<?php	
	function get_main_cat()
	{
		$sql_huyen="select * from table_product_cat order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select style="padding:5px" id="id_cat" name="id_cat" onchange="select_onchange1()" class="main_font">
			<option >Chọn danh mục</option>
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	function get_main_item()
	{
		$sql_huyen="select * from table_product_list where id_cat='".$_REQUEST['id_cat']."'  order by stt desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select style="padding:5px" id="id_item" name="id_list" onchange="select_onchange22()" class="main_font">
			<option>Chọn danh mục</option>	
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_list"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	if(!isset($item['ten'])) $item['ten']="";
?>


<form name="frm" method="post" action="index.php?com=sanpham&act=save_danhmuc<?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>" enctype="multipart/form-data" class="nhaplieu">	
	<b>Danh mục cấp 1:</b><?=get_main_cat();?><br />
    <b>Danh mục cấp 2:</b><?=get_main_item();?><br />
    <br />
     <?php if ($_REQUEST['act']==edit_danhmuc)
	{?>
	<b>Hình hiện tại:</b><img src="<?=_upload_sanpham.$item['photo']?>" width="80px"  alt="NO PHOTO" /><br />
	<?php }?>
	<b>Hình ảnh:</b> <input type="file" name="file" /> <?=_product_type?>(w:308px;h:321px)<br />
    <b>Tên</b> <input type="text" name="ten" value="<?=$item['ten']?>" class="input" /><br /><br>
      <!--<b>Keyword</b> <input type="text" name="keyword" value="<?=@$item['keyword']?>" class="input" /><br /><br>
	  <b>Description </b> <div><textarea type="text" cols="50" rows="5" name="description" ><?=@$item['description']?></textarea></div>-->
    <b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br>

	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br />
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:goback();" class="btn" />
</form>