<?php
session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './admin/lib/');
	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."functions.php";
	include_once _lib."function_user.php";
	include_once _lib."class.database.php";
	
	include_once _lib."file_requick.php";
	include_once _lib."thongkeonline.php";	
	var_dump("XXX");
	if($_REQUEST['command']=='add' && $_REQUEST['productid'] > 0){
		 $pid=$_REQUEST['productid'];
		 $size = $_REQUEST['size'];
		 //alert($size);
		 $q=isset($_REQUEST['quantity']) ? (int)$_REQUEST['quantity'] : "1";
		 addtocart($pid,$q,$size);
		 redirect("http://$config_url/gio-hang.html");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes">
<base href="http://<?=$config_url?>/"  />
<meta name="author" content="TRUMSI" />
<link rel="shortcut icon" href="images/logo.png" type="image/x-icon">

<title>
	<?=$title_bar?>
    <?php if($com =='' || $com =='index' ||  $com =='trang-chu') { ?>
    <?=$row_title['ten']?>
    <?php } ?>
</title>

<?php if($_REQUEST['com']=='san-pham' && isset($_GET['id'])){?>
    <meta name="keywords" content="<?=$result_detail[0]['keyword']?>"/>
    <meta name="description" content="<?=$result_detail[0]['description']?>"/>
    <?php } else if($_REQUEST['com']=='san-pham' && isset($_GET['idl'])){ //echo $_GET['idl'];?>
    <meta name="keywords" content="<?=$loaitin[0]['keyword']?>"/>
    <meta name="description" content="<?=$loaitin[0]['description']?>"/>

   <?php }else if($_REQUEST['com']=='tin-tuc' && isset($_GET['id'])){?>
    <meta name="keywords" content="<?=$tintuc_detail[0]['keyword']?>"/>
    <meta name="description" content="<?=$tintuc_detail[0]['description']?>"/>

   <?php }else{ ?>
    <meta name="keywords" content="<?=$row_meta['keyword']?>" />
<meta name="description" content="<?=$row_meta['description']?>" />
    <?php }?>

<link rel="stylesheet" type="text/css" href="css/style.css"/>

<!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
<script language="javascript" type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<script src="bootstrap/js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="css/manhinh.css" />

	<script type="text/javascript" src="scripts/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="scripts/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<link type="text/css" rel="stylesheet" href="scripts/master/demo/css/demo.css" />
	<link type="text/css" rel="stylesheet" href="scripts/master/dist/css/jquery.mmenu.all.css" />
	<script type="text/javascript" src="scripts/master/dist/js/jquery.mmenu.min.all.js"></script>
	<script type="text/javascript">
		$(function() {
			$('nav#menu').mmenu();
		});
	</script>   

<link href="scripts/flexisel/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/flexisel/js/jquery.flexisel.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
         
            $('.fancybox').fancybox();

    
        });
</script>

	<link href="popup/utils-min.css" rel="stylesheet" type="text/css">
	<script src="popup/utils-min.js" type="text/javascript"></script>


<script  type="text/javascript" >
 $(window).load(function (){
	$(".xemgia").click(function(){
                messageDiaLog('Thông báo','Bạn vui lòng đăng nhập để xem giá.<br><br>Nếu chưa có tài khoản <a href="sigin.html">Đăng kí tại đây</a>','');
            })
	
});
	
</script>


</head>

<body>
<?php require "facebookphp/config.php";?>

