<?php
	$d->reset();
	$sql="select * from #_yahoo where hienthi=1 order by stt, id desc";
	$d->query($sql);
	$result_yahoo=$d->result_array();
	
	$d->reset();
	$sql="select * from #_alpum where hienthi=1 order by stt, id desc";
	$d->query($sql);
	$alpum=$d->result_array();
?>
<div class="danhmuc">hotline</div>
	<div style="margin:10px 0 0 10px;">
     <?php for($i=0;$i<count($result_yahoo);$i++){?>         <a href="ymsgr:sendIM?<?=$result_yahoo[$i]['yahoo']?>">
    <img src="http://opi.yahoo.com/online?u=<?=$result_yahoo[$i]['yahoo']?>&amp;m=g&amp;t=2" title="<?=$result_yahoo[$i]['ten']?>" alt="Text" width="100"/>
         </a> 
         
         <div style="margin-top:5px; color:#F00;"><?=$result_yahoo[$i]['dienthoai']?> &nbsp; <?=$result_yahoo[$i]['ten']?></div>
        
         <br/>
     <? } ?>
     </div>
<div class="danhmuc">facebook</div>
	<div style="margin:5px 0">
		<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like-box" data-href="https://www.facebook.com/pages/Inoxmanhhung/1427403860867187?ref=hl" data-width="200" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>

        
        
    </div>
<div class="danhmuc">thành phẩm đối tác</div>
	<div style="width:200px; height:400px;margin:5px 0;">   
		<ul class="scroller">	        
    		<!--<li><img src="images/0185944362071230.jpg"border="0" width="202" height="130" /></li>
    		<li><img src="images/0185944362071231.jpg"border="0" width="202" height="130"  /></li>  -->
        	<?php for($i=0;$i<count($alpum);$i++){?>
        	<li><img src="<?=_upload_tintuc_l.$alpum[$i]['photo']?>" width="200px" height="146px" title="<?=$alpum[$i]['ten']?>" /></li>
       	 	<? } ?>
		</ul> 
    </div>