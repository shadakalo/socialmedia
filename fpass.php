<?php
   session_start();
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

            $helpers->password_reset($email,$token);
    
            $msg = "<div> We've sent an email to $email.  Please click on the password reset link in the email to generate new password. </div>";
                   
      }
          else
        {
          $msg = "<div>  <strong>Sorry!</strong>  this email not found.  </div>";
           
        }

        
  }

?>


<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
    <style>
        
        .container {
            margin: 12% auto;
            width: 40%;
            min-width: 250px;
            height: 40%;
            border: 1px solid #e5e5e5;
            border-radius: 5px;
            box-shadow: 2px 2px 2px rgba(105, 105, 105, 0.5);
            padding: 2%;
        }
        
        form h2{
            text-align: center;
            color: #A07A9D;
        }
        label {
            margin-right: 5px;
        }
        div.fpass-button{
            margin-top: 20px;
            text-align: center;
        }
        button {
            width: 160px;
            border: none;
            padding: 9px;
            border-radius: 12px;
            color: white;
            background: #60485f;
            cursor: pointer;
        }
        button:hover {
            background: #A07A9D;
        }
        .fpass-text {
            margin: 20px 0 20px 0;
        }
        input[type=email] {
            margin-bottom: 20px;
        }
        
    </style>
</head>
  <body >
    <div class= "container">

      <form action="" method="post">
        <h2>Forgot Password</h2><hr />
        
          <?php
            if(isset($msg))
              {
                echo $msg;
              }
             else
              {
          ?>
                <div class="fpass-text">
                  Please enter your email address. You will receive a link to create a new password via email.
                </div> 

          <?php
              }
            ?>
          <label>Email</label>
        <input type="email" placeholder="Email address" name="email" required  class="form-control" />
        <hr />
          <div class="fpass-button"><button type="submit" name="btn-submit">Create New Password</button></div>
      </form>

    </div>
    
  </body>
</html>