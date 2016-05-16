<?php
	$d->reset();
	$sql="select * from #_product_cat where hienthi=1 order by stt, id desc";
	$d->query($sql);
	$product_cat=$d->result_array();
	
	$d->reset();
	$sql = "select * from table_logodoitac where hienthi = 1 limit 0,1";
	$d->query($sql);
	$video=$d->result_array();
	
	
	$d->reset();
	$sql="select * from #_infodoitac where hienthi=1 order by stt, id desc";
	$d->query($sql);
	$infodoitac=$d->result_array();
	
	$d->reset();
	$sql="select * from #_yahoo where hienthi=1 order by stt, id desc limit 0,4";
	$d->query($sql);
	$result_yahoo=$d->result_array();

    $d->reset();
    $sql="select * from #_hotline where hienthi=1 limit 0,2";
    $d->query($sql);
    $result_hotline=$d->result_array();
	
	$d->reset();
	$sql="select * from #_news where hienthi=1 and id_item = 9 order by stt, id asc limit 0,4";
	$d->query($sql);
	$result_news=$d->result_array();
	
	$d->reset();
	$sql="select * from #_alpum where hienthi=1 order by stt, id desc";
	$d->query($sql);
	$alpum=$d->result_array();
?>
<?php if($_GET['com'] != 'index' && $_GET['com'] != '' && $_GET['com'] != 'trang-chu') {?>
<div style="font-family: utmavo;text-transform: uppercase;font-size: 15px;"><img src="images/tintuc.png" alt="icon" style="vertical-align: middle;margin-right: 10px;">danh mục sản phẩm</div>
    <div id="menudoc" style="border: 1px solid #dedede;">
    <ul >
         <?php for($i=0;$i<count($product_cat);$i++){ 
            $d->reset();
            $sql="select* from #_product_list where hienthi=1 and  id_cat='".$product_cat[$i]['id']."' order by stt";
            $d->query($sql);
            $product_item=$d->result_array();   
            
         ?>
        <li><h2><a href="san-pham/<?=$product_cat[$i]['tenkhongdau']?>.html"><img alt="icon" src="<?=_upload_sanpham_l.$product_cat[$i]['photo']?>" style="margin-right:5px" /><?=$product_cat[$i]['ten']?></a><h2>
                 <ul >
                    <?php for($j=0;$j<count($product_item);$j++){?>
                    <li>
          <h3><a style="font-size:14px;font-weight:normal;" href="san-pham/<?=$product_cat[$i]['tenkhongdau']?>/<?=$product_item[$j]['tenkhongdau']?>/<?=$product_item[$j]['id']?>.html">
            <img alt="icon" src="images/butlicon.png" style="margin-right:5px" /> <?=$product_item[$j]['ten']?>
            
          </a></h3>
                    </li>
                    <? }?>
                  </ul>
            
            </li>
        <? } ?>        
    </ul>
    </div>
<?php } ?>

<div class="clear"></div>
<img src="images/hotline_su.png" alt="icon" >
<div style="background:#fff;min-height:100px; padding:2px; margin-bottom:15px;border:1px solid #eaeaea;">
<?php foreach ($result_hotline as $k => $v) {?>
    <span style="font-family: utmavob;font-size: 18px;color:#0166ac"><?=$v['dienthoai']?></span>
<?php }?>
     <?php for($i=0;$i<count($result_yahoo);$i++){?>
        
         
         <div style="margin-bottom:10px; color:#F00;float:left;font-size:12px;margin-top:5px;"><span style="color:#000;margin-left:10px"> <?=$result_yahoo[$i]['ten']?></span> <br /><span style="color:#0166ac;font-weight:bold;margin-left:10px"><?=$result_yahoo[$i]['dienthoai']?></span></div>
         <div style="float:right;margin-top:10px;">
         <a href="ymsgr:sendIM?<?=$result_yahoo[$i]['yahoo']?>">
    		<img  src="images/yahoo.png" title="<?=$result_yahoo[$i]['ten']?>" alt="<?=$result_yahoo[$i]['ten']?>"/>
         </a>
         <a href="Skype:<?php echo $v['skype']; ?>?chat" title="<?php echo $v['ten']; ?>" > <img  src="images/skype.png" title="<?php echo $v['ten']; ?>"  border="0" alt="<?php echo $v['ten']; ?>" /> </a> 
         </div>
         <div class="clear"></div>
     <? } ?>
     </div>    
    <div class="clear"></div>
    
    
<div style="font-family: utmavo;text-transform: uppercase;font-size: 15px;"><img src="images/video.png" alt="icon" style="vertical-align: middle;margin-right: 10px;">video</div>
    <div style="margin:5px 0;" >
		<?php 
			$link=explode('v=',$video[0]['mota'])?>
    	
	<iframe width="284" height="200" src="//www.youtube.com/embed/<?=$link[1]?>?rel=0" frameborder="0" allowfullscreen></iframe>
    
     </div>
