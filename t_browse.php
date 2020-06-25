<?

include('ini.php'); 


if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
if (isset($_GET["type"])) { $type  = $_GET["type"]; } else { $type=''; };


if(isset($_GET["year"]) && $type == 'year')
{
	
	$year 		= $_GET["year"];
	$get_genres = array();
	$url 		= '&type='.$type.'&year='.$year;
	
	$movies     = api_connect("https://api.themoviedb.org/3/discover/tv?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&sort_by=popularity.desc&first_air_date_year=$year&page=$page&timezone=America%2FNew_York&vote_count.gte=100&include_null_first_air_dates=false");

}
elseif(isset($_GET["genre"]) && $type == 'genre')
{
	
	$get_genres =  explode(",",$_GET["genre"]);
	$get_genre  =  $_GET["genre"];
	$year  	    =  '';
	$url 		= '&type='.$type.'&genre='.$get_genre;
	
	$movies    = api_connect("https://api.themoviedb.org/3/discover/tv?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&sort_by=popularity.desc&page=$page&timezone=America%2FNew_York&vote_count.gte=100&with_genres=$get_genre&include_null_first_air_dates=false");
	
}
elseif($type == 'all')
{
	
	if (isset($_GET["rate"])) 
	{ 
		$rate   = $_GET["rate"]; 
		$rating = '&vote_average.gte=' .   $rate;
	} 
	else 
	{ 
		$rate	= '' ; 
		$rating = '' ;
	}
	
	if (isset($_GET["year"]))   
	{ 
		$year  = $_GET["year"]; 
		$years = '&first_air_date_year=' . $year;
	} 
	else 
	{ 
		$year=''; 
		$years = '' ;
		 }
	
	if (isset($_GET["sort"])) 	
	{ 
		$sort    = $_GET["sort"]; 
		$sorting = '&sort_by=' . $sort;
	} 
	else 
	{ 
		$sort=''; 
		$sorting = '' ;
	}
	
	if (isset($_GET["genre"])) 	
	{ 
		$get_genre  = $_GET["genre"]; 
		$get_genres =  explode(",", $_GET["genre"]);
		$genres = '&with_genres=' . $get_genre;
	} 
	else 
	{ 
		$get_genre='';
		$get_genres = array(); 
		$genres = '' ;
	}
	
	
	$url 	= '&type='.$type.'&rate='.$rate.'&year='.$year.'&sort='.$sort.'&genre='.$get_genre;
	
	
	$movies = api_connect("https://api.themoviedb.org/3/discover/tv?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&sort_by=popularity.desc&page=$page&timezone=America%2FNew_York&vote_count.gte=100&include_null_first_air_dates=false".$genres.$sorting.$years.$rating."");
	
}
else
{
	$get_genres = array();
	$year  = '';
	$rate = '' ;
	$sort = '' ;
	$url = '';
	
	$movies = api_connect("https://api.themoviedb.org/3/discover/tv?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&sort_by=popularity.desc&page=$page&timezone=America%2FNew_York&vote_count.gte=100&include_null_first_air_dates=false");
}


	$genres = api_connect("https://api.themoviedb.org/3/genre/tv/list?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");
 

	$total_pages = $movies->total_pages; 

?>
	


