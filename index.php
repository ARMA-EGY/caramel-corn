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
	   <div style="background: url('https://image.tmdb.org/t/p/w1920_and_h800_multi_faces<?= $movie_cover->backdrop_path?>') no-repeat ; background-size:100% 100%; "> 
		   <div style="background: rgba(0, 0, 0,0.5);width: 100%; height: 100%;"></div> 
		</div>
	
	<? } 
	
	foreach (array_slice($tv_covers->results, 0, 7) as $tv_cover)
	{
	?>	
	   <div style="background: url('https://image.tmdb.org/t/p/w1920_and_h800_multi_faces<?= $tv_cover->backdrop_path?>') no-repeat ; background-size:100% 100%; "> 
		   <div style="background: rgba(0, 0, 0,0.5);width: 100%; height: 100%;"></div> 
		</div>
	
	<? } ?>	
		
		
	</div>
	
	
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
					<input class="search_bar" type="text" placeholder="Search for a Movie, TV Show or Actor" style="height: 46px;">
					<div id="search_result"></div>
				</div>
			
				<i class="fa fa-search" style="position: absolute;color: #ccc;right: 10px;"></i>

		</div>	  

      </div>
		

		
    </div>
  </div>
	
</div>	


<!-- above is menu -->


<!-- End Banner -->

<!-- Movies starts -->

<section id="about" class="section-spacing">
	<div style="padding-top: 75px;">
	
 
			 
		
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
	<div style="padding: 50px 0;">
		

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


