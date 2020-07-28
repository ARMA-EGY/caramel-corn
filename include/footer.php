<?
	$stmt = $conn->prepare("SELECT * FROM footer ORDER BY RAND() LIMIT 1");
	$stmt->execute();
	$row = $stmt->fetch();

	$background = $row['background'];

if(isset($_SESSION['access_token']))
{
	$stmt = $conn->prepare("SELECT * FROM members WHERE id = ? ");
	$stmt->execute(array($user_id));
	$user = $stmt->fetch();

	$private = $user['private'];
	$uid     = $user['uid'];
	$logo    = $user['corn_logo'];
}
	
?>

<!--
	<div class="back-to-top">
		<i class="fas fa-rocket"></i>
	</div>
-->



	<section class="section-spacing1" style="background: url('layout/img/footer/<?= $background ?>');background-size: cover;">
	<div class="footer pt-5">

    <!-- ***** Footer Area Start ***** -->
    <footer class="fancy-footer-area fancy-bg-dark">
        <div class="footer-content section-padding-80-50">
            <div class="container">
                <div class="row">
                    <!-- Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
							
                            <h6>Our Newsletter</h6>
							
                            <p>Subscribe to our mailing list to get the updates to your email inbox.</p>
							
                            <form class="subscribe_form">
                                <input type="email" name="subscribe_email" placeholder="E-mail" required>
                                <button class="btn-filter submit" type="submit">Subscribe</button>
                            </form>
							
							<div class="footer-social-widegt d-flex align-items-center text-center">
                                <a href="https://www.facebook.com/caramelcornofficial/"><i class="fab fa-facebook-square fa-2x" aria-hidden="true"></i></a>
                                <a href="https://www.instagram.com/caramelcornofficial/"><i class="fab fa-instagram fa-2x" aria-hidden="true"></i></a>
								<a href="#"><i class="fab fa-twitter fa-2x" aria-hidden="true"></i></a>
                            </div>
							
                        </div>
                    </div>
                    <!-- Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget text-center">
                            <h6>Integration With</h6>
                            <div class="single-tweet m-auto">
                           
								
	<img src="https://www.themoviedb.org/assets/2/v4/logos/primary-green-d70eebe18a5eb5b166d5c1ef0796715b8d1a2cbc698f96d311d62f894ae87085.svg" alt="The Movie Database (TMDb)" width="55" >
								
	<svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="55" height="32" viewBox="0 0 64 32" version="1.1"><g fill="#F5C518"><rect x="0" y="0" width="100%" height="100%" rx="4"></rect></g><g transform="translate(8.000000, 7.000000)" fill="#000000" fill-rule="nonzero"><polygon points="0 18 5 18 5 0 0 0"></polygon><path d="M15.6725178,0 L14.5534833,8.40846934 L13.8582008,3.83502426 C13.65661,2.37009263 13.4632474,1.09175121 13.278113,0 L7,0 L7,18 L11.2416347,18 L11.2580911,6.11380679 L13.0436094,18 L16.0633571,18 L17.7583653,5.8517865 L17.7707076,18 L22,18 L22,0 L15.6725178,0 Z"></path><path d="M24,18 L24,0 L31.8045586,0 C33.5693522,0 35,1.41994415 35,3.17660424 L35,14.8233958 C35,16.5777858 33.5716617,18 31.8045586,18 L24,18 Z M29.8322479,3.2395236 C29.6339219,3.13233348 29.2545158,3.08072342 28.7026524,3.08072342 L28.7026524,14.8914865 C29.4312846,14.8914865 29.8796736,14.7604764 30.0478195,14.4865461 C30.2159654,14.2165858 30.3021941,13.486105 30.3021941,12.2871637 L30.3021941,5.3078959 C30.3021941,4.49404499 30.272014,3.97397442 30.2159654,3.74371416 C30.1599168,3.5134539 30.0348852,3.34671372 29.8322479,3.2395236 Z"></path><path d="M44.4299079,4.50685823 L44.749518,4.50685823 C46.5447098,4.50685823 48,5.91267586 48,7.64486762 L48,14.8619906 C48,16.5950653 46.5451816,18 44.749518,18 L44.4299079,18 C43.3314617,18 42.3602746,17.4736618 41.7718697,16.6682739 L41.4838962,17.7687785 L37,17.7687785 L37,0 L41.7843263,0 L41.7843263,5.78053556 C42.4024982,5.01015739 43.3551514,4.50685823 44.4299079,4.50685823 Z M43.4055679,13.2842155 L43.4055679,9.01907814 C43.4055679,8.31433946 43.3603268,7.85185468 43.2660746,7.63896485 C43.1718224,7.42607505 42.7955881,7.2893916 42.5316822,7.2893916 C42.267776,7.2893916 41.8607934,7.40047379 41.7816216,7.58767002 L41.7816216,9.01907814 L41.7816216,13.4207851 L41.7816216,14.8074788 C41.8721037,15.0130276 42.2602358,15.1274059 42.5316822,15.1274059 C42.8031285,15.1274059 43.1982131,15.0166981 43.281155,14.8074788 C43.3640968,14.5982595 43.4055679,14.0880581 43.4055679,13.2842155 Z"></path></g></svg>   
								
								     
	<img src="https://yts.mx/assets/images/website/logo-YTS.svg" alt="YIFY" width="60">
								
                            </div>
                        </div>
                    </div>
                    <!-- Footer Widget -->
                    <div class="col-6 col-sm-6 col-lg-2">
                        <div class="single-footer-widget">
                            <h6>Categories</h6>
                            <nav>
                                <ul>
                                    <li><a href="https://caramel-corn.com/"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Home</a></li>
                                    <li><a href="https://caramel-corn.com/m_browse.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Movies</a></li>
                                    <li><a href="https://caramel-corn.com/t_browse.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Tv Shows</a></li>
                                    <li><a href="https://caramel-corn.com/actors.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> People</a></li>
