<?php 

//cacher les warning de connection a la bdd
ini_set('display_errors','off');

function verifuser()
{
	$pseudo = mysql_real_escape_string($_POST['pseudo']);
	$mdp = mysql_real_escape_string($_POST['mdp']);

	if (!$name && !$mdp)
	{
		echo '<script>alert("Un champ n\'a pas ete rempli. Tout les champs sont obligatoires.");</script>';
		return ;
	}
	$mdp = MD5($mdp);
	$connect = mysql_connect('localhost', 'root', '')  or die(mysql_error());
	mysql_select_db("chevre_rose") or die(mysqli_error($connect));
	$user = mysql_query("SELECT * FROM user WHERE pseudo='$pseudo' && password='$mdp';") or die(mysql_error(). ' when we select');
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
	echo "<script>alert(\"Bienvenue $pseudo\");";
	echo 'window.location.href = "../index.php"; </script>';

	mysql_close($connect);

}


if (isset($_POST['login']))
	verifuser();
?>