
		<script>
			$('#form_sigin').reset();
		</script>
		<div class="nt_navigation">
					<p class="p_navigation"><i class="fa fa-home"></i> <a href="">Trang chủ </a> &raquo; <span style="font-family:opensans_b;">Cập nhật thông tin tài khoản</span></p>
				</div>
				<div class="container" style="margin-top: 20px;padding-top: 20px;border: 1px solid #ccc;margin-bottom: 20px;">
				
					<div class="row">
					<form id="form_sigin" method="post" action="cap-nhat-tai-khoan.html" >
						<div class="col-sm-7">
					
						<!-- <div class="row">
							
							<div class="col-sm-4">
								<p class="p_note_sigin">Tên biệt danh (<font style="color:#f00">*</font>)</p>
							</div>
							<div class="col-sm-7">
								<div style="" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input id="login-username" type="text" class="form-control" name="username" value="<?=$info_user['username']?>" placeholder="Username">                                        
									
								</div>
								<div class="clear"></div>
								
									<?php
										if(!empty($error_username)){
									?>
									<p class="p_note_error"><?=$error_username?></p>
									<? }else{?>
									
									<p class="p_height_sigin"></p>
									<? }?>
							</div>
							
						</div> -->
						
						<div class="row">
							
							<div class="col-sm-4">
								<p class="p_note_sigin">Email (<font style="color:#f00">*</font>)</p>
							</div>
							<div class="col-sm-7">
								<div style="" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
									<input readonly id="login-username" type="text" class="form-control" name="email" value="<?=$info_user['email']?>" placeholder="Email">                                        
								</div>
								<div class="clear"></div>
								<?php
										if(!empty($error_email)){
									?>
									<p class="p_note_error spcolor"><?=$error_email?></p>
									<? }else{?>
									
									<p class="p_height_sigin spcolor"></p>
									<? }?>
								
							
							</div>
							
						</div>
					

						<div class="row">
							
							<div class="col-sm-4">
								<p class="p_note_sigin">Họ tên </p>
							</div>
							<div class="col-sm-7">
								<div style="" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
									<input id="login-username" type="text" class="form-control" name="hoten" value="<?=$info_user['hoten']?>" placeholder="Fullname">                                        
								</div>
								<div class="clear"></div>
								<?php
										if(!empty($error_hoten)){
									?>
									<p class="p_note_error"><?=$error_hoten?></p>
									<? }else{?>
									
									<p class="p_height_sigin"></p>
									<? }?>
								
							
							</div>
							
						</div>							
						
						
						<div class="row">
							
							<div class="col-sm-4">
								<p class="p_note_sigin">Địa chỉ (<font style="color:#f00">*</font>)</p>
							</div>
							<div class="col-sm-7">
								<div style="" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
									<input id="login-username" type="text" class="form-control" name="diachi" value="<?=$info_user['diachi']?>" placeholder="Address">                                        
								</div>
								<div class="clear"></div>
								<?php
										if(!empty($error_diachi)){
									?>
									<p class="p_note_error"><?=$error_diachi?></p>
									<? }else{?>
									
									<p class="p_height_sigin"></p>
								<? }?>							
							</div>
							
						</div>				

						<div class="row">
							
							<div class="col-sm-4">
								<p class="p_note_sigin">Điện thoại (<font style="color:#f00">*</font>)</p>
							</div>
							<div class="col-sm-7">
								<div style="" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
									<input id="login-username" type="text" class="form-control" name="dienthoai" value="<?=$info_user['dienthoai']?>" placeholder="Phone">                                        
								</div>
								<?php
										if(!empty($error_sodt)){
									?>
									<p class="p_note_error"><?=$error_sodt?></p>
									<? }else{?>
									
									<p class="p_height_sigin"></p>
								<? }?>				
							
							</div>
							
						</div>					
						
						
						<div class="row">
							
							<div class="col-sm-4">
								<p class="p_note_sigin">Giới tính</p>
							</div>
							<div class="col-sm-7">
								<div style="margin-bottom: 25px" class="input-group">
										<input <?php if($info_user['gioitinh']==1) echo 'checked=checked'; ?> name="gioitinh" type="radio" value="1">  Nam
										&nbsp;&nbsp;&nbsp;&nbsp;
									<input <?php if($info_user['gioitinh']==0) echo 'checked=checked'; ?> name="gioitinh" value="0" type="radio">  Nữ
								</div>
							
							</div>
						
						</div>	


						<div class="row">
							
							<div class="col-sm-4">
								
							</div>
							<div class="col-sm-7">
								<div style="margin-bottom: 25px" class="input-group">
									
										<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Cập nhật</button>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<button onclick="reset()" type="button" class="btn btn-default">Nhập lại</button>
								</div>
							
							</div>
							
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


