<?

//Include Configuration File
include('include/db-connect.php'); 




if(isset($_POST['rating']))
{
		$user_id 		= $_POST['user_id'];
		$category 		= $_POST['category'];
		$rating 		= $_POST['rating'];
		$feedback 		= filter_var($_POST['feedback'], FILTER_SANITIZE_STRING);


		if ($category == '' )
		{
      ?>

		<script>
			Swal.fire(
			  'Oops...',
			  'Please select your feedback category.',
			  'warning'
			)
		</script>
	  <?
		}
		elseif ($feedback == '' )
		{
      ?>

		<script>
			Swal.fire(
			  'Oops...',
			  'Please write your feedback.',
			  'warning'
			)
		</script>
	  <?
		}
		else
		{
			
			$stmt = "INSERT INTO rating (user_id, rate, category, feedback, Add_Date)

						VALUES('$user_id', '$rating' , '$category', '$feedback', now() )";

			$conn->exec($stmt);

			
      ?>

		<script>
				
			$('#feedback_text').val('');
				
			var data = { user_id: '<?=$user_id?>', rate: '<?=$rating?>', category: '<?=$category?>', feedback: '<?=$feedback?>', date: '<?=date("Y/m/d")?>' };
			var MyPath = firebase.database().ref('Rating/');
			MyPath.push(data)
			  .then(function() {
				console.log('succeeded');
			  })
			  .catch(function(error) {
				console.log("failed: " + error.message);
			  });

			
			Swal.fire(
			  'Thank You',
			  'Your Survey Completed Successfully',
			  'success'
			)
		</script>
	  <?
			
			
		}



}
else
{
      ?>

		<script>
				Swal.fire(
				  'Oops...',
				  'Please choose your rating by selecting one of (Emotions).',
				  'warning'
				)
		</script>
	  <?
}





?>