
<?php

//config.php


$dbn    = 'mysql:host=185.201.11.187;dbname=u919964947_corn';
$user   = 'u919964947_corn';
$pass   = '123456';
$option =  array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);

try 
{
	$conn = new PDO($dbn, $user, $pass, $option);
	
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}


catch(PDOException $e) 
{
	echo 'Failed To Connect' . $e->getMessage();
}


//======================= .  FACEBOOK LOGIN API  . ==============================


require_once 'vendor_facebook/autoload.php';

if (!session_id())
{
    session_start();
}
else
{
	session_start();
}

// Call Facebook API

$facebook = new \Facebook\Facebook([
  'app_id'      => '269864730696474',
  'app_secret'     => '7d3c74848ff154fd5e89f3fcf221ba3d',
  'default_graph_version'  => 'v2.10'
]);




//======================= .  GOOGLE LOGIN API  . ==============================

//Include Google Client Library for PHP autoload file
require_once 'vendor_google/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('652581811330-2amt9q1fhqph2dtkth6g5h35v9vl7stm.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('giSMrA9WHvMzycOGVpFB-qmn');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://caramel-corn.com/');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//session_start();

?>