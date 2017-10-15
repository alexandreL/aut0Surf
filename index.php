<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Chevre rose Autosurf</title>

	<!-- responsive_bootstrap / dark_side -->
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->

<link href="medias/static/themes/bootstrap/css/minify.css" rel="stylesheet">
<link href="themes/combined.css" rel="stylesheet">
<link rel="icon" href="medias/img/favicon.ico">
<script src="medias/static/themes/bootstrap/js/minify.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->

<script src="themes/combined.js"></script>
</head>
<body id="welcome_index" class="default">

	<div id="ad_website_top">
		<style type="text/css">#ad_website_top{display:none;}</style>    
	</div>
	<?php
		if (!isset($_SESSION['username']))
			include("script/navbar.php");
		else
			include("script/navuserbar.php");
	?>
	<?php include("script/header.php"); ?>


	<div id="main-area" class="main">
		<div class="container">


			<?php 
				if (isset($_SESSION['username']))
					include("script/menubar.php"); 
			?>


			<div class="span9 content" id="content-area">

				<div class="view view-pages" id="view-index">
					<h1 class="view-title">Accueil</h1>

					<div id="rows" class="clearfix">
						<div  class="row-container page_1">
							<div class="row-content">
								<div class="row">
									<div class="column" style="width:100%">
										<div class="column-content">
											<div class="clearfix">
												<h3>C'est quoi un <strong>Autosurf</strong>&nbsp;?</h3>

												<p>&nbsp;</p>

												<p><em>Un autosurf est un système d'échange de visites permettant de découvrir différents types de sites : blog, vidéo, chaîne musicale, portfolio, ... et qui peut donc permettre de gagner potentiellement des visites.</em></p>
												<p>&nbsp;</p>
												<p>&nbsp;</p>

												<h4>Les fonctionnalitees de l'autosurf.</h4>


												<h5>Gratuit</h5>
												<p>Toutes les options de l'autosurf sont gratuites, il suffit juste de gagner des crédits</p>
												<h5>Visite unique possible</h5>
												<p>Une même personne ne verra ton site qu'une fois par jour</p>
												<h5>Temps d'affichage réglable</h5>
												<p>Personnaliser le temps d'affichage (8 à 160 secondes)</p>

											</div>
										</div>



									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>


</div>
</div>
</div>

</body>

</html>