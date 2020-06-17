
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.15.1/firebase-app.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.15.1/firebase-analytics.js"></script>

  <!-- Add Firebase products that you want to use -->
  <script src="https://www.gstatic.com/firebasejs/7.15.1/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.15.1/firebase-firestore.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.15.1/firebase-database.js"></script>

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyAf-iU56NqohoFxIFtwYWiX1Ix7FKfFdW8",
    authDomain: "caramel-corn.firebaseapp.com",
    databaseURL: "https://caramel-corn.firebaseio.com",
    projectId: "caramel-corn",
    storageBucket: "caramel-corn.appspot.com",
    messagingSenderId: "652581811330",
    appId: "1:652581811330:web:3cd814bc941c9a5299b09b",
    measurementId: "G-YC236VJYC6"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>


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
			
			?>
			<script>
				
				var data = { user_id: '<?=$user_id?>', rate: '<?=$rate?>', category: '<?=$category?>', feedback: '<?=$feedback?>', date: '<?=date("Y/m/d")?>' };
				var MyPath = firebase.database().ref('Rating/');
				MyPath.push(data)
				  .then(function() {
					console.log('succeeded');
				  })
				  .catch(function(error) {
					console.log("failed: " + error.message);
				  });

			</script>

			<?
			
		}



}
else
{
        $state = 'rating';

        $response = ['state'=>$state];
        echo json_encode($response);
}





?>