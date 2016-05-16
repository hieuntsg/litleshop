<?php if(!defined('_source')) die("Error");
		$d->reset();
			$sql = "select * from table_hoidap where hienthi =1 ";
			$d->query($sql);
			$result_hoidap = $d->result_array();
	
				
						
		$title_bar = "Hỏi đáp - ";
		if(!empty($_POST)){
		
			
			$data['mota'] = $_POST['noidung'];
			$data['ngaytao'] = time();
			$data['hienthi'] =0;
			$d->setTable('hoidap');
			$d->insert($data);
			$meg=" Thông tin đã gữi thành công";
		}else{
		$meg="";
		}
			
	
?>