<?php if($_REQUEST['com']=='san-pham' && isset($_GET['id'])){?>
    <h1 style="display:none"><?=$result_detail[0]['keyword']?></h1>
<?php } else if($_REQUEST['com']=='san-pham' && isset($_GET['idl'])){ ?>
	<h1 style="display:none"><?=$loaitin[0]['keyword']?></h1>
<?php }else if($_REQUEST['com']=='tin-tuc' && isset($_GET['id'])){ ?>
	<h1 style="display:none"><?=$tintuc_detail[0]['keyword']?></h1>
<?php }else{ ?>
    <h1 style="display:none"><?=$row_meta['keyword']?></h1>
<?php } ?>
<div class="top_header" style="display:none;">
        <div class="menu_t" style="max-width:1200px;min-height:42px;margin:0 auto;background:#fff;">
            	<a href="./"><img src="images/logo.png" alt="logo" style="float: left;height: 55px;padding: 5px 0px;"></a>
            <div class="dropdown" style="float: left;margin-top:3px;margin-left: 25px;">
			    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">DANH MỤC <img src="images/menu_t.png" alt="icon">
			   </button>

			    <ul class="dropdown-menu">
			      <li><a href="./">Trang chủ</a></li>
			      <li><a href="gioi-thieu.html">Về Trùm Sỉ</a></li>
			      <li><a href="san-pham/hang-co-san.html">Hàng có sẵn</a>
			       <?php
			            /*$d->reset();
			            $sql = "select * from #_product_cat where hienthi = 1 order by stt,id asc";
			            $d->query($sql);
			            $result_cat = $d->result_array();
			            */
			        ?>
			      		
			      </li>
			      <!-- <div style="margin-left: 30px;">
			      			<?php foreach ($result_cat as $cat) {?>
			      				<div><a href="san-pham/<?=$cat['tenkhongdau']?>.html"><?=$cat['ten']?></a></div>
			      				<h2 style="display: none"><?=$cat['ten']?></h2>
			      			<?php } ?>
			      			
			      		</div>  -->
			      <li><a href="san-pham/albums.html">Album</a></li>
			    
			      <li><a href="tin-tuc.html">Tin tức</a></li>
			     
			      <li><a href="thac-mac-va-huong-dan.html">Thắc mắc hướng dẫn</a></li>
			      <li><a href="lien-he.html">Góp ý</a></li>
			    </ul>
			 </div>
<!-- ############### --> 			 
            	<div id="tkiem">
                <? include _template."layout/tkiem.php" ?>
           		</div>
<!-- ############### -->           		
    <div style="float:right;line-height: 45px;">
    	<ul class="tophai">
    	<?php
			if(empty($_SESSION['mem_login']['mem_mail'])){
		?>
    		<li class="dropdown" id="menuLogin">
		         
		            <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Đăng nhập</a>
		            <div class="dropdown-menu" style="padding:17px 35px;">
		              <form class="form" id="formLogin"> 
		                <input style="width: 100%" name="email_login" id="txt_email_login1" type="text" placeholder="Email">
		                <p class="error_email_head1 spcolor"></p>
		                <input style="width: 100%;margin-top: 10px;" name="pass_login" id="txt_password_login1" type="password" placeholder="Password">
		                <p class="error_password_head1 spcolor"></p>
		                <button onclick="login_head1()" type="button" id="btnLogin" class="btn" style="width: 100%;margin-top: 10px;">Đăng nhập</button>
		                <p class="error_common_head1 spcolor"></p>
		                <div style="width: 100%;margin-top: 5px;"><span style="float: left;"><a class="hover1" href="quen-mat-khau.html">Quên mật khẩu ?</a></span><span style="float: right;"><a class="hover1" href="sigin.html">Đăng kí ?</a></span></div>
		              </form>
		            </div>
		         
		        
    		</li>
    		<li>
    			<?php 
			$fbuser = null;
			$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
			$output = '<a href="'.$loginUrl.'"><img src="images/loginface.png" alt="icon"></a>';
				echo $output;
			?>
    		</li>
    		<?php }else{?>
    		<li>Chào,<a href="cap-nhat-tai-khoan.html" class="hover1"><?=$_SESSION['mem_login']['mem_mail']?></a> - <a href="thoat.html" class="hover1">Thoát</a></li>
    		<?php } ?>
    		<li><a href="gio-hang.html"><img src="images/giohang.png" alt="icon" style="margin-right: 5px;">Giỏ hàng <span style="color:#ffae00;font-weight: bold;">(<?=count($_SESSION['cart'])?>)</span></a></li>
    	</ul>
    </div>
 <!-- ###############end menu top -->               
            
        </div>
</div>
<?php
    $d->reset();
    $sql = "select * from #_hotline where hienthi = 1 ";
    $d->query($sql);
    $phone = $d->fetch_array();
    
?>

