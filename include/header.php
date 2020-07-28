<?php

$mode = 0;

$login_google_button = '';

$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
	 //It will Attempt to exchange a code for an valid authentication token.
	 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

	 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
	 if(!isset($token['error']))
	 {
		  //Set the access token used for requests
		  $google_client->setAccessToken($token['access_token']);

		  //Store "access_token" value in $_SESSION variable for future use.
		  $_SESSION['access_token'] = $token['access_token'];

		  //Create Object of Google Service OAuth 2 class
		  $google_service = new Google_Service_Oauth2($google_client);

		  //Get user profile data from google
		  $data = $google_service->userinfo->get();

		  //Below you can find Get profile data and store into $_SESSION variable
		  if(!empty($data['given_name']))
		  {
			$_SESSION['user_name'] = $data['given_name'] .' '. $data['family_name'] ;
		  }

		  if(!empty($data['family_name']))
		  {
			$_SESSION['user_last_name'] = $data['family_name'];
		  }

		  if(!empty($data['email']))
		  {
		   	$_SESSION['user_email_address'] = $data['email'];
		  }

		  if(!empty($data['gender']))
		  {
		   	$_SESSION['user_gender'] = $data['gender'];
		  }

		  if(!empty($data['picture']))
		  {
		   	$_SESSION['user_image'] = $data['picture'];
		  }
		 
		   	$_SESSION['login_type'] = 'Google';
		 
		  header('location:corn.php');
	 }
	else
	{
		if(isset($_SESSION['access_token']))
		 {
			  $access_token = $_SESSION['access_token'];
		 }
		 else
		 {
			  $access_token = $facebook_helper->getAccessToken();
			  $_SESSION['access_token'] = $access_token;
			  $facebook->setDefaultAccessToken($_SESSION['access_token']);
		 }


			  $graph_response = $facebook->get("/me?fields=name,email", $access_token);

			  $facebook_user_info = $graph_response->getGraphUser();

		 if(!empty($facebook_user_info['id']))
		 {
			 $_SESSION['user_image'] = 'https://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
		 }

		 if(!empty($facebook_user_info['name']))
		 {
			 $_SESSION['user_name'] = $facebook_user_info['name'];
		 }

		 if(!empty($facebook_user_info['email']))
		 {
			 $_SESSION['user_email_address'] = $facebook_user_info['email'];
		 }
		
		   	 $_SESSION['login_type'] = 'Facebook';
		
		    header('location:corn.php');
	}
	
	
	
	
}
else
{
 //https://caramel-corn.com/
 //http://localhost:8080/corn/caramel-corn/
 // Get login url
    $facebook_permissions = ['email']; // Optional permissions

    $facebook_login_url = $facebook_helper->getLoginUrl('https://caramel-corn.com/', $facebook_permissions);
    
    // Render Facebook login button
    $facebook_login_url = '<a class="btn btn-facebook m-1" href="'.$facebook_login_url.'"><i class="fab fa-facebook-square mr-1"></i> Login With Facebook</a>';
	
	$login_google_button = '<a class="btn btn-google m-1" href="'.$google_client->createAuthUrl().'"><i class="fab fa-google mr-1"></i> Sign In With Google</a>';
}

if(isset($_SESSION['access_token']))
{
	
	$name 			= $_SESSION['user_name'];
	$image 			= $_SESSION['user_image'];
	$email 			= $_SESSION['user_email_address'];
	$login_type 	= $_SESSION['login_type'];
	
	
	$stmt = $conn->prepare("SELECT * FROM members WHERE email = ?");
	$stmt->execute(array($email));
	$row = $stmt->fetch();

	$count = $stmt->rowCount();

	// if count > 0 this mean the database contain record about this username
	
	if ($count > 0 )
	{
		$user_id  = $row['id'];
		$date     = $row['Add_Date'];
		$logo     = $row['corn_logo'];
		$mode     = $row['dark_mode'];
		
		if ($name != $row['name'])
		{
			$stmt = $conn->prepare("UPDATE members SET name = ?, image = ? WHERE email = ?");
    		$stmt->execute(array($name, $image, $email));
		}
	}
	else
	{
		$logo     = 'corn3.png';
	
		$uid = uniqid();
		
		$stmt = "INSERT INTO members ( name, email, image, login_type, Add_Date, uid, corn_logo)
						VALUES('$name', '$email', '$image', '$login_type', now(), '$uid', '$logo' )";

		$conn->exec($stmt);
		
		$user_id = $conn->lastInsertId();
	}


}

