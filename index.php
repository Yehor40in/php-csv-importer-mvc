<?php

	ini_set('display_errors', 0);

	require_once 'Router.php';
	require_once 'View.php';
	require_once 'Model.php';
	require_once 'Controller.php';

	Router::route();

?>