<script type="text/javascript">
var num = 30; 
$(window).bind('scroll', function () {
    if ($(window).scrollTop() > num) {
        $('.tophaimobile').addClass('fixxed');
    } else {
        $('.tophaimobile').removeClass('fixxed');
    }
});
</script>
<style type="text/css" media="screen">
	.tophaimobile{width:100%;display: none;padding-top:5px;}
	.tophaimobile ul > li{display: inline-block;}
	.fixxed{
    position: fixed;
    top:0 ;
    width: 100%;
    z-index: 1001;
    background: #fff;
    box-shadow:3px 3px 5px #515151;
  }
</style>
	<div class="tophaimobile" align="center">
    	<ul>
    	<?php
			if(empty($_SESSION['mem_login']['mem_mail'])){
		?>
    		<li class="dropdown" id="menuLogin">
		         
		            <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Đăng nhập</a>
		            <div class="dropdown-menu" style="padding:17px 35px;">
		              <form class="form" id="formLogin"> 
		                <input style="width: 100%" name="email_login" id="txt_email_login2" type="text" placeholder="Email">
		                <p class="error_email_head2 spcolor"></p>
		                <input style="width: 100%;margin-top: 10px;" name="pass_login" id="txt_password_login2" type="password" placeholder="Password">
		                <p class="error_password_head2 spcolor"></p>
		                <button onclick="login_head2()" type="button" id="btnLogin" class="btn" style="width: 100%;margin-top: 10px;">Đăng nhập</button>
		                <p class="error_common_head2 spcolor"></p>
		                <div style="width: 100%;margin-top: 5px;"><span style="float: left;"><a class="hover1" href="quen-mat-khau.html">Quên mật khẩu ?</a></span><span style="float: right;"><a class="hover1" href="sigin.html">Đăng kí ?</a></span></div>
		              </form>
		            </div>
		         
		        
    		</li>
    		<li>
    			<?php 
			$fbuser = null;
			$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
			$output = '<a href="'.$loginUrl.'"><img src="images/loginface1.png" alt="icon" style="border-radius:3px;"></a>';
				echo $output;
			?>
    		</li>
    		<?php }else{?>
    		<li>Chào,<a href="cap-nhat-tai-khoan.html" class="hover1"><?=$_SESSION['mem_login']['mem_mail']?></a> - <a href="thoat.html" class="hover1">Thoát</a></li>
    		<?php } ?>
    		<li><a href="gio-hang.html"><img src="images/giohang.png" alt="icon" style="margin-right: 5px;">Giỏ hàng <span style="color:#ffae00;font-weight: bold;">(<?=count($_SESSION['cart'])?>)</span></a></li>
    	</ul>
    </div>
<div id="page" style="display:none;">
			<div class="header">
				<a href="#menu"></a>
				<?//=$phone['dienthoai']?> 
				<div style="width: 100%;font-size: 13px;">(Ms.Thu)(0948.011.101)</div> 
			</div>
			
			<nav id="menu">
				<ul>
					<li><a href="./">Trang chủ</a></li>
					<li><a href="gioi-thieu.html">Về Trùm Sỉ</a></li>
					<li><a href="tin-tuc.html">Tin tức</a></li>
<?php
	$d->reset();
	$sql = "select * from #_product_cat where hienthi = 1 order by stt,id asc";
	$d->query($sql);
	$result = $d->result_array();
	foreach ($result as $k => $v) {
		
?>
					<li><a href="san-pham/<?=$v['tenkhongdau']?>.html"><?=$v['ten'];?></a>
						<ul>
						<?php 
							$d->reset();
							$sql = "select * from #_product_list where hienthi = 1 and id_cat=".$v['id']." order by stt,id asc";
							$d->query($sql);
							$result1 = $d->result_array();
							foreach ($result1 as $k1 => $v1) {
								$d->reset();
								$sql = "select * from #_product_item where hienthi = 1 and id_list=".$v1['id']." order by stt,id asc";
								$d->query($sql);
								$result11 = $d->result_array();
						?>
							<li><a href="san-pham/<?=$v['tenkhongdau']?>/<?=$v1['tenkhongdau']?>/<?=$v1['id']?>.html"><?=$v1['ten']?></a>
							<?php if(count($result11)>0){?>
								<ul>
								<?php foreach ($result11 as $k11 => $v11) { ?>
									<li>
										<a href="san-pham/<?=$v['tenkhongdau']?>/<?=$v1['tenkhongdau']?>/<?=$v11['tenkhongdau']?>/<?=$v11['id']?>.html"><?=$v11['ten']?></a>
									</li>
								<?php } ?>	
								</ul>
							<?php } ?>		
							</li>
						<?php } ?>	
						</ul>
					</li>
	<?php } ?>				
				  
			      <li><a href="thac-mac-va-huong-dan.html">Thắc mắc hướng dẫn</a></li>
		
					<li><a href="lien-he.html">Góp ý</a></li>
				</ul>
			</nav>
