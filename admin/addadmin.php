<?php include 'header.php'; ?>


<?php include 'nav.php'; ?>
<div class="clear">
</div>
<?php include 'sidebar.php'; ?>


 <?php



  if(isset($_POST['add'])) 
  {
      
      $name  = $_POST['name'];
      $email = $_POST['email'];
      $pass1 = $_POST['pass1'];
      $pass2 = $_POST['pass2'];

      $admin_check =  $db->select("SELECT * FROM admin WHERE email = :email",array('email'=>$email));

        if (count($admin_check) == 0) {
       
       

              if(!empty($name) && !empty($email) && !empty($pass1) && !empty($pass2))
              {



                     if (strlen($pass1) >= 6 ) {

                                    if ($pass1 == $pass2) {
                                     
                                             
                                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                               
                                                $pass1 = sha1(md5($pass1));

                                                $db->insert('INSERT INTO admin(name, email, pass) VALUES(:name, :email, :pass)', array('name'=>$name, 'email'=>$email, 'pass'=>$pass1));

                                                    $MSG = "New Admin Assigned Successfully";

                                            }else{
                                                $errMSG = "Invalid email address..";
                                            }




                                    }else{
                                        $errMSG = "confirm password doesn't match";
                                    }
                         

                        }else{

                           $errMSG = "Password must contain 6 digits";

                        }



              }else{

                $errMSG = "Fields can not be empty ...";

              }
        }else{

             $errMSG = "Email already exists ...";


        }

        
}

?>


     <div class="grid_10">
        
            <div class=" box round first grid">
                <h2> Add Admin</h2>
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
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Full Name ...">
                              </div>

                             <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Email ...">
                              </div>

                             <div class="form-group">
                                <label for="pass1">Password</label>
                                <input type="password" class="form-control" name="pass1" placeholder="password ...">
                              </div>

                              <div class="form-group">
                                <label for="pass2">Confirm Password</label>
                                <input type="password" class="form-control" name="pass2" placeholder="Confirm password ...">
                              </div>


                              <button type="submit" class="btn btn-info" name="add"><i class="fa fa-user-secret" aria-hidden="true"></i> Add Admin</button>

                        </form>

                    </div>

            </div>
        </div>
        
        <div class="clear">
        </div>
    </div>
  <?php include 'footer.php'; ?>