
<div class="plock_main">
				<div class="tilel title_conten"><span>Dịch vụ</span></div>
					<div class="content_document">
						 <?=$tintuc_detail[0]['noidung']?>  
			
			
			<div class="othernews">
           <h1>Các bài khác</h1>
           <ul>
           
<?php foreach($tintuc_khac as $tinkhac){?>
<li><a href="gioi-thieu/<?=$tinkhac['tenkhongdau']?>/<?=$tinkhac['id']?>.html" style="text-decoration:none;" title="<?=htmlentities($tinkhac['ten'], ENT_QUOTES, "UTF-8")?>"><?=$tinkhac['ten']?></a> (<?=make_date($tinkhac['ngaytao'])?>)</li>
<?php }?>
     </ul>
</div>
                     </div>
			</div>
