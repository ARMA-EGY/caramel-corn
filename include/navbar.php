<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/hover-min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<title>Caramel Corn</title>
</head>

<body>
	

	
	<nav class="navbar navbar-expand-md navbar-light customNav">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <div class="container1" onclick="myFunction(this)">
  <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div>
</div>
  </button>
		<a id="askFaran" class="navbar-brand" href="index.php"><img src="img/logo.png" width="85" height="50" alt=""/></a>
		
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <ul class="nav navbar-nav mr-auto mt-2 mt-lg-0">
      <li id="home" class="nav-item">
        <a class="nav-link active" href="#" >Movies</a>
      </li>
      <li id="abt" class="nav-item">
        <a class="nav-link" href="tv.html" >Tv Shows</a>
      </li>
       <li id="svc" class="nav-item">
        <a class="nav-link" href="actors.html">Actors</a>
      </li>
    </ul>
	  
	  <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Go</button>
    </form>
	  
  </div>
</nav>
	



<!-- Movies starts -->
<!-- Start Playing Now  -->
<section id="about" class="section-spacing">
  <div class="container">
    <div class="row pad">
      <div class="col-xs-12">
        <div class="section-title text-center">
          <h2>Movies</h2>
        </div>
      </div>
    </div>
	  
	  
	  
	<div class="row px-4">
		
		<?
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.themoviedb.org/3/movie/now_playing?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=1",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_CUSTOMREQUEST => "POST"
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$movies = json_decode($response);


		foreach($movies->results as $movie)
		{
	    	$date =  $movie->release_date;
			$newdate = date('j M, Y', strtotime($date));
			?>
		
			<div class="col-sm-6">               
			<div class="poster-card" style="box-shadow: 0 0 5px 1px #000;">
				<div class="poster"> <img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2/<?= $movie->poster_path?>" alt=""/></div>
				<div class="c-body">
					<div class="wrapper">
					<div class="rate">
						 <h5><?= $movie->vote_average?> <p><small class="text-muted">&nbsp;&nbsp;<i class="fa fa-star"></i> </small></p></h5>
				  </div>
				<div class="c-title">
					<a href="single.php?movie=<?= $movie->id?>"><?= $movie->title?> </a>  
					<span class="mt-2"><?= $newdate ?></span>
				</div>
					</div>

				<p class="c-text"><?= substr($movie->overview,0,170) . '...'?></p>
					<div class="details">
				<a class="btn btn-outline-light my-2 my-sm-0" type="submit">View Details</a>
					</div>
				</div>
			</div>

		</div>
		
			<?
		}
		
		?>
		
		
	</div>
	  
	  
	  
  </div>
</section>
<!-- End Playing Now -->
<!-- Movies ends -->


	  
	  
	
	
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/java.js"></script>
	<script src="js/wow.min.js"></script>
	<script>
              new WOW().init();
    </script>
	
	
	<section class="section-spacing1">
	<div class="footer">

	<b>All Copy Right 2018 &copy Are Reserved To ARMA.</b>
	
	</div>
	</section>
	
</body>
	
	
	
</html>

