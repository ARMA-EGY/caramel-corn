<?

$today = date("Y-m-d");


$last_month = strtotime("+6 Months");

$end_date =  date("Y-m-27", $last_month) ;


$playing_now = api_connect("https://api.themoviedb.org/3/discover/movie?api_key=df264f8d059253c7e87471ab4809cbbf&language=en&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&primary_release_date.gte=$today&primary_release_date.lte=$end_date&release_date.gte=$today&release_date.lte=$end_date");



?>


	<div class="container">	  
		
		
			<div class="row">
			  <div class="col-sm-12">
				<div class="section-title">

				<h5 class="font-weight-bold title_btn" style="color:#fbd747;">Upcoming <span style="color:#fff;">Movies</span></h5>
					

				<a href="movies.php?type=Upcoming" class="viewall" >View all <i class="ti-angle-right"></i></a>


				</div>
			  </div>
			</div>


		<div class="p-4">


			<div class="show_cards row justify-content-center fade show">

			<?

				

				$i=0;

				foreach(array_slice($playing_now->results, 0, 20) as $movie )
				{
					if ($movie->original_language == 'en' && $movie->poster_path != '' )
					{


					$date =  $movie->release_date;
					$newdate = date('j M, Y', strtotime($date));

					$rate = $movie->vote_average * 10 ;
						
					if ($movie->poster_path == '')
					{
						$img = 'layout/img/no_poster.jpeg';
					}
					else
					{
						$img = 'https://image.tmdb.org/t/p/w185_and_h278_bestv2' . $movie->poster_path ;
					}

			?>

			  <!-- Start New Card -->
				<div class="col-sm-3 variable_card">  


					<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
						<div class="poster"> 
							<a href="single.php?movie=<?= $movie->id?>">
								<img src="<?= $img?>" alt=""/>
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
								<a href="m_browse.php?type=genre&genre=<?= $genre;?>"><?= $cate->$genre_cate;?></a>
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


		</div>	
		
	  
  </div>