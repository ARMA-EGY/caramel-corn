<?

include('include/function.php'); 



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





?>