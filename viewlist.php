<?

ob_start();

include('ini.php'); 


if(isset($_GET['u']))
{
	$list_uid = $_GET['u'];
		
	$stmt = $conn->prepare("SELECT * FROM lists WHERE uid = ?");
	$stmt->execute(array($list_uid));
	$row = $stmt->fetch();
	$count = $stmt->rowCount();

	if ($count > 0 )
	{
		if(isset($_SESSION['access_token']))
		{

			if($row['user_id'] == $user_id)
			{
					$stmt = $conn->prepare("SELECT * FROM lists WHERE uid = ? AND user_id = ? ");
					$stmt->execute(array($list_uid, $user_id));
					$row = $stmt->fetch();

					$list_id = $row['id'];

					$stmt = $conn->prepare("SELECT * FROM movie_list WHERE list_id = ? AND type = 'Movie' ORDER BY id DESC");
					$stmt->execute(array($list_id));
					$rows = $stmt->fetchAll();
					$result = $stmt->rowCount();

					$stmt3 = $conn->prepare("SELECT * FROM movie_list WHERE list_id = ? AND type = 'TV' ORDER BY id DESC");
					$stmt3->execute(array($list_id));
					$rows3 = $stmt3->fetchAll();
					$result2 = $stmt3->rowCount();

					if ($row['cover'] == '' )
					{
						$cover = 'layout/img/popcorn/cover.jpg' ;
					}
					else
					{
						$cover = 'https://image.tmdb.org/t/p/w1920_and_h800_multi_faces'.$row['cover'] ;
					}

				?>	

				<!-- List Starts -->
				<section class="section-spacing ">
					<div class="back_layer">

					<!-- =====================  Cover  =====================  -->

						<div class="cover_list" style="background: url('<?=$cover?>');background-size: cover; min-height:250px;">



							<div class="container-fluid p-3 layer_background mb-4" style="min-height: 250px;">
								<div class="row" style="min-height: 200px;">

									<div class="col-md-5 text-center text-white m-auto" >

										<h5 class="font-weight-bold">A List By </h5>

										<img class="m-2 avatar-img" width="50" src="<?=$image ?>"  alt=""/> 

										<h5 class="font-weight-bold text-white mb-3"><?= $name ?> </h5> 

										<button class="btn btn-light p-1 m-1" data-toggle="modal" data-target="#item_modal"><i class="fas fa-plus"></i> Add</button>
										<button class="btn btn-light p-1 m-1 get_list_modal_edit" data-list="<?= $row['uid'] ?>" data-user="<?= $user_id ?>"><i class="fas fa-pen-square"></i> Edit</button>
										<button class="btn btn-light p-1 m-1 get_list_modal" data-kind="share" data-list="<?= $row['uid'] ?>" data-user="<?= $user_id ?>"><i class="fas fa-share-alt"></i> Share</button>
										<button class="btn btn-light p-1 m-1 get_list_modal_cover" data-list="<?= $row['uid'] ?>" data-user="<?= $user_id ?>"><i class="fas fa-images"></i> Covers</button>


									</div>


									<div class="col-md-7 pt-4 text-white text-center m-auto">
										<div class="list_info">

										  <h3 class="font-weight-bold text-white"><?= ucwords($row['name'])  ?> </h3> 

										  <p class="font-weight-bold text-white"><? if($row['description'] == ''){echo 'No description entered.';}else{echo $row['description'];}  ?> </p> 

										  <? if($row['public'] == 'Yes'){echo '<span class="badge badge-secondary list-badge mb-3">Public</span>';}else{echo '<span class="badge badge-primary list-badge mb-3">Private</span>'; } ?>

										</div>

										  <a class="text-white" href="corn.php">
												<i class="fas fa-long-arrow-alt-left"></i> Back To Corn
										  </a>

									</div>

								</div>
							</div>


						</div>



				  <div class="container" id="list_items">

						<div>

							<div class="row">
								<div class="col-md-12 pb-3 b-border">

									<div class="font-weight-bold toggle_type active" data-type="movie" data-target="#list_section_movie" data-user="<?=$user_id?>">
										<span > Movies </span>
										<span class="badge badge-toggle"><?= countItems3 ('type', 'movie_list', 'Movie', 'list_id', $list_id) ?></span>
									</div>

									<div class="font-weight-bold toggle_type" data-type="tv" data-target="#list_section_tv" data-user="<?=$user_id?>">
										<span >Tv Shows </span>
										<span class="badge badge-toggle"><?= countItems3 ('type', 'movie_list', 'TV', 'list_id', $list_id) ?></span>
									</div>

								</div>	
							</div>	



						<div>

					<!-- ==========  Movies  ==========  -->

							<div id="list_section_movie">

					<?
							if($result > 0) 
							{
					?>
						<div class="row my-2">
							<div class="col-md-12 pb-1">

								<i class="ti-layout-list-thumb show_grid2" data-show=".show_cards_details" data-target="#likes_movies"></i>

								<i class="ti-layout-grid2 show_grid2 active" data-show=".show_cards" data-target="#likes_movies" ></i>

							</div>	
						</div>


								<div class="row justify-content-center" id="likes_movies">

								<?

									foreach($rows as $row )
									{

										$movie_id = $row['tmdb_id'];

										$movie = api_connect("https://api.themoviedb.org/3/movie/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

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
									<div class="variable_card px-2 show_cards fade show">  


										<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
											<div class="poster"> 
												<i class="fas fa-times-circle poster_remove" data-id="<?=$row['id'] ?>" ></i>
												<a href="single.php?movie=<?= $movie->id?>">
													<img width="100%" src="<?= $img?>" alt=""/>
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

													foreach(array_slice($movie->genres, 0, 4) as $genre )
													{
														$genre_cate = '_'.$genre->id;
														?>

												<div class="mb-1 cate_color_<?= $genre->id;?>">
													<a href="m_browse.php?type=genre&genre=<?= $genre->id;?>"><?= $cate->$genre_cate;?></a>
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




								  <!-- Start New Card -->
									<div class="col-sm-6 show_cards_details fade">  

										<div class="poster-card">
											<div class="poster"> <img src="<?= $img?>" alt=""/></div>
											<div class="c-body" style="border-left: 1px solid rgba(255, 255, 255, 0.15);">
											  <div class="wrapper">

												<div class="c-title">
													<a href="single.php?movie=<?= $movie->id?>" class="caramel_color"><? 
													if (strlen($movie->title) > 40){echo substr($movie->title,0,40) . '...';}else{echo $movie->title ;}  ?></a>  
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

												foreach(array_slice($movie->genres, 0, 4) as $genre )
													{
														$genre_cate = '_'.$genre->id;
														?>

												<div class="mb-1 cate_color_<?= $genre->id;?>">
													<a href="m_browse.php?type=genre&genre=<?= $genre->id;?>"><?= $cate->$genre_cate;?></a>
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
									}
								?>	


								</div>	

					<?
							}
							else
							{
								echo '<h3 class="text-white text-center my-4">No Result Found</h3>';
							}

					?>
							</div>


					<!-- ==========  TV Shows  ==========  -->


							<div id="list_section_tv">

				<?
						if($result2 > 0) 
						{
				?>
					 <div class="row my-2">
						<div class="col-md-12 pb-1">

							<i class="ti-layout-list-thumb show_grid2" data-show=".show_cards_details" data-target="#likes_tv"></i>

							<i class="ti-layout-grid2 show_grid2 active" data-show=".show_cards" data-target="#likes_tv" ></i>

						</div>	
					</div>


							<div class="row justify-content-center" id="likes_tv">

							<?

								foreach($rows3 as $row3 )
								{

									$movie_id = $row3['tmdb_id'];

									$movie = api_connect("https://api.themoviedb.org/3/tv/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

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
								<div class="variable_card px-2 show_cards fade show">  


									<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
										<div class="poster"> 
											<i class="fas fa-times-circle poster_remove" data-id="<?=$row3['id'] ?>" ></i>
											<a href="single.php?tv=<?= $movie->id?>">
												<img width="100%" src="<?= $img?>" alt=""/>
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

												foreach(array_slice($movie->genres, 0, 4) as $genre )
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


										<div class="details mt-3" >

											<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

											<a class="" href="single.php?tv=<?= $movie->id?>" ><i class="fa fa-info" ></i> Details</a>

										</div>


										</div>

									</div>

								</div>

							  <!-- End New Card -->




							  <!-- Start New Card -->
								<div class="col-sm-6 show_cards_details fade">  

									<div class="poster-card">
										<div class="poster"> <img src="<?= $img?>" alt=""/></div>
										<div class="c-body" style="border-left: 1px solid rgba(255, 255, 255, 0.15);">
										  <div class="wrapper">

											<div class="c-title">
												<a href="single.php?tv=<?= $movie->id?>" class="caramel_color"><? 
												if (strlen($movie->name) > 40){echo substr($movie->name,0,40) . '...';}else{echo $movie->name ;}  ?> </a>  
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

											foreach(array_slice($movie->genres, 0, 4) as $genre )
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


										<div class="details mt-3" style="position: absolute;bottom: 0;">

											<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

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
							echo '<h3 class="text-white text-center my-4">No Result Found</h3>';
						}

				?>

							</div>

						</div>



						</div>




				   </div>

				  </div>
				</section>
				<!-- List Ends -->

				<?

			}
			else
			{
				if($row['public'] == 'No')
				{
					header('location:index.php');
				}
				else
				{

					$stmt = $conn->prepare("SELECT * FROM lists WHERE uid = ? ");
					$stmt->execute(array($list_uid));
					$row = $stmt->fetch();

					$list_id = $row['id'];

					$stmt = $conn->prepare("SELECT * FROM members WHERE id = ? ");
					$stmt->execute(array($row['user_id']));
					$user = $stmt->fetch();

					$user_id    = $user['id'];
					$name    	= $user['name'];
					$image      = $user['image'];

					$stmt = $conn->prepare("SELECT * FROM movie_list WHERE list_id = ? AND type = 'Movie' ORDER BY id DESC");
					$stmt->execute(array($list_id));
					$rows = $stmt->fetchAll();
					$result = $stmt->rowCount();

					$stmt3 = $conn->prepare("SELECT * FROM movie_list WHERE list_id = ? AND type = 'TV' ORDER BY id DESC");
					$stmt3->execute(array($list_id));
					$rows3 = $stmt3->fetchAll();
					$result2 = $stmt3->rowCount();

					if ($row['cover'] == '' )
					{
						$cover = 'layout/img/popcorn/cover.jpg' ;
					}
					else
					{
						$cover = 'https://image.tmdb.org/t/p/w1920_and_h800_multi_faces'.$row['cover'] ;
					}

				?>	

				<!-- List Starts -->
				<section class="section-spacing ">
					<div class="back_layer">

					<!-- =====================  Cover  =====================  -->

						<div class="cover_list" style="background: url('<?=$cover?>');background-size: cover; min-height:250px;">



							<div class="container-fluid p-3 layer_background mb-4" style="min-height: 250px;">
								<div class="row" style="min-height: 200px;">

									<div class="col-md-5 text-center text-white m-auto" >

										<h5 class="font-weight-bold">A List By </h5>

										<img class="m-2 avatar-img" width="50" src="<?=$image ?>"  alt="" /> 

										<a href="viewcorn.php?u=<?=$user['uid']?>" class="font-weight-bold text-white mb-3"><?= $name ?> </a> 

										<br>

										<button class="btn btn-light p-1 m-1 get_list_modal" data-kind="share" data-list="<?= $row['uid'] ?>" data-user="<?= $user_id ?>"><i class="fas fa-share-alt"></i> Share</button>


									</div>


									<div class="col-md-7 pt-4 text-white text-center m-auto">
										<div class="list_info">

										  <h3 class="font-weight-bold text-white"><?= ucwords($row['name'])  ?> </h3> 

										  <p class="font-weight-bold text-white"><? if($row['description'] == ''){echo 'No description entered.';}else{echo nl2br($row['description']) ;}  ?> </p> 

										</div>


									</div>

								</div>
							</div>


						</div>



				  <div class="container" id="list_items">

						<div>

							<div class="row">
								<div class="col-md-12 pb-3 b-border" >

									<div class="font-weight-bold toggle_type active" data-type="movie" data-target="#list_section_movie" data-user="<?=$user_id?>">
										<span > Movies </span>
										<span class="badge badge-toggle"><?= countItems3 ('type', 'movie_list', 'Movie', 'list_id', $list_id) ?></span>
									</div>

									<div class="font-weight-bold toggle_type" data-type="tv" data-target="#list_section_tv" data-user="<?=$user_id?>">
										<span >Tv Shows </span>
										<span class="badge badge-toggle"><?= countItems3 ('type', 'movie_list', 'TV', 'list_id', $list_id) ?></span>
									</div>

								</div>	
							</div>	



						<div>

					<!-- ==========  Movies  ==========  -->

							<div id="list_section_movie">

					<?
							if($result > 0) 
							{
					?>
						<div class="row my-2">
							<div class="col-md-12 pb-1">

								<i class="ti-layout-list-thumb show_grid2" data-show=".show_cards_details" data-target="#likes_movies"></i>

								<i class="ti-layout-grid2 show_grid2 active" data-show=".show_cards" data-target="#likes_movies" ></i>

							</div>	
						</div>


								<div class="row justify-content-center" id="likes_movies">

								<?

									foreach($rows as $row )
									{

										$movie_id = $row['tmdb_id'];

										$movie = api_connect("https://api.themoviedb.org/3/movie/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

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
									<div class="variable_card px-2 show_cards fade show">  


										<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
											<div class="poster"> 
												<a href="single.php?movie=<?= $movie->id?>">
													<img width="100%" src="<?= $img?>" alt=""/>
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

													foreach(array_slice($movie->genres, 0, 4) as $genre )
													{
														$genre_cate = '_'.$genre->id;
														?>

												<div class="mb-1 cate_color_<?= $genre->id;?>">
													<a href="m_browse.php?type=genre&genre=<?= $genre->id;?>"><?= $cate->$genre_cate;?></a>
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




								  <!-- Start New Card -->
									<div class="col-sm-6 show_cards_details fade">  

										<div class="poster-card">
											<div class="poster"> <img src="<?= $img?>" alt=""/></div>
											<div class="c-body" style="border-left: 1px solid rgba(255, 255, 255, 0.15);">
											  <div class="wrapper">

												<div class="c-title">
													<a href="single.php?movie=<?= $movie->id?>" class="caramel_color"><? 
													if (strlen($movie->title) > 40){echo substr($movie->title,0,40) . '...';}else{echo $movie->title ;}  ?></a>  
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

												foreach(array_slice($movie->genres, 0, 4) as $genre )
													{
														$genre_cate = '_'.$genre->id;
														?>

												<div class="mb-1 cate_color_<?= $genre->id;?>">
													<a href="m_browse.php?type=genre&genre=<?= $genre->id;?>"><?= $cate->$genre_cate;?></a>
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
									}
								?>	


								</div>	

					<?
							}
							else
							{
								echo '<h3 class="text-white text-center my-4">No Result Found</h3>';
							}

					?>
							</div>


					<!-- ==========  TV Shows  ==========  -->


							<div id="list_section_tv">

				<?
						if($result2 > 0) 
						{
				?>
					 <div class="row my-2">
						<div class="col-md-12 pb-1">

							<i class="ti-layout-list-thumb show_grid2" data-show=".show_cards_details" data-target="#likes_tv"></i>

							<i class="ti-layout-grid2 show_grid2 active" data-show=".show_cards" data-target="#likes_tv" ></i>

						</div>	
					</div>


							<div class="row justify-content-center" id="likes_tv">

							<?

								foreach($rows3 as $row3 )
								{

									$movie_id = $row3['tmdb_id'];

									$movie = api_connect("https://api.themoviedb.org/3/tv/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

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
								<div class="variable_card px-2 show_cards fade show">  


									<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
										<div class="poster"> 
											<a href="single.php?tv=<?= $movie->id?>">
												<img width="100%" src="<?= $img?>" alt=""/>
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

												foreach(array_slice($movie->genres, 0, 4) as $genre )
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


										<div class="details mt-3" >

											<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

											<a class="" href="single.php?tv=<?= $movie->id?>" ><i class="fa fa-info" ></i> Details</a>

										</div>


										</div>

									</div>

								</div>

							  <!-- End New Card -->




							  <!-- Start New Card -->
								<div class="col-sm-6 show_cards_details fade">  

									<div class="poster-card">
										<div class="poster"> <img src="<?= $img?>" alt=""/></div>
										<div class="c-body" style="border-left: 1px solid rgba(255, 255, 255, 0.15);">
										  <div class="wrapper">

											<div class="c-title">
												<a href="single.php?tv=<?= $movie->id?>" class="caramel_color"><? 
												if (strlen($movie->name) > 40){echo substr($movie->name,0,40) . '...';}else{echo $movie->name ;}  ?> </a>  
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

											foreach(array_slice($movie->genres, 0, 4) as $genre )
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


										<div class="details mt-3" style="position: absolute;bottom: 0;">

											<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

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
							echo '<h3 class="text-white text-center my-4">No Result Found</h3>';
						}

				?>

							</div>

						</div>



						</div>




				   </div>

				  </div>
				</section>
				<!-- List Ends -->

				<?
				}

			}

		}
		else
		{
				if($row['public'] == 'No')
				{
					header('location:index.php');
				}
				else
				{
					$stmt = $conn->prepare("SELECT * FROM lists WHERE uid = ? ");
					$stmt->execute(array($list_uid));
					$row = $stmt->fetch();

					$list_id = $row['id'];

					$stmt = $conn->prepare("SELECT * FROM members WHERE id = ? ");
					$stmt->execute(array($row['user_id']));
					$user = $stmt->fetch();

					$user_id    = $user['id'];
					$name    	= $user['name'];
					$image      = $user['image'];

					$stmt = $conn->prepare("SELECT * FROM movie_list WHERE list_id = ? AND type = 'Movie' ORDER BY id DESC");
					$stmt->execute(array($list_id));
					$rows = $stmt->fetchAll();
					$result = $stmt->rowCount();

					$stmt3 = $conn->prepare("SELECT * FROM movie_list WHERE list_id = ? AND type = 'TV' ORDER BY id DESC");
					$stmt3->execute(array($list_id));
					$rows3 = $stmt3->fetchAll();
					$result2 = $stmt3->rowCount();

					if ($row['cover'] == '' )
					{
						$cover = 'layout/img/popcorn/cover.jpg' ;
					}
					else
					{
						$cover = 'https://image.tmdb.org/t/p/w1920_and_h800_multi_faces'.$row['cover'] ;
					}

				?>	

				<!-- List Starts -->
				<section class="section-spacing ">
					<div class="back_layer">

					<!-- =====================  Cover  =====================  -->

						<div class="cover_list" style="background: url('<?=$cover?>');background-size: cover; min-height:250px;">



							<div class="container-fluid p-3 layer_background mb-4" style="min-height: 250px;">
								<div class="row" style="min-height: 200px;">

									<div class="col-md-5 text-center text-white m-auto" >

										<h5 class="font-weight-bold">A List By </h5>

										<img class="m-2 avatar-img" width="50" src="<?=$image ?>"  alt="" /> 

										<a href="viewcorn.php?u=<?=$user['uid']?>" class="font-weight-bold text-white mb-3"><?= $name ?> </a> 

										<br>

										<button class="btn btn-light p-1 m-1 get_list_modal" data-kind="share" data-list="<?= $row['uid'] ?>" data-user="<?= $user_id ?>"><i class="fas fa-share-alt"></i> Share</button>


									</div>


									<div class="col-md-7 pt-4 text-white text-center m-auto">
										<div class="list_info">

										  <h3 class="font-weight-bold text-white"><?= ucwords($row['name'])  ?> </h3> 

										  <p class="font-weight-bold text-white"><? if($row['description'] == ''){echo 'No description entered.';}else{echo nl2br($row['description']);}  ?> </p> 

										</div>


									</div>

								</div>
							</div>


						</div>



				  <div class="container" id="list_items">

						<div>

							<div class="row">
								<div class="col-md-12 pb-3 b-border">

									<div class="font-weight-bold toggle_type active" data-type="movie" data-target="#list_section_movie" data-user="<?=$user_id?>">
										<span > Movies </span>
										<span class="badge badge-toggle"><?= countItems3 ('type', 'movie_list', 'Movie', 'list_id', $list_id) ?></span>
									</div>

									<div class="font-weight-bold toggle_type" data-type="tv" data-target="#list_section_tv" data-user="<?=$user_id?>">
										<span >Tv Shows </span>
										<span class="badge badge-toggle"><?= countItems3 ('type', 'movie_list', 'TV', 'list_id', $list_id) ?></span>
									</div>

								</div>	
							</div>	



						<div>

					<!-- ==========  Movies  ==========  -->

							<div id="list_section_movie">

					<?
							if($result > 0) 
							{
					?>
						<div class="row my-2">
							<div class="col-md-12 pb-1">

								<i class="ti-layout-list-thumb show_grid2" data-show=".show_cards_details" data-target="#likes_movies"></i>

								<i class="ti-layout-grid2 show_grid2 active" data-show=".show_cards" data-target="#likes_movies" ></i>

							</div>	
						</div>


								<div class="row justify-content-center" id="likes_movies">

								<?

									foreach($rows as $row )
									{

										$movie_id = $row['tmdb_id'];

										$movie = api_connect("https://api.themoviedb.org/3/movie/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

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
									<div class="variable_card px-2 show_cards fade show">  


										<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
											<div class="poster"> 
												<a href="single.php?movie=<?= $movie->id?>">
													<img width="100%" src="<?= $img?>" alt=""/>
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

													foreach(array_slice($movie->genres, 0, 4) as $genre )
													{
														$genre_cate = '_'.$genre->id;
														?>

												<div class="mb-1 cate_color_<?= $genre->id;?>">
													<a href="m_browse.php?type=genre&genre=<?= $genre->id;?>"><?= $cate->$genre_cate;?></a>
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




								  <!-- Start New Card -->
									<div class="col-sm-6 show_cards_details fade">  

										<div class="poster-card">
											<div class="poster"> <img src="<?= $img?>" alt=""/></div>
											<div class="c-body" style="border-left: 1px solid rgba(255, 255, 255, 0.15);">
											  <div class="wrapper">

												<div class="c-title">
													<a href="single.php?movie=<?= $movie->id?>" class="caramel_color"><? 
													if (strlen($movie->title) > 40){echo substr($movie->title,0,40) . '...';}else{echo $movie->title ;}  ?></a>  
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

												foreach(array_slice($movie->genres, 0, 4) as $genre )
													{
														$genre_cate = '_'.$genre->id;
														?>

												<div class="mb-1 cate_color_<?= $genre->id;?>">
													<a href="m_browse.php?type=genre&genre=<?= $genre->id;?>"><?= $cate->$genre_cate;?></a>
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
									}
								?>	


								</div>	

					<?
							}
							else
							{
								echo '<h3 class="text-white text-center my-4">No Result Found</h3>';
							}

					?>
							</div>


					<!-- ==========  TV Shows  ==========  -->


							<div id="list_section_tv">

				<?
						if($result2 > 0) 
						{
				?>
					 <div class="row my-2">
						<div class="col-md-12 pb-1">

							<i class="ti-layout-list-thumb show_grid2" data-show=".show_cards_details" data-target="#likes_tv"></i>

							<i class="ti-layout-grid2 show_grid2 active" data-show=".show_cards" data-target="#likes_tv" ></i>

						</div>	
					</div>


							<div class="row justify-content-center" id="likes_tv">

							<?

								foreach($rows3 as $row3 )
								{

									$movie_id = $row3['tmdb_id'];

									$movie = api_connect("https://api.themoviedb.org/3/tv/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

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
								<div class="variable_card px-2 show_cards fade show">  


									<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
										<div class="poster"> 
											<a href="single.php?tv=<?= $movie->id?>">
												<img width="100%" src="<?= $img?>" alt=""/>
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

												foreach(array_slice($movie->genres, 0, 4) as $genre )
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


										<div class="details mt-3" >

											<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

											<a class="" href="single.php?tv=<?= $movie->id?>" ><i class="fa fa-info" ></i> Details</a>

										</div>


										</div>

									</div>

								</div>

							  <!-- End New Card -->




							  <!-- Start New Card -->
								<div class="col-sm-6 show_cards_details fade">  

									<div class="poster-card">
										<div class="poster"> <img src="<?= $img?>" alt=""/></div>
										<div class="c-body" style="border-left: 1px solid rgba(255, 255, 255, 0.15);">
										  <div class="wrapper">

											<div class="c-title">
												<a href="single.php?tv=<?= $movie->id?>" class="caramel_color"><? 
												if (strlen($movie->name) > 40){echo substr($movie->name,0,40) . '...';}else{echo $movie->name ;}  ?> </a>  
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

											foreach(array_slice($movie->genres, 0, 4) as $genre )
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


										<div class="details mt-3" style="position: absolute;bottom: 0;">

											<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

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
							echo '<h3 class="text-white text-center my-4">No Result Found</h3>';
						}

				?>

							</div>

						</div>



						</div>




				   </div>

				  </div>
				</section>
				<!-- List Ends -->

				<?
				}

		}
		
	}
	else
	{
		header('location:index.php');
	}
}
else
{
	header('location:index.php');
}


?>


<!--========================== Start Modal Add Items ================================-->
<div class="modal fade" id="item_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	  
    <div class="modal-content">
		
      	<div class="modal-body">
		
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item" role="presentation">
				<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Movies</a>
			  </li>
			  <li class="nav-item" role="presentation">
				<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tv Shows</a>
			  </li>

			</ul>
			<div class="tab-content" id="myTabContent" style="
				min-height: 130px;
			">
			  <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">


			  <div class="form-group mt-3 mb-5" style="position: relative">
				<label for="formGroupExampleInput">Add Movie</label>
				<input type="text" class="form-control text-dark search_bar2" id="formGroupExampleInput" placeholder="Search for a Movie" data-type="movie" data-target="#search_result2" data-list="<?=$list_id ?>" data-user="<?=$user_id ?>">
				<div id="search_result2"></div>
			  </div>
				  
			  <div id="movie_list" class="row justify-content-center"></div>



			</div>
			  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

			  <div class="form-group mt-3 mb-5" style="position: relative">
				<label for="formGroupExampleInput">Add Tv Show</label>
				<input type="text" class="form-control text-dark search_bar2" id="formGroupExampleInput" placeholder="Search for a Tv Show" data-type="tv" data-target="#search_result3" data-list="<?=$list_id ?>" data-user="<?=$user_id ?>">
				<div id="search_result3"></div>
			  </div>
				  
			  <div id="tv_list" class="row justify-content-center"></div>

			</div>

			</div>
					
		
		</div>
		
		<div class="modal-footer">
			
        	<button type="button" class="btn-filter close_items" data-list="<?=$list_uid ?>" data-user="<?=$user_id?>" data-dismiss="modal">Save</button>
			
        	<button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
			
        </div>
      
    </div>
  </div>
</div>

	  
	  

<? include('include/footer.php'); 

ob_end_flush(); 

?>


