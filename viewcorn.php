<?

ob_start();

//Include Configuration File
include('include/config.php');

include('include/header.php'); 

include('include/function.php'); 

include('include/genre.php'); 



if(isset($_GET['u']))
{
	
	$uid = $_GET['u'];
	
	$stmt = $conn->prepare("SELECT * FROM members WHERE uid = ? ");
	$stmt->execute(array($uid));
	$user = $stmt->fetch();
	$count = $stmt->rowCount();

	if ($count > 0 )
	{
	
		if(isset($_SESSION['access_token']))
		{

			if ($user['id'] == $user_id)
			{
				header('location:corn.php');
			}
			else
			{
				$private 	= $user['private'];
				$logo    	= $user['corn_logo'];
				$date    	= $user['Add_Date'];
				$user_id    = $user['id'];
				$name    	= $user['name'];
				$image      = $user['image'];
				$join_date = date(' F, Y', strtotime($date));
			}
		}
		else
		{
			$private 	= $user['private'];
			$logo    	= $user['corn_logo'];
			$date    	= $user['Add_Date'];
			$user_id    = $user['id'];
			$name    	= $user['name'];
			$image      = $user['image'];
			$join_date = date(' F, Y', strtotime($date));

		}
	}
	else
	{
		header('location:index.php');
	}
}
else
{
	header('location:index.php');
}


	$watchlist_color = '#e46932';
	$likes_color 	 = '#fff';
	$favorites_color = '#fff';
	$lists_color 	 = '#fff';
	$following_color = '#fff';
	
	$watchlist_sec   = 'show active';
	$likes_sec 	     = '';
	$favorites_sec   = '';
	$lists_sec 	     = '';
	$following_sec   = '';

?>


<input type="hidden" id="user_id" value="<?=$user_id?>">
	