</div>
<style type="text/css">
 .search1 {
   background:#fff;
    border:1px solid #e5e5e5;
	
    float: left;
    height: 36px;
    max-width: 320px;
    margin-right:40px;
   
}
 	.lableTextForm {
    clear: left;
    float: left;
    padding: 4px 5px;
    text-align: left;
    width: 267px;
}
.classInputText {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: medium none;
    color: #aaa;
    font-size: 12px;
   
    width: 267px;
}
.lableButton {
    display: block;
    float: left;
 	height:25px;
    text-align: center;
    width: 30px;
}

.tophai li{
	display:inline-block;
	margin-left: 10px;
	line-height: 31px;
}
.tophai li a{
	color:#2b2b2b;
}
 </style>

<div style="background: url(images/topcat.png) repeat-x;height:45px;">
	<div class="tophaidesk" style="width:1200px;margin:0 auto;">
	<div class="searchdesk" style="padding: 3px 7px;background: #9b9b9b;border-radius: 0px 0px 5px 5px;width:415px;overflow: hidden;float: left;margin-left: 190px;">
		<div class="search1">	
 			<div class="lableTextForm">	
        		<input class="classInputText"  id="keyword1" type="text" name="keyword1" placeholder="Nhập tên sản phẩm..." />
            </div>
            <div class="lableButton">
            <!-- <input id="search-button" type="submit" onclick="searchProduct()" title="Tìm kiếm" value="Tìm"> -->
            	<a onclick="searchProduct1()" style="cursor:pointer;"><img style="vertical-align:top;margin-top: -1px;margin-left:35px;" src="images/tk.png"></a>
            </div>
        </div>
    </div>

    <div class="dky" style="float:right;">
    	<ul class="tophai">
    		<?php
			if(empty($_SESSION['mem_login']['mem_mail'])){
		?>
    		<li class="dropdown" id="menuLogin"><!-- <a href="#">Đăng nhập</a> -->
	    		
		         
		            <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Đăng nhập</a>
		            <div class="dropdown-menu" style="padding:17px 35px;">
		              <form class="form" id="formLogin"> 
		                <input style="width: 100%" name="email_login" id="txt_email_login" type="text" placeholder="Email">
		                <p class="error_email_head spcolor"></p>
		                <input style="width: 100%;margin-top: 10px;" name="pass_login" id="txt_password_login" type="password" placeholder="Password">
		                <p class="error_password_head spcolor"></p>
		                <button onclick="login_head()" type="button" id="btnLogin" class="btn" style="width: 100%;margin-top: 10px;">Đăng nhập</button>
		                <p class="error_common_head spcolor"></p>
		                <div style="width: 100%;margin-top: 5px;"><span style="float: left;"><a class="hover1" href="quen-mat-khau.html">Quên mật khẩu ?</a></span><span style="float: right;"><a class="hover1" href="sigin.html">Đăng kí ?</a></span></div>
		              </form>
		            </div>
		         
		        
    		</li>
    		<li>
    		
			<?php 
			$fbuser = null;
			$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
			$output = '<a href="'.$loginUrl.'"><img src="images/loginface.png" alt="icon"></a>';
				echo $output;
			?>

			</li>
    		<?php }else{?>
    		<li>Chào,<a href="cap-nhat-tai-khoan.html" class="hover1"><?=$_SESSION['mem_login']['mem_mail']?></a> - <a href="thoat.html" class="hover1">Thoát</a></li>
    		<?php } ?>
    		
    		<li><a href="gio-hang.html"><img src="images/giohang.png" alt="icon" style="margin-right: 5px;">Giỏ hàng <span style="color:#fff;font-weight: bold;">(<?=count($_SESSION['cart'])?>)</span></a></li>
    	</ul>
    </div>
    </div>    

