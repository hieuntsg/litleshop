<?php
include ("configajax.php");
$id=$_REQUEST['id'];
	$d->query("select id, ten_$lang as ten, link from #_video where id=$id ");
	$rs_video = $d->fetch_array();
?>

 <iframe width="250" height="220" src="https://www.youtube.com/embed/<?=getYoutubeIdFromUrl($rs_video['link'])?>" frameborder="0" allowfullscreen></iframe>
  <div class="ten_video"><?=$rs_video['ten']?></div>  