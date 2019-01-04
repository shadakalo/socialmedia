<?php include 'header.php'; ?>  




 <?php



  if(isset($_POST['changepass'])) 
  {
      $pass =  sha1(md5($_POST['pass']));
      $pass1 = $_POST['pass1'];
      $pass2 = $_POST['pass2'];

      if(!empty($pass) && !empty($pass1) && !empty($pass2))
      {
          if ($pass == $user_details['password']) {
            
                if (strlen($pass1) >= 6 ) {

                    if ($pass1 == $pass2) {
                     
                          $pass1 = sha1(md5($pass1));
                          $db->update("UPDATE users SET password = :password WHERE userid = :userid",array('password'=>$pass1,'userid'=>$_SESSION['userid']));

                          $MSG = "Password changed successfully";

                    }else{
                      $errMSG = "confirm password doesn't match";
                    }
                 

                }else{


                   $errMSG = "Password must contain 6 digits";

                }
          }else{
            $errMSG = "Wrong Old Password";
          }
    }else{
      $errMSG = "Fields can not be empty";
    }
}

?>
 

              
<div class="container change_name_form">




<form class="form-horizontal" method="post" name="form1" action="">

    

    <div class="form-group">
      <?php
              if(isset($MSG))
              {
                echo '<i class="fa fa-check-square" aria-hidden="true"> '.$MSG.' </i><br>';
              }

    ?>
     <?php
              if(isset($errMSG))
              {
                echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"> &nbsp'.$errMSG.' </i><br>';
              }

      ?>
        <label>
        Old Password</label>
            <input type="text" name="pass" class="form-control" placeholder="Old Password....">
    </div>
    <div class="form-group">
        <label>New Password :</label>
            <input type="text" name="pass1" class="form-control" placeholder="New Password....">
    </div>

    <div class="form-group">
        <label>Confirm Password :</label>
            <input type="text" name="pass2" class="form-control" placeholder="Confirm Password....">
    </div>

     



    <div class="form-group">
            <input type="submit"  name="changepass" value="UPDATE">
    </div>

    
</form>



</div>            
 <?php include 'chatbar.php'; ?>
 <?php include 'footer.php'; ?>



