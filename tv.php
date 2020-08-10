<?

include('ini.php'); 

 

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };

if (isset($_GET["type"])) { $type  = $_GET["type"]; } else { $type='On Air'; };



if($type == 'On Air')
{
	
	$tv_shows = api_connect("https://api.themoviedb.org/3/tv/on_the_air?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=$page");

}
elseif($type == 'Airing Today')
{
	
	$tv_shows = api_connect("https://api.themoviedb.org/3/tv/airing_today?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=$page");
	
}
elseif($type == 'Trending')
{
	
	$tv_shows = api_connect("https://api.themoviedb.org/3/trending/tv/week?api_key=df264f8d059253c7e87471ab4809cbbf&page=$page");
	
}
elseif($type == 'Popular')
{
	
	$tv_shows = api_connect("https://api.themoviedb.org/3/tv/popular?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=$page");
	
}
elseif($type == 'Top Rated')
{
	
	$tv_shows = api_connect("https://api.themoviedb.org/3/tv/top_rated?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=$page");
	
}


$total_pages = $tv_shows->total_pages;  

?>
	


<!-- Movies starts -->
<!-- Start Playing Now  -->
<section id="about" class="section-spacing">
  <div class="back_layer" >
	
  <div class="container">
	  
    <div class="row pb-4">
		
      <div class="col-md-12 p-1">
		  
        <div class="section-title ">
			<h4 class="font-weight-bold title_btn text-white"><?= $type ?> Tv Shows</h4>
					  
			<i class="ti-layout-list-thumb show_grid" data-show=".show_cards_details" data-target="#tv"></i>

			<i class="ti-layout-grid2 show_grid active" data-show=".show_cards" data-target="#tv" ></i>
			
        </div>
		  
		  
      </div>
		
		
    </div>
	  

	<div class="row py-4" id="tv">
		
		
		
			<div class="show_cards row justify-content-center fade show">

			<?


				foreach($tv_shows->results as $tv )
				{


					$date =  $tv->first_air_date;
					$newdate = date('j M, Y', strtotime($date));

					$rate = $tv->vote_average * 10 ;
						
					if ($tv->poster_path == '')
					{
						$img = 'layout/img/no_poster.jpeg';
					}
					else
					{
						$img = 'https://image.tmdb.org/t/p/w185_and_h278_bestv2' . $tv->poster_path ;
					}

			?>

			  <!-- Start New Card -->
				<div class="variable_card px-2">  


					<div class="poster-card tooltip2" style="box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.3)" data-tooltip-content="#tooltip_content_<?= $tv->id?>">
						<div class="poster"> 
							<a href="single.php?tv=<?= $tv->id?>">
								<img width="100%" src="<?= $img?>" alt=""/>
							</a>
						</div>

					</div>

					<div class="d-none">

						<div class="c-body" id="tooltip_content_<?= $tv->id?>">

						 <div class="wrapper">

							<div class="c-title">
								<a href="single.php?tv=<?= $movie->id?>" class="caramel_color"><?= $tv->name?> </a>  
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
								<a href="t_browse.php?type=genre&genre=<?= $genre?>"><?= $cate->$genre_cate;?></a>
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
				}
			?>	


			</div>	

			<!-- ==========================================  -->

			<div class="show_cards_details row justify-content-center fade">

			<?


				foreach($tv_shows->results as $tv )
				{

					$date =  $tv->first_air_date;
					$newdate = date('j M, Y', strtotime($date));

					$rate = $tv->vote_average * 10 ;

			?>

			  <!-- Start New Card -->
				<div class="col-sm-6">  

					<div class="poster-card" style="box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.3)">
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
								<a href="t_browse.php?type=genre&genre=<?= $genre?>"><?= $cate->$genre_cate;?></a>
							</div>

									<?
								}

							?>

						</div>


						<div class="details mt-3" style="position: absolute;bottom: 0;">

							<span class="get_trailer" data-type="tv" data-id="<?= $tv->id?>" ><i class="fa fa-play"></i>Trailer</span>

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

