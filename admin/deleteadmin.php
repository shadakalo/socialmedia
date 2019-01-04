
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


	if ($_GET['id']) {
		
		$id = base64_decode($_GET['id']);
		
		$db->delete("DELETE FROM admin WHERE id = :id",array('id'=>$id));

		echo "<script>alert('Admin Deleted!!!');</script>";
		echo "<script>window.location='viewadmin.php';</script>";


	}

?>