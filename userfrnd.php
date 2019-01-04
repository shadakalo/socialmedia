<?php include 'header.php'; ?>
<?php

  if (isset($_GET['userid'])) {
      
      $user2_id = base64_decode($_GET['userid']);


      if ($user2_id == $_SESSION['userid']) {
        echo "<script>window.location='profile.php';</script>";
      }


      //user details
      $user2_details = $db->select_one_row("SELECT * FROM users WHERE userid = :userid",array('userid'=>$user2_id));
      //profile image
      $user2_profile_image = $db->select_one_row("SELECT * FROM profile_images WHERE user_id = :user_id ORDER BY profile_image_time DESC",array('user_id'=>$user2_id));
      //cover image
      $user2_cover_image = $db->select_one_row("SELECT * FROM cover_images WHERE user_id = :user_id ORDER BY cover_image_time DESC",array('user_id'=>$user2_id));

      if ($user2_details == false) {
        echo "something went wrong";
      }
  }
?>

    <!--Main content-->
<div class="container">
            <!-- cover profile and profile nav-->
            <!-- cover profile and profile nav-->

<?php include 'userprofilenav.php'; ?>

          <!-- cover profile and profile nav end-->
          <!-- cover profile and profile nav end-->




          <div class="row main-row">
<?php

//frnd check

if ( $frnd_details['status'] == 1) {
 

?>
            <div class="col-md-11 ">
                
                <div class="panel panel-default">

                  <div class="panel-heading" style="background-color: #fff;padding: 30px;"><div class="panel_info"><i class="fa fa-users" aria-hidden="true"></i>&nbsp<span class="panel_header_text"> Friends</span></div></div>

                        <div class="panel-body">
 <?php

 //friend code

  $frnds = $db->select("SELECT * FROM friendship WHERE (user1_id = :user1_id OR user2_id = :user2_id) AND status = 1",array('user1_id'=>$user2_id,'user2_id'=>$user2_id));

    foreach ($frnds as  $value_frnds) {

        $user1_id  = $value_frnds['user1_id'];
        $user_id  = $value_frnds['user2_id'];

        if ($user1_id == $_SESSION['userid']) {
          $user1_id  = $value_frnds['user1_id'];
          $user_id  = $value_frnds['user2_id'];
        }else{

          $user1_id  = $value_frnds['user2_id'];
          $user_id  = $value_frnds['user1_id'];

        }

      $frnd_photo = $db->select_one_row("SELECT profile_image FROM profile_images WHERE user_id =:user_id ORDER BY profile_image_time DESC",array('user_id'=>$user1_id));

      $frnd_details = $db->select_one_row("SELECT * FROM users WHERE userid = :userid",array('userid'=>$user1_id));

      
      
  ?>



                               <div class="col-md-5 frnd-panel">
  <?php

      if ($frnd_photo == false) {
 
         echo '<a href="userprofile.php?userid='.base64_encode($user2_id).'"><img class="friend_image" src="images/profileimages/demo.png"></a>';
 
      }else{

        echo '<a href="userprofile.php?userid='.base64_encode($user2_id).'"><img class="friend_image" src="'.$frnd_photo['profile_image'].'"></a>';

      }

  ?>
                                    
                                      <div class="frnd-det">
                                          <a class="frnd-name info3" href="userprofile.php?userid=<?php echo base64_encode($user2_id); ?>"><?php echo $frnd_details['firstname']." ".$frnd_details['lastname']; ?></a><br>
                                         
                                      </div>
                                </div>

 <?php
    }

 ?>                               
                                
                               
                                
                          </div>

                  </div>
                    



           
                    



             
            </div>
          </div>

<?php
//unfriend code

if (isset($_POST['unfriend'])) {


   $userS = $_SESSION['userid'];
   $userF = $_POST['user2'];

    if ($userS > $userF) {
        $helpers->swap($userS,$userF);
    }

    

 $db->delete("DELETE FROM friendship WHERE user1_id = :user1_id AND user2_id = :user2_id", array('user1_id'=>$userS, 'user2_id'=>$userF));
 echo "<script>window.location='friends.php';</script>";

}

?>










<?php

}else{

  

             

                echo '<center><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '.$user2_details['firstname']." ".$user2_details['lastname']." is not your friend ...</center>";

    
  

}//frnd check end

?>




          <!-- Newsfeed Common Side Bar Right  -->
          <!-- Newsfeed Common Side Bar Right  -->
<?php include 'chatbar.php'; ?>         
            <!-- Newsfeed Common Side Bar Right end -->
            <!-- Newsfeed Common Side Bar Right  end-->


   
          </div><!--main content  end --> 
    <!--Main content END-->

<?php include 'footer.php'; ?>
