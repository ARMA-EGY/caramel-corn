<?php


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
<title>Caramel Corn</title>
</head>

<body>
	
	
	<nav class="navbar navbar-expand-md navbar-light customNav">

		<a id="askFaran" class="navbar-brand" href="index.php"><img src="layout/img/logo.png" width="32" alt=""/> Caramel <span style="color: #fff;font-family: Lobster, 'sans-serif';">Corn</span></a>
		
		<div class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			 <div class="container1" >
			  <div class="bar1"></div>
			  <div class="bar2"></div>
			  <div class="bar3"></div>
			 </div>
	   </div>
		
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
	  
    <ul class="nav navbar-nav ml-auto mt-2 mt-lg-0">
		
		
	<li class="nav-item">
	    <div class="btn-group">
        <a class="nav-link" >Movies</a>
			<a href="#" class="dropdown-toggle dropdown-toggle-split" id="test" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent"></a>

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
		
	<li class="nav-item">
	    <div class="btn-group">
        <a class="nav-link" >Tv Shows</a>
			<a href="#" class="dropdown-toggle dropdown-toggle-split" id="test" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent"></a>

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
		
		
       <li class="nav-item">
        <a class="nav-link" href="actors.php">People</a>
      </li>
    </ul>
	  

	  <ul class="nav navbar-nav navbar-right">
<?
   if(isset($_SESSION['user_name']))
   {
?>
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle btn-secondary rounded caramel_color" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img class="avatar" src="<?=$_SESSION["user_image"]?>"><?=$_SESSION['user_name']?></a>
			  
			<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
			  <li><a class="dropdown-item" href="corn.php"><img class="mr-2" src="layout/img/popcorn/<?=$logo ?>" width="35"> My Corn</a></li>
			  <li><a class="dropdown-item" href="logout.php"><img class="mr-3" src="layout/img/logout.png" width="28"> Logout</a></li>
			</ul>
			  
		  </li>
		  
<? }else{ ?>
		  
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle btn-secondary rounded " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-sign-in-alt"></i> Login</a>
			  
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
</nav>
	
	
	
	