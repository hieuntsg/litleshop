<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js" ></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="../css/font-awesome/css/font-awesome.min.css">  
<script language="javascript">
function goback() {
    history.back(-1);
}
</script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
        elements : "noidung",
		theme : "advanced",
		convert_urls : false,
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,imagemanager,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
height:"300px",
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
<h3> Thêm mới</h3>
<script language="javascript">				
	function select_onchange1()
	{				
		var b=document.getElementById("id_cat");
		if(b.value != 0){
		window.location ="index.php?com=sanpham&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_cat="+b.value;	
		return true;
		}else{ 
			document.getElementById("id_list").style.display="none";
			document.getElementById("id_item").style.display="none";
			return false; }
	}
	function select_onchangelist()
	{	
		var b=document.getElementById("id_cat");
		var c=document.getElementById("id_list");
		window.location ="index.php?com=sanpham&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_cat="+b.value+"&id_list="+c.value;	
		return true;
	}
		function select_onchange3()
	{	
		var b=document.getElementById("id_cat");
		var c=document.getElementById("id_list");
		var x=document.getElementById("id_item");
		window.location ="index.php?com=sanpham&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?>&id_cat="+b.value+"&id_list="+c.value+"&id_item="+x.value;	
		return true;
	}

	
</script>
<?php
global $fl;
$hai = $_REQUEST['act'];

if($hai == 'edit')
	$fl = 0;
else
	$fl = 1;

