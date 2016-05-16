<div class="title"> 
  <div style="float:left;font-size:20px;font-weight:bold;text-transform:uppercase;color:#7d7d7d;border-bottom:3px solid #dc241a;">
  <img src="images/ico4.png" alt="gt" style="vertical-align: middle;margin-right: 10px;"><?=$tintuc_detail[0]['ten']?></div>
    
</div>
 <div style="border: 1px solid #d0d0d0;padding: 10px;min-height: 100px;width:100%;overflow: hidden;">
<!-- <div style="margin:10px;border:3px #999999 solid;float:left;"> <img class="img_nn" src="<?=_upload_tintuc_l.$tintuc_detail[0]['photo']?>" width="200" height="200"/> </div>

<div style="padding-top:10px;color:#0166ac;font-size:16px;text-transform:uppercase;">
  <?=$tintuc_detail[0]['ten']?>
</div> -->
<div>
  <?=$tintuc_detail[0]['mota']?>
</div>
<div class="clear"></div>
<div class="img_v" style="margin:10px;">
  <?=$tintuc_detail[0]['noidung']?>
</div>
<div>
  
  <div style="border-bottom:1px #999999 dashed;padding-top:10px;width:70%;margin:0 auto;"></div>
    <h1 style="color:#03F;font-size:16px;font-weight:bold;text-transform:uppercase;margin:10px 0 10px 10px;"> Các bài khác</h1>
  <ul class="list_item_order" style="line-height:25px;">
    <?php foreach($tintuc_khac as $tinkhac){?>
    <li style="background:url(images/faq2.gif) 5px 3px no-repeat; padding-left:15px;"> <a href="tin-tuc/<?=$tinkhac['tenkhongdau']?>/<?=$tinkhac['id']?>.html" style="text-decoration:none;" title="<?=htmlentities($tinkhac['ten'], ENT_QUOTES, "UTF-8")?>">
     &raquo; <?=$tinkhac['ten']?>
      </a><span style="color:#999" > (<?=make_date($tinkhac['ngaytao'])?>)</span>
      </li>
    <?php }?>
  </ul>
</div>
</div>
