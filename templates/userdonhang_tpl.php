<?php 
	//date_default_timezone_set('Asia/Ho_Chi_Minh')

?>
<script>
			$('#form_sigin').reset();
		</script>
		<div class="nt_navigation">
					<p class="p_navigation"><i class="fa fa-home"></i> <a href="">Trang chủ </a> &raquo; <span style="font-family:opensans_b;">Thông tin đơn hàng</span></p>
				</div>
				<div class="container" style="margin-top: 20px;padding-top: 20px;border: 1px solid #ccc;margin-bottom: 20px;">
				
					<div class="row">
					<form id="form_sigin" method="post" action="">
					<div class="col-sm-7">
					
						<p style="font-family:opensans_b;font-size: 14px;text-decoration: underline;">Danh sách đơn hàng</p>
						<?php
							$dem=0;
							$sql="select * from table_donhang where iduser='".$_SESSION['mem_login']['iduser']."' order by ngaytao desc";
							$d->query($sql);
							$result_dh_tv = $d->result_array();
					if(count($result_dh_tv) > 0){		
							for($i=0;$i<count($result_dh_tv);$i++){
							$dem++;
						?>
							
							<p><a href="don-hang-thanh-vien/detail/ct/<?=$result_dh_tv[$i]['id']?>.html"><?=$dem?>. Đơn hàng mua ngày <?=date('d - m - Y H:i:s ',$result_dh_tv[$i]['ngaytao'])?></a>
							(<b>Mã đơn hàng:</b> <?=$result_dh_tv[$i]['madonhang'];?>)	
							</p>
							
						<? } } else {
								echo "Chưa có đơn hàng nào.";
							}?>


					
					
					
					</div>	
					<div class="col-sm-5">
						<div class="div_info_sigin" align="center">
							<ul class="userleft">
								<li style="background:#ffae00;text-align: center;color:#fff;font-family:opensans_b;font-size: 15px;padding: 10px 0px;">Thiết lập</li>
								<li <?php if($_GET['com'] == 'cap-nhat-tai-khoan'){?> class="activeleft" <?php } ?>style="padding: 10px 0px;"><a href="cap-nhat-tai-khoan.html">Cập nhật tài khoản</a></li>
								<?php if($info_user['typelog'] == 'normal') {?>
								<li <?php if($_GET['com'] == 'doi-mat-khau'){?> class="activeleft" <?php } ?>style="padding: 10px 0px;"><a href="doi-mat-khau.html">Đổi mật khẩu</a></li>
								<?php } ?>
								<li <?php if($_GET['com'] == 'don-hang-thanh-vien'){?> class="activeleft" <?php } ?>style="padding: 10px 0px;"><a href="don-hang-thanh-vien.html">Thông tin đơn hàng</a></li>
							</ul>
						</div>
					</div>
					
					
					</form>
					</div>
				</div><!--end container-->


