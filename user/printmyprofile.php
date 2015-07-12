<?php 
if (isset($_SESSION['username']))
	echo('<p><strong>Pseudo</strong> : ' . $_SESSION['username'] . ' </p>');
if (isset($_SESSION['email']))
	echo('<p><strong>e-mail</strong> : ' . $_SESSION['email'] . ' </p>');
if (isset($_SESSION['credit']))
	echo('<p><strong>Credit</strong> : ' . $_SESSION['credit'] . ' </p>');
if (isset($_SESSION['nbvisitesite']))
	echo('<p><strong>nombre de site visiter a ce jour</strong> : ' . $_SESSION['nbvisitesite'] . ' </p>');
 ?>