?>

<!doctype html>
<html>
<head>
	
<script data-ad-client="ca-pub-2074461395127410" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="Movies,TV Shows,Actors,best movies,trending movies,top movies,top rated movies,popular movies,upcoming movies,  ">
	<meta name="Description" content="Caramel Corn is a website for movies and TV shows, with the easiest way to mark your favorites and list what you love." />
	<meta name="robots" content="noindex,nofollow">
<!--	<meta http-equiv="refresh" content="240">-->
   
   <meta content='' name='current_path' />
   <meta content='false' name='protect_images' />
   <meta content="This photo is Copyright © 2020 Caramel Corn. All rights reserved." name='image_protection_blurb' />
   
   <meta property="og:site_name" content="Caramel Corn"/>
   
    <meta property="og:url"           content="https://caramel-corn.com/" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Caramel Corn" />
	<meta property="og:description"   content="Caramel Corn is a website for movies and TV shows, with the easiest way to mark your favorites and list what you love." />
	<meta property="og:image"         content="layout/img/corn.png" />
	
	<meta property="og:image:width" content="512" />
    <meta property="og:image:height" content="512" />
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="layout/img/logo.png"/>
<!--===============================================================================================-->	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="layout/css/tooltipster.main.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="layout/css/tooltipster-sideTip-borderless.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
<!--===============================================================================================-->	
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<!--	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="layout/css/style.css">
<!--===============================================================================================-->	
	<?
		if($mode == 0)
		{
	?>
		<link rel="stylesheet" type="text/css" href="layout/css/light-theme.css">
	<?
		}
		else
		{
	?>
		<link rel="stylesheet" type="text/css" href="layout/css/dark-theme.css">
	<?
		}
	?>
	
	
<!--===============================================================================================-->	
<title>Caramel Corn</title>
</head>

<body>
	
	
	<nav class="navbar navbar-expand-lg navbar-light customNav">

		<a id="askFaran" class="navbar-brand" href="index.php"><img src="layout/img/logo.png" width="32" alt=""/> Caramel <span style="color: #fff;font-family: Lobster, 'sans-serif';">Corn</span></a>
		
		<div class="mob-nav" >
			
			<a class="nav-link mx-1 btn-secondary rounded text-center searchtool" data-tooltip-content="#searchDropdown" href="#" style="width: 40px;height: 40px;border-radius: 25px!important;padding: 8px;">
				<i class="fa fa-search"></i>
			</a>
			
