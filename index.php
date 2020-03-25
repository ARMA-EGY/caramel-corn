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
<!-- Start Playing Now  -->

<section id="about" class="section-spacing">
	<div style="background: rgba(0, 0, 0, 0.75);padding: 75px 0;">
	
 		 <div class="container">
			 
    <div class="row">
      <div class="col-sm-12">
        <div class="section-title">
			
		<h2 class="font-weight-bold mr-4" style="color:#fbd747;">Newest <span style="color:#fff;">Movies</span>

			<a href="#" class="viewall" style="">View all <i class="ti-angle-right"></i></a>
			
			<i class="ti-layout-list-thumb show_grid" data-show=".show_cards_details"></i>

			<i class="ti-layout-grid2 show_grid active" data-show=".show_cards" ></i>
			
		</h2>
			
        </div>
      </div>
    </div>
			 
	 
	  
    <div class="p-4">
	
		
	<div class="show_cards row justify-content-center fade show">
				
	<?

		$playing_now = api_connect("https://api.themoviedb.org/3/movie/now_playing?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=1");

		$i=0;
		
		foreach(array_slice($playing_now->results, 0, 15) as $movie )
		{
			if ($movie->original_language == 'en')
			{
				
			
	    	$date =  $movie->release_date;
			$newdate = date('j M, Y', strtotime($date));
			
			$rate = $movie->vote_average * 10 ;

	?>
		
	  <!-- Start New Card -->
		<div class="col-sm-3 variable_card">  
			
			
			<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
				<div class="poster"> 
					<img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2/<?= $movie->poster_path?>" alt=""/>
				</div>
				
			</div>
			
			<div class="d-none">
					
				<div class="c-body" id="tooltip_content_<?= $movie->id?>">
					
				 <div class="wrapper">
						
					<div class="c-title">
						<a href="single.php?movie=<?= $movie->id?>" class="caramel_color"><?= $movie->title?> </a>  
						<div class="ratings">
						  <div class="empty-stars"></div>
						  <div class="full-stars" style="width:<?= $rate?>%"></div>
						</div>
						<span class="votes">(<?= number_format($movie->vote_count)?> Votes)</span>
					</div>
						
					<div class="rate">
						 <h5 class="text-white font-weight-bold"><?= $movie->vote_average?> </h5>
				  	</div>
					 
					
						
				  </div>

				<p class="c-text mb-2"><?= substr($movie->overview,0,90) . '...'?></p>
					
				<div class="mb-0 field-label" >Relase Date : <span style="color: #fff;"><?= $newdate ?></span></div>
					
					
				<div class="cate mt-3" >
					
					<?
		
						foreach(array_slice($movie->genre_ids, 0, 4) as $genre )
						{
							$genre_cate = '_'.$genre;
							?>
					
					<div class="mb-1 cate_color_<?= $genre;?>">
						<a href="#"><?= $cate->$genre_cate;?></a>
					</div>
					
							<?
						}
		
					?>

				</div>
					
					
				<div class="details mt-3" >

					<a class="" href="#"><i class="fa fa-play"></i>Trailer</a>

					<a class="" href="#" ><i class="fa fa-info" ></i> Details</a>
				</div>
					
					
				</div>
				
			</div>

		</div>
		
	  <!-- End New Card -->
		
			
		
	<? 
				$i++;
				
				if($i==10) break;
			} 
		}
	?>	
		
		
	</div>	
		
	<!-- ================================================= . -->
		
	<div class="show_cards_details row justify-content-center fade">
		
	<?
		
			$i=0;
		
		foreach(array_slice($playing_now->results, 0, 15) as $movie )
		{
			if ($movie->original_language == 'en')
			{
				
	    	$date =  $movie->release_date;
			$newdate = date('j M, Y', strtotime($date));
			
			$rate = $movie->vote_average * 10 ;
			
	?>
		
	  <!-- Start New Card -->
		<div class="col-sm-6">  
				
			<div class="poster-card">
				<div class="poster"> <img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2/<?= $movie->poster_path?>" alt=""/></div>
				<div class="c-body" style="border-left: 1px solid rgba(255, 255, 255, 0.15);">
				  <div class="wrapper">
						
					<div class="c-title">
						<a href="single.php?movie=<?= $movie->id?>" class="caramel_color"><?= $movie->title?> </a>  
						<div class="ratings">
						  <div class="empty-stars"></div>
						  <div class="full-stars" style="width:<?= $rate?>%"></div>
						</div>
						<span class="votes">(<?= number_format($movie->vote_count)?> Votes)</span>
					</div>
						
					<div class="rate">
						 <h5 class="text-white font-weight-bold"><?= $movie->vote_average?> </h5>
				  	</div>
					 
					
						
				  </div>

				<p class="c-text mb-2"><?= substr($movie->overview,0,90) . '...'?></p>
					
				<div class="mb-0 field-label" >Relase Date : <span style="color: #fff;"><?= $newdate ?></span></div>
					
					
				<div class="cate mt-3" >
					
					<?
		
						foreach(array_slice($movie->genre_ids, 0, 4) as $genre )
						{
							$genre_cate = '_'.$genre;
							?>
					
					<div class="mb-1 cate_color_<?= $genre;?>">
						<a href="#"><?= $cate->$genre_cate;?></a>
					</div>
					
							<?
						}
		
					?>

				</div>
					
					
				<div class="details mt-3" style="position: absolute;bottom: 0;">

					<a class="" href="#"><i class="fa fa-play"></i>Trailer</a>

					<a class="" href="#" ><i class="fa fa-info" ></i> Details</a>
				</div>
					
				</div>
			</div>

		</div>
		
	  <!-- End New Card -->
		
		
	<? 
				$i++;
				
				if($i==10) break;
			} 
		}
	?>	
		
		
	</div>	
		
	</div>		
	
	  
	  
	  
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






