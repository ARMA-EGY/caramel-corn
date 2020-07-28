<?


//Include Configuration File
include('include/config.php');


if(!isset($_SESSION['access_token']))
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

if(isset($_GET['sec']))
{
	$sec = $_GET['sec'];
	
	if ($sec == 'likes')
	{
		$watchlist_color = '#fff';
		$likes_color 	 = '#ff3447';
		
		$watchlist_sec 	 = '';
		$likes_sec 	   	 = 'show active';
	}
	elseif ($sec == 'favorites')
	{
		$watchlist_color = '#fff';
		$favorites_color = '#ffc107';
		
		$watchlist_sec   = '';
		$favorites_sec 	 = 'show active';
	}
	elseif ($sec == 'lists')
	{
		$watchlist_color = '#fff';
		$lists_color 	 = '#caa552';
		
		$watchlist_sec   = '';
		$lists_sec 	 	 = 'show active';
	}
	elseif ($sec == 'following')
	{
		$watchlist_color = '#fff';
		$following_color = '#9c9887';
		
		$watchlist_sec   = '';
		$following_sec 	 = 'show active';
	}
	
}

include('include/header.php'); 

include('include/function.php'); 

include('include/genre.php'); 

$join_date = date(' F, Y', strtotime($date));


$stmt = $conn->prepare("SELECT * FROM members WHERE id = ? ");
$stmt->execute(array($user_id));
$user = $stmt->fetch();

$private = $user['private'];
$uid     = $user['uid'];
$logo    = $user['corn_logo'];

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
						<span>   <?= countItems2 ('user_id', 'lists', $user_id) ?> </span>
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


				<div class="container pb-3">
<!--
				
					<div class="row">

						<div class="col-md-12 pt-4 text-white">

							<div class="d-inline-block corn_logo">
								<img class="mr-2 mb-2" src="layout/img/popcorn/<?=$logo ?>" alt="" width="70"> 
							</div>
							
							<h4 class="font-weight-bold caramel_color" style="display: inline-block;font-family: Lobster, 'sans-serif';">My <span class="text-white" style="font-family: Lobster, 'sans-serif';">Corn</span> 
							</h4> 
							
							<button class="btn-filter btn-list float-right px-2 py-1 mt-4 mx-1" data-toggle="modal" data-target="#setting_modal"><i class="fa fa-cog"></i> </button>
							
							<a href="list.php" class="btn-filter btn-list text-white text-white2 float-right px-2 py-1 mt-4 mx-1"><i class="fa fa-plus"></i> Create List</a>

						</div>

					</div>
-->
					
				</div>
				
				
				

			</div>
	  
	  
			<div class="container-fluid">
				
				<div class="row py-1 sections_bar">
					
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
			
			<div class="row">
				<div class="col-md-12 pb-3 b-border">

					<div class="font-weight-bold toggle_type active" data-kind="watchlist" data-type="movie" data-target="#watchlist_section_movie" data-user="<?=$user_id?>">
						<i class="fa fa-film"></i>
						<span > Movies </span>
						<span class="badge badge-toggle"><?= countItems3 ('type', 'watchlist', 'Movie', 'user_id', $user_id) ?></span>
					</div>

					<div class="font-weight-bold toggle_type" data-kind="watchlist" data-type="tv" data-target="#watchlist_section_tv" data-user="<?=$user_id?>">
						<i class="fa fa-tv"></i>
						<span >Tv Shows </span>
						<span class="badge badge-toggle"><?= countItems3 ('type', 'watchlist', 'TV', 'user_id', $user_id) ?></span>
					</div>

				</div>	
			</div>
			
			<div>
			  
				<div id="watchlist_section_movie"></div>

				<div id="watchlist_section_tv"></div>
				
			</div>
			  
		</div>
			
			<!--===================  Likes   ===================-->
		 
		  <div class="tab-pane fade <?=$likes_sec?>" id="likes" role="tabpanel" aria-labelledby="likes-tab">

			<div class="row">
				<div class="col-md-12 pb-3 b-border">

					<div class="font-weight-bold toggle_type active" data-kind="likes" data-type="movie" data-target="#likes_section_movie" data-user="<?=$user_id?>">
						<i class="fa fa-film"></i>
						<span > Movies </span>
						<span class="badge badge-toggle"><?= countItems3 ('type', 'likes', 'Movie', 'user_id', $user_id) ?></span>
					</div>

					<div class="font-weight-bold toggle_type" data-kind="likes" data-type="tv" data-target="#likes_section_tv" data-user="<?=$user_id?>">
						<i class="fa fa-tv"></i>
						<span >Tv Shows </span>
						<span class="badge badge-toggle"><?= countItems3 ('type', 'likes', 'TV', 'user_id', $user_id) ?></span>
					</div>

				</div>	
			</div>	
			
			<div>
			  
				<div id="likes_section_movie"></div>

				<div id="likes_section_tv"></div>
				
			</div>
			
		</div>
			
			<!--===================  Favorites   ===================-->
			
		  <div class="tab-pane fade <?=$favorites_sec?>" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">
			
			<div class="row">
				<div class="col-md-12 pb-3 b-border">

					<div class="font-weight-bold toggle_type active" data-kind="favorites" data-type="movie" data-target="#favorites_section_movie" data-user="<?=$user_id?>">
						<i class="fa fa-film"></i>
						<span > Movies </span>
						<span class="badge badge-toggle"><?= countItems3 ('type', 'favorites', 'Movie', 'user_id', $user_id) ?></span>
					</div>

					<div class="font-weight-bold toggle_type" data-kind="favorites" data-type="tv" data-target="#favorites_section_tv" data-user="<?=$user_id?>">
						<i class="fa fa-tv"></i>
						<span >Tv Shows </span>
						<span class="badge badge-toggle"><?= countItems3 ('type', 'favorites', 'TV', 'user_id', $user_id) ?></span>
					</div>

				</div>	
			</div>	
			
			<div>
			  
				<div id="favorites_section_movie"></div>

				<div id="favorites_section_tv"></div>
				
			</div>
			  
			  
			
		  </div>
			
			<!--===================  Lists   ===================-->
			
		   <div class="tab-pane fade <?=$lists_sec?>" id="lists" role="tabpanel" aria-labelledby="lists-tab">  </div>
			
			<!--===================  Following   ===================-->
			
		   <div class="tab-pane fade <?=$following_sec?>" id="following" role="tabpanel" aria-labelledby="following-tab">  </div>
			
		</div>

	</div>
	  
	  
	  
  </div>
</section>







<? include('include/footer.php'); ?>



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
					url: 		'include/sections/lists.php',
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

	
