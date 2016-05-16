
<!-- ###################################### -->
<!-- <link href="scripts/box/css/site.css" rel="stylesheet" type="text/css" />

<script src="scripts/box/scripts/jquery.bootstrap.newsbox.min.js" type="text/javascript"></script>  -->

<style type="text/css" media="screen">
    span.glyphicon{display: none;}
    .panel-default{border-color:#fff;}
    .panel-body {padding:55px 15px 25px 15px;}
    .panel-footer{border-top:1px solid #ebebeb;background-color:#ebebeb;}
    .panel{background-color: #ebebeb;border: 1px solid transparent;border-radius: 4px;}
    .pagination > li > a, .pagination > li > span {
    position: absolute;
    float: none;
    padding: 14px 18px;
    margin-left: 0px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: none;
}
    .pagination > li > a.next{background: url(images/up.png) no-repeat;top:20px;right:48%;}
    .pagination > li > a.prev{background: url(images/down.png) no-repeat;bottom:20px;right:48%;}

</style>
<div style="width: 100%;font-size: 20px;margin-bottom: 20px;margin-top: 20px;" align="center">ALBUM HÀNG MỚI VỀ</div>
<?php 
     $d->reset();
    $sql_sp="select * from #_product_item where hienthi=1 and id_cat = 16 order by stt, id asc ";
    $d->query($sql_sp);
    $sp_item=$d->result_array();
?>
<script type="text/javascript">
  $(document).ready(function() {
 
  $("#owl-demotab2").owlCarousel({
 
      autoPlay: 5000, //Set AutoPlay to 3 seconds
 
      items : 3,
      itemsDesktop : [1199, 3],
      itemsDesktopSmall : [979, 2],
      itemsTablet : [768, 2],
      
      itemsMobile : [579, 1],
      
      navigation : true,
      navigationText : ["<img src='images/prev.png' alt='icon'>","<img src='images/next.png' alt='icon'>"],
      rewindNav : true,
      scrollPerPage : false,
      pagination : false,  
  });
 
});
</script>
<div style="width: 100%;background: #ebebeb;">
<div class="albummoi" style="width: 1100px;margin: 0 auto;position: relative;">
<div id="owl-demotab2" >
<?php foreach ($sp_item as $kt => $vt) { 
     $d->reset();
    $sql_sp="select tenkhongdau from #_product_list where hienthi=1 and id = ".$vt['id_list']."";
    $d->query($sql_sp);
    $sp_tenlist=$d->fetch_array();
  ?>
    <div class="item" align="center">
        <div style="width: 308px;height: 367px;">
            <a href="san-pham/albums/<?=$sp_tenlist['tenkhongdau']?>/<?=$vt['tenkhongdau']?>/<?=$vt['id']?>.html"><img style="max-height: 322px;max-width: 308px;box-shadow: 4px 4px 7px #515151;" src="<?=_upload_sanpham_l.$vt['photo']?>"  /></a>
                <div class="clear"></div>
                <div style="height: 60px;margin-top: 15px;padding: 10px" align="center">
                    <a style="text-transform: uppercase;font-size: 15px;font-family:opensans_b;color:#222222;" href="san-pham/albums/<?=$sp_tenlist['tenkhongdau']?>/<?=$vt['tenkhongdau']?>/<?=$vt['id']?>.html"><?=$vt['ten']?></a>
                </div>
        </div>
    </div>    
<?php } ?>
</div>
</div> 
</div>