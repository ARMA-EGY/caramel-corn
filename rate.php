<?  include('ini.php'); ?>



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


 <section class="section-spacing">
	<div class="back_layer">
		
		<div class="container text-white py-3">

			<form class="col-md-10 p-3 m-auto rating_form" style="box-shadow:0 0 5px 1px rgba(255, 255, 255, 0.5);border-radius: 10px;">
				
				
			<div class="col-12 text-center mb-4">
				<h2>Rate Us</h2>
				<p class="text-white mb-0">We would like your feedback to improve our website.</p>
				<br>
				<p class="text-white"> What's your opinion on this website? </p>
			</div>
				
				
				<div class="col-md-12 text-center m-4">
					<div id="myRating"></div>
				</div>

				<hr style="border-top: 1px solid rgba(255, 255, 255, 0.5);">
				<div class="clearfix"></div>
				
				<div class="col-12 text-center mb-4">
					<p class="text-white"> Please select your feedback category  </p>
					<div>
						<span class="badge badge-light pointer p-2 mx-2 feedback_category" data-category="idea" style="font-size: 14px;" ><i class="fa fa-lightbulb"></i> Idea</span>

						<span class="badge badge-light pointer p-2 mx-2 feedback_category" data-category="problem" style="font-size: 14px;" ><i class="fa fa-exclamation-triangle"></i> Problem</span>

						<span class="badge badge-light pointer p-2 mx-2 feedback_category" data-category="question" style="font-size: 14px;" ><i class="fa fa-question-circle"></i> Question</span>

						<span class="badge badge-light pointer p-2 mx-2 feedback_category" data-category="praise" style="font-size: 14px;" ><i class="fa fa-heart"></i> Praise</span>
					</div>
					
					
					<p class="text-white mt-3">Tell us what do you think, any kind of feedback is highly appreciated.  </p>
					
					<textarea id="feedback_text" class="form-control mt-3" rows="4" name="feedback" placeholder="Your Feedback ..." required></textarea>
					
				</div>
				
				<input id="feedback_category" type="hidden" name="category" value="">
				
				
			   <? if(isset($_SESSION['access_token']))
					{
			   ?>	   
				
				<input  type="hidden" name="user_id" value="<?=$user_id?>">
				
				<div class="modal-footer">
					<button type="submit" class="btn btn-filter submit" >Complete</button>
				</div>
				
				
				<?
					}
				else
				   {
			   ?>

				<div class="modal-footer">
					<span class="btn btn-filter login_modal" data-login="Login to complete your feedback" >Complete</span>
				</div>
				
				
				<?}?>
				
			</form>
			

		</div>
		
		<hr style="border-top: 1px solid rgba(255, 255, 255, 0.8);">
		
		
		<div class="container text-white py-3">
			
				
			<div class="col-12 text-center mb-4">
				<h2 class="text-white font-weight-bold">Reviews</h2>
			</div>
			
			
			<div id="reviews">
			
