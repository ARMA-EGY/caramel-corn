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



$imdb 				= api_connect("http://www.omdbapi.com/?i=$movie->imdb_id&plot=full&apikey=88a3eaef");


$yts 				= api_connect("https://yts.mx/api/v2/list_movies.json?query_term=$movie->imdb_id");


$trailers 			= api_connect("https://api.themoviedb.org/3/movie/$movie_id/videos?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");


$casts   			= api_connect("https://api.themoviedb.org/3/movie/$movie_id/credits?api_key=df264f8d059253c7e87471ab4809cbbf");

$recommendations   	= api_connect("https://api.themoviedb.org/3/movie/$movie_id/recommendations?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=1");


$similar   			= api_connect("https://api.themoviedb.org/3/movie/$movie_id/similar?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=1");



?>
	
<style>

	.down-btn
	{
		width: 300px;
		background: radial-gradient(ellipse farthest-corner at right bottom, #FEDB37 0%, #FDB931 8%, #9f7928 30%, #8A6E2F 40%, transparent 80%),
					radial-gradient(ellipse farthest-corner at left top, #FFFFFF 0%, #FFFFAC 8%, #D1B464 25%, #5d4a1f 62.5%, #5d4a1f 100%);
		color: #fff;
		opacity: 0.8;
		transition: all 0.3s linear;
	}

	.down-btn:hover
	{
		opacity: 1;
	}
	
	.action-btn
	{
		width: 40px;
		height: 40px;
		border: 2px solid #fff;
		border-radius: 50%;
		text-align: center;
		justify-content: center;
		align-items: center;
		display: flex;
		cursor: pointer;
		margin: 0px 10px;
    	background: rgba(255, 255, 255, 0.2);
		
	}
	
	.trailer-single-video 
	{
		min-height: 250px;
		max-width: 350px;
		border-radius: 10px;
		box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.3);
	}
	
	.trailers_videos .slick-list, .cridets .slick-list  {
     padding: 10px !important; 
	}
	

</style>

	
<section id="act" class="section-spacing single">
  <div style="background: rgba(0, 0, 0,0.5);padding-top: 66px;padding-bottom: 10px;">
	  
  <div style="background: url('https://image.tmdb.org/t/p/w1920_and_h800_multi_faces<?=$movie->backdrop_path?>');background-size: cover;">
	  
	  
	  
	<div class="container-fluid p-3" style="background: rgba(0,0,0,0.5)">
		<div class="row">
			
			<div class="col-md-4 text-center m-auto wow bounceInLeft" data-wow-delay="1s">
			
		    	<img style="border-radius: 10px; box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.5);" src="https://image.tmdb.org/t/p/w300_and_h450_bestv2/<?= $movie->poster_path?>"  alt=""/> 
				
				<button class="btn my-3 down-btn" data-toggle="modal" data-target="#download_modal"><i class="fas fa-download"></i> Download</button>
			
			
			</div>
			
			
			<div class="col-md-5 pt-4 text-white wow bounceInRight" data-wow-delay="1s">

				  <h3 class="font-weight-bold text-white"><?= $movie->title ?> <span style="font-weight: 100;    color: rgba(255, 255, 255, 0.6);font-size: 14pt;"> (<?= $year ?>)</span></h3> 
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
				   
					<ul style="list-style: none;display: flex;">
						
						<li class="action-btn"><i class="fa fa-bookmark"></i></li>
						<li class="action-btn"><i class="fa fa-heart"></i></li>
						<li class="action-btn"><i class="fa fa-star"></i></li>
						<li class="action-btn"><i class="fa fa-list"></i></li>
						
					</ul>
				   
				   <div class="mb-4">
					   
					   <div class="rating-row mb-1">
							<span title="TMDB Rating" style="width: 90px;display: inline-block;">
								<img src="layout/img/tmdb.svg" width="40" alt="TMDB Rating"> 
						    </span>
							<span style="font-size: 1.25em;font-weight: bold;width: 25px;display: inline-block;"><?= $movie->vote_average?></span>
						   <i class="fas fa-star ml-2 text-warning" style="font-size: 13px;"></i>
						   <span class="votes">(<?= number_format($movie->vote_count)?> Votes)</span>
						</div>
					   
					   <div class="rating-row mb-2">
							<span title="IMDB Rating" style="width: 90px;display: inline-block;">
								<img src="layout/img/imdb.svg" alt="IMDB Rating"> 
						    </span>
							<span style="font-size: 1.25em;font-weight: bold;width: 25px;display: inline-block;"><?= $imdb->imdbRating?></span>
						   <i class="fas fa-star ml-2 text-warning" style="font-size: 13px;"></i>
						   <span class="votes">(<?= $imdb->imdbVotes?> Votes)</span>
						</div>
					   <?

								foreach($imdb->Ratings as $rating )
								{
									if ($rating->Source == 'Rotten Tomatoes')
									{
									?>

						<div class="rating-row ">
							<span title="IMDB Rating" style="width: 90px;display: inline-block;">
								<img src="layout/img/rotten2.png" style="width: 60px;background: #f00;" alt="Rotten Tomatoes Rating">
						    </span>
							<span style="font-size: 1.25em;font-weight: bold;"><?= $rating->Value?></span>
						</div>

									<?
									}
								}

							?>
					  
				   
				   </div>
				   
				   
				 <h4 class="text-white font-weight-bold" style="font-size: 1.3em;">Overview</h4>
				  <p style="max-width: 600px;font-size: 0.9em;"><?= $movie->overview?></p>

				   
				  <div style="background: rgba(255, 255, 255, 0.2);padding: 5px;width: fit-content;border-radius: 5px;box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.5);border: 1px solid rgba(255, 255, 255, 0.5);">
				   <h6>
					   <strong style="width: 150px;display: inline-block;"><i class="far fa-clock" style="color: #3498db;width: 25px;"></i> Run Time</strong>
					   <?= convertToHoursMins($movie->runtime, '%2d hr %02d min');?> 
				   </h6>
				   
				  <h6>
					  <strong style="width: 150px;display: inline-block;"><i class="fas fa-bell" style="color: #e67e22;width: 25px;"></i> Status</strong>
					  <?= $movie->status?>
				   </h6>
				   
				  <h6>
					  <strong style="width: 150px;display: inline-block;"><i class="fas fa-calendar-alt" style="color: #95a5a6;width: 25px;"></i> Release Date</strong>
					  <?= $newdate ?>
				   </h6>
				   
				   <h6>
					   <strong style="width: 150px;display: inline-block;"><i class="fas fa-donate" style="color: #eae634;width: 25px;"></i> Budget</strong>
					   <?= number_format($movie->budget)?> $
				   </h6>
				   
				   <h6>
					   <strong style="width: 150px;display: inline-block;"><i class="far fa-money-bill-alt" style="color: #2ecc71;width: 25px;"></i> Revenue</strong>
					   <?= number_format($movie->revenue)?> $
				   </h6>
					  
				</div>
					  
			  </div>
			
			
			<div class="col-md-3 text-center m-auto">
				<h5 class="text-center text-white font-weight-bold">Similar Movies</h5>
				
				<div class="row justify-content-center m-auto text-center" style="background: rgba(255, 255, 255, 0.25);border-radius: 10px;">
				
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
							<img width="100%" src="https://image.tmdb.org/t/p/w185_and_h278_bestv2/<?= $movie->poster_path?>" alt="" style="border-radius: 10px;box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.3);"/>
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
	  
	  
	  <div class="container-fluid px-5 my-2">
	  
		  	
		<div class="container">	  
		    <div class="col-sm-12">
				<h5 class="font-weight-bold title_btn"  ><span class="text-white">Trailer</span> </h5>
			</div>
		</div>
		  
		  <div class="trailers_videos">
			  
			 <?
	

					foreach($trailers->results as $trailer )
				{
						if ($trailer->type == 'Trailer' )
						{

							$name = $trailer->name;
							$key  = $trailer->key;
							?>
			  
			  	<iframe class="trailer-single-video" width="100%" height="100%" src="https://www.youtube.com/embed/<?=$key ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
			  
			  				<?
							
						}
				}
	
	
			 ?>
		  
		  
		  </div>
		  
		  
		  <div class="container mb-4" style="border-bottom: 1px solid rgba(255, 255, 255, 0.6);"></div>
	  
	  
	  </div>
	  
	  
	  <div class="container">
		  
	  
		<div class="container">	  
		    <div class="col-sm-12">

				<h5 class="font-weight-bold title_btn"  ><span class="text-white">CAST</span> </h5>

				<a href="movies.php?type=Trending" class="viewall" style="position: absolute; right: 10px;">Full Cast & Crew <i class="ti-angle-right"></i></a>

			</div>
		</div>

		<div class=" actor cridets">
		  
		<?
		
		foreach(array_slice($casts->cast, 0, 5) as $actor )
		{
	?>
		
		<!--  Actor Card Starts -->
		<div class=" px-2">
  			<a href="single.php?person=<?= $actor->id?>" class="card person-card transition" style="box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.3);border: none;border-radius: 1rem;">
				<img class="card-img-top" src="https://image.tmdb.org/t/p/w235_and_h235_face<?= $actor->profile_path?>" alt="<?= $actor->name?>" style="">
				<div class=" text-center">
				  <h5 class="card-title text-dark font-weight-bold"><?= $actor->name?></h5>
				  <h6 class="text-dark"><?= $actor->character?></h6>
				</div>
			</a>
		</div>
	    <!--  Actor Card Ends -->
	 
	  
	 <? } ?>
	  
	</div>
		  
		  
		
		  <div class="container mb-4" style="border-bottom: 1px solid rgba(255, 255, 255, 0.6);"></div>
		  
		  	
		<div class="container">	  
		    <div class="col-sm-12">
				<h5 class="font-weight-bold title_btn"  ><span class="text-white">Recommendations</span> </h5>
			</div>
		</div>
		  
		  
	    <div class="py-4 px-5">

			
			
	<!-- =====================  Recommendation Movies  =====================  -->
				
			<div class="row justify-content-center cridets">

			<?
				
				foreach(array_slice($recommendations->results, 0, 10) as $movie )
				{


					$date =  $movie->release_date;
					$newdate = date('j M, Y', strtotime($date));

					$rate = $movie->vote_average * 10 ;

			?>

			  <!-- Start New Card -->
				<div class=" variable_card" data-background="url('https://image.tmdb.org/t/p/w1920_and_h800_multi_faces<?= $movie->backdrop_path?>')">  


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
	  
    <div class="modal-content text-white text-center" style="background: rgba(0, 0, 0, 0.6);box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.4);">
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

