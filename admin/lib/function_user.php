<?php if(!defined('_lib')) die("Error");
#
#	$id_connect : ket noi database
#

function thongtintheoid($id){
	global $d;		
	$sql = "select * from #_user where id='".$id."'";
	$d->query($sql);
	$item = $d->fetch_array();
	return $item;
}
function logout(){	
	session_destroy();
	transfer("Đăng xuất thành công", "index.html");
}

function doitien($tien){	
	$money = number_format($tien,0,',','.').'₫';
	return $money;
}

?>