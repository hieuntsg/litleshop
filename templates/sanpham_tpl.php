<div class="title"> 
	<div style="float:left;font-size:20px;font-weight:bold;text-transform:uppercase;color:#7d7d7d;border-bottom:3px solid #ffae00;"><img src="images/ico2.png" alt="gt" style="vertical-align: middle;margin-right: 10px;"><?=$title_tcat?></div>
</div>
<div class="clear"></div>
<?php if(($_GET['idc'] == 'hang-co-san') || ($_GET['idct'] == 'hang-co-san')){?>

<style type="text/css">
    ul.cccdm{//background:#ccc;//text-align:center;//min-height: 50px;//overflow: hidden;}
    
    ul.cccdm li.licccdm{float:left;background:#ccc;padding:0px 10px;line-height: 50px;border-right:1px solid #fff;position:relative;}
    ul.cccdm li.licccdm:hover{background:#ffae00;}
    ul.subcccdm{position:absolute;display: none;width: 120px;z-index:9999899999;background:#fff;box-shadow:2px 2px 5px #ccc;}
    ul.cccdm li.licccdm:hover ul.subcccdm{display: block;left:0px;}
    li.licon{height: 35px;line-height: 35px;padding-left: 10px;border-bottom: 1px solid #ccc;}
    li.licon:hover{background:#ffae00;}
    li.licon:hover a{color:#fff !important;}
</style>
        <ul class="cccdm">
        <?php 
        $sql = "select * from table_product_list where id_cat = 19 order by stt,id asc";
            $d->query($sql);
            $rowlist = $d->result_array();
        foreach ($rowlist as $kx => $vx) { 
            $sql = "select * from table_product_item where id_list = ".$vx['id']." order by stt,id asc";
            $d->query($sql);
            $rowitem = $d->result_array();
            ?>
            <li class="licccdm"><a href="san-pham/hang-co-san/<?=$vx['tenkhongdau']?>/<?=$vx['id']?>.html"><img style="width: 25px;vertical-align: middle;" src="<?=_upload_sanpham_l.$vx['thumb']?>" alt="<?=$vx['ten']?>"></a>
                <ul class="subcccdm">
                <?php foreach ($rowitem as $kxx=> $vxx) {?>
                    <li class="licon"><a href="san-pham/hang-co-san/<?=$vx['tenkhongdau']?>/<?=$vxx['tenkhongdau']?>/<?=$vxx['id']?>.html" style="color:#000;"><?=$vxx['ten'];?></a></li>
                <?php } ?>    
                </ul>
            </li>

        <?php } ?>
            <li class="licccdm" style="color:#fff;"><a href="san-pham/hang-co-san.html" style="color:#fff">TẤT CẢ &raquo;</a></li>
        </ul>


<?php } ?>

<div class="clear"></div>
<?php if($_GET['idct'] == 'albums' && $_GET['idi'] == ''){ ?>
<div style="width: 100%;margin: 0 auto;border:1px solid #ccc;padding: 15px;overflow: hidden;">
    <?=$loaitin[0]['mota'];?>

    <?php 
    $d->reset();
    $sql_sp="select * from #_product_item where hienthi=1 and id_list = ".$_GET['idl']." order by stt,id desc";
    $d->query($sql_sp);
    $sp_tenlist=$d->result_array();
    foreach ($sp_tenlist as $kt => $vt) { ?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" align="center" style="margin-bottom: 10px;">
        <div style="width: 100%;max-height: 367px;">
            <a href="san-pham/albums/<?=$loaitin[0]['tenkhongdau']?>/<?=$vt['tenkhongdau']?>/<?=$vt['id']?>.html"><img style="height: 322px;max-width: 100%;box-shadow: 4px 4px 7px #515151;" src="<?=_upload_sanpham_l.$vt['photo']?>"  /></a>
                <div class="clear"></div>
                <div style="height: 60px;margin-top: 15px;padding: 10px" align="center">
                    <a style="text-transform: uppercase;font-size: 15px;font-family:opensans_b;color:#222222;" href="san-pham/albums/<?=$loaitin[0]['tenkhongdau']?>/<?=$vt['tenkhongdau']?>/<?=$vt['id']?>.html"><?=$vt['ten']?></a>
                </div>
        </div>
    </div>  
<?php } ?>
</div>
<?php } else {
        if($_GET['idc'] == 'albums' && $_GET['idl']==''){?>
            <?php 
    $d->reset();
    $sql_sp="select * from #_product_item where hienthi=1 and id_cat = 16 order by stt,id desc";
    $d->query($sql_sp);
    $sp_tenlist=$d->result_array();
    foreach ($sp_tenlist as $kt => $vt) { ?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" align="center" style="margin-bottom: 10px;">
        <div style="width: 100%;max-height: 367px;">
            <a href="san-pham/albums/<?=$loaitin[0]['tenkhongdau']?>/<?=$vt['tenkhongdau']?>/<?=$vt['id']?>.html"><img style="height: 322px;max-width: 100%;box-shadow: 4px 4px 7px #515151;" src="<?=_upload_sanpham_l.$vt['photo']?>"  /></a>
                <div class="clear"></div>
                <div style="height: 60px;margin-top: 15px;padding: 10px" align="center">
                    <a style="text-transform: uppercase;font-size: 15px;font-family:opensans_b;color:#222222;" href="san-pham/albums/<?=$loaitin[0]['tenkhongdau']?>/<?=$vt['tenkhongdau']?>/<?=$vt['id']?>.html"><?=$vt['ten']?></a>
                </div>
        </div>
    </div>  
<?php } ?>
     <?php   }else{
    ?>

<?php  if(count($result_product)>0 ){ ?>

<?php $pro = $result_product; for($i=0;$i<count($result_product);$i++){ ?>
<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xxs_n" align="center">
<div class="row">
 <div class="sp"> 
    <div class="sp_img" >
    <div class="sp_img_l" >
    <a class="fancybox fancybox.iframe" href="popup/popup.php?c=<?=$id_spcat?>&i=<?=$result_product[$i]['id']?>">
    <img class="soihinh" alt="<?=$pro[$i]['ten']?>" src="<?=_upload_sanpham_l.$pro[$i]['thumb']?>" style="width:248px;height:340px;vertical-align: middle;" /></a>
    <a class="fancybox fancybox.iframe" href="popup/popup.php?i=<?=$result_product[$i]['id']?>">
    <img src="images/chitiet.png" alt="icon" style="position: absolute;bottom: 0px;left: 0px;"></a>
    </div>
    <?php if($result_product[$i]['banchay'] > 0){ ?>
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
                <h4 style="margin: 0px;"><a><?=/*$result_list['ten'].' '.*/$result_product[$i]['ten']?></a></h4>
            </div>
            
            <div class="sp_gia">
            <?php
                if(empty($_SESSION['mem_login']['mem_mail'])){
            ?>
            <a class="xemgia" style="cursor: pointer;color:#dc241a;"><?='Xem giá';?></a>
        <?php }else {?>
            <?=doitien($result_product[$i]['gia'])?>
        <?php } ?>    
            </div>
        </div> <!-- #### -->

    </div>
  </div>
</div>
</div>
<? }?>
 <div class="phantrang"><?=$paging['paging']?></div>
 <?php } else{?>
 	<div style="font-size:12px;color:#969696; text-align:center; margin:10px;" > Sản phẩm đang cập nhật</div><br />
<?php  } } ?>

<?php  } ?>