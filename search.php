<?

	include('include/function.php'); 


	if(isset($_POST['search']))
	{
		$search = $_POST['search'];
	  //$type 	= $_POST['type'];
	}


	$movie_results  = api_connect("https://api.themoviedb.org/3/search/movie?api_key=df264f8d059253c7e87471ab4809cbbf&language=en&query=$search&page=1&include_adult=false");

	$tv_results     = api_connect("https://api.themoviedb.org/3/search/tv?api_key=df264f8d059253c7e87471ab4809cbbf&language=en&query=$search&page=1&include_adult=false");

	$people_results = api_connect("https://api.themoviedb.org/3/search/person?api_key=df264f8d059253c7e87471ab4809cbbf&language=en&query=$search&page=1&include_adult=false");

?>

	  <div class="tab-pane fade show active search-pane" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
		  <?
		  if($movie_results->total_results == 0)
		  {
			  echo '<p class="text-center text-white">No Result Found.</p>';
		  }
		  else
		  {
		  ?>
		  <ul class='mb-0'>
		 	<?
				foreach(array_slice($movie_results->results, 0, 10) as $movie )
				{
					$date =  $movie->release_date;
					$year = date('Y', strtotime($date));

					if ($movie->poster_path == '')
					{
						$img = 'layout/img/no_poster.jpeg';
					}
					else
					{
						$img = 'https://image.tmdb.org/t/p/w185_and_h278_bestv2' . $movie->poster_path ;
					}

				?>

				<li class="search-row">
					<a class="search-link" href="single.php?movie=<?= $movie->id?>" >

						<img src="<?= $img?>" alt="" style="width: 40px;float: left;margin-right: 15px;">
						<span class="text-white"> <?= $movie->title?></span>
						<p class="text-white">(<?=$year ?>)</p>

					</a>
					<div class="clearfix"></div>
				</li>

				<? 
				}
			 ?>
		  </ul>
		  <?
		  }
		  ?>
	  </div>

	  <div class="tab-pane fade search-pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"> 
		  <?
		  if($tv_results->total_results == 0)
		  {
			  echo '<p class="text-center text-white">No Result Found.</p>';
		  }
		  else
		  {
		  ?>
		  <ul class='mb-0'>
			<?
				foreach(array_slice($tv_results->results, 0, 10) as $tv )
				{
					$date =  $tv->first_air_date;
					$year = date('Y', strtotime($date));

					if ($tv->poster_path == '')
					{
						$img = 'layout/img/no_poster.jpeg';
					}
					else
					{
						$img = 'https://image.tmdb.org/t/p/w185_and_h278_bestv2' . $tv->poster_path ;
					}

				?>

				<li class="search-row" >
					<a class="search-link" href="single.php?tv=<?= $tv->id?>">

						<img src="<?= $img?>" alt="" style="width: 40px;float: left;margin-right: 15px;">
						<span class="text-white"> <?= $tv->name?></span>
						<p class="text-white">(<?=$year ?>)</p>

					</a>
					<div class="clearfix"></div>
				</li>

				<? 
				}
			  
			?>
		  </ul>
		  <?
		  }
		  ?>
	  </div>

	  <div class="tab-pane fade search-pane" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"> 
		  <?
		  if($people_results->total_results == 0)
		  {
			  echo '<p class="text-center text-white">No Result Found.</p>';
		  }
		  else
		  {
		  ?>
		  <ul class='mb-0'>
			<?
				foreach(array_slice($people_results->results, 0, 10) as $actor )
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

				<li class="search-row" >
					<a class="search-link" href="single.php?person=<?= $actor->id?>" style="line-height: 5;">

						<img src="<?= $img?>" alt="" style="width: 60px;float: left;margin-right: 15px; border-radius: 50%;">
						<span class="text-white"> <?= $actor->name?></span>

					</a>
					<div class="clearfix"></div>
				</li>

				<? 
				}

			?>
		  </ul>
		  <?
		  }
		  ?>
	  </div>


