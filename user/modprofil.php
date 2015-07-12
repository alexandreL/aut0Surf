<?php 
ini_set('display_errors','off');

function refreshsession($log, $pwd)
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

function modpassword()
{
	$mdp = mysql_real_escape_string($_POST['oldpwd']);
	$newmdp = mysql_real_escape_string($_POST['newmdp']);
	$cfnewmdp = mysql_real_escape_string($_POST['cfnewmdp']);
	$pseudo = $_SESSION['username'];

	if ($newmdp !== $cfnewmdp)
	{
		echo '<script>alert("Le mot de passe de verification ne correspond pas au mot de passe de depart");</script>';
		return ;
	}
	$newmdp = MD5($newmdp);
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
	mysql_query("UPDATE user SET password = '$newmdp' WHERE id = $id;");
	mysql_close($connect);
}

function modpseudo()
{
	$mdp = mysql_real_escape_string($_POST['oldpwd']);
	$newpseudo = mysql_real_escape_string($_POST['newpseudo']);
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
	mysql_query("UPDATE user SET pseudo = '$newpseudo' WHERE id = $id;") or die(mysql_error(). 'lolmdr');
	mysql_close($connect);
	refreshsession($newpseudo, $mdp);
}

function modmail()
{
	$mdp = mysql_real_escape_string($_POST['oldpwd']);
	$newmail = mysql_real_escape_string($_POST['newmail']);
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
	mysql_query("UPDATE user SET email = '$newmail' WHERE id = $id;");
	mysql_close($connect);
	refreshsession($pseudo, $mdp);
}

if (isset($_POST['modprofil']))
{
	if ($_POST['oldpwd'])
	{
		if ($_POST['newpseudo'])
			modpseudo();
		if ($_POST['newmail'])
			modmail();
		if ($_POST['newmdp'] && $_POST['cfnewmdp'])
			modpassword();
	}
	else
		echo '<script>alert("Le mot de passe actuel est obligatoir pour valider les modifications.");</script>';
		
}
?>
<?php 
if (isset($_SESSION['username']))
	echo('<p><strong>Pseudo</strong> : ' . $_SESSION['username'] . ' </p>');
if (isset($_SESSION['email']))
	echo('<p><strong>e-mail</strong> : ' . $_SESSION['email'] . ' </p>');
 ?>
<form method="post" action="">

    <div class="control-group required">
        <label for="co_field_pseudo" class="control-label">modifier le Pseudo</label>
        <div class="controls">
            <input type="text" name="newpseudo" id="co_field_pseudo" class="input-block-level" value="" />
        </div>
    </div>
    <div class="control-group required">
        <label for="co_field_pseudo" class="control-label">modifier l'address e-mail</label>
        <div class="controls">
            <input type="text" name="newmail" id="co_field_pseudo" class="input-block-level" value="" />
        </div>
    </div>
    <div class="control-group required">
        <label for="co_field_mdp" class="control-label">modifier le Mot de Passe</label>
        <div class="controls">
            <input type="password" name="newmdp" id="co_field_mdp" class="input-block-level" value="" />
        </div>
    </div>
    <div class="control-group required">
        <label for="co_field_mdp" class="control-label">retapper le Mot de Passe</label>
        <div class="controls">
            <input type="password" name="cfnewmdp" id="co_field_mdp" class="input-block-level" value="" />
        </div>
    </div>
    <div class="control-group required">
        <label for="co_field_mdp" class="control-label">entre votre mot de passe actuel pour valider vos modifications</label>
        <div class="controls">
            <input type="password" name="oldpwd" id="co_field_mdp" class="input-block-level" value="" />
        </div>
    </div>
</div>
<div class="form-actions">
    <input type="submit" value="confirmer" name="modprofil" class="btn btn-primary" />
</div>
</form>