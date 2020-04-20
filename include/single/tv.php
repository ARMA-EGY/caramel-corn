<?

$tv = api_connect("https://api.themoviedb.org/3/tv/$tv_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

$title = $tv->name;

$date =  $tv->first_air_date;
$newdate = date('j M, Y', strtotime($date));
$year = date('Y', strtotime($date));

/*================================= VIDEOS API ==========================================	*/

$trailers = api_connect("https://api.themoviedb.org/3/tv/$tv_id/videos?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");


if (!empty($trailers->results) )
{
	$f_key 	  = $trailers->results[0]->key;	
}

/*================================= CAST API ==========================================	*/

$casts    = api_connect("https://api.themoviedb.org/3/tv/$tv_id/credits?api_key=df264f8d059253c7e87471ab4809cbbf");

/*================================= Similar API ==========================================	*/

$similar  = api_connect("https://api.themoviedb.org/3/tv/$tv_id/similar?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=1");

$similar_exist = $similar->total_results;

/*================================= Recommend API ==========================================	*/

$recommendations   	= api_connect("https://api.themoviedb.org/3/tv/$tv_id/recommendations?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=1");

$recomm_exist = $recommendations->total_results;


if ($tv->poster_path == '')
{
	$img = 'layout/img/no_poster.jpeg';
}
else
{
	$img = 'https://image.tmdb.org/t/p/w300_and_h450_bestv2' . $tv->poster_path ;
}


if(isset($_SESSION['access_token']))
{

	 $favorites  =  checkExist('tmdb_id', 'favorites', $tv_id, 'user_id', $user_id );

	 $likes 	 =  checkExist('tmdb_id', 'likes', $tv_id, 'user_id', $user_id );

	 $watchlists =  checkExist('tmdb_id', 'watchlist', $tv_id, 'user_id', $user_id );


	 if ($favorites > 0)
	 {
		 $favorite = 'added';
	 }
	 else
	 {
		 $favorite = '';
	 }

	 if ($likes > 0)
	 {
		 $like = 'added';
	 }
	 else
	 {
		 $like = '';
	 }

	 if ($watchlists > 0)
	 {
		 $watchlist = 'added';
	 }
	 else
	 {
		 $watchlist = '';
	 }

}
else
{
		 $favorite 	= '';
		 $like 		= '';
		 $watchlist = '';
}


?>
	

	
<section id="act" class="section-spacing single">
  <div class="back_layer">
	  
	<!-- =====================  About TV Show  =====================  -->
	  
  		<div style="background: url('https://image.tmdb.org/t/p/w1920_and_h800_multi_faces<?=$tv->backdrop_path?>');background-size: cover;">
	  
	  

			<div class="container-fluid p-3 layer_background">
				<div class="row">

					<div class="col-md-4 text-center m-auto" >

						<img class="poster_img" src="<?= $img?>"  alt=""/> 
						
					</div>


					<div class="col-md-5 pt-4 text-white">

						  <h3 class="font-weight-bold text-white"><?= $tv->name ?> 
							  <a href="t_browse.php?type=year&year=<?= $year ?>" class="movie_year"> (<?= $year ?>)</a>
						  </h3> 


						   <div class="cate my-3" >

									<?

										foreach($tv->genres as $genre )
										{
											$genre_cate = '_'.$genre->id;
											?>

									<div class="mb-1 cate_color_<?= $genre->id;?>">
										<a href="t_browse.php?type=genre&genre=<?= $genre->id;?>"><?= $cate->$genre_cate;?></a>
									</div>

											<?
										}

									?>

							</div>


						   <ul class="action_list">

							   
							   <? if(isset($_SESSION['access_token']))
									{
							   ?>
							   
								<li class="action-btn use_tooltips watchlist_icon add_to <?= $watchlist ?>" data-name="<?= $tv->name ?>" data-tmdb="<?= $tv_id ?>" data-imdb="0" data-type="TV" data-kind="Watchlist" data-userid="<?= $user_id ?>" data-icon="<i class='fa fa-bookmark watchlist-color mx-2'></i>"
									 data-toggle="tooltip" data-placement="bottom" title="Add To Watchlist">
									<i class="fa fa-bookmark"></i>
							    </li>
							   
								<li class="action-btn use_tooltips like_icon add_to <?= $like ?>" data-name="<?= $tv->name ?>" data-tmdb="<?= $tv_id ?>" data-imdb="0" data-type="TV" data-kind="Likes" data-userid="<?= $user_id ?>" data-icon="<i class='fa fa-heart like-color mx-2'></i>" data-toggle="tooltip" data-placement="bottom" title="Like This Movie">
									<i class="fa fa-heart"></i>
							    </li>
							   
								<li class="action-btn use_tooltips favorite_icon add_to <?= $favorite ?>" data-name="<?= $tv->name ?>" data-tmdb="<?= $tv_id ?>" data-imdb="0"  data-type="TV" data-kind="Favorites" data-userid="<?= $user_id ?>" data-icon="<i class='fa fa-star text-warning mx-2'></i>" data-toggle="tooltip" data-placement="bottom" title="Mark as Favorite">
									<i class="fa fa-star"></i>
							    </li>
							   
								<li class="action-btn use_tooltips" data-toggle="tooltip" data-placement="bottom" title="Add To List">
									<i class="fa fa-list"></i>
							    </li>
							   
							   <?
								   }
							   else
								   {
							   ?>
							   
								<li class="action-btn use_tooltips watchlist_icon"
									 data-toggle="tooltip" data-placement="bottom" title="Login to Add To Watchlist">
									<i class="fa fa-bookmark"></i>
							    </li>
							   
								<li class="action-btn use_tooltips like_icon" data-toggle="tooltip" data-placement="bottom" title="Login to Like This Movie">
									<i class="fa fa-heart"></i>
							    </li>
							   
								<li class="action-btn use_tooltips favorite_icon" data-toggle="tooltip" data-placement="bottom" title="Login to Mark as Favorite">
									<i class="fa fa-star"></i>
							    </li>
							   
								<li class="action-btn use_tooltips" data-toggle="tooltip" data-placement="bottom" title="Login to Add To List">
									<i class="fa fa-list"></i>
							    </li>
							   
							   <?
								   }
							   ?>


							</ul>


						   <div class="mb-4">

							   <div class="rating-row mb-1">

									<span class="icon_rating" title="TMDB Rating">
										<img src="layout/img/tmdb.svg" width="40" alt="TMDB Rating"> 
									</span>

									<span class="voting"><?= $tv->vote_average?></span>

									<i class="fas fa-star ml-2 text-warning fs-13"></i>

									<span class="votes">(<?= number_format($tv->vote_count)?> Votes)</span>

								</div>


						   </div>

  

						 <h4 class="text-white font-weight-bold" style="font-size: 1.3em;">Overview</h4>

						 <p style="max-width: 600px;font-size: 0.9em;"><?= $tv->overview?></p>


					  </div>


					<div class="col-md-3 text-center m-auto">
						

				<!-- =========  Details Box  =========  -->
						
						<div class="text-left text-white mx-auto my-3 details_box">

						   <h6 class="details_row">
							   <strong class="details_icon">
								   <i class="far fa-clock w-25" style="color: #3498db;"></i> Run Time
							   </strong>
							   <? if($tv->episode_run_time[0] > 0)
									{echo  convertToHoursMins($tv->episode_run_time[0], '%2d hr %02d min');}
							 	else{echo '-';}
							   ?> 
						   </h6>

						   <h6 class="details_row">
							  <strong class="details_icon">
								  <i class="fas fa-bell w-25" style="color: #e67e22;"></i> Status
							  </strong>
							  <?= $tv->status?>
						   </h6>

						   <h6 >
							  <strong class="details_icon">
								  <i class="fas fa-calendar-alt w-25" style="color: #95a5a6;"></i> Release Date
							  </strong>
							  <?= $newdate ?>
						   </h6>


						</div>
						
				
				<?
					if($similar_exist > 1)
					{
				?>
						
				<!-- =========  Similar Tv Shows =========  -->

						<h5 class="text-center text-white font-weight-bold">Similar Tv Shows</h5>

						<div class="row justify-content-center m-auto text-center similar_box" >

					<?
						
						foreach(array_slice($similar->results, 0, 4) as $movie )
						{
							$date =  $movie->first_air_date;
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
						<div class="col-md-6 my-2" >  

							<div class=" tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
								<div class="poster"> 
									<a href="single.php?tv=<?= $movie->id?>">
										<img width="75%" src="<?= $img?>" alt="" class="poster_img" />
									</a>
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
										<a href="t_browse.php?type=genre&genre=<?= $genre?>"><?= $cate->$genre_cate;?></a>
									</div>

											<?
										}

									?>

								</div>


								<div class="details mt-3" >

									<span class="get_trailer" data-type="tv" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

									<a class="" href="single.php?tv=<?= $movie->id?>" ><i class="fa fa-info" ></i> Details</a>
								</div>


								</div>

							</div>

						</div>

					  <!-- End New Card -->

					<? } ?>

						</div>

				<? } ?>
						

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
		  
			<?

			if (!empty($trailers->results) )
			{
			?>
			
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
			
			<?
			}
			else
			{
			?>
			
			<div class="py-4"><p class="text-center text-white">There are no videos to display for <?= $title?> .</p></div>
			
			<?
			}
			?>
		  


			<div class="mb-4 hr_light"></div>
	  
	  </div>
	  
	  
	<!-- =====================  CAST  =====================  -->
	  
	  
	  	<div class="container">
			
		  
		    <div class="col-sm-12">
				<h5 class="font-weight-bold title_btn" >
					<span class="text-white">CAST</span> 
				</h5>
				
				<a href="cast.php?tv=<?= $tv_id ?>" class="viewall" style="position: absolute; right: 10px;">Full Cast & Crew <i class="ti-angle-right"></i></a>
			</div>
			

			<ul class=" actor cridets">

		<?

			foreach(array_slice($casts->cast, 0, 6) as $actor )
			{
				if ($actor->profile_path == '')
				{
					if($actor->gender == 1)
					{
						$img = 'layout/img/unknown_female.jpg';
					}
					else
					{
						$img = 'layout/img/unknown_male.jpg';
					}


				}
				else
				{
					$img = 'https://image.tmdb.org/t/p/w235_and_h235_face' . $actor->profile_path ;
				}
		?>

				<!--  Actor Card Starts -->
				<li class="px-3">
					<a href="single.php?person=<?= $actor->id?>" class="card person-card transition cast_card">
						<img class="card-img-top" src="<?= $img?>" alt="<?= $actor->name?>" style="">
						<div class=" text-center mh-70">
						  <h5 class="card-title text-dark font-weight-bold"><?= $actor->name?></h5>
						  <h6 class="text-dark" style="font-size: 9pt;"><?= $actor->character?></h6>
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
				
				<?
					if($recomm_exist > 0)
					{
				?>
			
			
			<div class="row justify-content-center cridets">

			<?
				
				foreach(array_slice($recommendations->results, 0, 10) as $movie )
				{


					$date =  $movie->first_air_date;
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
				
				<div class="variable_card">  

					<div class=" tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
						
						<div class="poster"> 
							<a href="single.php?tv=<?= $movie->id?>">
								<img src="<?= $img?>" alt="" style="border-radius: 10px;box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.3);" width="80%" />
							</a>
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
								<a href="t_browse.php?type=genre&genre=<?= $genre?>"><?= $cate->$genre_cate;?></a>
							</div>

									<?
								}

							?>

						</div>


						<div class="details mt-3" >

							<span class="get_trailer" data-type="tv" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

							<a class="" href="single.php?tv=<?= $movie->id?>" ><i class="fa fa-info" ></i> Details</a>
						</div>


						</div>

					</div>

				</div>

			  <!-- End New Card -->

			<? 
				}
			?>	


			</div>	
			
			<?
					}
					else
					{
						echo '<p class="text-center text-white">We don\'t have enough data to suggest any movies based on '.$title.' .</p>';
					}
			?>

		</div>	
	  
	  
	  </div>
	  
	  
	</div>
	
	</section>




