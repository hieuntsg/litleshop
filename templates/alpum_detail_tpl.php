
	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="js/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="js/jquery.fancybox.css" media="screen" />
	<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();

	});
	</script>

<div class="left">
	<div class="content_left">
		<h1 class="class_h1">Abum hình ảnh</h1>
			<?php
			for($i=0;$i<count($result_detail);$i++)
			{
			?>
			<div class="thuvien_detail">
		
			<a  class="fancybox" href="<?=_upload_hinhanh_l.$result_detail[$i]['photo']?>" data-fancybox-group="gallery" title="<?=$result_detail[0]['ten']?>"><img  src="<?=_upload_hinhanh_l.$result_detail[$i]['photo']?>" width="250"/></a>
			</div>
			<? }?>		<div class="clear"></div>
	</div>

</div>