</div>
</div>
<div class="container">    
<!--<style type="text/css">
	.gh_hover{position:fixed; z-index:999999;margin-top:150px; background:#fff;padding:10px; border-radius:5px;box-shadow: 0 0 5px #dbdbdb;right:0px;width: 50px;height:50px;overflow: hidden;transition: width 0.5s linear;}
	.gh_hover span{display: none;}
	.gh_hover:hover{width: 120px;height:50px;}
	.gh_hover:hover span{display:block;}
</style>-->	
    <div class="clear"></div>
	<!-- <div id="wrapper"> -->
	 <!-- <div class="gh_hover" style=" ">
		<a href="gio-hang.html" style="color:#616161;"><img src="images/giohang.png" width="30" height="30" style="float:left;margin-right: 5px;" /><span style="float:left;">Giỏ hàng</span></a>
	</div> -->
<!-- </div> -->

    	<div id="header">
        
            <? include _template."layout/header.php" ?>
        </div>
        <!-- <div id="menu_m">
             <? //include _template."layout/menu.php" ?>
        </div> -->
        <div class="clear"></div>
       	<?php if($com =='' || $com =='index' ||  $com =='trang-chu') { ?>
                <div id="slider_m">
                 <? include _template."layout/slider.php" ?>
           		</div>
                <?php } ?>
        <div class="clear"></div>        
          <div id="contain_m">
        	<!-- <div id="left">
            	 <? //include _template."layout/left.php" ?>
            </div> -->
            <!-- <div id="contain"> -->
            <!-- ################# -->
            <?php
    if(($com == 'san-pham' && $_GET['idc'] == 'albums') || ($com == 'san-pham' && $_GET['idct'] == 'albums') || ($com =='' || $com =='index' ||  $com =='trang-chu')){        
    $d->reset();
    $sql_sp="select * from #_product_list where hienthi=1 and hot = 1 and id_cat = 16 order by stt, id asc ";
    $d->query($sql_sp);
    $sp_list=$d->result_array();

    /*$d->reset();
    $sql_sp="select * from #_product_cat where hienthi=1 and hot = 1 order by stt, id asc ";
    $d->query($sql_sp);
    $cat=$d->result_array();*/
?>

<link rel="stylesheet" type="text/css" href="scripts/owl/owl-carousel/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="scripts/owl/owl-carousel/owl.theme.css" />
<script type="text/javascript" src="scripts/owl/owl-carousel/owl.carousel.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
 
  $("#owl-demotab1").owlCarousel({
 
      autoPlay: 5000, //Set AutoPlay to 3 seconds
 
      items : 4,
      itemsDesktop : [1199, 3],
      itemsDesktopSmall : [979, 2],
      itemsTablet : [768, 2],
      
      itemsMobile : [479, 1],
      
      navigation : true,
      navigationText : ["<img src='images/prev.png' alt='icon'>","<img src='images/next.png' alt='icon'>"],
      rewindNav : true,
      scrollPerPage : false,
      pagination : false,  
  });
 
});
</script>
<style type="text/css" media="screen">
.owl-theme .owl-controls .owl-buttons div {
    color: #FFF;
    display: inline-block;
    zoom: 1;
    margin: 5px;
    padding: 0px;
    font-size: 12px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px;
    background: none;
    filter: Alpha(Opacity=50);
    opacity: 0.5;
}
.owl-theme .owl-controls .owl-buttons .owl-prev{
    position: absolute;
    top:-55px;
    left:0px;
}

