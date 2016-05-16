<?
	function get_product_name($pid){
		global $d, $row;
		$sql = "select ten from #_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['ten'];
	}
	
	function get_price($pid){
		global $d, $row;
		$sql = "select gia from table_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['gia'];
	}

	function get_quantity($pid){
		global $d, $row;
		$sql = "select soluong from table_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['soluong'];
	}

	function get_img($pid){
		global $d, $row;
		$sql = "select thumb from table_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['thumb'];
	}

	function remove_product($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
		
	}
	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
			$sum+=$price*$q;
		}
		return $sum;
	}
	
	function get_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$sum+=$q;
		}
		return $sum;
	}
	

	
	function addtocart($pid,$q,$size){
		if($pid<1 or $q<1) return;
		
		if(is_array($_SESSION['cart'])){
			if(product_exists($pid)) {
			
			$pid=intval($pid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
			$quan= $_SESSION['cart'][$i]['qty'];
			$_SESSION['cart'][$i]['qty']=$quan + $q; 
				break;
			}
		}
		return $flag;
			
			}
			else {
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['productid']=$pid;
			$_SESSION['cart'][$max]['qty']=$q;  
			$_SESSION['cart'][$max]['size']=$size;
			}
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['productid']=$pid;
			$_SESSION['cart'][0]['qty']=$q;
			$_SESSION['cart'][0]['size']=$size;
		}
	}
	function product_exists($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				$flag=1;
				break;
			}
		}
		return $flag;
	}

?>