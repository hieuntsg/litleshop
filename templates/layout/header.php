<?php
$d->reset();
$sql="select* from table_photo where hienthi=1 and com='banner_top'";
$d->query($sql);
$result=$d->fetch_array();
$d->reset();
$sql="select* from table_hotline where hienthi=1 limit 0,2";
$d->query($sql);
$result_hot=$d->result_array();

$d->reset();
$sql="select* from table_company";
$d->query($sql);
$result_com=$d->fetch_array();
?>
<div class="logo" style="float:left;">
<a href="trang-chu.html">

<img src="<?=_upload_hinhanh_l.$result['photo']?>" width="80" height="141"/>
</a>
</div>
<div class="diachitop" style="float:right;width:1100px;" align="center">
    <img src="images/chu_top.png" alt="top" style="max-width: 100%;margin-top: 35px;">
    <!-- <div >
      <?=$result_com['diachi']?>
    </div> -->
    <div class="clear"></div>
    <div id="menu_m">
             <? include _template."layout/menu.php" ?>
    </div>
</div>
<!-- <div class="dienthoaitop" style="float:right;margin-top: 10px;">
    <img src="images/hotline_top.png" alt="top" style="max-width: 100%;">
    <div>
    <?php foreach ($result_hot as $k => $v) { ?> 
        <span style="font-family:utmavob;font-size: 20px;"><?=$v['dienthoai']?></span>
    <?php }?>
    </div>
</div> -->
<div class="clear"></div>