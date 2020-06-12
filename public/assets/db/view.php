<?php
	define('PHPFILE', 'C:\xampp\htdocs\ace-master\assets\db');
	require_once PHPFILE.'\controller\view_controller.php';

	$view = new View();

	$view->viewTable();

	/*require_once("dbmodel.php");

	$mysqli = new dbModel();
	$page = isset($_GET['page']) ? $_GET['page'] : 1 ; 
	$limit = isset($_GET['rows']) ? $_GET['rows'] : 10;
	$sidx = isset($_GET['sidx']) ? $_GET['sidx'] : 'id';
	$sord = isset($_GET['sord'])? $_GET['sord'] : 'ASC';
	$table_name = "buku";

	$count = $mysqli->getRows($table_name);
	$total_pages = $mysqli->getNumOfPages($count, $limit);

	if ($page > $total_pages) $page = $total_pages;
	$start = $limit*$page - $limit;

	$data_arr = $mysqli->getSelectedData($table_name, $sidx, $sord, $start, $limit);

	$mysqli->createJSON($page, $total_pages, $count, $data_arr);*/
	
?>