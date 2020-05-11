
<?php

// Database Connection


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


?>