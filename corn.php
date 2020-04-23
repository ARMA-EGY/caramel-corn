<?


//Include Configuration File
include('include/config.php');


if(!isset($_SESSION['access_token']))
{
	header('location:index.php');
}



include('include/header.php'); 

include('include/function.php'); 

include('include/genre.php'); 

$join_date = date(' F, Y', strtotime($date));

?>

<style>

	.toggle_type 
	{
		margin: 0 5px;
		background: #000;
		border-radius: 15px;
		border: 1px solid rgba(255, 255, 255, 0.7);
		box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.3);
		transition: all 0.3s linear;
		display: inline-block;
		color: #fff;
		padding: 5px 15px;
		cursor: pointer;
	}
	
	.toggle_type.active{color: #fbd747;}
	
	
	.badge-toggle 
	{
		color: #212529;
		background-color: #f8f9fa;
	}
	
	
	.toggle_type.active .badge-toggle
	{
		color: #212529;
		background-color: #ffc107;
	}
	
	.select-control
	{
		width: fit-content;
		box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.3);
		background: rgb(0, 0, 0);
   		color: #fff;
		height: calc(1.5em + .75rem + 2px);
		padding: .375rem .75rem;
		font-size: 0.8rem;
		font-weight: 400;
		line-height: 1.5;
		border: 1px solid #ced4da;
		border-radius: 15px;
		transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	}
	
	
	
</style>

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


				<div class="container px-0">
				
					<div class="row">

						<div class="col-md-12 pt-4 text-white">

							<img class="mr-2 mb-2" src="layout/img/popcorn/corn3.png" alt="" width="70"> 

							<h4 class="font-weight-bold" style="display: inline-block;color: #fbd747;font-family: Lobster, 'sans-serif';">My <span class="text-white" style="font-family: Lobster, 'sans-serif';">Corn</span> 
							</h4> 
							
							<button class="btn-filter btn-list float-right px-2 py-1 mt-4 mx-1"><i class="fa fa-cog"></i> </button>
							
							<button class="btn-filter btn-list float-right px-2 py-1 mt-4 mx-1"><i class="fa fa-plus"></i> Create List</button>

						</div>

					</div>
					
				</div>
				
				
				

			</div>
	  
	  
			<div class="container-fluid">
				
				<div class="row py-1" style="color: #fff;text-align: center;background: rgba(255, 255, 255, 0.25);">
					
					<ul class="nav col-12" id="myTab" role="tablist">
						
					  <li class="col">
						  <i class="fa fa-bookmark pointer col p-2 transition section" id="watchlist-tab" data-toggle="tab" href="#watchlist" role="tab" aria-controls="watchlist" aria-selected="true" data-section="watchlist" data-user="<?=$user_id ?>" data-color="#e46932" style="border-right: 1px solid #fff; color: rgb(228, 105, 50);"></i>
					  </li>
						
					  <li class="col">
						  <i class="fa fa-heart pointer col p-2 transition section" id="likes-tab" data-toggle="tab" href="#likes" role="tab" aria-controls="likes" aria-selected="true" data-section="likes" data-user="<?=$user_id ?>" data-color="#ff3447" style="border-right: 1px solid #fff;"></i>
					  </li>
						
					  <li class="col">
						  <i class="fa fa-star pointer col p-2 transition section" id="favorites-tab" data-toggle="tab" href="#favorites" role="tab" aria-controls="favorites" aria-selected="true" data-section="favorites" data-user="<?=$user_id ?>" data-color="#ffc107" style="border-right: 1px solid #fff;"></i>
					  </li>
						
					  <li class="col">
						  <i class="fa fa-list pointer col p-2 transition section" id="lists-tab" data-toggle="tab" href="#lists" role="tab" aria-controls="lists" aria-selected="true" data-section="lists" data-user="<?=$user_id ?>" data-color="#caa552" style="border-right: 1px solid #fff;"></i>
					  </li>
						
					  <li class="col">
						  <i class="fa fa-users pointer col p-2 transition section" id="following-tab" data-toggle="tab" href="#following" role="tab" aria-controls="following" aria-selected="true" data-section="following" data-user="<?=$user_id ?>" data-color="#9c9887"></i>
					  </li>
						
					</ul>
					
<!--
					<i class="fa fa-bookmark col p-2 pointer transition section" id="watchlist-tab" data-toggle="tab" href="#watchlist" role="tab" aria-controls="watchlist" aria-selected="true" data-section="watchlist" data-user="<?=$user_id ?>" data-color="#e46932" style="border-right: 1px solid #fff;"></i>
					
					
					<i class="fa fa-heart col p-2 pointer transition section" id="likes-tab" data-toggle="tab" href="#likes" role="tab" aria-controls="likes" aria-selected="true" data-section="likes" data-user="<?=$user_id ?>" data-color="#ff3447" style="border-right: 1px solid #fff;"></i>
					
					<i class="fa fa-star col p-2 pointer transition section" id="favorites-tab" data-toggle="tab" href="#favorites" role="tab" aria-controls="favorites" aria-selected="true" data-section="favorites" data-user="<?=$user_id ?>" data-color="#ffc107" style="border-right: 1px solid #fff;"></i>
					
					<i class="fa fa-list col p-2 pointer transition section" id="lists-tab" data-toggle="tab" href="#lists" role="tab" aria-controls="lists" aria-selected="true" data-section="lists" data-user="<?=$user_id ?>" data-color="#caa552" style="border-right: 1px solid #fff;"></i>
					
					<i class="fa fa-users col p-2 pointer transition section" id="following-tab" data-toggle="tab" href="#following" role="tab" aria-controls="following" aria-selected="true" data-section="following" data-user="<?=$user_id ?>" data-color="#9c9887"></i>
-->
					
				</div>

			</div>
	  

	<div class="container py-4" id="show_section" style="min-height: 500px;">		
				
		<div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade show active" id="watchlist" role="tabpanel" aria-labelledby="watchlist-tab"> watchlist </div>
		  <div class="tab-pane fade" id="likes" role="tabpanel" aria-labelledby="likes-tab"> likes </div>
		  <div class="tab-pane fade" id="favorites" role="tabpanel" aria-labelledby="favorites-tab"> favorites </div>
		  <div class="tab-pane fade" id="lists" role="tabpanel" aria-labelledby="lists-tab"> lists </div>
		  <div class="tab-pane fade" id="following" role="tabpanel" aria-labelledby="following-tab"> following </div>
		</div>

	</div>
	  
	  
	  
  </div>
</section>









	

<? include('include/footer.php'); ?>

<script>

	
		
	    $('#watchlist, #likes, #favorites, #lists, #following').html('<img class="d-flex m-auto" src="layout/img/loader.gif" width="75">');
	
		var user_id = $('#user_id').val()
		
		$.ajax({
					url: 		'include/sections/watchlist.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{ 
								 user_id 	 : user_id
								}	,
					success : function(response)
							 {
								$("#watchlist").html(response);
							 }
				});
		
		$.ajax({
					url: 		'include/sections/likes.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{ 
								 user_id 	 : user_id
								}	,
					success : function(response)
							 {
								$("#likes").html(response);
							 }
				});
		
		$.ajax({
					url: 		'include/sections/favorites.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{ 
								 user_id 	 : user_id
								}	,
					success : function(response)
							 {
								$("#favorites").html(response);
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
	


</script>

