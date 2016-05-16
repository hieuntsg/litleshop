<style>
	#top{color:#FFF;font-weight:500;text-align:center;width:84px;height:48px;//padding:11px 0px;position:fixed;bottom:40px;right:0px; z-index:99999999; display:none;cursor:pointer;-moz-transition: background-color 0.2s ease-in-out;-ms-transition: background-color 0.2s ease-in-out;-o-transition: background-color 0.2s ease-in-out;-webkit-transition: background-color 0.2s ease-in-out;transition: background-color 0.2s ease-in-out;}
	#top:hover{}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		
		$('body').append('<img id="top" src="images/topback.png" />');
		$(window).scroll(function() {
			if($(window).scrollTop() > 100) {
				$('#top').fadeIn();
			} else {
				$('#top').fadeOut();
			}
	   	});
	   	$('#top').click(function() {
			$('html, body').animate({scrollTop:0},300);
	   	});	   	   	
		
	});
</script>