<?php 
	session_start();
   	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../admin/lib/');
	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."functions.php";
	include_once _lib."function_user.php";
	include_once _lib."class.database.php";	
	include_once _lib."file_requick.php";
	
	$d = new database($config['database']);


		$next = $_POST['idn'];
		$prev = $_POST['idp'];
		$idz = $_POST['idz'];
		//echo $next.'-'.$idz.'-'.$prev;
	$id = $next;
    $arrsp = $_GET['c'];

    $getid = explode('-',$arrsp);
   
    $getcat = $getid[0];
    $getlist = $getid[1];
    $getitem = $getid[2];

    $sql = "select * from #_quangcao1 where hienthi=1";
    /*if($getcat != 0)
        $sql .= " and id_cat = ".$getcat." " ;
    if($getlist != 0)
        $sql .= " and id_list = ".$getlist." " ;
    if($getitem != 0)
        $sql .= " and id_item = ".$getitem." " ; */        
    $sql .= " order by stt,id asc";
    $d->query($sql);
    $result_sp = $d->result_array(); 

   foreach ($result_sp as $ks => $vs) {
      if($vs['id'] == $id){
            if($ks == 0){
                $prev = $ks+1;
                $x = $ks;
                $next = 0;
            }elseif($ks == count($result_sp)-1){
                $prev = 0;
                $x = $ks;
                $next = $ks-1;
            }else{    
                $prev = $ks+1;
                $x = $ks;
                $next = $ks-1;
            }    
       }
   }
   $n = $result_sp[$next]['id'];
   $z = $result_sp[$x]['id'];
   $p = $result_sp[$prev]['id'];	

