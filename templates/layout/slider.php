<?php
    
    $d->reset();
    $sql_slide="select * from table_slider where hienthi=1 order by stt";
    $d->query($sql_slide);
    $result_slides=$d->result_array();

?>


<link rel="stylesheet" type="text/css" href="scripts/engine1/style.css" />
<!-- <script type="text/javascript" src="scripts/engine1/jquery.js"></script> -->
<div id="wowslider-container1">
  <div class="ws_images">
    <ul>
    <?php foreach($result_slides as $result_slide){ ?>
      <li><a href="<?=$result_slide['ten']?>">
      <img src="<?=_upload_hinhanh_l.$result_slide['photo']?>" alt="<?=$result_slide['ten']?>" title="<?=$result_slide['ten']?>" id="wows1_0"/>
      </a></li>
    <?php } ?>
    </ul>
  </div>
  <!-- <div class="ws_bullets"><div>
    <a href="#" title="robuschi"><span>1</span></a>
    <a href="#" title="seepex"><span>2</span></a>
  </div></div>
  <div class="ws_shadow"></div> -->
  </div>

  <script type="text/javascript" src="scripts/engine1/wowslider.js"></script>
  <script type="text/javascript" src="scripts/engine1/script.js"></script>
<?php 
    $d->reset();
    $sql_slide="select * from table_about";
    $d->query($sql_slide);
    $result_gt=$d->fetch_array();
?>
<div style="width: 100%;padding: 15px;border: 1px solid #949494;margin-top: 35px;position:relative;">
    <h3 style="background: #fff;position: absolute;font-size: 35px;margin-top: -38px;font-family:opensans_b;">VỀ TRÙM SỈ</h3>
    <?=catchuoi($result_gt['noidung'],700)?>
    <div class="clear"></div>
    <div style="padding-bottom: 10px;">
    <a href="gioi-thieu.html" style="float: right;margin-bottom: 10px;color:#eda61c;">Chi tiết &raquo;</a>
    </div>
</div>  













