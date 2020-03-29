
<?

$today = date("Y-m-d");


$last_month = strtotime("-2 Months");

$start_from =  date("Y-m-01", $last_month) ;



$playing_now = api_connect("https://api.themoviedb.org/3/discover/movie?api_key=df264f8d059253c7e87471ab4809cbbf&language=en&sort_by=revenue.desc&include_adult=false&include_video=false&page=1&primary_release_date.gte=$start_from&primary_release_date.lte=$today");


$f_movie_id = $playing_now->results[0]->id;

$f_movie_background = $playing_now->results[0]->backdrop_path;

$trailer = api_connect("https://api.themoviedb.org/3/movie/$f_movie_id/videos?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");


$f_key = $trailer->results[0]->key;

?>

<style>

.trailer-card
	{
		display: flex;
		align-items: center;
		cursor: pointer;
	}
	
	
.trailer-card:hover, .trailer-card.active {
    background: rgba(255,255,255,0.3);
    border-top: 1px solid rgba(255, 255, 255, 0.4);
    border-bottom: 1px solid rgba(255, 255, 255, 0.4);
}

</style>

	<div class="mt-4 trailer-background" style="background: url('https://image.tmdb.org/t/p/w1920_and_h800_multi_faces<?=$f_movie_background?>');background-size: cover;">
		<div style="background: rgba(0,0,0,0.5)">
		
	 		<div class="container p-4">	
		
			<div class="row">
			  <div class="col-sm-12">
				<div class="section-title text-center">

				<h4 class="font-weight-bold title_btn"  >Box office <span class="text-white">Movies</span> </h4>
					
				<a href="#" class="viewall" style="position: absolute; right: 10px;">View all <i class="ti-angle-right"></i></a>

				</div>
			  </div>
			</div>


	    <div class="py-4 row">

	<!-- =====================  In-Theaters  =====================  -->
			
			<div class="col-md-8 my-2">
			<iframe class="trailer-video" width="100%" height="100%" src="https://www.youtube.com/embed/<?=$f_key?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" style="
    min-height: 350px;
    max-height: 400px;
    overflow: hidden;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 10px;
    box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.5);
"></iframe>
			
			</div>
			
			
			<div class="col-md-4" style="padding: 20px 5px;
    max-height: 400px;
    overflow: scroll;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 10px;
    box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.5);">

			<?


				
				$i=1;

				foreach(array_slice($playing_now->results, 0, 20) as $movie )
				{
					if ($movie->original_language == 'en' && $movie->vote_count > 20 )
					{
						
						
				$trailers = api_connect("https://api.themoviedb.org/3/movie/$movie->id/videos?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

					foreach($trailers->results as $trailer )
				{
						if ($trailer->type == 'Trailer' )
						{

							$name = $trailer->name;
							$key  = $trailer->key;
							
							break;
						}
				}
					
					$background  = $movie->backdrop_path;
						

					$date =  $movie->release_date;
					$newdate = date('j M, Y', strtotime($date));

					$rate = $movie->vote_average * 10 ;
						
					$counter = $i++;
						
					if ($counter == 1){$active = 'active';}else{$active = '';}

			?>

			  <!-- Start New Card -->
				<div class=" p-1 trailer-card <?=$active?>" data-key="https://www.youtube.com/embed/<?=$key?>" data-background="url('https://image.tmdb.org/t/p/w1920_and_h800_multi_faces<?=$background?>')">  

						<span style="
						color: #fff;
						padding-right: 10px;
						font-weight: bolder;
						font-size: 12pt;
					"><?=$counter;?></span>
					
						<div class=""> 
							<img width="60" src="https://image.tmdb.org/t/p/w185_and_h278_bestv2<?= $movie->poster_path?>" alt=""/>
						</div>
					
					<div class="ml-3 text-white">
						<h6><?= $movie->title?></h6>
						<h6 style="
							font-size: 9pt;
							font-weight: bold;
						"><?= $name?></h6>
					</div>



				</div>

			  <!-- End New Card -->



			<? 
						

						if($i==11) break;
					} 
				}
			?>	


			</div>	
			
			
			
						

		</div>	
		
		</div>
		  
		</div>
	</div>
		



				