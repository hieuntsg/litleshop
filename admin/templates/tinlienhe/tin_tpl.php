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
	if (hoi==true) document.location = "index.php?com=tinlienhe&act=delete&listid=" + listid;
});
});
</script>

<table class="blue_table">

	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th width="5%" style="width:5%;">Tên</th>
		<th width="15%" style="width:15%;">Tiêu đề</th>
		<!--<th style="width:40%;">Danh mục</th>-->
        <th style="width:40%;">Nội dung </th>
	  <th width="10%" style="width:10%;">Điện thoại</th>
		<th width="10%" style="width:10%;">Email</th>
		<th width="12%" style="width:12%;">Địa chỉ</th>
		<th width="4%" style="width:4%;">Xóa</th>
	</tr>
    
	<?php 
	
	$items_lienhe = $items;
	//echo count($items_lienhe);

	for($i=0; $i< count($items_lienhe);$i++){
	?>
	<tr>
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items_lienhe[$i]['id']?>" class="chon" /></td>
        <td style="width:5%;" align="center"><?=$items_lienhe[$i]['ten']?></td>
		<td style="width:15%;" align="center"><?= $items_lienhe[$i]['tieude']?></td>
		
		<!-- <td style="width:3%;" align="center">
		 	<?php
				/*$sql_danhmuc="select ten from table_news_item where id='".$items_lienhe[$i]['id_item']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten']*/
			?>    
		 
		 </td>-->
        
		<td style="width:40%;" align="center"><?=$items_lienhe[$i]['noidung']?></td>
		<td style="width:10%;" align="center"><?= $items_lienhe[$i]['dienthoai']?></td>
		<td style="width:10%;" align="center"><?= $items_lienhe[$i]['email']?></td>
		<td style="width:12%;" align="center"><?= $items_lienhe[$i]['diachi']?></td>
	<td style="width:4%;"><a href="index.php?com=tinlienhe&act=delete&id=<?=$items_lienhe[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>
<!-- <a href="index.php?com=tinlienhe&act=add"><img src="media/images/add.jpg" border="0"  /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --><a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>

<div class="paging"><?=$paging['paging']?></div>