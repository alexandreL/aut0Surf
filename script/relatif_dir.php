<?php
$mypath = explode('/', $_SERVER['REQUEST_URI']);
$nb_folder = 0;

foreach ($mypath as $key) {
	if ($key && $key !== 'test')
		$nb_folder++;
}
$nb_folder--;
$new_path = NULL;
for ($i=0; $i < $nb_folder; $i++) { 
	$new_path = $new_path . '../';
}
echo '"' . $new_path;
?>