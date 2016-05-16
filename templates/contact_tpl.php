<script language="javascript" src="admin/media/scripts/my_script.js"></script>
<script language="javascript">
function js_submit(){
	if(isEmpty(document.getElementById('ten'), "Xin nhập Họ tên.")){
		document.getElementById('ten').focus();
		return false;
	}
	
	if(isEmpty(document.getElementById('diachi'), "Vui lòng nhập địa chỉ")){
		document.getElementById('diachi').focus();
		return false;
	}
	
	if(isEmpty(document.getElementById('dienthoai'), "Xin nhập Số điện thoại.")){
		document.getElementById('dienthoai').focus();
		return false;
	}
	
	if(!isNumber(document.getElementById('dienthoai'), "Số điện thoại không hợp lệ.")){
		document.getElementById('dienthoai').focus();
		return false;
	}
	
	if(!check_email(document.frm.email.value)){
		alert("Email không hợp lệ");
		document.frm.email.focus();
		return false;
	}
	
	if(isEmpty(document.getElementById('tieude1'), "Xin nhập Chủ đề.")){
		document.getElementById('tieude1').focus();
		return false;
	}
	
	if(isEmpty(document.getElementById('noidung'), "Xin nhập Nội dung.")){
		document.getElementById('noidung').focus();
		return false;
	}
	
	document.frm.submit();
}
</script>
<?php $sql = "select * from #_lienhe limit 0,1";
	$d->query($sql);
	$item = $d->fetch_array();
	?>
<div class="title"> 
	<div style="float:left;font-size:20px;font-weight:bold;text-transform:uppercase;color:#7d7d7d;border-bottom:3px solid #dc241a;"><img src="images/ico1.png" alt="gt" style="vertical-align: middle;margin-right: 10px;">Góp ý</div>
    
</div>
<div class="clear"></div>
  
   <div class="content-deteil"  style="min-height: 100px;overflow: hidden;padding: 10px;border:1px solid #d0d0d0">
       <div class="box_contact_l" align="center">
          	<?=$item['noidung'];?>       
       </div>
       <div class="box_contact_r" style="width: 100%;min-height:100px " >  
	<form method="post" name="frm" action="lien-he.html">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7" >
		<div class="row" >								
																
		<div class="form-group">
                  <span>Họ và tên</span>
                  <input  class="form-control" id="ten" name="ten" value="<?=$_SESSION['tencty']?>"> 
        </div>
        <div class="form-group">
                  <span>Địa chỉ</span>
                  <input  class="form-control" id="diachi" name="diachi" value="<?=$_SESSION['diachi']?>"> 
        </div>
        <div class="form-group">
                  <span>Số điện thoại</span>
                  <input  class="form-control" id="dienthoai" name="dienthoai" value="<?=$_SESSION['dienthoai']?>"> 
        </div>
        <div class="form-group">
                  <span>Email</span>
                  <input  class="form-control" id="email" name="email" value="<?=$_SESSION['email']?>"> 
        </div>
        <div class="form-group">
                  <span>Chủ đề</span>
                  <input  class="form-control" id="tieude1" name="tieude1" value="<?=$_SESSION['tieude1']?>"> 
        </div>
        <span>Nội dung</span>
            <textarea class="form-control" rows="6" name="noidung" id="noidung"><?=$_SESSION['noidung']?></textarea>
            </div>
        <input class="button" type="button" value="Gửi" onclick="js_submit();" style="border:none;background:#38459c;padding:5px 45px;cursor:pointer;color:#fff;margin:10px 0px;" /> <input class="button" type="button" value="Nhập lại" onclick="document.frm.reset();" style="border:none;background:#38459c;padding:5px 45px;cursor:pointer;color:#fff;" />       
        </div>

     <div   class="col-xs-12 col-sm-5 col-md-5 col-lg-5" >
		<div class="row" >							            
            
		<div class="clear"></div>
                <div>
                <center>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.266969018677!2d106.6834193144859!3d10.790853261878723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528d2dbb832d1%3A0xd65d01c42b2f346c!2zNjAvMzcgTMO9IENow61uaCBUaOG6r25nLCBwaMaw4budbmcgOCwgUXXhuq1uIDMsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1456211060578" width="100%" height="500px" frameborder="0" style="border:0" allowfullscreen></iframe>
                </center>   
                </div>
</div></div>   
    </div>	     
	</form>

	</div>

 
               
               
               
               