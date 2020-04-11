<?

include('ini.php'); 


if(isset($_GET['movie']))
{
	$movie_id = $_GET['movie'];
}


$movie = api_connect("https://api.themoviedb.org/3/movie/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

$date =  $movie->release_date;
$newdate = date('j M, Y', strtotime($date));
$year = date('Y', strtotime($date));

/*================================= IMDB API   ==========================================	*/

$imdb     = api_connect("http://www.omdbapi.com/?i=$movie->imdb_id&plot=full&apikey=88a3eaef");

/*================================= YTS API   ==========================================	*/

$yts 	  = api_connect("https://yts.mx/api/v2/list_movies.json?query_term=$movie->imdb_id");

/*================================= VIDEOS API ==========================================	*/

$trailers = api_connect("https://api.themoviedb.org/3/movie/$movie_id/videos?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

$f_key 	  = $trailers->results[0]->key;

/*================================= CAST API ==========================================	*/

$casts    = api_connect("https://api.themoviedb.org/3/movie/$movie_id/credits?api_key=df264f8d059253c7e87471ab4809cbbf");

/*================================= Similar API ==========================================	*/

$similar  = api_connect("https://api.themoviedb.org/3/movie/$movie_id/similar?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=1");

/*================================= Recommend API ==========================================	*/

$recommendations   	= api_connect("https://api.themoviedb.org/3/movie/$movie_id/recommendations?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=1");


?>
	

	
<section id="act" class="section-spacing single">
  <div class="back_layer">
	  
	<!-- =====================  About Movie  =====================  -->
	  
  		<div style="background: url('https://image.tmdb.org/t/p/w1920_and_h800_multi_faces<?=$movie->backdrop_path?>');background-size: cover;">
	  
	  

			<div class="container-fluid p-3 layer_background">
				<div class="row">

					<div class="col-md-4 text-center m-auto" >

						<img class="poster_img" src="https://image.tmdb.org/t/p/w300_and_h450_bestv2/<?= $movie->poster_path?>"  alt=""/> 

						<button class="btn my-3 text-white down-btn" data-toggle="modal" data-target="#download_modal"><i class="fas fa-download"></i> Download</button>

					</div>


					<div class="col-md-5 pt-4 text-white">

						  <h3 class="font-weight-bold text-white"><?= $movie->title ?> 
							  <span class="movie_year"> (<?= $year ?>)</span>
						  </h3> 


						   <div class="cate my-3" >

									<?

										foreach($movie->genres as $genre )
										{
											$genre_cate = '_'.$genre->id;
											?>

									<div class="mb-1 cate_color_<?= $genre->id;?>">
										<a href="#"><?= $cate->$genre_cate;?></a>
									</div>

											<?
										}

									?>

							</div>


						   <ul class="action_list">

								<li class="action-btn use_tooltips watchlist_icon" data-toggle="tooltip" data-placement="bottom" title="Add To Watchlist">
									<i class="fa fa-bookmark"></i>
							    </li>
							   
								<li class="action-btn use_tooltips like_icon" data-toggle="tooltip" data-placement="bottom" title="Like This Movie">
									<i class="fa fa-heart"></i>
							    </li>
							   
								<li class="action-btn use_tooltips favorite_icon" data-toggle="tooltip" data-placement="bottom" title="Add To Favorites">
									<i class="fa fa-star"></i>
							    </li>
							   
								<li class="action-btn use_tooltips" data-toggle="tooltip" data-placement="bottom" title="Add To My List">
									<i class="fa fa-list"></i>
							    </li>

							</ul>


						   <div class="mb-4">

							   <div class="rating-row mb-1">

									<span class="icon_rating" title="TMDB Rating">
										<img src="layout/img/tmdb.svg" width="40" alt="TMDB Rating"> 
									</span>

									<span class="voting"><?= $movie->vote_average?></span>

									<i class="fas fa-star ml-2 text-warning fs-13"></i>

									<span class="votes">(<?= number_format($movie->vote_count)?> Votes)</span>

								</div>

							   <div class="rating-row mb-2">

									<span class="icon_rating" title="IMDB Rating">
										<img src="layout/img/imdb.svg" alt="IMDB Rating"> 
									</span>

									<span class="voting" ><?= $imdb->imdbRating?></span>

									<i class="fas fa-star ml-2 text-warning fs-13"></i>

									<span class="votes">(<?= $imdb->imdbVotes?> Votes)</span>

								</div>
							   <?

										foreach($imdb->Ratings as $rating )
										{
											if ($rating->Source == 'Rotten Tomatoes')
											{
											?>

								<div class="rating-row ">

									<span class="icon_rating" title="IMDB Rating">
										<img src="layout/img/rotten2.png" style="width: 60px;background: #f00;" alt="Rotten Tomatoes Rating">
									</span>

									<span class="voting"><?= $rating->Value?></span>

								</div>

											<?
											}
										}

									?>


						   </div>


						 <h6 class="text-white font-weight-bold" ><?= ucwords($movie->tagline) ?></h6>   

						 <h4 class="text-white font-weight-bold" style="font-size: 1.3em;">Overview</h4>

						 <p style="max-width: 600px;font-size: 0.9em;"><?= $movie->overview?></p>


					  </div>


					<div class="col-md-3 text-center m-auto">
						

				<!-- =========  Details Box  =========  -->
						
						<div class="text-left text-white mx-auto my-3 details_box">

						   <h6 class="details_row">
							   <strong class="details_icon">
								   <i class="far fa-clock w-25" style="color: #3498db;"></i> Run Time
							   </strong>
							   <?= convertToHoursMins($movie->runtime, '%2d hr %02d min');?> 
						   </h6>

						   <h6 class="details_row">
							  <strong class="details_icon">
								  <i class="fas fa-bell w-25" style="color: #e67e22;"></i> Status
							  </strong>
							  <?= $movie->status?>
						   </h6>

						   <h6 class="details_row">
							  <strong class="details_icon">
								  <i class="fas fa-calendar-alt w-25" style="color: #95a5a6;"></i> Release Date
							  </strong>
							  <?= $newdate ?>
						   </h6>

						   <h6 class="details_row">
							   <strong class="details_icon">
								   <i class="fas fa-donate w-25" style="color: #eae634;"></i> Budget
							   </strong>
							   <?= number_format($movie->budget)?> $
						   </h6>

						   <h6>
							   <strong class="details_icon">
								   <i class="far fa-money-bill-alt w-25" style="color: #2ecc71;"></i> Revenue
							   </strong>
							   <?= number_format($movie->revenue)?> $
						   </h6>

						</div>
						
						
				<!-- =========  Similar Movies =========  -->

						<h5 class="text-center text-white font-weight-bold">Similar Movies</h5>

						<div class="row justify-content-center m-auto text-center similar_box" >

					<?
						foreach(array_slice($similar->results, 0, 4) as $movie )
						{
							$date =  $movie->release_date;
							$newdate = date('j M, Y', strtotime($date));
							$rate = $movie->vote_average * 10 ;
					?>

					  <!-- Start New Card -->
						<div class="col-md-6 my-2" >  

							<div class=" tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
								<div class="poster"> 
									<img width="75%" src="https://image.tmdb.org/t/p/w185_and_h278_bestv2/<?= $movie->poster_path?>" alt="" class="poster_img" />
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

									<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

									<a class="" href="single.php?movie=<?= $movie->id?>" ><i class="fa fa-info" ></i> Details</a>
								</div>


								</div>

							</div>

						</div>

					  <!-- End New Card -->

					<? } ?>

						</div>

					</div>

				</div>
			</div>
			
	  
		</div>
	  
	  
	<!-- =====================  VIDEOS  =====================  -->
	  
	  
	  	<div class="container my-2">
	  
		    <div class="col-sm-12">
				<h5 class="font-weight-bold title_btn">
					<span class="text-white">Videos</span> 
				</h5>
			</div>
		  
		  
	   		<div class="row py-4">
			
			<div class="col-md-8 my-2">
				
				<iframe class="trailer-video" width="100%" height="100%" src="https://www.youtube.com/embed/<?=$f_key?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
			
			</div>
			
			
			<div class="col-md-4 p-0" style="border-radius: 10px; overflow: hidden;">
				
				<div class="trailer-list">

			<?

				$i = 1;
						

				foreach($trailers->results as $trailer )
				{
						
					$name = $trailer->name;
					$key  = $trailer->key;
						
					$counter = $i++;
						
					if ($counter == 1){$active = 'active';}else{$active = '';}
			?>
					
					
			  <!-- Start New Card -->
				<div class=" p-3 trailer-card <?=$active?>" style="border-bottom: 1px solid #ccc;" data-key="https://www.youtube.com/embed/<?=$key?>">  

						<span class="video_counter"><?=$counter;?></span>
					
						<div class="ml-3 text-white">
							<h6><?= $name?></h6>
						</div>

				</div>

			  <!-- End New Card -->
					
			<?	
				}
			?>
					
			  </div>	
			
			</div>
			
						

			</div>	


			<div class="mb-4 hr_light"></div>
	  
	  </div>
	  
	  
	<!-- =====================  CAST  =====================  -->
	  
	  
	  	<div class="container">
			
		  
		    <div class="col-sm-12">
				<h5 class="font-weight-bold title_btn" >
					<span class="text-white">CAST</span> 
				</h5>
				
				<a href="movies.php?type=Trending" class="viewall" style="position: absolute; right: 10px;">Full Cast & Crew <i class="ti-angle-right"></i></a>
			</div>
			

			<ul class=" actor cridets">

		<?

			foreach(array_slice($casts->cast, 0, 5) as $actor )
			{
		?>

				<!--  Actor Card Starts -->
				<li class="px-3">
					<a href="single.php?person=<?= $actor->id?>" class="card person-card transition cast_card">
						<img class="card-img-top" src="https://image.tmdb.org/t/p/w235_and_h235_face<?= $actor->profile_path?>" alt="<?= $actor->name?>" style="">
						<div class=" text-center mh-70">
						  <h5 class="card-title text-dark font-weight-bold"><?= $actor->name?></h5>
						  <h6 class="text-dark" style="font-size: 10pt;"><?= $actor->character?></h6>
						</div>
					</a>
				</li>
				<!--  Actor Card Ends -->


		 <? } ?>

		  	</ul>
		  
		  
		
			<div class="mb-4 hr_light"></div>
			
		</div>
	  
	  
	<!-- =====================  Recommendation Movies  =====================  -->
	  
		  
		<div class="container">
		  	
		    <div class="col-sm-12">
				<h5 class="font-weight-bold title_btn"  >
					<span class="text-white">Recommendations</span> 
				</h5>
			</div>
			
		  
		  
	    <div class="py-4 px-5">
			
			<div class="row justify-content-center cridets">

			<?
				
				foreach(array_slice($recommendations->results, 0, 10) as $movie )
				{


					$date =  $movie->release_date;
					$newdate = date('j M, Y', strtotime($date));

					$rate = $movie->vote_average * 10 ;

			?>

			  <!-- Start New Card -->
				
				<div class="variable_card">  

					<div class=" tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
						
						<div class="poster"> 
							<img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2/<?= $movie->poster_path?>" alt="" style="border-radius: 10px;box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.3);"/>
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

							<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

							<a class="" href="single.php?movie=<?= $movie->id?>" ><i class="fa fa-info" ></i> Details</a>
						</div>


						</div>

					</div>

				</div>

			  <!-- End New Card -->

			<? 
				}
			?>	


			</div>	

		</div>	
	  
	  
	  </div>
	  
	  
	</div>
	
	</section>






<!--==========================Start Modal Download ================================-->

<div class="modal fade" id="download_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	  
    <div class="modal-content text-white text-center download_modal">
	  <div class="modal-header" style="border-bottom: none;">
        <h5 class="modal-title"></h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		
      	<div class="modal-body">
			
			<table class="table table-striped table-hover table-bordered table-dark">
			  <thead>
				<tr>
				  <th scope="col"><i class="fas fa-desktop mr-2"></i> Quality</th>
				  <th scope="col"><i class="fas fa-folder mr-2"></i> Size</th>
				  <th scope="col"></th>
				</tr>
			  </thead>
			  <tbody>
				  
			<?
			
				$downloads = json_encode($yts->data->movies);

				$downs = json_decode($downloads, true); 

				 foreach ($downs as $download)
				 {
					 foreach ($download['torrents'] as $down)
					{
						?>
				  
				  	<tr>
					  <td><?= $down['quality'] . ' .' . ucfirst($down['type']) ; ?></td>
					  <td><?= $down['size']; ?></td>
					  <td><a class="btn btn-success" href="<?= $down['url']; ?>">Download</a></td>
					</tr>
				  
				  		<?
					}
				 }
			
			?>

				


			  </tbody>
			</table>
		
			
		</div>
      <div class="modal-footer" style="border-top: none;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>
	


<? include('include/footer.php'); ?>

