<?php
	   session_start();
	   $path = $_SERVER['DOCUMENT_ROOT']; // starts with root directory such as wamp/www or xammp/htdocs
	   $dbpath = $path."/social/class/Database.php";// for including database class
	   $helperspath = $path."/social/class/helpers.php";// for including helpers class
	   include_once($dbpath);
	   include_once($helperspath);

	   $db = new Database();

		$db->update("UPDATE users SET log_status = 0 WHERE userid = :userid",array('userid'=>$_SESSION['userid']));

		session_destroy();
		unset($_SESSION['login']);
		header("Location:index.php");

?>