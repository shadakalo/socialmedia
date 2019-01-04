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

      if ( $frnd_details['status'] != 1){

      echo '<center><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '.$user2_details['firstname']." ".$user2_details['lastname']." is not your friend ...</center>";

  }//frnd check end
  ?>
<?php


  if ( $frnd_details['status'] == 1){

        
     

?>



            <div class="col-md-11 ">
            
 <?php
 //photos code
      $photos = $db->select("SELECT * FROM profile_images WHERE user_id = :user_id ORDER BY profile_image_time DESC ",array('user_id' => $user2_id));
      $photos2 = $db->select("SELECT * FROM cover_images WHERE user_id = :user_id ORDER BY cover_image_time DESC ",array('user_id' => $user2_id));
      $photos3 = $db->select("SELECT * FROM posts WHERE user_id = :user_id ORDER BY post_time DESC",array('user_id' => $user2_id));

 ?>       

        <div class="panel panel-default">
          <div class="panel-heading"  style="background-color: #fff;"><i class="fa fa-picture-o info5" aria-hidden="true">&nbsp&nbspProfile Images</i></div>
          <div class="panel-body">



                  <?php

                      if ($photos == false) {
                        echo "No photos to show";
                      }


                  ?>


<?php

      foreach ($photos as $value_photos) {

 ?>


            
              <img class="photo-a" src="<?php echo $value_photos['profile_image']; ?>">
            
            

<?php

  }

?>
          </div>
        </div>




        <div class="panel panel-default">
          <div class="panel-heading"  style="background-color: #fff;"><i class="fa fa-picture-o info5" aria-hidden="true">&nbsp&nbspCover Images</i></div>
          <div class="panel-body">

            <?php

                      if ($photos2 == false) {
                        echo "No photos to show";
                      }


            ?>
 <?php       
      
      foreach ($photos2 as $value_photos2) {

 ?>                 
           <img class="photo-a" src="<?php echo $value_photos2['cover_image']; ?>">


<?php

  }

?>            

          </div>
          
        </div>
           
        <div class="panel panel-default">
          <div class="panel-heading"  style="background-color: #fff;"><i class="fa fa-picture-o info5" aria-hidden="true">&nbsp&nbspPost Images</i></div>
          <div class="panel-body">
            <?php

                      if ($photos3 == false) {
                        echo "No photos to show";
                      }


                  ?>
            
 <?php       

      

      foreach ($photos3 as $value_photos3) {

          if (isset($value_photos3['post_image'])) {
           
          

 ?>                 
           <img class="photo-a" src="<?php echo $value_photos3['post_image']; ?>">

<?php       

    }

      }

    }
?>

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


  

  
