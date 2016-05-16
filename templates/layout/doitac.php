<?php
	$d->reset();
	$sql="select* from #_logodoitac where hienthi=1";
	$d->query($sql);
	$doitac=$d->result_array();
    ?><!--
  jQuery library
-->
<!--<script type="text/javascript" src="../lib/jquery-1.4.2.min.js"></script>
--><!--
  jCarousel library
-->
<script type="text/javascript" src="lib/jquery.jcarousel.js"></script>
<!--
  jCarousel skin stylesheets
-->
<link rel="stylesheet" type="text/css" href="skins/tango/skin.css" />
<link rel="stylesheet" type="text/css" href="skins/ie7/skin.css" />
<link rel="stylesheet" type="text/css" href="skins/ie8/skin.css" />

<script type="text/javascript">

jQuery(document).ready(function() {
    // Initialise the first and second carousel by class selector.
	// Note that they use both the same configuration options (none in this case).
	jQuery('.first-and-second-carousel').jcarousel({wrap: 'circular',
	scroll :1,
		auto: 1,
		start: 6
	});
	
	// If you want to use a caoursel with different configuration options,
	// you have to initialise it seperately.
	// We do it by an id selector here.
	
});

</script>

  <ul id="second-carousel" class="first-and-second-carousel jcarousel-skin-ie8">
  <?php
  for($i=0;$i<count($doitac);$i++)
  {
  ?>
    <li>
	<a href="<?=$doitac[$i]['mota']?>" target="_blank">
	<img src="<?=_upload_hinhanh_l.$doitac[$i]['photo']?>" width="250" height="150" alt="" /></a>
	</li>
  <? }?>
  </ul>

