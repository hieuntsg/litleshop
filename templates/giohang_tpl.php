<?php
if(empty($_SESSION['mem_login']['mem_mail'])){
	echo "Bạn chưa đăng nhập.<br><br>";
	echo "Nếu chưa có tài khoản vui lòng <a href='sigin.html'>đăng kí tại đây</a>";
}
else{
/*##########################################*/
if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
		remove_product($_REQUEST['pid']);
?>
	<script type="text/javascript">window.location.href="gio-hang.html";</script>
<?php		
	}
	else if($_REQUEST['command']=='clear'){
		unset($_SESSION['cart']);
?>
	<script type="text/javascript">window.location.href="gio-hang.html";</script>
<?php		
	}
	else if($_REQUEST['command']=='update'){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=intval($_REQUEST['product'.$pid]);
			if($q>0 && $q<=99){
				$_SESSION['cart'][$i]['qty']=$q;
			}
			else{
				$msg='Some proudcts not updated!, quantity must be a number between 1 and 99';
			}
		}
	}
?>
<script language="javascript">
	function del(pid){
		if(confirm('Bạn muốn xóa sản phẩm này .')){
			document.form1.pid.value=pid;
			document.form1.command.value='delete';
			document.form1.submit();
			
		}
	}
	function clear_cart(){
		if(confirm('Bạn chắc chắn muốn xóa toàn bộ giỏ hàng.')){
			document.form1.command.value='clear';
			document.form1.submit();
		}
	}
	function update_cart(){
		document.form1.command.value='update';
		document.form1.submit();
		
	}
</script>
<div class="title"> 
	<div style="float:left;font-size:20px;font-weight:bold;text-transform:uppercase;color:#7d7d7d;border-bottom:3px solid #ffae00;margin-bottom:10px;"><img src="images/ico1.png" alt="gt" style="vertical-align: middle;margin-right: 10px;">giỏ hàng</div>
</div>
<div class="clear"></div>
	
    
			<form name="form1" method="post" action="">
<input type="hidden" name="pid" />
<input type="hidden" name="size" />
<input type="hidden" name="command" /> 
				<table border="0" cellpadding="5px" cellspacing="1px" style=" font-size:12px;" width="100%">
    	<?php
			if(is_array($_SESSION['cart']) && count($_SESSION['cart'])!=0 ){
		?>		

            	<tr bgcolor="#ffae00" style="font-weight:bold;height:20px;color:#FFF; font-family:opensans_b;">
                	<td align="center" style="padding:10px">STT</td>
					<td align="center" style="padding:10px">Tên</td>
                    <!--<td align="center">Màu</td>-->
                    <td style="padding:10px" align="center">Giá/SL</td>
                    <!-- <td style="padding:10px" align="center">Số lượng</td> -->
                    <td style="padding:10px" align="center">Tổng giá</td>
                    <td style="padding:10px" align="center">Xóa</td>
                </tr>
		<?php		
                $max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$size=$_SESSION['cart'][$i]['size'];
					$q=$_SESSION['cart'][$i]['qty'];					
					$pname=get_product_name($pid);
					$imgsp = get_img($pid);
					$sl = intval(get_quantity($pid));
					if($q==0) continue;
			?>

            		<tr <?php if(($i+1)%2 != 0){?> bgcolor="#FFFFFF" <?php }else{?>
            		bgcolor="#e1e1e1" <?php } ?> >
            		<td  align="center"><?=$i+1?></td>
            		<td style="padding:10px" align="center">
            			<img src="<?=_upload_sanpham_l.$imgsp;?>" alt="sp" style="width: 60px;"><br>
            			<?=$pname?>
            		</td>
                    <!--<td width="29%"><?//=$color?></td>-->
                    <td style="padding:10px"  align="center"><?=number_format(get_price($pid),0, ',', '.')?>&nbsp;₫ 
                    <!-- <input type="text" name="product<?=$pid?>" value="<?=$q?>" maxlength="2" size="2" style="padding: 5px;text-align:center; border:1px solid #F0F0F0" />  -->
                    <div style="width: 100%;">
                    	<select name="product<?=$pid?>" >
                    	<?php for ($j=1; $j <= $sl ; $j++) { ?>
                    		<option value="<?=$j;?>" <?php if($j == $q){?> selected <?php } ?> ><?=$j;?></option>
                    	<?php } ?>
                    	</select>
                    </div>	
                   <div class="clear"></div>
                    <br>
                    Size: <span style="font-family:opensans_b;"><?=$size;?></span>
                    </td>
                    <!-- <td style="padding:10px"  align="center">
                    <input type="text" name="product<?=$pid?>" value="<?=$q?>" maxlength="2" size="2" style="padding: 5px;text-align:center; border:1px solid #F0F0F0" />&nbsp;</td> -->                    
                    <td style="padding:10px"  align="center"><span style="font-family:opensans_b;"><?=number_format(get_price($pid)*$q,0, ',', '.') ?>&nbsp;₫</span></td>
                    <td style="padding:10px"  align="center"><a href="javascript:del(<?=$pid?>)"><img src="images/delete.png" border="0" width="30px" /></a></td>
            		</tr>
            <?					
				}
			?>
				<tr><td style="padding:5px" colspan="5" style="background:#E6E6E6">
                Tổng giá bán: <span style="font-family:opensans_b;font-size: 15px;"><?=number_format(get_order_total(),0, ',', '.')?>&nbsp;₫</span>
                </td></tr>
                <tr>
                	<td colspan="5" align="right">
                    <input style="padding:10px;border:none;background:#404042;color:#fff;cursor:pointer;" type="button" value="Mua tiếp" onclick="window.location='http://<?=$config_url?>/san-pham.html'" class="button">
                	<input style="padding:10px;border:none;background:#404042;color:#fff;cursor:pointer;" type="button" value="Xóa tất cả" onclick="clear_cart()" class="button">								                    
                    <input style="padding:10px;border:none;background:#404042;color:#fff;cursor:pointer;" type="button" value="Cập nhật" onclick="update_cart()" class="button">
                    <input style="padding:10px;border:none;background:#404042;color:#fff;cursor:pointer;" type="button" value="Thanh toán" onclick="window.location='http://<?=$config_url?>/thanh-toan.html'" class="button">
                    </td>
                </tr>
			<?
            }
			else{
				echo "<tr bgColor='#FFFFFF'><td>Không có sản phẩm nào trong giỏ hàng!</td>";
			}
		?>
        </table>			
  </form>
<!-- ########################################### -->     
<?php } ?>   