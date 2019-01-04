<?php include 'header.php'; ?>

    <!--Main content-->
      <div class="container">
            <!-- cover profile and profile nav-->
            <!-- cover profile and profile nav-->

<?php include 'profilenav.php'; ?>

          <!-- cover profile and profile nav end-->
          <!-- cover profile and profile nav end-->


 $frnd_post = $db->select("SELECT * FROM friendship WHERE (user1_id = :user1_id OR user2_id = :user2_id) AND status = 1",array('user1_id'=>$_SESSION['userid'],'user2_id'=>$_SESSION['userid']));

    foreach ($frnd_post as $key_fnrd ) {
     
      if ($key_fnrd['user1_id'] == $_SESSION['userid']) {
            
              $key = $key_fnrd['user2_id'] ;

        }else{
          $key = $key_fnrd['user1_id'] ;
        }


        $post_details = $db->select("SELECT * FROM posts WHERE user_id = :user_id  ORDER BY post_time DESC",array('user_id'=>$key));

    }




<input type="text" class="form-control" name="search" placeholder="Search..." autocomplete="off" type="text">
                <span class="input-group-addon" style="width:1%;">
                <input type="submit" name="search-text" value="search"><span class="glyphicon glyphicon-search"></span> 
                </span>


          <!-- Newsfeed Common Side Bar Right  -->
          <!-- Newsfeed Common Side Bar Right  -->
      <?php include 'chatbar.php'; ?>         
            <!-- Newsfeed Common Side Bar Right end -->
            <!-- Newsfeed Common Side Bar Right  end-->


   
          </div><!--main content  end --> 
    <!--Main content END-->

<?php include 'footer.php'; ?>


  

  
   
    
