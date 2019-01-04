<?php include 'header.php'; ?>

    <!--Main content-->
      <div class="container">
            <!-- cover profile and profile nav-->
            <!-- cover profile and profile nav-->

<?php include 'profilenav.php'; ?>

          <!-- cover profile and profile nav end-->
          <!-- cover profile and profile nav end-->



          <div class="row main-row">
            <div class="col-md-11 ">
            

            		<?php
 //photos code
      $photos = $db->select("SELECT * FROM profile_images WHERE user_id = :user_id ORDER BY profile_image_time DESC ",array('user_id' => $_SESSION['userid']));
      $photos2 = $db->select("SELECT * FROM cover_images WHERE user_id = :user_id ORDER BY cover_image_time DESC ",array('user_id' => $_SESSION['userid']));
      $photos3 = $db->select("SELECT * FROM posts WHERE user_id = :user_id ORDER BY post_time DESC",array('user_id' => $_SESSION['userid']));

 ?>     	

 				<div class="panel panel-default">
					<div class="panel-heading "  style="background-color: #fff;"><i class="fa fa-picture-o info5" aria-hidden="true">&nbsp&nbspProfile Images</i></div>
					<div class="panel-body">
<?php

        if (count($photos) == 0) {
          
          echo "No photos to show";

        }

      foreach ($photos as $value_photos) {

 ?>


 						
						  <a href="deletephoto.php?pid=<?php  echo $value_photos['profile_image_id'] ?>" onclick="return confirm('Are you sure ? you want to delete photo ??')"><img class="photo-a" src="<?php echo $value_photos['profile_image']; ?>"></a>
						
 						

<?php

	}

?>
					</div>
				</div>




				<div class="panel panel-default">
					<div class="panel-heading"  style="background-color: #fff;"><i class="fa fa-picture-o info5" aria-hidden="true">&nbsp&nbspCover Images</i></div>
				<div class="panel-body">
 <?php       
      
      if (count($photos2) == 0) {
          
          echo "No photos to show";

        }

      foreach ($photos2 as $value_photos2) {

 ?>                 
          <a href="deletephoto.php?cid=<?php  echo $value_photos2['cover_image_id'] ?>" onclick="return confirm('Are you sure ? you want to delete photo ??')"> <img class="photo-a" src="<?php echo $value_photos2['cover_image']; ?>"></a>


<?php

	}

?>						

					</div>
					
				</div>
           
				<div class="panel panel-default">
					<div class="panel-heading"  style="background-color: #fff;"><i class="fa fa-picture-o info5" aria-hidden="true">&nbsp&nbspPost Images</i></div>
					<div class="panel-body">
						
 <?php       

        
        $count = 0;
      foreach ($photos3 as $value_photos3) {




          if (isset($value_photos3['post_image'])) {
           
            $count++;

 ?>                 
           <img class="photo-a" src="<?php echo $value_photos3['post_image']; ?>">

<?php       

    }

      }
      if ($count == 0) {
          
          echo "No photos to show";

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


  

  
   
    
  