<div style="margin-top: 15px;font-family: utmavo;text-transform: uppercase;font-size: 15px;"><img src="images/tintuc.png" alt="icon" style="vertical-align: middle;margin-right: 10px;">tư vấn sản phẩm</div>
    <div style="background:#fff;min-height:100px;padding:10px;margin-bottom:15px;border:1px solid #eaeaea;margin-top: 10px;">
    <div>
     <?php foreach($result_news as $news){?>
     <div style="padding:15px 0px;">
        <img src="<?=_upload_tintuc_l.$news['photo']?>" alt="<?=$news['ten']?>" style="float: left;width:85px;height:85px;">
        <div style="background:url(images/lineli.png) no-repeat center bottom;line-height:15px;float:left;width:165px;margin-left:10px; ">
        <a style="font-weight: bold;" class="news_left" href="tin/<?=$news['tenkhongdau']?>/<?=$news['id']?>.html"><?=catchuoi($news['ten'],40)?></a>
            <div style="margin-top: 5px;clear:both;font-size: 12px;">
                <?=catchuoi($news['mota'],80)?>
            </div>
        </div>
     </div>
     <div class="clear"></div>   
     <? } ?>
     </div>
     <div style="float:right;margin-top:10px;"><a style="color:#4280b8;" href="tin/tu-van-san-pham.html">Xem thêm &raquo;</a></div>
     <div class="clear"></div>
     </div>       
<!--<div class="danhmuc">facebook</div>
	 <div style="background:#fff;width:220px;min-height:100px;margin-bottom:15px;">
		<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like-box" data-href="https://www.facebook.com/pages/Inoxmanhhung/1427403860867187?ref=hl" data-width="220" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>    
</div>     --> 
     
<!--<div class="danhmuc">liên kết website</div>
	<div style="margin:5px 5px">
		<select style="width:190px;" id="lkweb" onchange="window.open(this.value,'_blank')">
          	<option style="text-align:center;">----Chọn liên kết----</option>	
           <!-- <option value="https://www.google.com.vn/">google.com</option>
            <option value="http://ptit.vn/">Thiết kế web PTiT</option>
            <option value="http://banghieuhopden.net/">Quảng cáo Quang Vinh</option>
            <option value="http://www.chicuongpro.com">Chống thấm nhà</option> 
             <?php for($i=0;$i<count($infodoitac);$i++){ ?>
             	 <option value="<?=$infodoitac[$i]['mota']?>"><?=$infodoitac[$i]['ten']?></option>
             <? } ?>
        </select>
    </div>  -->
    
<div style="font-family: utmavo;text-transform: uppercase;font-size: 15px;"><img src="images/tintuc.png" alt="icon" style="vertical-align: middle;margin-right: 10px;">Sản phẩm hot</div>
	<div style="background:#fff;width:284px;min-height:100px;margin-bottom:15px;margin-top: 10px;">   
		<ul class="scroller">	        
        	<?php for($i=0;$i<count($alpum);$i++){?>
        	<li><img src="<?=_upload_tintuc_l.$alpum[$i]['photo']?>" width="284px" title="<?=$alpum[$i]['ten']?>" /></li>
       	 	<? } ?>
		</ul> 
	</div>    
    
<!-- <div style="font-family: utmavo;text-transform: uppercase;font-size: 15px;"><img src="images/tintuc.png" alt="icon" style="vertical-align: middle;margin-right: 10px;">Thống kê truy cập</div>
    <div style="background:#fff;//width:200px;min-height:70px;margin-bottom:15px;padding:10px;border:1px solid #eaeaea;margin-top: 10px;">
    <div><img src="images/dang.png" /><span style="color:#999"> Đang Online: </span>
		<strong><big><? $count=count_online(); echo $count['dangxem']?></big></strong></div>
    <br />
    <div><img src="images/ngay.png" /><span style="color:#999">Trong ngày: </span>
		<strong><big><? echo $today_visitors;?></big></strong></div>
    <br />
    <div><img src="images/dang.png" /><span style="color:#999"> Tổng truy cập: </span> 
		<strong><big><?=$count['daxem']?></big></strong></div>
    <br />
    </div> -->
<div style="font-family: utmavo;text-transform: uppercase;font-size: 15px;"><img src="images/tintuc.png" alt="icon" style="vertical-align: middle;margin-right: 10px;">Google</div>
<div style="background:#fff;width:284px;min-height:100px;margin-bottom:15px;border:1px solid #eaeaea;border:1px solid #eaeaea;margin-top: 10px;" align="center">
<a href="https://plus.google.com/u/0/+%C4%91%C3%B4ngquangghecafe/posts"><img src="images/g_icon.png" alt="icon" width="200px"></a>
</div>    
<!-- <div style="font-family: utmavo;text-transform: uppercase;font-size: 15px;"><img src="images/tintuc.png" alt="icon" style="vertical-align: middle;margin-right: 10px;">Facebook</div> -->
<img src="images/title_facebook.png" alt="icon" width="284px">
     <div style="background:#fff;width:284px;min-height:100px;margin-bottom:15px;">
        <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like-box" data-href="https://www.facebook.com/banghevietnam" data-width="284" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>    
</div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    