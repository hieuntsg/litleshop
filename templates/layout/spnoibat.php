<?php  
	if(!defined('_source')) die("Error");	
	$d->reset();
	$sql_sp="select * from #_product where hienthi=1 and noibat !=0 order by stt, id desc";
	$d->query($sql_sp);
	$spnb=$d->result_array();
?>


<div class="title"><span class="title_right">SẢN PHẨM </span> NỔI BẬT</div>            
<div id="wrap">
 <ul id="mycarousel" class="jcarousel-skin-tango">
  <?php for($i=0;$i<count($spnb);$i++){?>    <li> 
      <div class="sp">
            <div class="sp_img"><a href="san-pham/<?=$spnb[$i]['tenkhongdau']?>/<?=$spnb[$i]['id']?>.html">
            <img src="<?=_upload_sanpham_l.$spnb[$i]['photo']?>" width="230" height="160" />
            </a></div>
            <div class="sp_info">
                <div class="sp_ten"><a href="san-pham/<?=$spnb[$i]['tenkhongdau']?>/<?=$spnb[$i]['id']?>.html"> 
					<?=catchuoi($spnb[$i]['ten'],30)?>
                 </a></div>
                <div style="height:25px;"> <div class="sp_ma">MãSP:<?=$spnb[$i]['maso']?> </div> <div class="sp_gia">- Giá:<?=format_money($spnb[$i]['gia'])?> </div> </div>
            </div>   
        </div>
    </li> 
    <? } ?> 
  </ul>
</div>