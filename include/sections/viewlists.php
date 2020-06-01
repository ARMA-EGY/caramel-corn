<?

	//Include Configuration File


	include('../db-connect.php'); 
	include('../function.php'); 
	include('../genre.php'); 

	$kind = 'lists';
	$user_id 	 	= $_POST['user_id'];


?>
	<div class="row justify-content-center">
<?
	
		$stmt = $conn->prepare("SELECT * FROM $kind WHERE user_id = ? AND public = 'Yes'  ");
		$stmt->execute(array($user_id));
		$rows = $stmt->fetchAll();
	
		
		$count = $stmt->rowCount();

		// if count > 0 this mean the database contain record about this username

		if ($count > 0 )
		{
			foreach($rows as $row)
			{  
				
				$newdate = date('j M, Y', strtotime($row['Add_Date']));
				
				if ($row['cover'] == '' )
				{
					$cover = 'layout/img/popcorn/cover.jpg' ;
				}
				else
				{
					$cover = 'https://image.tmdb.org/t/p/w355_and_h200_bestv2'.$row['cover'] ;
				}
	?>
					<div class="mx-2 photo-box" style="width: 355px" data-cover="<?=$row['cover'] ?>" data-list="<?=$row['id']  ?>" >
						
						<a href="viewlist.php?u=<?=$row['uid']?>&u2=<?= $user_id ?>" class="post-box" style="background-image: url(<?=$cover ?>)" >
							
							<div class="highlight">
								<div class="text text-light">
									<h6><?= ucwords($row['name'])  ?></h6>
									<span><?=$newdate ?></span>
									
								</div>
							</div>
							<span style="position: absolute;bottom: 5px;left: 10px;color: white;">
								<i class="fas fa-film"></i> <?= countItems2 ('list_id', 'movie_list', $row['id']) ?> </span>
						</a>
					</div>
	<? 		} 
			
		}
	else
	{
		echo "<h3 class='text-center text-white'>There's No Lists Found .</h3>";
	}
				
?>		
				
	</div>
				


