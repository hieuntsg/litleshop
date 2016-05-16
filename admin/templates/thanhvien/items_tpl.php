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
	if (hoi==true) document.location = "index.php?com=thanhvien&act=delete&listid=" + listid;
});
});
</script>

<script language="javascript">	
	function select_onchange()
	{	
		var b=document.getElementById("id_cat");
		window.location ="index.php?com=thanhvien&act=man&id_cat="+b.value;	
		return true;
	}
	
</script>
<?php function get_main_category()
	{
		$sql="select * from table_news_item order by stt asc,id desc";
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
<h3>Quản lý thành viên</h3>	
<table class="blue_table">

	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th width="5%" style="width:6%;">Stt</th>
		<th width="5%" style="width:10%;">Họ tên</th>
		<th width="5%" style="width:10%;">Email</th>
		<th width="5%" style="width:10%;">Ngày đăng kí</th>
		<!--<th width="5%" style="width:10%;">Ngày đăng nhập gần đây</th>-->
		<th width="5%" style="width:10%;">Đơn hàng / Tổng giá trị</th>
		<!--<th style="width:40%;">Danh mục</th>-->
		<!--
        <th style="width:10%;">Lệ phí hiệu lực</th>
		 <th style="width:10%;">Ngày đóng phí</th>
		<th style="width:10%;">Thời hạn xem</th>
		<th style="width:10%;">Lệ phí từng dùng</th>
		<th style="width:10%;">Thành viên vip</th> -->
		 <!--  <th width="9%" style="width:6%;">Trả lời bình luận</th> -->
		<th width="9%" style="width:6%;">Khóa tài khoản</th>
		<th width="9%" style="width:6%;">Xem thông tin</th>
		<th width="9%" style="width:6%;">Xóa</th>
	</tr>
    
	<?php for($i=0;$i<count($items); $i++){?>
	<tr>
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        <td style="width:6%;" align="center"><?=$items[$i]['id']?></td>
		<td style="width:10%;" align="center"><a href="index.php?com=thanhvien&act=edit&id=<?=$items[$i]['id']?>"><?=$items[$i]['hoten']?></a></td>
		<td style="width:10%;" align="center"><?=$items[$i]['email']?></td>
		<!-- <td style="width:3%;" align="center">
		 	<?php
				/*$sql_danhmuc="select ten from table_news_item where id='".$items[$i]['id_item']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten']*/
			?>    
		 
		 </td>-->
        
		<td style="width:10%;" align="center"><?=make_date($items[$i]['ngaydangki'])?></td>
		<!--<td style="width:10%;" align="center">Ngay login</td>-->

		<td style="width:10%;" align="center"><font color="#f00">
		 <?php
				
				$sql ="select id,tonggia from table_donhang where iduser = ".$items[$i]['id']."";
				$d->query($sql);
				$result_count = $d->result_array();
				$tongdh = 0;
				foreach ($result_count as $kdh => $vdh) {
					$tongdh = $tongdh + $vdh['tonggia'];
				}
			?>  
		<?=count($result_count)?> / <?=number_format($tongdh,0,',','.')?> đ
		</td>
		<!--
		<td style="width:10%;" align="center"><?=number_format($items[$i]['sotiendong'],0,".",".")?> VNĐ</td>
		<td style="width:10%;" align="center"><?=$items[$i]['ngaydongphi']?></td>
		<td style="width:10%;" align="center"><?php echo($items[$i]['sotiendong']/$result_qdlp[0]['quydinhlephi'])*365?> năm</td>
		<td style="width:10%;" align="center"><?=number_format($items[$i]['sotiendatru'],0,".",".")?> VNĐ</td>
		<?php
			if($result_count2[0]['total'] >= 20000000){
				$d->reset();
				$sql_role="update table_thanhvien set role=4 where id_thanhvien='".$items[$i]['id']."'";
				$d->query($sql_role);	
			}
		if($items[$i]['role']==4){
		?>
		<td style="width:10%;" align="center"><font color="#f00"><img src="media/images/imgVip3.gif"></font></td>
		<? }else{ ?>
			<td style="width:10%;" align="center">0</td>
		<? }?>
		 -->
		<!-- <td style="width:6%;">
		<?php 
		if(@$items[$i]['combinhluan']==0)
		{
		?>       
         <a href="index.php?com=thanhvien&act=man<?php if($_REQUEST['id_cat']!='') echo"&id_cat=".$_REQUEST['id_cat'] ?>&comment=<?=$items[$i]['id']?>"><img src="media/images/active_0.png" border="0" /></a>
        
			
		<? 
		}
		else
		{
		?>
       <a href="index.php?com=thanhvien&act=man<?php if($_REQUEST['id_cat']!='') echo"&id_cat=".$_REQUEST['id_cat'] ?>&comment=<?=$items[$i]['id']?>"><img src="media/images/active_1.png"  border="0"/></a>
         <?php
		 }?>        </td>	 -->	
		
		
        
       
		<td style="width:6%;">
		<?php 
		if(@$items[$i]['khoa']==0)
		{
		?>       
       
        <a href="index.php?com=thanhvien&act=man<?php if($_REQUEST['id_cat']!='') echo"&id_cat=".$_REQUEST['id_cat'] ?>&khoa=<?=$items[$i]['id']?>"><img src="media/images/active_1.png"  border="0"/></a>
			
		<? 
		}
		else
		{
		?>
         <a href="index.php?com=thanhvien&act=man<?php if($_REQUEST['id_cat']!='') echo"&id_cat=".$_REQUEST['id_cat'] ?>&khoa=<?=$items[$i]['id']?>"><img src="media/images/active_0.png" border="0" /></a>
         <?php
		 }?>        </td>
		

		 
		<td style="width:5%;"><a href="index.php?com=thanhvien&act=edit&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png" border="0" /></a></td>
		<td style="width:6%;"><a href="index.php?com=thanhvien&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>


<div class="paging"><?=$paging['paging']?></div>