<section id="act" class="section-spacing single">
  <div class="back_layer">
	  
	<!-- =====================  About User  =====================  -->
	  

			<div class="container-fluid p-3 layer_background">
				
				<div class="row">

					<div class="col-md-12 pt-4 text-white text-center">
						
						<img class="m-2" width="50" src="<?=$image ?>"  alt="" style="border-radius: 50%;box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.5);display: inline-block;"/> 

						<h4 class="font-weight-bold text-white mb-1"><?= $name ?> </h4> 
						
						<span class="member_date"> Member since <?=$join_date ?></span>
						
				    </div>
					
				</div>
				
					
			<div class="row justify-content-center mt-4">

			   <div class="col-lg-2 col-md-3 col-4 p-0">
				  <div class="count-card" >
					<h5 class="text-center text-white"><strong> Watchlist </strong></h5>
					  <div class="counter">
						<div class="icon">
						  <i class="fa fa-bookmark fs-15-t watchlist-color"></i>
						</div>
						<span>  <?= countItems2 ('user_id', 'watchlist', $user_id) ?>  </span>
					  </div>
				  </div>
				</div>

			   <div class="col-lg-2 col-md-3 col-4 p-0">
				  <div class="count-card" >
					<h5 class="text-center text-white"><strong> Likes </strong></h5>
					  <div class="counter">
						<div class="icon">
						  <i class="fa fa-heart fs-15-t like-color"></i>
						</div>
						<span>  <?= countItems2 ('user_id', 'likes', $user_id) ?>  </span>
					  </div>
				  </div>
				</div>

			   <div class="col-lg-2 col-md-3 col-4 p-0">
				  <div class="count-card" >
					<h5 class="text-center text-white"><strong> Favorites </strong></h5>
					  <div class="counter">
						<div class="icon">
						  <i class="fa fa-star fs-15-t text-warning"></i>
						</div>
						<span> <?= countItems2 ('user_id', 'favorites', $user_id) ?> </span>
					  </div>
				  </div>
				</div>

			   <div class="col-lg-2 col-md-3 col-4 p-0">
				  <div class="count-card" >
					<h5 class="text-center text-white"><strong> Lists </strong></h5>
					  <div class="counter">
						<div class="icon">
						  <i class="fa fa-list fs-15-t list-color"></i>
						</div>
						<span>   <?= countItems3 ('user_id', 'lists', $user_id, 'public', 'Yes') ?> </span>
					  </div>
				  </div>
				</div>

			   <div class="col-lg-2 col-md-3 col-4 p-0">
				  <div class="count-card" >
					<h5 class="text-center text-white"><strong> Following </strong></h5>
					  <div class="counter">
						<div class="icon">
						  <i class="fa fa-users fs-15-t follow-color"></i>
						</div>
						<span>   <?= countItems2 ('user_id', 'following', $user_id) ?> </span>
					  </div>
				  </div>
				</div>



			</div>


				<div class="container px-0">
				
					<div class="row">

						<div class="col-md-12 pt-4 text-white">

							<div class="d-inline-block corn_logo">
								<img class="mr-2 mb-2" src="layout/img/popcorn/<?=$logo ?>" alt="" width="70"> 
							</div>
							
							<h4 class="font-weight-bold" style="display: inline-block;color: #fbd747;font-family: Lobster, 'sans-serif';">My <span class="text-white" style="font-family: Lobster, 'sans-serif';">Corn</span> 
							</h4> 
							

						</div>

					</div>
					
				</div>
				
				
				

			</div>
	  
	  
			<div class="container-fluid">
				
				<div class="row py-1" style="color: #fff;text-align: center;background: rgba(255, 255, 255, 0.25);">
					
					<ul class="nav col-12" id="myTab" role="tablist">
						
					  <li class="col" style="border-right: 1px solid #fff;">
						  <i class="fa fa-bookmark pointer col p-2 transition section" id="watchlist-tab" data-toggle="tab" href="#watchlist" role="tab" aria-controls="watchlist" aria-selected="true" data-section="watchlist" data-user="<?=$user_id ?>" data-color="#e46932" style="color: <?=$watchlist_color?>;"></i>
					  </li>
						
					  <li class="col" style="border-right: 1px solid #fff;">
						  <i class="fa fa-heart pointer col p-2 transition section" id="likes-tab" data-toggle="tab" href="#likes" role="tab" aria-controls="likes" aria-selected="true" data-section="likes" data-user="<?=$user_id ?>" data-color="#ff3447" style="color: <?=$likes_color?>;"></i>
					  </li>
						
					  <li class="col" style="border-right: 1px solid #fff;">
						  <i class="fa fa-star pointer col p-2 transition section" id="favorites-tab" data-toggle="tab" href="#favorites" role="tab" aria-controls="favorites" aria-selected="true" data-section="favorites" data-user="<?=$user_id ?>" data-color="#ffc107" style="color: <?=$favorites_color?>;"></i>
					  </li>
						
					  <li class="col" style="border-right: 1px solid #fff;">
						  <i class="fa fa-list pointer col p-2 transition section" id="lists-tab" data-toggle="tab" href="#lists" role="tab" aria-controls="lists" aria-selected="true" data-section="lists" data-user="<?=$user_id ?>" data-color="#caa552" style="color: <?=$lists_color?>;"></i>
					  </li>
						
					  <li class="col">
						  <i class="fa fa-users pointer col p-2 transition section" id="following-tab" data-toggle="tab" href="#following" role="tab" aria-controls="following" aria-selected="true" data-section="following" data-user="<?=$user_id ?>" data-color="#9c9887" style="color: <?=$following_color?>;"></i>
					  </li>
						
					</ul>
					
					
				</div>

			</div>
	  

	<div class="container py-4" id="show_section" style="min-height: 500px;">		
				
		<div class="tab-content" id="myTabContent">
			
			<!--===================  Watchlist   ===================-->
			
		  <div class="tab-pane fade <?=$watchlist_sec?>" id="watchlist" role="tabpanel" aria-labelledby="watchlist-tab">  
			  
		<?
			if($private == 1)
			{
				echo '<h3 class="text-center text-white">This Account Is Private.</h3>';
			}
	   		else
			{
		?>
			
			<div class="row">
				<div class="col-md-12 pb-3" style="border-bottom: 1px solid rgba(255, 255, 255, 0.5);">

					<div class="font-weight-bold toggle_type active" data-kind="watchlist" data-type="movie" data-target="#watchlist_section_movie" data-user="<?=$user_id?>">
						<span > Movies </span>
						<span class="badge badge-toggle"><?= countItems3 ('type', 'watchlist', 'Movie', 'user_id', $user_id) ?></span>
					</div>

					<div class="font-weight-bold toggle_type" data-kind="watchlist" data-type="tv" data-target="#watchlist_section_tv" data-user="<?=$user_id?>">
						<span >Tv Shows </span>
						<span class="badge badge-toggle"><?= countItems3 ('type', 'watchlist', 'TV', 'user_id', $user_id) ?></span>
					</div>

				</div>	
			</div>
			
			<div>
			  
				<div id="watchlist_section_movie"></div>

				<div id="watchlist_section_tv"></div>
				
			</div>
			  
		<? } ?>
			  
		</div>
			
			<!--===================  Likes   ===================-->
		 
		  <div class="tab-pane fade <?=$likes_sec?>" id="likes" role="tabpanel" aria-labelledby="likes-tab">
	  
		<?
			if($private == 1)
			{
				echo '<h3 class="text-center text-white">This Account Is Private.</h3>';
			}
	   		else
			{
		?>
			<div class="row">
				<div class="col-md-12 pb-3" style="border-bottom: 1px solid rgba(255, 255, 255, 0.5);">

					<div class="font-weight-bold toggle_type active" data-kind="likes" data-type="movie" data-target="#likes_section_movie" data-user="<?=$user_id?>">
						<span > Movies </span>
						<span class="badge badge-toggle"><?= countItems3 ('type', 'likes', 'Movie', 'user_id', $user_id) ?></span>
					</div>

					<div class="font-weight-bold toggle_type" data-kind="likes" data-type="tv" data-target="#likes_section_tv" data-user="<?=$user_id?>">
						<span >Tv Shows </span>
						<span class="badge badge-toggle"><?= countItems3 ('type', 'likes', 'TV', 'user_id', $user_id) ?></span>
					</div>

				</div>	
			</div>	
			
			<div>
			  
				<div id="likes_section_movie"></div>

				<div id="likes_section_tv"></div>
				
			</div>
			  
		<? } ?>
			
		</div>
			
			<!--===================  Favorites   ===================-->
			
		  <div class="tab-pane fade <?=$favorites_sec?>" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">
				  
		<?
			if($private == 1)
			{
				echo '<h3 class="text-center text-white">This Account Is Private.</h3>';
			}
	   		else
			{
		?>
			<div class="row">
				<div class="col-md-12 pb-3" style="border-bottom: 1px solid rgba(255, 255, 255, 0.5);">

					<div class="font-weight-bold toggle_type active" data-kind="favorites" data-type="movie" data-target="#favorites_section_movie" data-user="<?=$user_id?>">
						<span > Movies </span>
						<span class="badge badge-toggle"><?= countItems3 ('type', 'favorites', 'Movie', 'user_id', $user_id) ?></span>
					</div>

					<div class="font-weight-bold toggle_type" data-kind="favorites" data-type="tv" data-target="#favorites_section_tv" data-user="<?=$user_id?>">
						<span >Tv Shows </span>
						<span class="badge badge-toggle"><?= countItems3 ('type', 'favorites', 'TV', 'user_id', $user_id) ?></span>
					</div>

				</div>	
			</div>	
			
			<div>
			  
				<div id="favorites_section_movie"></div>

				<div id="favorites_section_tv"></div>
				
			</div>
			  
		<? } ?>
			  
		  </div>
			
			<!--===================  Lists   ===================-->
			
		   <div class="tab-pane fade <?=$lists_sec?>" id="lists" role="tabpanel" aria-labelledby="lists-tab"> 
				  
		<?
			if($private == 1)
			{
				echo '<h3 class="text-center text-white">This Account Is Private.</h3>';
			}
		?>
			
			</div>
			
			<!--===================  Following   ===================-->
			
		   <div class="tab-pane fade <?=$following_sec?>" id="following" role="tabpanel" aria-labelledby="following-tab"> 
			   		  
		<?
			if($private == 1)
			{
				echo '<h3 class="text-center text-white">This Account Is Private.</h3>';
			}
		?>
			
			</div>
			
		</div>

	</div>
	  
	  
	  
  </div>
