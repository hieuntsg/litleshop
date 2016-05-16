<?php
$d->reset();
$sql="select * from #_yahoo where hienthi=1 order by stt, id desc";
$d->query($sql);
$ya=$d->result_array();

?><ul id="support-list">
    <li class="devider"><a href="#">
        <img src="http://opi.yahoo.com/online?u=<?=$ya[0]['yahoo']?>&amp;m=g&amp;t=2" class="yahoo-pic" style="width:80px; float:left">
    	<span> &nbsp; <?=$ya[0]['ten'];?></span></a>
    </li>
    <li><a href="#">
    	 <img src="http://opi.yahoo.com/online?u=<?=$ya[1]['yahoo']?>&amp;m=g&amp;t=2" class="yahoo-pic" style="width:80px; float:left">
        <span> &nbsp; <?=$ya[1]['ten'];?></span></a>
    </li>
</ul>