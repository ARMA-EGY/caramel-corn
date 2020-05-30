<?

// error_reporting(E_ALL);
// ini_set('display_errors','On');



//Include Configuration File
include('include/db-connect.php'); 
include('include/function.php'); 
include('include/genre.php'); 




// ========================= GET STEP 2 CREATE NEW LIST  =========================

if (isset($_POST['list_name']))
{
	
    	$name    	= filter_var($_POST['list_name'], FILTER_SANITIZE_STRING);
    	$desc    	= filter_var($_POST['desc'], FILTER_SANITIZE_STRING);
    	$public    	= $_POST['public'];
    	$user_id    = $_POST['user_id'];
	
		$uid 		= uniqid();	

			if (strlen($name) > 32 )
			{
				$error = 'List Name Cannot be More Than 32 Chars ';
			}
			else if (strlen($name) == 0 )
			{
				$error = 'List Name Cannot be Empty';
			}
			else
			{
				$error = '';
			}
	
		$stmt = $conn->prepare("SELECT * FROM lists WHERE name = ? AND user_id = ?  ");
		$stmt->execute(array($name, $user_id));
		$row = $stmt->fetch();

		$count = $stmt->rowCount();
	

		// if count > 0 this mean the database contain record about this username

		if ($count > 0 || $error != '' )
		{
			if ($error == ''){$error = 'This List Name is already Exist';}
			
			
			?>
			<script>
				
				 const Toast = Swal.mixin({
					  toast: true,
					  position: 'top-end',
					  showConfirmButton: false,
					  timer: 4000,
					  timerProgressBar: true,
					  onOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					  }
					})
				
					var title = '<?=$error ?>';

						Toast.fire({
						  icon: 'error',
						  title: title
						})

			</script>

			
			<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" style="margin: 20px auto;">
             <tbody>
						
					<tr>
                      <td width="55">&nbsp;</td>
                      <td width="55" align="center"><img class="mb-2" src="layout/img/marker.png" width="15" ></td>
                      <td width="55" align="center"></td>
                      <td width="55" align="center"></td>
                    </tr>
						
                    <tr>
                      <td width="55" height="13" class="font-weight-bold" style="color: #fff;">Step : </td>
                      <td width="55" height="13" align="center" bgcolor="#f3e095" class=""> 
						  <u>1</u>
					  </td>
                      <td width="55" height="13" align="center" bgcolor="#EEF5F9" class="f1">
						  <u>2</u>
					  </td>
                      <td width="55" height="13" align="center" bgcolor="#EEF5F9" class="f1"> 
						  <u>3</u>
					  </td>
                    </tr>
						
			  </tbody>
			</table>
			
			
       		<div class="container" style="justify-content: center; display: flex;">
			
          <form class="col-md-10 list_form" style="padding: 20px;border: 1px solid #ccc;border-radius: 10px;box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.5);background:#fff;">
			  

			 <!--======= List Name ========-->  

					<div class="form-row form-group"> 

						<div class="col-md-10 mx-auto mb-2" style="border-bottom: 1px solid #555;">
							<div class="form-group">
							  <label class="font-weight-bold" for="inputName">Name</label>
							  <input pattern=".{3,32}" title="Name Must Be Between 3:32 Chars" type="text" class="form-control text-dark" id="inputName" name="list_name" value="<?=$name ?>" required>
							</div>
						</div>
						
						
			 <!--======= List Description ========-->  

						<div class="col-md-10 mx-auto mb-2" style="border-bottom: 1px solid #555;">
							<div class="form-group">
							  <label class="font-weight-bold" for="inputDesc">Description</label>
								<textarea class="form-control text-dark" id="inputDesc" name="desc" ><?=$desc ?></textarea>
							</div>
						</div>
						
						
			 <!--======= Public List ========-->  

						<div class="col-md-10 mx-auto mb-2">
							<div class="form-group">
							  <label class="font-weight-bold" for="inputState">Public List</label>		 
							  <select id="inputState" class="form-control text-dark" name="public">
								<option selected>Yes</option>
								<option>No</option>
							  </select>
							</div>
						</div>
				

					</div>
			  
			  <input type="hidden" name="user_id" value="<?=$user_id ?>">
			  
			  <div class="modal-footer">
				<button type="submit" class="btn-filter">Next</button>
			  </div>
				
		    </form>
				
	  	</div>


			<?

			
			
		}
		else
		{

			$stmt = "INSERT INTO lists ( `name`, `description`, `public`, `user_id`, `Add_Date`, `step`, `uid`)

						VALUES('$name', '$desc' , '$public', '$user_id', now(), 1, '$uid' )";

			$conn->exec($stmt);

			$list_id = $conn->lastInsertId();
	
	
?>


		<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" style="margin: 20px auto;">
             <tbody>
						
					<tr>
                      <td width="55">&nbsp;</td>
                      <td width="55" align="center"></td>
                      <td width="55" align="center"><img class="mb-2" src="layout/img/marker.png" width="15" ></td>
                      <td width="55" align="center"></td>
                    </tr>
						
                    <tr>
                      <td width="55" height="13" class="font-weight-bold" style="color: #fff;">Step : </td>
                      <td width="55" height="13" align="center" bgcolor="#EEF5F9" class="f11"> 
						  <u>1</u>
					  </td>
                      <td width="55" height="13" align="center" bgcolor="#f3e095" class="f1">
						  <u>2</u>
					  </td>
                      <td width="55" height="13" align="center" bgcolor="#EEF5F9" class="f1"> 
						  <u>3</u>
					  </td>
                      
                    </tr>
						
			  </tbody>
			</table>
		

        <div class="container" style="justify-content: center; display: flex;">


			<form class="col-md-10 list_form" style="padding: 20px;border: 1px solid #ccc;border-radius: 10px;box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.5);background:#fff;min-height: 300px;">


			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item" role="presentation">
				<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Movies</a>
			  </li>
			  <li class="nav-item" role="presentation">
				<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tv Shows</a>
			  </li>

			</ul>
			<div class="tab-content" id="myTabContent" style="
				min-height: 130px;
			">
			  <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">


			  <div class="form-group mt-3 mb-5" style="position: relative">
				<label for="formGroupExampleInput">Add Movie</label>
				<input type="text" class="form-control text-dark search_bar2" id="formGroupExampleInput" placeholder="Search for a Movie" data-type="movie" data-target="#search_result2" data-list="<?=$list_id ?>" data-user="<?=$user_id ?>">
				<div id="search_result2"></div>
			  </div>
				  
			  <div id="movie_list" class="row justify-content-center"></div>



			</div>
			  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

			  <div class="form-group mt-3 mb-5" style="position: relative">
				<label for="formGroupExampleInput">Add Tv Show</label>
				<input type="text" class="form-control text-dark search_bar2" id="formGroupExampleInput" placeholder="Search for a Tv Show" data-type="tv" data-target="#search_result3" data-list="<?=$list_id ?>" data-user="<?=$user_id ?>">
				<div id="search_result3"></div>
			  </div>
				  
			  <div id="tv_list" class="row justify-content-center"></div>

			</div>

			</div>
					
				
			  <input type="hidden" name="user_id" value="<?=$user_id ?>">
			  <input type="hidden" name="list_id" value="<?=$list_id ?>">
			  <input type="hidden" name="step_2" value="2">
				
			  <div class="modal-footer">
				<button type="submit" class="btn-filter">Next</button>
			  </div>

		</form>


		</div>
			
<?

		}
	
}