</section>









<? include('include/footer.php'); ?>

<?

if($private != 1)
{

?>

<script>
	
	    $('#watchlist_section_movie, #watchlist_section_tv, #likes_section_movie, #likes_section_tv, #favorites_section_movie, #favorites_section_tv, #lists, #following').html('<img class="d-flex m-auto" src="layout/img/loader.gif" width="75">');
		
	    $('#watchlist_section_tv, #likes_section_tv, #favorites_section_tv').hide();
	
		var user_id = $('#user_id').val()
		
		$.ajax({
					url: 		'include/sections/watchlist.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{ 
								 user_id 	 : user_id,
								 type 		 : 'movie'
								}	,
					success : function(response)
							 {
								$("#watchlist_section_movie").html(response);
							 }
				});
		
		$.ajax({
					url: 		'include/sections/watchlist.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{ 
								 user_id 	 : user_id,
								 type 		 : 'tv'
								}	,
					success : function(response)
							 {
								$("#watchlist_section_tv").html(response);
							 }
				});
		
		$.ajax({
					url: 		'include/sections/likes.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{ 
								 user_id 	 : user_id,
								 type 		 : 'movie'
								}	,
					success : function(response)
							 {
								$("#likes_section_movie").html(response);
							 }
				});
		
		$.ajax({
					url: 		'include/sections/likes.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{ 
								 user_id 	 : user_id,
								 type 		 : 'tv'
								}	,
					success : function(response)
							 {
								$("#likes_section_tv").html(response);
							 }
				});
		
		$.ajax({
					url: 		'include/sections/favorites.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{ 
								 user_id 	 : user_id,
								 type 		 : 'movie'
								}	,
					success : function(response)
							 {
								$("#favorites_section_movie").html(response);
							 }
				});
		
		$.ajax({
					url: 		'include/sections/favorites.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{ 
								 user_id 	 : user_id,
								 type 		 : 'tv'
								}	,
					success : function(response)
							 {
								$("#favorites_section_tv").html(response);
							 }
				});
		
		$.ajax({
					url: 		'include/sections/viewlists.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{ 
								 user_id 	 : user_id
								}	,
					success : function(response)
							 {
								$("#lists").html(response);
							 }
				});
		
		$.ajax({
					url: 		'include/sections/following.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{ 
								 user_id 	 : user_id
								}	,
					success : function(response)
							 {
								$("#following").html(response);
							 }
				});
		
	
	var start = 20;
	var limit = 20;
	var reachedMax = false;


	$(document).on('click', '.loadmore', function()
	   {
		  var section 	  = $(this).attr('data-section');
		  var type 	  	  = $(this).attr('data-type');
		  var target  	  = $(this).attr('data-target');
		  var sort  	  = $(this).attr('data-sort');
		  var btn     	  = $(this).attr('data-btn');
		  var user_id     = $(this).attr('data-user');
		//  $(this).prop('disabled', true);
		  getData(section,type,target,sort,btn,user_id);

	   });

	
	function getData(section,type,target,sort,btn,user_id) 
	{
    if (reachedMax)
        return;
	
	//$('.loader').html('<img src="layout/img/loader.gif" width="75">');
	
	$(btn).hide();
	$(btn).parent().append('<img class="img_loader" src="layout/img/loader.gif" width="75">');

    $.ajax({
       url: 'ajax.php',
       method: 'POST',
        dataType: 'text',
       data: 
       {
           getData: 1,
           start: start,
           limit: limit,
           sort: sort,
           section: section,
           user_id: user_id,
           type: type
       },
       success: function(response) 
       {
            if (response.trim() == '')
            {
                reachedMax = true;
                $(btn).fadeOut();
            }
            else 
            {
                start += limit;
                $(target).append(response);
				
		  		$(btn).fadeIn();
            }

		   $(btn).parent().find('.img_loader').remove();
        }
    });
}
	
</script>

<?
	
}

ob_end_flush(); 

?>
