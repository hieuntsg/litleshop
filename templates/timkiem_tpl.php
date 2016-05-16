<div class="title"> 
	<div style="float:left;font-size:20px;font-weight:bold;text-transform:uppercase;color:#7d7d7d;border-bottom:3px solid #dc241a;"><img src="images/ico8.png" alt="gt" style="vertical-align: middle;margin-right: 10px;">tìm kiếm</div>
</div>
<div class="clear"></div>
<?php if($tk){ $pro=$tk; ?><?php for($i=0;$i<count($tk);$i++){?>
 
 <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xxs_n" align="center">
<div class="row">
 <div class="sp"> 
    <div class="sp_img" >
    <div class="sp_img_l" >
    <a class="fancybox fancybox.iframe" href="popup/popup.php?c=<?=$id_spcat?>&i=<?=$pro[$i]['id']?>">
    <img class="soihinh" alt="<?=$pro[$i]['ten']?>" src="<?=_upload_sanpham_l.$pro[$i]['thumb']?>" style="width:248px;height:340px;vertical-align: middle;" /></a>
    <a class="fancybox fancybox.iframe" href="popup/popup.php?i=<?=$pro[$i]['id']?>">
    <img src="images/chitiet.png" alt="icon" style="position: absolute;bottom: 0px;left: 0px;"></a>
    </div>
    <?php if($pro[$i]['banchay'] > 0){ ?>
    <img src="images/new_icon.gif" alt="icon" style="position: absolute;top:0px;left:0px;">
    <?php } ?>
    </div>
<?php 
    /*$idarr = $pro[$i]['id_product'];
    $a = rtrim($idarr,',');
    $tachid = explode(',',$a);*/
    //echo count($tachid);
?>    
    <div class="sp_info">
  
        <div style="width: 100%;clear: both;">
            <div class="sp_ten">
                <h4 style="margin: 0px;"><a><?=/*$result_list['ten'].' '.*/$pro[$i]['ten']?></a></h4>
            </div>
            
            <div class="sp_gia">
           
             <?php
                if(empty($_SESSION['mem_login']['mem_mail'])){
            ?>
            <a class="xemgia" style="cursor: pointer;color:#dc241a;"><?='Xem giá';?></a>
            <?php }else {?>
                <?=doitien($pro[$i]['gia'])?>
            <?php } ?> 
            </div>
        </div> <!-- #### -->

    </div>
  </div>
</div>
</div>
<?php } } else{?>
<div style="text-align:center"><b style="color:#969696; font-size: 12px;">Không tìm thấy sản phẩm nào.</b></div>
<? }?>
<div class="phantrang">
  <?=$paging['paging']?>
</div>
