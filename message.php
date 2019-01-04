<?php include 'header.php'; ?>

    <!--Main content-->
      <div class="container message-container">
            <!-- cover profile and profile nav-->
            <!-- cover profile and profile nav-->


            <div class="col-md-11">
              

                <div class="col-md-4" >
                  <div class="panel panel-default">
                       <div class="panel-heading"><i class="fa fa-list" aria-hidden="true"></i>Chat List</div>
<?php

  $chat_list = $db->select("SELECT * FROM chat_user WHERE user_1 = :user_1 OR user_2 = :user_2 ",array('user_1'=>$_SESSION['userid'],'user_2'=>$_SESSION['userid']));

  if (count($chat_list) != 0) {
 
  foreach ($chat_list as $key_list) {
      
        if ($key_list['user_1'] == $_SESSION['userid']) {
          
            $user_1 = $key_list['user_1'];
            $user_2 = $key_list['user_2'];

        }else{

            $user_1 = $key_list['user_2'];
            $user_2 = $key_list['user_1'];
        }


   $chat_user_det = $db->select_one_row("SELECT * FROM users WHERE userid = :userid",array('userid'=>$user_2));
   $chat_user_img = $db->select_one_row("SELECT * FROM profile_images WHERE user_id = :user_id",array('user_id'=>$user_2));



?>

        <div class="list">
          <a href="message.php?userid=<?php echo $user_2 ?>">    <div class="panel-body">

<?php

  if ($chat_user_img == false) {
?>  
  <img src="images/profileimages/demo.png" class="img-nav">
<?php
  }else{
?>
<img src="<?php echo $chat_user_img['profile_image'] ?>" class="img-nav">
<?php
  }

?>
                




                  <?php echo $chat_user_det['firstname']." ".$chat_user_det['lastname'] ?> 
              </div></a>

</div>



<?php
    } 
  }else{
    echo "no chat histry";
  } 

?>                   
                       </div>

                </div>


<?php

  if (isset($_GET['userid'])) {
    
   $user3 = $_GET['userid'];

   $user4 = $_SESSION['userid'];

   if ($user3>$user4) {
     
        $helpers->swap($user3,$user4);

   }

    $chat_histry = $db->select("SELECT * FROM chat WHERE user_1 = :user_1 AND user_2 = :user_2 ORDER BY chat_time DESC ",array('user_1'=>$user3,'user_2'=>$user4));

    $frnd_chat_image   = $db->select_one_row("SELECT * FROM profile_images WHERE user_id = :user_id ",array('user_id'=>$user4));
  

?>




                <div class="col-md-7">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <i class="fa fa-clock-o" aria-hidden="true"></i>Chat History 
                      <a style="float: right;font-size: 20px; color: #fff;" href="chat.php?userid=<?php echo base64_encode($_GET['userid']) ?>"><i class="fa fa-commenting-o" aria-hidden="true" ></i></a>
                    </div>
                    <div class="panel-body">
                      <ul>
<?php
  foreach ($chat_histry as $key ) {
  
   
?>


                
                     <li>
<?php

  if ($key['actionid'] == $_SESSION['userid']) {
?>

      

                      <?php

                        if ($profile_image_details == false) {
                      ?>
                        <img class="img1" src="images/profileimages/demp.png">
                      <?php
                      }else{

                      ?>
                      <img class="img1" src="<?php echo  $profile_image_details['profile_image'] ?>">
                      <?php
                        }

                      ?>







<?php
  }else{
?>

      <?php
  
        if ($frnd_chat_image == false) {
          
      ?>  
         <img class="img1" src="images/profileimages/demo.png">
      <?php 
        }else{
      ?>
         <img class="img1" src="<?php echo $frnd_chat_image['profile_image'] ?>">
      <?php

        }

      ?>




<?php


  }
?>
                         <span class="text-history"><?php  echo  wordwrap($key['content'], 28, "\n", true);?> </span>
                         <span class="date-history"><?php  echo facebook_time_ago($key['chat_time']); ?> </span>

                  </li>




<?php
  }
}else{
  echo "<span class='info5' style='position:relative;top:10px;'>( select chat history ) </span>";
}

?>
                      </ul>
                    </div>
                  </div>
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


  

  
   
    
