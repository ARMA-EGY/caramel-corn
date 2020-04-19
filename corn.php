<?


//Include Configuration File
include('include/config.php');


if(isset($_SESSION['user_name']))
{
	
}
else
{
	header('location:index.php');
}



include('include/header.php'); 

include('include/function.php'); 

include('include/genre.php'); 

$join_date = date(' F, Y', strtotime($date));

?>

<style>

</style>

	
<section id="act" class="section-spacing single">
  <div class="back_layer">
	  
	<!-- =====================  About User  =====================  -->
	  

			<div class="container-fluid p-3 layer_background">
				
				<div class="row">

					<div class="col-md-12 pt-4 text-white text-center">
						
						<img class="m-2" src="<?=$image ?>"  alt="" style="border-radius: 50%;box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.5);display: inline-block;"/> 

						  <h4 class="font-weight-bold text-white" style="display: inline-block;"><?= $name ?> 
							  <span  class="member_date"> Member since <?=$join_date ?></span>
						  </h4> 

				    </div>
					
					
				</div>
				
					
				<div class="row justify-content-center mt-4">

			   <div class="col-lg-2 col-md-3 col-6">
				  <div class="count-card pointer" >
					<h5 class="text-center text-white"><strong> Favorites </strong></h5>
					  <div class="counter">
						<div class="icon">
						  <i class="fa fa-star fs-15-t text-warning"></i>
						</div>
						<span> <?= countItems2 ('user_id', 'favorites', $user_id) ?> </span>
					  </div>
				  </div>
				</div>

			   <div class="col-lg-2 col-md-3 col-6">
				  <div class="count-card pointer" >
					<h5 class="text-center text-white"><strong> Likes </strong></h5>
					  <div class="counter">
						<div class="icon">
						  <i class="fa fa-heart fs-15-t like-color"></i>
						</div>
						<span>  <?= countItems2 ('user_id', 'likes', $user_id) ?>  </span>
					  </div>
				  </div>
				</div>

			   <div class="col-lg-2 col-md-3 col-6">
				  <div class="count-card pointer" >
					<h5 class="text-center text-white"><strong> Watchlist </strong></h5>
					  <div class="counter">
						<div class="icon">
						  <i class="fa fa-bookmark fs-15-t watchlist-color"></i>
						</div>
						<span>  <?= countItems2 ('user_id', 'watchlist', $user_id) ?>  </span>
					  </div>
				  </div>
				</div>

			   <div class="col-lg-2 col-md-3 col-6">
				  <div class="count-card pointer" >
					<h5 class="text-center text-white"><strong> Lists </strong></h5>
					  <div class="counter">
						<div class="icon">
						  <i class="fa fa-list fs-15-t list-color"></i>
						</div>
						<span> 9 </span>
					  </div>
				  </div>
				</div>

			   <div class="col-lg-2 col-md-3 col-6">
				  <div class="count-card pointer" >
					<h5 class="text-center text-white"><strong> Following </strong></h5>
					  <div class="counter">
						<div class="icon">
						  <i class="fa fa-users fs-15-t follow-color"></i>
						</div>
						<span> 34 </span>
					  </div>
				  </div>
				</div>



			</div>


				<div class="container">
				
					<div class="row">

						<div class="col-md-12 pt-4 text-white">

							<img class="mr-2 mb-2" src="layout/img/popcorn/corn3.png" alt="" style="width: 90px;"> 

							<h3 class="font-weight-bold" style="display: inline-block;color: #fbd747;font-family: Lobster, 'sans-serif';">My <span class="text-white" style="font-family: Lobster, 'sans-serif';">Corn</span> 

							</h3> 
							
							<button class="btn-filter btn-list float-right px-2 py-1 mt-4"><i class="fa fa-plus"></i> Create List</button>

						</div>

					</div>
					
				</div>
				
				
				

			</div>
	  
	  
			<div class="container-fluid">
				
				<div class="row py-1" style="color: #fff;text-align: center;background: rgba(255, 255, 255, 0.25);">
					
					<i class="fa fa-star col p-2 pointer transition section" data-color="#ffc107" style="border-right: 1px solid #fff;"></i>
					
					<i class="fa fa-heart col p-2 pointer transition section" data-color="#ff3447" style="border-right: 1px solid #fff;"></i>
					
					<i class="fa fa-bookmark col p-2 pointer transition section" data-color="#e46932" style="border-right: 1px solid #fff;"></i>
					
					<i class="fa fa-list col p-2 pointer transition section" data-color="#caa552" style="border-right: 1px solid #fff;"></i>
					
					<i class="fa fa-users col p-2 pointer transition section" data-color="#9c9887"></i>
					
				</div>

			</div>
	  

			<div class="container py-4" style="min-height: 500px;">
	  
	  
	  
	  		</div>
	  
	  
	  
  </div>
</section>









	

<?
 include('include/footer.php'); ?>

