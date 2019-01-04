<?php include 'header.php'; ?>


<?php include 'nav.php'; ?>
<div class="clear">
</div>
<?php include 'sidebar.php'; ?>


 <?php



  if(isset($_POST['changepass'])) 
  {
      $pass =  sha1(md5($_POST['pass']));
      $pass1 = $_POST['pass1'];
      $pass2 = $_POST['pass2'];

      if(!empty($pass) && !empty($pass1) && !empty($pass2))
      {
          if ($pass == $admin_details['pass']) {
            
                if (strlen($pass1) >= 6 ) {

                    if ($pass1 == $pass2) {
                     
                          $pass1 = sha1(md5($pass1));
                          $db->update("UPDATE admin SET pass = :pass WHERE id = :id",array('pass'=>$pass1,'id'=>$_SESSION['id']));

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


     <div class="grid_10">
        
            <div class=" box round first grid">
                <h2> Change Password</h2>
                    <div class="col-md-4" style="padding: 10px;">
                        <form action="" method="post">
                            

                            <?php
                                  if(isset($MSG))
                                  {
                                    echo '<i class="fa fa-check-square" aria-hidden="true" style="color:green"> '.$MSG.' </i><br>';
                                  }

                        ?>
                         <?php
                                  if(isset($errMSG))
                                  {
                                    echo '<i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:red"> &nbsp'.$errMSG.' </i><br>';
                                  }

                          ?>

                             <div class="form-group">
                                <label for="pass">Old Password</label>
                                <input type="text" class="form-control" name="pass" placeholder="Old password ...">
                              </div>

                             <div class="form-group">
                                <label for="pass1">New Password</label>
                                <input type="text" class="form-control" name="pass1" placeholder="New password ...">
                              </div>

                             <div class="form-group">
                                <label for="pass2">Confirm Password</label>
                                <input type="text" class="form-control" name="pass2" placeholder="Confirm password ...">
                              </div>


                              <button type="submit" class="btn btn-info" name="changepass">Change</button>
                        </form>

                    </div>

            </div>
        </div>
        
        <div class="clear">
        </div>
    </div>
  <?php include 'footer.php'; ?>