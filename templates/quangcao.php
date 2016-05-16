<?php
	$d->reset();
	$sql_qctrai="select mota,photo from #_quangcao2 where vitri=0 and hienthi=1 order by stt,id desc";
	$result_qctrai=$d->query($sql_qctrai);
	
	$d->reset();
	$sql_qcphai="select mota,photo from #_quangcao2 where vitri=1 and hienthi=1 order by stt,id desc";
	$result_qcphai=$d->query($sql_qcphai);
?>
    <div id="divAdRight" style="DISPLAY: none; POSITION: absolute; TOP: 0px;z-index:999999">
     <?php while($rows_qcphai=mysql_fetch_assoc($result_qcphai)) { ?>
    <a href="<?=$rows_qcphai['mota']?>" target="_blank"><img src="<?=_upload_hinhanh_l.$rows_qcphai['photo']?>" /></a><br/>
	<?php } ?>
	
    </div>
    
    <div id="divAdLeft" style="DISPLAY: none; POSITION: absolute; TOP: 0px">
    <?php while($rows_qctrai=mysql_fetch_assoc($result_qctrai)) { ?>    <a href="<?=$rows_qctrai['mota']?>" target="_blank"><img src="<?=_upload_hinhanh_l.$rows_qctrai['photo']?>" width="150" /></a><br/>
	<?php } ?>     
    </div>
    <script>
        function FloatTopDiv()
        {
            startLX = ((document.body.clientWidth -MainContentW)/2)-LeftBannerW-LeftAdjust , startLY = TopAdjust+80;
            startRX = ((document.body.clientWidth -MainContentW)/2)+MainContentW+RightAdjust , startRY = TopAdjust+80;
            var d = document;
            function ml(id)
            {
                var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
                el.sP=function(x,y){this.style.left=x + 'px';this.style.top=y + 'px';};
                el.x = startRX;
                el.y = startRY;
                return el;
            }
            function m2(id)
            {
                var e2=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
                e2.sP=function(x,y){this.style.left=x + 'px';this.style.top=y + 'px';};
                e2.x = startLX;
                e2.y = startLY;
                return e2;
            }
            window.stayTopLeft=function()
            {
                if (document.documentElement && document.documentElement.scrollTop)
                    var pY =  document.documentElement.scrollTop;
                else if (document.body)
                    var pY =  document.body.scrollTop;
                if (document.body.scrollTop > 30){startLY = 3;startRY = 3;} else {startLY = TopAdjust;startRY = TopAdjust;};
                ftlObj.y += (pY+startRY-ftlObj.y)/16;
                ftlObj.sP(ftlObj.x, ftlObj.y);
                ftlObj2.y += (pY+startLY-ftlObj2.y)/16;
                ftlObj2.sP(ftlObj2.x, ftlObj2.y);
                setTimeout("stayTopLeft()", 1);
            }
            ftlObj = ml("divAdRight");
            //stayTopLeft();
            ftlObj2 = m2("divAdLeft");
            stayTopLeft();
        }
        function ShowAdDiv()
        {
            var objAdDivRight = document.getElementById("divAdRight");
            var objAdDivLeft = document.getElementById("divAdLeft");       
            if (document.body.clientWidth < 1000)
            {
                objAdDivRight.style.display = "none";
                objAdDivLeft.style.display = "none";
            }
            else
            {
                objAdDivRight.style.display = "block";
                objAdDivLeft.style.display = "block";
                FloatTopDiv();
            }
        } 
    </script>
    <script>
    document.write("<script type='text/javascript' language='javascript'>MainContentW = 1150;LeftBannerW = 150;RightBannerW = 150;LeftAdjust = 5;RightAdjust = 5;TopAdjust = 30;ShowAdDiv();window.onresize=ShowAdDiv;;<\/script>");
    </script>
