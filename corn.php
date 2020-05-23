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


$stmt = $conn->prepare("SELECT * FROM members WHERE id = ? ");
$stmt->execute(array($user_id));
$user = $stmt->fetch();

$private = $user['private'];
$uid     = $user['uid'];
$logo    = $user['corn_logo'];

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
	
	.select-wrapper
	{
		border-radius: 30px;
		display: inline-block;
		overflow: hidden;
		background: #000;
		border: 1px solid #ccc;
		float: right;
		box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.3);
		margin: 2px;
	}
	
	.select-control
	{
		width: fit-content;
		background: rgb(0, 0, 0);
   		color: #fff;
		height: calc(1.5em + .75rem + 2px);
		font-size: 0.8rem;
		font-weight: 400;
		line-height: 1.5;
		transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		border: 0px;
		outline: none;
		padding: 0;
		margin: 0!important;
	}
	

	.floaty {
		float: left;
		width: 250px;
		color: #fff;}

	.info p, .info-last p {margin-left: 50px;}

	.info {
		border-bottom: 1px solid #bbb;
		padding-top: 15px;}

	.info-last {
		padding-top: 15px;
		padding-bottom: 1px;}
/*
	.info:hover, .info-last:hover{background-color: rgba(239, 239, 239, 0.5)}
*/
	
	.logo-hov:hover {background: #555; border-radius: 5px;}
	
	.logo_select {background: #bbb; border-radius: 5px; padding: 5px;}
	
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

							<div class="d-inline-block corn_logo">
								<img class="mr-2 mb-2" src="layout/img/popcorn/<?=$logo ?>" alt="" width="70"> 
							</div>
							
							<h4 class="font-weight-bold" style="display: inline-block;color: #fbd747;font-family: Lobster, 'sans-serif';">My <span class="text-white" style="font-family: Lobster, 'sans-serif';">Corn</span> 
							</h4> 
							
							<button class="btn-filter btn-list float-right px-2 py-1 mt-4 mx-1" data-toggle="modal" data-target="#setting_modal"><i class="fa fa-cog"></i> </button>
							
							<a href="list.php" class="btn-filter btn-list text-white float-right px-2 py-1 mt-4 mx-1"><i class="fa fa-plus"></i> Create List</a>

						</div>

					</div>
					
				</div>
				
				
				

			</div>
	  
	  
			<div class="container-fluid">
				
				<div class="row py-1" style="color: #fff;text-align: center;background: rgba(255, 255, 255, 0.25);">
					
					<ul class="nav col-12" id="myTab" role="tablist">
						
					  <li class="col" style="border-right: 1px solid #fff;">
						  <i class="fa fa-bookmark pointer col p-2 transition section" id="watchlist-tab" data-toggle="tab" href="#watchlist" role="tab" aria-controls="watchlist" aria-selected="true" data-section="watchlist" data-user="<?=$user_id ?>" data-color="#e46932" style="color: rgb(228, 105, 50);"></i>
					  </li>
						
					  <li class="col" style="border-right: 1px solid #fff;">
						  <i class="fa fa-heart pointer col p-2 transition section" id="likes-tab" data-toggle="tab" href="#likes" role="tab" aria-controls="likes" aria-selected="true" data-section="likes" data-user="<?=$user_id ?>" data-color="#ff3447"></i>
					  </li>
						
					  <li class="col" style="border-right: 1px solid #fff;">
						  <i class="fa fa-star pointer col p-2 transition section" id="favorites-tab" data-toggle="tab" href="#favorites" role="tab" aria-controls="favorites" aria-selected="true" data-section="favorites" data-user="<?=$user_id ?>" data-color="#ffc107"></i>
					  </li>
						
					  <li class="col" style="border-right: 1px solid #fff;">
						  <i class="fa fa-list pointer col p-2 transition section" id="lists-tab" data-toggle="tab" href="#lists" role="tab" aria-controls="lists" aria-selected="true" data-section="lists" data-user="<?=$user_id ?>" data-color="#caa552"></i>
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
			
			<!--===================  Watchlist   ===================-->
			
		  <div class="tab-pane fade show active" id="watchlist" role="tabpanel" aria-labelledby="watchlist-tab">  
			
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
			  
		</div>
			
			<!--===================  Likes   ===================-->
			
		 
		<div class="tab-pane fade" id="likes" role="tabpanel" aria-labelledby="likes-tab">

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
			
		</div>
			
			<!--===================  Favorites   ===================-->
			
		  <div class="tab-pane fade" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">
			
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
			  
			  
			
		  </div>
			
			<!--===================  Lists   ===================-->
			
		  <div class="tab-pane fade" id="lists" role="tabpanel" aria-labelledby="lists-tab">  </div>
			
			<!--===================  Following   ===================-->
			
		  <div class="tab-pane fade" id="following" role="tabpanel" aria-labelledby="following-tab">  </div>
			
		</div>

	</div>
	  
	  
	  
  </div>
</section>






<!-- Setting Modal -->
<div class="modal fade" id="setting_modal" tabindex="-1" role="dialog" aria-labelledby="setting_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background: rgba(0, 0, 0, 0.7);color: #fff;border: 1px solid rgba(255, 255, 255, 0.5);">
      <div class="modal-header">
        <h5 class="modal-title" id="setting_label">Setting</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		    
        <div class="info">
			
			<span class="floaty"><i class="far fa-file-image mr-2"></i> Logo</span>
			
			<div class="mb-2">
				<button class="btn btn-light get_logo px-1 py-0 ml-2" data-user="<?=$user_id ?>"><i class="fas fa-edit"></i> Change</button>
			</div>
			
			<div id="corn_logos" class="text-center"></div>
			
		</div>
		
		  
        <div class="info-last">
			
			<span class="floaty"><i class="fas fa-user-shield mr-2"></i> Private Account</span>
			
			<div class="custom-control custom-switch">
			  <input type="checkbox" class="custom-control-input" id="private" data-user="<?=$user_id ?>" <? if($private == 1){echo 'checked';} ?>>
			  <label class="custom-control-label ml-5 mb-2" for="private"> Private</label>
			</div>
			
		</div>
		  
		  
		<div class="info-last sharelink <? if($private == 1){echo 'd-none2';} ?>" style="border-top: 1px solid #bbb;">
			
			<span class="floaty"><i class="fas fa-share-alt mr-2"></i> Shareable Link</span>
			
			<div class="mb-2">
				<button class="btn btn-light copyButton px-1 py-0 ml-2"><i class="fas fa-copy"></i> Copy</button>
				<input class="linkToCopy" value="https://caramel-corn.com/viewcorn.php?u=<?=$uid ?>" style="position: absolute; opacity: 0;top: 0; width: 0;" />

				<p class="mt-3 ml-4">https://caramel-corn.com/viewcorn.php?u=<?=$uid ?></p>
			</div>
			
		</div>
		  
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-filter" data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>



<!-- List Modal -->
<div class="modal fade" id="list_modal" tabindex="-1" role="dialog" aria-labelledby="setting_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" >
		
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		
      <div class="modal-body" id="get_list_modal">
		    
	  </div>
		
    </div>
  </div>
</div>

	

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
	

	
	
	///////////////////////////////////////////////
	
	var start = 20;
	var limit = 20;
	var reachedMax = false;


	$(document).on('click', '.loadmore', function()
	   {
		  var section 	  = $(this).attr('data-section');
		  var type 	  	  = $(this).attr('data-type');
		  var target  	  = $(this).attr('data-target');
		  var btn     	  = $(this).attr('data-btn');
		  var user_id     = $(this).attr('data-user');
		//  $(this).prop('disabled', true);
		  getData(section,type,target,btn,user_id);

	   });

	
	function getData(section,type,target,btn,user_id) 
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

	
 $('#private').click(function()
  {
	 		
		var user_id = $(this).attr('data-user');
	 
	 	 if($('#private').is(':checked'))
			 {
				 $('.sharelink').slideUp();
				 
				 $.ajax({
					url: 		'ajax.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{private : 1, 
								 user_id 	 : user_id
								}	,
					success : function(response)
							 {
							 }
				});
			 }
	 	 else
			{
				 $('.sharelink').slideDown(); 
				
				 $.ajax({
					url: 		'ajax.php',
					method: 	'POST',
					dataType: 	'text',
					data:		{private : 0, 
								 user_id 	 : user_id
								}	,
					success : function(response)
							 {
							 }
				});
			}
       

  });
	
	
	
 $('.get_logo').click(function()
      {
	 
			$('#corn_logos').slideDown();
			var user_id = $(this).attr('data-user');
	 	
			$.ajax({
				url: 		'ajax.php',
				method: 	'POST',
				dataType: 	'text',
				data:		{get_logo : 1, 
							 user_id 	 : user_id
							}	,
				success : function(response)
						 {
							 $('#corn_logos').html(response);
						 }
			});

      });
	
		
	
 $(document).on('click', '.select_corn', function()
      {
	 
			var user_id = $(this).attr('data-user');
			var logo 	= $(this).attr('data-logo');
	 	
			$.ajax({
				url: 		'ajax.php',
				method: 	'POST',
				dataType: 	'text',
				data:		{change_logo : logo, 
							 user_id 	 : user_id
							}	,
				success : function(response)
						 {
							 $('#corn_logos').slideUp();
							 $('.corn_logo').html(response);
						 }
			});

      });

	
	
 $(document).on('click', '.get_list_modal', function()
      {
	 
			var list    = $(this).attr('data-list');
			var kind 	= $(this).attr('data-kind');
			var user 	= $(this).attr('data-user');
	 
	 		$('.photo-box').removeClass('active');
	 		$(this).parents('.photo-box').addClass('active');
	 
	 		if (kind == 'remove')
				{
					  Swal.fire({
					  title: 'Are you sure?',
					  text: "You won't be able to revert this!",
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#d33',
					  cancelButtonColor: '#3085d6',
					  confirmButtonText: 'Yes, Remove it!'
					}).then((result) => {
					  if (result.value) {
						  
		 				    $(this).parents('.photo-box').remove();
						  
						    $.ajax({
									url: 		'ajax_list.php',
									method: 	'POST',
									dataType: 	'text',
									data:		{list_kind : kind, 
												 user_id 	 : user, 
												 list_id 	 : list
												}	,
									success : function(response)
											 {

											 }
								});
						  
							Swal.fire(
							  'Deleted!',
							  'Your List has been removed.',
							  'success'
							)
					  }
					})
				}
	 		else
			{
				$('#list_modal').modal('show');
	    		$('#get_list_modal').html('<img class="d-flex m-auto" src="layout/img/loader.gif" width="75">');
				
				 $.ajax({
							url: 		'ajax_list.php',
							method: 	'POST',
							dataType: 	'text',
							data:		{list_kind : kind, 
										 user_id 	 : user, 
										 list_id 	 : list
										}	,
							success : function(response)
									 {
		 				    			$('#get_list_modal').html(response);
									 }
						});
			}
	 
	 	

      });
	
	

 $(document).on('submit', '.edit_list_form', function(e){

	e.preventDefault();
	$('#list_modal').modal('hide');

	$.ajax({
		url: 		'ajax_list.php',
		method: 	'POST',
		dataType: 	'text',
		data:		$(this).serialize()	,
		success : function(response)
			 {
				$(".photo-box.active").find('.highlight').html(response);
			 }
	});

});
	
	

 $(document).on('click', '.change_list_cover', function()
      {
			var cover 		= $(this).attr('data-cover');
			var background  = 'url(https://image.tmdb.org/t/p/w355_and_h200_bestv2' + cover + ')';
	 	
    		$(".photo-box.active").find('.post-box').css({"background": background});

      });

	
</script>

	
