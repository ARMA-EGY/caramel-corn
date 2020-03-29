

<section id="services" class="section-spacing">
	<div style="background: rgba(255, 255, 255, 0.5);padding: 50px 0;">
	
  <div class="container">
 
			<div class="row">
			  <div class="col-sm-12">
				<div class="section-title">

				<h4 class="font-weight-bold title_btn_light" style="color:#fbd747;">On Air  <span style="color:#000;">Tv Show</span></h4>
					

				<a href="#" class="viewall_light">View all <i class="ti-angle-right"></i></a>

				<i class="ti-layout-list-thumb show_grid" data-show=".show_cards_details"></i>

				<i class="ti-layout-grid2 show_grid active" data-show=".show_cards" ></i>

				</div>
			  </div>
			</div>
	  
	  
	  	<div class="p-4">


			<div class="show_cards row justify-content-center fade show">

			<?

				$tv_shows = api_connect("https://api.themoviedb.org/3/tv/on_the_air?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=1");

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


					<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $tv->id?>">
						<div class="poster"> 
							<img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2/<?= $tv->poster_path?>" alt=""/>
						</div>

					</div>

					<div class="d-none">

						<div class="c-body" id="tooltip_content_<?= $tv->id?>">

						 <div class="wrapper">

							<div class="c-title">
								<a href="single.php?movie=<?= $tv->id?>" class="caramel_color"><?= $tv->name?> </a>  
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

			<!-- ==========================================  -->

			<div class="show_cards_details row justify-content-center fade">

			<?

					$i=0;

				foreach(array_slice($tv_shows->results, 0, 15) as $tv )
				{
					if ($tv->original_language == 'en')
					{

					$date =  $tv->first_air_date;
					$newdate = date('j M, Y', strtotime($date));

					$rate = $tv->vote_average * 10 ;

			?>

			  <!-- Start New Card -->
				<div class="col-sm-6">  

					<div class="poster-card">
						<div class="poster"> <img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2/<?= $tv->poster_path?>" alt=""/></div>
						<div class="c-body" style="border-left: 1px solid rgba(255, 255, 255, 0.15);">
						  <div class="wrapper">

							<div class="c-title">
								<a href="single.php?movie=<?= $tv->id?>" class="caramel_color"><?= $tv->name?> </a>  
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

						if($i==5) break;
					} 
				}
			?>	

			</div>	

		</div>	
	  
	  </div>
	</div>
</section>