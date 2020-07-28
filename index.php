<?

include('ini.php'); 

?>

<div id="mainslide">
	
	<div id="slideshow" data-time="5">
		
	<? 
	
	$movie_covers = api_connect("https://api.themoviedb.org/3/trending/movie/week?api_key=df264f8d059253c7e87471ab4809cbbf");	
		
	$tv_covers = api_connect("https://api.themoviedb.org/3/trending/tv/week?api_key=df264f8d059253c7e87471ab4809cbbf");

	foreach (array_slice($movie_covers->results, 0, 10) as $movie_cover)
	{
	?>	
	   <div style="background: url('https://image.tmdb.org/t/p/w1920_and_h800_multi_faces<?= $movie_cover->backdrop_path?>') no-repeat ; background-size:cover; "> 
		   <div style="background: rgba(0, 0, 0,0.7);width: 100%; height: 100%;"></div> 
		</div>
	
	<? } 
	
	foreach (array_slice($tv_covers->results, 0, 7) as $tv_cover)
	{
	?>	
	   <div style="background: url('https://image.tmdb.org/t/p/w1920_and_h800_multi_faces<?= $tv_cover->backdrop_path?>') no-repeat ; background-size:cover; "> 
		   <div style="background: rgba(0, 0, 0,0.7);width: 100%; height: 100%;"></div> 
		</div>
	
	<? } ?>	
		
		
	</div>
	
	
    <div class="banner-content">
    <div class="container">
		
		<div class=" text-white text-white2 col-md-10 px-0 mx-auto mb-5">
		  
			<h1 class="font-weight-bold">All you want is here</h1>
			<div class="my-5" style="background: rgba(0, 0, 0, 0.3);padding: 10px;width: fit-content;border-radius: 5px;border: 0.2px solid rgba(255, 255, 255, 0.3);">
				<h6> <i class="fa fa-check caramel_color mr-2"></i> Add your watchlist.</h6>
				<h6> <i class="fa fa-check caramel_color mr-2"></i> Mark your favorites.</h6>
				<h6> <i class="fa fa-check caramel_color mr-2"></i> Save your lists.</h6>
				<h6> <i class="fa fa-check caramel_color mr-2"></i> Share reviews.</h6>
				<h6> <i class="fa fa-check caramel_color mr-2"></i> Own your library.</h6>
				<h6> <i class="fa fa-check caramel_color mr-2"></i> Check your friends library.</h6>
				<h6> <i class="fa fa-check caramel_color mr-2"></i> Browse all any time.</h6>
				<h6> <i class="fa fa-check caramel_color mr-2"></i> Sign in with one click.</h6>	  
			</div>
			<h6 class="mb-3">Ready to Explore More ?... Get Started your membership Free </h6>
			<button class="btn btn-warning login_modal" data-login="Sign In With ..." style="border-radius: 20px;" > GET STARTED</button>
			
      	</div>
	
<!--
		
	  <div class="row col-md-8 px-0 mx-auto mb-5">
		  
		<div class="top-search">

				<select class="select-search" >
					<option value="movie">Movies</option>
					<option value="tv">TV Show</option>
					<option value="person">Actors</option>
				</select>
			
				<div style="width: 100%; position: relative;">
					<input class="search_bar" type="text" placeholder="Search for a Movie, TV Show or Actor" style="height: 46px;">
					<div id="search_result"></div>
				</div>
			
				<i class="fa fa-search" style="position: absolute;color: #ccc;right: 10px;"></i>

		</div>	  

      </div>
		
-->

		
    </div>
  </div>
	
</div>	


<!-- above is menu -->


<!-- End Banner -->

<!-- Movies starts -->

<section id="about" class="section-spacing">
	<div style="padding-top: 0px;">
	
 
			 
		
	<!-- =====================  Now Playing Movies  =====================  -->
		
		
		<? //include('include/home/now_playing.php'); ?>
		
		
	<!-- =====================  On-Trend   =====================  -->
	
		
		<? //include('include/home/on_trend.php'); ?>
		
		
	<!-- =====================  Upcoming  =====================  -->
		
	
		
		<?  //include('include/home/upcoming.php'); ?>
		
	<!-- =====================  In-Theaters  =====================  -->
		
		
		<? //include('include/home/in_theater.php'); ?>
		  
		
		
		
		
		
		
	</div>
</section>

<!-- End Playing Now -->
<!-- Movies ends -->



<!-- Tv Shows Starts -->


<section id="services" class="section-spacing">
	<div style="padding: 0px 0;">
		

	<!-- =====================  On Air TV Show  =====================  -->
		
		<? //include('include/home/tv_show.php'); ?>
		

	<!-- =====================  Trending TV Show  =====================  -->
		
		<? //include('include/home/trend_tv.php'); ?>
		

	<!-- =====================  What's Popular =====================  -->
		
		<? //include('include/home/popular.php'); ?>
		
		
	</div>
</section>


<!-- Tv Shows Ends -->



		

	
<? include('include/footer.php'); ?>


