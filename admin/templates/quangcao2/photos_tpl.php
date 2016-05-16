<!--<h3>Thêm hình ảnh(rộng: 130px x cao:550px)</h3>-->

<table class="blue_table">
	<tr>
		<th style="width:5%;">Stt</th>		
        <th style="width:50%;">Hình ảnh</th>
        <!--<th style="width:50%;">Vị Trí</th>-->
      	<th style="width:5%;">Hiển thị</th>
		<th style="width:5%;">Sửa</th>
	</tr>
	<?php for($i=0, $count=1; $i<$count; $i++){?>
	<tr>
		<td style="width:5%;"><?=$items[$i]['stt']?></td>          
		<td style="width:30%;"><img src="<?=_upload_hinhanh.$items[$i]['photo']?>" width="100"  /></td>
   		<!--<td style="width:30%;"><?php if($items[$i]['vitri']==0) echo"trái"; elseif($items[$i]['vitri']==1) echo"phải";?></td>-->
       
        
		<td style="width:5%;"><?php if(@$items[$i]['hienthi']){?><img src="media/images/active_1.png" /><? }else {?><img src="media/images/active_0.png" /><? }?></td>
		<td style="width:5%;"><a href="index.php?com=quangcao2&act=edit_photo&id=<?=$items[$i]['id']?>&idc=<?=$items[$i]['id_photo']?>"><img src="media/images/edit.png" border="0" /></a></td>
		
	</tr>
	<?php	}?>
</table>
<div class="paging"><?=$paging['paging']?></div>