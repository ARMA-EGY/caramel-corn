<?

include('ini.php'); 


if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };

?>
	
<style>

.card-title 
	{
		margin-bottom: .75rem;
		margin-top: 0.75rem;
	}

</style>


<!-- Actors Starts -->
<section id="act" class="section-spacing actor">
	<div class="back_layer">
		
  <div class="container" >
    <div class="row pb-4">
		
      <div class="col-md-12 p-1">
        <div class="section-title ">
			<h4 class="font-weight-bold title_btn text-white">Popular People</h4>
        </div>
      </div>
		
		
    </div>
	  
  
	  
    <div class="row justify-content-center">
		
		
	<?

		$actors = api_connect("https://api.themoviedb.org/3/trending/person/week?api_key=df264f8d059253c7e87471ab4809cbbf&page=$page");
		
		foreach($actors->results as $actor )
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
		<div class="col-sm-3 d-flex justify-content-center px-2 col-person">
  			<a href="single.php?person=<?= $actor->id?>" class="card person-card transition">
				<img class="card-img-top" src="<?= $img?>" alt="<?= $actor->name?>" style="">
				<div class=" text-center">
				  <h5 class="card-title text-dark font-weight-bold"><?= $actor->name?></h5>
				</div>
			</a>
		</div>
	    <!--  Actor Card Ends -->
	 
	  
	 <? } ?>
	   
	</div>			
	
	
	  

	  
	  	  
<?
	  $total_pages = $actors->total_pages;  
?>
	  
  <ul class="pagination my-4" style="justify-content: center;">
    <li class="page-item <? if($page == 1){echo 'disabled';} ?>">
      <a class="page-link" href="?page=<? if($page == 1){echo $page;}else{echo $page-1;} ?>" tabindex="-1">Prev</a>
    </li>
	  
	  
	<?php if ($page > 3): ?>
	<li class="page-item"><a class="page-link" href="?page=1">1</a></li>
	<li class="page-item"><a class="page-link" href="?page=2">2</a></li>
	<li class="page-item"><div class="page-link">...</div></li>
	<?php endif; ?>

	<?php if ($page-2 > 0): ?><li class="page"><a class="page-link" href="?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
	<?php if ($page-1 > 0): ?><li class="page"><a class="page-link" href="?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

<!--	
<li class="page-item active"><a class="page-link" href="?page=<?php echo $page ?>"><?php echo $page ?></a></li>
-->
	  
	  <select class="page-item select_page" >
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
	<li class="page-item"><div class="page-link">...</div></li>
	<li class="page-item"><a class="page-link" href="?page=<?php echo ceil($total_pages)-1 ?>"><?php echo ceil($total_pages)-1 ?></a></li>
	<li class="page-item"><a class="page-link" href="?page=<?php echo ceil($total_pages) ?>"><?php echo ceil($total_pages) ?></a></li>
	<?php endif; ?>

	  
    <li class="page-item">
      <a class="page-link" href="?page=<?=$page+1?>">Next</a>
    </li>
  </ul>
	  
	 
	  
	  

   </div>
  </div>
</section>
<!-- Actors Ends -->

	  
	  

<? include('include/footer.php'); ?>
