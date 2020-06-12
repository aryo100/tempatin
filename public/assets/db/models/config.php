<?php
	/* Configuration for Database */
	define('DB_SERVER','localhost');
	define('DB_USER','root');
	define('DB_PASS' ,'root');
	define('DB_NAME', 'db_sik');

	class Config {
		function __construct() {
			$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die ($mysqli->error);
		}
	}