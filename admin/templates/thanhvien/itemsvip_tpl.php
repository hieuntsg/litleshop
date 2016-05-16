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
<h3></h3>
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
<table class="blue_table">

	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th width="5%" style="width:6%;">Stt</th>
		<th width="5%" style="width:10%;">Họ tên</th>
		<th width="5%" style="width:10%;">Mã đăng nhập</th>
		<th width="5%" style="width:10%;">Email</th>
		<th width="5%" style="width:10%;">Ngày đăng kí</th>
		<th width="5%" style="width:10%;">Loại phí</th>
	
		<!--<th style="width:40%;">Danh mục</th>-->
        <th style="width:10%;">Lệ phí hiệu lực</th>
		 <th style="width:10%;">Ngày đóng phí</th>
		<th style="width:10%;">Thời hạn xem</th>
		<th style="width:10%;">Lệ phí từng dùng</th>
		<th style="width:10%;">Thành viên vip</th>
	  <th width="9%" style="width:6%;">Khóa</th>
		<th width="9%" style="width:6%;">Sửa</th>
		<th width="9%" style="width:6%;">Xóa</th>
	</tr>
    
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        <td style="width:6%;" align="center"><?=$items[$i]['id']?></td>
		<td style="width:10%;" align="center"><a href="index.php?com=thanhvien&act=editvip&id=<?=$items[$i]['id']?>"><?=$items[$i]['firstname']." ".$items[$i]['lastname']?></a></td>
		<td style="width:10%;" align="center">
		
		<a href="index.php?com=thanhvien&act=codelogin&id=<?=$items[$i]['id']?>">
		<?php
			if(!empty($items[$i]['madangnhap'])){
		?>
		<?=$items[$i]['madangnhap']?>
		<? }else{?>
			Chưa có
		<? }?>
		</a>
		
		</td>
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
		<?php
			if($items[$i]['id_banggianam']<>0){
			$d->reset();
			$sql_phi="select * from table_banggianam where id='".$items[$i]['id_banggianam']."'";
			$d->query($sql_phi);
			$result_phi=$d->result_array();
			
			
		?>
		<td style="width:10%;" align="center"><a href="index.php?com=thanhvien&act=editphi&id=<?=$items[$i]['id']?>"><?=$result_phi[0]['nam']?> năm đóng <?=$result_phi[0]['tien']?> VNĐ </a></td>
		<? }else{?>
			<td style="width:10%;" align="center"><a href="index.php?com=thanhvien&act=editphi&id=<?=$items[$i]['id']?>">Chưa chọn mức phí</a></td>
		<? }?>
		<?php
			$d->reset();
			$sql_qdlp="select quydinhlephi from table_user";
			$d->query($sql_qdlp);
			$result_qdlp=$d->result_array();

			
			$d->reset();
			$sql_count="select count(*) as dem from table_cart where id_thanhvien='".$items[$i]['id']."'";
			$d->query($sql_count);
			$result_count=$d->result_array();
			
			$d->reset();
			$sql_count2="select trangthaigiaohang,id,total from table_cart where trangthaigiaohang > '0' and id_thanhvien='".$items[$i]['id']."'";
			$d->query($sql_count2);
			$result_count2=$d->result_array();
			$total_cart=count($result_count2);
			
			
		?>
	
		<td style="width:10%;" align="center"><?=number_format($items[$i]['sotiendong'],0,".",".")?> VNĐ</td>
		<td style="width:10%;" align="center"><?=$items[$i]['ngaydongphi']?></td>
		<td style="width:10%;" align="center"><?php 
		if($items[$i]['id_banggianam'] != 0){
			$d->reset();
			$sql_banggianam="select * from table_banggianam where id='".$items[$i]['id_banggianam']."'";
			$d->query($sql_banggianam);
			$result_banggianam=$d->result_array();
			
			$d->reset();
			$sql_date="select DATE_ADD(ngaydongphi, INTERVAL ".$result_banggianam[0]['nam']." YEAR) as ngay from table_thanhvien where id= '".$items[$i]['id']."'";
			$d->query($sql_date);
			$result_date=	$d->result_array();
			
			$d->reset();
			$sql_thoihan="update table_thanhvien set thoihanxem='".$result_date[0]['ngay']."' where id='".$items[$i]['id']."'";
			$d->query($sql_thoihan);
			if($items[$i]['thoihanxem']!='0000-00-00'){
				if(strtotime($items[$i]['thoihanxem']) < strtotime(date("Y-m-d"))){
		
					$d->reset();
				$sql_khoa="update table_thanhvien set khoa='1' where id='".$items[$i]['id']."'";
				$d->query($sql_khoa);
				}
			}
						
		
		?> <?=$result_date[0]['ngay']?>
		<? } 	?>
		
		</td>
		<td style="width:10%;" align="center">0</td>
		<?php
	
				$d->reset();
				$sql_vip="select * from table_thanhvien where id='".$items[$i]['id']."'";
				$d->query($sql_vip);	
				$result_vip=$d->result_array();

		if($result_vip[0]['comvip']!=""){
		?>
		<td style="width:10%;" align="center"><a href="index.php?com=thanhvien&act=editvip&id=<?=$items[$i]['id']?>"> Có </a></td>
		<? }else{ ?>
			<td style="width:10%;" align="center"><a href="index.php?com=thanhvien&act=editvip&id=<?=$items[$i]['id']?>"> Không </a></td>
		<? }?>
		<td style="width:6%;">
        
        
		
		<?php 
		if(@$items[$i]['khoa']==0)
		{
		?>       
       
        <a href="index.php?com=thanhvien&act=editvip&id=<?=$items[$i]['id']?>"><img src="media/images/active_1.png"  border="0"/></a>
			
		<? 
		}
		else
		{
		?>
         <a href="index.php?com=thanhvien&act=editvip&id=<?=$items[$i]['id']?>"><img src="media/images/active_0.png" border="0" /></a>
         <?php
		 }?>        </td>
		<td style="width:5%;"><a href="index.php?com=thanhvien&act=editvip&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png" border="0" /></a></td>
		<td style="width:6%;"><a href="index.php?com=thanhvien&act=deletevip&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>


<div class="paging"><?=$paging['paging']?></div>

