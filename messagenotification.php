<?php include 'header.php'; ?>

    <!--Main content-->
      <div class="container">
            <!-- cover profile and profile nav-->
            <!-- cover profile and profile nav-->

<?php include 'profilenav.php'; ?>

          <!-- cover profile and profile nav end-->
          <!-- cover profile and profile nav end-->

        <div class="col-md-11 rel" style="padding: 0px;">
          <div class="panel panel-default msg-not-panel">
            <div class="panel-heading"><i class="fa fa-comments-o info5" aria-hidden="true">&nbsp&nbsp Messages Notifications</i>
           
              
                  <?php  


  $pending = $db->select("SELECT * FROM chat_notification WHERE (user_1 = :user_1 OR user_2 = :user_2)  AND actionid != :actionid",array('user_1'=>$_SESSION['userid'],'user_2'=>$_SESSION['userid'],'actionid'=>$_SESSION['userid']));


  if(count($pending) == 0){
    echo "<span style='padding:5px;'><i class='fa fa-exclamation-triangle' aria-hidden='true'>&nbsp No notification to show</i>&nbsp <i class='fa fa-exclamation-triangle' aria-hidden='true'> </i></span>";
   } 


  if (count($pending) > 0 ) {
   
?>

  <a class="pull-right msg-not-del" href="deletenotification.php?di=delall"><i class="fa fa-ban" aria-hidden="true"> Delete All</i></a>

      </div>
   <div class="panel-body">

<?php
      foreach ($pending as  $value_pending) {
       

          $pending_user = $db->select_one_row("SELECT * FROM users WHERE userid = :userid ",array('userid'=>$value_pending['actionid']));
          $pending_user_image = $db->select_one_row("SELECT * FROM profile_images WHERE user_id = :user_id ",array('user_id'=>$value_pending['actionid']));
?>
        <div class="msg-not-div">

            <a class="msg-not-a"  href="chat.php?userid=<?php echo base64_encode($value_pending['actionid']) ?>">

      <?php

        if ($pending_user_image == false) {
         
          echo ' <img src="images/profileimages/demo.png" class="img-nav msg-img">  ';

        }else{
      ?>
          
           <img src="<?php echo $pending_user_image['profile_image'] ?>" class="img-nav msg-img">

      <?php
        }

      ?>
           

              <?php echo $pending_user['firstname']." ".$pending_user['lastname'] ?></a><span class="msg-not-text"> sent you message </span>
             <span class="msg-not-time"> <?php echo facebook_time_ago($value_pending['send_time']); ?> .</span>
              &nbsp&nbsp<a class="msg-not-a" href="deletenotification.php?id=<?php echo $value_pending['id']  ?>"><i class="fa fa-ban" aria-hidden="true"></i></a>
            
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


  

  
   
    
