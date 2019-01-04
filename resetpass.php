   <?php
   $path = $_SERVER['DOCUMENT_ROOT']; // starts with root directory such as wamp/www or xammp/htdocs
   $dbpath = $path."/social/class/Database.php";// for including database class
   $helperspath = $path."/social/class/helpers.php";// for including helpers class
   include_once($dbpath);
   include_once($helperspath);
   $db = new Database(); // object for db
   $helpers = new Format(); // object for helpers
 



if(isset($_GET['email']) && isset($_GET['token']))
{
 

  $token = base64_decode($_GET['token']);
  $email = $_GET['email'];

  
  $stmt = $db->select("SELECT * FROM users WHERE token=:token AND email=:email",array('token'=>$token,'email'=>$email));
 
  
  if($stmt)
  {
    if(isset($_POST['btn-reset-pass']))
    {
      $pass = $_POST['pass'];
      $cpass = $_POST['confirm-pass'];
      
      if($cpass!==$pass)
      {
        $msg = "<div>  <strong>Sorry!</strong>  Password Doesn't match.  </div>";
                  
      }
      else
      {
        $password = sha1(md5($cpass));
        $stmt = $db->update("UPDATE users SET password=:upass WHERE email=:email",array('upass'=>$password,'email'=>$email));
        
        $msg = "<div> Password Changed. </div>";      
        header('Location:index.php');
      }
    } 
  }
  else
  {
    $msg = "<div>  No Account Found, Try again </div>";
       
        
        
  }
  
  
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Password Reset</title>

    <style type="text/css">
      
      .main{
        margin: auto;
        width: 500px;
        border: 1px solid #80537D;
        padding: 30px;
        border-radius: 5px;
        position: relative;
        top: 150px;
      }
      .btn{

          padding: 5px;
          color: #fff;
          border-radius: 5px;
          background-color:  #4A2849; 
          border: 1px solid #4A2849;
          cursor: pointer;

      }
      .btn:hover{
          background-color: #80537D;
          border: 1px solid #80537D;
      }

      .input{
        margin: 5px;
        height: 25px;
        padding: 5px;
        border-radius: 5px;
      }

    </style>
     </head>
  <body>
    <div class="main">
      <div>
      <strong style="color: red;">you are here to reset your forgetton password.</strong>
    </div>
        <form  method="post">
        <h3 style="color: #80537D;">Password Reset.</h3><hr />
        <?php
        if(isset($msg))
    {
      echo $msg;
    }
    ?>
        <input type="password" placeholder="New Password" name="pass" required class="input" /><br>
        <input type="password" placeholder="Confirm New Password" name="confirm-pass" required  class="input" />
      <hr />
        <button type="submit" name="btn-reset-pass" class="btn">Reset Your Password</button>
        
      </form>

    </div>
    
  </body>
</html>

