<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1001002426591026";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<?php
  	$id = $result_detail[0]['id'];
	$d->reset();
  	$sql = "select * from #_mausac where id_product = '".$id."' order by id desc " ;
	$d->query($sql);
	$result_t = $d->result_array();
	$c= count($result_t);
  ?>   
<link rel="stylesheet" href="js/abc/css/smoothproducts.css">
<style type="text/css">
	.qh_img{ 
	//float:left;
	/*border:5px #999 solid;*/
	//width:50%;
	;
	}
	.ct_ten{
		font-size:16px;
		color:#00F;
		font-weight:bold;
		padding:5px;
		border-bottom:1px dotted #CCC;
	}
	.t {
		color: #333;
		
		padding:5px;
		border-bottom:1px dotted #CCC;
		
	}
	
	.img_fl img{max-width:100%;height: auto;}
	
</style>


<div class="title"> 
	<div style="float:left;font-size:20px;font-weight:bold;text-transform:uppercase;color:#7d7d7d;border-bottom:3px solid #dc241a;margin-bottom:10px;"><img src="images/ico8.png" alt="gt" style="vertical-align: middle;margin-right: 10px;">chi tiết</div>
    
</div>
<div class="clear"></div>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
  <form id="form1" name="form1" action="index.php">
  	  <table id="tb" border="0" cellpadding="0" cellspacing="0" align="center">
    	<tbody>
        	<tr>
               <td class="ct_ten">Tên SP :</td>
               <td class="t" style="font-size:16px;color:#F00;text-transform:uppercase;font-weight:bold;"><?=$result_detail[0]['ten']?></td>
            </tr>
            <tr>
               <td class="ct_ten">Mã SP :</td>
               <td class="t"><?=$result_detail[0]['maso']?></td>
            </tr>
            <? if($result_detail[0]['gia2']<>0){?>
            <tr>
               <td class="ct_ten">Giá gốc :</td>
               <td class="t"><?=doitien($result_detail[0]['gia2'])?></td>
            </tr>
            <? } ?>
            <tr>
               <td class="ct_ten">Giá :</td>
               <td class="t" style="font-size:16px;font-weight:bold;" >
			  
               <?php 
				if($result_detail[0]['gia']=='' || $result_detail[0]['gia']==0){
					echo  "Liên hệ" ;
				} 
				else 
				{ 
					echo doitien($result_detail[0]['gia']) ;
				} ?>
               </td>
            </tr>
            <tr>
               <td class="ct_ten">Xuất xứ :</td>
               <td class="t"><?=$result_detail[0]['xuatxu']?></td>
            </tr>
            <tr>
               <td class="ct_ten">Màu sắc :</td>
               <td class="t"><?=$result_detail[0]['mausac']?></td>
            </tr>
            <tr>
               <td class="ct_ten">Kích thước :</td>
               <td class="t"><?=$result_detail[0]['kichthuoc']?></td>
            </tr>
            <!-- <tr>
               <td class="ct_ten">Kiểu đan :</td>
               <td class="t"><?=$result_detail[0]['kieudan']?></td>
            </tr>
            <tr>
               <td class="ct_ten">Tình trạng :</td>
               <td class="t"><?=$result_detail[0]['tinhtrang']?></td>
            </tr> -->
             <tr>
               
               <td align="center" colspan="2" class="t" style="border:none;"><input type="submit" value="Thêm vào giỏ hàng" style="border:none;padding:5px 10px;background:#0166ac;color:#fff;cursor:pointer;" >
               	<input type="hidden" name="quantity" id="quantity" value="1"/>     
     			<input type="hidden" name="productid" value="<?=$result_detail[0]['id']?>" />
        		<input type="hidden" name="command" value="add" />
    
               </td>
            </tr> 
        </tbody>
    </table>
 	</form>
  </div>   

 
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 qh_img">        
         <!--<a class="fancybox a_detail" href="<?=_upload_sanpham_l.$result_detail[0]['photo']?>" data-fancybox-group="gallery" title="<?=$result_detail[0]['ten']?>"> <img src="<?=_upload_sanpham_l.$result_detail[0]['photo']?>" width="260" height="190"/></a>-->
      
