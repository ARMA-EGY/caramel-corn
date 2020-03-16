<?

	include('include/function.php'); 


	if(isset($_POST['search']))
	{
		$search = $_POST['search'];
	}


	$movies = api_connect("https://api.themoviedb.org/3/search/movie?api_key=df264f8d059253c7e87471ab4809cbbf&language=en&query=$search&page=1&include_adult=false");

echo "<ul>";

	foreach(array_slice($movies->results, 0, 15) as $movie )
		{
	    	$date =  $movie->release_date;
			$year = date('Y', strtotime($date));

?>

<li style="padding: 10px; border-bottom: 1px solid rgba(255, 255, 255, 0.6); height: 95px;">
    <a href="single.php?movie=<?= $movie->id?>" style="width: 100%;height: 100%;font-size: 14px;font-weight: bold;">
		
        <img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2/<?= $movie->poster_path?>" alt="" style="width: 50px;float: left;margin-right: 15px;">
		<span style="color: #fff;"> <?= $movie->title?></span>
		<p style="color: #fff;">(<?=$year ?>)</p>
		
    </a>
    <div class="clearfix"></div>
</li>


<? } ?>

</ul>