// ========================= GET STEP 3 CREATE NEW LIST  =========================

if (isset($_POST['step_2']))
{
	
    	$step    	= $_POST['step_2'];
    	$user_id    = $_POST['user_id'];
    	$list_id    = $_POST['list_id'];
    

		$stmt = $conn->prepare("UPDATE lists SET step = ? WHERE id = ?");
		$stmt->execute(array($step, $list_id));
	
	
?>


		<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" style="margin: 20px auto;">
             <tbody>
						
					<tr>
                      <td width="55">&nbsp;</td>
                      <td width="55" align="center"></td>
                      <td width="55" align="center"></td>
                      <td width="55" align="center"><img class="mb-2" src="layout/img/marker.png" width="15" ></td>
                    </tr>
						
                    <tr>
                      <td width="55" height="13" class="font-weight-bold" style="color: #fff;">Step : </td>
                      <td width="55" height="13" align="center" bgcolor="#EEF5F9" class="f11"> 
						  <u>1</u>
					  </td>
                      <td width="55" height="13" align="center" bgcolor="#EEF5F9" class="f1">
						  <u>2</u>
					  </td>
                      <td width="55" height="13" align="center" bgcolor="#f3e095" class="f1"> 
						  <u>3</u>
					  </td>
                      
                    </tr>
						
			  </tbody>
			</table>
		

        <div class="container" style="justify-content: center; display: flex;">


			<form class="col-md-10" action="corn.php" style="padding: 20px;border: 1px solid #ccc;border-radius: 10px;box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.5);background:#fff;min-height: 300px;">
		
			<div>
			<h4>Choose Cover :</h4>
			<hr>
				
				
			<div class="row justify-content-center">
				
<?
	
		$stmt = $conn->prepare("SELECT * FROM movie_list WHERE list_id = ?  ");
		$stmt->execute(array($list_id));
		$rows = $stmt->fetchAll();
	
		
		$count = $stmt->rowCount();

		// if count > 0 this mean the database contain record about this username

		if ($count > 0 )
		{
			$counter = 0;
			
			foreach($rows as $row)
			{  
				$counter++ ;
	?>
					<div class="mx-2 photo-box select_cover" style="width: 355px" data-cover="<?=$row['cover'] ?>" data-list="<?=$list_id ?>" >
						<? 
							if($counter == 1)
							{
								echo '<i class="fas fa-check poster_more cover_selected text-warning"></i>';
								
								$stmt = $conn->prepare("UPDATE lists SET step = 3 , cover = ? WHERE id = ?");
								$stmt->execute(array($row['cover'], $list_id));
							} 
					    ?>
						<a class="post-box" style=" background-image: url(https://image.tmdb.org/t/p/w355_and_h200_bestv2<?=$row['cover'] ?>) " >
							<div class="highlight">
							</div>
						</a>
					</div>
	<? 		} 
			
		}
	else
	{
		echo "<p class='text-center'>There's No Images To Select .</p>";
	}
				
?>		
				
			</div>
				
			
			</div>		
	
				
			  <div class="modal-footer">
				<button type="submit" class="btn-filter">Finish</button>
			  </div>

		</form>


		</div>
			
<?

	
}


// ========================= FINISH CREATE NEW LIST  =========================

if (isset($_POST['step_3']))
{
    	$step    	= $_POST['step_3'];
    	$cover      = $_POST['cover'];
    	$list_id    = $_POST['list_id'];
    

		$stmt = $conn->prepare("UPDATE lists SET step = ? , cover = ? WHERE id = ?");
		$stmt->execute(array($step, $cover, $list_id));

}


