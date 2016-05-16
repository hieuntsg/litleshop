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
	if (hoi==true) document.location = "index.php?com=sanpham&act=delete_danhmuc&listid=" + listid;
});
});
</script>
<h3><a href="index.php?com=sanpham&act=add_danhmuc">Thêm danh mục</a></h3> 
 Danh mục cấp 1&nbsp;<?=get_main_cat();?>&nbsp;&nbsp; Danh mục cấp 2&nbsp;<?=get_main_item();?></h3>
<script language="javascript">	

	function select_onchange1()
	{	
		//var b=document.getElementById("id_cat");
		var c=document.getElementById("id_cat");
		window.location ="index.php?com=sanpham&act=man_danhmuc&id_cat="+c.value;	
		return true;
	}
	function select_onchange2()
	{	
		var c=document.getElementById("id_cat");
		var b=document.getElementById("id_list");
		window.location ="index.php?com=sanpham&act=man_danhmuc&id_cat="+c.value+"&id_list="+b.value;	
		return true;
	}

</script>
<?php


	function get_main_cat()
	{
		$sql_huyen="select * from table_product_cat  order by stt desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select style="padding:5px" id="id_cat" name="id_cat" onchange="select_onchange1()" class="main_font">
			<option>Chọn danh mục</option>	
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
			<select style="padding:5px" id="id_list" name="id_list" onchange="select_onchange2()" class="main_font">
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
?><br />
<table class="blue_table">
	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th style="width:5%;">Stt</th>		
        <th style="width:15%;">Danh mục cấp 1</th>
        <th style="width:15%;">Danh mục cấp 2</th>
        <th style="width:10%;">Hình ảnh</th>
        <th style="width:15%;">Tên</th>      
		<th style="width:5%;">Hiển thị</th>
		<th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        <td style="width:5%;"><?=$items[$i]['stt']?></td>
         <td align="center" style="width:15%;">
        
        <?php
	$sql_danhmuc="select ten from table_product_cat where id='".$items[$i]['id_cat']."'";
		$result=mysql_query($sql_danhmuc);
	 	$item_danhmuc =mysql_fetch_array($result);
	 	echo @$item_danhmuc['ten']
	?>
        
        
        </td>	
        <td align="center" style="width:15%;">
        
        <?php
		$sql_danhmuc="select ten from table_product_list where id='".$items[$i]['id_list']."'";
		$result=mysql_query($sql_danhmuc);
	 	$item_danhmuc =mysql_fetch_array($result);
	 	echo @$item_danhmuc['ten']
	?>
        
        
        </td>
         <td style="width:10%;"><img src="<?=_upload_sanpham.$items[$i]['photo']?>" width="100" /></td>		      
		<td style="width:15%;"><a href="index.php?com=sanpham&act=edit_danhmuc&id_cat=<?=$items[$i]['id_cat']?>&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['ten']?> </a></td>
       
		<td style="width:5%;"><?php 
		if(@$items[$i]['hienthi']==1)
		{
		?>
      <a href="index.php?com=sanpham&act=man_danhmuc<?php $ur=""; if($_REQUEST['id_cat']!=''){
			$ur="&id_cat=".$_REQUEST['id_cat'];
		if($_REQUEST['id_list']!='') $ur.="&id_list=".$_REQUEST['id_list'];} echo $ur;?>&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_1.png" border="0" /></a>
      <? 
		}
		else
		{
		?>
      <a href="index.php?com=sanpham&act=man_danhmuc<?php $ur=""; if($_REQUEST['id_cat']!=''){
			$ur="&id_cat=".$_REQUEST['id_cat'];
		if($_REQUEST['id_list']!='') $ur.="&id_list=".$_REQUEST['id_list'];} echo $ur;?>&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_0.png"  border="0"/></a>
      <?php
		 }?></td>
		<td style="width:5%;"><a href="index.php?com=sanpham&act=edit_danhmuc&id_cat=<?=$items[$i]['id_cat']?>&id_list=<?=$items[$i]['id_list']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/edit.png" border="0" /></a></td>
		<td style="width:5%;"><a href="index.php?com=sanpham&act=delete_danhmuc&id_cat=<?=$items[$i]['id_cat']?>&id_list=<?=$items[$i]['id_list']?>&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>
<a href="index.php?com=sanpham&act=add_danhmuc"><img src="media/images/add.jpg" border="0"  /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>

<div class="paging"><?=$paging['paging']?></div>