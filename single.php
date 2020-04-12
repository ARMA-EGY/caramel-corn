<?

include('ini.php'); 


if(isset($_GET['movie']))
{
	$movie_id = $_GET['movie'];
	
	include('include/single/movie.php');
	
}
elseif(isset($_GET['tv']))
{
	$tv_id = $_GET['tv'];
	
	include('include/single/tv.php');
	
}
elseif(isset($_GET['person']))
{
	$person_id = $_GET['person'];
	
	include('include/single/person.php');
	
}

	


 include('include/footer.php'); ?>

