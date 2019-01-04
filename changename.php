<?php include 'header.php'; ?>  




 <?php



  if(isset($_POST['changename'])) 

  {
      $userid = $_SESSION['userid'];
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];

      if(empty($firstname))
    {
      $errMSG = "Please update your name";
    }

    else 
    {
       
      $user_bio = $db->update("UPDATE users SET firstname=:firstname,lastname=:lastname WHERE userid=:userid",array('firstname'=>$firstname,'lastname'=>$lastname,'userid'=>$userid));
          
         $MSG = "Name Updated Successfully"; 
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
                echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"> '.$errMSG.' </i><br>';
              }

    ?>
        <label>
        First Name :</label>
            <input type="text" name="firstname" class="form-control" placeholder="First Name....">
    </div>
    <div class="form-group">
        <label>Last Name :</label>
            <input type="text" name="lastname" class="form-control" placeholder="Last Name....">
    </div>

     



    <div class="form-group">
            <input type="submit" name="changename" value="UPDATE">
    </div>

    
</form>



</div>            
 <?php include 'chatbar.php'; ?>
 <?php include 'footer.php'; ?>



