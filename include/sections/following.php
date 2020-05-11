<?

$kind = 'following';

if(isset($_POST['user_id']))
{
	
	//Include Configuration File


	include('../db-connect.php'); 
	include('../function.php'); 
	include('../genre.php'); 
	
	
	$user_id 	 	= $_POST['user_id'];
	
	
	$stmt = $conn->prepare("SELECT * FROM $kind WHERE user_id = ?  ORDER BY id DESC LIMIT 0, 20");
	$stmt->execute(array($user_id));
	$rows = $stmt->fetchAll();
	
	$stmt2 = $conn->prepare("SELECT * FROM $kind WHERE user_id = ? ORDER BY id DESC");
	$stmt2->execute(array($user_id));
	$result = $stmt2->rowCount();
	
	$page  = 1 ;
	$pages = $result / 20 ;
	$total_pages = ceil($pages);
	
	$url = '&kind='.$kind.'';
	
?>
	    

	
	<div id="following_section">
		
<?
		if($result > 0) 
		{
?>
	 <div class="row my-2">
		<div class="col-md-12 pb-1">
			
			<select dir="ltr" class="select-control float-right m-1 select_sort" data-kind="<?=$kind?>" data-type="movies" data-target="#watchlist_movies" data-user="<?=$user_id?>">
				<option value="id DESC"> Latest </option>
				<option value="id ASC"> Oldest </option>
				<option value="name ASC"> From A to Z </option>
				<option value="name DESC"> From Z to A </option>
			</select>
			
			<select dir="ltr" class="select-control float-right m-1 select_show" data-kind="<?=$kind?>" data-type="movies" data-target="#watchlist_movies" data-user="<?=$user_id?>">
				<option value="20"> Show 20 </option>
				<option value="30"> Show 30 </option>
				<option value="40"> Show 40 </option>
				<option value="50"> Show 50 </option>
			</select>
			
		</div>	
	</div>

		
			<div class="row justify-content-center actor">

			<?

				foreach($rows as $row )
				{

					$person_id = $row['person_id'];
					
					$actor = api_connect("https://api.themoviedb.org/3/person/$person_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

					
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
					<a href="single.php?person=<?= $actor->id?>" class="card person-card transition" style="box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.3);border: none;border-radius: 1rem;">
						<img class="card-img-top" src="<?= $img?>" alt="<?= $actor->name?>" style="">
						<div class=" text-center">
						  <h5 class="card-title text-dark font-weight-bold"><?= $actor->name?></h5>
						</div>
					</a>
				</div>
				<!--  Actor Card Ends -->



			<? 
				}
			?>	


			</div>	
		
<?
		}
		else
		{
			echo '<h3 class="text-white text-center my-4">No Result Found</h3>';
		}
			
?>
					
				<!-- ================   Pagination   ================  -->

<? if($total_pages > 1)
	{
?>
			<div class="col-md-12 my-3" style="border-top: 1px solid rgba(255, 255, 255, 0.5);">
	
  			<ul class="col-md-12 pagination my-4 mx-auto" style="justify-content: center;">
				<li class="page-item <? if($page == 1){echo 'disabled';} ?>">
				  <a class="page-link" href="?page=<? if($page == 1){echo $page;}else{echo $page-1;} ?><?=$url?>" tabindex="-1">Prev</a>
				</li>


				<?php if ($page > 3): ?>
				<li class="page-item"><a class="page-link" href="?page=1&type=<?=$type?>">1</a></li>
				<li class="page-item"><div class="page-link">...</div></li>
				<?php endif; ?>

				<?php if ($page-2 > 2): ?><li class="page"><a class="page-link" href="?page=<?php echo $page-2 . $url ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
				<?php if ($page-1 > 3): ?><li class="page"><a class="page-link" href="?page=<?php echo $page-1 . $url ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

			<!--	
			<li class="page-item active"><a class="page-link" href="?page=<?php echo $page ?>"><?php echo $page ?></a></li>
			-->

				  <select class="page-item select_page" >
					 <?
					for ($i=1; $i<=$total_pages; $i++) 
					  {  
						  if ($page == $i){$selected = 'selected';}else{$selected = '';}
							 echo '<option value="'.$i.$url.'" '.$selected.'>'.$i.'</option>';
					  }; 

					 ?>
				  </select>

				<?php if ($page+1 < ceil($total_pages)+1): ?><li class="page-item"><a class="page-link" href="?page=<?php echo $page+1 . $url ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
				<?php if ($page+2 < ceil($total_pages)+1): ?><li class="page-item"><a class="page-link" href="?page=<?php echo $page+2 . $url ?>"><?php echo $page+2 ?></a></li><?php endif; ?>

				<?php if ($page < ceil($total_pages)-2): ?>

				  <? if ($page < ceil($total_pages)-3)
					{ ?>
				<li class="page-item"><div class="page-link">...</div></li>
				  <?}?>

				<li class="page-item"><a class="page-link" href="?page=<?php echo ceil($total_pages) . $url ?>"><?php echo ceil($total_pages) ?></a></li>
				<?php endif; ?>


				<li class="page-item">
				  <a class="page-link" href="?page=<?=$page+1 . $url?>">Next</a>
				</li>
			  </ul>
				
				
		 </div>
<?
	}
?>
		

	</div>	


<script>

        $(document).ready(function() {
            $('.tooltip2').tooltipster({
			contentCloning: true, 
			contentAsHTML: true, 
			interactive: true, 
			animation: 'fade',
			side: [ 'left', 'top', 'bottom', 'right'],
		    delay: 200,
			maxWidth: 360,
			minWidth: 200,
		    theme: 'tooltipster-borderless'
			});
        });
	
</script>

<? } 



?>






