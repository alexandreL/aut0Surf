<?php 
if (!isset($_SESSION['username']))
	header('Location: http://localhost/test/user/connect.php');
 ?>