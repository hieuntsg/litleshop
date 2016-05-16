<?php

	
	$d->reset();
	$sql="select * from #_quangcao1 where hienthi=1 order by stt,id desc";
	$d->query($sql);
	$thiekekientruc=$d->result_array();

?>
<div style="font-family: utmavo;text-transform: uppercase;font-size: 15px;margin-bottom: 10px;"><img src="images/khachhang.png" alt="icon" style="vertical-align: middle;margin-right: 10px;">Khách hàng tiêu biểu</div>
<ul id="flexiselDemo2" >
    <?php for($i=0;$i<count($thiekekientruc);$i++){?>
        <li><a href="<?=$thiekekientruc[$i]['mota']?>" ><img style="width: 223px;height: 145px;"  src="<?=_upload_hinhanh_l.$thiekekientruc[$i]['photo']?>"  alt="slider"/></a>
            <div align="center"><a href="<?=$thiekekientruc[$i]['link']?>" ><?=$thiekekientruc[$i]['ten']?></a></div>     
        </li>
    <?php } ?>      
</ul> 
<script type="text/javascript">
    $("#flexiselDemo2").flexisel({
        visibleItems: 5,
        animationSpeed: 1000,
        autoPlay: true,
        autoPlaySpeed: 3000,            
        pauseOnHover: true,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: { 
            portrait: { 
                changePoint:520,
                visibleItems: 1
            }, 
            landscape: { 
                changePoint:800,
                visibleItems: 2
            },
            
            tablet: { 
                changePoint:1000,
                visibleItems: 3
            }
        }
    });
</script>