		
		<script>
			$('#form_sigin').reset();
		</script>
		<div class="nt_navigation" >
					<p class="p_navigation"><i class="fa fa-home"></i> <a href="./">Trang chủ </a> &raquo; <span style="font-family:opensans_b;">Đăng ký thành viên</span></p>
				</div>
				<div class="container" style="margin-top: 20px;padding-top: 20px;border: 1px solid #ccc;margin-bottom: 20px;">
				
					<div class="row">
					<form id="form_sigin" method="post" action="sigin.html" >
						<div class="col-sm-7">
						<div class="row">
							
							<div class="col-sm-4">
								<p class="p_note_sigin">Email (<font style="color:#f00">*</font>)</p>
							</div>
							<div class="col-sm-7">
								<div style="" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
									<input id="login-username" type="text" class="form-control" name="email" value="<?=$_POST['email']?>" placeholder="Email">                                        
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
						<!-- <div class="row">
							
							<div class="col-sm-4">
								<p class="p_note_sigin">Tên biệt danh (<font style="color:#f00">*</font>)</p>
							</div>
							<div class="col-sm-7">
								<div style="" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Username">                                        
									
								</div>
								<div class="clear"></div>
								
									<?php
										if(!empty($error_username)){
									?>
									<p class="p_note_error spcolor"><?=$error_username?></p>
									<? }else{?>
									
									<p class="p_height_sigin spcolor"></p>
									<? }?>
							</div>
							
						</div> -->
						
						<div class="row">
						
							<div class="col-sm-4">
								<p class="p_note_sigin">Mật khẩu (<font style="color:#f00">*</font>)</p>
							</div>
							<div class="col-sm-7">
								<div style="" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input id="login-username" type="password" class="form-control" name="matkhau" value="<?=$_POST['matkhau']?>" placeholder="Password">                                        
								</div>
								
								<div class="clear"></div>
								<?php
										if(!empty($error_matkhau)){
									?>
									<p class="p_note_error spcolor"><?=$error_matkhau?></p>
									<? }else{?>
									
									<p class="p_height_sigin spcolor"></p>
									<? }?>
							
							
							</div>
							
						</div>

						<div class="row">
							
							<div class="col-sm-4">
								<p class="p_note_sigin">Nhập lại mật khẩu (<font style="color:#f00">*</font>)</p>
							</div>
							<div class="col-sm-7">
								<div style="" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input id="login-username" type="password" class="form-control" name="golaimatkhau" value="<?=$_POST['golaimatkhau']?>" placeholder="Repassword">                                        
								</div>
								<div class="clear"></div>
								<?php
										if(!empty($error_golaimatkhau)){
									?>
									<p class="p_note_error spcolor"><?=$error_golaimatkhau?></p>
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
									<input id="login-username" type="text" class="form-control" name="hoten" value="<?=$_POST['hoten']?>" placeholder="Full name">                                        
								</div>
								<div class="clear"></div>
								<?php
										if(!empty($error_hoten)){
									?>
									<p class="p_note_error spcolor"><?=$error_hoten?></p>
									<? }else{?>
									
									<p class="p_height_sigin spcolor"></p>
									<? }?>
								
							
							</div>
							
						</div>							
						
						
						<div class="row">
							
							<div class="col-sm-4">
								<p class="p_note_sigin">Địa chỉ</p>
							</div>
							<div class="col-sm-7">
								<div style="" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
									<input id="login-username" type="text" class="form-control" name="diachi" value="<?=$_POST['diachi']?>" placeholder="Address">                                        
								</div>
								<div class="clear"></div>
								<?php
										if(!empty($error_diachi)){
									?>
									<p class="p_note_error spcolor"><?=$error_diachi?></p>
									<? }else{?>
									
									<p class="p_height_sigin spcolor"></p>
								<? }?>							
							</div>
							
						</div>				

						<div class="row">
							
							<div class="col-sm-4">
								<p class="p_note_sigin">Điện thoại</p>
							</div>
							<div class="col-sm-7">
								<div style="" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
									<input id="login-username" type="text" class="form-control" name="dienthoai" value="<?=$_POST['dienthoai']?>" placeholder="Phone">                                        
								</div>
								<?php
										if(!empty($error_sodt)){
									?>
									<p class="p_note_error spcolor"><?=$error_sodt?></p>
									<? }else{?>
									
									<p class="p_height_sigin spcolor"></p>
								<? }?>				
							
							</div>
							
						</div>					
						
						
						<div class="row">
							
							<div class="col-sm-4">
								<p class="p_note_sigin">Giới tính</p>
							</div>
							<div class="col-sm-7">
								<div style="margin-bottom: 25px" class="input-group">
										<input value="1" name="gioitinh" type="radio">  Nam
										&nbsp;&nbsp;&nbsp;&nbsp;
									<input value="0" name="gioitinh" type="radio">  Nữ
								</div>
							
							</div>
						
						</div>	


						<div class="row">
							
							<div class="col-sm-4">
								
							</div>
							<div class="col-sm-7">
								<div style="margin-bottom: 25px" class="input-group">
									
										<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Đăng kí</button>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<button onclick="reset()" type="button" class="btn btn-default">Nhập lại</button>
								</div>
							
							</div>
							
						</div>						
					
					
					</div>	
					<div class="col-sm-5">
						<div class="div_info_sigin">
							<p style="font-weight:bold">Lợi ích khi tham gia vào hệ thống website trumsi.vn</p>
							<p style="font-style:italic">- Bạn sẽ được hưởng nhiều chính sách ưu đãi </p>
							<p style="font-style:italic">- Nhận được ngay thông tin khi có chương trình khuyến mãi</p>
							<p>..............</p>
						</div>
					</div>
					
					
					</form>
					</div>
				</div><!--end container-->

