<?

	$stmt = $conn->prepare("SELECT * FROM footer ORDER BY RAND() LIMIT 1");

	$stmt->execute();
	$row = $stmt->fetch();

	$background = $row['background'];

?>



	<div class="back-to-top">
		<i class="fas fa-rocket"></i>
	</div>

	
	<section class="section-spacing1" style="background: url('layout/img/footer/<?= $background ?>');background-size: cover;    height: 400px;">
	<div class="footer">

	<b>All Copy Right 2018 &reg  Are Reserved To ARMA.</b>
	
	</div>
	</section>	





	<script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
	<script src="layout/js/bootstrap.min.js"></script>
	<script src="layout/js/java.js"></script>
	<script src="layout/js/wow.min.js"></script>
	<script src="layout/js/tooltipster.main.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

	<script>
		
        new WOW().init();
		
    </script>
	

	
</body>
	
	
	
</html>