<!--
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Compare</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Support</a></li>
-->
                                    <li><a href="contact.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Contact Us</a></li>
                                    <li><a href="rate.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Rate Us</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Footer Widget -->
                    <div class="col-6 col-sm-6 col-lg-2">
                        <div class="single-footer-widget">
                            <h6>Account</h6>
                            <nav>
                                <ul>
									   
							   <? if(isset($_SESSION['access_token']))
									{
							   ?>
							      <li><a href="corn.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> My Corn</a></li>
                                    <li><a href="corn.php?sec=watchlist"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Watchlist</a></li>
                                    <li><a href="corn.php?sec=likes"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Likes</a></li>
                                    <li><a href="corn.php?sec=favorites"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Favorites</a></li>
                                    <li><a href="corn.php?sec=lists"><i class="fa fa-angle-double-right" aria-hidden="true"></i> My Lists</a></li>
                                    <li><a href="corn.php?sec=following"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Following</a></li>
							   
							   <?
								   }
							   else
								   {
								?>
							   
                                    <li class="login_modal" data-login="Login to view your Corn">
										<a><i class="fa fa-angle-double-right" aria-hidden="true"></i> My Corn</a>
									</li>
									
                                    <li class="login_modal" data-login="Login to view your Watchlist">
										<a ><i class="fa fa-angle-double-right" aria-hidden="true"></i> Watchlist</a>
									</li>
									
                                    <li class="login_modal" data-login="Login to view your Likes">
										<a ><i class="fa fa-angle-double-right" aria-hidden="true"></i> Likes</a
									</li>
									
                                    <li class="login_modal" data-login="Login to view your Favorites">
										<a ><i class="fa fa-angle-double-right" aria-hidden="true"></i> Favorites</a>
									</li>
									
                                    <li class="login_modal" data-login="Login to view your Lists">
										<a ><i class="fa fa-angle-double-right" aria-hidden="true"></i> My Lists</a>
									</li>
									
                                    <li class="login_modal" data-login="Login to view your Following">
										<a ><i class="fa fa-angle-double-right" aria-hidden="true"></i> Following</a>
									</li>
							
							   
							   <?
								   }
							   ?>
									
									
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Footer Widget -->
                    <div class="col-6 col-sm-6 col-lg-2">
                        <div class="single-footer-widget">
                            <h6>Legal</h6>
                            <nav>
                                <ul>
                                    <li><a href="https://caramel-corn.com/privacy.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Privacy Policy</a></li>
                                    <li><a href="https://caramel-corn.com/terms.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Terms & Condition </a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
					
					
                </div>
            </div>
        </div>
    </footer>
    <!-- ***** Footer Area End ***** -->
		
	<div>
		<p class="pt-4 text-center" style="font-weight: bold;font-size: 12pt;">Powered By 
			<img src="layout/img/arma_logo.png" width="65"> 
		</p>
	</div>
	
	</div>
	</section>	






