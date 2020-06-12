<?php
	define('PHPFILE', 'C:\xampp\htdocs\ace-master\assets\db');
	

	$request = $_POST['oper'];

	switch ($request) {
		case 'add':
			require_once PHPFILE.'\controller\add_controller.php';
			$add = new Add();
			$add->addBookProcess();
		break;

		case 'edit':
			require_once PHPFILE.'\controller\update_controller.php';
			$update = new Update();
			$update->updateBookProcess();
		break;

		case 'del':
			require_once PHPFILE.'\controller\delete_controller.php';
			$update = new Delete();
			$update->deleteBookProcess();
		break;
		
		default:
			die("Request Exeption: ".mysqli_error());
		break;
	}

	/*define('DB_SERVER','localhost');
	define('DB_USER','root');
	define('DB_PASS' ,'root');
	define('DB_NAME', 'jq');

	$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die ($mysqli->error);

	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$pengarang = $_POST['pengarang'];
	$tahun = $_POST['tahun_terbit'];
	$penerbit = $_POST['penerbit'];

	$query = "UPDATE buku SET nama = '$nama', pengarang =  '$pengarang', tahun_terbit = '$tahun', penerbit = '$penerbit' WHERE id = '$id'";
	$result = $mysqli->query($query) or die("querynya salah");
	echo "yang ini juga udah bisa...";*/

?>