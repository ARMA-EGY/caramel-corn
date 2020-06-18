<?php 

// ========================= CREATE NOTIFICATION =========================


include_once("include/db-connect.php");


if (isset($_POST['notification_title'])) 
{
	
	$title 		= $_POST['notification_title'];
	$body 		= $_POST['body'];
	$link 		= $_POST['link'];
	$image_link = $_POST['image'];
	$logo_link 	= $_POST['logo'];
	
	
	$stmt = "INSERT INTO notifications (title, body, link, image, icon, Add_Date)
					VALUES('$title', '$body', '$link', '$image_link', '$logo_link', now() )";

	$conn->exec($stmt);

	
}
elseif (isset($_POST['resend_noti'])) 
{
	$id = $_POST['resend_noti'];
		
	$stmt = $conn->prepare("SELECT * FROM notifications WHERE id = ? ");
	$stmt->execute(array($id));
	$row = $stmt->fetch();

	
	$title 			= $row['title'];
	$body 			= $row['body'];
	$link 			= $row['link'];
	$image_link 	= $row['image'];
	$logo_link 		= $row['icon'];
	
}

	
	

		define('SERVER_API_KEY', 'AIzaSyBqFh2dACkhJGi0Voqdvk7sjdWeYIluwlg');

		include_once("db-connect.php");

		$stmt = $conn->prepare('SELECT * FROM tokens');
		$stmt->execute();
		$tokens = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach ($tokens as $token) {
			$registrationIds[] = $token['token'];
		}

		// $tokens = ['cCLA1_8Inic:APA91bGhuCksjWEETYWVOh04scsZInxdWmXekEr5F9-1zJuTDZDw3It_tNmpA__PmoxDTISZzplD_ciXvsuw2pMtYSzdfIUAUfcTLnghvJS0CVkYW9sVx2HnF1rqnxsFgSdYmcXpHKLs'];

		$header = [
			'Authorization: Key=' . SERVER_API_KEY,
			'Content-Type: Application/json'
		];

		$msg = [
			'title' => $title,
			'body' => $body,
			'icon' => $logo_link,
			'image' => $image_link,
			'click_action' => $link
		];

		$payload = [
			'registration_ids' 	=> $registrationIds,
			'data'				=> $msg
		];

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode( $payload ),
		  CURLOPT_HTTPHEADER => $header
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}
	
	

 ?>