<style>
	#footer ul li{
		float:left; padding:10px 20px;
	}
	#footer li a{
		padding:0 5px;
		color:#FFF;
		font-weight:bold;
	}
	#footer li a:hover{
		/*background:url(images/menu_m_act.png);
		background-size:100% 100%;
		padding:5px 5px;
		color:#000;*/
	}
	#footer .act2 a{
		background:url(images/menu_m_act.png);
		background-size:100% 100%;
		padding:5px 5px;
		color:#000;
	}
	#linkp{
		width:210px;
		line-height:25px;
		background:#c99d03;
		float:right;
		margin-right:10px;
		margin-bottom:5px;
		padding-left:10px;
		 border-radius: 5px;
    	-moz-border-radius: 5px;
    	-webkit-border-radius: 5px;
    	-ms-border-radius: 5px;
   	 	-o-border-radius: 5px;
	}
	#linkp a{
		color:#FFF;
	}
</style>
<?php 
$d->reset();
$sql="select* from table_footer where hienthi=1";
$d->query($sql);
$result=$d->fetch_array();

?>

<?php //include _template."layout/doitackhachhang.php"; ?>
<div class="clear"></div>
<div class="foot_c" style="min-height:100px; width:1200px;margin:0 auto;" >
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div style="font-size: 22px;font-family:opensans_r;color:#fff;margin-bottom: 10px;border-bottom: 1px solid #fff;">LIÊN HỆ TRÙM SỈ</div>
	<?=$result['noidung']?>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div style="font-size: 22px;font-family:opensans_r;color:#fff;margin-bottom: 10px;border-bottom: 1px solid #fff;">BẢN ĐỒ</div>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.266969018677!2d106.6834193144859!3d10.790853261878723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528d2dbb832d1%3A0xd65d01c42b2f346c!2zNjAvMzcgTMO9IENow61uaCBUaOG6r25nLCBwaMaw4budbmcgOCwgUXXhuq1uIDMsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1456211060578" width="240" height="230" frameborder="0" style="border:0" allowfullscreen></iframe>
	
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div style="font-size: 22px;font-family:opensans_r;color:#fff;margin-bottom: 10px;border-bottom: 1px solid #fff;">ĐĂNG KÝ NHẬN TIN</div>
<script language="javascript" src="admin/media/scripts/my_script.js"></script>
 <script language="javascript">
 	function js_submit1(){
 		if(!check_email(document.frm1.email.value)){
			alert("Invalid email");
			document.frm1.email.focus();
			return false;
		}
		document.frm1.submit();
 	}
 </script>
	<form method="post" name="frm1" action="lien-he.html">
			<input style="width:65%;padding:5px 10px;color:#898989;margin-top: 8px;border:1px solid #898989;outline: none;" type="text" name="email"  placeholder="Nhập email của bạn">
			<input style="margin-top: 10px;background:#fcb01e;color:#fff;padding:4px 15px;" class="button" type="button" value="Nhận tin" onclick="js_submit1();" />
		</form>
	<!-- <div style="line-height: 30px;"> -->
		
		<!-- <div><a style="color:#d0d0d0" href="tuyen-dung.html">Tuyển dụng</a></div> -->
	<?php 
	/*$d->reset();
	$sql="select * from table_giaitri where hienthi=1 order by stt desc";
	$d->query($sql);
	$result_ht=$d->result_array();*/
	//foreach ($result_ht as $kht => $vht) {
?>	
	<!-- <div><a style="color:#d0d0d0" href="ho-tro/<?=$vht['tenkhongdau']?>/<?=$vht['id']?>.html"><?=$vht['ten']?></a></div> -->
<?php // } ?>	
	<!-- </div> -->
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div style="font-size: 22px;font-family:opensans_r;color:#fff;margin-bottom: 10px;border-bottom: 1px solid #fff;">FANPAGE FACEBOOK</div>
<?php 
	$sql="select * from #_company";
	$d->query($sql);
	$result_fan=$d->fetch_array();
?>	

		<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like-box" data-href="<?=$result_fan['taikhoang'];?>" data-width="240" data-height="240" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>	
<?php 
	/*$d->reset();
	$sql="select* from table_lkweb where hienthi=1 limit 0,5";
	$d->query($sql);
	$result_lk=$d->result_array();*/
	/*foreach ($result_lk as $k => $v) {*/
?>	
	<!-- <a href="<?=$v['url']?>"><img style="width:38px;height: 38px;" src="<?=_upload_hinhanh_l.$v['image']?>" alt="lk"></a> -->
<?php //} ?>
	<!-- <div style="font-size: 22px;font-family: utmavo;color:#fff;margin-bottom: 10px;font-weight: bold;border-bottom: 1px solid #fff;margin-top: 10px;">THỐNG KÊ TRUY CẬP</div>
	<div style="color: #fff;margin-top: 15px;">
	<img src="images/ónl.png" /><span style="color:#d0d0d0"> Đang Online: </span>
		<strong><big><? $count=count_online(); echo $count['dangxem']?></big></strong>
	<img src="images/ònl.png" style="margin-left: 20px;" /><span style="color:#d0d0d0"> Tổng truy cập: </span> 
		<strong><big><?=$count['daxem']?></big></strong>	
	</div> -->
</div>  
 <div class="clear"></div> 

</div>
