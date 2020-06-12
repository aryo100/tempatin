<?php
	defined('PHPFILE') ? require_once PHPFILE.'\models\allModels.php' : die("script berakhir");

	class Delete {

		private $conn;

		public function deleteBookProcess() {
			$mysqli = new Models();

			$id = $_POST['id'];

			$mysqli->deleteBook($id);
		}

	}

?>