.owl-theme .owl-controls .owl-buttons .owl-next{
    position: absolute;
    top:-55px;
    right:0px;
}
   #owl-demotab1 .item{position: relative;}
   .title_tc{    
    font-size: 18px;
    font-family: opensans_b;
    background: rgba(52, 54, 54, 0.6);
    position: absolute;
    bottom: 0px;
    left:0px;
    padding: 10px;
    width: 259px;
    z-index:100;
}   
    .aaaa{display: none;position:absolute;width: 255px;height: 268px;background: rgba(0,0,0,0.6);z-index: 101;top:2px;left:2px;}
    .title_tchover{
        font-size: 18px;
        font-family: opensans_b;
        background: rgba(252, 213, 30, 0.6);
        position: absolute;
        bottom: 40%;
        padding: 10px;
        width: 259px;
        left:0px;
    }
    .imgdmtc{z-index:99;}
    .item:hover .aaaa{display:block !important;}
    .item:hover .title_tc{display:none !important;}
    .item:hover .imgdmtc{border:2px solid #fcd51e !important;}
</style>
<div style="width: 100%;font-size: 20px;margin-bottom: 20px;" align="center">DANH MỤC SẢN PHẨM</div>
<div id="owl-demotab1" >
<?php foreach ($sp_list as $kl => $vl) { ?>
    

    <div class="item" align="center">
        <div style="width: 259px;height: 280px;position: relative;" >
            <img class="imgdmtc" src="<?=_upload_sanpham_l.$vl['photo'];?>" alt="sp" style="width: 259px;height: 272px;border:2px solid #b6b6b6;box-shadow: 3px 3px 5px #515151;">

            <div style="width: 100%;position: relative;" align="center"> 
            <span class="title_tc"><div style="width: 100%;text-align: center;">
            <a style="color:#fff;" href="san-pham/albums/<?=$vl['tenkhongdau']?>/<?=$vl['id']?>.html"><?=$vl['ten']?></a></div></span>       
            </div>  
            <div class="aaaa" align="center">
                <span class="title_tchover"><div style="width: 100%;text-align: center;">
                <a style="color:#fff;" href="san-pham/albums/<?=$vl['tenkhongdau']?>/<?=$vl['id']?>.html"><?=$vl['ten']?></a></div></span>
            </div>
        </div>   
    </div>
    <!-- ############## -->
<?php } ?>
</div>   
<div class="clear"></div>	
<?php } ?>
            <!-- ################# -->	
                	 <? include _template.$template."_tpl.php" ?> 
               
            <!-- </div> -->
            
        </div> 
        <div class="clear"></div>
        <? //include _template."layout/doitackhachhang.php" ?>
       
        <?php //include _template . "quangcao.php"; ?> 
    </div>
   
<div id="footer">
 <? include _template."layout/footer.php" ?>
 <? include _template."layout/backtotop.php" ?>
</div>



<div style="background: #bebebe;line-height: 30px; height: 30px;" align="center">
	<a style="font-size:13px;font-weight:normal;color:#535353;font-family:opensans_b;"  target="_blank"> Copyright &copy; 2016 TRUMSI - DESIGN BY PTIT</a>
    
