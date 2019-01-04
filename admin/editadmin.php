<?php include 'header.php'; ?>


<?php include 'nav.php'; ?>
<div class="clear">
</div>
<?php include 'sidebar.php'; ?>

<?php
 if(isset($_POST['edit'])) 
  {
      
      $name  = $_POST['name'];
      $email = $_POST['email'];
           
       

              if(!empty($name) && !empty($email))
              {

                            
                         
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                           
                          $db->update("UPDATE admin SET name = :name WHERE id = :id",array('name'=>$name,'id'=>$_SESSION['id']));
                          $db->update("UPDATE admin SET email = :email WHERE id = :id",array('email'=>$email,'id'=>$_SESSION['id']));
            

                                $MSG = "Info updated Successfully";


                        }else{
                            $errMSG = "Invalid email address..";
                        }



              }else{

                $errMSG = "Fields can not be empty ...";

              }
       
        
}



$admin_details =  $db->select_one_row("SELECT * FROM admin WHERE id = :id",array('id'=>$_SESSION['id']));

?>


     <div class="grid_10">
        
            <div class="box round first grid">
                <h2> Edit Admin Info</h2>

                <div class="col-md-4" style="padding: 5px;">

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
                                <input type="text" class="form-control" name="name" value="<?php echo $admin_details['name']?>">
                              </div>

                             <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" value="<?php echo $admin_details['email']?>">
                              </div>

                              <button type="submit" class="btn btn-info" name="edit"><i class="fa fa-user-secret" aria-hidden="true"></i> Edit </button>

                        </form>

                    </div>       


            </div>
        </div>
        
        <div class="clear">
        </div>
    </div>
  <?php include 'footer.php'; ?>