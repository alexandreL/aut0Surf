<?php session_start(); ?>
<?php include('../script/securitprofilepage.php'); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Paremetre du surfeur</title>

    <!-- responsive_bootstrap / dark_side -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->

<link href="../medias/static/themes/bootstrap/css/minify.css" rel="stylesheet">
<link href="../themes/combined.css" rel="stylesheet">

<script src="../medias/static/themes/bootstrap/js/minify.js"></script>
<script src="../themes/combined.js"></script>
</head>

<body id="pages_run_presentation" class="default">

    <?php
        if (!isset($_SESSION['username']))
            include("../script/navbar.php");
        else
            include("../script/navuserbar.php");
    ?>
    <?php include( "../script/header.php"); ?>

    <div id="main-area" class="main">
        <div class="container">
            <?php 
                if (isset($_SESSION['username']))
                    include("../script/menubar.php"); 
            ?>
            <div class="span9 content" id="content-area">

                <div class="view view-pages" id="view-page">
                    <h1 class="view-title">Parametre</h1>

                    <div id="rows" class="clearfix">
                        <div class="row-container page_1">
                            <div class="row-content">
                                <div class="row">
                                    <div class="column" style="width:100%">
                                        <div class="column-content">
                                            <div class="clearfix">
                                                <h3>Paramètres de l'autosurf</h3>
                                                <?php include('modsurfeur.php'); ?>
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