</div>   
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<?php if(($_GET['idc'] != 'hang-co-san') && ($_GET['idct'] != 'hang-co-san')){?>
<ul class="listdm">
	<?php
		$sql = "select * from table_product_list where id_cat = 19 order by stt,id asc";
		$d->query($sql);
		$rowlist = $d->result_array();
	foreach ($rowlist as $kldm => $vldm) { ?>
			<li data-toggle="tooltip" title="<?=$vldm['ten']?>"><a  href="san-pham/hang-co-san/<?=$vldm['tenkhongdau']?>/<?=$vldm['id']?>.html" title="<?=$vldm['ten']?>"><img style="width: 25px;" src="<?=_upload_sanpham_l.$vldm['thumb']?>" alt="<?=$vldm['ten']?>"></a></li>
	<?php } ?>

</ul>
<?php } ?>
<script type="text/javascript">
 function login_head(){
 	
			$('.error_email_head').html('');
			$('.error_password_head').html('');
			$('.error_common_head').html('');
			var coloi=0;
			var email=$('#txt_email_login').val();
			var password=$('#txt_password_login').val();
				if( email.length === 0 ) {
					$('.error_email_head').text('Yêu cầu nhập email');
					coloi=1;
				}
				if( password.length === 0 ) {
					$('.error_password_head').text('Yêu cầu nhập password');
					coloi=1;
				}
				if(coloi==0){
					var islogin=1;
					$.ajax({
		
					url: "sources/loginprocess.php",
					type: "post",
					cache: false,
					data: {email_login:email , pass_login:password, islogin:islogin},
					success: function(result){
							var data= $.parseJSON(result);
							$('.error_common_head').text(data.notecommon);
							if(data.success == 1){
								//$('.div_login_head').css('display','none');
								 location.reload();
							}
						
					}
				});
			}
		}
	function login_head1(){
 	
			$('.error_email_head1').html('');
			$('.error_password_head1').html('');
			$('.error_common_head1').html('');
			var coloi=0;
			var email=$('#txt_email_login1').val();
			var password=$('#txt_password_login1').val();
				if( email.length === 0 ) {
					$('.error_email_head1').text('Yêu cầu nhập email');
					coloi=1;
				}
				if( password.length === 0 ) {
					$('.error_password_head1').text('Yêu cầu nhập password');
					coloi=1;
				}
				if(coloi==0){
					var islogin=1;
					$.ajax({
		
					url: "sources/loginprocess.php",
					type: "post",
					cache: false,
					data: {email_login:email , pass_login:password, islogin:islogin},
					success: function(result){
							var data= $.parseJSON(result);
							$('.error_common_head1').text(data.notecommon);
							if(data.success == 1){
								//$('.div_login_head').css('display','none');
								 location.reload();
							}
						
					}
				});
			}
		}

		function login_head2(){
 	
			$('.error_email_head2').html('');
			$('.error_password_head2').html('');
			$('.error_common_head2').html('');
			var coloi=0;
			var email=$('#txt_email_login2').val();
			var password=$('#txt_password_login2').val();
				if( email.length === 0 ) {
					$('.error_email_head2').text('Yêu cầu nhập email');
					coloi=1;
				}
				if( password.length === 0 ) {
					$('.error_password_head2').text('Yêu cầu nhập password');
					coloi=1;
				}
				if(coloi==0){
					var islogin=1;
					$.ajax({
		
					url: "sources/loginprocess.php",
					type: "post",
					cache: false,
					data: {email_login:email , pass_login:password, islogin:islogin},
					success: function(result){
							var data= $.parseJSON(result);
							$('.error_common_head2').text(data.notecommon);
							if(data.success == 1){
								//$('.div_login_head').css('display','none');
								 location.reload();
							}
						
					}
				});
			}
		}	

	  	function locdau(str) {  
		str= str.toLowerCase();  
		str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");  
		str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");  
		str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");  
		str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");  
		str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");  
		str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");  
		str= str.replace(/đ/g,"d");  
		str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-"); 
		/* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */ 
		str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1- 
		str= str.replace(/^\-+|\-+$/g,"");  
		//cắt bỏ ký tự - ở đầu và cuối chuỗi  
		return str;  
		}   
		$('#keyword').keypress(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == '13'){
				//alert('Bạn vừa nhấn phím "enter" trong thẻ input');    
				searchProduct();
			}
		});

		$('#keyword1').keypress(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == '13'){
				//alert('Bạn vừa nhấn phím "enter" trong thẻ input');    
				searchProduct1();
			}
		});
		
		function searchProduct(){
			var name_search = locdau($('#keyword').val());
			//alert(name_search);
			if(name_search=='')
				{
					 alert('Keyword is wrong!');
					 document.getElementById('keyword').value='';
					document.getElementById('keyword').focus();
					
				}
			else if(($('#keyword').val()).trim() != '' )
			window.location = 'tim-kiem/' + name_search;
			else
			alert('Please input information !');
		}

		function searchProduct1(){
			var name_search = locdau($('#keyword1').val());
			//alert(name_search);
			if(name_search=='')
				{
					 alert('Keyword is wrong!');
					 document.getElementById('keyword1').value='';
					document.getElementById('keyword1').focus();
					
				}
			else if(($('#keyword1').val()).trim() != '' )
			window.location = 'tim-kiem/' + name_search;
			else
			alert('Please input information !');
		}
</script>          
</body>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/56dce9e289de54b41e946421/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</html>
