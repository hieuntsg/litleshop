<div class="content_left">
	<?php include _template."layout/left_user_info.php"; ?>
</div>
<div class="content_right">

	<div class="tcat">Thay đổi avatar</div>
<div class="content">
<form action="" method="post" enctype="multipart/form-data" name="formdk" id="formdk">
<table width="550" border="0" cellpadding="0" cellspacing="0" class="tablelienhe">
<tr>
   <td colspan="2"><img src="<?php if($item['thumb']!=NULL) echo _upload_avatar_l.$item['thumb']; else echo 'images/noavatar.gif';?>" onerror="this.src='images/noavatar.gif';" width="128" height="128" border="0"/></td>
</tr>
<tr><td><b>Upload</b></td>
   <td><input name="file" type="file" class="input" id="file" />
        <span class="error"> <?=$error_avatar ?> </span>   </td>
</tr>
<tr><td colspan="2" align="center">       
       <input type="submit" name="btndangky" id="btndangky" value="Cập nhật" class="button" />
	</td>
</tr>
</table>
</form>
</div>
    </div>
    <style>
.content_left{
	float:left;
	width:255px;
}
.content_right{
	float:left;
	width:695px;
	padding-left:10px;
}
.content_right .tcat{
	background:url(images/bg_tcat.png) no-repeat top left;
	height:36px;
	color:#FFF;
	font-weight:bold;
	line-height:36px;
	font-size:14px;
	padding-left:35px;
}
.content_right .content{
	background:#FFF url(images/bg_content.png) repeat-x top left;
	border:1px solid #E5E5E5;
	padding:9px;
	margin-bottom:10px;
}
.tablelienhe .input, .tablelienhe textarea {
    border: 1px solid #E9E9E9;
    width: 200px;
}
</style>