function get_main_category(){
	global $fl;
		$sql="select * from table_product_cat order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select style="padding:5px;" id="id_cat" name="id_cat" onchange="select_onchange1()" class="main_font">
			<option>Chọn danh mục</option>';?>		
	<?php	
		if($fl == 1){
			$str .='<option value="0">Cả hai</option>';
		}
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	
	function get_main_item()
	{
		$sql_huyen="select * from table_product_list where id_cat = ".$_REQUEST["id_cat"]."  order by id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select style="padding:5px;" id="id_list" name="id_list" onchange="select_onchangelist()" class="main_font">
			<option>Chọn danh mục</option>			
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_list"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	function get_main_item2()
	{
		$sql_huyen="select * from table_product_item where id_cat=".$_REQUEST['id_cat']." and id_list=".$_REQUEST['id_list']." order by stt desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select style="padding:5px;" id="id_item" name="id_item" onchange="" class="main_font">
			<option>Chọn danh mục</option>	
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
	if(!isset($_REQUEST['curPage'])) $_REQUEST['curPage']=1;
	if(!isset($_REQUEST['act'])) $_REQUEST['act']="";
?>
<form name="frm" method="post" action="index.php?com=sanpham&act=save&curPage=<?=$_REQUEST['curPage']?>" enctype="multipart/form-data" class="nhaplieu">	
	<b>Danh mục cấp 1:</b><?=get_main_category();?><br />
	<b>Danh mục cấp 2:</b><?=get_main_item();?><br /><br />
  	<b>Danh mục cấp 3:</b><?=get_main_item2();?><br /><br />
	<?php if ($_REQUEST['act']==edit){?>
	 <b>Hình hiện tại:</b><img src="<?=_upload_sanpham.$item['photo']?>" width="200px"  alt="NO PHOTO" /><br /> 
	<?php } ?>
	 <b>Hình ảnh:</b> <input type="file" name="file" /> <?=_product_type?> (w:744px;h:1020)(Tỉ lệ: 1:2,1:3...)<br />
    <br />
<style type="text/css" media="screen">
	.showimage {
    position: relative;
    display: inline-block;
    width: 100%;
    max-width: 125px;
    /* height: 120px; */
    border: solid 1px #ddd;
    vertical-align: top;
    margin-left: 5px;
    margin-bottom: 5px;
}
	.img-responsive{
		display: block;
    	max-width: 100%;
    	height: auto;
	}
</style>
    <b>Hình ảnh thêm:</b><br/>
				<?php if($_REQUEST['act']=="edit"){
					foreach($rs_img as $v){
				?>
				<div class="showimage" id="<?=md5($v['id'])?>">
				
					
					<img src="<?=_upload_sanpham.$v['photo']?>" alt="hình ảnh" class="img-responsive" />
				<a class="remove_image" data-id="<?=$v['id']?>" style="cursor:pointer;">
					<!-- <img src="media/images/delete.png" alt="delete" style="position: absolute;top:0px;right: 0px;" > -->
					<i class="fa fa-times" style="color:red;font-size: 18px;position: absolute;top:0px;right: 0px;padding: 2px;background: #fff;"></i>
				</a>	
					
				
				</div>
				<?php } }?>
				<div style="clear: both"></div>
				<div id="dZUpload" class="dropzone">
					<div class="dz-default dz-message"><img src="media/images/image_add.png" alt="add photo" class="img-responsive" /></div>
				</div>
	<br><br> 
   <b>Tên sản phẩm</b> <input type="text" name="ten" value="<?=$item['ten']?>" class="input" /><br /> 
       
  <!--  <b>Giá gốc</b> <input type="text" name="gia2" value="<?=$item['gia2']?>" class="input" /><span style="text-decoration:line-through;">VNĐ</span><br /> -->
   <b>Giá</b> <input type="text" name="gia" value="<?=$item['gia']?>" class="input" /> VNĐ<br />
  <!--  <b>Mã SP</b> <input type="text" name="maso" value="<?=$item['maso']?>" class="input" /><br />  -->
   <!-- <b>Xuất xứ</b> <input type="text" name="xuatxu" value="<?=$item['xuatxu']?>" class="input" /><br />
   <b>Màu sắc</b> <input type="text" name="mausac" value="<?=$item['mausac']?>" class="input" /><br />
   <b>Kích thước</b> <input type="text" name="kichthuoc" value="<?=$item['kichthuoc']?>" class="input" /><br />
   <b>Kiểu đan</b> <input type="text" name="kieudan" value="<?=$item['kieudan']?>" class="input" /><br /> -->
   <!-- <b>Tình trạng</b> <input type="text" name="tinhtrang" value="<?=$item['tinhtrang']?>" class="input" /><br / -->
   <b>Số lượng</b> <input type="text" name="soluong" value="<?=$item['soluong']?>" class="input" /><br />
 	<b>Mô tả</b>
	 <textarea name="mota" id="mota" cols="50" rows="5"><?=$item['mota']?></textarea>
     <br/>
    <!--<b>Đánh giá:</b>
	 <textarea name="danhgia" id="danhgia" cols="50" rows="5"><?=$item['danhgia']?></textarea>
     <br/>-->
      
   <!--   <b>Nội dung</b><br/>
	<div>
	 <textarea name="noidung" id="noidung"><?=$item['noidung']?></textarea></div> -->
      
      <br/>
	 <b>Keyword</b> <input type="text" name="keyword" value="<?=@$item['keyword']?>" class="input" /><br /><br>
	  <b>Description </b> <div><textarea type="text" cols="50" rows="5" name="description" ><?=@$item['description']?></textarea></div>             
      
	<b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br>
	<b>Hiển thị tin</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br /><br />
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:goback();" class="btn" />
</form>
<link rel="stylesheet" type="text/css" href="media/dropzone/dropzone.css">
<script type="text/javascript" src="media/dropzone/dropzone.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#dZUpload").dropzone({
			url: "../ajax/check.php",
			formName:"frm",
			addRemoveLinks: true,
			paramName:"xfile",
			success: function (file, response) {
				var imgName = response;
				file.previewElement.classList.add("dz-success");
				console.log(file);
			},
			error: function (file, response) {
				file.previewElement.classList.add("dz-error");
			}
		});
		$('.remove_image').click(function(){
			var id=$(this).data("id");

			$.ajax({
				type: "POST",
				url: "ajax/xuly_admin_dn.php",
				data: {id:id, act: 'remove_image'},

				success:function(data){
					//alert(data);
					$jdata = $.parseJSON(data);					
					$("#"+$jdata.md5).fadeOut(500);
					setTimeout(function(){
						$("#"+$jdata.md5).remove();
					}, 1000)
				}
			})
		})
	})
</script>