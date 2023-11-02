<?php
require 'includes/obrada.php';
?>
<!DOCTYPE html>
<html lang="hr">
<head>
	<title>Emanuel Tours</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#ffffff">
	<!--<meta http-equiv="Content-Security-Policy" content="default-src 'none';
        script-src 'self';
        style-src 'self' https://fonts.googleapis.com;
        img-src 'self' https: data:;
        connect-src 'self' https:;
        font-src 'self' https:;
        object-src 'none';
        media-src 'self' https:;
        form-action 'self';
        frame-src 'self' https://maps.google.com/ https://www.google.com/ https:;
        frame-ancestors 'self';
        base-uri 'none';
        upgrade-insecure-requests;
        block-all-mixed-content;"> -->

	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/form.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="/assets/css/main.css">

	<link rel="apple-touch-icon" sizes="180x180" href="images/fav/apple-touch-icon.png">
	<link rel="shortcut icon" type="image/png" href="/images/fav/favicon-32x32.png">
	<link rel="mask-icon" href="/images/fav/safari-pinned-tab.svg" color="#5bbad5">
</head>


<body>


<!-- header -->
<div class="container header">
	<div>
		<a href="/home"><img src="/images/logo.png" /></a>
	</div>
	<div class="navbar navbar-default" role="navigation">
        	<div class="navbar-header">
          		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            	<span class="sr-only">Toggle navigation</span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
          		</button>
			</div>
			<div class="navbar-collapse collapse">
			<!-- Right nav -->
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/home">Naslovna</a></li>
				<li><a href="/o-nama">O nama</a></li>
				<li><a href="/zanimljivosti">Zanimljivosti</a></li>
				<li><a href="/u-ponudi">Ponuda</a></li>
				<li><a href="/kontakt">Kontakt</a></li>
			</ul>
			</div><!--/.nav-collapse -->
	  </div>
	</div>
<?php
if ( in_array($stranica, array('home','tekstovi','u-ponudi'))) {
?>
<script src="/assets/js/responsiveslides.min.js"></script>
<script src="/assets/js/slider_large.js"></script>

<!-- image -->
<div class="mainImageContainer">
	<div class="mainImage">
		<ul class="rslides">
		<?php
			$results = mysqli_query($connection, "SELECT * FROM najnovije") or die(mysqli_error($connection));
			while($red=mysqli_fetch_assoc($results)){
				$srcar=$red['src_slider'];
				if (!empty($srcar)){
				$srcar=explode(", ",$red['src_slider']);
				$srcs=array_rand($srcar,1);
				$text=(strlen($red['text']) > 13) ? substr($red['text'],0,350).'...' : $red['text'];
				$title=(strlen($red['title']) > 13) ? substr($red['title'],0,45).'...' : $red['title'];
				$id= $red['id'];
				echo "<li>
				<div class='slider-overlay-container'>
					<div class='slider-overlay slider-title slider-bg'>".$title."</div>
					<div class='slider-text slider-bg'>".strip_tags($text)."</div>
					<div class='slider-overlay slider-bg slider-go'><a href='/ponuda/".$id."/".$red['title']."'>➙</a></div>
				</div>
				<img src='/images/slider/".$srcar[$srcs]."' alt=''>
				</li>";
				}
			}
		?>	
		</ul>
	</div>
<?php
}
?>
</div>

<?php include ("pages/".$stranica.".php"); ?>



<!-- footer -->

<div class="footer">
	<div class="c-foot">
		<div class="container">

			<div class="col-md-4 foot-box flex">
				<img src="/images/phone-call.png" />
				<p>+385 91 155 7236</p>
			</div>

			<div class="col-md-4 foot-box flex">
				<img src="/images/email.png" />
				<p>info@emanuel-tours.com</p>
			</div>

			<div class="col-md-4 foot-box flex">
				<img src="/images/location.png" />
				<p>Trg Popa Marka Mesića 5/13 Otočac</p>
			</div>
			
		</div>
	</div>

	<div class="copyright">
		<div class="container">

		<div class="col-md-6">
			&copy;  Emanuel Tours 2018 Sva prava pridržana
		</div>

		<div class="col-md-6">
			<a href="http://spectral-media.com/" target="_blank">Izrada web stranica</a>
            <a href="http://spectral-media.com/" target="_blank"> web shopa</a>
            -
            <a href="http://spectral-media.com/" target="_blank"> Spectral Media</a>
		</div>

		</div>
	</div>
</div>
</body>
</html>