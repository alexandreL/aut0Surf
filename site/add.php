<?php 
ini_set('display_errors','off');

function refreshsession($log)
{
	$connect = mysql_connect('localhost', 'root', '')  or die(mysql_error());
	mysql_select_db("chevre_rose") or die(mysqli_error($connect));
	$user = mysql_query("SELECT * FROM user WHERE pseudo='$log';") or die(mysql_error(). ' when we select');
	$nb = mysql_num_rows($user);
	if ($nb == 0)
	{
		echo '<script>alert("L\'identifiant est erroné. Reconnectez vous.");</script>';
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

function addwebsite()
{
	$newsite = mysql_real_escape_string($_POST['newsite']);
	$theme = $_POST['theme'];
	$pseudo = $_SESSION['username'];

	$connect = mysql_connect('localhost', 'root', '')  or die(mysql_error());
	mysql_select_db("chevre_rose") or die(mysqli_error($connect));
	$ret = mysql_query("INSERT INTO `chevre_rose`.`listsite` (`site`, `theme`) VALUES ('$newsite', '$theme');") or die(mysql_error());
	mysql_query("UPDATE user SET credit = credit + 10 WHERE pseudo = '$pseudo';");
	refreshsession($pseudo);
	echo "<script>alert(\"$newsite a ete ajouter a la liste des site, Merci. Vous avez gagner 10 credits\");</script>";
}

if (isset($_POST['addsite']))
{
	if ($_POST['newsite'])
		addwebsite();
	else
		echo '<script>alert("Aucun site.");</script>';
		
}
?>

<form method="post" action="">

	<div class="control-group required">
		<label for="newsite" class="control-label">Site : </label>
		<div class="controls">
			<input type="text" name="newsite" id="newsite" class="input-block-level" value="" />
		</div>
	</div>
	<div class="control-group required">
		<label for="newsite" class="control-label">Theme : </label>
		<select name='theme'class="selectpicker">
			<option value='autre'>autre</option>
			<option value='actualité‎'>actualité‎</option>
			<option value='architecture‎'>architecture‎</option>
			<option value='arts‎'>arts‎</option>
			<option value='automobile‎'>automobile‎</option>
			<option value='choc‎'>choc‎</option>
			<option value='érotique ou pornographique‎'>érotique ou pornographique‎</option>
			<option value='généalogie‎'>généalogie‎</option>
			<option value='géolocalisation‎'>géolocalisation‎</option>
			<option value='humoristique‎'>humoristique‎</option>
			<option value='presse'>presse</option>
			<option value='informatique‎'>informatique‎</option>
			<option value='jeux de société‎'>jeux de société‎</option>
			<option value='littéraire‎'>littéraire‎</option>
			<option value='marchand‎'>marchand‎</option>
			<option value='Musée virtuel‎'>Musée virtuel‎</option>
			<option value='pédagogique‎'>pédagogique‎</option>
			<option value='politique‎'>politique‎</option>
			<option value='recrutement‎'>recrutement‎</option>
			<option value='religieux‎'>religieux‎</option>
			<option value='réseaux social‎'>réseaux social‎</option>
			<option value='sciences‎'>sciences‎</option>
			<option value='questions-réponses‎'>questions-réponses‎</option>
			<option value='histoire‎'>histoire‎</option>
			<option value='société‎'>société‎</option>
			<option value='sport‎'>sport‎</option>
			<option value='télévision‎'>télévision‎</option>
			<option value='vidéoludique‎'>vidéoludique‎</option>
		</select>
	</div>
	<div class="form-actions">
		<input type="submit" value="addsite" name="addsite" class="btn btn-primary" />
	</div>
</form>