<?
	$stmt = $conn->prepare("SELECT * FROM rating ORDER BY id DESC ");
	$stmt->execute();
	$rows = $stmt->fetchAll();

			
		foreach($rows as $row)
		{
			$date = date('j M, Y', strtotime($row['Add_Date']));
			
			$stmt = $conn->prepare("SELECT * FROM members WHERE id = ? ");
			$stmt->execute(array($row['user_id']));
			$user = $stmt->fetch();
?>
			<div class="p-2" style="border-bottom: 1px solid rgba(255, 255, 255, 0.6);">
				<div>
					<img class="avatar" src="<?=$user['image']?>">
				
					<span class="caramel_color font-weight-bold"><?=$user['name']?></span>
					
					<?
						if ($row['category'] == 'praise')
						{
							echo '<span class="badge badge-light p-2 m-2 float-right" style="font-size: 10px;" ><i class="fa fa-heart"></i> Praise</span>';
						}  
						elseif ($row['category'] == 'problem')
						{
							 echo '<span class="badge badge-light p-2 m-2 float-right" style="font-size: 10px;" ><i class="fa fa-exclamation-triangle"></i> Problem</span>';
						} 
						elseif ($row['category'] == 'idea')
						{
							 echo '<span class="badge badge-light p-2 m-2 float-right" style="font-size: 10px;" ><i class="fa fa-lightbulb"></i> Idea</span>';
						} 
						elseif ($row['category'] == 'question')
						{
							 echo '<span class="badge badge-light p-2 m-2 float-right" style="font-size: 10px;" ><i class="fa fa-question-circle"></i> Question</span>';
						} 
					?>

				</div>
				
				<div class="ml-5">
					<span style="font-size: 18px; font-weight: bold;">
					<?
						if ($row['rate'] == 1){echo '&#x1F620; Angry';}  
						 elseif ($row['rate'] == 2){echo '&#x1F61E; &#x1F61E; Disappointed';} 
						 elseif ($row['rate'] == 3){echo '&#x1F610; &#x1F610; &#x1F610; Normal';} 
						 elseif ($row['rate'] == 4){echo '&#x1F60A; &#x1F60A; &#x1F60A; &#x1F60A; Happy';} 
						 elseif ($row['rate'] == 5){echo '&#x1F60D; &#x1F60D; &#x1F60D; &#x1F60D; &#x1F60D; InLove';} 
					?>
					</span>
				
				</div>
				
				<p class="ml-5 mt-2 mb-0"><?=$row['feedback']?></p>
				
				<span class="float-right" style="font-size: 12px;"><?=$date?></span>
				<div class="clearfix"></div>
			
			</div>
			
<?
		}
?>
			</div>
			
		</div>
		
	</div>
 </section>


<div id="result"></div>


	
<? include('include/footer.php'); ?>


<script src="layout/js/emotions_rate.js"></script>
	
<script>

var emotionsArray = {
    angry:"&#x1F620;",
    disappointed:"&#x1F61E;",
    meh:"&#x1F610;",
    happy:"&#x1F60A;",
    smile:"&#x1F603;",
    wink:"&#x1F609;",
    laughing:"&#x1F606;",
    inLove:"&#x1F60D;",
    heart:"&#x2764;",
    crying:"&#x1F622;",
    star:"&#x2B50;",
};

	
var emotionsArray = ['angry','disappointed','meh', 'happy', 'inLove'];
	
	$("#myRating").emotionsRating({
  emotions: emotionsArray
});

	
	$("#myRating").emotionsRating({

  // background emoji
  bgEmotion: "happy",

  // number of emoji
  count: 5,

  // color of emoji
  // gold, red, blue, green, black, 
  // brown, pink, purple, orange
  color: "red",

  // initial rating value
  initialRating: 2,

  // size of emoji
  emotionSize: 30,

  // input name
  inputName: "ratings[]",

//  // callback
//  emotionOnUp<a href="https://www.jqueryscript.net/time-clock/">date</a>: null,

  // if is disabled?
  disabled: false,

  // enable use of images as emoji
  useCustomEmotions: false,

  // if you want to process the images
  transformImages: false
  
});
	
	
	
//==================================	
	
		
	$('.rating_form').submit(function(e)
	{
		
		e.preventDefault();
    	$('.submit').prop('disabled', true);
		
		$.ajax({
			url: 		'rating.php',
			method: 	'POST',
			dataType: 	'text',
			data:		$(this).serialize()	,
			success : function(response)
				 {
					 $('#result').html(response);
    				$('.submit').prop('disabled', false);
				 }
		});
		
	});
	
	
	$('.feedback_category').click(function(){
		
		var category = $(this).attr('data-category');
		
		$('#feedback_category').val(category);
		
		$(this).addClass('badge-secondary');
		$(this).removeClass('badge-light');
		$(this).append('<i class="fa fa-check-circle text-white category_checked ml-2"></i>');
		$(this).siblings().removeClass('badge-secondary');
		$(this).siblings().addClass('badge-light');
		$(this).siblings().find('.category_checked').remove();
		
	});
	
	
	var MyPath = firebase.database().ref('Rating/');
	 MyPath.on('value', function(GetData) {

		console.log("Change Data" , GetData.val());
           
		$.ajax({
			url: 		'reviews.php',
			method: 	'POST',
			dataType: 	'text',
			data:		{getreviews: 1}	,
			success : function(response)
				 {
    				$('#reviews').html(response);
				 }
		});

	 });
	

</script>


