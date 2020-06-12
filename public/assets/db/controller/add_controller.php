<?php
	defined('PHPFILE') ? require_once PHPFILE.'\models\allModels.php' : die("script berakhir");

	class Add {

		private $conn;

		public function addBookProcess() {
			$mysqli = new Models();

			$nama = $_POST['nama'];
			$pengarang = $_POST['pengarang'];
			$tahun = $_POST['tahun_terbit'];
			$penerbit = $_POST['penerbit'];

			$mysqli->addBook($nama, $pengarang, $tahun, $penerbit);
		}

	}

?>