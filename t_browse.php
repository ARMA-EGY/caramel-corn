<?

include('ini.php'); 


if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };



if(isset($_GET["year"]))
{
	$year = $_GET["year"];
	
	$movies = api_connect("https://api.themoviedb.org/3/discover/tv?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&sort_by=popularity.desc&first_air_date_year=$year&page=1&timezone=America%2FNew_York&vote_count.gte=100&include_null_first_air_dates=false");

}
elseif(isset($_GET["genre"]))
{
	$get_genre = $_GET["genre"];
	
	$movies = api_connect("https://api.themoviedb.org/3/discover/tv?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&sort_by=popularity.desc&page=1&timezone=America%2FNew_York&vote_count.gte=100&with_genres=$get_genre&include_null_first_air_dates=false");
	
}
else
{
	$get_genre = '';
	$year  = '';
	
	$movies = api_connect("https://api.themoviedb.org/3/discover/tv?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&sort_by=popularity.desc&page=1&timezone=America%2FNew_York&vote_count.gte=100&include_null_first_air_dates=false");
}


	$genres = api_connect("https://api.themoviedb.org/3/genre/tv/list?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");
 

	$total_pages = $movies->total_pages; 

?>
	


<!-- Movies starts -->
<!-- Start Playing Now  -->
<section id="about" class="section-spacing">
  <div style="background: rgba(0, 0, 0,0.7);padding-top: 80px;padding-bottom: 10px;">
		
  	<div class="container">
	  
    <div class="row pb-4">
		
      	<div class="col-md-9 p-1">
		  
        <div class="section-title ">
			<h4 class="font-weight-bold title_btn" style="color:#fbd747;">Browse <span style="color:#fff;">TV Shows</span></h4>
			
        </div>
		  
		  
      </div>
		
		
		<div class="col-md-3 p-1">
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
				
				<div class="col-md-12 mb-3" style="border-bottom: 2px solid #fff;">
					<h4 class="text-white font-weight-bold"><i class="fas fa-filter fs-13-t"></i> Filter 
						<i class="fa fa-arrow-circle-down float-right pointer transition slide_box"></i> 
					</h4>
				</div>
				
				<div class="form-box">
				
					<div class="form-row mb-2 filter-box" style="border-bottom: 1px solid rgba(255,255,255,0.3)">


						 <div class="form-group col-md-4">
							<label for="" class="font-weight-bolder text-white fs-13-t">Rating</label>
							  <select dir="ltr" class="form-control" name="rating" >
								<option value=""  selected=""> Select  </option>
								<option value="9"> 9+ </option>
								<option value="8"> 8+ </option>
								<option value="7"> 7+ </option>
								<option value="6"> 6+ </option>
								<option value="5"> 5+ </option>
								<option value="4"> 4+ </option>
								<option value="3"> 3+ </option>
							  </select>
						  </div>


						 <div class="form-group col-md-4">
							<label for="" class="font-weight-bolder text-white fs-13-t">Year</label>
							  <select id="year" dir="ltr" class="form-control" name="year" >
								<option value=""  selected=""> Select  </option>

							  </select>
						  </div>


						 <div class="form-group col-md-4">
							<label for="" class="font-weight-bolder text-white fs-13-t">Sort By</label>
							  <select  dir="ltr" class="form-control" name="sort" >
								<option value=""  selected=""> Select  </option>
								<option value="first_air_date.desc"> Latest </option>
								<option value="first_air_date.asc"> Oldest </option>
								<option value="popularity.desc"> Most Popularity </option>
								<option value="popularity.asc"> Less Popularity </option>
								<option value="vote_average.desc"> Top Voting </option>
								<option value="vote_average.asc"> Less Voting </option>
							  </select>
						  </div>


						 <div class="form-group col-md-12">
							<label for="" class="font-weight-bolder text-white fs-13-t">Choose Genres</label>
							  <div class="cate text-center" >

									<?

										foreach($genres->genres as $genre )
										{
											$genre_cate = '_'.$genre->id;

											 if($get_genre == $genre->id )
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

									<div class="m-2 p-1 pointer <?= $class?> cate_color_<?= $genre->id?>" data-id="<?= $genre->id?>">
										<a class="text-white" ><?= $cate->$genre_cate;?></a>

										<?= $check ?>

									</div>

											<?
										}

									?>

								</div>
						  </div>



					</div>

					<? if(isset($_GET['genre'])){echo '<input class="'.$get_genre.'" type="hidden" name="genre[]" value="'.$get_genre.'" >';} ?>

					<input type="hidden" name="browse" value="movie" >

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
	  
	<div class="row p-4" id="browse">
		
		
		
		
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
				<div class="col-sm-3 variable_card">  


					<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
						<div class="poster"> 
							<a href="single.php?tv=<?= $movie->id?>">
								<img src="<?= $img?>" alt=""/>
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
				<div class="col-sm-6">  

					<div class="poster-card">
						<div class="poster"> <img src="<?= $img?>" alt=""/></div>
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
						
				}
			?>	


			</div>	
		
		
	</div>
	  
	  
	  
	  
 
  <ul class="pagination my-4" style="justify-content: center;">
    <li class="page-item <? if($page == 1){echo 'disabled';} ?>">
      <a class="page-link" href="?page=<? if($page == 1){echo $page;}else{echo $page-1;} ?>&type=<?=$type?>" tabindex="-1">Prev</a>
    </li>
	  
	  
	<?php if ($page > 3): ?>
	<li class="page-item"><a class="page-link" href="?page=1&type=<?=$type?>">1</a></li>
	<li class="page-item"><div class="page-link">...</div></li>
	<?php endif; ?>

	<?php if ($page-2 > 2): ?><li class="page"><a class="page-link" href="?page=<?php echo $page-2 ?>&type=<?=$type?>"><?php echo $page-2 ?></a></li><?php endif; ?>
	<?php if ($page-1 > 3): ?><li class="page"><a class="page-link" href="?page=<?php echo $page-1 ?>&type=<?=$type?>"><?php echo $page-1 ?></a></li><?php endif; ?>

