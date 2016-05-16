<div class="tcat">Hình ảnh</div>
   <div class="content">
               	         
             <?php
			   if(count($tintuc)>0){
			   for($i=0,$count_tintuc=count($tintuc);$i<$count_tintuc;$i++){
		   ?>            <div class="box_new">
            	<div class="image_boder"><a href="hinh-anh/<?=$tintuc[$i]['tenkhongdau']?>/<?=$tintuc[$i]['id']?>.html" title="<?=htmlentities($tintuc[$i]['ten'], ENT_QUOTES, "UTF-8")?>"><img src="<?php if($tintuc[$i]['photo']!=NULL) echo _upload_tintuc_l.$tintuc[$i]['photo']; else echo 'images/noimage.gif';?>" onerror="this.src='images/noimage.gif';" width="120" height="80" title="<?=htmlentities($tintuc[$i]['ten'], ENT_QUOTES, "UTF-8")?>" alt="<?=htmlentities($tintuc[$i]['ten'], ENT_QUOTES, "UTF-8")?>"/></a></div>
               <h1> <a href="hinh-anh/<?=$tintuc[$i]['tenkhongdau']?>/<?=$tintuc[$i]['id']?>.html" title="<?=htmlentities($tintuc[$i]['ten'], ENT_QUOTES, "UTF-8")?>"><?=$tintuc[$i]['ten']?></a></h1> <?=$tintuc[$i]['mota']?> 
                        
              <div class="clear"></div>
              <div style="text-align:right"><a style="text-decoration:underline" href="hinh-anh/<?=$tintuc[$i]['tenkhongdau']?>/<?=$tintuc[$i]['id']?>.html">Xem thêm</a></div>
            </div>
            <?php } }else echo '<p>Nội dung đang cập nhật, bạn vui lòng xem các chuyên mục khác.</p>';  ?>                                     
            <div class="phantrang" ><?=$paging['paging']?></div>
            </div> 