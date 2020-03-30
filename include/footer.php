<?


	$stmt = $conn->prepare("SELECT * FROM footer ORDER BY RAND() LIMIT 1");

	$stmt->execute();
	$row = $stmt->fetch();

	$background = $row['background'];

?>


	
	<section class="section-spacing1" style="background: url('layout/img/footer/<?= $background ?>');background-size: cover;    height: 400px;">
	<div class="footer">

	<b>All Copy Right 2018 &reg  Are Reserved To ARMA.</b>
	
	</div>
	</section>	





	<script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
	<script src="layout/js/bootstrap.min.js"></script>
	<script src="layout/js/java.js"></script>
	<script src="layout/js/wow.min.js"></script>
	<script src="layout/js/tooltipster.main.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

	<script>
		
        new WOW().init();
		
		$('.center').slick({
  		  infinite: true,
		  centerMode: true,
		  centerPadding: '60px',
		  slidesToShow: 6,
		  responsive: [
			{
			  breakpoint: 768,
			  settings: {
				arrows: false,
				centerMode: true,
				centerPadding: '40px',
				slidesToShow: 4
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				centerMode: true,
				centerPadding: '40px',
				slidesToShow: 2
			  }
			}
		  ]
		});
		
		
				
		$('.vertical').slick({
  		  infinite: true,
		  slidesToShow: 6,
			vertical: true,
			verticalSwiping: true,
		  responsive: [
			{
			  breakpoint: 768,
			  settings: {
				arrows: false,
				slidesToShow: 4
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 2
			  }
			}
		  ]
		});
		
		
		
	$('.trailer-card').click(function(){
		
		var background = $(this).attr('data-background');
		
		var video = $(this).attr('data-key');
		
		$(this).siblings('.trailer-card').removeClass('active');
		$(this).addClass('active');
		
		
    	$(".trailer-background").css({"background": background, "background-size": "cover"});
		
		$(".trailer-video").attr("src", video);
		
	});
		
		
			
	$('.trends .slick-arrow').click(function(){
		
		var background = $('.trends .slick-center .variable_card').attr('data-background');
		
    	$(".trends").css({"background": background, "background-size": "cover"});
		
	});
		
			
	$('.tv_trends .slick-arrow').click(function(){
		
		var background = $('.tv_trends .slick-center .variable_card').attr('data-background');
		
    	$(".tv_trends").css({"background": background, "background-size": "cover"});
		
	});
		
	
		
    </script>
	

	
</body>
	
	
	
</html>