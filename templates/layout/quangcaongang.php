<?php
	$d->reset();
	$sql="select * from #_quangcao where hienthi=1 order by stt, id desc";
	$d->query($sql);
	$quangcao=$d->result_array();
?>
<style type="text/css">
    #demo {
     overflow:hidden;
     width: 1000px;
     line-height : 110px;
     /*background:#0F6;*/
    }
    #demo img {
     border: 1px solid #F2F2F2;
	 margin-right:10px;
    }
    #indemo {
     float: left;
     width: 800%;
	 height: 120px;
    }
    #demo1 {
     float: left;
	 height: 120px;
    }
    #demo2 {
     float: left;
    }
</style>
<div id="demo">
<div id="indemo">

    <div id="demo1">
    <? for($i=0;$i<count($quangcao);$i++){?>    <a href="<?=$quangcao[$i]['mota'];?>" title="<?=$quangcao[$i]['mota'];?>" target="_blank"><img src="<?=_upload_hinhanh_l.$quangcao[$i]['photo']?>" height="110"></a>
   <? } ?>
    
    </div>
    <div id="demo2"> 
    </div>
    
</div>
</div>
<script>
    var speed = 10; 
    var tab = document.getElementById("demo");
    var tab1 = document.getElementById("demo1");
    var tab2 = document.getElementById("demo2");
    tab2.innerHTML = tab1.innerHTML;
    function Marquee() {
        if (tab2.offsetWidth - tab.scrollLeft <= 0)
            tab.scrollLeft -= tab1.offsetWidth
        else {
            tab.scrollLeft++;
        }
    }
    var MyMar = setInterval(Marquee, speed);
    tab.onmouseover = function() { clearInterval(MyMar) };
    tab.onmouseout = function() { MyMar = setInterval(Marquee, speed) };
</script>
