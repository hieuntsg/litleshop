<!-- CSS -->
        <link rel="stylesheet" href="css/fancybox/jquery.fancybox-buttons.css">
        <link rel="stylesheet" href="css/fancybox/jquery.fancybox-thumbs.css">
        <link rel="stylesheet" href="css/fancybox/jquery.fancybox.css">
        
        
	<!-- FancyBox -->
		<script src="js/fancybox/jquery.fancybox.js"></script>
		<script src="js/fancybox/jquery.fancybox-buttons.js"></script>
		<script src="js/fancybox/jquery.fancybox-thumbs.js"></script>
        <script src="js/fancybox/jquery.easing-1.3.pack.js"></script>
		<script src="js/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>
        

        

        
        <script type="text/javascript">
        	$(document).ready(function() {
				$(".various").fancybox({
					maxWidth	: 800,
					maxHeight	: 600,
					fitToView	: true,
					width		: '70%',
					height		: '70%',
					autoSize	: false,
					closeClick	: false,
					openEffect	: 'elastic',
					closeEffect	: 'none'
				});
			});
		</script>


<div class="plock_main">
				<div class="tilel title_conten"><span>Video</span></div>
					<div class="content_document">
                    	<?php
						for($i=0;$i<count($result_video);$i++)
						{
							$linkyou=explode('v=',$result_video[$i]['mota']);
						?>						<div class="video">
                        	 <a class="various fancybox.iframe" href="http://www.youtube.com/embed/<?=$linkyou[1]?>?autoplay=1">
                             <img src="<?=_upload_hinhanh_l.$result_video[$i]['photo']?>" />
                            </a>
                            <a class="video_name various fancybox.iframe" href="http://www.youtube.com/embed/<?=$linkyou[1]?>?autoplay=1"><?=$result_video[$i]['ten']?></a>
                        </div>
                        <? }?>
                      

                     </div>
			</div>