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
			var target   = $(this).attr('data-target');
			
			var active 	 = target + " " + selected ;
			var unactive = target + " " + '.fade' ;
			
			
			$(this).siblings('.show_grid').removeClass('active');
			$(this).addClass('active');
			
			$(unactive).removeClass('show');
			$(active).addClass('show');
			
		});
	
	

	// ========================== Scroll to Top ========================== 
	
	
$(window).scroll(function() {
    if ($(this).scrollTop() >= 100) {        // If page is scrolled more than 50px
        $('.back-to-top').fadeIn(500);    // Fade in the arrow
    } else {
        $('.back-to-top').fadeOut(500);   // Else fade out the arrow
    }
});
	
$('.back-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 800);
});
	
	
		
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
	
	
	
		
		$('.trailers_videos').slick({
  		  infinite: true,
		  slidesToShow: 3,
		  responsive: [
			{
			  breakpoint: 768,
			  settings: {
				arrows: false,
				centerMode: true,
				centerPadding: '40px',
				slidesToShow: 2
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				centerMode: true,
				centerPadding: '40px',
				slidesToShow: 1
			  }
			}
		  ]
		});
	
	
		
		$('.cridets').slick({
  		  infinite: true,
		  slidesToShow: 5,
		  responsive: [
			{
			  breakpoint: 768,
			  settings: {
				arrows: false,
				centerMode: true,
				centerPadding: '40px',
				slidesToShow: 3
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
		
	
	
	// ========================== HOVER DROPDOWN MENU   ==========================
	

$('.btn-group').hover(function()
{
	$(this).find('.dropdown-menu').stop(true,false,true).slideToggle("slow");
});
	
	
	// ==========================  SHOW TRAILER  ==========================
	
$('.get_trailer').click(function(){
	
	$('#trailer_body').html('<img src="layout/img/loader.gif" width="75">');
	
	$('#trailer_modal').modal('show');
	
	var type =	$(this).attr('data-type');
	var id   =	$(this).attr('data-id');
	
	$.ajax({
			url: 		'ajax.php',
			method: 	'POST',
			dataType: 	'text',
			data:		{trailer_type: type, 
						 trailer_id: id
						}	,
			success : function(response)
				 {
					$('#trailer_body').html(response);
				 }
		});
	
});



});

