<?

$person = api_connect("https://api.themoviedb.org/3/person/$person_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");


if ($person->profile_path == '')
{
	if($person->gender == 1)
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
	$img = 'https://image.tmdb.org/t/p/w300_and_h450_face' . $person->profile_path ;
}

/*================================= Known API ==========================================	*/

$known   	= api_connect("https://api.themoviedb.org/3/discover/movie?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&vote_count.gte=10&with_people=$person_id");


/*================================= Acting Movies API ==========================================	*/

$acting_movies  = api_connect("https://api.themoviedb.org/3/person/$person_id/movie_credits?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");


/*================================= Acting TV API ==========================================	*/

$acting_tvs   	= api_connect("https://api.themoviedb.org/3/person/$person_id/tv_credits?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");



if(isset($_SESSION['access_token']))
{

	 $following  =  checkExist('person_id', 'following', $person_id, 'user_id', $user_id );


	 if ($following > 0)
	 {
		 $follow 		= 'added';
		 $follow_text 	= 'Unfollow';
	 }
	 else
	 {
		 $follow 		= '';
		 $follow_text 	= 'Follow';
	 }

}
else
{
		 $follow 		= '';
		 $follow_text 	= 'Follow';
}


if($person->deathday != '')
{
	$date 		= $person->deathday;
	$year2 		= date('Y', strtotime($date));
	$year 		= date('Y', strtotime($person->birthday));
	
	$age 		= $year2 - $year ;
	$age1  		= '' ;
	$age2  		= ' ('.$age. ' years old)' ;
}
else
{
	$date 		= $person->birthday;
	$year 		= date('Y', strtotime($date));
	$year2 		= date('Y');
	
	$age 		= $year2 - $year ;
	$age1  		= ' ('.$age. ' years old)' ;
	$age2  		= '' ;
}


