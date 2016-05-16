<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
        elements : "content_vi,content_en",
		theme : "advanced",
		convert_urls : false,
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,imagemanager,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
height:"500px",
    width:"100%",
	remove_script_host : false,

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
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

<h3>Thêm dịch vụ</h3>
<br />

<?php
function get_main_item()
	{
		$sql_huyen="select * from table_news_item order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item"">
			<option value="0">Chọn danh mục</option>
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
function get_main_thanhvien()
	{
		$sql_huyen="select * from table_thanhvien order by id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id" name="id"">
			<option value="0">Chọn </option>
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}	
?>


<script>
$(function() {
	
	$('#popupDatepicker').datepick({dateFormat: 'yyyy-mm-dd'});
	$('#popupDatepicker').datepick({yearRange: '1930:2020'}); 
});


</script>
<form name="frm" method="post" action="index.php?com=thanhvien&act=savephi" enctype="multipart/form-data" class="nhaplieu">

	
	<b>Tên thành viên</b> <input  type="text" name="tenhoasi" id="tenhoasi" value="<?=@$item['firstname']." ".@$item['lastname']?>" class="input" /><br />	
	<b>Email</b> <input  type="text" name="email" id="email" value="<?=@$item['email']?>" class="input" /><br />
	<b>Địa chỉ</b> <input disabled="disabled" type="text" name="diachi" id="diachi" value="<?=@$item['diachinoio']?>" class="input" /><br />
	<b>Số tiền đã từng sử dụng</b><input disabled="disabled" type="text" name="sotiendatru" id="sotiendatru" value="<?=@$item['sotiendatru']?>" class="input" /><br />
	<b>Đóng phí</b> <input type="text" disabled="disabled" name="sotiendong" id="sotiendong" value="<?=@$item['sotiendong']?>" class="input" /> <br />
	<b>Ngày đóng phí</b> <input  name="ngaydongphi" id="popupDatepicker" placeholder="Nam-Thang-Ngay (2014-07-08)" type="text"   value="<?=@$item['ngaydongphi']?>" class="input" /> <br />
	 <p>Ngày đóng phí - (Nam-Thang-Ngay (2014-07-08)</p>
	 <input type="hidden" name="keyword" value="<?=@$item['keyword']?>" class="input" /><br /><br>
	  <div><input type="hidden" cols="50" rows="5" name="description" ></div>  
	<b>Thành viên vip</b> <input disabled="disabled" type="checkbox" name="comvip" <?=(!isset($item['comvip']) || $item['comvip']=='vip')?'checked="checked"':''?>><br /><br />
	<b>Mã đăng nhập</b> <input type="text" disabled="disabled"  name="madangnhap" id="madangnhap" value="<?=@$item['madangnhap']?>" class="input" /> <br />
	<div class="clear"></div>
	<br><br/>

	<b>Chọn mức phí</b>
	<?php
		$d->reset();
		$sql_phi="select * from table_banggianam order by stt";
		$d->query($sql_phi);
		$result_phi =$d->result_array();
		
		for($i=0;$i<count($result_phi);$i++){
	?>
	<input name="chonphi" <?php if($result_phi[$i]['id']==$item['id_banggianam']){ echo "checked" ;}?> class="radiochonphi" type="radio" value="<?=$result_phi[$i]['id']?>"><?=$result_phi[$i]['nam']?> năm đóng <?=$result_phi[$i]['tien']?> VNĐ
	<? }?>

	<div class="clear"></div>
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Sửa phí" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=thanhvien&act=manvip'" class="btn" />
</form>