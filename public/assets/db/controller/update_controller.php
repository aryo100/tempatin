<?php
	defined('PHPFILE') ? require_once PHPFILE.'\models\allModels.php' : die("script berakhir");

	class Update {

		private $conn;

		public function updateBookProcess() {
			$mysqli = new Models();

			$id = $_POST['id'];
			$nama = $_POST['nama'];
			$pengarang = $_POST['pengarang'];
			$tahun = $_POST['tahun_terbit'];
			$penerbit = $_POST['penerbit'];

			$mysqli->updateBook($id, $nama, $pengarang, $tahun, $penerbit);
		}

	}

?>