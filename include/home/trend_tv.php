<?

$playing_now = api_connect("https://api.themoviedb.org/3/trending/tv/week?api_key=df264f8d059253c7e87471ab4809cbbf");


$f_movie_background = $playing_now->results[0]->backdrop_path;

?>
	



	<div class="my-4 tv_trends" style="background: url('https://image.tmdb.org/t/p/w1920_and_h800_multi_faces<?=$f_movie_background?>');background-size: cover;">
		
	 	<div class="container-fluid p-5" style="background: rgba(0,0,0,0.5)">	
		
			<div class="row">
			  <div class="col-sm-12">
				<div class="section-title text-center">

				<h5 class="font-weight-bold title_btn"  >Trending <span style="color: #fff;">Tv Shows</span> </h5>
					
				<a href="tv.php?type=Trending" class="viewall" style="position: absolute; right: 10px;">View all <i class="ti-angle-right"></i></a>

				</div>
			  </div>
			</div>


	    <div class="py-4">

			
			
	<!-- =====================  On-Trend  =====================  -->
				
			<div class="show_trends row justify-content-center center">

			<?

			$i=0;

				foreach(array_slice($playing_now->results, 0, 20) as $movie )
				{
					


					$date =  $movie->first_air_date;
					$newdate = date('j M, Y', strtotime($date));

					$rate = $movie->vote_average * 10 ;

			?>

			  <!-- Start New Card -->
				<div class=" variable_card" data-background="url('https://image.tmdb.org/t/p/w1920_and_h800_multi_faces<?= $movie->backdrop_path?>')">  


					<div class="slick-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
						<div class="poster"> 
							<img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2/<?= $movie->poster_path?>" alt=""/>
						</div>

					</div>

					<div class="d-none">

						<div class="c-body" id="tooltip_content_<?= $movie->id?>">

						 <div class="wrapper">

							<div class="c-title">
								<a href="single.php?tv=<?= $movie->id?>" class="caramel_color"><?= $movie->name?> </a>  
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

							<span class="get_trailer" data-type="tv" data-id="<?= $tv->id?>" ><i class="fa fa-play"></i>Trailer</span>

							<a class="" href="single.php?tv=<?= $movie->id?>" ><i class="fa fa-info" ></i> Details</a>
						</div>


						</div>

					</div>

				</div>

			  <!-- End New Card -->



			<? 
						$i++;

						if($i==10) break;
					
				}
			?>	


			</div>	

				

		</div>	
		
		</div>
	</div>
		