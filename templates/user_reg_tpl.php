<script type="text/javascript">

			
			function setDate( newDate, idDate ) {

				if (document.getElementById('day_'+idDate)) {

					document.getElementById('day_'+idDate).value = newDate.substr(8,10);

				}

				if (document.getElementById('month_'+idDate)) {

					var selMonth = parseInt(newDate.substr(5,7)) - 1;

					document.getElementById('month_'+idDate).options[selMonth].selected = true;

				}

				if (document.getElementById('year_'+idDate)) {

					document.getElementById('year_'+idDate).value = newDate.substr(0,4);

				}

			}

			function daysInFebruary( year ){

				return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );

			}

			function daysInMonth( month, year ) {

				var days = 31;

				switch( true ) {

					case month == 2 :

						days = daysInFebruary( year );

						break;

					case month == 4 || month == 6 || month == 9 || month == 11 :

						days = 30;

						break;

				}

			   return days;

			}

			function checkDate( idDate ) {

				var year = 0;

				var month = 0;

				var day = 0;

				if (document.getElementById('year_'+idDate)) {

					year = document.getElementById('year_'+idDate).value;

				}

				if (document.getElementById('month_'+idDate)) {

					month = document.getElementById('month_'+idDate).value;

				}

				if (document.getElementById('day_'+idDate)) {

					day = document.getElementById('day_'+idDate).value;

				}

				if (day > 0 && month > 0 && year > 0) {

					var days = daysInMonth( month, year );

					if (day > days) {

						day = days;

						document.getElementById('day_'+idDate).value = days;

						var error = 'Only %days% days in the selected month ! Please set the month first.';

						alert( error.replace( '%days%', days ) );

					}

				}

				if (document.getElementById(idDate)) {

					document.getElementById(idDate).value = year+'-'+month+'-'+day;

				}

			}
  </script>
<script type="text/javascript">
$(document).ready(function() {	
//Kiem tra user
	$('#usernameLoading').hide();
	$('#username').blur(function(){
	 	 $('#usernameLoading').show();
     	 $.post("check.php", {
       	 username: $('#username').val()
      	}, function(response){
      	  $('#usernameResult').fadeOut();
      	  setTimeout("finishAjax('usernameResult', '"+escape(response)+"')", 400);
      });
    	return false;
	});



//Kiem tra email
	$('#emailLoading').hide();
	$('#email').blur(function(){
	  $('#emailLoading').show();
      $.post("check.php", {
        email: $('#email').val()
      }, function(response){
        $('#emailResult').fadeOut();
        setTimeout("finishAjax1('emailResult', '"+escape(response)+"')", 400);
      });
    	return false;
	});
});

function finishAjax(id, response) {
  $('#usernameLoading').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
}; //finishAjax

function finishAjax1(id, response) {
  $('#emailLoading').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
} //finishAjax

function validEmail(obj) {
	var s = obj.value;
	for (var i=0; i<s.length; i++)
		if (s.charAt(i)==" "){
			return false;
		}
	var elem, elem1;
	elem=s.split("@");
	if (elem.length!=2)	return false;

	if (elem[0].length==0 || elem[1].length==0)return false;

	if (elem[1].indexOf(".")==-1)	return false;

	elem1=elem[1].split(".");
	for (var i=0; i<elem1.length; i++)
		if (elem1[i].length==0)return false;
	return true;
}//Kiem tra dang email
function IsNumeric(sText)
{
	var ValidChars = "0123456789";
	var IsNumber=true;
	var Char;

	for (i = 0; i < sText.length && IsNumber == true; i++) 
	{ 
		Char = sText.charAt(i); 
		if (ValidChars.indexOf(Char) == -1) 
		{
			IsNumber = false;
		}
	}
	return IsNumber;
}//Kiem tra dang so
function check()
		{
			var frm 	= document.formdktv;
			
			if(frm.username.value=='') 
			{ 
				alert( "<?=_chuatendangnhap?>" );
				frm.username.focus();
				return false;
			}
			if(frm.matkhau.value=='') 
			{ 
				alert( "<?=_chuamatkhau?>" );
				frm.matkhau.focus();
				return false;
			}
			if(frm.golaimatkhau.value=='') 
			{ 
				alert( "<?=_chuanhaplaimatkhau?>" );
				frm.golaimatkhau.focus();
				return false;
			}
			if(frm.hoten.value=='') 
			{ 
				alert( "<?=_chuanhapten?>" );
				frm.hoten.focus();
				return false;
			}
			if(frm.email.value=='') 
			{ 
				alert( "<?=_chuanhapemail?>" );
				frm.email.focus();
				return false;
			}
			if(!validEmail(frm.email)){
				alert('<?=_vuilongnhapdungdiachi?> email');
				frm.email.focus();
				return false;
			}
			
			if(frm.ngaysinh.value=='') 
			{ 
				alert( "<?=_chuanhapngaysinh?>" );
				frm.ngaysinh.focus();
				return false;
			}
			
			if(frm.diachi.value=='') 
			{ 
				alert( "<?=_chuanhapdiachi?>" );
				frm.diachi.focus();
				return false;
			}
			
			if(frm.sodt.value=='') 
			{ 
				alert( "<?=_chuanhapdienthoai?>" );
				frm.sodt.focus();
				return false;
			}
				
			
			if(!IsNumeric(frm.sodt.value)) 
			{ 
				alert( "<?=_vuilongnhapdungdienthoai?>" );
				frm.sodt.focus();
				return false;
			}
			
			if(frm.referrername.value=='') 
			{ 
				alert( "<?=_chuanhapmagioithieu?>" );
				frm.referrername.focus();
				return false;
			}
			
			if(frm.capt.value=='') 
			{ 
				alert( "<?=_chuanhapmabaove?>." );
				frm.capt.focus();
				return false;
			}
						
			frm.submit();		
		}
	function textboxChange(tb, f, sb) 
{
    if (!f) 
    {
        if (tb.value == "") 
        {
            tb.value = sb;
        }
    }
    else 
    {
        if (tb.value == sb)
        {
            tb.value = "";
        }
    }
}	
</script>


	<div class="tcat"><?=_dangkythanhvien?></div>
     <div class="box_content">
    <div class="content">    
  	<?=$thongbao?>
