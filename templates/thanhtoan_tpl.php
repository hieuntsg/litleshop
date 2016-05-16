<script type="text/javascript">
function validEmail(obj) {
	var s = obj.value;
	for (var i=0; i<s.length; i++)
		if (s.charAt(i)==" "){
			return false;
		}
	var elem, elem1;
	elem=s.split("@");
	if (elem.length!=2)	return false;

	if (elem[0].length==0 || elem[1].length==0)return false;

	if (elem[1].indexOf(".")==-1)	return false;

	elem1=elem[1].split(".");
	for (var i=0; i<elem1.length; i++)
		if (elem1[i].length==0)return false;
	return true;
}//Kiem tra dang email
function IsNumeric(sText)
{
	var ValidChars = "0123456789";
	var IsNumber=true;
	var Char;

	for (i = 0; i < sText.length && IsNumber == true; i++) 
	{ 
		Char = sText.charAt(i); 
		if (ValidChars.indexOf(Char) == -1) 
		{
			IsNumber = false;
		}
	}
	return IsNumber;
}//Kiem tra dang so
function check()
		{
			var frm 	= document.frm_order;
			
			if(frm.ten.value=='') 
			{ 
				alert( "Bạn chưa điền họ tên." );
				frm.ten.focus();
				return false;
			}
			if(frm.dienthoai.value=='') 
			{ 
				alert( "Bạn chưa điền điện thoại." );
				frm.dienthoai.focus();
				return false;
			}
			if(frm.diachi.value=='') 
			{ 
				alert( "Bạn chưa điền địa chỉ." );
				frm.diachi.focus();
				return false;
			}
			
			if(frm.email.value=='') 
			{ 
				alert( "Bạn chưa điền email." );
				frm.email.focus();
				return false;
			}
			if(!validEmail(frm.email)){
				alert('Vui lòng nhập đúng địa chỉ email');
				frm.email.focus();
				return false;
			}												
			frm.submit();		
		}	
</script>
<?php 
	if(empty($_SESSION['mem_login']['mem_mail'])){
	echo "Bạn chưa đăng nhập.<br><br>";
	echo "Nếu chưa có tài khoản vui lòng <a href='sigin.html'>đăng kí tại đây</a>";
}
else{
/*##########################################*/
?>
<div class="title"> 
	<div style="float:left;font-size:20px;font-weight:bold;text-transform:uppercase;color:#7d7d7d;border-bottom:3px solid #ffae00;margin-bottom:10px;"><img src="images/ico1.png" alt="gt" style="vertical-align: middle;margin-right: 10px;">Thanh toán</div>
</div>
<div class="clear"></div>

           <table border="0" cellpadding="5px" cellspacing="1px" style="font-size:14px; background-color:#E1E1E1; padding:5px;" width="100%">
    	<?php
			if(is_array($_SESSION['cart'])){
		?>		
            	<tr bgcolor="#ffae00" style="font-weight:bold;color:#FFF;font-family:opensans_b;">
                	<td style="padding:10px" align="center">STT</td>
                    <td style="padding:10px" align="center">Tên</td>
                    <td style="padding:10px" align="center">Giá</td>
                    <td style="padding:10px" align="center">Số lượng</td>
                    <td style="padding:10px" align="center">Tổng giá</td>
                </tr>
		<?php
        		$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$size=$_SESSION['cart'][$i]['size'];
					$q=$_SESSION['cart'][$i]['qty'];				
					$pname=get_product_name($pid);
					$imgsp = get_img($pid);
					if($q==0) continue;
			?>
            		<tr <?php if(($i+1)%2 != 0){?> bgcolor="#FFFFFF" <?php }else{?>
            		bgcolor="#e1e1e1" <?php } ?>><td  align="center"><?=$i+1?></td>
            		<td style="padding:10px" align="center"><img src="<?=_upload_sanpham_l.$imgsp;?>" alt="sp" style="width: 60px;"><br><?=$pname?></td>
                    <td style="padding:10px"  align="center"><?=doitien(get_price($pid))?></td>
                    <td style="padding:10px"  align="center"><?=$q?>
                    	<br>
                    Size: <span style="font-family:opensans_b;"><?=$size;?></span>
                    </td>                    
                    <td style="padding:10px"  align="center"><span style="font-family:opensans_b"><?=doitien(get_price($pid)*$q)?></span></td>                  
            		</tr>
            <?					
				}
			?>
				<tr>
				<td  colspan="5" style="background-color: #ffae00;padding: 15px;">
             
                Tổng giá bán: <span style="font-family:opensans_b"><?=number_format(get_order_total(),0, ',', '.')?>&nbsp;VNĐ</span></td>
                 
                </tr>
			<?
            }
			else{
				echo "<tr bgColor='#FFFFFF'><td>Không có sản phẩm nào trong giỏ hàng!</td>";
			}
		?>
        </table>
        <br />
 <?php if($_SESSION['cart'] !=''){?>       
    <form method="post" name="frm_order" action="" enctype="multipart/form-data" onsubmit="return check();">
    <div style="width:100%;" align="center">          
    <table width="60%" cellpadding="5" cellspacing="5" border="0" class="tablelienhe" align="center">   
      <tr>
        <td colspan="2" align="center"><h2 style="font-family:opensans_b;text-transform: uppercase;font-size: 17px;">Nhập thông tin khách hàng</h2></td>                
      </tr>
      <tr><td>&nbsp;</td></tr>
      <tr >
        <td >Họ tên<span style="color: red">*</span></td>        
        <td><input style="padding:5px;width:100%;" name="ten" id="ten" class="input" value="<?=$_SESSION['mem_login']['name']?>" /></td>
      </tr>
      
      <tr>
        <td>Điện thoại<span style="color: red">*</span></td>
        <td><input style="padding:5px;width:100%;" name="dienthoai" id="dienthoai" class="input" value="<?=$_SESSION['mem_login']['phone']?>" /></td>
      </tr>
      
      <tr>
        <td>Địa chỉ<span style="color: red">*</span></td>
        <td><input style="padding:5px;width:100%;"  name="diachi"  id="diachi" class="input"  value="<?=$_SESSION['mem_login']['address']?>"/></td>
       </tr>
       <tr>
        <td>E-mail<span style="color: red">*</span></td>
        <td><input style="padding:5px;width:100%;" name="email" id="email" class="input"  value="<?=$_SESSION['mem_login']['mem_mail']?>"/></td>
      </tr>     
      <tr>
        <td>Nội dung</td>
        <td><textarea name="noidung"   rows="5" style="background-color:#FFFFFF; color:#666666;width:100%;"  ><?=$_POST['noidung']?></textarea></td>
        </tr>               
    </table>
	</div>
    <div style="text-align: center; padding-top:20px;">
    <input type="button" value="Mua tiếp" onclick="window.location='http://<?=$config_url?>/san-pham.html'" style="padding:10px;border:none;background:#404042;color:#fff;cursor:pointer;">
	<!--<input title='tiếp tục' class="button" type="submit" name="next" value="Tiếp tục" style="cursor:pointer;" onclick="if(!confirm('xác nhận'))return false;" /> -->
    <input title='tiếp tục'  type="submit" name="next" value="Đặt hàng" style="padding:10px;border:none;background:#404042;color:#fff;cursor:pointer;" />
    <input type="hidden" name="iduser" value="<?=$_SESSION['mem_login']['iduser']?>"> 
    </div>
      </form>
<?php } ?>      
<!-- ############################################# -->
<?php } ?>      