?>	

   <link href="utils-min.css" rel="stylesheet" type="text/css">
    <script src="jquery.js" type="text/javascript"></script>
    <script src="utils-min.js" type="text/javascript"></script>
    <link href="site.css" rel="stylesheet" type="text/css">
    <link href="reponsive.css" rel="stylesheet" type="text/css">
    <script src="jquery.elevateZoom-3.0.8.min.js" type="text/javascript"></script>
    <script src="slideable.js" type="text/javascript"></script>
    <script>
        $(function () {
            var parentBody = window.parent.document.body;
            $(".grvProductTemp").data("QueryEncode", window.parent.dataQuery);
            $("#cboxContent", parentBody).css("margin-top", 0);
            $("body").on("click", ".next-product", function () {
                //alert('aaa');
                $.ajax({
                    url: "xuly.php",
                    type: "post",
                    cache: false,
                    data: { idn: <?=$n?>,idz: <?=$z?>,idp: <?=$p?>},
                    success: function(result){
                        $('.popProduct').hide();
                        $('.zoomContainer').hide();
                        $('#abc').html(result);
                       
                    }
                });
                /*var parentBody = window.parent.document.body;
                var id = $(".txtIdGroupPopup").val();
                var objThis = $(".group-product-item[data=" + id + "]", parentBody);
                var index = $(".group-product-item", parentBody).index(objThis);
                index++;
                if (index >= $(".group-product-item", parentBody).size()) {
                    index = 0;
                }
                var dataNext = $($(".group-product-item", parentBody).get(index)).attr("data");
                $(".txtIdGroupPopup").val(dataNext);
                $(".txtIdGroupPopup").actionComponent("NewProduct");*/
            }).on("click", ".prev-product", function () {
                /*var parentBody = window.parent.document.body;
                var id = $(".txtIdGroupPopup").val();
                var objThis = $(".group-product-item[data=" + id + "]", parentBody);
                var index = $(".group-product-item", parentBody).index(objThis);
                index--;
                if (index == 0) {
                    index = $(".group-product-item", parentBody).size() - 1;
                }
                var dataNext = $($(".group-product-item", parentBody).get(index)).attr("data");
                $(".txtIdGroupPopup").val(dataNext);
                $(".txtIdGroupPopup").actionComponent("NewProduct");*/
            });

            var listImageSlideClick = 0;
            $(document).keyup(function (e) {
                if (e.keyCode == 37) {
                    //<
                    $(".prev-product").click();
                } else if (e.keyCode == 39) {
                    //>
                    $(".next-product").click();
                } else if (e.keyCode == 38) {
                    //^
                    listImageSlideClick--;
                    if (listImageSlideClick < 0) {
                        listImageSlideClick = ($("#listImageSlide .item").size() - 1);
                    }
                    $($("#listImageSlide .item").get(listImageSlideClick)).click();
                } else if (e.keyCode == 40) {
                    //<V
                    listImageSlideClick++;
                    if (listImageSlideClick >= $("#listImageSlide .item").size()) {
                        listImageSlideClick = 0;
                    }
                    $($("#listImageSlide .item").get(listImageSlideClick)).click();
                }
            })
            window.focus();

        })

        $(window).load(function () {
            var parentBody = window.parent.document.body;
            $(".c-pdi").click(function(){
                messageDiaLog('Thông báo','Thành công','');
            })
           /* $(".s-pdi").each(function (i, e) {
                var data = $(e).attr("data");
                var vals = "";
                if ($("option", e).size() > 0) {
                    $("option", e).each(function (i, e) {
                        var q = parseInt($(e).attr("data"));
                        if (q > 0) {
                            if (vals == "") {
                                vals = $(e).attr("value");
                            }
                        }
                    })
                } else {
                    $(".c-pdi[data=" + data + "]").css("display", "none");
                    $(".c-d-pdi[data=" + data + "]").css("display", "block");
                }
                $(e).val(vals);
            })*/
            /*$(".s-pdi").change(function () {
                var data = $(this).attr("data");
                var q = parseInt($("option:selected", this).attr("data"));
                var qOption = "";
                if (q > 0) {
                    for (var i = 1; i <= q; i++) {
                        qOption += "<option value=\"" + i + "\">" + i + "</option>";
                    }
                    $(".c-pdi[data=" + data + "]").css("display", "block");
                    $(".c-d-pdi[data=" + data + "]").css("display", "none");
                } else {
                    $(".c-pdi[data=" + data + "]").css("display", "none");
                    $(".c-d-pdi[data=" + data + "]").css("display", "block");
                }
                $(".q-pdi[data=" + data + "]").html(qOption);
            })*/
            /*$(".s-pdi").change();
            $(".c-pdi").click(function () {
                var data = $(this).attr("data");
                var s = $(".s-pdi[data=" + data + "]").val();
                var q = $(".q-pdi[data=" + data + "]").val();
                var parentBody = window.parent.document.body;
                $(".txtProductOrder", parentBody).val(s + "," + q);
                $(".txtProductOrder", parentBody).actionComponent("OrderProduct");
            })*/
            $(".view-price").click(function () {
                var parentBody = window.parent;
                $(".txtProductOrder", parentBody.document.body).val(parentBody.location.pathname);
                $(".txtProductOrder", parentBody.document.body).actionComponent("RedirectLoginParent");
            })
            //=======
            var wImage = $(".popProduct").width() + 150 ;
            var wImageRender = wImage;
            $(".img-detail-render").css("width", wImageRender);
            $(".image-main-product").css("width", wImage);
            if (!$.isMobile) {
                $("#listImageSlide .item").click(function () {
                    var data = $(this).attr("data-zoom-image");
                    $("#img_01").attr("src", data);
                })
            }
            $("#listImageSlide").slideable({ size: 3, nextSize: 3, axis: 'y' });
            if ($(".list-image-slide img").size() < 3) {
                $(".list-image-slide").css("height", $(".list-image-slide img").size() * 146);
            }
            resizeImg();
            $(".popProduct").css("visibility", "visible");
        })

        function resizeImg() {

            var heightContent = $(".popProduct").height();
            //alert(heightContent);
            var parentBody = window.parent.document.body;
            var heightParent = $("#cboxOverlay", parentBody).height();
            if (heightContent < heightParent) {
                var topParent = (heightParent - heightContent) / 2;
                $("#cboxContent", parentBody).css("height", heightContent);
                $("#cboxContent", parentBody).css("margin-top", topParent);
            }
            var zh = $(".image-main-product").height();
            //$(".img-detail-render").css("max-width", 430);
            $(".img-detail-render").css("max-height", heightContent - 20);
            $("#img_01").css("max-width", 430);
            //$("#img_01").css("max-height", heightContent - 20);
            /*if (!$.isMobile) {
*/              var wZ = $("#demo-container").width();
                var hZ = $("#demo-container").height();
                
                $("#img_01").elevateZoom({ gallery: "listImageSlide", cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, zoomWindowPosition: "demo-container", zoomWindowHeight: hZ, zoomWindowWidth: wZ, borderSize: 0, easing: true, scrollZoom: true });
                $($("#listImageSlide .item").get(0)).click();
            /*}*/

        }
    </script>
    <style>
        .zoomWindowContainer .zoomWindow, .zoomContainer
        {
            max-height: 100%;
        }
        
        .zoomWrapper
        {
            width: auto !important;
            height: auto !important;
        }
    </style>
