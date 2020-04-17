<?

include('ini.php'); 



?>

<style>

.count-card {
    margin: 10px;
    padding: 15px;
    box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.3);
    border: 1px solid #dadce0;
    border-radius: 20px;
    transition: all 0.3s linear;
}
	
.counter {
    text-align: center;
    margin-top: 10px;
}
	
.counter span {
    font-size: 18pt;
    font-weight: bold;
	color: #fff;
}
	
.icon {
    float: left;
    padding: 15px;
    color: #fff;
}	
	
	
.fs-15-t{font-size: 15pt;}
	
.like-color{color: #ff3447;}
	
.watchlist-color{color: #e46932;}
	
.list-color{color: #caa552;}

</style>

	
<section id="act" class="section-spacing single">
  <div class="back_layer">
	  
	<!-- =====================  About User  =====================  -->
	  
	  

			<div class="container-fluid p-3 layer_background">
				
				<div class="row">

					<div class="col-md-12 pt-4 text-white text-center">
						
						<img class="m-2" src="http://graph.facebook.com/3946930631991425/picture"  alt="" style="border-radius: 50%;box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.5);display: inline-block;"/> 

						  <h4 class="font-weight-bold text-white" style="display: inline-block;">Mohamed Khaled 
							  <span  class="movie_year"> Member since March 2020</span>
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
						<span> 4 </span>
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
						<span> 10 </span>
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
						<span> 17 </span>
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
						  <i class="fa fa-users fs-15-t "></i>
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
							
							<button class="btn btn-warning float-right mt-4"><i class="fa fa-plus"></i> Create List</button>

						</div>

					</div>
					
				</div>
				

			</div>
			
	  
	  
	  
	  
  </div>
</section>









	

<?
 include('include/footer.php'); ?>