<!-- Movies starts -->
<!-- Start Playing Now  -->
<section id="about" class="section-spacing">
  <div class="back_layer" >
		
  	<div class="container">
	  
    <div class="row pb-4">
		
      	<div class="col-md-9 py-2">
		  
        <div class="section-title ">
			<h4 class="font-weight-bold title_btn" style="color:#fbd747;">Browse <span style="color:#fff;">TV Shows</span></h4>
			
        </div>
		  
		  
      </div>
		
		
		<div class="col-md-3 py-2 px-3">
    	<div class="top-search">
			
			
			<input type="hidden" class="select-search" value="movie" >

				<div style="width: 100%; position: relative;">
					<input class="search_bar" type="text" placeholder="Search for Movies" style="border-left: none;">
					<div id="search_result"></div>
				</div>
			
				<i class="fa fa-search" style="position: absolute;color: #ccc;right: 10px;"></i>

		</div>
	</div>
		
		
		<div class="col-md-12">
			
			<form class="filter_form">
				
				<div class="col-md-12">
					<h4 class="text-white font-weight-bold slide_box pointer mb-0"><i class="fas fa-filter fs-13-t"></i> Filter 
						<i class="fa fa-chevron-down fs-13-t float-right pointer transition rotate"></i> 
					</h4>
				</div>
				
				<div class="form-box">
				
					<div class="form-row my-2 pt-3 filter-box" style="border-bottom: 1px solid rgba(255,255,255,0.3);border-top: 1px solid rgba(255,255,255,0.3);">


						 <div class="form-group col-md-4 mb-2">
							<label for="" class="font-weight-bolder text-white fs-13-t">Rating</label>
							  <select dir="ltr" class="form-control" name="rating" >
								<option value="" > Select  </option>
								<option value="9" <? if($rate == 9){echo 'selected';} ?>> 9+ </option>
								<option value="8" <? if($rate == 8){echo 'selected';} ?>> 8+ </option>
								<option value="7" <? if($rate == 7){echo 'selected';} ?>> 7+ </option>
								<option value="6" <? if($rate == 6){echo 'selected';} ?>> 6+ </option>
								<option value="5" <? if($rate == 5){echo 'selected';} ?>> 5+ </option>
								<option value="4" <? if($rate == 4){echo 'selected';} ?>> 4+ </option>
								<option value="3" <? if($rate == 3){echo 'selected';} ?>> 3+ </option>
							  </select>
						  </div>


						 <div class="form-group col-md-4 mb-2">
							<label for="" class="font-weight-bolder text-white fs-13-t">Year</label>
							  <select dir="ltr" class="form-control" name="year" >
								<option value=""  > Select  </option>
								<?
								    define('DOB_YEAR_START', 1900);

									$current_year = date('Y');

									for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
									{ 
										if($count == $year){$select = 'selected';}else{$select = '';}
										echo "<option value='$count' $select>{$count}</option>";
									}
								 ?>
							  </select>
						  </div>


						 <div class="form-group col-md-4 mb-2">
							<label for="" class="font-weight-bolder text-white fs-13-t">Sort By</label>
							  <select  dir="ltr" class="form-control" name="sort" >
								<option value=""  selected=""> Select  </option>
								<option value="first_air_date.desc" <? if($sort == 'first_air_date.desc'){echo 'selected';} ?>> Latest </option>
								<option value="first_air_date.asc" <? if($sort == 'first_air_date.asc'){echo 'selected';} ?>> Oldest </option>
								<option value="popularity.desc" <? if($sort == 'popularity.desc'){echo 'selected';} ?>> Most Popularity </option>
								<option value="popularity.asc" <? if($sort == 'popularity.asc'){echo 'selected';} ?>> Less Popularity </option>
								<option value="vote_average.desc" <? if($sort == 'vote_average.desc'){echo 'selected';} ?>> Top Voting </option>
								<option value="vote_average.asc" <? if($sort == 'vote_average.asc'){echo 'selected';} ?>> Less Voting </option>
							  </select>
						  </div>


						 <div class="form-group col-md-12">
							<label for="" class="font-weight-bolder text-white fs-13-t">Choose Genres</label>
							  <div class="cate text-center" >

									<?

										foreach($genres->genres as $genre )
										{
											$genre_cate = '_'.$genre->id;

											 if (in_array($genre->id, $get_genres ))
											 {
												$check = '<i class="fa fa-check-circle text-white genre_checked"></i>';
												$class="remove_genre";
											 }
											else
											{
												$check = '';
												$class="add_genre";
											}
											?>

									<div class="m-2 py-1 px-2 pointer <?= $class?> cate_color_<?= $genre->id?>" data-id="<?= $genre->id?>">
										<a class="text-white" ><?= $cate->$genre_cate;?></a>

										<?= $check ?>

									</div>

											<?
										}

									?>

								</div>
						  </div>



					</div>

					<? 
					if(isset($_GET['genre']))
					{
						
						foreach($get_genres as $genre1)
						{
							echo '<input class="'.$genre1.'" type="hidden" name="genre[]" value="'.$genre1.'" >';
						}
					} 
					?>

					<input type="hidden" name="browse" value="tv" >

					<div class="text-right">
						<button class="btn-filter">Filter</button>
					</div>
					
				</div>
				
			</form>
		
		</div>
		
    </div>
	  
	<div class="row">
		<div class="col-md-12">
			<i class="ti-layout-list-thumb show_grid" data-show=".show_cards_details" data-target="#browse"></i>

			<i class="ti-layout-grid2 show_grid active" data-show=".show_cards" data-target="#browse" ></i>
		</div>	
	</div>
	  
	<div class="row" id="browse">
		
			<div class="col-md-12 text-center text-white mb-2">
				<h5><?
						if($movies->total_results > 0)  
						{
							echo  number_format($movies->total_results) . ' TV Shows Found ' ;
						}
						else
						{
							echo 'No TV Shows Found';
						}
					?></h5>
			</div>
		
		
			<div class="show_cards row justify-content-center fade show">

			<?

				foreach($movies->results as $movie )
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
				<div class="variable_card px-2">  


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

			<!-- ==========================================  -->

			<div class="show_cards_details row justify-content-center fade ">

			<?


				foreach($movies->results as $movie )
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
				<div class="col-sm-6">  

					<div class="poster-card">
						<div class="poster"> <img src="<?= $img?>" alt=""/></div>
						<div class="c-body" style="border-left: 1px solid rgba(255, 255, 255, 0.15);">
						  <div class="wrapper">

							<div class="c-title">
								<a href="single.php?movie=<?= $movie->id?>" class="caramel_color"><?= $movie->name?> </a>  
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
						
				}
			?>	


			</div>	
		
		
			<!-- ================   Pagination   ================  -->