<?
   if(isset($_SESSION['user_name']))
   {
?>
			<a class="nav-link mx-1 btn-secondary rounded text-center" href="#" style="width: 40px;height: 40px;border-radius: 25px!important;padding: 8px;">
				<i class="fa fa-bell"></i>
			</a>
<?
   }
	else
	{
?>			
			<a class="nav-link mx-1 btn-secondary rounded text-center dark_mode_guest" href="#" style="width: 40px;height: 40px;border-radius: 25px!important;padding: 8px;">
				<i class="fa fa-moon"></i>
	   		</a>
			
			<a class="nav-link mx-1 btn-secondary rounded text-center" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"style="width: 40px;height: 40px;border-radius: 25px!important;padding: 8px;">
				<i class="fas fa-sign-in-alt"></i>
			</a>
			  
			<ul class="dropdown-menu text-center" aria-labelledby="navbarDropdown2" style="right: 0; left: unset;">
			  <li><?=$facebook_login_url?></li>
			  <li><?=$login_google_button?></li>
			</ul>
			
<?  }  ?>

	     </div>
		
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
	  
    <ul class="nav navbar-nav mx-auto mt-2 mt-lg-0">
		
	<li class="nav-item use_tooltips rounded nav-hover" data-toggle="tooltip" data-placement="top" title="Home">
        <a class="nav-link px-4" href="index.php"><i class="fa fa-home fa-2x"></i></a>
    </li>
		
	<li class="nav-item use_tooltips rounded nav-hover" data-toggle="tooltip" data-placement="top" title="Movies">
	    <div class="btn-group">
        <a class="nav-link px-4" ><i class="fa fa-film fa-2x"></i></a>
		
			<div class="dropdown-menu" aria-labelledby="test">

				<a class="dropdown-item" href="movies.php?type=Newest">Newest</a>
				<a class="dropdown-item" href="movies.php?type=Trending">Trending</a>
				<a class="dropdown-item" href="movies.php?type=In Theatres">In Theatres</a>
				<a class="dropdown-item" href="movies.php?type=Popular">Popular</a>
				<a class="dropdown-item" href="movies.php?type=Top Rated">Top Rated</a>
				<a class="dropdown-item" href="movies.php?type=Top Revenue">Top Revenue</a>
				<a class="dropdown-item" href="movies.php?type=Upcoming">Upcoming</a>
				<a class="dropdown-item" href="m_browse.php">Browse All</a>

			</div>
		</div>
    </li>
		
	<li class="nav-item use_tooltips rounded nav-hover" data-toggle="tooltip" data-placement="top" title="Tv Shows">
	    <div class="btn-group">
			<a class="nav-link px-4" ><i class="fas fa-tv fa-2x"></i></a>

			<div class="dropdown-menu" aria-labelledby="test">

				<a class="dropdown-item" href="tv.php?type=On Air">On Air</a>
				<a class="dropdown-item" href="tv.php?type=Airing Today">Airing Today</a>
				<a class="dropdown-item" href="tv.php?type=Trending">Trending</a>
				<a class="dropdown-item" href="tv.php?type=Popular">Popular</a>
				<a class="dropdown-item" href="tv.php?type=Top Rated">Top Rated</a>
				<a class="dropdown-item" href="t_browse.php">Browse All</a>

			</div>
		</div>
    </li>
		
		
       <li class="nav-item use_tooltips rounded nav-hover" data-toggle="tooltip" data-placement="top" title="People">
        <a class="nav-link px-4" href="actors.php"><i class="fa fa-users fa-2x"></i></a>
      </li>
		
