
<script type="text/javascript">
    jQuery(document).ready(function($) {    
  //selector đến menu cần làm việc
  var TopFixMenu = $("#menu_m");
  var TopFixMenu1 = $(".top_header");
  // dùng sự kiện cuộn chuột để bắt thông tin đã cuộn được chiều dài là bao nhiêu.
    $(window).scroll(function(){
    // Nếu cuộn được hơn 150px rồi
        if($(this).scrollTop()>133){
      // Tiến hành show menu ra  
        TopFixMenu1.css({
            top: 0,
            
        });  
           TopFixMenu.hide();
           TopFixMenu1.show(); 
            
        }else{
      // Ngược lại, nhỏ hơn 150px thì hide menu đi.
                TopFixMenu1.hide();
                TopFixMenu.show(); 
                TopFixMenu.css({
                top: 133,
            
                }); 

            }
        }
    )
})
</script>

<?php
	$d->reset();
	$sql = "select * from #_product_cat where hienthi = 1 order by stt,id asc";
	$d->query($sql);
	$result = $d->result_array();
?>
<ul class="nav1">
    <li <?php if($_GET['com'] == '' || $_GET['com'] == 'trang-chu' || $_GET['com'] == 'index'){?>class="act" <?php } ?> ><a href="trang-chu.html"> TRANG CHỦ </a>  </li>
    
    <li <?php if($_GET['com'] == 'thac-mac-va-huong-dan'){?>class="actgt" <?php }else{?> class="gioithieu"<? } ?>><a href="thac-mac-va-huong-dan.html">THẮC MẮC VÀ HƯỚNG DẪN</a>  </li>
	
   <li style="position: relative;" <?php if($_GET['com'] == 'san-pham-khuyen-mai'){?>class="actkm" <?php }else{?> class="khuyenmai"<? } ?>><a href="san-pham/hang-co-san.html"> HÀNG CÓ SẴN</a>  <img class="imghaimenu" src="images/new.png" alt="icon" style="position: absolute;left: 130px;top: -15px;">   
        <?php
            $d->reset();
            $sql = "select * from #_product_cat where hienthi = 1 order by stt,id asc";
            $d->query($sql);
            $result_cat = $d->result_array();
            
        ?>
        <ul class="sub">
            <?php foreach($result_cat as $cat){ ?>
            <li class="t2">
                <h5><a href="san-pham/<?=$cat['tenkhongdau']?>.html">
                     <img alt="icon" src="images/pt_next.png" style="margin-right:5px;" /><?=$cat['ten']?>
                </a>
                </h5>
            </li>
            <? } ?>
        </ul>

    </li>
    
    <li <?php if($_GET['idc'] == 'phong-thuy'){?>class="actpt" <?php }else{?> class="phongthuy"<? } ?>><a href="san-pham/albums.html">ALBUM</a>  </li>

   	<li <?php if($_GET['com'] == 'tin-tuc'){?>class="acttt" <?php }else{?> class="tintuc"<? } ?>><a href="tin-tuc.html"> TIN TỨC</a>  </li>

    <li <?php if($_GET['idc'] == 'tuyen-dung'){?>class="acttd" <?php }else{?> class="tuyendung"<? } ?>><a href="gioi-thieu.html">VỀ TRÙM SỈ</a>  </li>
    
    <li <?php if($_GET['com'] == 'lien-he'){?>class="actlh" <?php }else{?> class="lienhe"<? } ?>><a href="lien-he.html">GÓP Ý</a></li>
    
     
      
</ul>
