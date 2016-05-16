</script>
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
	if (hoi==true) document.location = "index.php?com=danhgiasp&act=delete&listid=" + listid;
});
});
</script>

<h3> Đánh giá sản phẩm</h3>
Sản phẩm &nbsp;
<?=get_sp()?>


<script language="javascript">	
	function select_onchange()
	{	
		var b=document.getElementById("id");
		//alert (b.value);
		window.location ="index.php?com=danhgiasp&act=man&id_sp="+b.value;	
		return true;
	}
	

</script>
<?php

	function get_sp()
	{
		$sql="select * from table_product order by stt asc,id desc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id" name="id" onchange="select_onchange()" class="main_font">
			<option>Chọn sản phẩm</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}	
	
	
?>
<table class="blue_table">
  <tr>
    <th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
    <th style="width:5%;">Stt</th>
  	<th style="width:5%;">Id_sp</th>
    <th style="width:25%;"> Họ Tên </th>
    <th style="width:10%;">Điện thoại</th>
    <th style="width:25%;">Email</th>
    <th style="width:25%;">Nội dung</th>
    <th style="width:5%;">Hiển thị</th>
    <th style="width:5%;">Sửa</th>
    <th style="width:5%;">Xóa</th>
  </tr>
  <?php for($i=0, $count=count($items); $i<$count; $i++){?>
  <tr>
    <td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
    <td style="width:5%;"><?=$items[$i]['id']?></td>
    <td style="width:5%;"><?=$items[$i]['id_sp']?></td>
    <td style="width:25%;"><?=$items[$i]['hoten']?></td>
     <td style="width:10%;"><?=$items[$i]['dienthoai']?></td>
    <td style="width:25%;"><?=$items[$i]['email']?></td>
    <td style="width:25%;"><?=catchuoi($items[$i]['noidung'],20)?></td> 
  
        
        
    <td style="width:5%;"><?php 
		if(@$items[$i]['hienthi']==1)
		{
		?>
      <a href="index.php?com=danhgiasp&act=man<?php $ur=""; if($_REQUEST['id_cat']!=''){
			$ur="&id_cat=".$_REQUEST['id_cat'];
		if($_REQUEST['id_list']!='') $ur.="&id_list=".$_REQUEST['id_list'];} echo $ur;?>&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_1.png" border="0" /></a>
      <? 
		}
		else
		{
		?>
      <a href="index.php?com=danhgiasp&act=man<?php $ur=""; if($_REQUEST['id_cat']!=''){
			$ur="&id_cat=".$_REQUEST['id_cat'];
		if($_REQUEST['id_list']!='') $ur.="&id_list=".$_REQUEST['id_list'];} echo $ur;?>&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_0.png"  border="0"/></a>
      <?php
		 }?></td>
         
         
         
         
    <td style="width:5%;">
    	<a href="index.php?com=danhgiasp&act=edit&id=<?=$items[$i]['id']?>">
    		<img src="media/images/edit.png" />
        </a>
    </td>
    
    
    <td style="width:5%;"><a href="index.php?com=danhgiasp&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" /></a></td>
  </tr>
  <?php	}?>
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>
<div class="paging">
  <?=$paging['paging']?>
</div>
