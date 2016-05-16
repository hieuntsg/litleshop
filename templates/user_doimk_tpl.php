  
    <script>
      $('#form_sigin').reset();
    </script>
    <div class="nt_navigation">
          <p class="p_navigation"><i class="fa fa-home"></i> <a href="">Trang chủ </a> &raquo; <span style="font-family:opensans_b;">Quên mật khẩu</span></p>
        </div>
        <div class="container" style="margin-top: 20px;padding-top: 20px;border: 1px solid #ccc;margin-bottom: 20px;">
        
          <div class="row">
          <form id="form_sigin" method="post" action="quen-mat-khau.html" >
            <div class="col-sm-7">
          

          <div class="row">
            
              <div class="col-sm-4">
                <p class="p_note_sigin">Email(<font style="color:#f00">*</font>)</p>
              </div>
              <div class="col-sm-7">
                <div style="" class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="Email">                                        
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
                
              </div>
              <div class="col-sm-7">
                <div style="margin-bottom: 25px" class="input-group">
                  
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Gửi</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button onclick="reset()" type="button" class="btn btn-default">Nhập lại</button>
                </div>
              
              </div>
              
            </div>            
          
          
          </div>  
          <div class="col-sm-5">
            <div class="div_info_sigin" >
                <p style="font-weight:bold">Vui lòng kiểm tra hộp thư mail của bạn, nếu chưa thấy thông tin xin kiểm tra phần spam trong email.</p>
                <p style="font-weight:bold">Mọi thông tin vui lòng liên hệ trumsi.vn .</p>
            </div>
          </div>
          
          
          </form>
          </div>
        </div><!--end container-->


 
 
 