<? if($total_pages > 1)
	{
?>
  			<ul class="col-md-12 pagination my-4 mx-auto" style="justify-content: center;">
				<li class="page-item <? if($page == 1){echo 'disabled';} ?>">
				  <a class="page-link" href="?page=<? if($page == 1){echo $page;}else{echo $page-1;} ?><?=$url?>" tabindex="-1">Prev</a>
				</li>


				<?php if ($page > 3): ?>
				<li class="page-item"><a class="page-link" href="?page=1<?=$url?>">1</a></li>
				<li class="page-item"><div class="page-link">...</div></li>
				<?php endif; ?>

				<?php if ($page-2 > 2): ?><li class="page"><a class="page-link" href="?page=<?php echo $page-2 . $url ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
				<?php if ($page-1 > 3): ?><li class="page"><a class="page-link" href="?page=<?php echo $page-1 . $url ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

			<!--	
			<li class="page-item active"><a class="page-link" href="?page=<?php echo $page ?>"><?php echo $page ?></a></li>
			-->

				  <select class="page-item select_page" >
					 <?
					for ($i=1; $i<=$total_pages; $i++) 
					  {  
						  if ($page == $i){$selected = 'selected';}else{$selected = '';}
							 echo '<option value="'.$i.$url.'" '.$selected.'>'.$i.'</option>';
					  }; 

					 ?>
				  </select>

				<?php if ($page+1 < ceil($total_pages)+1): ?><li class="page-item"><a class="page-link" href="?page=<?php echo $page+1 . $url ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
				<?php if ($page+2 < ceil($total_pages)+1): ?><li class="page-item"><a class="page-link" href="?page=<?php echo $page+2 . $url ?>"><?php echo $page+2 ?></a></li><?php endif; ?>

				<?php if ($page < ceil($total_pages)-2): ?>

				  <? if ($page < ceil($total_pages)-3)
					{ ?>
				<li class="page-item"><div class="page-link">...</div></li>
				  <?}?>

				<li class="page-item"><a class="page-link" href="?page=<?php echo ceil($total_pages) . $url ?>"><?php echo ceil($total_pages) ?></a></li>
				<?php endif; ?>


				<li class="page-item">
				  <a class="page-link" href="?page=<?=$page+1 . $url?>">Next</a>
				</li>
			  </ul>
<?
	}
?>
		
	</div>
	  
	  
	  
	  
 
	  
	 
	   
	  
  
	  
  </div>
	  
  </div>
</section>
<!-- End Playing Now -->
<!-- Movies ends -->


	  
	

<? include('include/footer.php'); ?>



