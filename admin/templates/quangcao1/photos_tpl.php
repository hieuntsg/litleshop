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
	if (hoi==true) document.location = "index.php?com=quangcao1&act=delete_photo&listid=" + listid;
});
});
</script>

<script language="javascript">	
	function select_onchange()
	{	
		var b=document.getElementById("id_cat");
		window.location ="index.php?com=quangcao1&act=man_photo&id_cat="+b.value;	
		return true;
	}
	
	function select_onchange1()
	{	
		var b=document.getElementById("id_cat");
		var c=document.getElementById("id_list");
		window.location ="index.php?com=quangcao1&act=man_photo&id_cat="+b.value+"&id_list="+c.value;	
		return true;
	}
	function select_onchange2()
	{	
		var b=document.getElementById("id_cat");
		var c=document.getElementById("id_list");
		var x=document.getElementById("id_item");
		window.location ="index.php?com=quangcao1&act=man_photo&id_cat="+b.value+"&id_list="+c.value+"&id_item="+x.value;	
		return true;
	}

</script>
<?php

	function get_main_category()
	{
		$sql="select * from table_product_cat order by stt asc,id desc";
		$stmt=mysql_query($sql);
		$str='
			<select style="padding:5px;" id="id_cat" name="id_cat" onchange="select_onchange()" class="main_font">
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
		$sql_huyen="select * from table_product_list where id_cat = ".$_REQUEST['id_cat']."  order by stt desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select style="padding:5px;" id="id_list" name="id_list" onchange="select_onchange1()" class="main_font">
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
			<select style="padding:5px;" id="id_item" name="id_item" onchange="select_onchange2()" class="main_font">
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
?>
<h3><a href="index.php?com=quangcao1&act=add_photo">Thêm sản phẩm</a></h3>
Danh mục cấp 1:<?=get_main_category();?> Danh mục cấp 2:<?=get_main_item();?>
Danh mục cấp 3:<?=get_main_item2();?>
<table class="blue_table">
	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
		<th style="width:5%;">Stt</th>
		<th style="width:10%;">Danh mục cấp 1</th>
		<th style="width:10%;">Danh mục cấp 2</th>
		<th style="width:10%;">Danh mục cấp 3</th>
		<th style="width:20%;">Sản phẩm</th>		
        <th style="width:15%;">Hình ảnh</th>
        <th style="width:10%;">Thêm hình</th>
      	<th style="width:5%;">Hiển thị</th>
		<th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
		<td style="width:5%;"><?=$items[$i]['stt']?></td>
		<td style="width:10%;"><?php
				$sql_danhmuc="select ten from table_product_cat where id='".$items[$i]['id_cat']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten']
			?>
	    </td>
	    <td style="width:10%;">
			<?php
	            $sql_danhmuc="select ten from table_product_list where id='".$items[$i]['id_list']."'";
	            $result=mysql_query($sql_danhmuc);
	            $item_danhmuc =mysql_fetch_array($result);
	            echo @$item_danhmuc['ten']
	        ?>
	    </td>
	    <td style="width:10%;">
			<?php
	            $sql_danhmuc="select ten from table_product_item where id='".$items[$i]['id_item']."'";
	            $result=mysql_query($sql_danhmuc);
	            $item_danhmuc =mysql_fetch_array($result);
	            echo @$item_danhmuc['ten']
	        ?>
	    </td>
        <td style="width:20%;">
		<?php
			$id_pro =  $items[$i]['id_product'];
			$tach= explode(',',$id_pro);
			foreach ($tach as $ksp => $vsp) {
				$sql_danhmuc="select ten,id_list from table_product where id='".$vsp."'";
	            $result=mysql_query($sql_danhmuc);
	            $item_danhmuc =mysql_fetch_array($result);

	            $sql_list="select ten from table_product_list where id='".$item_danhmuc['id_list']."'";
	            $result_l=mysql_query($sql_list);
	            $item_list =mysql_fetch_array($result_l);
	            echo @$item_list['ten'].' '.@$item_danhmuc['ten']."<br>";
			}
          
        ?>
    	</td>
		<td style="width:15%;">
       
       <img src="<?=_upload_sanpham.$items[$i]['photo']?>" width="50" />
        
        </td>
       <td style="width:10%;">
      <a href="index.php?com=mausac1&act=default&amp;id_product=<?=$items[$i]['id']?>" style="text-decoration:none;" class="view-pic">
			<?php echo "Thêm hình";?>     
      </a>
         </td>  
        
		

		<td style="width:5%;"><?php 
		if(@$items[$i]['hienthi']==1)
		{
		?>
      <a href="index.php?com=quangcao1&act=man_photo<?php $ur=""; 
		if($_REQUEST['id_cat']!='') $ur.="&id_cat=".$_REQUEST['id_cat'];echo $ur;?><?php $ur=""; 
		if($_REQUEST['id_list']!='') $ur.="&id_list=".$_REQUEST['id_list'];echo $ur;?><?php $ur=""; 
		if($_REQUEST['id_item']!='') $ur.="&id_item=".$_REQUEST['id_item'];echo $ur;?>&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_1.png" border="0" /></a>
      <? 
		}
		else
		{
		?>
      <a href="index.php?com=quangcao1&act=man_photo<?php $ur=""; 
		if($_REQUEST['id_cat']!='') $ur.="&id_cat=".$_REQUEST['id_cat'];echo $ur;?><?php $ur=""; 
		if($_REQUEST['id_list']!='') $ur.="&id_list=".$_REQUEST['id_list'];echo $ur;?><?php $ur=""; 
		if($_REQUEST['id_item']!='') $ur.="&id_item=".$_REQUEST['id_item'];echo $ur;?>&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_0.png"  border="0"/></a>
      <?php
		 }?></td>

		<td style="width:5%;"><a href="index.php?com=quangcao1&act=edit_photo&id=<?=$items[$i]['id']?>&id_cat=<?=$items[$i]['id_cat']?>&id_list=<?=$items[$i]['id_list']?>&id_item=<?=$items[$i]['id_item']?>"><img src="media/images/edit.png" border="0" /></a></td>
		<td style="width:5%;"><a href="index.php?com=quangcao1&act=delete_photo&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>
<a href="index.php?com=quangcao1&act=add_photo"><img src="media/images/add.jpg" border="0"  /></a>
<a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>
<div class="paging"><?=$paging['paging']?></div>