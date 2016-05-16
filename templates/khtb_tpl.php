<style type="text/css">
.tt_ten {
	padding-top: 10px;
	font-size: 14px;
	font-weight: bold;
	text-transform: uppercase;
}
.tt_ten a {
	color: #03F;
}
.tt_mota {
	min-height: 75px;
}
</style>

<div style="margin-right:10px;">
<div class="title"> 
	<div style="float:left;font-size:20px;font-weight:bold;text-transform:uppercase;color:#7d7d7d;border-bottom:3px solid #dc241a;"><img src="images/ico4.png" alt="gt" style="vertical-align: middle;margin-right: 10px;">thắc mắc và hướng dẫn</div>
</div>
<div class="clear"></div>
  <div style="border: 1px solid #d0d0d0;padding: 10px;min-height: 100px;width:100%;overflow: hidden;">
  
      <?php
	  
				for($i=0;$i<count($result_source);$i++)
				{
			?>      
      <div style="border-bottom: 1px dotted #d0d0d0;width:100%;min-height: 50px;overflow: hidden;">
        <div style="float:left;margin:10px;border:2px #999999 solid;">
        	<img src="<?=_upload_tintuc_l.$result_source[$i]['photo']?>" width="100" height="100"/>
        </div>
        <div style="float: left;width: 85%;">
        <h2  class="tt_ten"><a href="thac-mac-va-huong-dan/<?=$result_source[$i]['tenkhongdau']?>/<?=$result_source[$i]['id']?>.html" title="">
          <?=$result_source[$i]['ten']?>
          </a></h2>
       <div class="tt_mota">
        <?=$result_source[$i]['mota']?>
        <div class="clear"></div>
        <div style="float: right;margin-top: 10px;">
        <a href="thac-mac-va-huong-dan/<?=$result_source[$i]['tenkhongdau']?>/<?=$result_source[$i]['id']?>.html" style="color:#fff;background: #0166ac;padding: 5px 10px;">Xem tiếp ...</a>
        </div>
        </div>
        
        </div>
      </div>
      <? }?>
    
  </div>
</div>
<div class="phantrang"><?=$paging['paging']?></div>