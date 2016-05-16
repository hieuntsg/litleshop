	
		<script>
			$('#form_sigin').reset();
		</script>
		<div class="nt_navigation">
					<p class="p_navigation"><i class="fa fa-home"></i> <a href="">Trang chủ </a> &raquo; <span style="font-family:opensans_b;">Đổi mật khẩu</span></p>
				</div>
				<div class="container" style="margin-top: 20px;padding-top: 20px;border: 1px solid #ccc;margin-bottom: 20px;">
				
					<div class="row">
					<form id="form_sigin" method="post" action="doi-mat-khau.html" >
						<div class="col-sm-7">
					

					<div class="row">
						
							<div class="col-sm-4">
								<p class="p_note_sigin">Mật khẩu cũ(<font style="color:#f00">*</font>)</p>
							</div>
							<div class="col-sm-7">
								<div style="" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input id="login-username" type="password" class="form-control" name="matkhaucu" value="<?=$passold?>" placeholder="Old password">                                        
								</div>
								
								<div class="clear"></div>
								<?php
										if(!empty($error_matkhaucu)){
									?>
									<p class="p_note_error spcolor"><?=$error_matkhaucu?></p>
									<? }else{?>
									
									<p class="p_height_sigin spcolor"></p>
									<? }?>
							
							
							</div>
							
					</div>					
					
					
					<div class="row">
						
							<div class="col-sm-4">
								<p class="p_note_sigin">Mật khẩu mới(<font style="color:#f00">*</font>)</p>
							</div>
							<div class="col-sm-7">
								<div style="" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input id="login-username" type="password" class="form-control" name="matkhau" value="<?=$matkhau?>" placeholder="New password">                                        
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
								<p class="p_note_sigin">Nhập lại mật khẩu mới (<font style="color:#f00">*</font>)</p>
							</div>
							<div class="col-sm-7">
								<div style="" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input id="login-username" type="password" class="form-control" name="golaimatkhau" value="<?=$golaimatkhau?>" placeholder="Re-new password">                                        
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
								<li <?php if($_GET['com'] == 'doi-mat-khau'){?>class="activeleft" <?php } ?> style="padding: 10px 0px;"><a href="doi-mat-khau.html">Đổi mật khẩu</a></li>
								<li <?php if($_GET['com'] == 'don-hang-thanh-vien'){?> class="activeleft" <?php } ?>style="padding: 10px 0px;"><a href="don-hang-thanh-vien.html">Thông tin đơn hàng</a></li>
							</ul>
						</div>
					</div>
					
					
					</form>
					</div>
				</div><!--end container-->


 
 
 