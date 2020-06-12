<?php
	defined('PHPFILE') ? require_once PHPFILE.'\models\allModels.php' : die("script berakhir");
	

	class View {

		private $conn;

		public function viewTable() {
			$mysqli = new Models();

			$page = isset($_GET['page']) ? $_GET['page'] : 1 ; 
			$limit = isset($_GET['rows']) ? $_GET['rows'] : 10;
			$sidx = isset($_GET['id'])? $_GET['id'] : 'id_nilai';
			$sord = isset($_GET['sord'])? $_GET['sord'] : 'ASC';
			$table_name = "nilai";

			$count = $mysqli->getRows($table_name);
			$total_pages = $mysqli->getNumOfPages($count, $limit);

			echo $page . " " . $limit." ".$total_pages;
			if ($page > $total_pages) $page = $total_pages;
			$start = $limit*$page - $limit;
			
			$data_arr = $mysqli->getSelectedData($table_name, $sidx, $sord, $start, $limit);
			
			$mysqli->createJSON($page, $total_pages, $count, $data_arr);
		}

	}


?>