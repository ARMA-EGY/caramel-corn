<?

	include('include/function.php'); 


	if(isset($_POST['search']))
	{
		$search = $_POST['search'];
		$type 	= $_POST['type'];
	}


	$results = api_connect("https://api.themoviedb.org/3/search/$type?api_key=df264f8d059253c7e87471ab4809cbbf&language=en&query=$search&page=1&include_adult=false");

echo "<ul class='mb-0'>";

	if($type == 'movie')
	{
		foreach(array_slice($results->results, 0, 10) as $movie )
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

				<img src="<?= $img?>" alt="" style="width: 50px;float: left;margin-right: 15px;">
				<span style="color: #fff;"> <?= $movie->title?></span>
				<p style="color: #fff;">(<?=$year ?>)</p>

			</a>
			<div class="clearfix"></div>
		</li>

		<? 
		}
		
	}
	elseif($type == 'tv')
	{
		foreach(array_slice($results->results, 0, 10) as $tv )
		{
	    	$date =  $tv->first_air_date;
			$year = date('Y', strtotime($date));
			
			if ($movie->poster_path == '')
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

				<img src="<?= $img?>" alt="" style="width: 50px;float: left;margin-right: 15px;">
				<span style="color: #fff;"> <?= $tv->name?></span>
				<p style="color: #fff;">(<?=$year ?>)</p>

			</a>
			<div class="clearfix"></div>
		</li>

		<? 
		}
	}
	elseif($type == 'person')
	{
		foreach(array_slice($results->results, 0, 10) as $actor )
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
			<a class="search-link" href="single.php?actor=<?= $actor->id?>" >

				<img src="<?= $img?>" alt="" style="width: 70px;float: left;margin-right: 15px; border-radius: 10px;">
				<span style="color: #fff;"> <?= $actor->name?></span>

			</a>
			<div class="clearfix"></div>
		</li>

		<? 
		}
	}

	 ?>

</ul>
