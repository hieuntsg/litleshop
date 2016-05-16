<script language="javascript" src="admin/media/scripts/my_script.js"></script>
<script language="javascript">
function js_submit(){
	

	
	if(isEmpty(document.getElementById('noidung'), "Xin nhập Nội dung.")){
		document.getElementById('noidung').focus();
		return false;
	}
	
	document.frm.submit();
}
</script>

<script type="text/javascript">
	
	$(document).ready(function() {
   		$('.view_more').click(function() {
		 $('.onrely').fadeOut();
		 $(this).parent().find('.onrely').fadeIn();
		 
		
		});
		
	});


</script>
 
			   
<div class="left">
	<div class="content_left">
		<h1 class="class_h1">Hỏi đáp</h1>
		<span class="class_span">
			
			<ul class="main_news">
			<?php
				for($i=0;$i<count($result_hoidap);$i++)
				{
			?>			<li>
			<?php
			if($result_hoidap[$i]['photo']!='')
			{
			?>
			<img src="<?=_upload_tintuc_l.$result_hoidap[$i]['photo']?>" width="100" height="100"/>
			<? }?>
			<h2><a href="tin-tuc/<?=$result_hoidap[$i]['tenkhongdau']?>/<?=$result_hoidap[$i]['id']?>.html" title=""><?=$result_hoidap[$i]['ten']?></a></h2>
			<span><?=$result_hoidap[$i]['mota']?></span><br />

				<span>
				<a class="view_more">Xem tiếp ...</a>
				<span class="onrely">
					<?=$result_hoidap[$i]['noidung']?>
				
				</span>
				</span>
			</li>
			<? }?>
		</ul>
			
			
			
			<span><?=$meg?></span>
			<form method="post" name="frm" action="hoi-dap.html">
	
      <table width="100%" cellpadding="5" cellspacing="0" border="0" class="tablelienhe">
                                                                        
                                                 
                        <tr>
                        <td>Nội dung<span>*</span></td>
						<td>
                        <textarea name="noidung" cols="50" rows="5" class="ta_noidung" id="noidung" style="background-color:#FFFFFF; color:#666666;"></textarea>
                        </td>
                        </tr>
                         <tr>
                         <td>&nbsp;</td>
                        <td> 
                    <input class="button" type="button" value="Gửi" onclick="js_submit();" />
                    <input class="button" type="button" value="Nhập lại" onclick="document.frm.reset();" />
                                                         
                        </td>
						</tr>
                        </table>   
	                            </form>
		</span>
	</div>

</div>