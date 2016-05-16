<div class="title"> 
    <div style="float:left;font-size:20px;font-weight:bold;text-transform:uppercase;color:#7d7d7d;border-bottom:3px solid #dc241a;">
    <img src="images/ico8.png" alt="gt" style="vertical-align: middle;margin-right: 10px;">Sản phẩm khuyến mãi</div>
   
</div>
<div class="clear"></div>

<?php if(count($result_product)>0){ ?>
<?php $pro = $result_product; for($i=0;$i<count($result_product);$i++){ ?>
<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xxs_n">
<div class="row">
 <div class="sp"> 
    <div class="sp_img" >
    <div class="sp_img_l" >
    <a href="san-pham/<?=$pro[$i]['tenkhongdau']?>/<?=$pro[$i]['id']?>.html">
    <img class="soihinh" alt="<?=$pro[$i]['ten']?>" src="<?=_upload_sanpham_l.$pro[$i]['photo']?>" style="height:258px;width:284px;vertical-align: middle;" /></a>
    <a href="san-pham/<?=$pro[$i]['tenkhongdau']?>/<?=$pro[$i]['id']?>.html">
    <img src="images/chitiet.png" alt="icon" style="position: absolute;bottom: 0;"></a>
    </div>
    </div>
    <div class="sp_info">
        <div class="sp_ten">
            <h4><a href="san-pham/<?=$pro[$i]['tenkhongdau']?>/<?=$pro[$i]['id']?>.html"><?=catchuoi($pro[$i]['ten'],35)?></a></h4>
        </div>
        <div style="padding-left:10px;">
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
         
        </div>
        
    </div>
  </div>
</div>
</div>
<? }?>
 <div class="phantrang"><?=$paging['paging']?></div>
 <?php } else{?>
    <div style="font-size:14px;color:#969696;font-weight:bold; text-align:center; margin:10px;" > Sản phẩm đang cập nhật</div><br />
<?php  } ?>