<?

//Include Configuration File
include('include/db-connect.php'); 




if(isset($_POST['rating']))
{
		$user_id 		= $_POST['user_id'];
		$category 		= $_POST['category'];
		$rating 		= $_POST['rating'];
		$feedback 		= $_POST['feedback'];


		if ($category == '' )
		{

			$state = 'category';

			$response = ['state'=>$state];
			echo json_encode($response);
		}
		elseif ($feedback == '' )
		{

			$state = 'feedback';

			$response = ['state'=>$state];
			echo json_encode($response);
		}
		else
		{
			
			$stmt = "INSERT INTO rating (user_id, rate, category, feedback, Add_Date)

						VALUES('$user_id', '$rate' , '$category', '$feedback', now() )";

			$conn->exec($stmt);

			$state = 'success';

			$response = ['state'=>$state];
			echo json_encode($response);
		}



}
else
{
        $state = 'rating';

        $response = ['state'=>$state];
        echo json_encode($response);
}





?>