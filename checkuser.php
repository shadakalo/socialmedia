<?php 

   $path = $_SERVER['DOCUMENT_ROOT']; // starts with root directory such as wamp/www or xammp/htdocs
   $dbpath = $path."/social/class/Database.php";// for including database class
   $helperspath = $path."/social/class/helpers.php";// for including helpers class
   include_once($dbpath);
   include_once($helperspath);
?>
<?php

	$db = new Database();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$email = $_POST['email'];

		$result =  $db->select("SELECT * FROM users WHERE email = :email",array('email'=>$email));
		if (count($result) > 0) {
			
			echo "<span class='error'><i class='fa fa-ban' aria-hidden='true'> Email address already taken...</i></span>";
			exit();
		}


	}



?>