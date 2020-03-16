<?

include('include/header.php'); 
include('include/function.php'); 

?>
	

<!-- above is menu -->
<section id="sect" class="header">
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
    <!--end container-->
  </div>
</section>
<!-- End Banner -->

<!-- Movies starts -->
<!-- Start Playing Now  -->
<section id="about" class="section-spacing">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="section-title text-center">
          <h2>Playing Now</h2>
        </div>
      </div>
    </div>
	  
    <div class="row p-4">
		
	<?

		$playing_now = api_connect("https://api.themoviedb.org/3/movie/now_playing?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=1");
		
		foreach(array_slice($playing_now->results, 0, 8) as $movie )
		{
	    	$date =  $movie->release_date;
			$newdate = date('j M, Y', strtotime($date));

	?>
		
	  <!-- Start New Card -->
			<div class="col-sm-6">               
			<div class="poster-card" style="box-shadow: 0 0 5px 1px #000;">
				<div class="poster"> <img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2/<?= $movie->poster_path?>" alt=""/></div>
				<div class="c-body">
					<div class="wrapper">
					<div class="rate">
						 <h5><?= $movie->vote_average?> <p><small class="text-muted">&nbsp;&nbsp;<i class="fa fa-star"></i> </small></p></h5>
				  </div>
				<div class="c-title">
					<a href="single.php?movie=<?= $movie->id?>"><?= $movie->title?> </a>  
					<span class="mt-2"><?= $newdate ?></span>
				</div>
					</div>

				<p class="c-text"><?= substr($movie->overview,0,170) . '...'?></p>
					<div class="details">
				<a class="btn btn-outline-light my-2 my-sm-0" type="submit">View Details</a>
					</div>
				</div>
			</div>

		</div>
		
	  <!-- End New Card -->
		
		
	<? } ?>	
		
	</div>		
	
	  
	  
	  
  </div>
</section>
<!-- End Playing Now -->
<!-- Movies ends -->



<!-- Tv Shows Starts -->
<section id="services" class="section-spacing inverse">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="section-title text-center">
          <h2>Tv Shows</h2>
        </div>
      </div>
    </div>
	  
	      <div class="row p-4">
		
	<?

		$tv_show = api_connect("https://api.themoviedb.org/3/tv/on_the_air?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=1");
		
		foreach(array_slice($tv_show->results, 0, 8) as $tv )
		{
	    	$date =  $tv->first_air_date;
			$newdate = date('j M, Y', strtotime($date));

	?>
		
	  <!-- Start New Card -->
			<div class="col-sm-6">               
			<div class="poster-card" style="box-shadow: 0 0 5px 1px #000;">
				<div class="poster"> <img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2/<?= $tv->poster_path?>" alt=""/></div>
				<div class="c-body">
					<div class="wrapper">
					<div class="rate">
						 <h5><?= $tv->vote_average?> <p><small class="text-muted">&nbsp;&nbsp;<i class="fa fa-star"></i> </small></p></h5>
				  </div>
				<div class="c-title">
					<a href="single.php?movie=<?= $tv->id?>"><?= $tv->name?> </a>  
					<span class="mt-2"><?= $newdate ?></span>
				</div>
					</div>

				<p class="c-text"><?= substr($tv->overview,0,170) . '...'?></p>
					<div class="details">
				<a class="btn btn-outline-light my-2 my-sm-0" type="submit">View Details</a>
					</div>
				</div>
			</div>

		</div>
		
	  <!-- End New Card -->
		
		
	<? } ?>	
		
	</div>	
	  
	  </div>
</section>
<!-- Tv Shows Ends -->

	
	
	<!-- Actors Starts -->
<section id="act" class="section-spacing actor">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="section-title text-center">
          <h2>Popular Actors</h2>
        </div>
      </div>
    </div>
	  
	  <!-- Start Actors Card -->
	  
    <div class="row">
		
		
	<?

		$actors = api_connect("https://api.themoviedb.org/3/trending/person/week?api_key=df264f8d059253c7e87471ab4809cbbf");
		
		foreach(array_slice($actors->results, 0, 8) as $actor )
		{
	?>
		
		<!-- 1 Actor Card Starts -->
		<div class="col-sm-3">
  			<div class="card" style="border-radius: 10px;box-shadow: 0 0 5px 1px #555;">
				<img class="card-img-top" src="https://image.tmdb.org/t/p/w235_and_h235_face/<?= $actor->profile_path?>" alt="<?= $actor->name?>" style="border-radius: 10px 10px 0 0;">
				<div class="card-body text-center">
				  <h5 class="card-title"><?= $actor->name?></h5>
				</div>
			</div>
		</div>
	  <!-- 1 Actor Card Ends -->
	 
	  
	 <? } ?>
	   
	</div>			
	
	
	
	  <!-- End Actors Card -->
	  
	  
	  
	  
  </div>
</section>
<!-- Actors Ends -->
	
<? include('include/footer.php'); ?>
