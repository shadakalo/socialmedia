<?php

   $path = $_SERVER['DOCUMENT_ROOT']; // starts with root directory such as wamp/www or xammp/htdocs
   $dbpath = $path."/social/class/Database.php";// for including database class
   $helperspath = $path."/social/class/helpers.php";// for including helpers class
   include_once($dbpath);
   include_once($helperspath);
   $db = new Database(); // object for db
   $helpers = new Format(); // object for helpers


  if(isset($_POST['btn-submit']))

{ 

    $email = $_POST['email'];
    $stmt=  $db->select_one_row("SELECT userid FROM users WHERE email = :email",array('email'=>$email));
   
    if($stmt)

        {

            $id = base64_encode($stmt['userid']);
            $token = md5(uniqid(rand()));

            $stmt = $db->update("UPDATE users SET token=:token WHERE email=:email",array('token'=>$token,'email'=>$email));

            $helpers->verification_mail($email,$token);
    
            $msg = "<div> We've sent an email to $email.</div>";
                   
      }
          else
        {
          $msg = "<div style='color:red;'><br>  <strong>Sorry!</strong>  this email not found.  </div>";
           
        }

        
  }


?>


<!DOCTYPE html>
<html>
<head>
	<title>Resend Acrivation link</title>
	<style type="text/css">

		.form {
		margin: 0 auto;
		width: 500px;
		padding: 30px 30px;
		border: 1px solid black;
		margin-top: 70px;
		}

		h3{
		text-align: center;
		}

		button {
	               background-image: -webkit-linear-gradient(bottom, #4A2849, #93628F);
              background: linear-gradient(to bottom, rgb(74, 40, 73, .8), rgb(147, 98, 143, .8));
              background-size: cover;
              border-color: rgb(147, 98, 143);
		border: none;
		color: whitesmoke;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 15px 0px;
		cursor: pointer;
		padding: 7px 9px;

		border-radius: 5px;
		
		}

		form {
		text-align: center;
		}

		input[type=email] {

		padding: 5px 5px;
		margin: 8px 0;
		box-sizing: border-box;
		border-radius: 5px;
		}

		.color{

			color: rgb(147, 98, 143);

		}
	</style>

</head>
<body>
<div class="form" style="border-radius: 5px; border:1px solid rgb(147, 98, 143); "> 

<h3 class="color">CONGRATULATION!</h3>
<p>You have sucessfully created a new account!</p>
<div> This account is currently inactivate! please verify your email Address to activate your account!  </div>
<hr>
	<div> Incase you did not receive an email due to error please use the form below to resend Activation link. ( If you have already activated account please  <a href="index.php">login</a> )</div>
	<div></div>





	<form method="post">
		<?php
            if(isset($msg))
              {
                echo $msg;
              }
             else
              {
          ?>
          <div></div>
          <?php
              }
            ?>

		<h3 class="color">RESEND ACTIVATION LINK!</h3>
		<label>Email address: </label>
		<input type="email" placeholder="Email address" name="email" required /> <br>
	   
	    <button type="submit" name="btn-submit" class="btn-sub">Resend activation email</button>
		
	</form>
	
</div>




</body>
</html>