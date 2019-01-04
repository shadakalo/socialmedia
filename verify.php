<?php
   $path = $_SERVER['DOCUMENT_ROOT']; // starts with root directory such as wamp/www or xammp/htdocs
   $dbpath = $path."/social/class/Database.php";// for including database class
   $helperspath = $path."/social/class/helpers.php";// for including helpers class
   include_once($dbpath);
   include_once($helperspath);

?>
<?php

	$db = new Database();

	if(isset($_GET['email']) && isset($_GET['token'])){

		$email = $_GET['email'];
		$token = base64_decode($_GET['token']);


		$user_verification_result = $db->select_one_row("SELECT * FROM users WHERE email = :email AND token = :token",array('email'=>$email, 'token'=>$token));

		if ($user_verification_result) {
			
			if ($user_verification_result['activate'] == 1) {

				echo "<script>alert('Your acount is already activated... Please Login');window.location='index.php';</script>";
			}else{
				

				if($db->update("UPDATE users SET activate = 1 WHERE userid = :userid",array('userid'=>$user_verification_result['userid'])) == true)
					{
						echo "<script>alert('Your acount is activated... Please Login');window.location='index.php';</script>";
					}else{
						echo "<script>alert('something went wrong... try again later');window.location='index.php';</script>";
					}

			}

		}
	}

?>