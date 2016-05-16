		<script>
			$('#form_sigin').reset();
		</script>
		<div class="nt_navigation">
					<p class="p_navigation"><i class="fa fa-home"></i> <a href="">Trang chủ </a> &raquo; <span style="font-family:opensans_b;">Thông tin đơn hàng</span></p>
				</div>
				<div class="container" style="margin-top: 20px;padding-top: 20px;border: 1px solid #ccc;margin-bottom: 20px;">
				
					<div class="row">
					<form id="form_sigin" method="post" action="" >
					<div class="col-sm-7">
					<?php 
					$sql="select * from table_donhang where id='".$_GET['idl']."' order by ngaytao desc";
							$d->query($sql);
							$result_dh = $d->fetch_array();
					?>
						<p style="font-family:opensans_r;font-size: 14px;text-decoration: underline;">Chi tiết đơn hàng - <span style="font-family:opensans_b"><?=$result_dh['madonhang']?></span></p>
						<?php
							$id_dh=$_GET['idl'];
							
							$sql="select * from table_donhang where id='".$id_dh."' order by ngaytao desc";
							$d->query($sql);
							$result_dh_detail = $d->result_array();
						?>
						<div class="clear"></div>
						<div style="margin-top: 10px;">
							<?=$result_dh_detail[0]['donhang']?>
						</div>
							

					
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


