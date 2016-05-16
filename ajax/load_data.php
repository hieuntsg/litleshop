<?php
	include_once  "configajax.php";
	

// KIỂM TRA TỒN TẠI PAGE HAY KHÔNG
$type=$_POST['pag'];
$pag=4;
//die($table);
if(isset($_POST["page"]))
{
	// ĐƯA 2 FILE VÀO TRANG & KHỞI TẠO CLASS
	
	
	$paging1 = new paging_ajax();
	
	
	// ĐẶT CLASS CHO THÀNH PHẦN PHÂN TRANG THEO Ý MUỐN
	$paging1->class_pagination = "phantrang";
	$paging1->class_active = "paginate_button";
	$paging1->class_inactive = "paginate_active";
	$paging1->class_go_button = "go_button";
	$paging1->class_text_total = "total";
	$paging1->class_txt_goto = "txt_go_button";

	// KHỞI TẠO SỐ PHẦN TỬ TRÊN TRANG
    $paging1->per_page = $pag; 	
    
    // LẤY GIÁ TRỊ PAGE THÔNG QUA PHƯƠNG THỨC POST
    $paging1->page = $_POST["page"];
    
	
    // VIẾT CÂU TRUY VẤN & LẤY KẾT QUẢ TRẢ VỀ
    $paging1->text_sql = "select * from table_about where type='".$type."' and noibat=1 and hienthi=1 order by stt,id desc";
    $result_pag_data = $paging1->GetResult();	

    // BIẾN CHỨA KẾT QUẢ TRẢ VỀ
	$message = "";
	$idx=1;
	// DUYỆT MẢNG LẤY KẾT QUẢ
		foreach($result_pag_data as $v){
			$message.='<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="box_news">
					<div class="images">
						<a href="'.$type.'/'.$v["tenkhongdau"].'-'.$v["id"].'.html">
							<img src="timthumb.php?src='._upload_tintuc_l.$v["photo"].'&w=150&h=110&zc=2" alt="'.$v["ten_".$lang].'" class="img-responsive" />
						</a>
					</div>
					<div class="name">
						<a href="'.$type.'/'.$v["tenkhongdau"].'-'.$v["id"].'.html">
							'.$v["ten_".$lang].'
						</a>
						<p>'.$v["mota_".$lang].'</p>
					</div>
					
					<div class="clear"></div>
				</div>
			</div>';
		}
		
	// ĐƯA KẾT QUẢ VÀO PHƯƠNG THỨC LOAD() TRONG LỚP PAGING_AJAX
	$paging1->data = '<div class="data">'. $message.'<div class="clear"></div></div>' ; // Content for Data    

	echo $paging1->Load();  // KẾT QUẢ TRẢ VỀ
		
} 

