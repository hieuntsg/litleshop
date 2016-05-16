<h3><a href="index.php?com=lkweb&act=add">Thêm mới liên kết</a></h3>

<table class="blue_table">
	<tr>
		<th style="width:6%;">Stt</th>
		<th width="5%" style="width:6%;">Hình ảnh</th>
		<th style="width:38%;">Tên</th>
        <th style="width:38%;">Link</th>
		<th style="width:6%;">Hiển thị</th>
		<th style="width:6%;">Sửa</th>
		<th style="width:6%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:6%;"><?=$items[$i]['stt']?></td>
		<td style="width:6%;" align="center"><img src="<?=_upload_hinhanh.$items[$i]['image']?>"  height="50"/></td>
        <td style="width:38%;"><?=$items[$i]['ten']?></td>
		<td style="width:38%;">
		<?=$items[$i]['url']?>
        </a>
        </td>
		<td style="width:6%;"><?php if(@$items[$i]['hienthi']){?><img src="media/images/active_1.png" /><? }?></td>
		<td style="width:6%;"><a href="index.php?com=lkweb&act=edit&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png" /></a></td>
		<td style="width:6%;"><a href="index.php?com=lkweb&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" /></a></td>
	</tr>
	<?php	}?>
</table>
<div class="paging"><?=$paging['paging']?></div>