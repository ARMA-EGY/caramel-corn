<?

	$tv_shows = api_connect("https://api.themoviedb.org/3/tv/airing_today?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=1");


?>

	
  <div class="container">
 
			<div class="row">
			  <div class="col-sm-12">
				<div class="section-title">

				<h5 class="font-weight-bold title_btn_light" style="color:#000;">Tv Shows  <span style="color:#fbd747;">Airing Today</span></h5>
					

				<a href="#" class="viewall_light">View all <i class="ti-angle-right"></i></a>

				</div>
			  </div>
			</div>
	  
	  
	  	<div class="p-4">


			<div class="show_cards row justify-content-center fade show">

			<?


				$i=0;

				foreach(array_slice($tv_shows->results, 0, 20) as $tv )
				{
					if ($tv->original_language == 'en')
					{


					$date =  $tv->first_air_date;
					$newdate = date('j M, Y', strtotime($date));

					$rate = $tv->vote_average * 10 ;

			?>

			  <!-- Start New Card -->
				<div class="col-sm-3 variable_card">  


					<div class="poster-card tooltip2" style="box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.3)" data-tooltip-content="#tooltip_content_<?= $tv->id?>">
						<div class="poster"> 
							<img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2/<?= $tv->poster_path?>" alt=""/>
						</div>

					</div>

					<div class="d-none">

						<div class="c-body" id="tooltip_content_<?= $tv->id?>">

						 <div class="wrapper">

							<div class="c-title">
								<a href="single.php?tv=<?= $tv->id?>" class="caramel_color"><?= $tv->name?> </a>  
								<div class="ratings">
								  <div class="empty-stars"></div>
								  <div class="full-stars" style="width:<?= $rate?>%"></div>
								</div>
								<span class="votes">(<?= number_format($tv->vote_count)?> Votes)</span>
							</div>

							<div class="rate">
								 <h5 class="text-white font-weight-bold"><?= $tv->vote_average?> </h5>
							</div>



						  </div>

						<p class="c-text mb-2"><?= substr($tv->overview,0,90) . '...'?></p>

						<div class="mb-0 field-label" >Relase Date : <span style="color: #fff;"><?= $newdate ?></span></div>


						<div class="cate mt-3" >

							<?

								foreach(array_slice($tv->genre_ids, 0, 4) as $genre )
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

							<a class="" href="single.php?tv=<?= $tv->id?>" ><i class="fa fa-info" ></i> Details</a>
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