?>
	

	
<section id="act" class="section-spacing single">
  <div class="back_layer">
	  
	<!-- =====================  About Person  =====================  -->
	  

			<div class="container-fluid p-3 layer_background mb-3">
				<div class="row">

					<div class="col-md-3 text-center m-auto" >

						<img class="poster_img" src="<?= $img?>"  alt=""/> 
						

				<!-- =========  Details Box  =========  -->
						
						<div class="text-left text-white mx-auto my-3 details_box" style="background: none;width: 300px;">

						   <h6 class="details_row">
							   <strong class="details_icon mb-1 text-light"> Name </strong>
							   <p class="ml-2 mb-1 font-weight-bold"><?= $person->name ?></p> 
						   </h6>

						   <h6 class="details_row">
							   <strong class="details_icon mb-1 text-light"> Known For </strong>
							   <p class="ml-2 mb-1 font-weight-bold"><?= $person->known_for_department ?></p> 
						   </h6>

						   <h6 class="details_row">
							  <strong class="details_icon mb-1 text-light"> Birthday </strong>
							  <p class="ml-2 mb-1 font-weight-bold"><?= $person->birthday . $age1 ?></p>
						   </h6>
						<?
							if ($person->deathday != '')
							{
						?>
						   <h6 class="details_row">
							  <strong class="details_icon mb-1 text-light"> Deathday </strong>
							  <p class="ml-2 mb-1 font-weight-bold"><?= $person->deathday . $age2?></p>
						   </h6>
						<?	
							}
						?>

						   <h6 class="">
							   <strong class="details_icon mb-1 text-light">Place of Birth  </strong>
							   <p class="ml-2 mb-1 font-weight-bold"><?= $person->place_of_birth ?></p>
							    
						   </h6>

						</div>
						
					</div>


					<div class="col-md-9 pt-4 text-white m-auto pl-4">
						
					   <? if(isset($_SESSION['access_token']))
							{
					   ?>
						
						<button class="btn btn-light my-4 px-3 follow_person <?=$follow?>" style="border-radius: 20px;" data-person="<?=$person_id?>" data-name="<?=$person->name?>" data-user="<?=$user_id?>" data-icon="<i class='fa fa-users follow-color mx-2'></i>" > <?=$follow_text?> </button>
						
						<?
							 }
							 else
							 {
								?>
									<button class="btn btn-light my-4 px-3 login_modal" style="border-radius: 20px;" data-login="Login to Follow <?=$person->name?>" > Follow </button>
						
								<?
							 }
						?>

						<h4 class="text-white font-weight-bold" style="font-size: 1.3em;">Biography</h4>

						<p style="max-width: 800px;font-size: 0.9em;"><?= nl2br($person->biography) ?></p>
						
						  	
						<div class="col-sm-12 mt-4 mb-2">
							<h5 class="font-weight-bold title_btn"  >
								<span class="text-white">Known For</span> 
							</h5>
						</div>



						<div class="py-2 px-5">


							<div class="row justify-content-center cridets">

							<?

								foreach(array_slice($known->results, 0, 10) as $movie )
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

								<div class="variable_card">  

									<div class=" tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">

										<div class="poster"> 
											<a href="single.php?movie=<?= $movie->id?>">
												<img src="<?= $img?>" alt="" style="border-radius: 10px;box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.3);" width="80%" />
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
								}
							?>	


							</div>	


						</div>	

					</div>


				</div>
			</div>
	  
	  
	<!-- =====================  Known Movies  =====================  -->
	  
		  
		<div class="container">
		
	  
			
			<div class="row">
				<div class="col-md-12 pb-3 b-border">

					<div class="font-weight-bold toggle_type active" data-type="movie" data-target="#acting_movies" data-user="<?=$user_id?>">
						<span > Movies </span>
					</div>

					<div class="font-weight-bold toggle_type" data-type="tv" data-target="#acting_tv" data-user="<?=$user_id?>">
						<span >Tv Shows </span>
					</div>

				</div>	
			</div>
			
			<div>
			  
				<div id="acting_movies">
					<ul class="listitems pl-3">
					
					<?

						foreach($acting_movies->cast as $acting_movie )
						{
							if( !isset($acting_movie->release_date) || $acting_movie->release_date == '')
							{

							$character = $acting_movie->character;
							$title = $acting_movie->title;
					?>
							
							<li class="text-white py-2" style="border-bottom: 1px solid #ccc" data-position="9999">
								<span class="caramel_color mr-2">Soon</span>
								<a class="text-white font-weight-bold" href="single.php?movie=<?=$acting_movie->id?>"><?=$title?></a>
								<?
									if($character == '')
									{
										
									}
									else
									{
								?>
								<span class="as"> as </span> 
								<span class="text-light"> <?=$character?> </span>
								<?
									}
								?>
							</li>
						
					<?
								
							}
							else
							{
							
							$date =  $acting_movie->release_date;
							$year = date('Y', strtotime($date));

							$character = $acting_movie->character;
							$title = $acting_movie->title;
					?>
							
							<li class="text-white py-2" style="border-bottom: 1px solid #ccc" data-position="<?=$year?>">
								<span class="caramel_color mr-2"><?=$year?></span>
								<a class="text-white font-weight-bold" href="single.php?movie=<?=$acting_movie->id?>"><?=$title?></a>
									<?
									if($character == '')
									{
										
									}
									else
									{
								?>
								<span class="as"> as </span> 
								<span class="text-light"> <?=$character?> </span>
								<?
									}
								?>
							</li>
						
					<?
								
							}
						}
						 
					?>
						
					</ul>
				</div>

				<div id="acting_tv" class="d-none2">
					
					<ul class="listitems2 pl-3">
					
					<?

						foreach($acting_tvs->cast as $acting_tv )
						{
							$character 	= $acting_tv->character;
							$title 		= $acting_tv->name;
							$episode 	= $acting_tv->episode_count;
							
							
							if($episode  > 1 )
							{
								$episode_num =  ' ( '.$episode. ' episodes ) ';
							}
							else
							{
								$episode_num =  ' ( '.$episode. ' episode ) ';
							}
							
							if($acting_tv->first_air_date == '')
							{

					?>
							
							<li class="text-white py-2" style="border-bottom: 1px solid #ccc" data-position="9999">
								<span class="caramel_color mr-2">Soon</span>
								<a class="text-white font-weight-bold" href="single.php?tv=<?=$acting_tv->id?>"><?=$title?></a>
								<?
									if($character == '')
									{
								?>
								<span class="as"><?=$episode_num?> </span> 
								<?
									}
									else
									{
								?>
								<span class="as"><?=$episode_num?> as </span> 
								<span class="text-light"> <?=$character?> </span>
								<?
									}
								?>
							</li>
						
					<?
								
							}
							else
							{
							
							$date =  $acting_tv->first_air_date;
							$year = date('Y', strtotime($date));
					?>
							
							<li class="text-white py-2" style="border-bottom: 1px solid #ccc" data-position="<?=$year?>">
								<span class="caramel_color mr-2"><?=$year?></span>
								<a class="text-white font-weight-bold" href="single.php?tv=<?=$acting_tv->id?>"><?=$title?></a>
									<?
									if($character == '')
									{
								?>
								<span class="as"><?=$episode_num?> </span> 
								<?
									}
									else
									{
								?>
								<span class="as"><?=$episode_num?> as </span> 
								<span class="text-light"> <?=$character?> </span>
								<?
									}
								?>
							</li>
						
					<?
								
							}
						}
						 
					?>
						
					</ul>
				</div>
				
			</div>
			
			
		
			
	  
	  </div>
	  
	  
	</div>
	
	</section>




