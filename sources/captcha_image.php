<?php //file capcha_image.php
header('Content-type: image/png');
header("Pragma: No-cache");
header("Cache-Control:No-cache, Must-revalidate");
$sokytu=7;  $width = 90;  $height = 22;
$fontsize=12; $x=10; $y=15;  //toạ độ chữ
$do_nghieng=0;
$font = 'font/cour.ttf';//'arial.ttf';
$str= md5(rand(0,9999));  //chữ ngẫu nhiên 
$str = strtoupper(substr($str, 10, $sokytu)); 
session_start();
$_SESSION['captcha_code'] = $str; 
$img = imagecreatetruecolor($width, $height); //tạo hình
$nen = imagecolorallocate($img, 120, 120, 120); //tạo màu cần dùng
$mauchu= imagecolorallocate($img, 255, 255, 255);
$vien = imagecolorallocate($img, 127, 127, 127);
imagefilledrectangle($img, 0, 0, $width-1, $height-1, $nen);
for ($i=0; $i<=$height; $i+=10) ImageLine($img, 0, $i, $width, $i, $vien); 
for ($i=0; $i<=$width; $i+=10) ImageLine($img, $i, 0, $i, $height, $vien); 
imagettftext($img, $fontsize, $do_nghieng, $x, $y, $mauchu, $font, $str);
imagepng($img);
imagedestroy($img);
?>