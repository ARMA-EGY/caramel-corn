<?

include('ini.php'); 



if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };

?>
	



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
	  
	  
	  
	<div class="row p-4">
		
		<?
		
		
		
		$movies = api_connect("https://api.themoviedb.org/3/movie/now_playing?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US&page=$page");


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
	  
	  
	  
	  
	  
<?
	  $total_pages = $movies->total_pages;  
?>
	  
 
  <ul class="pagination my-4" style="justify-content: center;">
    <li class="page-item <? if($page == 1){echo 'disabled';} ?>">
      <a class="page-link" href="?page=<? if($page == 1){echo $page;}else{echo $page-1;} ?>" tabindex="-1">Prev</a>
    </li>
	  
	  
	<?php if ($page > 3): ?>
	<li class="page-item"><a class="page-link" href="?page=1">1</a></li>
	<li class="page-item"><div class="page-link">...</div></li>
	<?php endif; ?>

	<?php if ($page-2 > 2): ?><li class="page"><a class="page-link" href="?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
	<?php if ($page-1 > 3): ?><li class="page"><a class="page-link" href="?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

<!--	
<li class="page-item active"><a class="page-link" href="?page=<?php echo $page ?>"><?php echo $page ?></a></li>
-->
	  
	  <select class="page-item select_page" style="background: #007bff; color: #fff">
		 <?
		for ($i=1; $i<=$total_pages; $i++) 
		  {  
			  if ($page == $i){$selected = 'selected';}else{$selected = '';}
				 echo '<option '.$selected.'>'.$i.'</option>';
		  }; 
	
		 ?>
	  </select>

	<?php if ($page+1 < ceil($total_pages)+1): ?><li class="page-item"><a class="page-link" href="?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
	<?php if ($page+2 < ceil($total_pages)+1): ?><li class="page-item"><a class="page-link" href="?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php endif; ?>

	<?php if ($page < ceil($total_pages)-2): ?>
	  
	  <? if ($page < ceil($total_pages)-3)
		{ ?>
	<li class="page-item"><div class="page-link">...</div></li>
	  <?}?>
	  
	<li class="page-item"><a class="page-link" href="?page=<?php echo ceil($total_pages) ?>"><?php echo ceil($total_pages) ?></a></li>
	<?php endif; ?>

	  
    <li class="page-item">
      <a class="page-link" href="?page=<?=$page+1?>">Next</a>
    </li>
  </ul>
	  
	 
	   
	  
  
	  
  </div>
</section>
<!-- End Playing Now -->
<!-- Movies ends -->


	  
	

<? include('include/footer.php'); ?>



