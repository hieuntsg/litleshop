<script language="javascript">				
	function select_onchange1()
	{			

		var b=document.getElementById("id_cat");
		window.location ="index.php?com=quangcao1&act=edit_photo<?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_cat="+b.value;	
		return true;
	}
	function select_onchangelist()
	{	
		var b=document.getElementById("id_cat");
		var c=document.getElementById("id_list");
		window.location ="index.php?com=quangcao1&act=edit_photo<?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_cat="+b.value+"&id_list="+c.value;	
		return true;
	}

	function select_onchangelist2()
	{	
		var b=document.getElementById("id_cat");
		var c=document.getElementById("id_list");
		var x=document.getElementById("id_item");
		window.location ="index.php?com=quangcao1&act=edit_photo<?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_cat="+b.value+"&id_list="+c.value+"&id_item="+x.value;	
		return true;
	}
</script>
<?php
function get_main_category()
	{
		$sql="select * from table_product_cat order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select style="padding:5px;" id="id_cat" name="id_cat" onchange="select_onchange1()" class="main_font">
			<option>Chọn danh mục</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	
	function get_main_item()
	{
		$sql_huyen="select * from table_product_list where id_cat=".$_REQUEST['id_cat']."  order by id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select style="padding:5px;" id="id_list" name="id_list" onchange="select_onchangelist()" class="main_font">
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
	

	function get_main_item2()
	{
		$sql_huyen="select * from table_product_item where id_cat=".$_REQUEST['id_cat']." and id_list=".$_REQUEST['id_list']." order by stt desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select style="padding:5px;" id="id_item" name="id_item" onchange="select_onchangelist2()" class="main_font">
			<option>Chọn danh mục</option>	
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}

	if(!isset($_REQUEST['curPage'])) $_REQUEST['curPage']=1;
	if(!isset($_REQUEST['act'])) $_REQUEST['act']="";
?>
<h3>Sản phẩm</h3>

<form name="frm" method="post" action="index.php?com=quangcao1&act=save_photo&id=<?=$_REQUEST['id'];?>&idc=<?=$_REQUEST['idc']?>" enctype="multipart/form-data" class="nhaplieu">	
	<b>Danh mục cấp 1:</b><?=get_main_category();?><br />
	<b>Danh mục cấp 2:</b><?=get_main_item();?><br />
	<b>Danh mục cấp 3:</b><?=get_main_item2();?><br />
	<br />
    Hình hiện tại : <img src="<?=_upload_sanpham.$item['photo']?>" width="100" />
    
    <br />
	<b>Hình ảnh </b> <input type="file" name="file" /> <strong>Dạng:.jpg|.gif|png(w:744px;h:1020)(Tỉ lệ: 1:2,1:3...)</strong><br />
	
    <br />
	<!-- <b>Tên: </b> <input name="ten" type="text"   />	
	<br /> -->
<div style="color:red;font-size: 15px;margin-bottom: 20px;">* Nhấn giữ ctrl để chọn nhiều sản phẩm con</div>    
<?php 
	$d->reset();
	$sql="select * from #_product_list order by stt,id desc";
	$d->query($sql);
	$result_list = $d->result_array();

foreach ($result_list as $kl => $vl) {
		$d->reset();
		$sql="select * from #_product where id_list = ".$vl['id']." order by stt,id desc";
		$d->query($sql);
		$result_pro = $d->result_array();
		
	if(count($result_pro) > 0){	?>
<div style="float: left;width:200px;margin-right:20px;">	
	<div style="color:blue;font-size:13px;text-transform: uppercase;"><?=$vl['ten']?></div>
    
    <select name="prolist[]" size="10" multiple="multiple" tabindex="10" style="width:200px;">

    	<?php 
    	$id_pro =  $item['id_product'];

			$tach= explode(',',$id_pro);
			
    	foreach ($result_pro as $kp => $vp) { ?>
    		
			
		<?php	for ($i=0; $i < count($tach) ; $i++) { 
				if( $vp['id'] == $tach[$i]){ 
					
					$vp['vitri'] = 'selected';
				}
    		}?>
    <option value="<?=$vp['id']?>" <?=$vp['vitri']?> ><?=$vp['ten']?></option>
        	
        	
        <?php } ?>

        
    </select>
</div>    
<?php } ?>
	
<?php } ?>
<div style="clear: both;"></div>	
	<b>Số thứ tự </b> <input type="text" name="stt" value="<?=$item['stt']?>" style="width:30px" />	<br />
	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=$item['hienthi'] ? 'checked="checked"' : ""?> /> <br /><br />
	
	<input type="hidden" name="id" value="<?=$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=quangcao1&act=man_photo'" class="btn" />
</form>