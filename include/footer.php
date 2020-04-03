<?

	$stmt = $conn->prepare("SELECT * FROM footer ORDER BY RAND() LIMIT 1");

	$stmt->execute();
	$row = $stmt->fetch();

	$background = $row['background'];

?>




	<div class="back-to-top">
		<i class="fas fa-rocket"></i>
	</div>

	



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
                            <form action="#" method="get">
                                <input type="search" name="search" id="footer-search" placeholder="E-mail">
                                <button type="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                    <!-- Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget text-center">
                            <h6>Integration With</h6>
                            <div class="single-tweet m-auto">
                           
								
							<img src="https://www.themoviedb.org/assets/2/v4/logos/primary-green-d70eebe18a5eb5b166d5c1ef0796715b8d1a2cbc698f96d311d62f894ae87085.svg" alt="The Movie Database (TMDb)" width="64"  style="
								display: block;
								margin: 5px auto;
							">
								
	<svg id="home_img" class="ipc-logo" xmlns="http://www.w3.org/2000/svg" width="64" height="32" viewBox="0 0 64 32" version="1.1"><g fill="#F5C518"><rect x="0" y="0" width="100%" height="100%" rx="4"></rect></g><g transform="translate(8.000000, 7.000000)" fill="#000000" fill-rule="nonzero"><polygon points="0 18 5 18 5 0 0 0"></polygon><path d="M15.6725178,0 L14.5534833,8.40846934 L13.8582008,3.83502426 C13.65661,2.37009263 13.4632474,1.09175121 13.278113,0 L7,0 L7,18 L11.2416347,18 L11.2580911,6.11380679 L13.0436094,18 L16.0633571,18 L17.7583653,5.8517865 L17.7707076,18 L22,18 L22,0 L15.6725178,0 Z"></path><path d="M24,18 L24,0 L31.8045586,0 C33.5693522,0 35,1.41994415 35,3.17660424 L35,14.8233958 C35,16.5777858 33.5716617,18 31.8045586,18 L24,18 Z M29.8322479,3.2395236 C29.6339219,3.13233348 29.2545158,3.08072342 28.7026524,3.08072342 L28.7026524,14.8914865 C29.4312846,14.8914865 29.8796736,14.7604764 30.0478195,14.4865461 C30.2159654,14.2165858 30.3021941,13.486105 30.3021941,12.2871637 L30.3021941,5.3078959 C30.3021941,4.49404499 30.272014,3.97397442 30.2159654,3.74371416 C30.1599168,3.5134539 30.0348852,3.34671372 29.8322479,3.2395236 Z"></path><path d="M44.4299079,4.50685823 L44.749518,4.50685823 C46.5447098,4.50685823 48,5.91267586 48,7.64486762 L48,14.8619906 C48,16.5950653 46.5451816,18 44.749518,18 L44.4299079,18 C43.3314617,18 42.3602746,17.4736618 41.7718697,16.6682739 L41.4838962,17.7687785 L37,17.7687785 L37,0 L41.7843263,0 L41.7843263,5.78053556 C42.4024982,5.01015739 43.3551514,4.50685823 44.4299079,4.50685823 Z M43.4055679,13.2842155 L43.4055679,9.01907814 C43.4055679,8.31433946 43.3603268,7.85185468 43.2660746,7.63896485 C43.1718224,7.42607505 42.7955881,7.2893916 42.5316822,7.2893916 C42.267776,7.2893916 41.8607934,7.40047379 41.7816216,7.58767002 L41.7816216,9.01907814 L41.7816216,13.4207851 L41.7816216,14.8074788 C41.8721037,15.0130276 42.2602358,15.1274059 42.5316822,15.1274059 C42.8031285,15.1274059 43.1982131,15.0166981 43.281155,14.8074788 C43.3640968,14.5982595 43.4055679,14.0880581 43.4055679,13.2842155 Z"></path></g></svg>   
								
								     
							 <img src="https://yts.mx/assets/images/website/logo-YTS.svg" alt="YIFY" width="75" style="
								display: block;
								margin: 5px auto;
							">
								
                            </div>
                        </div>
                    </div>
                    <!-- Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
                            <h6>Link Categories</h6>
                            <nav>
                                <ul>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Home</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Movies</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Tv Shows</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Actors</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Compare</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Support</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Contact Us</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Rate Us</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Privacy Policy</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Terms </a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
                            <h6>Account</h6>
                            <nav>
                                <ul>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> My Corn</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Watchlist</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Likes</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> My Lists</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Favorites</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Collections</a></li>
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