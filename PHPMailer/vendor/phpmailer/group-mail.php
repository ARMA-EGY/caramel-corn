<?php

$name = $_GET['group-name'];
$name = $_GET['group-email'];
print_r['group-email'];
$number = $_GET['number'];
echo $name." ".$number;

	$subject = 'Freestudio Application for Creators & Talents';
	$body = '
	<body style="text-align: center;">
		<h1>Welcome to FreeStudioEgypt.com</h1>
		<h3>Hello '.$name.',</h3>
		<p>
			We are very happy that you are part of our community! <br>	
			You are just one step away from finalizing your registration.
		</p>
		<p>
			To confirm your account in freestudioegypt.com please click on the following link:
		</p>
		<button class="btn btn-sm btn-primary" style="color: #fff; background-color: #337ab7; border-color: #2e6da4; border-radius: 5px; cursor: pointer; padding: 6px;	">Confirm</button>
		<p>
			If this link does not work, please copy and paste the following link into your browser:<br>
			*url link* <br>
			and we will be delighted to help you.

		</p>
		<p>If you have any questions, please write us at <a href="">info@freestudio.com</a> and we will be delighted to help you.</p>
		<p>Thank You!</p>
		<p>The <a href="http://www.freestudioegypt.com">freestudioegypt.com</a> Team</p>


		<a href="#" class="fa fa-facebook"></a>
		<a href="#" class="fa fa-twitter"></a>
		<a href="#" class="fa fa-instagram"></a>
		<a href="#" class="fa fa-snapchat"></a>
	</body>';
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'relay-hosting.secureserver.net';  // Specify main and backup SMTP servers                     // Enable SMTP authentication
    $mail->Username = 'info@mediagatestudios.com';                 // SMTP username
    $mail->Password = '123456';                           // SMTP password
    $mail->SMTPDebug  = 0;
	$mail->SMTPSecure = "none";                 
	$mail->SMTPAuth   = false;
    $mail->Port = 25;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('info@mediagatestudios.com', 'Free Studio Egypt');
    $mail->addAddress( $email, $name );     // Add a recipient


    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    #$mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

#header("Location: /freestudio/freestudio.html");
?>