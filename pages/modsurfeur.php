 <?php 
ini_set('display_errors','off');

function refreshmysession($log, $pwd)
{
	$connect = mysql_connect('localhost', 'root', '')  or die(mysql_error());
	mysql_select_db("chevre_rose") or die(mysqli_error($connect));
	$user = mysql_query("SELECT * FROM user WHERE pseudo='$log' && password='$pwd';") or die(mysql_error(). ' when we select');
	$nb = mysql_num_rows($user);
	if ($nb == 0)
	{
		echo '<script>alert("L\'identifiant ou le mot de passe est erroné.");</script>';
		return ;
	}
	$row = mysql_fetch_array($user, MYSQL_ASSOC);
	$_SESSION['username'] = $row['pseudo'];
	$_SESSION['email'] = $row['email'];
	$_SESSION['credit'] = $row['credit'];
	$_SESSION['timewait'] = $row['timewait'];
	$_SESSION['nbvisitesite'] = $row['nbvisitesite'];
	mysql_close($connect);
}

function modtmp()
{
	$mdp = mysql_real_escape_string($_POST['oldpwd']);
	$newtmp = (int) $_POST['tmp'];
	$pseudo = $_SESSION['username'];

	$mdp = MD5($mdp);
	$connect = mysql_connect('localhost', 'root', '')  or die(mysql_error());
	mysql_select_db("chevre_rose") or die(mysqli_error($connect));
	$user = mysql_query("SELECT * FROM user WHERE pseudo = '$pseudo' && password = '$mdp';") or die(mysql_error(). ' when we select');
	$nb = mysql_num_rows($user);
	if ($nb == 0)
	{
		echo '<script>alert("L\'identifiant ou le mot de passe est erroné.");</script>';
		return ;
	}
	$row = mysql_fetch_array($user, MYSQL_ASSOC);
	$id = $row['id'];
	mysql_query("UPDATE user SET timewait = $newtmp WHERE id = $id;");
	mysql_close($connect);
	refreshmysession($pseudo, $mdp);
}

if (isset($_POST['modsurfeur']))
{
	if ($_POST['oldpwd'])
	{
		if ($_POST['tmp'])
			modtmp();
	}
	else
		echo '<script>alert("Le mot de passe actuel est obligatoire pour valider les modifications.");</script>';
		
}
?>

<?php 
if (isset($_SESSION['credit']))
	echo('<p><strong>Credit</strong> : ' . $_SESSION['credit'] . ' </p>');
if (isset($_SESSION['nbvisitesite']))
	echo('<p><strong>nombre de site visiter a ce jour</strong> : ' . $_SESSION['nbvisitesite'] . ' </p>');
if (isset($_SESSION['timewait']))
	echo('<p><strong>Temps d\'attente entre chaque site</strong> : ' . $_SESSION['timewait'] . ' </p>&nbsp;');
 ?>

<form method="post" action="">

    <div class="control-group required">
        <label for="co_field_pseudo" class="control-label">modification du temps d'attente</label>
        <div class="controls">
            <input type="text" name="tmp" id="co_field_pseudo" class="input-block-level" value="" />
        </div>
    </div>
    <div class="control-group required">
        <label for="co_field_mdp" class="control-label">entrez votre mot de passe actuel pour valider vos modifications</label>
        <div class="controls">
            <input type="password" name="oldpwd" id="co_field_mdp" class="input-block-level" value="" />
        </div>
    </div>
</div>
<div class="form-actions">
    <input type="submit" value="confirmer" name="modsurfeur" class="btn btn-primary" />
</div>
</form>