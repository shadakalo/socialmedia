
<?php

   session_start();
   $path = $_SERVER['DOCUMENT_ROOT']; // starts with root directory such as wamp/www or xammp/htdocs
   $dbpath = $path."/social/class/Database.php";// for including database class
   $helperspath = $path."/social/class/helpers.php";// for including helpers class
   include_once($dbpath);
   include_once($helperspath);
   $db = new Database(); // object for db
   $helpers = new Format(); // object for helpers

    if ($_SESSION['login'] == false) {
        echo "<script>window.location='login.php';</script>";
    }


?>


<?php


	if ($_GET['userid']) {
		
		$userid = base64_decode($_GET['userid']);
		
		$db->insert("INSERT INTO block_admin (userid) VALUES (:userid)",array('userid'=>$userid));

		echo "<script>alert('User Blocked !!!');</script>";
		echo "<script>window.location='blockedusers.php';</script>";


	}

?>