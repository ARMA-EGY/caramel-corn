jQuery(document).ready(function($) {
	"use strict";
	
  




$('.reflect').click(function(){
		"use strict";
		$(this).toggleClass('reflect1');
		
	});


$('.container1').click(function(){
		"use strict";
		$(this).toggleClass('change');
		
	});
	
	
$('.slide_box').click(function(){
		
	
		$(this).find('.rotate').toggleClass('rotate-180');
		
	});

	
$(document).on('change', '.select_page', function()
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
	
	
		$(document).on('click', '.show_grid', function()
        {
			
			var selected = $(this).attr('data-show');
			var target   = $(this).attr('data-target');
			
			var active 	 = target + " " + selected ;
			var unactive = target + " " + '.fade' ;
			
			
			$(this).siblings('.show_grid').removeClass('active');
			$(this).addClass('active');
			
			$(unactive).removeClass('show');
			$(active).addClass('show');
			
		});
	
	
		$(document).on('click', '.show_grid2', function()
        {
			
			var selected = $(this).attr('data-show');
			var target   = $(this).attr('data-target');
			
			var active 	 = target + " " + selected ;
			var unactive = target + " " + '.fade' ;
			
			
			$(this).siblings('.show_grid2').removeClass('active');
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
		  slidesToShow: 6,
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
	
	
	
	// ==========================  Browse Filter  ==========================
	
$('.filter_form').submit(function(e){
	
	e.preventDefault();
		
	
	$('#browse').html('<img class="m-auto" src="layout/img/loader.gif" width="75">');
	
	$.ajax({
			url: 		'ajax.php',
			method: 	'POST',
			dataType: 	'text',
			data:		$(this).serialize()	,
			success : function(response)
				 {
					$('#browse').html(response);
				 }
		});
	
});


	
	// ==========================  Section Color and Data  ==========================
	
	$('.section').click(function(){
		
		var color 		= $(this).attr('data-color');
		var user_id 	= $(this).attr('data-user');
	//	var section 	= 'include/sections/' + $(this).attr('data-section') + '.php';
		
		$('.section').css({"color": '#fff'});
		
    	$(this).css({"color": color});
		
		
	});

	
	
	// ==========================  Get Section Data  ==========================
	
	$(document).on('click', '.toggle_type', function()
        {
		
		var kind 		= $(this).attr('data-kind');
		var type 		= $(this).attr('data-type');
		var target 		= $(this).attr('data-target');
		var user_id 	= $(this).attr('data-user');
		
		$(this).siblings('.toggle_type').removeClass('active');
		$(this).addClass('active');
		
	    $(target).html('<img class="d-flex m-auto" src="layout/img/loader.gif" width="75">');
		
		$.ajax({
					url: 		'ajax.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{ 
								 toggle_type 	 : type,
								 kind 	 	 	 : kind,
								 user_id 	 	 : user_id
								 
								}	,
					success : function(response)
							 {
								$(target).html(response);
							 }
				});
		
		
	});
	
	
	// ==========================  Add To / Remove From (Favorites, Likes, Watchlist)  ==========================
	
 const Toast = Swal.mixin({
	  toast: true,
	  position: 'top-end',
	  showConfirmButton: false,
	  timer: 3000,
	  timerProgressBar: true,
	  onOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer)
		toast.addEventListener('mouseleave', Swal.resumeTimer)
	  }
	})
	
 
 
	$('.add_to').click(function()
	 {
		
		var user_id = $(this).attr('data-userid');
		var name 	= $(this).attr('data-name');
		var tmdb 	= $(this).attr('data-tmdb');
		var imdb 	= $(this).attr('data-imdb');
		var type    = $(this).attr('data-type');
		var kind    = $(this).attr('data-kind');
		var icon    = $(this).attr('data-icon');
		
		var dis 	= $(this) ;
		
		if ($(this).hasClass('added') )
			{
				var title = '( ' + name + ' ) Removed from ' + kind + ' ' + icon + ' Successfully .';
				
				$.ajax({
					url: 		'ajax.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{remove_from : kind, 
								 name 		 : name, 
								 tmdb 		 : tmdb, 
								 imdb 	 	 : imdb, 
								 type 	 	 : type, 
								 user_id 	 : user_id
								}	,
					success : function(response)
							 {
								Toast.fire({
								  icon: 'success',
								  title: title
								})
								 
								dis.removeClass('added')
							 }
				});
			}
			else
			{
				var title = '( ' + name + ' ) Added to ' + kind + ' ' + icon + ' Successfully .';
					
				$.ajax({
					url: 		'ajax.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{add_to      : kind,
								 name 		 : name, 
								 tmdb 		 : tmdb, 
								 imdb 	 	 : imdb, 
								 type 	 	 : type, 
								 user_id 	 : user_id
								}	,
					success : function(response)
							 {
								Toast.fire({
								  icon: 'success',
								  title: title
								})
								 
								dis.addClass('added')
							 }
				});
			}
		
	});
	
	

});

