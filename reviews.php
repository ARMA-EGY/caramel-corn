
<?

//Include Configuration File
include('include/db-connect.php'); 




if(isset($_POST['getreviews']))
{
	
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
			<div class="p-2 review1">
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



}





?>