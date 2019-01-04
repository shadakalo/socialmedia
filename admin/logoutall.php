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



    $db->update("UPDATE users SET log_status = 0");

    echo "<script>window.location='index.php';</script>";

?>