<?
   if(isset($_SESSION['user_name']))
   {
?>
       <li class="nav-item use_tooltips rounded nav-hover" data-toggle="tooltip" data-placement="top" title="Friends">
        <a class="nav-link px-4" href="#"><i class="fa fa-user-friends fa-2x"></i></a>
      </li>
	
<? } ?>
		
    </ul>
	  

	  <ul class="nav navbar-nav navbar-right pb-2">
		  
		 <li class="nav-item mr-0 use_tooltips" data-toggle="tooltip" data-placement="top" title="Search">
			<a class="nav-link btn-secondary rounded text-center searchtool" data-tooltip-content="#searchDropdown" href="#" style="width: 40px;height: 40px;border-radius: 25px!important;" >
				<i class="fa fa-search"></i>
	   		</a>
			 
	

	<div class="d-none create_search">		
			 
		<div class="" id="searchDropdown" style="right: 0; left: unset;">
		<div style="width: 330px;" class="mb-2">
				 
			<div class="top-search mb-2">

				<div style="width: 100%; position: relative;">
					<input class="search_bar" type="text" placeholder="Search for a Movie, TV Show or Actor" style="height: 46px;">
			<!--	<div id="search_result"></div>-->
				</div>

				<i class="fa fa-search" style="position: absolute;color: #ccc;right: 10px;"></i>

			</div>
			
			 <nav class="search_nav mb-2">
				  <div class="nav nav-tabs" id="nav-tab" role="tablist">
					<a class="nav-item nav-link text-white active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fa fa-film"></i> Movies</a>
					<a class="nav-item nav-link text-white" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-tv"></i> Tv Shows</a>
					<a class="nav-item nav-link text-white" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fa fa-users"></i> People</a>
				  </div>
			</nav>
			
			<div class="tab-content" id="search_results">
			  <div class="tab-pane fade show active search-pane" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				  <p class="text-center text-white">No Result Found.</p>
			  </div>
			  <div class="tab-pane fade search-pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"> 
				  <p class="text-center text-white">No Result Found.</p>
			  </div>
			  <div class="tab-pane fade search-pane" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"> 
				  <p class="text-center text-white">No Result Found.</p>
			  </div>
			</div>
			
		</div>
	</div>
		
	</div>
		
		</li> 
