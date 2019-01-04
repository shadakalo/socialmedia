<?php 
   session_start();
   $_SESSION['login']  = false;
   $_SESSION['userid'] = false;
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

	
//registration
//registration
//registration	
	if (isset($_POST['register-submit'])) {
		
		$firstname     = $helpers->validation($_POST['firstname']);
		$lastname  	   = $helpers->validation($_POST['lastname']);
		$email 	  	   = $helpers->validation($_POST['email']);
		$password 	   = $helpers->validation($_POST['password']);
		$password2 	   = $helpers->validation($_POST['confpass']);
		$country_id    = $helpers->validation($_POST['country_id']);
		$gender 	   = $helpers->validation($_POST['gender']);
		$dob 	   	   = $helpers->validation($_POST['dob']);
		$token 	  	   = sha1($firstname.md5(uniqid(rand())).$lastname);

		if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password) && !empty($password2) && !empty($country_id) && !empty($gender) && !empty($dob)) {
					//checking password matched with confirm password or not
					if ($password == $password2) {
								//checking email is valid or not
								if(filter_var($email, FILTER_VALIDATE_EMAIL)){
										$resultEmail =  $db->select("SELECT * FROM users WHERE email = :email",array('email'=>$email));
										if (count($resultEmail) == 0) {
											
											$password =sha1(md5($password));
											$db->insert('INSERT INTO users(firstname, lastname, email, password, country_id, gender, dob, token) VALUES(:firstname, :lastname, :email, :password, :country_id, :gender, :dob, :token)', array('firstname'=>$firstname, 'lastname'=>$lastname, 'email'=>$email, 'password'=>$password, 'country_id'=>$country_id, 'gender'=>$gender, 'dob'=>$dob, 'token'=>$token));

											$helpers->verification_mail($email,$token);	

											$msg = "<script>alert('Registration Succesfull...please verify  using email Address to activate !!');</script>";

										}else{
											$msg = "<script>alert('Email Already Exists');</script>"; //for check email in db
										}

								}else{

									$msg = "<script>alert('Invalid Email Address');</script>"; // for email validation

								}

					}else{

						$msg = "<script>alert('Password dont macth');</script>"; // for password check

					}
		
		}else{

					$msg = "<script>alert('not registered !!! select country / gender  ');</script>"; //if anyfield is empty or somehow not registered

		}

	}
//registration  end  
//registration  end 
//registration  end 

//login
//login
//login
	

	if (isset($_POST['loginSubmit'])){

		$email 	  	   = $helpers->validation($_POST['email']);
		$password 	   = $helpers->validation($_POST['password']);
		$password 	   = sha1(md5($password));
		
		if(isset($_POST['robot_check']) && !empty($email) && !empty($password) ){

				$result_login = $db->select_one_row("SELECT * FROM users WHERE email = :email AND password = :password",array('email'=>$email, 'password'=>$password));

				$block_user = $db->select("SELECT * FROM block_admin WHERE userid = :userid",array('userid'=>$result_login['userid']));

						if (count($block_user) == 1) {
							echo "<script>alert('YOUR ARE BANNED');</script>";
							echo "<script>window.location='banned.php';</script>"; 
						}else{

									if ($result_login) {
											if($result_login['activate'] == 1 ){
												$_SESSION['login']  = true;
												$_SESSION['userid'] = $result_login['userid'];
												$db->update("UPDATE users SET 	log_status = 1 WHERE userid = :userid",array('userid'=>$_SESSION['userid']));
												echo "<script>window.location='newsfeed.php';</script>";
											}else{
												$msg_login =  "<span class='error'><i class='fa fa-ban' aria-hidden='true'> Your account is not activated</i></span>";
											}

									}else{
										$msg_login = "<span class='error'><i class='fa fa-ban' aria-hidden='true'> Invalid username/password</i></span>";
								}
							}
		}else{
			$msg_login = "<span class='error'>* Fields can not be empty...</span>";
		}
	}
//login end  
//login end
//login end
	
