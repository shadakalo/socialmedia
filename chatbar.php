 <div class="col-md-3 ">
  <div class="chat-sidebar focus">
    <div class="list-group text-left">
       <p class="text-center chat-title">Online Users</p>  


<?php
  
   $friends_availability = $db->select("SELECT * FROM friendship WHERE (user1_id = :user1_id OR user2_id = :user2_id) AND status = 1 ",array('user1_id'=>$_SESSION['userid'],'user2_id'=>$_SESSION['userid']));
  
   foreach ($friends_availability as  $value_availability) {
     
        if ($value_availability['user1_id'] != $_SESSION['userid']  ) {
             $frnd_chat = $value_availability['user1_id'];
        }else{
             $frnd_chat = $value_availability['user2_id'];
        }


    $frnd_chat_details = $db->select_one_row("SELECT * FROM users WHERE userid = :userid ",array('userid'=>$frnd_chat));
    $frnd_chat_image   = $db->select_one_row("SELECT * FROM profile_images WHERE user_id = :user_id ",array('user_id'=>$frnd_chat));



?>


    <a href="chat.php?userid=<?php echo base64_encode($frnd_chat_details['userid']); ?>" class="list-group-item">

<?php

  if ($frnd_chat_details['log_status'] == 1 ) {
    echo ' <i class="fa fa-check-circle connected-status"></i>';
  }else{
     echo ' <i class="fa fa-times" aria-hidden="true" ></i>';
  }

?>


<?php

    if ($frnd_chat_image == false) {
      
  ?>
    <img src="images/profileimages/demo.png" class="img-chat img-thumbnail">
  <?php
    }else{
  ?>
      <img src= "<?php echo $frnd_chat_image["profile_image"] ?>" class="img-chat img-thumbnail">
  <?php
    }

?>

         
          
          <span class="chat-user-name"><?php echo $frnd_chat_details['firstname']." ".$frnd_chat_details['lastname'];  ?></span>
       </a>
<?php

   }

?>

    </div>
  </div>
</div>

