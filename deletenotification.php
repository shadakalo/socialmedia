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
		echo "<script>window.location='index.php';</script>";
	}else{
		$user_details =  $db->select_one_row("SELECT * FROM users WHERE userid = :userid",array('userid'=>$_SESSION['userid']));
		if ($user_details['log_status'] == 0){

			echo "<script>alert('Session expired... Login again please... ');</script>";
			session_destroy();
			unset($_SESSION['login']);
			echo "<script>window.location='index.php';</script>";
		}
	}

?>

<?php

  if (isset($_GET['id'])) {
   
      $id = $_GET['id'];
      $db->delete("DELETE FROM chat_notification WHERE id = :id",array('id'=>$id));
      echo "<script>window.location='messagenotification.php';</script>";


  }

?>
<?php

  if (isset($_GET['di'])) {
   
    
    $db->delete("DELETE  FROM chat_notification WHERE (user_1 = :user_1 OR user_2 = :user_2)  AND actionid != :actionid",array('user_1'=>$_SESSION['userid'],'user_2'=>$_SESSION['userid'],'actionid'=>$_SESSION['userid']));
      echo "<script>window.location='messagenotification.php';</script>";


  }

?>