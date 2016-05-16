<div id="menu_m2">
    <ul>
        <li><a href="san-pham-hot.html">SẢN PHẨM HOT</a></li>
        <li style="position:relative;"><a href="san-pham-khuyen-mai.html">KHUYẾN MÃI
        	<img src="images/hotnews.gif" height="20px;" style="position:absolute;top:5px;right:2px;"/></a></li>
        <span class="act2"><li><a href="san-pham-xem-nhieu-nhat.html">XEM NHIỀU NHẤT</a></li></span>
    </ul>
</div>
<div class="clear"></div>
<?php for($i=0;$i<count($spxnn);$i++){?><div class="sp">
    <div class="sp_img"><a href="san-pham/<?=$spxnn[$i]['tenkhongdau']?>/<?=$spxnn[$i]['id']?>.html">
    <img src="<?=_upload_sanpham_l.$spxnn[$i]['photo']?>" width="270" height="220"/></a></div>
    <div class="sp_info">
        <div class="sp_ten">
        <a href="san-pham/<?=$spxnn[$i]['tenkhongdau']?>/<?=$spxnn[$i]['id']?>.html"><?=catchuoi($spxnn[$i]['ten'],20)?></a></div>
        <div class="sp_chitiet"> <a href="san-pham/<?=$spxnn[$i]['tenkhongdau']?>/<?=$spxnn[$i]['id']?>.html"> Chi tiết</a></div>
    </div>
</div>
<? } ?>
<div class="phantrang"><?=$paging['paging']?></div>