<form action="" method="post" enctype="multipart/form-data" name="formdktv" id="formdktv" onsubmit="return check();">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tablelienhe">
<tr><td width="100" class="tb_border"><?=_tentruycap?></td>
   <td><input name="username" type="text" class="input" id="username" value="<?=$username?>" />     
     <span id="usernameLoading"><img src="images/ajax-loader.gif" /></span>
	<span id="usernameResult"></span></td>
</tr>
<tr><td class="tb_border"><?=_matkhau?></td>
	<td><input name="matkhau" type="password" class="input" id="matkhau" /></td>
</tr>
<tr>
	<td class="tb_border"><?=_golaimatkhau?></td>
    <td> <input name="golaimatkhau" type="password" class="input" id="golaimatkhau" /></td>
</tr>
<tr><td class="tb_border"><?=_hoten?></td>
   <td><input name="hoten" type="text" class="input" id="hoten" value="<?=$hoten?>" /> </td>
</tr>
<tr><td class="tb_border">Email</td>
	<td><input name="email" type="text" class="input" id="email" value="<?=$email?>" size="45" />
        <span id="emailLoading"><img src="images/ajax-loader.gif" /></span>
	<span id="emailResult"></span></td>
</tr>
<tr><td class="tb_border"><?=_gioitinh?></td>
	<td><input name="gioitinh" type="radio" id="gt_0" value=1 checked=checked /><?=_nam?>
       <input type="radio" name="gioitinh" value="0" id="gt_1" /><?=_nu?></td>
</tr>
<tr>
	<td class="tb_border"><?=_ngaysinh?></td>
    <td><select onchange="checkDate('aics_birthday')" id="day_aics_birthday" name="day_aics_birthday">
												<?php
													for($i=1;$i<=31;$i++){
												?>
                                               			<option value="<?=$i?>"><?=$i?></option>
                                               <?php } ?>
                                               </select>                                                
                                               <select onchange="checkDate('aics_birthday')" id="month_aics_birthday" name="month_aics_birthday">						
                                               	<?php
													for($i=1;$i<=12;$i++){
												?>
                                               			<option value="<?=$i?>"><?=_thang?> <?=$i?></option>
                                               <?php } ?>
                                               </select>
                                               <select onchange="checkDate('aics_birthday')" id="year_aics_birthday" name="year_aics_birthday">
                                               <?php
											   	$start=date("Y")-60;        
												for($i=$start;$i<=date("Y");$i++){
											   ?>
                                               <option value="<?=$i?>"><?=$i?></option>
                                               <?php } ?>
                                               </select>
                                               <script>setDate('<?=date("Y-m-d");  ?>','aics_birthday')</script></td>
</tr>
<tr><td class="tb_border"><?=_diachi?></td>
	<td><input name="diachi" type="text" class="input" id="diachi" value="<?=$diachi?>" size="45" />
       </td>
</tr>
<tr><td class="tb_border"><?=_dienthoai?></b></td>
	<td><input name="sodt" type="text" class="input" id="sodt" value="<?=$sodt?>" size="45" />
       </td>
</tr>
<tr>
  <td class="tb_border"><?=_mabaove?></td>
  <td>
   &nbsp;&nbsp; <input type="text" name="capt" id="capt"  class="input"/>     <img src="captcha_image.php" align="left"/><br/>
  
    </td>
</tr>

<tr><td colspan="2" align="center">    <br/>   
       <input type="submit" name="btndangky" id="btndangky" value="<?=_dangky?>" class="button" /> <input type="reset" value="<?=_huy?>" class="button"  />
	</td>
</tr>
</table>

</form>

    </div>   </div>