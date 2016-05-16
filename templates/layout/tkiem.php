<?php
	session_start();
?> 
<style type="text/css">
 .search {
   background:#fff;
    border:1px solid #e5e5e5;
	border-radius:5px;
    float: right;
    height: 36px;
    max-width: 320px;
    margin-right:40px;
    margin-top:5px;
}
 	.lableTextForm {
    clear: left;
    float: left;
    padding: 2px 5px;
    text-align: left;
    width: 267px;
}
.classInputText {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: medium none;
    color: #aaa;
    font-size: 12px;
   
    width: 267px;
}
.lableButton {
    display: block;
    float: left;
 	height:25px;
    text-align: center;
    width: 30px;
}
 </style>

		
        
        <div style="float:right;line-height:25px;//padding-right:15px;//width:150px;">
        <!-- 
        	<h3 style="color:#fff;">
        	<img src="images/phonetop.png" alt="icon" style="vertical-align: middle;"> 
			<?php
				$d->reset();
				$sql="select* from #_hotline where hienthi=1 limit 0,2";
				$d->query($sql);
				$result=$d->result_array();
				foreach($result as $re){
					echo $re['dienthoai'];
				}
			?></h3> -->
           <!--  <a href="gio-hang.html"><img src="images/giohang.png" /> <b>Giỏ hàng : </b></a><b style="color:#dc241a;font-size:16px;">(<?php echo count($_SESSION['cart']); ?>)</b><b>/sp</b>  -->
        </div>
        <div class="search">	
 			<div class="lableTextForm">	
        		<input class="classInputText"  id="keyword" type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm ..." />
            </div>
            <div class="lableButton">
            <!-- <input id="search-button" type="submit" onclick="searchProduct()" title="Tìm kiếm" value="Tìm"> -->
            	<a onclick="searchProduct()" style="cursor:pointer;"><img style="vertical-align:top;margin-top: -1px;margin-left:35px;" src="images/tk.png"></a>
            </div>
        </div>
