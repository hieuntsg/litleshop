<div class="tcat"><?=$tintuc_detail[0]['ten']?></div>
   <div class="content">             
           <?=$tintuc_detail[0]['noidung']?>           
          <div class="othernews">
           <h1>Các bài khác</h1>
           <ul>
           
<?php foreach($tintuc_khac as $tinkhac){?>
<li><a href="hinh-anh/<?=$tinkhac['tenkhongdau']?>/<?=$tinkhac['id']?>.html" style="text-decoration:none;" title="<?=htmlentities($tinkhac['ten'], ENT_QUOTES, "UTF-8")?>"><?=$tinkhac['ten']?></a> (<?=make_date($tinkhac['ngaytao'])?>)</li>
<?php }?>
     </ul>
</div>
</div>