<?
   if(isset($_SESSION['user_name']))
   {
?>
		  <li class="nav-item mr-0 use_tooltips" data-toggle="tooltip" data-placement="top" title="Notifications">
			<a class="nav-link btn-secondary rounded  text-center" href="#" style="width: 40px;height: 40px;border-radius: 25px!important;">
				<i class="fa fa-bell"></i>
	   		</a>
		  </li>
		  
		  <li class="nav-item dropdown use_tooltips" data-toggle="tooltip" data-placement="top" title="Account">
			<a class="nav-link btn-secondary rounded caramel_color text-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 40px; height: 40px;">
				<i class="fa fa-caret-down"></i>
	   		</a>
			  
			<ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="right: 0; left: unset;">
				
				<li>
					<a class="dropdown-item" href="corn.php">
						<div class="d-inline-block">
							<img class="avatar" src="<?=$_SESSION["user_image"]?>" style="align-items: center;display: flex;">
						</div>
						<div class="d-inline-block">
							<span><?=$_SESSION['user_name']?></span>
							<span class="d-block text-muted">See your corn</span>
						</div>
        			</a>
					<hr class="hr_light m-2" >
				</li>
				
				<li>
					<a class="dropdown-item" href="rate.php">
						<div class="d-inline-block">
							<i class="fa fa-exclamation-circle fa-2x mr-3"></i>
						</div>
						<div class="d-inline-block">
							<span>Give Feedback</span>
							<small class="d-block text-muted">Help us improve the website</small>
						</div>
        			</a>
					<hr class="hr_light m-2" >
				</li>
				
				<li>
					<a class="dropdown-item py-2" href="list.php">
						<div class="d-inline-block pl-2">
							<i class="fa fa-plus-circle mr-4"></i>
						</div>
						<div class="d-inline-block">
							<span>Create List</span>
						</div>
        			</a>
				</li>
				
				<li>
					<a class="dropdown-item py-2">
						<label class="col-12 p-0 mb-0 pointer dark_mode" data-user="<?=$user_id?>" data-mode="<?=$mode?>" for="dark_mode">
							<div class="d-inline-block pl-2">
								<i class="fa fa-moon mr-4"></i>
							</div>
							<div class="d-inline-block">
								<span>Dark Mode</span>
							</div>
							<div class="d-inline-block float-right">
								<div class="custom-control custom-switch">
								  <input type="checkbox" class="custom-control-input dark_mode_check" id="dark_mode" data-user="<?=$user_id?>" <? if($mode == 1){echo 'checked';} ?>>
								  <label class="custom-control-label ml-5 mb-2 pointer dark_mode" data-user="<?=$user_id?>" data-mode="<?=$mode?>" for="dark_mode" > </label>
								</div>
							</div>
						</label>
        			</a>
				</li>
				
				<li>
					<a class="dropdown-item py-2" data-toggle="modal" data-target="#setting_modal">
						<div class="d-inline-block pl-2">
							<i class="fa fa-cog mr-4"></i>
						</div>
						<div class="d-inline-block">
							<span>Setting & Privacy</span>
						</div>
        			</a>
				</li>
				
				<li>
					<a class="dropdown-item py-2" href="logout.php">
						<div class="d-inline-block pl-2">
							<i class="fas fa-sign-out-alt mr-4"></i>
						</div>
						<div class="d-inline-block">
							<span>Log Out</span>
						</div>
        			</a>
				</li>
				
			</ul>
			  
		  </li>
		  
<? }
	else
	{ ?>
		   
		 <li class="nav-item mr-0 use_tooltips" data-toggle="tooltip" data-placement="top" title="Dark Mode">
			<a class="nav-link btn-secondary rounded text-center dark_mode_guest" href="#" style="width: 40px;height: 40px;border-radius: 25px!important;">
				<i class="fa fa-moon"></i>
	   		</a>
		 </li> 
		  
		  <li class="nav-item dropdown">
			<a class="nav-link btn-secondary rounded " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-sign-in-alt"></i> Sign In</a>
			  
			<ul class="dropdown-menu text-center" aria-labelledby="navbarDropdown" style="right: 0; left: unset;">
			  <li><?=$facebook_login_url?></li>
			  <li><?=$login_google_button?></li>
			</ul>
			  
		  </li>
		  
		  <div id="login_form" class="d-none">
			  
				<?
					echo $facebook_login_url . $login_google_button ;
				?>
			  
		  </div>
		  
	 <? } ?>
	  
	</ul>
	  
	
	  
  </div>
		
  <div class="row mx-auto mt-1 col-12 mob-nav">
		
	<div class="col px-1 m-auto use_tooltips rounded nav-hover text-center" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Home">
        <a class="p-2 text-white text-white2" href="index.php"><i class="fa fa-home"></i></a>
    </div>
		
	<div class="col px-1 m-auto use_tooltips rounded nav-hover text-center" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Movies">
	    <div class="btn-group">
        <a class="text-white text-white2 p-2"><i class="fa fa-film"></i></a>
		
			<div class="dropdown-menu mob-dropdown" aria-labelledby="test">

				<a class="dropdown-item" href="movies.php?type=Newest">Newest</a>
				<a class="dropdown-item" href="movies.php?type=Trending">Trending</a>
				<a class="dropdown-item" href="movies.php?type=In Theatres">In Theatres</a>
				<a class="dropdown-item" href="movies.php?type=Popular">Popular</a>
				<a class="dropdown-item" href="movies.php?type=Top Rated">Top Rated</a>
				<a class="dropdown-item" href="movies.php?type=Top Revenue">Top Revenue</a>
				<a class="dropdown-item" href="movies.php?type=Upcoming">Upcoming</a>
				<a class="dropdown-item" href="m_browse.php">Browse All</a>

			</div>
		</div>
    </div>
		
	<div class="col px-1 m-auto use_tooltips rounded nav-hover text-center" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tv Shows">
	    <div class="btn-group">
			<a class="text-white text-white2 p-2"><i class="fas fa-tv"></i></a>

			<div class="dropdown-menu mob-dropdown" aria-labelledby="test">

				<a class="dropdown-item" href="tv.php?type=On Air">On Air</a>
				<a class="dropdown-item" href="tv.php?type=Airing Today">Airing Today</a>
				<a class="dropdown-item" href="tv.php?type=Trending">Trending</a>
				<a class="dropdown-item" href="tv.php?type=Popular">Popular</a>
				<a class="dropdown-item" href="tv.php?type=Top Rated">Top Rated</a>
				<a class="dropdown-item" href="t_browse.php">Browse All</a>

			</div>
		</div>
    </div>
		
    <div class="col px-1 m-auto use_tooltips rounded nav-hover text-center" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="People">
	<a class="text-white text-white2 p-2" href="actors.php"><i class="fa fa-users"></i></a>
    </div>
		
	 		
