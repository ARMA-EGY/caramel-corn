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
  <div class="container">
    <div class="row pad">
      <div class="col-xs-12">
        <div class="section-title text-center">
          <h2>Actors</h2>
        </div>
      </div>
    </div>
	  
  
	  
    <div class="row">
		
		
	<?

		$actors = api_connect("https://api.themoviedb.org/3/trending/person/week?api_key=df264f8d059253c7e87471ab4809cbbf&page=$page");
		
		foreach($actors->results as $actor )
		{
	?>
		
		<!--  Actor Card Starts -->
		<div class="col-sm-3 d-flex justify-content-center">
  			<div class="card" style="border-radius: 10px;box-shadow: 0 0 5px 1px #555; width: 85%;">
				<img class="card-img-top" src="https://image.tmdb.org/t/p/w235_and_h235_face/<?= $actor->profile_path?>" alt="<?= $actor->name?>" style="border-radius: 10px 10px 0 0;">
				<div class=" text-center">
				  <h5 class="card-title"><?= $actor->name?></h5>
				</div>
			</div>
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
	<li class="page-item"><div class="page-link">...</div></li>
	<li class="page-item"><a class="page-link" href="?page=<?php echo ceil($total_pages)-1 ?>"><?php echo ceil($total_pages)-1 ?></a></li>
	<li class="page-item"><a class="page-link" href="?page=<?php echo ceil($total_pages) ?>"><?php echo ceil($total_pages) ?></a></li>
	<?php endif; ?>

	  
    <li class="page-item">
      <a class="page-link" href="?page=<?=$page+1?>">Next</a>
    </li>
  </ul>
	  
	 
	  
	  

  </div>
</section>
<!-- Actors Ends -->

	  
	  

<? include('include/footer.php'); ?>
