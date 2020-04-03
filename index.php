<?

include('ini.php'); 

?>

	
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
		

		
    </div>
  </div>
	


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




