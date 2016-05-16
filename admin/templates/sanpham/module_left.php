<?php
	$d->reset();
	$sql_dmtour1="select ten,tenkhongdau from #_tour_item where hienthi=1 and id_cat=1 order by stt,id desc";
	$d->query($sql_dmtour1);
	$result_dmtour1=$d->result_array();
	
	$d->reset();
	$sql_hotro="select ten,yahoo,skype from #_yahoo where hienthi=1 order by stt,id desc";
	$d->query($sql_hotro);
	$result_hotro=$d->result_array();

	$d->reset();
	$sql_doitac="select photo,mota from #_doitac where hienthi =1 order by stt,id desc";
	$d->query($sql_doitac);
	$result_doitac=$d->result_array();
	
	$d->reset();
	$sql_hotline="select dienthoai from #_hotline limit 0,1";
	$d->query($sql_hotline);
	$result_hotline=$d->fetch_array();	
?>

<div class="left_module">
	<div class="menutop">Danh Mục Sản Phẩm</div>
      <div class="menubg">
    	<?php
			$count_dmtour1=count($result_dmtour1);
			if($count_dmtour1>0){
		?>
      	<ul class="menu_left">
        	<?php for($i=0;$i<$count_dmtour1;$i++) { ?>
        	<li><a href="sanpham/thoitrang/<?=$result_dmtour1[$i]['tenkhongdau']?>.html"><font color="#FFFF00">+</font>  <?=$result_dmtour1[$i]['ten']?></a></li>
            <?php } ?>
        </ul>
        <?php } ?>
      </div>
  </div>
  
  <div class="left_module">
	<div class="menutop">Hỗ trợ trực tuyến</div>
      <div class="menubg">
          <ul class="menu_left">
          <?php 
          for($i=0,$count_hotro=count($result_hotro);$i<$count_hotro;$i++){	
          ?> 
            <li><?php echo $result_hotro[$i]['ten']?> <span style="font-size:14px; float:right; padding-right:37px"><a href="ymsgr:sendIM?<?php echo $result_hotro[$i]['yahoo']?>"><img src="http://opi.yahoo.com/online?u=<?php echo $result_hotro[$i]['yahoo']?>&m=g&t=2" width="92"></a></span></li>
          <?php } ?>
             <li>Hotline: <span style="font-size:14px; float:right; padding-right:37px;font-weight: bold;"><?php echo $result_hotline['dienthoai']?></span></li>
          </ul>
      </div>
  </div>
  <div style="top:12px;top: 40px;position: absolute;right: 112px;font-size: 18px;color: #F26522;"><?php echo $result_hotline['dienthoai']?></div>

  <div class="left_module">
	<div class="menutop">Quảng cáo</div>
      <div class="module_new">
			 <?php for($i=0,$count_doitac=count($result_doitac);$i<$count_doitac;$i++){ ?>
             <a href="<?=$result_doitac[$i]['mota']?>"> <img src="<?=_upload_hinhanh_l.$result_doitac[$i]['photo']?>" width="212" alt="" /> &nbsp; </a> 
           <?php } ?>
      </div>
  </div>

  <div class="left_module">
	<div class="menutop">Thống kê truy cập</div>
      <div class="menubg">
          <ul class="menu_left">
            <li>Đang online: <span style="font-size:14px; float:right; padding-right:37px;font-weight: bold;"> <?php $count=count_online();echo $tong_xem=$count['dangxem'];?> người</span></li>
            <li>Đã online: <span style="font-size:14px; float:right; padding-right:37px;font-weight: bold;"> <?php $count = count_online(); echo $count['daxem']?> người</span></li>
          </ul>
      </div>
  </div>
  