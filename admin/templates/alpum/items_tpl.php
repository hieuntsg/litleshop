<script>
$(document).ready(function() {
$("#chonhet").click(function(){
	var status=this.checked;
	$("input[name='chon']").each(function(){this.checked=status;})
});

$("#xoahet").click(function(){
	var listid="";
	$("input[name='chon']").each(function(){
		if (this.checked) listid = listid+","+this.value;
    	})
	listid=listid.substr(1);	 //alert(listid);
	if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
	hoi= confirm("Bạn có chắc chắn muốn xóa?");
	if (hoi==true) document.location = "index.php?com=alpum&act=delete&listid=" + listid;
});
});
</script>
<h3><a href="index.php?com=alpum&act=add">Thêm hình ảnh</a></h3>
<script language="javascript">	
	function select_onchange()
	{	
		var b=document.getElementById("id_cat");
		window.location ="index.php?com=alpum&act=man&id_cat="+b.value;	
		return true;
	}
	
</script>
<?php function get_main_category()
	{
		$sql="select * from table_alpum_item order by stt asc,id desc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_cat" name="id_cat" onchange="select_onchange()" class="main_font">
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
	}?>
<table class="blue_table">

	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th width="5%" style="width:6%;">Stt</th>
		<th width="5%" style="width:6%;">hình ảnh</th>
		<!--<th style="width:40%;">Danh mục</th>-->
        <th style="width:40%;">Tên</th>
		<!--<th style="width:40%;">hình ảnh</th>
		<th width="9%" style="width:6%;">Hot</th>-->
	  <th width="9%" style="width:6%;">Hiển thị</th>
		<th width="9%" style="width:6%;">Sửa</th>
		<th width="9%" style="width:6%;">Xóa</th>
	</tr>
    
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        <td style="width:6%;" align="center"><?=$items[$i]['stt']?></td>
		<td style="width:6%;" align="center"><img src="<?=_upload_tintuc.$items[$i]['photo']?>" height="50"/></td>
		
		 <!--<td style="width:3%;" align="center">
		 	<?php
				/*$sql_danhmuc="select ten from table_alpum_item where id='".$items[$i]['id_item']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten']*/
			?>    
		 
		 </td>-->
        
		<td style="width:40%;" align="center"><a href="index.php?com=alpum&act=edit&id_item=<?=$items[$i]['id_item']?>&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['ten']?></a></td>
			
            <!--<td style="width:40%;" align="center"><a href="index.php?com=hinhanh&act=man_photo&idc=<?=$items[$i]['id']?>">Thêm hình ảnh </a></td>
		
		<td style="width:6%;">
        
        
		
		<?php 
		if(@$items[$i]['hot']==1)
		{
		?>       
       
        <a href="index.php?com=alpum&act=man<?php if($_REQUEST['id_cat']!='') echo"&id_cat=".$_REQUEST['id_cat'] ?>&hot=<?=$items[$i]['id']?>"><img src="media/images/active_1.png"  border="0"/></a>
			
		<? 
		}
		else
		{
		?>
         <a href="index.php?com=alpum&act=man<?php if($_REQUEST['id_cat']!='') echo"&id_cat=".$_REQUEST['id_cat'] ?>&hot=<?=$items[$i]['id']?>"><img src="media/images/active_0.png" border="0" /></a>
         <?php
		 }?>        </td>-->
		<td style="width:6%;">
        
        
		
		<?php 
		if(@$items[$i]['hienthi']==1)
		{
		?>       
       
        <a href="index.php?com=alpum&act=man<?php if($_REQUEST['id_cat']!='') echo"&id_cat=".$_REQUEST['id_cat'] ?>&hienthi=<?=$items[$i]['id']?>"><img src="media/images/active_1.png"  border="0"/></a>
			
		<? 
		}
		else
		{
		?>
         <a href="index.php?com=alpum&act=man<?php if($_REQUEST['id_cat']!='') echo"&id_cat=".$_REQUEST['id_cat'] ?>&hienthi=<?=$items[$i]['id']?>"><img src="media/images/active_0.png" border="0" /></a>
         <?php
		 }?>        </td>
		<td style="width:6%;" align="center"><a href="index.php?com=alpum&act=edit&id_item=<?=$items[$i]['id_item']?>&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png"  border="0"/></a></td>
		<td style="width:6%;">
		<?php
		if($items[$i]['id']!='0')
		{
		?>
		<a href="index.php?com=alpum&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a>
		<? }?>
		</td>
	</tr>
	<?php	}?>
</table>
<a href="index.php?com=alpum&act=add"><img src="media/images/add.jpg" border="0"  /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>

<div class="paging"><?=$paging['paging']?></div>