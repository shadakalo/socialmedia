<?php include 'header.php'; ?>

    <!--Main content-->
      <div class="container">
            <!-- cover profile and profile nav-->
            <!-- cover profile and profile nav-->

<?php include 'profilenav.php'; ?>

          <!-- cover profile and profile nav end-->
          <!-- cover profile and profile nav end-->
<?php

//cancelling request//unfriend
if (isset($_POST['cancel_request'])) {

    $user1 = $_POST['user1'];
    $user2 = $_POST['user2'];

    $frnd_req_cancel = $db->delete("DELETE FROM friendship WHERE user1_id = :user1_id AND user2_id = :user2_id", array('user1_id'=>$user1, 'user2_id'=>$user2));
    echo "<script>window.location='notification.php';</script>";
}


//accepting request
if (isset($_POST['confirm_request'])) {

    $user1 = $_POST['user1'];
    $user2 = $_POST['user2'];
  
  $frnd_req_confirm = $db->update("UPDATE friendship SET status = 1 WHERE user1_id = :user1_id AND user2_id = :user2_id", array('user1_id'=>$user1, 'user2_id'=>$user2));
   echo "<script>window.location='notification.php';</script>";
}


?>

<div class="col-md-11 rel" style="padding: 0px; " >
  <div class="panel panel-default msg-not-panel">
  

<?php  


  $pending = $db->select("SELECT * FROM friendship WHERE (user1_id = :user1_id OR user2_id = :user2_id) AND status = 0 AND action_id != :action_id",array('user1_id'=>$_SESSION['userid'],'user2_id'=>$_SESSION['userid'],'action_id'=>$_SESSION['userid']));

?>

  <div class="panel-heading"><i class="fa fa-comments-o info5" aria-hidden="true">&nbsp&nbsp Friend Requests</i>

<?php

    if (count($pending) == 0 ) {
       echo "<span style='padding:5px;'><i class='fa fa-exclamation-triangle' aria-hidden='true'>&nbsp No requests to show</i>&nbsp <i class='fa fa-exclamation-triangle' aria-hidden='true'> </i></span>";
    }

?>

  </div>

  



<?php
  if (count($pending) > 0 ) {
  ?>
      <div class="panel-body">
<?php
      foreach ($pending as  $value_pending) {
       

          $pending_user = $db->select_one_row("SELECT * FROM users WHERE userid = :userid ",array('userid'=>$value_pending['action_id']));
          $pending_user_image = $db->select_one_row("SELECT * FROM profile_images WHERE user_id = :user_id ",array('user_id'=>$value_pending['action_id']));
?>
          <div style="display: flex;" class="msg-not-div">

            <a class="msg-not-a" href="userprofile.php?userid=<?php echo base64_encode($value_pending['action_id']) ?>"><div>

      <?php

        if ($pending_user_image == false) {
         
          echo ' <img src="images/profileimages/demo.png" class="img-nav msg-img">';

        }else{
      ?>
          
           <img src="<?php echo $pending_user_image['profile_image'] ?>" class="img-nav msg-img">

      <?php
        }

      ?>
           

              <?php echo $pending_user['firstname']." ".$pending_user['lastname'] ?>

             
            </div></a>
           
            <span class="frnd-not-text">sent you friend request  </span>
             <form action="" method="post">
                <input type="text" name="user1" hidden="" value="<?php echo $value_pending['user1_id']  ?>">
                <input type="text" name="user2" hidden="" value="<?php echo $value_pending['user2_id']  ?>">
                <button class="btn btn-frnd-accept" name="confirm_request"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                <button class="btn btn-frnd-cancel" name="cancel_request"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
            </form>

          </div>





<?php
      }

   }

?>


</div>

  </div>
      </div>
          <!-- Newsfeed Common Side Bar Right  -->
          <!-- Newsfeed Common Side Bar Right  -->
      <?php include 'chatbar.php'; ?>         
            <!-- Newsfeed Common Side Bar Right end -->
            <!-- Newsfeed Common Side Bar Right  end-->


   
          </div><!--main content  end --> 
    <!--Main content END-->

<?php include 'footer.php'; ?>


  

  
   
    
