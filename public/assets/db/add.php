<?php
	define('PHPFILE', 'C:\xampp\htdocs\ace-master\assets\db');
	require_once PHPFILE.'\controller\add_controller.php';

	$add = new Add();

	$add->addBookProcess();
?>