// ========================= GET  CREATE NEW LIST  =========================

	if(isset($_POST['search']))
	{
		$search 	= $_POST['search'];
		$type 		= $_POST['type'];
		$target 	= $_POST['target'];
		$list_id 	= $_POST['list'];
		$user_id 	= $_POST['user'];

		$results = api_connect("https://api.themoviedb.org/3/search/$type?api_key=df264f8d059253c7e87471ab4809cbbf&language=en&query=$search&page=1&include_adult=false");

		echo "<ul class='mb-0'>";

		if($type == 'movie')
		{
			foreach(array_slice($results->results, 0, 20) as $movie )
			{
				$date =  $movie->release_date;
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

			<li class="search-row">
				<div class="search-link select_list" data-tmdb="<?= $movie->id?>" data-type="Movie" data-list="<?=$list_id ?>" data-user="<?=$user_id ?>" data-target="<?=$target ?>" data-section="#movie_list" >

					<img src="<?= $img?>" alt="" style="width: 50px;float: left;margin-right: 15px;">
					<span style="color: #fff;"> <?= $movie->title?></span>
					<p style="color: #fff;">(<?=$year ?>)</p>

				</div>
				<div class="clearfix"></div>
			</li>

			<? 
			}

		}
		elseif($type == 'tv')
		{
			foreach(array_slice($results->results, 0, 20) as $tv )
			{
				$date =  $tv->first_air_date;
				$year = date('Y', strtotime($date));

				if ($tv->poster_path == '')
				{
					$img = 'layout/img/no_poster.jpeg';
				}
				else
				{
					$img = 'https://image.tmdb.org/t/p/w185_and_h278_bestv2' . $tv->poster_path ;
				}

			?>

			<li class="search-row" >
				<div class="search-link select_list" data-tmdb="<?= $tv->id?>" data-type="TV" data-list="<?=$list_id ?>" data-user="<?=$user_id ?>" data-target="<?=$target ?>" data-section="#tv_list">

					<img src="<?= $img?>" alt="" style="width: 50px;float: left;margin-right: 15px;">
					<span style="color: #fff;"> <?= $tv->name?></span>
					<p style="color: #fff;">(<?=$year ?>)</p>

				</div>
				<div class="clearfix"></div>
			</li>

			<? 
			}
		}


	}



