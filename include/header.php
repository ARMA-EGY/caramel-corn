<?php

//Include Configuration File
include('config.php');

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
		 
		  header('location:index.php');
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
			 $_SESSION['user_image'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
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
		
		    header('location:index.php');
	}
	
	
	
	
}
else
{
	
 // Get login url
    $facebook_permissions = ['email']; // Optional permissions

    $facebook_login_url = $facebook_helper->getLoginUrl('http://caramel-corn.com/', $facebook_permissions);
    
    // Render Facebook login button
    $facebook_login_url = '<a class="btn btn-facebook" href="'.$facebook_login_url.'"><i class="fab fa-facebook-square mr-1"></i> Login With Facebook</a>';
	
	$login_google_button = '<a class="btn btn-google" href="'.$google_client->createAuthUrl().'"><i class="fab fa-google mr-1"></i> Sign In With Google</a>';
}

if(isset($_SESSION['access_token']))
{
	
//	echo $_SESSION['access_token'] . '<br>' ;
//	echo $_SESSION['user_name'] . '<br>' ;
//	echo $_SESSION['user_image'] . '<br>' ;
//	echo $_SESSION['user_email_address'] . '<br>' ;
//	echo $_SESSION['login_type'] . '<br>' ;
	
	
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
		if ($name != $row['name'])
		{
			$stmt = $conn->prepare("UPDATE members SET name = ? WHERE email = ?");
    		$stmt->execute(array($name, $email));
		}
	}
	else
	{
		$stmt = "INSERT INTO members ( name, email, image, login_type, Add_Date)
						VALUES('$name', '$email', '$image', '$login_type', now() )";

		$conn->exec($stmt);
	}


}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="layout/img/logo2.png"/>
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="layout/css/bootstrap.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="layout/css/style.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="layout/css/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="layout/css/hover-min.css">
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
<title>Caramel Corn</title>
</head>

<body>
	

	
	<nav class="navbar navbar-expand-md navbar-light customNav">

		<a id="askFaran" class="navbar-brand" href="index.php"><img src="layout/img/logo2.png" width="40" alt=""/> Caramel <span style="color: #fff;font-family: Lobster, 'sans-serif';">Corn</span></a>
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			 <div class="container1" onclick="myFunction(this)">
			  <div class="bar1"></div>
			  <div class="bar2"></div>
			  <div class="bar3"></div>
			 </div>
	   </button>
		
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
	  
    <ul class="nav navbar-nav ml-auto mt-2 mt-lg-0">
      <li id="home" class="nav-item">
        <a class="nav-link" href="movies.php" >Movies</a>
      </li>
      <li id="abt" class="nav-item">
        <a class="nav-link" href="tv.php" >Tv Shows</a>
      </li>
       <li id="svc" class="nav-item">
        <a class="nav-link" href="actors.php">Actors</a>
      </li>
    </ul>
	  
<!--
	  
	  <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2 search_bar" type="search" placeholder="Search" aria-label="Search">
		  <div style="position: absolute;width: 193px;background: rgba(0, 0, 0, 0.5);height: 300px;top: 60px;overflow: auto; display: none;" id="search_result"></div>
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Go</button>
    </form>
	  
-->
	  <ul class="nav navbar-nav navbar-right">
<?
   if(isset($_SESSION['user_name']))
   {
?>
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img class="avatar" src="<?=$_SESSION["user_image"]?>"><?=$_SESSION['user_name']?></a>
			  
			<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
			  <li><a class="dropdown-item" href="#"><img src="layout/img/mycorn.png" width="26"> My Corn</a></li>
			  <li><a class="dropdown-item" href="logout.php"><img src="layout/img/mycorn.png" width="23"> Logout</a></li>
			</ul>
			  
		  </li>
		  
<? }else{ ?>
		  
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-sign-in-alt"></i> Login</a>
			  
			<ul class="dropdown-menu text-center" aria-labelledby="navbarDropdown" style="right: 0; left: unset;">
			  <li><?=$facebook_login_url?></li>
			  <li><?=$login_google_button?></li>
			</ul>
			  
		  </li>
		  
		  
	 <? } ?>
	  
	</ul>
	  
	
	  
  </div>
</nav>
	
	
	
	