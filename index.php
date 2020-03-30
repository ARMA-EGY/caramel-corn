<?

include('ini.php'); 

?>
	

<style>
/* width */
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  background: transparent; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>

<!-- above is menu -->

<section id="sect" class="header">
	

  <div class="banner-content">
    <div class="container">
		
	
		
	  <div class="row col-md-8 px-0 mx-auto mb-5">
		  
		<div class="top-search">

				<select class="select-search" >
					<option value="movie">Movies</option>
					<option value="tv">TV Show</option>
					<option value="person">Actors</option>
				</select>
			
				<div style="width: 100%; position: relative;">
					<input class="search_bar" type="text" placeholder="Search for a Movie, TV Show or Actor">
					<div id="search_result"></div>
				</div>
			
				<i class="fa fa-search" style="position: absolute;color: #ccc;right: 10px;"></i>

		</div>	  

      </div>
		
<!--
		
		<ul class="social-mdedia">
          <li>
            <a href="#about" id="link" class="about">

              <span class=" goToAbout ">
        
      <i class="fa fa-arrow-circle-down"></i>
      </span>
            </a>
          </li>
        </ul>
-->
		
    </div>
  </div>
	

	
<!--
  <div class="banner-content">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 cnt">
          <div class="banner-inner">
            <h1 class="custColor cd-headline clip is-full-width">
								<span class="cd-words-wrapper">
									<b>Do You <i class="fa fa-heart" aria-hidden="true" style="color:red;"></i> Movies</b>
									<b class="is-visible">See What Up Coming</b>
									<b>And Top Rated</b>
								</span>
							</h1>

          </div>

        </div>
        <ul class="social-mdedia">
          <li class="wow bounceInLeft" data-wow-delay="1s"><a href="https://www.facebook.com/mohamedkhaled.elkholy" target="_blank"><i class="fa fa-facebook"></i></a></li>
          <li class="wow bounceInLeft" data-wow-delay="0.5s"><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
          <li class="wow bounceInRight" data-wow-delay="0.7s"><a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
          <li class="wow bounceInRight" data-wow-delay="1.2s"><a href="https://github.com/" target="_blank"><i class="fa fa-github-alt"></i></a></li>
        </ul>
        <ul class="social-mdedia">
          <li>
            <a href="#about" id="link" class="about">

              <span class=" goToAbout ">
        
      <i class="fa fa-arrow-circle-down"></i>
      </span>
            </a>
          </li>
        </ul>

      </div>
    </div>
    end container
  </div>
	
-->
</section>

<!-- End Banner -->

<!-- Movies starts -->

<section id="about" class="section-spacing">
	<div style="background: rgba(0, 0, 0, 0.7);padding-top: 75px;">
	
 
			 
		
	<!-- =====================  Now Playing Movies  =====================  -->
		
		
		<? include('include/home/now_playing.php'); ?>
		
		
	<!-- =====================  On-Trend   =====================  -->
	
		
		<? include('include/home/on_trend.php'); ?>
		
		
	<!-- =====================  Upcoming  =====================  -->
		
	
		
		<?  include('include/home/upcoming.php'); ?>
		
	<!-- =====================  In-Theaters  =====================  -->
		
		
		<? include('include/home/in_theater.php'); ?>
		  
		
		
		
		
		
		
	</div>
</section>

<!-- End Playing Now -->
<!-- Movies ends -->



<!-- Tv Shows Starts -->


<section id="services" class="section-spacing">
	<div style="background: rgba(255, 255, 255, 0.5);padding: 50px 0;">
		

	<!-- =====================  On Air TV Show  =====================  -->
		
		<? include('include/home/tv_show.php'); ?>
		

	<!-- =====================  Trending TV Show  =====================  -->
		
		<? include('include/home/trend_tv.php'); ?>
		

	<!-- =====================  What's Popular =====================  -->
		
		<? include('include/home/popular.php'); ?>
		
		
	</div>
</section>

<!-- Tv Shows Ends -->

	
	
	
<? include('include/footer.php'); ?>






