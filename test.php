<!doctype html>
<html>
<head>
	
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="layout/img/logo.png"/>
<!--===============================================================================================-->	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="layout/css/tooltipster.main.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="layout/css/tooltipster-sideTip-borderless.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
<!--===============================================================================================-->	
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<!--	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="layout/css/style.css">
<!--===============================================================================================-->	
<title>Caramel Corn</title>
</head>

<body>


  
		<div class="info-last sharelink " style="border-top: 1px solid #bbb;">
			
			<span class="floaty"><i class="fas fa-share-alt mr-2"></i> Shareable Link</span>
			
			<div class="mb-2">
				<button class="btn btn-light copyButton px-1 py-0 ml-2"><i class="fas fa-copy"></i> Copy</button>
				<input id="linkToCopy" class="linkToCopy" value="https://caramel-corn.com/viewcorn.php?u=" style="position: absolute; opacity: 0;top: 0; " />

				<p id="corn_link" class="mt-3 ml-4">https://caramel-corn.com/viewcorn.php?u=</p>
			</div>
			
		</div>
	
	
	<button class="copyButton">click here to copy</button>
<input class="linkToCopy" value="TEXT TO COPY"
style="position: absolute; z-index: -999; opacity: 0;" />
	
	
	<?
	$actual_link = "$_SERVER[REQUEST_URI]";
	
	echo $actual_link;
	
	?>

	

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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





	
<script>
		
	// ========================== Copy Shareable Link  ==========================	
	  

	
	
	$('.copyButton').click(function()
	{
		$(this).siblings('input.linkToCopy').select();      
		document.execCommand("copy");
		
		alert('copied');
		
	});
	
	var animals = ['Cat', 'Dog', 'Mouse'] ;
	
	for (var i = 0; i < animals.length; i++)
		{
		
			console.log(animals[i]);
		}
	
	
</script>


	
</body>
	
	
	
</html>