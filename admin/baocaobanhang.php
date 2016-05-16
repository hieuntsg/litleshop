<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './lib/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$login_name = 'admin';
	
	function tinhtrang($i=0)
	{
		$sql="select * from table_tinhtrang order by id";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_tinhtrang" name="id_tinhtrang" class="main_font">					
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$i)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["trangthai"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	
	$d = new database($config['database']);
			$tongthu=0;
		$tongchi=0;
	$sql="select id,madonhang,hoten,dienthoai,diachi,email,tonggia,ngaytao,trangthai  from #_donhang";
	
	
	if(!empty($_POST)){
		
		$ngaybatdau = $_POST['datefrm'];		
	$Ngay_arr = explode("/",$ngaybatdau); // array(17,11,2010)
	if (count($Ngay_arr)==3) {
		$ngay = $Ngay_arr[0]; //17
		$thang = $Ngay_arr[1]; //11
		$nam = $Ngay_arr[2]; //2010
		if (checkdate($thang,$ngay,$nam)==false){ $coloi=true; $error_ngaysinh = "Bạn nhập chưa đúng ngày sinh<br>";} else $ngaybatdau=$nam."-".$thang."-".$ngay;
	}	
		$ngaybatdau = (int)strtotime($ngaybatdau);
		
			
				$ngayketthuc = $_POST['dateto'];		
	$Ngay_arr = explode("/",$ngayketthuc); // array(17,11,2010)
	if (count($Ngay_arr)==3) {
		$ngay = $Ngay_arr[0]; //17
		$thang = $Ngay_arr[1]; //11
		$nam = $Ngay_arr[2]; //2010
		if (checkdate($thang,$ngay,$nam)==false){ $coloi=true; $error_ngaysinh = "Bạn nhập chưa đúng ngày sinh<br>";} else $ngayketthuc=$nam."-".$thang."-".$ngay;
	}	
		$ngayketthuc = (int)strtotime($ngayketthuc);
		
		
		$trangthai = $_POST['id_tinhtrang'];	
		$sql.=	" where ( ngaytao > $ngaybatdau OR $ngaybatdau=0 ) and ( ngaytao <= $ngayketthuc OR $ngayketthuc=0) and trangthai='$trangthai'";
	}
	
	
	$d->reset();
		 $sql.=" order by ngaytao desc";
		$d->query($sql);
		$result=$d->result_array();
		
		
	/*if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){
		redirect("index.php?com=user&act=login");
	}*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Báo cáo đơn hàng</title>
<style>
body{
	margin:0px;
	padding:0px;
	font-family:Tahoma, Geneva, sans-serif;
	font-size:12px;
	line-height:1.5;
}
table,tr,td {border-collapse: collapse;font-size:12px; text-align:center;}
.thongbao{	
    border: 1px solid #0C0;
    border-radius: 5px 5px 5px 5px;
    margin: 0 auto;
    overflow: hidden;
	padding:15px;
}
.tablelienhe span{
	color:#F00;
}
.tablelienhe td{ height:25px;}
.tablelienhe .input,.tablelienhe textarea{
	border: 1px #E9E9E9 solid;
	azimuth:center;	
	width:300px;
	
}
.tablelienhe .title{text-transform:uppercase; color:#FFF; background:#0066FF; text-align:center}
.date{
	margin-bottom:10px;
}
</style>
<link href="media/css/redmond/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="media/scripts/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="media/scripts/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){						
	var dates = $( "#datefm, #dateto" ).datepicker({
			defaultDate: "+1w",
			dateFormat: 'dd/mm/yy',
			changeMonth: true,			
			numberOfMonths: 3,
			onSelect: function( selectedDate ) {
				var option = this.id == "datefm" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
        
		});
</script>

</head>
<body>
<div class="wrapper">
	<div class="date">
    	<form name="frm_date" action="" method="post" enctype="multipart/form-data">Từ ngày: <input type="text" name="datefrm" id="datefm" value="<?php if(!empty($_POST))echo  $_POST['datefrm'];	?>" /> đến ngày: <input type="text" name="dateto" id="dateto" value="<?php if(!empty($_POST))echo  $_POST['dateto'];	?>" />
       <?=tinhtrang()?>
         <input type="submit" name="btnok" value="Xem báo cáo" />
        </form>
    </div>
    
    <div class="result">
    	 <table width="100%" cellpadding="5" cellspacing="0" border="1" class="tablelienhe" bordercolor="#CCCCCC">
                        <tr class="title">
                        <td>STT</td>
                        <td>Mã đơn hàng</td>
                        <td>Họ tên</td>
						<td>Ngày đặt</td>                       
                        <td>Số tiền</td>  
                        <td>Tình trạng</td>                      
                        </tr>  
                   <?php for($i=0,$count=count($result);$i<$count;$i++){
					
					$tongthu=$tongthu+$result[$i]['tonggia'];
					
					?>
                   <tr>
                   	 <td><?=$i+1?></td>        
                     <td><?=$result[$i]['madonhang']?></td>                       
                        <td><?=$result[$i]['hoten']?></td>                       
                        <td><?=date('d-m-Y',$result[$i]['ngaytao'])?></td>
                       <td><?=number_format($result[$i]['tonggia'],0,",",".")." VNĐ";?></td>
                       <td> <?php 
		   		$sql="select trangthai from #_tinhtrang where id= '".$result[$i]['trangthai']."' ";
				$d->query($sql);
				$result1=$d->fetch_array();
				echo $result1['trangthai'];
		   ?></td>
                   </tr>
                   <?php } ?>
         <tr><td colspan="6">Tổng giá trị: <b><?=number_format ($tongthu,0,",",".")." VNĐ";?></b></td></tr>
		</table>
    	
    </div>
</div>
</body>
</html>