<?

// error_reporting(E_ALL);
// ini_set('display_errors','On');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/vendor/autoload.php';


//Include Configuration File
include('include/db-connect.php'); 
include('include/function.php'); 
include('include/genre.php'); 


/*====================  Get Trailer  ====================*/

if(isset($_POST['trailer_id']))
{
	$type 	= $_POST['trailer_type'];
	$id 	= $_POST['trailer_id'];
	
	
	if($type == 'movie')
	{
		$trailers = api_connect("https://api.themoviedb.org/3/movie/$id/videos?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

		foreach($trailers->results as $trailer )
			{
					if ($trailer->type == 'Trailer' )
					{

						$name = $trailer->name;
						$key  = $trailer->key;

						break;
					}
			}
	}
	elseif($type == 'tv')
	{
		$trailers = api_connect("https://api.themoviedb.org/3/tv/$id/videos?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

		foreach($trailers->results as $trailer )
			{
					if ($trailer->type == 'Trailer' )
					{

						$name = $trailer->name;
						$key  = $trailer->key;

						break;
					}
			}
	}
	
?>


	<iframe class="trailer-video" width="100%" height="100%" src="https://www.youtube.com/embed/<?=$key?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>


<?
	
	
}



/*====================  Browse Movies  ====================*/

if(isset($_POST['browse']))
{
	
		$rate 	 		= $_POST['rating'];
		$year 			= $_POST['year'];
		$sort 			= $_POST['sort'];
	
		/*=======  Genres  =======*/
		if(isset($_POST['genre']))
		{
			if($_POST['genre'] != '')
			{
				$get_genre 	= implode(",",$_POST['genre']);
				$genres 	= '&with_genres=' .  $get_genre;
			}
		}
		else{
				$genres 	= '';
				$get_genre 	= '';
			}
		/*=======  Rating  =======*/

		if($rate != '')
		{
			$rating = '&vote_average.gte=' .   $rate;
		}
		else{
			$rating = '';
		}

		/*=======  Sorting  =======*/

		if($sort != '')
		{
			$sorting = '&sort_by=' . $sort;
		}
		else
		{
			$sorting = '';
		}

	
	if($_POST['browse'] == 'movie')
	{
		
		$certification 	= $_POST['certification'];

		/*=======  Certification  =======*/

		if($certification != '')
		{
			$certifications = '&certification=' . $certification;
		}
		else
		{
			$certifications = '';
		}
		
		/*=======  Years  =======*/

		if($year != '')
		{
			$years = '&primary_release_year=' . $year;
		}
		else
		{
			$years = '';
		}

		
		/*=======  API  =======*/

		$movies = api_connect("https://api.themoviedb.org/3/discover/movie?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&vote_count.gte=100".$genres.$sorting.$years.$rating.$certifications."");
		
		
		$total_pages = $movies->total_pages; 
		$page = 1;
		
		$url 	= '&type=all&rate='.$rate.'&year='.$year.'&sort='.$sort.'&genre='.$get_genre.'&certification='.$certification;
	
?>
	
			<div class="col-md-12 text-center text-white mb-2">
				<h5><?
						if($movies->total_results > 0)  
						{
							echo  number_format($movies->total_results) . ' Movies Found ' ;
						}
						else
						{
							echo 'No Movies Found';
						}
					?></h5>
			</div>
		
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
				<div class="variable_card px-2 mx-md-2">  


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


<?

	}		
	
	elseif($_POST['browse'] == 'tv')
	{
		
		/*=======  Years  =======*/

		if($year != '')
		{
			$years = '&first_air_date_year=' . $year;
		}
		else
		{
			$years = '';
		}
		
		
		/*=======  API  =======*/

		$movies = api_connect("https://api.themoviedb.org/3/discover/tv?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&sort_by=popularity.desc&page=1&timezone=America%2FNew_York&vote_count.gte=100&include_null_first_air_dates=false".$genres.$sorting.$years.$rating."");
		
		
		$total_pages = $movies->total_pages; 
		$page = 1;
		
		
	    $url 	= '&type=all&rate='.$rate.'&year='.$year.'&sort='.$sort.'&genre='.$get_genre;
		
?>
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
				<div class="variable_card px-2 mx-md-2">  


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
<?
		
	}
?>




<? if($total_pages > 1)
	{
?>
		 	<ul class="pagination my-4 mx-auto" style="justify-content: center;">
				
				<li class="page-item <? if($page == 1){echo 'disabled';} ?>">
				  <a class="page-link" href="?page=<? if($page == 1){echo $page;}else{echo $page-1;} ?><?=$url?>" tabindex="-1">Prev</a>
				</li>

				  <select class="page-item select_page" >
					 <?
					for ($i=1; $i<=$total_pages; $i++) 
					  {  
						  if ($page == $i){$selected = 'selected';}else{$selected = '';}
							 echo '<option value="'.$i.$url.'" '.$selected.'>'.$i.'</option>';
					  }; 

					 ?>
				  </select>

				<li class="page-item"><a class="page-link" href="?page=<?php echo ceil($total_pages) . $url ?>"><?php echo ceil($total_pages) ?></a></li>

				<li class="page-item">
				  <a class="page-link" href="?page=<?=$page+1 . $url?>">Next</a>
				</li>
				
			  </ul>
<?
	}

?>	

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

<?
}



/*====================  Add To (Favorites, Likes, Watchlist)  ====================*/

if(isset($_POST['add_to']))
{
	
	$kind 	 	 	= $_POST['add_to'];
	$name 	 		= $_POST['name'];
	$tmdb 	 		= $_POST['tmdb'];
	$imdb 	 		= $_POST['imdb'];
	$type 	 		= $_POST['type'];
	$date 	 		= $_POST['date'];
	$rate 	 		= $_POST['rate'];
	$user_id 	 	= $_POST['user_id'];
	
	
	if ($kind == 'Favorites')
	{
		
		$stmt = $conn->prepare("SELECT * FROM favorites WHERE tmdb_id = ? AND user_id = ?");
		$stmt->execute(array($tmdb, $user_id));
		$row = $stmt->fetch();

		$count = $stmt->rowCount();

		// if count > 0 this mean the database contain record about this data

		if ($count > 0 )
		{
			
		}
		else
		{
			
			$stmt = "INSERT INTO favorites ( `name`, `tmdb_id`, `imdb_id`, `type`, `release_date`, `rate`, `user_id`, `Add_Date`)

						VALUES('$name', '$tmdb' , '$imdb', '$type', '$date', '$rate', '$user_id', now() )";

			$conn->exec($stmt);
			
		}
		
		
	}
	elseif ($kind == 'Likes')
	{
		
		$stmt = $conn->prepare("SELECT * FROM likes WHERE tmdb_id = ? AND user_id = ?");
		$stmt->execute(array($tmdb, $user_id));
		$row = $stmt->fetch();

		$count = $stmt->rowCount();

		// if count > 0 this mean the database contain record about this data

		if ($count > 0 )
		{
			
		}
		else
		{
		
			$stmt = "INSERT INTO likes ( `name`, `tmdb_id`, `imdb_id`, `type`, `release_date`, `rate`, `user_id`, `Add_Date`)

						VALUES('$name', '$tmdb' , '$imdb', '$type', '$date', '$rate', '$user_id', now() )";

			$conn->exec($stmt);
			
		}
		
	}
	elseif ($kind == 'Watchlist')
	{
		
		$stmt = $conn->prepare("SELECT * FROM watchlist WHERE tmdb_id = ? AND user_id = ?");
		$stmt->execute(array($tmdb, $user_id));
		$row = $stmt->fetch();

		$count = $stmt->rowCount();

		// if count > 0 this mean the database contain record about this data

		if ($count > 0 )
		{
			
		}
		else
		{
		
			$stmt = "INSERT INTO watchlist ( `name`, `tmdb_id`, `imdb_id`, `type`, `release_date`, `rate`, `user_id`, `Add_Date`)

						VALUES('$name', '$tmdb' , '$imdb', '$type', '$date', '$rate', '$user_id', now() )";

			$conn->exec($stmt);
			
		}
		
	}
	
	
}
	


/*====================  Remove From (Favorites, Likes, Watchlist)  ====================*/

if(isset($_POST['remove_from']))
{
	
	$kind 	 	 	= $_POST['remove_from'];
	$name 	 		= $_POST['name'];
	$tmdb 	 		= $_POST['tmdb'];
	$imdb 	 		= $_POST['imdb'];
	$type 	 		= $_POST['type'];
	$user_id 	 	= $_POST['user_id'];
	
	
	if ($kind == 'Favorites')
	{
		  $stmt = $conn->prepare("DELETE FROM favorites WHERE tmdb_id = ? AND user_id = ? ");

		  $stmt->execute(array($tmdb, $user_id));
		
	}
	elseif ($kind == 'Likes')
	{
		  $stmt = $conn->prepare("DELETE FROM likes WHERE tmdb_id = ? AND user_id = ? ");

		  $stmt->execute(array($tmdb, $user_id));
		
	}
	elseif ($kind == 'Watchlist')
	{
		  $stmt = $conn->prepare("DELETE FROM watchlist WHERE tmdb_id = ? AND user_id = ? ");

		  $stmt->execute(array($tmdb, $user_id));
		
	}
	
}

	

/*====================  Following Person  ====================*/

if(isset($_POST['follow_person']))
{
	
	$name 	 			= $_POST['name'];
	$person_id 	 		= $_POST['follow_person'];
	$user_id 	 		= $_POST['user_id'];
	
	
	$stmt = "INSERT INTO following ( `name`, `person_id`, `user_id`, `Add_Date`)

				VALUES('$name', '$person_id' , '$user_id', now() )";

	$conn->exec($stmt);
		
}



/*====================  UnFollowing Person  ====================*/

if(isset($_POST['unfollow_person']))
{
	
	$name 	 			= $_POST['name'];
	$person_id 	 		= $_POST['unfollow_person'];
	$user_id 	 		= $_POST['user_id'];
	
	
  	$stmt = $conn->prepare("DELETE FROM following WHERE person_id = ? AND user_id = ? ");

  	$stmt->execute(array($person_id, $user_id));
		
}



/*====================  Toggle Type In Corn  ====================*/

if(isset($_POST['toggle_type']))
{
	
	$kind 	 	 	= $_POST['kind'];
	$type 	 		= $_POST['toggle_type'];
	$user_id 	 	= $_POST['user_id'];
	
	
	$stmt = $conn->prepare("SELECT * FROM $kind WHERE user_id = ? AND type = ? ORDER BY id DESC LIMIT 0, 20");
	$stmt->execute(array($user_id, $type));
	$rows = $stmt->fetchAll();
	
	$stmt2 = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND type = ? ORDER BY id DESC");
	$stmt2->execute(array($user_id, $type));
	$result = $stmt2->rowCount();
	
	$page  = 1 ;
	$pages = $result / 20 ;
	$total_pages = ceil($pages);
	
	$url = '&kind='.$kind.'&type='.$type.'';

	if($type == 'movie')
	{
		if($result > 0) 
		{

?>
	 		<div class="row my-2">
		<div class="col-md-12 pb-1">
			
			<div class="select-wrapper">
				<select dir="ltr" class="select-control m-1" name="sort">
					<option value="" selected="">Latest</option>
					<option value=""> Oldest </option>
					<option value=""> Top Rated </option>
					<option value=""> Release Date </option>
					<option value=""> From A to Z </option>
					<option value=""> From Z to A </option>
				</select>
			</div>
			
			<div class="select-wrapper">
				<select dir="ltr" class="select-control m-1" name="show">
					<option value="" selected="">Show 20</option>
					<option value=""> Show 30 </option>
					<option value=""> Show 40 </option>
					<option value=""> Show 50 </option>
				</select>
			</div>
			
			<i class="ti-layout-list-thumb show_grid2" data-show=".show_cards_details" data-target="#movies"></i>

			<i class="ti-layout-grid2 show_grid2 active" data-show=".show_cards" data-target="#movies" ></i>
			
		</div>	
	</div>

		
			<div class="row justify-content-center" id="movies">

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
			
	
	}
	elseif($type == 'tv')
	{
		if($result > 0) 
		{
			
?>

		    <div class="row my-2">
		<div class="col-md-12 pb-1">
			
			<div class="select-wrapper">
				<select dir="ltr" class="select-control m-1" name="sort">
					<option value="" selected="">Latest</option>
					<option value=""> Oldest </option>
					<option value=""> Top Rated </option>
					<option value=""> Release Date </option>
					<option value=""> From A to Z </option>
					<option value=""> From Z to A </option>
				</select>
			</div>
			
			<div class="select-wrapper">
				<select dir="ltr" class="select-control m-1" name="show">
					<option value="" selected="">Show 20</option>
					<option value=""> Show 30 </option>
					<option value=""> Show 40 </option>
					<option value=""> Show 50 </option>
				</select>
			</div>
			
			<i class="ti-layout-list-thumb show_grid2" data-show=".show_cards_details" data-target="#movies"></i>

			<i class="ti-layout-grid2 show_grid2 active" data-show=".show_cards" data-target="#movies" ></i>
			
		</div>	
	</div>

		
			<div class="row justify-content-center" id="movies">

			<?

				foreach($rows as $row )
				{

					$movie_id = $row['tmdb_id'];
					
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
				<div class="variable_card show_cards fade show">  


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
	}
	

	
?>
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
<?
		
}



/*====================  Select Change (Sort / Show)  ====================*/

if(isset($_POST['select_sort']))
{
	
	$kind 	 	 	= $_POST['kind'];
	$type 	 		= $_POST['type'];
	$sort 	 		= $_POST['select_sort'];
	$target 	 	= $_POST['target'];
	$subtarget 	 	= $_POST['subtarget'];
	$load 	 		= $_POST['load'];
	$show 	 		= 20;
	$user_id 	 	= $_POST['user_id'];
	
	
	$stmt = $conn->prepare("SELECT * FROM $kind WHERE user_id = ? AND type = ? ORDER BY $sort LIMIT 0, $show");
	$stmt->execute(array($user_id, $type));
	$rows = $stmt->fetchAll();
	
	$stmt2 = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND type = ?");
	$stmt2->execute(array($user_id, $type));
	$result = $stmt2->rowCount();
	
	$page  = 1 ;
	$pages = $result / $show ;
	$total_pages = ceil($pages);
	
	$url = '&kind='.$kind.'&type='.$type.'';

	if($type == 'movie')
	{
		if($result > 0) 
		{
			echo '<div class="row justify-content-center" id="'.$subtarget.'">';
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
					
				echo '</div>';	

			
 if($total_pages > 1)
	{
?>
	<div class="mt-4 text-center">
   		 <button id="<?=$load?>" class="btn btn-filter cnt loadmore" data-sort="<?=$sort?>" data-type="<?=$type?>" data-section="<?=$kind?>" data-target="#<?=$subtarget?>" data-btn="#<?=$load?>" data-user="<?=$user_id?>" >Show More</button>
	</div>	
<?
	}
			
		}
		else
		{
			echo '<h3 class="text-white text-center my-4">No Result Found</h3>';
		}
			
	
	}
	elseif($type == 'tv')
	{
		if($result > 0) 
		{

				foreach($rows as $row )
				{

					$movie_id = $row['tmdb_id'];
					
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
	

<?
	    }
		else
		{
			echo '<h3 class="text-white text-center my-4">No Result Found</h3>';
		}
	}
	

	
?>
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
<?
		
}



// ========================= Show More Data (Sections) =========================


if (isset($_POST['getData'])) 
{

		$start 		= $_POST['start'];
		$limit 		= $_POST['limit'];
		$sort 	    = $_POST['sort'];
		$section 	= $_POST['section'];
		$type 		= $_POST['type'];
		$user_id 	= $_POST['user_id'];

		$stmt  = $conn->prepare("SELECT * FROM $section WHERE type = ? AND user_id = ? ORDER BY $sort LIMIT $start, $limit");
		$stmt->execute(array($type, $user_id));
		$rows  = $stmt->fetchAll();
		$count = $stmt->rowCount();
		
		if ($count > 0 )
		{
			foreach ($rows as $row)
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
<?

		} 

	   
}




// ========================= START SEND MESSAGE FROM CONTACT =========================

if(isset($_POST['msg'])){
	
	
	  $name 		= $_POST['name'];
	  $email 		= $_POST['email'];
	  $msg 			= $_POST['msg'];	
	  $msg2 		= filter_var($_POST['msg'],FILTER_SANITIZE_STRING);	
	
  	  $subject 	    = $_POST['subject'];
      $mail_to 		= 'elkholuy@gmail.com';
	
	
	 
		$mail = new PHPMailer;  
	    $mail->CharSet = "UTF-8";                             // Passing `true` enables exceptions
	try {

		//From email address and name
		$mail->setFrom($email,$name);

		$mail->addAddress($mail_to); //Recipient name is optional
		$mail->Subject  = $subject;

		$mail->isHTML(true);

		$mail->CharSet = 'UTF-8';
		$mail->Body = $msg;
		$mail->AltBody = "This is the plain text version of the email content";
		$mail->send();

        $stmt = "INSERT INTO mails ( name, mail_from, mail_to, subject, msg, Add_Date)
                                        VALUES('$name', '$email', '$mail_to', '$subject', '$msg2', now() )";
        
        $conn->exec($stmt);
		} catch (Exception $e) {
				echo 'Email could not be sent. Mailer Error: ', $mail->ErrorInfo;

		}  
	
	exit('success');
 }


// ========================= START SUBSCRIBE FORM  =========================

if(isset($_POST['subscribe_email']))
{
	$email = $_POST['subscribe_email'];
	
	
	$stmt = $conn->prepare("SELECT * FROM subscribe WHERE email = ?");
	$stmt->execute(array($email));
	$row = $stmt->fetch();

	$count = $stmt->rowCount();

	// if count > 0 this mean the database contain record about this username
	
	if ($count > 0 )
	{
		  $state = 'error';
		  $response = ['state'=>$state];
		  echo json_encode($response);
	}
	else
	{
		
		$stmt = "INSERT INTO subscribe ( email,  Add_Date)
						VALUES('$email', now() )";

		$conn->exec($stmt);
		
		
		  $state = 'success';
		  $response = ['state'=>$state];
		  echo json_encode($response);
		
	}
	
	
}


// ========================= START SAVE DEVICE TOKENS  =========================

if(isset($_POST['token']))
{
	$token = $_POST['token'];
	
	
	$stmt = $conn->prepare("SELECT * FROM tokens WHERE token = ?");
	$stmt->execute(array($token));
	$row = $stmt->fetch();

	$count = $stmt->rowCount();

	// if count > 0 this mean the database contain record about this token
	
	if ($count > 0 )
	{
		echo 'Token Already Exist In DB.';
	}
	else
	{
		$stmt = "INSERT INTO tokens ( token,  Add_Date)
						VALUES('$token', now() )";

		$conn->exec($stmt);
	
		echo 'Token Saved Successfully in DB.';
		
	}
	
}


// ========================= START CHANGE SAVED TOKEN IN DB  =========================

if (isset($_POST['oldToken']))
{

    $oldToken = $_POST['oldToken'];
    $newToken = $_POST['newToken'];

    $stmt = $conn->prepare("UPDATE tokens SET token = ? WHERE token = ?");
    $stmt->execute(array($newToken, $oldToken));
	
	
	echo 'Token Changed In DB.';
	
}



// ========================= GET ALL CORN LOGOS  =========================

if (isset($_POST['get_logo']))
{
	
    	$user_id = $_POST['user_id'];
	
		$stmt = $conn->prepare("SELECT * FROM members WHERE id = ? ");
		$stmt->execute(array($user_id));
		$user = $stmt->fetch();
	
		$logo = $user['corn_logo'];
	
		$stmt = $conn->prepare("SELECT * FROM corn_logo ");
		$stmt->execute();
		$rows = $stmt->fetchAll();


		foreach($rows as $row)
		{
			if($logo == $row['logo'])
			{
				$select = 'logo_select';
			}
			else
			{
				$select = '';
			}
?>
			<img class="m-2 select_corn pointer transition logo-hov <?=$select ?>" src="layout/img/popcorn/<?=$row['logo'] ?>" data-logo="<?=$row['logo'] ?>" data-user="<?=$user_id ?>" alt="" width="70">

<?
		}
	
	
}



// ========================= CHANGE CORN LOGO  =========================

if (isset($_POST['change_logo']))
{
	
    	$user_id = $_POST['user_id'];
    	$logo    = $_POST['change_logo'];
	
	
		$stmt = $conn->prepare("UPDATE members SET corn_logo = ? WHERE id = ?");
		$stmt->execute(array($logo, $user_id));
	
?>
		<img class="mr-2 mb-2" src="layout/img/popcorn/<?=$logo ?>" alt="" width="70"> 
<?
	
}



// ========================= CHANGE ACCOUNT PRIVACY  =========================

if (isset($_POST['private']))
{
	
    	$user_id    = $_POST['user_id'];
    	$private    = $_POST['private'];

	
		$stmt = $conn->prepare("UPDATE members SET private = ? WHERE id = ?");
		$stmt->execute(array($private, $user_id));

	
}


// ========================= ADD ITEM TO LIST  =========================

	if(isset($_POST['item_list']))
	{
		$list 	= $_POST['item_list'];
		$type 		= $_POST['type'];
		$tmdb 	    = $_POST['tmdb'];
		$user_id 	= $_POST['user_id'];
		
	
		$stmt = $conn->prepare("SELECT * FROM movie_list WHERE tmdb_id = ? AND user_id = ? AND list_id = ? ");
		$stmt->execute(array($tmdb, $user_id, $list));
		$row = $stmt->fetch();

		$count = $stmt->rowCount();

		// if count > 0 this mean the database contain record about this username

		if ($count > 0 )
		{
			?>
			<script>
				
					
				 const Toast = Swal.mixin({
					  toast: true,
					  position: 'top-end',
					  showConfirmButton: false,
					  timer: 3000,
					  timerProgressBar: true,
					  onOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					  }
					})
				
					var title = "This item is already on the List";

						Toast.fire({
						  icon: 'error',
						  title: title
						})
				
						
						var snd = new Audio("audio/beep.mp3");
						snd.play();
						snd.currentTime=0;

			</script>
			<?

		}
		else
		{

			if($type == 'Movie')
			{

						$movie_id = $tmdb;

						$movie = api_connect("https://api.themoviedb.org/3/movie/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

						$date =  $movie->release_date;
						$newdate = date('j M, Y', strtotime($date));

						$rate  = $movie->vote_average * 10 ;
						$rate1 = $movie->vote_average  ;
						$name  = $movie->title  ;
						$cover = $movie->backdrop_path  ;

						$stmt = "INSERT INTO movie_list ( `list_id`, `tmdb_id`, `type`, `user_id`, `Add_Date`, `name`, `rate`, `cover`, `release_date`)

									VALUES('$list', '$tmdb' , '$type', '$user_id', now(), '$name', '$rate1', '$cover' , '$date' )";

						$conn->exec($stmt);

			}
			elseif($type == 'TV')
			{

					$movie_id = $tmdb;

					$movie = api_connect("https://api.themoviedb.org/3/tv/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

					$date =  $movie->first_air_date;
					$newdate = date('j M, Y', strtotime($date));

					$rate  = $movie->vote_average * 10 ;
					$rate1 = $movie->vote_average  ;
					$name  = $movie->name  ;
					$cover = $movie->backdrop_path  ;

					$stmt = "INSERT INTO movie_list ( `list_id`, `tmdb_id`, `type`, `user_id`, `Add_Date`, `name`, `rate`, `cover`, `release_date`)

								VALUES('$list', '$tmdb' , '$type', '$user_id', now(), '$name', '$rate1', '$cover' , '$date' )";

					$conn->exec($stmt);


			}

?>

	<script>		
				 const Toast = Swal.mixin({
					  toast: true,
					  position: 'top-end',
					  showConfirmButton: false,
					  timer: 3000,
					  timerProgressBar: true,
					  onOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					  }
					})
				
					var title = "Item Added to list successfully";

						Toast.fire({
						  icon: 'success',
						  title: title
						})
		
						var snd = new Audio("audio/lesser.mp3");
						snd.play();
						snd.currentTime=0;

			</script>
<?
			
		}

		
	}



// ========================= UPDATE DARK MODE  =========================

if (isset($_POST['dark_mode']))
{
	
    	$user_id    = $_POST['user_id'];

		$stmt = $conn->prepare("SELECT * FROM members WHERE id = ? ");
		$stmt->execute(array($user_id));
		$row = $stmt->fetch();
	
		$mode = $row['dark_mode'];
	
		if($mode == 1)
		{
			$dark_mode = 0;
		}
		else
		{
			$dark_mode = 1;
		}
	
		$stmt = $conn->prepare("UPDATE members SET dark_mode = ? WHERE id = ?");
		$stmt->execute(array($dark_mode, $user_id));
	
}






?>