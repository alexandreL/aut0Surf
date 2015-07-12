<?php session_start(); ?>
<?php include('verifjoin.php'); ?>
<?php 
if (isset($_SESSION['username']))
    header('Location: http://localhost/test/index.php');
 ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Sign up</title>

    <!-- responsive_bootstrap / dark_side -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <meta name="generator" content="lol">

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

    <?php include( "../script/navbar.php"); ?>
    <?php include( "../script/header.php"); ?>

    <div id="main-area" class="main">
        <div class="container">

            <div class="span9 content" id="content-area">

                    <div class="plugins">

                        <div class="plugin plugin-comment-add" id="comment-add">
                            <h3>Inscription</h3>

                            <form method="post" action="join.php">

                                <div class="control-group required">
                                    <label for="join_field_name" class="control-label">Nom</label>
                                    <div class="controls">
                                        <input type="text" name="name" id="join_field_name" class="input-block-level" value="" />
                                    </div>
                                </div>

                                <div class="control-group required">
                                    <label for="join_field_pseudo" class="control-label">Pseudo</label>
                                    <div class="controls">
                                        <input type="text" name="pseudo" id="join_field_pseudo" class="input-block-level" value="" />
                                    </div>
                                </div>

                                <div class="control-group required">
                                    <label for="join_field_email" class="control-label">E-mail</label>
                                    <div class="controls">
                                        <input type="text" name="email" id="join_field_email" class="input-block-level" value="" />
                                    </div>
                                </div>

                                <div class="control-group required">
                                    <label for="join_field_cfemail" class="control-label">confirmation E-mail</label>
                                    <div class="controls">
                                        <input type="text" name="cfemail" id="join_field_cfemail" class="input-block-level" value="" />
                                    </div>
                                </div>

                                <div class="control-group required">
                                    <label for="join_field_mdp" class="control-label">Mot de Passe</label>
                                    <div class="controls">
                                        <input type="password" name="mdp" id="join_field_mdp" class="input-block-level" value="" />
                                    </div>
                                </div>

                                <div class="control-group required">
                                    <label for="join_field_cfmdp" class="control-label">confirmation Mot de Passe</label>
                                    <div class="controls">
                                        <input type="password" name="cfmdp" id="join_field_cfmdp" class="input-block-level" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Creer" name="Creer" class="btn btn-primary" />
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>

</html>
