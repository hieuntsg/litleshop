<?php
session_start();
@define ( '_template' , '../templates/');
@define ( '_source' , '../sources/');
@define ( '_lib' , '../lib/');
//error_reporting(0);
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";
$d = new database($config['database']);
		$id=$_POST['id'];
		$d->reset();
		$sql_kt="select * from #_mausac1 where id='".$id."'";
		$d->query($sql_kt);
		if($d->num_rows()>0){
			$rs=$d->fetch_array();
			delete_file(_upload_sanpham_l.$rs['photo']);
			
			$sql="delete from #_mausac1 where id='".$id."' ";
			if($d->query($sql)){
				echo json_encode(array("md5"=>md5($id)));
			}
		}
?>

