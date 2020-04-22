<?

$kind = 'favorites';


if(isset($_POST['user_id']))
{
	
	//Include Configuration File

	$dbn    = 'mysql:host=185.201.11.187;dbname=u919964947_corn';
	$user   = 'u919964947_corn';
	$pass   = '123456';
	$option =  array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);

	try 
	{
		$conn = new PDO($dbn, $user, $pass, $option);

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}


	catch(PDOException $e) 
	{
		echo 'Failed To Connect' . $e->getMessage();
	}


	include('../function.php'); 
	include('../genre.php'); 
	
	
	$user_id 	 	= $_POST['user_id'];
	
	
	$stmt = $conn->prepare("SELECT * FROM $kind WHERE user_id = ? AND type = 'Movie' ORDER BY id DESC LIMIT 0, 20");
	$stmt->execute(array($user_id));
	$rows = $stmt->fetchAll();
	
	$stmt2 = $conn->prepare("SELECT * FROM $kind WHERE user_id = ? AND type = 'Movie' ORDER BY id DESC");
	$stmt2->execute(array($user_id));
	$result = $stmt2->rowCount();
	
	$page  = 1 ;
	$pages = $result / 20 ;
	$total_pages = ceil($pages);
	
	$url = '&kind='.$kind.'&type=movies';
	
?>
	  
  
	<div class="row">
		<div class="col-md-12 pb-3" style="border-bottom: 1px solid rgba(255, 255, 255, 0.5);">
			
    		<div class="font-weight-bold toggle_type active" data-kind="<?=$kind?>" data-type="movie" data-target="#favorites_section" data-user="<?=$user_id?>">
				<span > Movies </span>
				<span class="badge badge-toggle"><?= countItems3 ('type', $kind, 'Movie', 'user_id', $user_id) ?></span>
			</div>
			
			<div class="font-weight-bold toggle_type" data-kind="<?=$kind?>" data-type="tv" data-target="#favorites_section" data-user="<?=$user_id?>">
				<span >Tv Shows </span>
			    <span class="badge badge-toggle"><?= countItems3 ('type', $kind, 'TV', 'user_id', $user_id) ?></span>
			</div>
			
		</div>	
	</div>	  

	
	<div id="favorites_section">
		
<?
		if($result > 0) 
		{
?>
			<div class="row my-2">
		<div class="col-md-12 pb-1">
			
			<select dir="ltr" class="select-control float-right m-1 select_sort" data-kind="<?=$kind?>" data-type="movie" data-target="#favorites_movies" data-user="<?=$user_id?>">
				<option value="id DESC"> Latest </option>
				<option value="id ASC"> Oldest </option>
				<option value="rate DESC"> Top Rated </option>
				<option value="release_date DESC"> Release Date </option>
				<option value="name ASC"> From A to Z </option>
				<option value="name DESC"> From Z to A </option>
			</select>
			
			<select dir="ltr" class="select-control float-right m-1 select_show" data-kind="<?=$kind?>" data-type="movie" data-target="#favorites_movies" data-user="<?=$user_id?>">
				<option value="20"> Show 20 </option>
				<option value="30"> Show 30 </option>
				<option value="40"> Show 40 </option>
				<option value="50"> Show 50 </option>
			</select>
			
			<i class="ti-layout-list-thumb show_grid2" data-show=".show_cards_details" data-target="#favorites_movies"></i>

			<i class="ti-layout-grid2 show_grid2 active" data-show=".show_cards" data-target="#favorites_movies" ></i>
			
		</div>	
	</div>

		
			<div class="row justify-content-center" id="favorites_movies">

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
				<div class="col-sm-3 variable_card show_cards fade show">  


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
					
				<!-- ================   Pagination   ================  -->

<? if($total_pages > 1)
	{
?>
			<div class="col-md-12 my-3" style="border-top: 1px solid rgba(255, 255, 255, 0.5);">
	
  			<ul class="col-md-12 pagination my-4 mx-auto" style="justify-content: center;">
				<li class="page-item <? if($page == 1){echo 'disabled';} ?>">
				  <a class="page-link" href="?page=<? if($page == 1){echo $page;}else{echo $page-1;} ?><?=$url?>" tabindex="-1">Prev</a>
				</li>


				<?php if ($page > 3): ?>
				<li class="page-item"><a class="page-link" href="?page=1&type=<?=$type?>">1</a></li>
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
				
				
		 </div>
<?
	}
?>
		

	</div>	


<script>

        $(document).ready(function() {
            $('.tooltip2').tooltipster({
			contentCloning: true, 
			contentAsHTML: true, 
			interactive: true, 
			animation: 'fade',
			side: [ 'left', 'top', 'bottom', 'right'],
		    delay: 200,
			maxWidth: 360,
			minWidth: 200,
		    theme: 'tooltipster-borderless'
			});
        });
	
</script>

<? } 



?>