// ========================= ADD ITEM TO LIST  =========================

	if(isset($_POST['add_list']))
	{
		$list 	    = $_POST['add_list'];
		$type 		= $_POST['type'];
		$tmdb 	    = $_POST['tmdb'];
		$user_id 	= $_POST['user'];
		
	
		$stmt = $conn->prepare("SELECT * FROM movie_list WHERE tmdb_id = ? AND user_id = ? AND list_id = ? ");
		$stmt->execute(array($tmdb, $user_id, $list));
		$row = $stmt->fetch();

		$count = $stmt->rowCount();

		// if count > 0 this mean the database contain record about this username

		if ($count > 0 )
		{
			?>
			<script>
				
					
				 const Toast = Swal.mixin({
					  toast: true,
					  position: 'top-end',
					  showConfirmButton: false,
					  timer: 3000,
					  timerProgressBar: true,
					  onOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					  }
					})
				
					var title = "This item is already on the List";

						Toast.fire({
						  icon: 'error',
						  title: title
						})

			</script>
			<?

		}
		else
		{

			if($type == 'Movie')
			{

						$movie_id = $tmdb;

						$movie = api_connect("https://api.themoviedb.org/3/movie/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

						$date =  $movie->release_date;
						$newdate = date('j M, Y', strtotime($date));

						$rate  = $movie->vote_average * 10 ;
						$rate1 = $movie->vote_average  ;
						$name  = $movie->title  ;
						$cover = $movie->backdrop_path  ;

						$stmt = "INSERT INTO movie_list ( `list_id`, `tmdb_id`, `type`, `user_id`, `Add_Date`, `name`, `rate`, `cover`, `release_date`)

									VALUES('$list', '$tmdb' , '$type', '$user_id', now(), '$name', '$rate1', '$cover' , '$date' )";

						$conn->exec($stmt);

						$item_id = $conn->lastInsertId();

						if ($movie->poster_path == '')
						{
							$img = 'layout/img/no_poster.jpeg';
						}
						else
						{
							$img = 'https://image.tmdb.org/t/p/w185_and_h278_bestv2' . $movie->poster_path ;
						}

				?>

				  <!-- Start New Card -->
					<div class="variable_card px-2 show_cards fade show">  


						<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
							<div class="poster"> 
								<i class="fas fa-times-circle poster_remove" data-id="<?=$item_id ?>" ></i>
									<img width="100%" src="<?= $img?>" alt=""/>
							</div>

						</div>

						<div class="d-none">

							<div class="c-body" id="tooltip_content_<?= $movie->id?>">

							 <div class="wrapper">

								<div class="c-title">
									<a class="caramel_color"><?= $movie->title?> </a>  
									<div class="ratings">
									  <div class="empty-stars"></div>
									  <div class="full-stars" style="width:<?= $rate?>%"></div>
									</div>
									<span class="votes">(<?= number_format($movie->vote_count)?> Votes)</span>
								</div>

								<div class="rate">
									 <h5 class="text-white font-weight-bold"><?= $movie->vote_average?> </h5>
								</div>



							  </div>

							<p class="c-text mb-2"><?= substr($movie->overview,0,90) . '...'?></p>

							<div class="mb-0 field-label" >Relase Date : <span style="color: #fff;"><?= $newdate ?></span></div>


							<div class="cate mt-3" >

								<?

									foreach(array_slice($movie->genres, 0, 4) as $genre )
									{
										$genre_cate = '_'.$genre->id;
										?>

								<div class="mb-1 cate_color_<?= $genre->id;?>">
									<a ><?= $cate->$genre_cate;?></a>
								</div>

										<?
									}

								?>

							</div>


							<div class="details mt-3" >

								<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>


							</div>


							</div>

						</div>

					</div>

				  <!-- End New Card -->

				<?
			}
			elseif($type == 'TV')
			{

					$movie_id = $tmdb;

					$movie = api_connect("https://api.themoviedb.org/3/tv/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

					$date =  $movie->first_air_date;
					$newdate = date('j M, Y', strtotime($date));

					$rate  = $movie->vote_average * 10 ;
					$rate1 = $movie->vote_average  ;
					$name  = $movie->name  ;
					$cover = $movie->backdrop_path  ;

					$stmt = "INSERT INTO movie_list ( `list_id`, `tmdb_id`, `type`, `user_id`, `Add_Date`, `name`, `rate`, `cover`, `release_date`)

								VALUES('$list', '$tmdb' , '$type', '$user_id', now(), '$name', '$rate1', '$cover' , '$date' )";

					$conn->exec($stmt);

					$item_id = $conn->lastInsertId();

					if ($movie->poster_path == '')
					{
						$img = 'layout/img/no_poster.jpeg';
					}
					else
					{
						$img = 'https://image.tmdb.org/t/p/w185_and_h278_bestv2' . $movie->poster_path ;
					}

				?>

				  <!-- Start New Card -->
					<div class="variable_card px-2 show_cards fade show">  


						<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
							<div class="poster"> 
								<i class="fas fa-times-circle poster_remove" data-id="<?=$item_id ?>" ></i>
									<img width="100%" src="<?= $img?>" alt=""/>
							</div>

						</div>

						<div class="d-none">

							<div class="c-body" id="tooltip_content_<?= $movie->id?>">

							 <div class="wrapper">

								<div class="c-title">
									<a class="caramel_color"><?= $movie->name?> </a>  
									<div class="ratings">
									  <div class="empty-stars"></div>
									  <div class="full-stars" style="width:<?= $rate?>%"></div>
									</div>
									<span class="votes">(<?= number_format($movie->vote_count)?> Votes)</span>
								</div>

								<div class="rate">
									 <h5 class="text-white font-weight-bold"><?= $movie->vote_average?> </h5>
								</div>



							  </div>

							<p class="c-text mb-2"><?= substr($movie->overview,0,90) . '...'?></p>

							<div class="mb-0 field-label" >Relase Date : <span style="color: #fff;"><?= $newdate ?></span></div>


							<div class="cate mt-3" >

								<?

									foreach(array_slice($movie->genres, 0, 4) as $genre )
									{
										$genre_cate = '_'.$genre->id;
										?>

								<div class="mb-1 cate_color_<?= $genre->id;?>">
									<a><?= $cate->$genre_cate;?></a>
								</div>

										<?
									}

								?>

							</div>


							<div class="details mt-3" >

								<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>


							</div>


							</div>

						</div>

					</div>

				  <!-- End New Card -->


				<?


			}

?>

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
<?
			
		}

		
	}



// ========================= REMOVE ITEM FROM LIST  =========================

	if(isset($_POST['remove_item']))
	{
		
		  $id 	    = $_POST['remove_item'];
		
		  $stmt = $conn->prepare("DELETE FROM movie_list WHERE id = ?  ");

		  $stmt->execute(array($id));

	}



// ========================= LIST KIND ACTIONS  =========================

if (isset($_POST['list_kind']))
{
	$kind 	    	= $_POST['list_kind'];
	$user_id 	    = $_POST['user_id'];
	$list_uid 	    = $_POST['list_id'];
	
		
	$stmt = $conn->prepare("SELECT * FROM lists WHERE uid = ? AND user_id = ? ");
	$stmt->execute(array($list_uid, $user_id));
	$row = $stmt->fetch();
	
	
	if ($kind == 'remove')
	{
		$stmt = $conn->prepare("DELETE FROM lists WHERE uid = ?  ");

		$stmt->execute(array($list_uid));
		
		$stmt = $conn->prepare("DELETE FROM movie_list WHERE list_id = ?  ");

		$stmt->execute(array($row['id']));
		
	}
	elseif ($kind == 'edit')
	{
		?>


          <form class="edit_list_form" >
			  
			 <!--======= List Name ========-->  

					<div class="form-row form-group"> 

						<div class="col-md-10 mx-auto mb-2" style="border-bottom: 1px solid #555;">
							<div class="form-group">
							  <label class="font-weight-bold" for="inputName">Name</label>
							  <input pattern=".{3,32}" title="Name Must Be Between 3:32 Chars" type="text" class="form-control text-dark" id="inputName" name="edit_list_name" value="<?=$row['name'] ?>" required>
							</div>
						</div>
						
						
			 <!--======= List Description ========-->  

						<div class="col-md-10 mx-auto mb-2" style="border-bottom: 1px solid #555;">
							<div class="form-group">
							  <label class="font-weight-bold" for="inputDesc">Description</label>
								<textarea class="form-control text-dark" id="inputDesc" name="edit_desc"><?=$row['description'] ?></textarea>
							</div>
						</div>
						
						
			 <!--======= Public List ========-->  

						<div class="col-md-10 mx-auto mb-2">
							<div class="form-group">
							  <label class="font-weight-bold" for="inputState">Public List</label>		 
							  <select id="inputState" class="form-control text-dark" name="edit_public">
								<option <? if($row['public'] == 'Yes'){echo 'selected';} ?>>Yes</option>
								<option <? if($row['public'] == 'No'){echo 'selected';} ?>>No</option>
							  </select>
							</div>
						</div>
				

					</div>
			  
			  <input type="hidden" name="user_id" value="<?=$user_id ?>">
			  <input type="hidden" name="list_id" value="<?=$list_uid ?>">
			  
			  <div class="modal-footer">
				<button type="submit" class="btn-filter">Save</button>
			  </div>
				
		    </form>

		<?
		
	}
	elseif ($kind == 'cover')
	{
		?>
			<div class="row justify-content-center">
				
		<?
	
		$stmt = $conn->prepare("SELECT * FROM movie_list WHERE list_id = ?  ");
		$stmt->execute(array($row['id']));
		$rows = $stmt->fetchAll();
	
		
		$count = $stmt->rowCount();

		// if count > 0 this mean the database contain record about this username

		if ($count > 0 )
		{
			
			foreach($rows as $row2)
			{  
	?>
					<div class="mx-2 photo-box select_cover change_list_cover" style="width: 355px" data-cover="<?=$row2['cover'] ?>" data-list="<?=$row['id'] ?>" >
						<? 
							if($row['cover'] == $row2['cover'])
							{
								echo '<i class="fas fa-check poster_more cover_selected text-warning"></i>';
							}
						?>
						<a class="post-box" style="background-image: url(https://image.tmdb.org/t/p/w355_and_h200_bestv2<?=$row2['cover'] ?>) " >
							<div class="highlight">
							</div>
						</a>
					</div>
	<? 		
			} 
			
		}
	else
	{
		echo "<p class='text-center'>There's No Images To Select .</p>";
	}
				
?>		
				
			</div>

		  <div class="modal-footer">
			<button type="button" class="btn-filter" data-dismiss="modal">Save</button>
		  </div>
		<?
		
	}
	elseif ($kind == 'share')
	{
		if ($row['public'] == 'Yes')
		{
		
		?>
			<div class="info-last sharelink text-center">
			
				<span class="floaty text-dark"><i class="fas fa-share-alt mr-2"></i> Shareable Link</span>

				<div class="mb-2">
					<button class="btn btn-dark copyButton px-1 py-0 ml-2"><i class="fas fa-copy"></i> Copy</button>
					<input class="linkToCopy" value="https://caramel-corn.com/viewlist.php?u=<?=$list_uid ?>" style="position: absolute; opacity: 0;top: 0; left: 0;" />

					<p class="mt-3 ml-4">https://caramel-corn.com/viewlist.php?u=<?=$list_uid ?></p>
				</div>

			</div>

		<?
			
		}
		else
		{
			echo "<p class='text-center'>Sorry, It's not a public list.</p>";
		}
	}

}


// ========================= LIST EDIT FROM (LIST PAGE)  =========================

if (isset($_POST['list_edit']))
{
	$user_id 	    = $_POST['user_id'];
	$list_uid 	    = $_POST['list_id'];
	
		
	$stmt = $conn->prepare("SELECT * FROM lists WHERE uid = ? AND user_id = ? ");
	$stmt->execute(array($list_uid, $user_id));
	$row = $stmt->fetch();
	
	
		?>


          <form class="edit_list_form2" >
			  
			 <!--======= List Name ========-->  

					<div class="form-row form-group"> 

						<div class="col-md-10 mx-auto mb-2" style="border-bottom: 1px solid #555;">
							<div class="form-group">
							  <label class="font-weight-bold" for="inputName">Name</label>
							  <input pattern=".{3,32}" title="Name Must Be Between 3:32 Chars" type="text" class="form-control text-dark" id="inputName" name="edit_list_name2" value="<?=$row['name'] ?>" required>
							</div>
						</div>
						
						
			 <!--======= List Description ========-->  

						<div class="col-md-10 mx-auto mb-2" style="border-bottom: 1px solid #555;">
							<div class="form-group">
							  <label class="font-weight-bold" for="inputDesc">Description</label>
								<textarea class="form-control text-dark" id="inputDesc" name="edit_desc"><?=$row['description'] ?></textarea>
							</div>
						</div>
						
						
			 <!--======= Public List ========-->  

						<div class="col-md-10 mx-auto mb-2">
							<div class="form-group">
							  <label class="font-weight-bold" for="inputState">Public List</label>		 
							  <select id="inputState" class="form-control text-dark" name="edit_public">
								<option <? if($row['public'] == 'Yes'){echo 'selected';} ?>>Yes</option>
								<option <? if($row['public'] == 'No'){echo 'selected';} ?>>No</option>
							  </select>
							</div>
						</div>
				

					</div>
			  
			  <input type="hidden" name="user_id" value="<?=$user_id ?>">
			  <input type="hidden" name="list_id" value="<?=$list_uid ?>">
			  
			  <div class="modal-footer">
				<button type="submit" class="btn-filter">Save</button>
			  </div>
				
		    </form>

		<?
		
}




// ========================= EDIT LIST DATA FROM (CORN PAGE)  =========================

if (isset($_POST['edit_list_name']))
{
    $name    	= filter_var($_POST['edit_list_name'], FILTER_SANITIZE_STRING);
    $desc    	= filter_var($_POST['edit_desc'], FILTER_SANITIZE_STRING);
	$public 	= $_POST['edit_public'];
	$user_id 	= $_POST['user_id'];
	$list_uid 	= $_POST['list_id'];
	
	
	$stmt = $conn->prepare("UPDATE lists SET name = ?, description = ?, public = ? WHERE uid = ? AND user_id = ?");
	$stmt->execute(array($name, $desc, $public, $list_uid, $user_id));
	
	
	$stmt = $conn->prepare("SELECT * FROM lists WHERE uid = ? AND user_id = ? ");
	$stmt->execute(array($list_uid, $user_id));
	$row = $stmt->fetch();
	
	$newdate = date('j M, Y', strtotime($row['Add_Date']));
?>
	<div class="text text-light">
		<h6><?= ucwords($row['name']) ?></h6>
		<span><?=$newdate ?></span>
		<br>
		<? if($row['public'] == 'Yes'){echo '<span class="badge badge-secondary mt-1">Public</span>';}else{echo '<span class="badge badge-primary mt-1">Private</span>'; } ?>
	</div>

<?
}



// ========================= EDIT LIST DATA FROM (LIST PAGE)  =========================

if (isset($_POST['edit_list_name2']))
{
    $name    	= filter_var($_POST['edit_list_name2'], FILTER_SANITIZE_STRING);
    $desc    	= filter_var($_POST['edit_desc'], FILTER_SANITIZE_STRING);
	$public 	= $_POST['edit_public'];
	$user_id 	= $_POST['user_id'];
	$list_uid 	= $_POST['list_id'];
	
	
	$stmt = $conn->prepare("UPDATE lists SET name = ?, description = ?, public = ? WHERE uid = ? AND user_id = ?");
	$stmt->execute(array($name, $desc, $public, $list_uid, $user_id));
	
	
	$stmt = $conn->prepare("SELECT * FROM lists WHERE uid = ? AND user_id = ? ");
	$stmt->execute(array($list_uid, $user_id));
	$row = $stmt->fetch();
	
	$newdate = date('j M, Y', strtotime($row['Add_Date']));
?>
	
	  <h3 class="font-weight-bold text-white"><?= ucwords($row['name'])  ?> </h3> 

	  <p class="font-weight-bold text-white"><? if($row['description'] == ''){echo 'No description entered.';}else{echo $row['description'];}  ?> </p> 

	  <? if($row['public'] == 'Yes'){echo '<span class="badge badge-secondary list-badge mb-3">Public</span>';}else{echo '<span class="badge badge-primary list-badge mb-3">Private</span>'; } ?>

<?
}



// ========================= LIST CHANGE COVER (LIST PAGE)  =========================

if (isset($_POST['list_cover']))
{
	$user_id 	    = $_POST['user_id'];
	$list_uid 	    = $_POST['list_id'];
	
		
	$stmt = $conn->prepare("SELECT * FROM lists WHERE uid = ? AND user_id = ? ");
	$stmt->execute(array($list_uid, $user_id));
	$row = $stmt->fetch();
	
	
		?>
			<div class="row justify-content-center">
				
		<?
	
		$stmt = $conn->prepare("SELECT * FROM movie_list WHERE list_id = ?  ");
		$stmt->execute(array($row['id']));
		$rows = $stmt->fetchAll();
	
		
		$count = $stmt->rowCount();

		// if count > 0 this mean the database contain record about this username

		if ($count > 0 )
		{
			
			foreach($rows as $row2)
			{  
	?>
					<div class="mx-2 photo-box select_cover change_list_cover2" style="width: 355px" data-cover="<?=$row2['cover'] ?>" data-list="<?=$row['id'] ?>" >
						<? 
							if($row['cover'] == $row2['cover'])
							{
								echo '<i class="fas fa-check poster_more cover_selected text-warning"></i>';
							}
						?>
						<a class="post-box" style="background-image: url(https://image.tmdb.org/t/p/w355_and_h200_bestv2<?=$row2['cover'] ?>) " >
							<div class="highlight">
							</div>
						</a>
					</div>
	<? 		
			} 
			
		}
	else
	{
		echo "<p class='text-center'>There's No Images To Select .</p>";
	}
				
?>		
				
			</div>

		  <div class="modal-footer">
			<button type="button" class="btn-filter" data-dismiss="modal">Save</button>
		  </div>
		<?
		

}




// ========================= GET LIST ITEMS AFTER ADD ITEM  =========================

if (isset($_POST['list_items']))
{
	$user_id 	    = $_POST['user_id'];
	$list_uid 	    = $_POST['list_items'];
	
	
	$stmt = $conn->prepare("SELECT * FROM lists WHERE uid = ? AND user_id = ? ");
	$stmt->execute(array($list_uid, $user_id));
	$row = $stmt->fetch();
	
	$list_id = $row['id'];
	
	$stmt = $conn->prepare("SELECT * FROM movie_list WHERE list_id = ? AND type = 'Movie' ORDER BY id DESC");
	$stmt->execute(array($list_id));
	$rows = $stmt->fetchAll();
	$result = $stmt->rowCount();
	
	$stmt3 = $conn->prepare("SELECT * FROM movie_list WHERE list_id = ? AND type = 'TV' ORDER BY id DESC");
	$stmt3->execute(array($list_id));
	$rows3 = $stmt3->fetchAll();
	$result2 = $stmt3->rowCount();
	
	
	?>

		<div>
			
	  		<div class="row">
				<div class="col-md-12 pb-3" style="border-bottom: 1px solid rgba(255, 255, 255, 0.5);">

					<div class="font-weight-bold toggle_type active" data-type="movie" data-target="#list_section_movie" data-user="<?=$user_id?>">
						<span > Movies </span>
						<span class="badge badge-toggle"><?= countItems3 ('type', 'movie_list', 'Movie', 'list_id', $list_id) ?></span>
					</div>

					<div class="font-weight-bold toggle_type" data-type="tv" data-target="#list_section_tv" data-user="<?=$user_id?>">
						<span >Tv Shows </span>
						<span class="badge badge-toggle"><?= countItems3 ('type', 'movie_list', 'TV', 'list_id', $list_id) ?></span>
					</div>

				</div>	
			</div>	
			
			

		<div>
			
	<!-- ==========  Movies  ==========  -->
			
			<div id="list_section_movie">

	<?
			if($result > 0) 
			{
	?>
		<div class="row my-2">
			<div class="col-md-12 pb-1">

				<i class="ti-layout-list-thumb show_grid2" data-show=".show_cards_details" data-target="#likes_movies"></i>

				<i class="ti-layout-grid2 show_grid2 active" data-show=".show_cards" data-target="#likes_movies" ></i>

			</div>	
		</div>


				<div class="row justify-content-center" id="likes_movies">

				<?

					foreach($rows as $row )
					{

						$movie_id = $row['tmdb_id'];

						$movie = api_connect("https://api.themoviedb.org/3/movie/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

						$date =  $movie->release_date;
						$newdate = date('j M, Y', strtotime($date));

						$rate = $movie->vote_average * 10 ;

						if ($movie->poster_path == '')
						{
							$img = 'layout/img/no_poster.jpeg';
						}
						else
						{
							$img = 'https://image.tmdb.org/t/p/w185_and_h278_bestv2' . $movie->poster_path ;
						}

				?>

				  <!-- Start New Card -->
					<div class="variable_card px-2 show_cards fade show">  


						<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
							<div class="poster"> 
								<i class="fas fa-times-circle poster_remove" data-id="<?=$row['id'] ?>" ></i>
								<a href="single.php?movie=<?= $movie->id?>">
									<img width="100%" src="<?= $img?>" alt=""/>
								</a>
							</div>

						</div>

						<div class="d-none">

							<div class="c-body" id="tooltip_content_<?= $movie->id?>">

							 <div class="wrapper">

								<div class="c-title">
									<a href="single.php?movie=<?= $movie->id?>" class="caramel_color"><?= $movie->title?> </a>  
									<div class="ratings">
									  <div class="empty-stars"></div>
									  <div class="full-stars" style="width:<?= $rate?>%"></div>
									</div>
									<span class="votes">(<?= number_format($movie->vote_count)?> Votes)</span>
								</div>

								<div class="rate">
									 <h5 class="text-white font-weight-bold"><?= $movie->vote_average?> </h5>
								</div>



							  </div>

							<p class="c-text mb-2"><?= substr($movie->overview,0,90) . '...'?></p>

							<div class="mb-0 field-label" >Relase Date : <span style="color: #fff;"><?= $newdate ?></span></div>


							<div class="cate mt-3" >

								<?

									foreach(array_slice($movie->genres, 0, 4) as $genre )
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


							<div class="details mt-3" >

								<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

								<a class="" href="single.php?movie=<?= $movie->id?>" ><i class="fa fa-info" ></i> Details</a>

							</div>


							</div>

						</div>

					</div>

				  <!-- End New Card -->




				  <!-- Start New Card -->
					<div class="col-sm-6 show_cards_details fade">  

						<div class="poster-card">
							<div class="poster"> <img src="<?= $img?>" alt=""/></div>
							<div class="c-body" style="border-left: 1px solid rgba(255, 255, 255, 0.15);">
							  <div class="wrapper">

								<div class="c-title">
									<a href="single.php?movie=<?= $movie->id?>" class="caramel_color"><? 
									if (strlen($movie->title) > 40){echo substr($movie->title,0,40) . '...';}else{echo $movie->title ;}  ?></a>  
									<div class="ratings">
									  <div class="empty-stars"></div>
									  <div class="full-stars" style="width:<?= $rate?>%"></div>
									</div>
									<span class="votes">(<?= number_format($movie->vote_count)?> Votes)</span>
								</div>

								<div class="rate">
									 <h5 class="text-white font-weight-bold"><?= $movie->vote_average?> </h5>
								</div>



							  </div>

							<p class="c-text mb-2"><?= substr($movie->overview,0,90) . '...'?></p>

							<div class="mb-0 field-label" >Relase Date : <span style="color: #fff;"><?= $newdate ?></span></div>


							<div class="cate mt-3" >

								<?

								foreach(array_slice($movie->genres, 0, 4) as $genre )
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


							<div class="details mt-3" style="position: absolute;bottom: 0;">

								<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

								<a class="" href="single.php?movie=<?= $movie->id?>" ><i class="fa fa-info" ></i> Details</a>

							</div>

							</div>
						</div>

					</div>

				  <!-- End New Card -->



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
			</div>
			
			
	<!-- ==========  TV Shows  ==========  -->
			
		
			<div id="list_section_tv">
					
<?
		if($result2 > 0) 
		{
?>
	 <div class="row my-2">
		<div class="col-md-12 pb-1">
			
			<i class="ti-layout-list-thumb show_grid2" data-show=".show_cards_details" data-target="#likes_tv"></i>
			
			<i class="ti-layout-grid2 show_grid2 active" data-show=".show_cards" data-target="#likes_tv" ></i>
			
		</div>	
	</div>

		
			<div class="row justify-content-center" id="likes_tv">

			<?

				foreach($rows3 as $row3 )
				{

					$movie_id = $row3['tmdb_id'];
					
					$movie = api_connect("https://api.themoviedb.org/3/tv/$movie_id?api_key=df264f8d059253c7e87471ab4809cbbf&language=en-US");

					$date =  $movie->first_air_date;
					$newdate = date('j M, Y', strtotime($date));

					$rate = $movie->vote_average * 10 ;
						
					if ($movie->poster_path == '')
					{
						$img = 'layout/img/no_poster.jpeg';
					}
					else
					{
						$img = 'https://image.tmdb.org/t/p/w185_and_h278_bestv2' . $movie->poster_path ;
					}

			?>

			  <!-- Start New Card -->
				<div class="variable_card px-2 show_cards fade show">  


					<div class="poster-card tooltip2" data-tooltip-content="#tooltip_content_<?= $movie->id?>">
						<div class="poster"> 
							<i class="fas fa-times-circle poster_remove" data-id="<?=$row3['id'] ?>" ></i>
							<a href="single.php?tv=<?= $movie->id?>">
								<img width="100%" src="<?= $img?>" alt=""/>
							</a>
						</div>

					</div>

					<div class="d-none">

						<div class="c-body" id="tooltip_content_<?= $movie->id?>">

						 <div class="wrapper">

							<div class="c-title">
								<a href="single.php?tv=<?= $movie->id?>" class="caramel_color"><?= $movie->name?> </a>  
								<div class="ratings">
								  <div class="empty-stars"></div>
								  <div class="full-stars" style="width:<?= $rate?>%"></div>
								</div>
								<span class="votes">(<?= number_format($movie->vote_count)?> Votes)</span>
							</div>

							<div class="rate">
								 <h5 class="text-white font-weight-bold"><?= $movie->vote_average?> </h5>
							</div>



						  </div>

						<p class="c-text mb-2"><?= substr($movie->overview,0,90) . '...'?></p>

						<div class="mb-0 field-label" >Relase Date : <span style="color: #fff;"><?= $newdate ?></span></div>


						<div class="cate mt-3" >

							<?

								foreach(array_slice($movie->genres, 0, 4) as $genre )
								{
									$genre_cate = '_'.$genre->id;
									?>

							<div class="mb-1 cate_color_<?= $genre->id;?>">
								<a href="t_browse.php?type=genre&genre=<?= $genre->id;?>"><?= $cate->$genre_cate;?></a>
							</div>

									<?
								}

							?>

						</div>


						<div class="details mt-3" >

							<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

							<a class="" href="single.php?tv=<?= $movie->id?>" ><i class="fa fa-info" ></i> Details</a>
							
						</div>


						</div>

					</div>

				</div>

			  <!-- End New Card -->
				
				
			

			  <!-- Start New Card -->
				<div class="col-sm-6 show_cards_details fade">  

					<div class="poster-card">
						<div class="poster"> <img src="<?= $img?>" alt=""/></div>
						<div class="c-body" style="border-left: 1px solid rgba(255, 255, 255, 0.15);">
						  <div class="wrapper">

							<div class="c-title">
								<a href="single.php?tv=<?= $movie->id?>" class="caramel_color"><? 
								if (strlen($movie->name) > 40){echo substr($movie->name,0,40) . '...';}else{echo $movie->name ;}  ?> </a>  
								<div class="ratings">
								  <div class="empty-stars"></div>
								  <div class="full-stars" style="width:<?= $rate?>%"></div>
								</div>
								<span class="votes">(<?= number_format($movie->vote_count)?> Votes)</span>
							</div>

							<div class="rate">
								 <h5 class="text-white font-weight-bold"><?= $movie->vote_average?> </h5>
							</div>



						  </div>

						<p class="c-text mb-2"><?= substr($movie->overview,0,90) . '...'?></p>

						<div class="mb-0 field-label" >Relase Date : <span style="color: #fff;"><?= $newdate ?></span></div>


						<div class="cate mt-3" >

							<?

							foreach(array_slice($movie->genres, 0, 4) as $genre )
								{
									$genre_cate = '_'.$genre->id;
									?>

							<div class="mb-1 cate_color_<?= $genre->id;?>">
								<a href="t_browse.php?type=genre&genre=<?= $genre->id;?>"><?= $cate->$genre_cate;?></a>
							</div>

									<?
								}

							?>

						</div>


						<div class="details mt-3" style="position: absolute;bottom: 0;">

							<span class="get_trailer" data-type="movie" data-id="<?= $movie->id?>" ><i class="fa fa-play"></i>Trailer</span>

							<a class="" href="single.php?tv=<?= $movie->id?>" ><i class="fa fa-info" ></i> Details</a>
							
						</div>

						</div>
					</div>

				</div>

			  <!-- End New Card -->



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
			
			</div>
	  
	  	</div>
	
	

		</div>
	  


		<script>
			
			
	    $('#list_section_tv').hide();

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
    <?
	
	
	
	
	
}

?>