<div class="left">
	<div class="content_left">
		<h1 class="class_h1">Abum hình ảnh</h1>
			<?php
			for($i=0;$i<count($result_hinhanh);$i++)
			{
			?>
			<div class="thuvien">
			<img  src="<?=_upload_tintuc_l.$result_hinhanh[$i]['photo']?>"  />
			<a href="album/<?=$result_hinhanh[$i]['tenkhongdau']?>/<?=$result_hinhanh[$i]['id']?>.html"><?=$result_hinhanh[$i]['ten']?></a>
			</div>
			<? }?>		<div class="clear"></div>
	</div>

</div>