jQuery(document).ready(function($) {
	"use strict";
	
  

  //wow js animation
  // Animation section
  if ($(".wow").length) {
    var wow = new WOW({
      boxClass: "wow", // animated element css class (default is wow)
      animateClass: "animated", // animation css class (default is animated)
      offset: 0, // distance to the element when triggering the animation (default is 0)
      mobile: true, // trigger animations on mobile devices (default is true)
      live: true // act on asynchronously loaded content (default is true)
    });
    wow.init();
  }



$(window).on("scroll", function() {
	"use strict";
  // Back to top
  if ($(this).scrollTop() > 150) {
    $(".back-top").fadeIn();
  } else {
    $(".back-top").fadeOut();
  }

  // Progress bar
  $(".single-progressbar").each(function() {
    var base = $(this);
    var windowHeight = $(window).height();
    var itemPos = base.offset().top;
    var scrollpos = $(window).scrollTop() + windowHeight - 100;
    if (itemPos <= scrollpos) {
      var auptcoun = base.find(".progress-bar").attr("aria-valuenow");
      base.find(".progress-bar").css({
        width: auptcoun + "%"
      });
      var str = base.find(".skill_per").text();
      var res = str.replace("%", "");
      if (res === 0) {
        $({
          countNumber: 0
        }).animate(
          {
            countNumber: auptcoun
          },
          {
            duration: 1500,
            easing: "linear",
            step: function() {
              base.find(".skill_per").text(Math.ceil(this.countNumber) + "%");
            }
          }
        );
      }
    }
  });
});



$('.reflect').click(function(){
		"use strict";
		$(this).toggleClass('reflect1');
		
	});


$('.container1').click(function(){
		"use strict";
		$(this).toggleClass('change');
		
	});


//$('.navbar li a').click(function(){
//		"use strict";
//		
//		$('html,body').animate({
//			
//			scrollTop: $('#' + $(this).data('scroll')).offset().top - $('.navbar').innerHeight()  
//			
//		},1000);
//		
//	});


	
	$(".select_page").on("change",function() 
        {
            var location = '?page=' + $(this).val();
            window.location.href=location ;

        });
	
	
	

 
  $(".search_bar").keyup(function(){
	  if($(this).val().length > 2)
		 {
			var type =  $('.select-search').val();
			 
    		$("#search_result").fadeIn();
			 
			 $.ajax({
                  url:    'search.php',
                  method:   'POST',
                  dataType:   'text',
                  data:   {search: $(this).val(), type: type} ,
                  success : function(response)
                     {$('#search_result').html(response);}
                });
		 }
	  else
		  {
			 $("#search_result").fadeOut();
		  }
	  
  });

$('.select-search').change(function(){
	
	if($(".search_bar").val().length > 2)
		 {
			var type =  $('.select-search').val();
			 
    		$("#search_result").fadeIn();
			 
			 $.ajax({
                  url:    'search.php',
                  method:   'POST',
                  dataType:   'text',
                  data:   {search: $(".search_bar").val(), type: type} ,
                  success : function(response)
                     {$('#search_result').html(response);}
                });
		 }
	  else
		  {
			 $("#search_result").fadeOut();
		  }
});


	
		// ========================== SHOW NAVBAR WHEN SCROLL   ==========================

	$(window).scroll(function()
	{
		
		if ($(window).scrollTop() > 50 )
			{
				$('.navbar').addClass('scrolled');
			}
		else if ($(window).scrollTop() < 50 )
			{
				$('.navbar').removeClass('scrolled');
			}	
		
	});
	


        $(document).ready(function() {
            $('.tooltip2').tooltipster({
			contentCloning: true, 
			contentAsHTML: true, 
			interactive: true, 
			animation: 'fade',
			side: [ 'left', 'top', 'bottom', 'right'],
		    delay: 200,
			maxWidth: 360,
			minWidth: 200,
		    theme: 'tooltipster-borderless'
			});
        });
	
	
		$('.show_grid').click(function(){
			
			var selected = $(this).attr('data-show');
			
			$(this).siblings('.show_grid').removeClass('active');
			$(this).addClass('active');
			
			$('.playing .fade').removeClass('show');
			
			$(selected).addClass('show');
			
		});
	
		$('.trend_btn').click(function(){
			
			var selected = $(this).attr('data-show');
			
			$(this).siblings('.trend_btn').removeClass('active');
			$(this).addClass('active');
			
			$('.trends .hide').removeClass('hide');
			
			$(selected).addClass('hide');
			
		});



});

