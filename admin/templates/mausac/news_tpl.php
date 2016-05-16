<h3> <span>Quản lý size</span></h3>
<table class="blue_table">
	<thead>
    	<tr>
        	<th style="width:5%;">Stt</th>
            <th style="width:40%;"> Tên </th>
            <!-- <th style="width:40%;">Hình ảnh</th> -->
         
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
   
    
    
<tbody>
    <?php $i=0; ?>
     <?php
	if(count($news)>0){
	?>
    <?php foreach($news as $one): $i++?>

    	<tr>
        	<td style="width:5%;"><?=$one['stt']?></td>
            <td style="width:40%;"><?=$one['ten']?></td>
            <!-- <td style="width:40%;"><a href="index.php?com=mausac&amp;act=edit&amp;id=<?=$one['id']?>&id_product=<?=$_REQUEST['id_product']?>" style="text-decoration:none;"><img src="<?=_upload_tintuc.$one['photo']?>" width="50" /></a></td> -->
            
            <td>
            	<a href="index.php?com=mausac&amp;act=edit&amp;id=<?=$one['id']?>&id_product=<?=$_REQUEST['id_product']?>">
        			<img src="media/images/edit.png"  border="0"/>
           		</a
            ></td>
            <td>
            	<a href="index.php?com=mausac&amp;act=delete&amp;id=<?=$one['id']?>" onClick="if(!confirm('Bạn có chắc là mình muốn xóa không..?')) return false;">
            		<img src="media/images/delete.png" border="0" />
            	</a>
            </td>
        </tr>
	<?php endforeach;?>
       <? } ?>
    </tbody>
</table>
<span class="black-btn"><a href="index.php?com=mausac&amp;act=add&id_product=<?=$_REQUEST['id_product']?>">+ Thêm</a></span>

<div class="paging"><?=$paging['paging']?></div>