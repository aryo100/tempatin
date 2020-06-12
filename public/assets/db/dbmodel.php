<?php
	/* Database connection settings */
	define('DB_SERVER','localhost');
	define('DB_USER','root');
	define('DB_PASS' ,'');
	define('DB_NAME', 'db_sik');

	class dbModel {

		private $conn;

		function __construct() {
			$this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die ("Error Cuy");
		}

		public function getRows($table_name) {
			$query = mysqli_escape_string($this->conn, "SELECT COUNT(*) AS count FROM $table_name");
			$result = mysqli_query($this->conn, $query);
			$row = mysqli_fetch_assoc($result);
			$count = $row['count'];
			// echo $count;
			return $count;
		}

		public function getNumOfPages($count, $limit) {
			if ($count > 0) $total_pages = ceil($count/$limit); 
			else $total_pages = 0;
			return $total_pages;
		}

		public function getSelectedData($table_name, $sidx, $sord, $start, $limit) {
			$query = mysqli_escape_string($this->conn, "SELECT * FROM $table_name ORDER BY $sidx $sord LIMIT $start, $limit");
			$result = mysqli_query($this->conn, $query);
			while ($array = mysqli_fetch_assoc($result)) {
				$result_arr[] = $array;
			}
			return $result_arr;
		}

		public function createJSON($page, $total_pages, $count, $res_arr) {
			$responce = new stdClass();
			$responce->page = $page;
			$responce->total = $total_pages;
			$responce->records = $count;
			$i = 0;

			foreach ($res_arr as $row) {
				$responce->rows[$i]['id'] = $row['id_nilai'];
				$responce->rows[$i]['cell'] = array( $row['id_nilai'], $row['id_siswa'], $row['id_mapel'], $row['nilai']);
				$i++;
			}

			echo json_encode($responce);
		}
	}