?>
<!DOCTYPE html>
<html>
  <head>
  	<link rel="icon" href="favicon.ico?v1" type="image/x-icon" />
    <link rel="shortcut icon" href="favicon.ico?v1" type="image/x-icon" />
    <title>Trivuz - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
      
    <link rel='stylesheet' type='text/css' href='http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css'/>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">

    <style type="text/css">
    	body{
    		 	background: #93628F; /* For browsers that do not support gradients */
			    background: -webkit-linear-gradient(#93628F, #4A2849) no-repeat center fixed; /* For Safari 5.1 to 6.0 */
			    background: -o-linear-gradient(#93628F, #4A2849) no-repeat center fixed; /* For Opera 11.1 to 12.0 */
			    background: -moz-linear-gradient(#93628F, #4A2849) no-repeat center fixed; /* For Firefox 3.6 to 15 */
			    background: linear-gradient(#93628F, #4A2849) no-repeat center fixed; /* Standard syntax */
    	}

    </style>
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
<body>
<?PHP
	echo $msg;
?>
<div class="container">
    	<div class="row log-page">
    		<div class="col-md-5 col-md-offset-1">
    			<center>
    				<h2 class="welcome">
   <?php

   	$title = $db->select_one_row("SELECT * FROM title WHERE id = 1");
   	echo $title['title_media'];

   ?>
    				</h2>
    		<h4 class="title">
 <?php

   	$title = $db->select_one_row("SELECT * FROM slogan WHERE id = 1");
   	echo $title['slogan_media'];

   ?>
    		</h4>
    			<img src="images/logo.png">
    			</center>
    		</div>


			<div class="col-md-4 col-md-offset-1" style="margin-top: 15px;">
				<div class="panel panel-login logregbdy1">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login&nbsp&nbsp<i class="fa fa-lock log-icon "></i></a>
								
								
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register&nbsp&nbsp<i class="fa fa-pencil log-icon"></i></a>
								
	                        		
							</div>
						</div>
						<hr style="background-color: #4A2849; height: 1px; ">
					</div>
					<div class="panel-body ">
						<div class="row">
							<div class="col-lg-12">
<!-- login form -->	
							

								<form id="login-form" name="myForm" action="" method="post" role="form" style="display: block;">
		<?php

			if (isset($msg_login)) {
				echo $msg_login;
			}

		?>
									<div class="form-group">
										<input type="text" name="email" id="login_email" class="form-control login-input" placeholder="Email...">
                                        <div id="email_state" class="invalidRed"></div>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="login_pass" class="form-control login-input" placeholder="Password..." value="">
                                        <div id="pass_state" class="invalidRed"></div>
									</div>

									<div class="form-group text-center">
										<input type="checkbox"  name="robot_check" class="robot" value="1"><sup class="super">I'M not a robot</sup>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="loginSubmit" class="form-control btn btnlogin" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="fpass.php" tabindex="5" class="forgot-password">Forgot Password </a><br>
													<a href="resendmail.php">Resend Activation mail </a>
												</div>
											</div>
										</div>
									</div>
								</form>



<!-- login form -->	
<!-- registration form -->	

								<form id="register-form" name="regForm" action="" method="post" role="form">
						
									<div class="form-group">
										<input type="text" name="firstname" id="firstname" class="form-control reg-input" placeholder="Firstname" value="">
                                        <div id="fname_state" class="invalidRed"></div>
									</div>
									<div class="form-group">
										<input type="text" name="lastname" id="lastname" class="form-control reg-input" placeholder="Lastname" value="">
                                        <div id="lname_state" class="invalidRed"></div>
									</div>
									<div class="form-group">
										<input type="text" name="email" id="reg_email" class="form-control reg-input " placeholder="Email Address" value="">
                                        <div id="reg_email_state" class="invalidRed"></div>
                                        <div id="emailstatus"></div>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="reg_pass" class="form-control reg-input" placeholder="Password">
                                        <div id="reg_pass_state" class="invalidRed"></div>
									</div>
									<div class="form-group">
										<input type="password" name="confpass" id="confpass" class="form-control reg-input" placeholder="Confirm Password">
                                        <div id="reg_confpass_state" class="invalidRed"></div>
									</div>
									<div class="form-group">
                                        <select id="country" name="country_id" class="form-control reg-input" > 
                                            <option selected="" value="0"><span style="color: grey">(Please select your Country)</span></option> 
<?php
	
	$result = $db->select('SELECT * FROM country', array()); // query to fetch country from db
	foreach (  $result as $value) {
		
?>
                                            <option value="<?php echo $value['country_id']  ?>"><?php echo $value['country_name']  ?></option>
<?php  } // end of foreach loop  ?>
                                        </select>
                                        <div id="country_state" class="invalidRed"></div>
                                    </div>
                                    <div class="form-group">
   
                                        <select name="gender" class="form-control reg-input" id="gender">
                                            
                                            <option selected="" value="0">(Please select your gender)</option>
                                            <option value="Female">Female</option>
                                            <option value="Male">Male</option>
                                        </select>
                                        <div id="gender_state" class="invalidRed"></div>
                                    </div>

                                    <div class="form-group"> <!-- Date input -->
                                        <input class="form-control reg-input" id="date" name="dob" placeholder="YYYY/MM/DD" type="text"/>
                                        <div id="date_state" class="invalidRed"></div>
                                    </div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit"  class="form-control btn btnlogin" value="Register Now">
											</div>
										</div>
									</div>
								</form>
<!-- registration form -->	



							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!--DatePICKER-->
  	<script type="text/javascript">
  		$(document).ready(function() {
	    $("#date").datepicker({
		      dateFormat: 'yy-mm-dd'
		});
	    $("button").click(function() {
	    	var selected = $("#dropdown option:selected").text();
	        var departing = $("#date").val();
	    });
	});
  	</script>
  	 <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script type="text/javascript" src="js/live-validation.js"></script>
    <script type="text/javascript" src="js/validation.js"></script>

</body>
</html>
