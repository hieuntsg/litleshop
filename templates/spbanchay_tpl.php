<div class="title"> 
	<div style="float:left;font-size:20px;font-weight:bold;text-transform:uppercase;color:#7d7d7d;border-bottom:3px solid #dc241a;">sản phẩm mới</div>
    
</div>
<div class="clear"></div>
<?php
	$d->reset();
	$sql_sp1="select * from #_product where hienthi=1 and banchay <> 0 order by stt, id ";
	$d->query($sql_sp1);
	$pro=$d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=15;
	$maxP=5;
	$paging=paging_home($pro, $url, $curPage, $maxR, $maxP);
	$pro=$paging['source'];
	
?><?php if(count($pro)>0){ ?>
<?php for($i=0;$i<count($pro);$i++){?>


<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xxs_n">
<div class="row">
 <div class="sp"> 
    <div class="sp_img" >
    <div class="sp_img_l" >
    <a href="san-pham/<?=$pro[$i]['tenkhongdau']?>/<?=$pro[$i]['id']?>.html">
    <img alt="<?=$pro[$i]['ten']?>" src="<?=_upload_sanpham_l.$pro[$i]['photo']?>" style="max-height:205px;max-width:288px;vertical-align: middle;" onmouseover="doTooltip(event, &#39; <?=_upload_sanpham_l.$pro[$i]['photo']?> &#39;)" onmouseout="hideTip()"/></a>
    </div>
    </div>
    <div class="sp_info">
        <div class="sp_ten">
        	<h4><a href="san-pham/<?=$pro[$i]['tenkhongdau']?>/<?=$pro[$i]['id']?>.html"><?=catchuoi($pro[$i]['ten'],40)?></a></h4>
        </div>
        <div style="padding:5px;">
        	<div class="sp_gia">
            <?php 
			if($pro[$i]['gia']=='' || $pro[$i]['gia']==0){
				echo  "Liên hệ" ;
			} 
			else 
			{ 
				echo doitien($pro[$i]['gia']) ;
			} ?>
            </div>
            <div class="sp_gia1"> <? if($pro[$i]['gia2']<>0) {?><?=doitien($pro[$i]['gia2'])?><? } ?></div>
            <div class="sp_chitiet"> <a href="san-pham/<?=$pro[$i]['tenkhongdau']?>/<?=$pro[$i]['id']?>.html"> Chi tiết</a></div>
    	</div>
    	
    </div>
  </div>
</div>
</div>

<? } ?>
 <div class="phantrang"><?=$paging['paging']?></div>
 <?php } else{?>
 	<div style="font-size:14px;color:#969696;font-weight:bold; text-align:center; margin:10px;" > Sản phẩm đang cập nhật</div><br />
<?php  }  ?>
