<?

include('ini.php'); 



	if(isset($_GET['movie']))
	{
		$movie_id = $_GET['movie'];
	}


	$movie = api_connect("https://api.themoviedb.org/3/movie/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

	$date =  $movie->release_date;
	$newdate = date('j M, Y', strtotime($date));

	?>
	
	
<section id="act" class="section-spacing single">
  <div class="container">
    <div class="row pad">
      <div class="col-xs-12">
        <div class="section-title text-center">
          <h2><?= $movie->title?></h2>
        </div>
      </div>
    </div>
	  
	  
		  <div class="container-fluid head1">
		<div class="row">
			<div class="col-md wow bounceInLeft" data-wow-delay="1s">
			
		    <img src="https://image.tmdb.org/t/p/w300_and_h450_bestv2/<?= $movie->poster_path?>"  alt=""/> </div>
			
		  <div class="col-md wow bounceInRight" data-wow-delay="1s">
			
			  <h2><?= $movie->title?></h2> 
			  
			 <h3>Overview</h3>
			  <p><?= $movie->overview?></p>
			  <h5>Revenue : <?= number_format($movie->revenue)?></h5>
			  <h5>Status : Released</h5>
			  <h5>Tag line : Some Missions Are Not A Choice</h5>
			  <div class="vote">
			     <h5>Vote : <?= $movie->vote_average?> <p><small class="text-muted">&nbsp;&nbsp;<i class="fa fa-star"></i> </small></p></h5>
		  </div>
				</div>
			</div>
		</div>
	  
	  
	  
	  
	  
	  
	  <div class="row pad">
      <div class="col-xs-12">
        <div class="section-title text-center">
          <h2>Cast</h2>
        </div>
      </div>
    </div>

	  <div class="row">
  <div class="col-sm-2"> 
	<div class="card">
    <img class="card-img-top" src="img/ryan.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Ryan Reynolds</h5>
      <p class="card-text">Deadpool</p>
    </div>
  </div>
	</div>
	
	 <div class="col-sm-2"> 
	<div class="card">
    <img class="card-img-top" src="img/ryan.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Ryan Reynolds</h5>
      <p class="card-text">Deadpool</p>
    </div>
  </div>
	</div>
	  
	   <div class="col-sm-2"> 
	<div class="card">
    <img class="card-img-top" src="img/ryan.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Ryan Reynolds</h5>
      <p class="card-text">Deadpool</p>
    </div>
  </div>
	</div>
	  
	   <div class="col-sm-2"> 
	<div class="card">
    <img class="card-img-top" src="img/ryan.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Ryan Reynolds</h5>
      <p class="card-text">Deadpool</p>
    </div>
  </div>
	</div>
	  
	   <div class="col-sm-2"> 
	<div class="card">
    <img class="card-img-top" src="img/ryan.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Ryan Reynolds</h5>
      <p class="card-text">Deadpool</p>
    </div>
  </div>
	</div>
	  
	   <div class="col-sm-2"> 
	<div class="card">
    <img class="card-img-top" src="img/ryan.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Ryan Reynolds</h5>
      <p class="card-text">Deadpool</p>
    </div>
  </div>
	</div>
	  
		        </div>
		  
		  
	  <div class="row">
  <div class="col-sm-2"> 
	<div class="card">
    <img class="card-img-top" src="img/ryan.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Ryan Reynolds</h5>
      <p class="card-text">Deadpool</p>
    </div>
  </div>
	</div>
	
	 <div class="col-sm-2"> 
	<div class="card">
    <img class="card-img-top" src="img/ryan.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Ryan Reynolds</h5>
      <p class="card-text">Deadpool</p>
    </div>
  </div>
	</div>
	  
	   <div class="col-sm-2"> 
	<div class="card">
    <img class="card-img-top" src="img/ryan.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Ryan Reynolds</h5>
      <p class="card-text">Deadpool</p>
    </div>
  </div>
	</div>
	  
	   <div class="col-sm-2"> 
	<div class="card">
    <img class="card-img-top" src="img/ryan.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Ryan Reynolds</h5>
      <p class="card-text">Deadpool</p>
    </div>
  </div>
	</div>
	  
	   <div class="col-sm-2"> 
	<div class="card">
    <img class="card-img-top" src="img/ryan.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Ryan Reynolds</h5>
      <p class="card-text">Deadpool</p>
    </div>
  </div>
	</div>
	  
	   <div class="col-sm-2"> 
	<div class="card">
    <img class="card-img-top" src="img/ryan.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Ryan Reynolds</h5>
      <p class="card-text">Deadpool</p>
    </div>
  </div>
	</div>
	  
		        </div>
	  
	</div>
	</section>


	


<? include('include/footer.php'); ?>