<!--========================== Start Modal Trailer ================================-->
<div class="modal fade" id="trailer_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	  
    <div class="modal-content text-white text-center" style="background: #0000;border: unset;">
		
		<div class="modal-header" style="border-bottom: unset;">
			<button type="button" class="close text-white close_trailer" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		</div>
		
      	<div id="trailer_body" class="modal-body"></div>
		
		<div class="modal-footer">
        	<button type="button" class="btn btn-secondary close_trailer" data-dismiss="modal">Close</button>
        </div>
      
    </div>
  </div>
</div>




<!--========================== List Modal ================================-->
<div class="modal fade" id="list_modal" tabindex="-1" role="dialog" aria-labelledby="setting_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content" >
		
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		
      <div class="modal-body" id="get_list_modal">
		    
	  </div>
		
    </div>
  </div>
</div>


<?
if(isset($_SESSION['access_token']))
{
?>
<!--========================== Setting Modal ================================-->
<div class="modal fade" id="setting_modal" tabindex="-1" role="dialog" aria-labelledby="setting_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content modal-content2">
      <div class="modal-header">
        <h5 class="modal-title" id="setting_label">Setting</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		    
        <div class="info">
			
			<span class="floaty"><i class="far fa-file-image mr-2"></i> Logo</span>
			
			<div class="mb-2">
				<button class="btn btn-light get_logo px-1 py-0 ml-2" data-user="<?=$user_id ?>"><i class="fas fa-edit"></i> Change</button>
			</div>
			
			<div id="corn_logos" class="text-center"></div>
			
		</div>
		
		  
        <div class="info-last">
			
			<span class="floaty"><i class="fas fa-user-shield mr-2"></i> Private Account</span>
			
			<div class="custom-control custom-switch">
			  <input type="checkbox" class="custom-control-input" id="private" data-user="<?=$user_id ?>" <? if($private == 1){echo 'checked';} ?>>
			  <label class="custom-control-label ml-5 mb-2" for="private"> Private</label>
			</div>
			
		</div>
		  
		  
		<div class="info-last sharelink b-top-light <? if($private == 1){echo 'd-none2';} ?>" >
			
			<span class="floaty"><i class="fas fa-share-alt mr-2"></i> Shareable Link</span>
			
			<div class="mb-2">
				<button class="btn btn-light copyButton px-1 py-0 ml-2"><i class="fas fa-copy"></i> Copy</button>
				<input id="linkToCopy" class="linkToCopy" type="text" value="https://caramel-corn.com/viewcorn.php?u=<?=$uid ?>" style="position: absolute; opacity: 0;top: 0; left: 0;" />

				<p id="corn_link" class="mt-3 ml-4">https://caramel-corn.com/viewcorn.php?u=<?=$uid ?></p>
			</div>
			
		</div>
		  
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-filter" data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>

<?
}
?>		
		
		

	<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.15.1/firebase-app.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.15.1/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.15.1/firebase-messaging.js"></script>


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
	
  // Retrieve Firebase Messaging object.
