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
  //post delete code
  if (isset($_GET['pid'])) {
    
    $photo = $_GET['pid'];

    $photo_select = $db->select_one_row("SELECT * FROM profile_images WHERE profile_image_id = :profile_image_id",array('profile_image_id'=> $photo));

    $photoid = $photo_select['profile_image'];

    unlink("$path/social/$photoid");
    $post_details =  $db->delete("DELETE FROM profile_images WHERE profile_image_id = :profile_image_id",array('profile_image_id'=>$photo));

    echo "<script>alert('Profile image Deleted');</script>";
    echo  "<script>window.location='photos.php';</script>";
  }

  //comment delete code



   if (isset($_GET['cid'])) {
    
    $photo = $_GET['cid'];

    $photo_select = $db->select_one_row("SELECT * FROM cover_images WHERE cover_image_id = :cover_image_id",array('cover_image_id'=> $photo));

    $photoid = $photo_select['cover_image'];

    unlink("$path/social/$photoid");
    $post_details =  $db->delete("DELETE FROM cover_images WHERE cover_image_id = :cover_image_id",array('cover_image_id'=>$photo));

    echo "<script>alert('Cover image Deleted');</script>";
    echo  "<script>window.location='photos.php';</script>";
  }



  
?>