<?


/*
==================================================================================
==  Curl Function for API  
==================================================================================
*/

function api_connect( $api_url ){
	$connection_c = curl_init(); // initializing
	curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
	curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
	curl_setopt( $connection_c, CURLOPT_TIMEOUT, 40 );
	$json_return = curl_exec( $connection_c ); // connect and get json data
	curl_close( $connection_c ); // close connection
	return json_decode( $json_return ); // decode and return
}



/*
==================================================================================
==  convertToHoursMins Function -> Convert a number to Hours and Minutes
==================================================================================
*/



function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}


/*
=====================================================================================
==  Check Items Exist Function -> check if this item in database or not 
=====================================================================================
*/


function checkExist ($select, $from, $value, $cond, $where)
{
	global $conn;
	
	$statement = $conn->prepare("SELECT $select FROM $from WHERE $select = ? AND $cond = ?");
	
	$statement->execute(array($value, $where));
	
	$count 	  = $statement->rowCount();
	
	return $count;
	
}


/*
==================================================================================
==  Sum Items Function -> Sum items from table in database  
==================================================================================
*/

function sumItems ($item, $table)
{
	global $conn;
	
	$statement1 = $conn->prepare("SELECT SUM($item) FROM $table ");
	
	$statement1->execute();
	
	return $statement1->fetchColumn();
	
}



/*
==================================================================================
==  Count Items Function -> Count items from table in database  
==================================================================================
*/

function countItems ($item, $table)
{
	global $conn;
	
	$statement1 = $conn->prepare("SELECT COUNT($item) FROM $table ");
	
	$statement1->execute();
	
	return $statement1->fetchColumn();
	
}



/*
==================================================================================
==  Count Items Function2 -> Count items from table in database  More Specific
==================================================================================
*/

function countItems2 ($item, $table, $where)
{
	global $conn;
	
	$statement2 = $conn->prepare("SELECT COUNT($item) FROM $table WHERE $item = ? ");
	
	$statement2->execute(array($where));
	
	return $statement2->fetchColumn();
	
}



/*
==================================================================================
==  Count Items Function3 -> Count items from table in database  More Specific
==================================================================================
*/

function countItems3 ($item, $table, $where, $user, $getuser)
{
	global $conn;
	
	$statement5 = $conn->prepare("SELECT COUNT($item) FROM $table WHERE $item = ? AND $user = ?");
	
	$statement5->execute(array($where, $getuser));
	
	return $statement5->fetchColumn();
	
}


/*
==================================================================================
==  Select Items Function -> Select items from table in database  
==================================================================================
*/

function selectItems ($item, $table, $cond, $where)
{
	global $conn;
	
	$statement5 = $conn->prepare("SELECT $item FROM $table WHERE $cond = ? ");
	
	$statement5->execute(array($where));
	
	return $statement5->fetchColumn();
	
}




?>