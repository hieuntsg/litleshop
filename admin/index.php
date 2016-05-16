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
	$login_name = 'AMTECOL';
	
	$d = new database($config['database']);
	
	switch($com){
			case 'tinlienhe':
			$source = "tinlienhe";
			break;
		case 'thanhvien':
			$source = "thanhvien";
			break;	
		case 'quangcao2':
			$source = "quangcao2";
			break;
		case 'quangcao1':
			$source = "quangcao1";
			break;	
		case 'hoidap':
			$source = "hoidap";
			break;			
		case 'logodoitac':
			$source = "logodoitac";
			break;		
		case 'user':
			$source = "user";
			break;
		case 'banggia':
			$source = "banggia";
			break;
		case 'infodoitac':
			$source = "infodoitac";
			break;	
		case 'alpum':
			$source = "alpum";
			break;		

		case 'about':
			$source = "about";
			break;
		case 'khuyenmai':
			$source = "khuyenmai";
			break;
		case 'dichvu':
			$source = "dichvu";
			break;
		case 'tintuc':
			$source = "tintuc";
			break;
		case 'huongdan':
			$source = "huongdan";
			break;
		case 'giaitri':
			$source = "giaitri";
			break;	
		case 'slider':
			$source = "slider";
			break;	
		case 'footer':
			$source = "footer";
			break;		
		case 'video':
			$source = "video";
			break;
		case 'title':
			$source = "title";
			break;
		case 'lkweb':
			$source = "lkweb";
			break;	
		case 'dactinh':
			$source = "dactinh";
			break;
		
		case 'meta':
			$source = "meta";
			break;

		case 'company':
			$source = "company";
			break;
		case 'lkweb':
			$source = "lkweb";
			break;
		case 'bannerqc':
			$source = "bannerqc";
			break;
		case 'hinhanh':
			$source = "hinhanh";
			break;
	
		case 'careers':
			$source = "Careers";
			break;
		
		case 'quangcao':
			$source = "quangcao";
			break;
			
		case 'lienket':
			$source = "lienket";
			break;
		case 'sanpham':
			$source = "sanpham";
			break;
		case 'danhgiasp':
			$source = "danhgiasp";
			break;

			
		case 'yahoo':
			$source = "yahoo";
			break;
			
		case 'doitac':
			$source = "doitac";
			break;

		case 'contact':
			$source = "contact";
			break;
		
		case 'hotline':
			$source = "hotline";
			break;
		case 'service':
			$source = "service";
			break;
		case 'lienhe':
			$source = "lienhe";
			break;
		//---------------------------------------------------------
		case 'sanpham':
			$source = "sanpham";
			break;
		case 'tuyendung':
			$source = "tuyendung";
			break;
			
		case 'htpp':
			$source = "htpp";
			break;
		case 'tuvan':
			$source = "tuvan";
			break;
		case 'khtb':
			$source = "khtb";
			break;
		case 'doitac':
			$source = "doitac";
			break;
			
		case 'order':
			$source = "donhang";
			break;
		case 'mausac':
			$source = "mausac";
			break;
		case 'mausac1':
			$source = "mausac1";
			break;		
		default: 
			$source = "";
			$template = "index";
			break;
	}
	
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){
		redirect("index.php?com=user&act=login");
	}
	
	if($source!="") include _source.$source.".php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/DTD/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Website Administration</title>
<link href="media/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="media/scripts/jquery.js"></script>
</head>

<body>

<?php if(isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true)){?>  
<div id="wrapper">
	<?php include _template."header_tpl.php"?>
    
    <div id="main"> 
		 
        <!-- Right col -->
        <div id="contentwrapper">
        <div id="content">
          <?php include _template.$template."_tpl.php"?>
        </div>
        </div>
        <!-- End right col -->
        
        <!-- Left col -->
        <div id="leftcol">
          <div class="innertube">
           <?php include _template."menu_tpl.php";?>
          </div>
        </div>
        <!-- End Left col -->
		
			<div class="clr"></div>
    </div>
  <div id="footer">
		<?php include _template."footer_tpl.php"?>
	</div>
</div>
<?php }else{?>   
				<?php include _template.$template."_tpl.php"?>
		<?php }?>
</body>
</html>
