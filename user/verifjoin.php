<?php 

//cacher les warning de connection a la bdd
ini_set('display_errors','off');

function joinbd($name, $pseudo, $mail, $mdp)
{
	$mdp = MD5($mdp);
	$connect = mysql_connect('localhost', 'root', '');
	mysql_select_db("chevre_rose") or die(mysql_error());
	$ret = mysql_query("INSERT INTO `chevre_rose`.`user` (`name`, `pseudo`, `email`, `password`, `timewait`) VALUES ('$name', '$pseudo', '$mail', '$mdp', '30');") or die(mysql_error());
	mysql_close($connect);
	echo '<script>alert("Inscription effectuer. veuillez vous connecter");';
	echo 'window.location.href = "connect.php"; </script>';
}

function verifpseudo($pseudo)
{
	$connect = mysql_connect('localhost', 'root', '')  or die(mysql_error());
	mysql_select_db("chevre_rose") or die(mysqli_error($connect));
	$ret = mysql_query("SELECT * FROM user WHERE pseudo='$pseudo';") or die(mysql_error(). ' when we select');
	$nb = mysql_num_rows($ret);
	mysql_close($connect);
	if ($nb == 0)
		return 0;
	else
		return 1;
}

function verifjoin()
{
	$username = mysql_real_escape_string($_POST['name']);
	$userpseudo = mysql_real_escape_string($_POST['pseudo']);
	$useremail = mysql_real_escape_string($_POST['email']);
	$usercfemail = mysql_real_escape_string($_POST['cfemail']);
	$usermdp = mysql_real_escape_string($_POST['mdp']);
	$usercfmdp = mysql_real_escape_string($_POST['cfmdp']);

	if (!$username && !$userpseudo && !$useremail && !$usercfemail && !$usermdp && !$usercfmdp)
	{
		echo '<script>alert("Un champ n\'a pas ete rempli. Tout les champs sont obligatoires.");</script>';
		return ;
	}

	if (!preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $useremail))
	{
		echo '<script>alert("L\'e-mail n\'est pas valide ");</script>';
		return ;
	}
	
	if (strlen($username) > 255)
	{
		echo '<script>alert("le nom semble trop long");</script>';
		return ;
	}
	
	if (strlen($userpseudo) > 255)
	{
		echo '<script>alert("le pseudo semble trop long");</script>';
		return ;
	}

	if ($useremail !== $usercfemail)
	{
		echo '<script>alert("L\'e-mail de verification ne correspond pas a l\'e-mail de depart");</script>';
		return ;
	}

	if (strlen($useremail) > 255)
	{
		echo '<script>alert("l\'e-mail semble trop long");</script>';
		return ;
	}
	
	if ($usermdp !== $usercfmdp)
	{
		echo '<script>alert("Le mot de passe de verification ne correspond pas au mot de passe de depart");</script>';
		return ;
	}
	
	if (strlen($usermdp) > 255)
	{
		echo '<script>alert("le mot de passe semble trop long");</script>';
		return ;
	}
	if (verifpseudo($userpseudo) == 1)
	{
		echo '<script>alert("le pseudo ' . $userpseudo . ' existe deja.");</script>';
		return ;
	}
	joinbd($username, $userpseudo, $useremail, $usermdp);
}


if (isset($_POST['Creer']))
	verifjoin();
?>