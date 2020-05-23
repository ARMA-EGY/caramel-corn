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
	
		$stmt = $conn->prepare("SELECT * FROM $kind WHERE user_id = ?  ");
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
						<i class="fas fa-ellipsis-h poster_more" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="right: 15px; top: 25px;"></i>
				
							<div class="dropdown-menu dropdown-menu-right text-white" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item get_list_modal" data-kind="edit" data-list="<?= $row['uid'] ?>" data-user="<?= $user_id ?>">
									<i class="fas fa-pen-square text-success"></i> Edit</a>
								<a class="dropdown-item get_list_modal" data-kind="cover" data-list="<?= $row['uid'] ?>" data-user="<?= $user_id ?>">
									<i class="far fa-images text-warning"></i> Change Cover</a>
								<a class="dropdown-item get_list_modal" data-kind="remove" data-list="<?= $row['uid'] ?>" data-user="<?= $user_id ?>">
									<i class="fa fa-trash text-danger"></i> Remove</a>
								<a class="dropdown-item get_list_modal" data-kind="share" data-list="<?= $row['uid'] ?>" data-user="<?= $user_id ?>">
									<i class="fas fa-share-alt text-primary"></i> Share</a>	
							</div>
						
						<a href="viewlist.php?u=<?=$row['uid'] ?>" class="post-box" style="background-image: url(<?=$cover ?>)" >
							
							<div class="highlight">
								<div class="text text-light">
									<h6><?=$row['name'] ?></h6>
									<span><?=$newdate ?></span>
									<br>
									<? if($row['public'] == 'Yes'){echo '<span class="badge badge-secondary mt-1">Public</span>';}else{echo '<span class="badge badge-primary mt-1">Private</span>'; } ?>
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
		echo "<p class='text-center'>There's No Lists Found .</p>";
	}
				
?>		
				
	</div>
				

