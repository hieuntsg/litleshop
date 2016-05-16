<script type="text/javascript">
tinyMCE.init({
	// General options
	mode : "exact",
    elements : "content_vi,content_en",
	theme : "advanced",
	convert_urls : false,
	plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,imagemanager,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media," +
	"searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
	height:"500px",
   	width:"100%",
	remove_script_host : false,
	// Theme options
	theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect," + 	
	"fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code" + 
	",|,insertdate,inserttime,preview,|,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",		
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,

	// Example content CSS (should be your site CSS)
	content_css : "css/content.css",

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "lists/template_list.js",
	external_link_list_url : "lists/link_list.js",
	external_image_list_url : "lists/image_list.js",
	media_external_list_url : "lists/media_list.js",

	// Style formats
	style_formats : [
		{title : 'Bold text', inline : 'b'},
		{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
		{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
		{title : 'Example 1', inline : 'span', classes : 'example1'},
		{title : 'Example 2', inline : 'span', classes : 'example2'},
		{title : 'Table styles'},
		{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
	],

	// Replace values for the template plugin
	template_replace_values : {
		username : "Some User",
		staffid : "991234"
	}
});
</script>

<h3><span>Thêm size</span><a href="index.php?com=mausac&amp;act=default&id_product=<?=$_REQUEST['id_product']?>" class="top-back">« Quay lại</a></h3>
<form name="frm" method="post" action="index.php?com=mausac&amp;act=save&id_product=<?=$_REQUEST['id_product']?>" enctype="multipart/form-data" class="nhaplieu">
    	<div class="a-field">
    	<b> Size:</b>
        <div class="input-box"><input type="text" name="ten" value="<?=$news['ten']?>" class="input" /></span></div><br/>
        </div>
    <!-- Short Description-->
	<?php if(@$_REQUEST['act'] == 'edit'):?>
    <!-- <div class="a-field">
    	<b> Màu sắc hiện tại: </b>
        <div class="input-box"></div>
    </div>
    <div class="a-field">
    	<div class="field-name"></div>
        <div class="input-box">
        	<img src="<?=_upload_tintuc.$news['photo']?>" alt="NO PHOTO"  width="150"/>
		</div>
    </div> -->
	<?php endif;?>
    <!-- End Short Description-->
    
    <!-- <div class="a-field">
        <div class="input-box">
        	<b>Chọn màu sắc</b>
            <input type="file" name="file" class="browser-pic-hide"/>
          
            <script type="text/javascript">
            	$('.browser-pic').click(function(e) {
                    $('.browser-pic-hide').click();
                });
            </script>
             <span style="float:left;font-weight:normal !important;font-size:13px;color:#666;margin-left:10px;margin-top:-2px;"><?=_news_type?></span>
    	</div>
    </div> -->
    <div class="a-field">
    	<div class="field-name"><b>Số thứ tự: </b></div>
        <div class="input-box"><input type="text" name="order_num" value="<?=isset($news['stt']) ? $news['stt'] : 1?>" class="order_num" style="width:250px;"></div>
    </div>
    
    <!-- <div class="a-field">
    	<div class="field-name">Hiển thị: </div>
        <div class="input-box">
        	<input type="checkbox" name="display" <?=(!isset($news['display']) || $news['display'] == 1) ? ' checked = "checked"' : ''?> class="display">
            <span style="float:left;font-size:13px;color:#888;">(check để hiển thị)</span>
        </div>
    </div> -->
    <!-- Short Description-->
  
    
    <input type="hidden" name="id" id="id" value="<?=@$news['id']?>" />
    <div class="a-field">
    	<div class="field-name"></div>
        <div class="input-box">
        	<input type="submit" value="Lưu lại" class="gray-btn save-btn" style="width:100px;" />
			<input type="button" value="Hủy bỏ" onclick="javascript:window.location='index.php?com=mausac&act=default&id_product=<?=$_REQUEST['id_product']?>'" class="gray-btn cancel" style="width:100px;" />
        </div>
    </div>
    
</form>