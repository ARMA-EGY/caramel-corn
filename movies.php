<?

include('ini.php'); 


if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };

if (isset($_GET["type"])) { $type  = $_GET["type"]; } else { $type='Newest'; };


if($type == 'Newest')
{
	
	$movies = api_connect("https://api.themoviedb.org/3/movie/now_playing?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=$page");

}
elseif($type == 'Trending')
{
	
	$movies = api_connect("https://api.themoviedb.org/3/trending/movie/week?api_key=df264f8d059253c7e87471ab4809cbbf&page=$page");
	
}
elseif($type == 'Upcoming')
{
	$today 		= date("Y-m-d");
	$last_month = strtotime("+6 Months");
	$end_date 	=  date("Y-m-27", $last_month) ;

	$movies = api_connect("https://api.themoviedb.org/3/discover/movie?api_key=df264f8d059253c7e87471ab4809cbbf&language=en&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&primary_release_date.gte=$today&primary_release_date.lte=$end_date&release_date.gte=$today&release_date.lte=$end_date&page=$page");

}
elseif($type == 'In Theatres')
{
	$today 		= date("Y-m-d");
	$last_month = strtotime("-2 Months");
	$start_from =  date("Y-m-01", $last_month) ;

	$movies = api_connect("https://api.themoviedb.org/3/discover/movie?api_key=df264f8d059253c7e87471ab4809cbbf&language=en&sort_by=revenue.desc&include_adult=false&include_video=false&page=1&primary_release_date.gte=$start_from&primary_release_date.lte=$today&page=$page&vote_count.gte=50");
	
}
elseif($type == 'Popular')
{
	
	$movies = api_connect("https://api.themoviedb.org/3/movie/popular?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=$page");
	
}
elseif($type == 'Top Rated')
{
	
	$movies = api_connect("https://api.themoviedb.org/3/discover/movie?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&sort_by=vote_average.desc&include_adult=false&include_video=false&page=$page&vote_count.gte=900");
	
}
elseif($type == 'Top Revenue')
{
	
	$movies = api_connect("https://api.themoviedb.org/3/discover/movie?api_key=df264f8d059253c7e87471ab4809cbbf&sort_by=revenue.desc&certification_country=US&vote_count.gte=100&page=$page");
	
}

 

	$total_pages = $movies->total_pages; 

?>
	



<!-- Movies starts -->
<!-- Start Playing Now  -->
<section id="about" class="section-spacing">
  <div style="background: rgba(0, 0, 0,0.8);padding-top: 80px;padding-bottom: 10px;">
		
  	<div class="container">
	  
    <div class="row pb-4">
		
      <div class="col-md-9 p-1">
		  
        <div class="section-title ">
			<h4 class="font-weight-bold title_btn" style="color:#fbd747;"><?= $type ?> <span style="color:#fff;">Movies</span></h4>
					  
			<i class="ti-layout-list-thumb show_grid" data-show=".show_cards_details" data-target="#movies"></i>

			<i class="ti-layout-grid2 show_grid active" data-show=".show_cards" data-target="#movies" ></i>
			
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
		
    </div>
	  
	  
	  
	<div class="row p-4" id="movies">
		
		
		
		
			<div class="show_cards row justify-content-center fade show">

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
				<div class="variable_card px-2">  


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
								<a href="m_browse.php?type=genre&genre=<?= $genre;?>"><?= $cate->$genre_cate;?></a>
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



