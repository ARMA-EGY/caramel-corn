<? include('ini.php'); ?>

	

	<link rel="stylesheet" type="text/css" href="contact/css/util.css">
	<link rel="stylesheet" type="text/css" href="contact/css/main.css">
<!--===============================================================================================-->



    <div class="contact1">
		<div class="container-contact1">
			
			<div class="col-12 text-center mb-4">
				<h2>Contact Us</h2>
				<p class="text-white mb-0">We're here to help and answer any question you might have.</p>
				<p class="text-white"> We look forward to hearing from you 🙂</p>
			</div>
			
			<div class="contact1-pic js-tilt" data-tilt>
				<img src="contact/images/img-01.png" alt="IMG">
			</div>

			<form class="contact1-form  msg_form">
				
				<span class="contact1-form-title">
					Get in touch
				</span>

				<div class="wrap-input1 validate-input" data-validate = "Name is required">
					<input id="name" class="input1" type="text" name="name" placeholder="Name">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<input id="email" class="input1" type="text" name="email" placeholder="Email">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Subject is required">
					<input id="subject" class="input1" type="text" name="subject" placeholder="Subject">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Message is required">
					<textarea id="message" class="input1" name="msg" placeholder="Message"></textarea>
					<span class="shadow-input1"></span>
				</div>

				<div class="container-contact1-form-btn">
					<button type="submit" class="contact1-form-btn">
						<span>
							Send Email
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
					</button>
				</div>
				
			</form>
		</div>
	</div>





		

	
<? include('include/footer.php'); ?>


<script src="contact/vendor/tilt/tilt.jquery.min.js"></script>
<script >
	$('.js-tilt').tilt({
		scale: 1.1
	})
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

<!--===============================================================================================-->
<script src="contact/js/main.js"></script>
