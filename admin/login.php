<?php 
   session_start();
   $_SESSION['login']  = false;
   $_SESSION['id'] = false;
   $path = $_SERVER['DOCUMENT_ROOT']; // starts with root directory such as wamp/www or xammp/htdocs
   $dbpath = $path."/social/class/Database.php";// for including database class
   $helperspath = $path."/social/class/helpers.php";// for including helpers class
   include_once($dbpath);
   include_once($helperspath);

?>
<?php
	
	$db = new Database(); // object for db
	$helpers = new Format(); // object for helpers
	$msg = "";
?>

<?php
	if (isset($_POST['submit'])){

		$email 	  	   = $helpers->validation($_POST['email']);
		$password 	   = $helpers->validation($_POST['password']);
		$password 	   = sha1(md5($password));



			$log_det = $db->select_one_row("SELECT * FROM admin WHERE email = :email AND pass = :pass",array('email'=>$email,'pass'=>$password));

			if ($log_det != false) {
				

					$_SESSION['login'] = true;
					$_SESSION['id']    = $log_det['id'];
					echo "<script>window.location='index.php';</script>";
 

			}else{
				$msg = "<span style='color:red;'>Invalid Username/Password</span>";
			}



		



}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="email"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" name="submit" />
			</div>
		</form><!-- form -->
		<div class="button">
			<?php  if ($msg != "") {
				echo $msg;
			} ?>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>