<div class="sp-wrap">
<a href="<?=_upload_sanpham_l.$result_detail[0]['photo']?>"><img src="<?=_upload_sanpham_l.$result_detail[0]['photo']?>" alt="hinh"  style="max-width: 100%;height:auto;"></a>
<?php
for ($i=0; $i < count($result_t); $i++) {  ?>
<a href="<?=_upload_tintuc_l.$result_t[$i]['photo']?>"><img src="<?=_upload_tintuc_l.$result_t[$i]['photo']?>" alt="" ></a>
<?php } ?>

<script type="text/javascript" src="js/abc/js/smoothproducts.min.js"></script>
<script type="text/javascript">
                /* wait for images to load */
                $(window).load( function() {
                    $('.sp-wrap').smoothproducts();
                });
        </script>

	</div>
  </div>
</div> <!-- row -->

  <div class="clear"></div>
  <div style="border-bottom:1px #999 dotted;margin:10px;"></div>
  <div style="margin:10px;">
  <!--<div style="margin-bottom: 15px;" class="fb-share-button" data-href="https://banghecafecaocap.com/san-pham/<?=$result_detail[0]['tenkhongdau']?>/<?=$result_detail[0]['id']?>.html" data-layout="button_count"></div>-->

  <!--<g:plus action="share"></g:plus>-->

    <script>
      window.___gcfg = {
        lang: 'en-US',
        parsetags: 'onload'
      };
    </script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    

    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54cb4e7e1052bd04" async="async"></script>
    <div class="addthis_native_toolbox"></div>
    <div class="img_fl">
    	<?=$result_detail[0]['noidung']?>
    </div>
  </div>
  






  
<div class="title"> 
	<div style="float:left;font-size:20px;font-weight:bold;text-transform:uppercase;color:#7d7d7d;border-bottom:3px solid #dc241a;margin-bottom:10px;">sản phẩm cùng loại</div>
    
</div>
<div class="clear"></div>

<?php if(count($result_product)>0){ ?>
<?php $pro = $result_product; for($i=0;$i<count($result_product);$i++){?>    
<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xxs_n">
<div class="row">
 <div class="sp"> 
    <div class="sp_img" >
    <div class="sp_img_l" >
    <a href="san-pham/<?=$pro[$i]['tenkhongdau']?>/<?=$pro[$i]['id']?>.html">
    <img class="soihinh" alt="<?=$pro[$i]['ten']?>" src="<?=_upload_sanpham_l.$pro[$i]['photo']?>" style="height:258px;width:284px;vertical-align: middle;" /></a>
    <a href="san-pham/<?=$pro[$i]['tenkhongdau']?>/<?=$pro[$i]['id']?>.html">
    <img src="images/chitiet.png" alt="icon" style="position: absolute;bottom: 0;"></a>
    </div>
    </div>
    <div class="sp_info">
        <div class="sp_ten">
            <h4><a href="san-pham/<?=$pro[$i]['tenkhongdau']?>/<?=$pro[$i]['id']?>.html"><?=catchuoi($pro[$i]['ten'],35)?></a></h4>
        </div>
        <div style="padding-left:10px;">
            <div class="sp_gia">
            <?php 
            if($pro[$i]['gia']=='' || $pro[$i]['gia']==0){
                echo  "Liên hệ" ;
            } 
            else 
            { 
                echo doitien($pro[$i]['gia']) ;
            } ?>
            </div>
            <div class="sp_gia1"> <? if($pro[$i]['gia2']<>0) {?><?=doitien($pro[$i]['gia2'])?><? } ?></div>
         
        </div>
        
    </div>
  </div>
</div>
</div>

<? } ?>
 <div class="phantrang"><?=$paging['paging']?></div>
 <?php } else{?>
 	<div style="font-size:14px;color:#F00;font-weight:bold; text-align:center; margin:10px;" > Sản phẩm đang cập nhật</div><br />
 <? } ?>
 
 <div class="clear"></div>