<?
   if(isset($_SESSION['user_name']))
   {
?> 
	  
    <div class="col px-1 m-auto use_tooltips rounded nav-hover text-center" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Friends">
	<a class="text-white text-white2 p-2" href="#"><i class="fa fa-user-friends"></i></a>
    </div>
		
    <div class="col px-1 m-auto rounded text-center">
		<a class="text-white text-white2 p-2" id="mobile-nav-toggle">
			<i class="fa fa-bars"></i>
		</a>
    </div>
	  
<?  }  ?>
	
  </div>
		
</nav>
	
<?
   if(isset($_SESSION['user_name']))
   {
?>
	
	<nav id="mobile-nav">
		<ul class="" style="touch-action: pan-y;" id="">
			
		 		<li>
					<a class="dropdown-item" href="corn.php">
						<div class="d-inline-block">
							<img class="avatar" src="<?=$_SESSION["user_image"]?>" style="align-items: center;display: flex;">
						</div>
						<div class="d-inline-block">
							<span><?=$_SESSION['user_name']?></span>
							<span class="d-block text-muted">See your corn</span>
						</div>
        			</a>
					<hr class="hr_light m-2" >
				</li>
				
				<li>
					<a class="dropdown-item" href="rate.php">
						<div class="d-inline-block">
							<i class="fa fa-exclamation-circle fa-2x mr-3"></i>
						</div>
						<div class="d-inline-block">
							<span>Give Feedback</span>
							<small class="d-block text-muted">Help us improve the website</small>
						</div>
        			</a>
					<hr class="hr_light m-2" >
				</li>
				
				<li>
					<a class="dropdown-item py-2" href="list.php">
						<div class="d-inline-block pl-2">
							<i class="fa fa-plus-circle mr-4"></i>
						</div>
						<div class="d-inline-block">
							<span>Create List</span>
						</div>
        			</a>
				</li>
				
				<li>
					<a class="dropdown-item py-2">
						<label class="col-12 p-0 mb-0 pointer dark_mode2" data-user="<?=$user_id?>" data-mode="<?=$mode?>" for="dark_mode2">
							<div class="d-inline-block pl-2">
								<i class="fa fa-moon mr-4"></i>
							</div>
							<div class="d-inline-block">
								<span>Dark Mode</span>
							</div>
							<div class="d-inline-block float-right">
								<div class="custom-control custom-switch">
								  <input type="checkbox" class="custom-control-input dark_mode_check" id="dark_mode2" data-user="<?=$user_id?>" <? if($mode == 1){echo 'checked';} ?>>
								  <label class="custom-control-label ml-5 mb-2 pointer dark_mode2" data-user="<?=$user_id?>" data-mode="<?=$mode?>" for="dark_mode2" > </label>
								</div>
							</div>
						</label>
        			</a>
				</li>
				
				<li>
					<a class="dropdown-item py-2" data-toggle="modal" data-target="#setting_modal">
						<div class="d-inline-block pl-2">
							<i class="fa fa-cog mr-4"></i>
						</div>
						<div class="d-inline-block">
							<span>Setting & Privacy</span>
						</div>
        			</a>
				</li>
				
				<li>
					<a class="dropdown-item py-2" href="logout.php">
						<div class="d-inline-block pl-2">
							<i class="fas fa-sign-out-alt mr-4"></i>
						</div>
						<div class="d-inline-block">
							<span>Log Out</span>
						</div>
        			</a>
				</li>

		</ul>
	</nav>
	
	<div id="mobile-body-overly"></div>
	
<?
   }
?>
	
	
	
	