
<?php  if(!defined('_source')) die("Error");

	 
			$title_bar="Hoạt động - ";
			$sql_tintuc = "select ten,mota,photo,tenkhongdau,id from #_alpum where hienthi=1 and id_item='10' order by id desc";
			$d->query($sql_tintuc);
			$result_video = $d->result_array();
	
	if($_REQUEST['id']!='')
	{
		 $sql_tintuc = "select ten,mota,photo,id from #_alpum where  id='".$_REQUEST['id']."' order by id desc";
			$d->query($sql_tintuc);
			$result_video = $d->result_array();
			$title_bar=$result_video[0]['ten']." - ";
			
		$d->reset();	
		$sql_tintuc = "select photo from #_hinhanh where hienthi=1 and id_photo='".$result_video[0]['id']."' order by id desc";
			$d->query($sql_tintuc);
			$result_hinhanh = $d->result_array();
	}
	

?>