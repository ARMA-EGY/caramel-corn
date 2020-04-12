<?

	$playing_now = api_connect("https://api.themoviedb.org/3/movie/now_playing?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=1");

?>

<div class="container">	 
			 
		<div class="row">
			  <div class="col-sm-12">
				<div class="section-title">

				<h5 class="font-weight-bold title_btn" style="color:#fbd747;">Newest <span style="color:#fff;">Movies</span></h5>
					

				<a href="movies.php?type=Newest" class="viewall" >View all <i class="ti-angle-right"></i></a>

				<i class="ti-layout-list-thumb show_grid" data-show=".show_cards_details" data-target="#playing"></i>

				<i class="ti-layout-grid2 show_grid active" data-show=".show_cards" data-target="#playing" ></i>

				</div>
			  </div>
			</div>


		<div class="p-4 playing" id="playing">


			<div class="show_cards row justify-content-center fade show">

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
				<div class="col-sm-3 variable_card">  


					<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
						<div class="poster">
							<a href="single.php?movie=<?= $movie->id?>">
								<img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2<?= $movie->poster_path?>" alt=""/>
							</a>
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
						$i++;

						if($i==5) break;
					} 
				}
			?>	


			</div>	

			<!-- ==========================================  -->

			<div class="show_cards_details row justify-content-center fade ">

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

							<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

							<a class="" href="single.php?movie=<?= $movie->id?>" ><i class="fa fa-info" ></i> Details</a>
							
						</div>

						</div>
					</div>

				</div>

			  <!-- End New Card -->


			<? 
						$i++;

						if($i==5) break;
					} 
				}
			?>	


			</div>	

		</div>		
	
	</div>