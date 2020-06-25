<?

include('ini.php'); 


if(isset($_GET['movie']))
{
	
	$movie_id = $_GET['movie'];

	$movie = api_connect("https://api.themoviedb.org/3/movie/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");


	$casts = api_connect("https://api.themoviedb.org/3/movie/$movie_id/credits?api_key=df264f8d059253c7e87471ab4809cbbf");

	$name = $movie->title;
	
	$date =  $movie->release_date;
	
	$back_link = 'single.php?movie='.$movie_id ;
	
}
elseif(isset($_GET['tv']))
{
	
	$movie_id = $_GET['tv'];

	$movie = api_connect("https://api.themoviedb.org/3/tv/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

	$casts = api_connect("https://api.themoviedb.org/3/tv/$movie_id/credits?api_key=df264f8d059253c7e87471ab4809cbbf");

	$name = $movie->name;
	
	$date =  $movie->first_air_date;
	
	$back_link = 'single.php?tv='.$movie_id ;
}



$newdate = date('j M, Y', strtotime($date));
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
	
<style>

.card-title 
	{
		margin-bottom: .75rem;
		margin-top: 0.75rem;
	}
	
.col-person 
{
	max-width: 180px;
	display: inline-block;
}

.mh-80{height: 80px;}

</style>


<!-- Actors Starts -->
<section id="act" class="section-spacing ">
	<div class="back_layer">
		
	<!-- =====================  Cover  =====================  -->
		
  		<div style="background: url('https://image.tmdb.org/t/p/w1920_and_h800_multi_faces<?=$movie->backdrop_path?>');background-size: cover;">
	  
	  

			<div class="container-fluid p-3 layer_background mb-4">
				<div class="row">

					<div class="col-md-4 text-center m-auto" >

						<img class="poster_img" src="<?= $img?>"  alt=""/> 
						
					</div>


					<div class="col-md-5 pt-4 text-white text-center">

						  <h3 class="font-weight-bold text-white"><?= $name ?> 
							  <a href="m_browse.php?type=year&year=<?= $year ?>" class="movie_year"> (<?= $year ?>)</a>
						  </h3> 


						   <div class="cate my-3" >

									<?

										foreach($movie->genres as $genre )
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


							<a class="text-white" href="<?= $back_link ?>">
								<i class="fas fa-long-arrow-alt-left"></i> Back To Main
						    </a>

					</div>


					<div class="col-md-3 text-center m-auto">
						
						

					</div>

				</div>
			</div>
			
	  
		</div>
		
		
		
  <div class="container" >
	  
	  <div class="col-sm-12 mb-3">
				<h5 class="font-weight-bold title_btn">
					<span class="text-white">Full Cast</span> 
				</h5>
			</div>
    
			<ul class="actor text-center">
		
	<?

			foreach($casts->cast as $actor )
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

				<!--  Actor Card Starts -->
				<li class="px-1 col-person">
					<a href="single.php?person=<?= $actor->id?>" class="card person-card transition cast_card">
						<img class="card-img-top" src="<?= $img?>" alt="<?= $actor->name?>" style="">
						<div class=" text-center mh-80">
						  <h5 class="card-title text-dark font-weight-bold"><?= $actor->name?></h5>
						  <h6 class="text-dark" style="font-size: 9pt;"><?= $actor->character?></h6>
						</div>
					</a>
				</li>
				<!--  Actor Card Ends -->


		 <? } ?>
	   
	
		  	</ul>		
	
	
	  

	  

   </div>
  </div>
</section>
<!-- Actors Ends -->

	  
	  

<? include('include/footer.php'); ?>