<?php 
    $sql = "select * from #_quangcao1 where id = ".$id."";
    $d->query($sql);
    $result_ctsp = $d->fetch_array();
    //print_r($result_ctsp);
/*tach id*/
    $idarr = $result_ctsp['id_product'];

    $a = rtrim($idarr,',');

    $tachid = explode(',',$a);
     
/*lay nhiu hinh*/
    $sql_1 = "select * from #_mausac1 where id_product = ".$id."";
    $d->query($sql_1);
    $result_c = $d->result_array();
    //print_r($result_c);
?>

<div  class="popProduct" style="position: relative; height: 624px; visibility: visible; background: white;">
    
        <!-- <div  class="GridView grvProductTemp hide">
            <div class="paging-top paging hide"><a class="page selected" data="1">1</a></div><div class="grid-header" style="width: 100px;"><table border="0" cellpadding="0" cellspacing="0"></table></div><div class="grid-content"><table border="0" cellpadding="0" cellspacing="0"></table></div><div class="paging-bottom paging hide"><a class="page selected" data="1">1</a></div>
        </div> -->
<style type="text/css">
    .next-product
{
    background: url('next-slide.png');
    width: 32px;
    height: 61px;
    top: 40%;
    right: 0px;
    position: absolute;
    z-index: 10;
}

.prev-product
{
    background: url('prev-slide.png');
    width: 32px;
    height: 61px;
    top: 40%;
    left: 0px;
    position: absolute;
    z-index: 10;
}
</style>        
        <div id="demo-container" style="position: absolute; top: 0px; right: 0px;width: 480px;height: 620px; z-index: -1">
        </div>
        <div class="image-main-product">
            <!-- <div class="hide">
                <input runnat="TextBox" id="txtIdGroupPopup_RD9458" class="TextBox txtIdGroupPopup">
                
            </div> -->
            <a class="next-product"></a>
            <a class="prev-product"></a>
            <div  class="img-detail-render">
        
                <div style="height:620px;width:430px;" class="zoomWrapper">
                    <img id="img_01" itemprop="image" src="<?=_upload_sanpham.$result_ctsp['photo']?>" class="main-image" data-zoom-image="<?=_upload_sanpham.$result_ctsp['photo']?>" style="width:430px;height: 620px; position: absolute;">
                </div>
            <!-- <div style="background: url(&#39;http://www.elevateweb.co.uk/spinner.gif&#39;) no-repeat center;height:undefinedpx;width:undefinedpx;z-index: 2000;position: absolute; background-position: center center;"></div> -->
            </div>
            
            <div class="list-image">
                <a class="prev-slide prev_listImageSlide" style="margin-bottom: 15px; visibility: visible;">
                    <img src="arr-top.jpg"></a>
                <div id="listImageSlide" class="list-image-slide" style="overflow: hidden; position: relative;">
                 
                <a  class="item active" data-image="<?=_upload_sanpham.$result_ctsp['photo']?>" data-zoom-image="<?=_upload_sanpham.$result_ctsp['photo']?>" style="display: block; margin: 0px; height: 264px; width: 100px;">
                <img src="<?=_upload_sanpham.$result_ctsp['thumb']?>">
                </a>
        <?php if(count($result_c) > 0){
            foreach ($result_c as $kc => $vc) {
        ?>        
                <a class="item "  data-image="<?=_upload_sanpham.$vc['photo']?>" data-zoom-image="<?=_upload_sanpham.$vc['photo']?>" style="display: block; margin: 0px; height: 264px; width: 100px;padding-top: 5px;"><img src="<?=_upload_sanpham.$vc['thumb']?>"></a>
        <?php } } ?>        

               
                </div>
                <a class="next-slide next_listImageSlide" style="margin-top: 15px; visibility: visible;">
                    <img src="arr-bottom.jpg"></a>
            </div>
            <div class="clear"></div>
        </div>
        <!-- ###################### -->
        <div class="description-main-product">