const messaging = firebase.messaging();

	  
messaging.requestPermission()
	.then(function()
	{
		console.log('Have Permission');
		if(isTokenSentToServer())
		{
			getRegToken();		  
			console.log('Token Already Saved');
			
		}
		else
		{
			getRegToken();
		}
	
	//	getRegToken();
	})
	.catch(function(err)
	{
		console.log('Error Occured');
	})
	
	

	function getRegToken() 
	{
		 messaging.getToken()
		 .then((currentToken) => {
		  if (currentToken) {
			console.log(currentToken);
			token =  getToken();     
			newToken =  currentToken;
		//	console.log(token);
		//	console.log(newToken);
			if (token !== '' && token !== null && token != newToken)
				{
					console.log('token changed');
					changeToken(token, newToken);
				}
			setTokenSentToServer(true);
			saveToken(currentToken);
    		setToken(currentToken);
		  } else {
			console.log('No Instance ID token available. Request permission to generate one.');
			setTokenSentToServer(false);
        	setTokenSaved(false);
		  }
		}).catch((err) => {
		  console.log('An error occurred while retrieving token. ', err);
		  showToken('Error retrieving Instance ID token. ', err);
		  setTokenSentToServer(false);
          setTokenSaved(false);
		});
	}
	
	
  function isTokenSentToServer() {
    return window.localStorage.getItem('sentToServer') === '1';
  }

  function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? '1' : '0');
  }
    
	function setTokenSaved(sent){
		window.localStorage.setItem('notificationTokenSaved', sent ? 1 : 0);
	}

	function isTokenSaved(){
		return window.localStorage.getItem('notificationTokenSaved') == 1;
	}

    		
	function setToken(token){
		window.localStorage.setItem('notificationToken', token);
		setTokenSaved(true);
	}

	function getToken(){
		return window.localStorage.getItem('notificationToken');
	}
	
	function saveToken(currentToken) {
		
		 $.ajax({
				url: 		'ajax.php',
				method: 	'POST',
				dataType: 	'text',
				data:		{token: currentToken},
			    success : function(response)
				 {
					console.log(response);
				 }		
			});
	}

    		
	function changeToken(oldToken, newToken){
		$.ajax({
			url: 		'ajax.php',
			method: 	'POST',
			data: 		{oldToken: oldToken, newToken: newToken },
			success : function(response)
			 {
				console.log(response);
			 }		
		});
	}

	messaging.onMessage(function(payload) {
	  console.log("Message received. ", payload);
	  notificationTitle = payload.data.title;
	  notificationOptions = {
	  	body: payload.data.body,
	  	icon: payload.data.icon,
	  	image:  payload.data.image,
        data:{
            time: new Date(Date.now()).toString(),
            click_action: payload.data.click_action
        }
	  };
	  var notification = new Notification(notificationTitle,notificationOptions);
	});
	
</script>


	<script src="https://code.jquery.com/jquery-1.10.0.min.js"></script>
<!--===============================================================================================-->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!--===============================================================================================-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!--===============================================================================================-->	
	<script src="layout/js/tooltipster.main.min.js"></script>
<!--===============================================================================================-->	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<!--===============================================================================================-->	
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!--===============================================================================================-->	
	<script src="layout/js/java.js"></script>




	
<script>
	
	
	$(document).ready(function() {
		$('.searchtool').tooltipster({
		contentCloning: true, 
		contentAsHTML: true, 
		interactive: true, 
		animation: 'fade',
		side: ['bottom'],
		delay: 200,
		maxWidth: 360,
		minWidth: 200,
		theme: 'tooltipster-borderless',
		trigger: 'click'
		});
		
		$('.create_search').remove();
		
	});

	
$('.use_tooltips').tooltip({ boundary: 'window' });
	
	
$(document).on('click', '.add_genre', function(){
	
	var genres = $('.genre_checked').length
	
	if(genres == 3 )
		{
			Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'You Can\'t Choose More Than 3 Genres '
					})
		}
	else
		{

			var id = $(this).attr('data-id');

			$(this).append('<i class="fa fa-check-circle text-white genre_checked"></i>');
			$(this).removeClass('add_genre');
			$(this).addClass('remove_genre');

			$('.filter-box').append('<input class="'+id+'" type="hidden" name="genre[]" value="'+id+'" >');
			
		}
});	
	

$(document).on('click', '.remove_genre', function(){
	
	var id ='.' + $(this).attr('data-id');
	
	$(this).removeClass('remove_genre');
	$(this).addClass('add_genre');
	$(this).find('.genre_checked').remove();
	
	$(id).remove();
	
});
	
	
$('.slide_box').click(function(){
	
	$('.form-box').slideToggle();
	
});
	
var start = 1930;
var end = new Date().getFullYear();
var options = "";
for(var year = end ; year >=start; year--){
  options += "<option>"+ year +"</option>";
}
$("#year").append(options);
	
</script>


	
</body>
	
	
	
</html>