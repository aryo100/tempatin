<?php
	define('DB_SERVER','localhost');
	define('DB_USER','root');
	define('DB_PASS' ,'');
	define('DB_NAME', 'db_sik');

	class Models {

		private $conn;

		function __construct() {
			$this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die ("Error Cuy");
		}

		public function getRows($table_name) {
			$query = mysqli_escape_string($this->conn, "SELECT COUNT(*) AS count FROM $table_name");
			$result = mysqli_query($this->conn, $query) or die("Goblok error");
			$row = mysqli_fetch_assoc($result);
			$count = $row['count'];
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
				$responce->rows[$i]['id_siswa'] = $row['id_siswa'];
				$responce->rows[$i]['id_mapel'] = $row['id_mapel'];
				$responce->rows[$i]['nilai'] = $row['nilai'];
				// $responce->rows[$i]['cell'] = array($row['id'], $row['nama'], $row['pengarang'], $row['tahun_terbit'], $row['penerbit']);
				$i++;
			}

			echo json_encode($responce);
		}

		public function addBook($nama, $pengarang, $tahun, $penerbit) {
			$query = "INSERT INTO buku (nama, pengarang, tahun_terbit, penerbit) VALUES ('$nama', '$pengarang', '$tahun', '$penerbit')";
			$result = mysqli_query($this->conn, $query) or die("Connection error");
		}

		public function updateBook($id, $nama, $pengarang, $tahun, $penerbit) {
			$query = "UPDATE buku SET nama = '$nama', pengarang =  '$pengarang', tahun_terbit = '$tahun', penerbit = '$penerbit' WHERE id = '$id'";
			$result = mysqli_query($this->conn, $query) or die("Connection error");
		}

		public function deleteBook($id) {
			$query = "DELETE FROM buku WHERE id = '$id'";
			$result = mysqli_query($this->conn, $query) or die("Connection error");
		}

	}
?>