<?php 
    for ($j=0; $j < count($tachid) ; $j++) { 
        $sql = "select * from #_product where hienthi=1 and id='".$tachid[$j]."'";
        $d->query($sql);
        $result_detail_pro = $d->fetch_array();

        $sql = "select * from #_mausac where  id_product ='".$result_detail_pro['id']."'";
            $d->query($sql);
            $result_size = $d->result_array();  

        $sql = "select * from #_product_list where hienthi=1 and id='".$result_detail_pro['id_list']."'";
            $d->query($sql);
            $result_list = $d->fetch_array();
?>

            <div  class="ghsp"  >
        
                <div class="product-detail-item">
                <div class="n-pdi"><?=$result_list['ten']?></div>
                <div class="d-pdi"><b>Mô tả : </b> <?=$result_detail_pro['mota']?></div>
                <table border="0" class="t-pdi" cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <td>Mã hàng : <b><?=$result_detail_pro['ten']?></b></td>
                    <td>Chọn size :
                    <?php if(count($result_size) <= 0){?>
                    <select class="s-pdi" >
                        <option value="0" >Free</option>
                    </select>
                    <?php }else{?>
                    <select class="s-pdi" >
                        <?php foreach ($result_size as $kz => $vz) {?>
                            <option value="<?=$vz['id']?>" ><?=$vz['ten']?></option>
                        <?php } ?>       
                    </select>
                    <?php } ?>
                    </td>
                    <!-- <td class="row-cart" rowspan="2">
                    
                    </td> -->
                </tr>
                
                <tr>
                    <td>Giá : 
                    <a class="view-price">
                    <?php if($result_detail_pro['gia'] != '') {?>
                        <b><?=number_format($result_detail_pro['gia'],0,',','.')?> ₫ </b>
                    </a>
                    <?php } ?>
                    </td>
                    <td>Số lượng :<select class="q-pdi" data="2726"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td>
                </tr>
               
                   
               
                </tbody>
                </table>
                </div>
                <div align="center"> <a class="c-pdi" style="display: block;">Thêm giỏ</a>
                <a class="c-d-pdi"  style="display: none;">Hết hàng</a></div>
            </div>
<?php } ?>
            <!-- ############### -->
           
            <div runnat="Div" id="RD9469_RD9470" class="Div guide-product">
        
            <p>Bạn có thể dùng phím&nbsp;mũi tên <img alt="" src="icon1.png" style="height:11px; width:19px">&nbsp;để xem các sản phẩm khác</p>

            <p>Để xem các góc chụp khác của sản phẩm, hãy dùng phím&nbsp;mũi tên &nbsp;<img alt="" src="icon2.png" style="height:19px; width:11px"></p>

            </div>
        </div>
        <div class="clear"></div>
    
</div>  	

    