<!--	
<li class="page-item active"><a class="page-link" href="?page=<?php echo $page ?>"><?php echo $page ?></a></li>
-->
	  
	  <select class="page-item select_page" >
		 <?
		for ($i=1; $i<=$total_pages; $i++) 
		  {  
			  if ($page == $i){$selected = 'selected';}else{$selected = '';}
				 echo '<option value="'.$i.'&type='.$type.'" '.$selected.'>'.$i.'</option>';
		  }; 
	
		 ?>
	  </select>

	<?php if ($page+1 < ceil($total_pages)+1): ?><li class="page-item"><a class="page-link" href="?page=<?php echo $page+1 ?>&type=<?=$type?>"><?php echo $page+1 ?></a></li><?php endif; ?>
	<?php if ($page+2 < ceil($total_pages)+1): ?><li class="page-item"><a class="page-link" href="?page=<?php echo $page+2 ?>&type=<?=$type?>"><?php echo $page+2 ?></a></li><?php endif; ?>

	<?php if ($page < ceil($total_pages)-2): ?>
	  
	  <? if ($page < ceil($total_pages)-3)
		{ ?>
	<li class="page-item"><div class="page-link">...</div></li>
	  <?}?>
	  
	<li class="page-item"><a class="page-link" href="?page=<?php echo ceil($total_pages) ?>&type=<?=$type?>"><?php echo ceil($total_pages) ?></a></li>
	<?php endif; ?>

	  
    <li class="page-item">
      <a class="page-link" href="?page=<?=$page+1?>&type=<?=$type?>">Next</a>
    </li>
  </ul>
	  
	 
	   
	  
  
	  
  </div>
	  
  </div>
</section>
<!-- End Playing Now -->
<!-- Movies ends -->


	  
	

<? include('include/footer.php'); ?>



