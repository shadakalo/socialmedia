<?php include 'header.php'; ?>

    <!--Header End-->

<?php
    //post code
    //post code
    $statusmsg = "";
    if (isset($_POST['post_submit'])) {
      
      $post_text = $_POST['post_text'];
      $user_id   = $_SESSION['userid'];



      $permited  = array('jpg', 'jpeg', 'png', 'gif');
      $file_name = $_FILES['post_image']['name'];
      $file_size = $_FILES['post_image']['size'];
      $file_temp = $_FILES['post_image']['tmp_name'];

      $div = explode('.', $file_name);
      $file_ext = strtolower(end($div));
      $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
      $uploaded_image = "images/postimages/".$unique_image;
      if (empty($file_name) && empty($post_text)) {
        $statusmsg = "<span class = 'post_err'> ( Please Write whatever you wish or upload image )</span>";
      }elseif(empty($file_name) && !empty($post_text)){

            if($db->insert("INSERT INTO posts(user_id, post_text) VALUES(:user_id, :post_text)", array( 'user_id'=>$user_id, 'post_text'=>$post_text)) == false){
                $statusmsg = "Something went wrong try again later";
            }else{
              echo "<script>window.location='profile.php';</script>";
            }

      }else{
        
            if ($file_size >5242880){

              $statusmsg = " <span class = 'post_err'>( Image should be less than 5MB )</span>";

            }elseif (in_array($file_ext, $permited) === false) {

                 $statusmsg = "<span class='error'>( You can upload only:- "
                 .implode(', ', $permited)." )</span>";

           }else{
                
                  if(!empty($file_name) && empty($post_text)){

                      move_uploaded_file($file_temp, $uploaded_image);

                      if($db->insert("INSERT INTO posts(user_id, post_image) VALUES(:user_id, :post_image)", array( 'user_id'=>$user_id, 'post_image'=>$uploaded_image)) == false){
                         $statusmsg = "Something went wrong try again later";
                      }else{
                         echo "<script>window.location='profile.php';</script>";
                      }

                  }elseif (!empty($file_name) && !empty($post_text)) {
                    
                      move_uploaded_file($file_temp, $uploaded_image);

                      if($db->insert("INSERT INTO posts(user_id, post_text, post_image) VALUES(:user_id, :post_text, :post_image)", array( 'user_id'=>$user_id, 'post_text'=>$post_text, 'post_image'=>$uploaded_image)) == false){
                         $statusmsg = "Something went wrong try again later";
                      }else{
                         echo "<script>window.location='newsfeed.php';</script>";
                      }

                  }else{
                    $statusmsg = "Something went wrong try again later";
                  }

           }
      }
    }

    //post code end
    //post code end
 ?> 
<?php
    if (isset($_GET['nid'])) {
    
    $comment_id = base64_decode($_GET['nid']);

    $post_details =  $db->delete("DELETE FROM comment WHERE comment_id = :comment_id",array('comment_id'=>$comment_id));
    
    echo  "<script>window.location='newsfeed.php';</script>";
  }
?>
<?php
   //defining two users nd making the smallest userid user1 
        


  if (isset($_POST['send_request'])) {

         $user3_check = $_SESSION['userid'];
         $user4_check = $_POST['user'];
        if ($user3_check > $user4_check) {
          $helpers->swap($user3_check,$user4_check);
        }


      $status = 0;
      $frnd_req_send = $db->insert('INSERT INTO friendship(user1_id, user2_id, status, action_id) VALUES(:user1_id, :user2_id, :status, :action_id)', array('user1_id'=>$user3_check, 'user2_id'=>$user4_check, 'status'=>$status, 'action_id'=>$_SESSION["userid"]));
        echo "<script>window.location='userprofile.php?userid=".base64_encode($_POST['user'])."';</script>";
     
}




  
   $friends_count = $db->select("SELECT * FROM friendship WHERE (user1_id = :user1_id OR user2_id = :user2_id) AND status = 1 ",array('user1_id'=>$_SESSION['userid'],'user2_id'=>$_SESSION['userid']));


?>

    <!--Main content-->
          <div class="container">
            <div class="row">
              
              <!-- Side Bar Left   -->
              <!-- Side Bar Left   -->
            
                   <div class="col-md-3" style="padding: 30px 0 50px;">
                    <!--profile miniView-->
                      <div class="profile-card">
                        <img src="<?php echo $profile_image_details['profile_image']; ?>" alt="user" class="profile-photo">
                        <h5><a href="profile.php" class="text-white"><?php echo $user_details['firstname'];  ?></a></h5>
                        <a href="friends.php" class="text-white"><i class="ion ion-android-person-add"></i> <?php echo  count($friends_count); ?> Friends</a>
                      </div>
                  <!--profile miniView ends-->

                  <!--news-feed links -->
                     <ul class="nav-news-feed">
                            <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Explore</h3>
                            </div>
                            </div>
                            <li><i class="icon ion-ios-paper"></i>
                                <div><a href="newsfeed.php">My Newsfeed</a></div>
                            </li>
                            <hr>
                            <li><i class="icon ion-android-contacts"></i>
                                <div><a href="friends.php">Friends</a></div>
                            </li>
                            <hr>
                            <li><i class="icon ion-social-instagram"></i>
                                <div><a href="photos.php">Photos</a></div>
                            </li>
                            <hr>
                            <li><i class="icon ion-chatboxes"></i>
                                <div><a href="message.php">Messages</a></div>
                            </li>
                            <hr>
                            <li><i class="icon ion-ios-game-controller-b"></i>
                                <div><a href="game.php">Games</a></div>
                            </li>
                        </ul>
                 <!--news-feed links ends-->
                 <!--chat block --> 
                       <div id="chat-block">
                          <div class="panel panel-info">
                              <div class="panel-heading">
                                  <h3 class="panel-title">People You May Know</h3>
                              </div>


                               <div class="panel-body">
                                  <div class="card">
                                      <div class="content">

                                         <ul class="list-unstyled team-members">
  <?php

    $search_user = $db->select("SELECT * FROM users WHERE  userid != :userid  ORDER BY rand() LIMIT 6 ",array('userid'=>$_SESSION['userid']));


          

    foreach ($search_user as $value_search) {

      //defining two users nd making the smallest userid user1 
        $user1_check = $_SESSION['userid'];
        $user2_check = $value_search['userid'];
        if ($user1_check > $user2_check) {
          $helpers->swap($user1_check,$user2_check);
        }
        //frndcheck & request
        $frnd_details = $db->select_one_row("SELECT * FROM friendship WHERE (user1_id = :user1_id AND user2_id = :user2_id) AND (status = 1 or status = 0)",array('user1_id'=>$user1_check, 'user2_id'=>$user2_check));

          if ($frnd_details['user1_id'] == $_SESSION['userid']) {
            
              $frnd_check = $frnd_details['user2_id'] ;

          }else{
            $frnd_check = $frnd_details['user1_id'] ;
          }
  

            if ($frnd_check != $value_search['userid'] ) {



            




         $search_user_image = $db->select_one_row("SELECT * FROM profile_images WHERE user_id = :user_id ORDER BY profile_image_time DESC",array('user_id'=>$value_search['userid']));

?>
                                            <li>
                                                <div class="row">

                                                    <div class="col-xs-3">
                                                        <div class="avatar">

      <?php

        if ($search_user_image == false) {
          echo '<img src="images/profileimages/demo.png" class="profile-image"> ';
        }else{
          echo '<img src="'.$search_user_image['profile_image'].'" class="img-nav1"> ';
        }

    ?>
                                                        </div>
                                                    </div>

                                                   <a href="userprofile.php?userid=<?php echo base64_encode($value_search["userid"]) ?>"> <div class="col-xs-6"><?php echo $value_search['firstname']." ".$value_search['lastname']  ?></div></a>



                                                    <div class="col-xs-3 text-right">
                                                      <form action="" method="post">
                                                        <input type="text" name="user" hidden value="<?php echo $value_search['userid'] ?>">
                                                        <button type="submit" class="btn btn-sm btn-warning btn-icon" name="send_request"><i class="fa fa-user-plus"></i></button>
                                                      </form>
                                                       
                                                    </div>
                                                </div>
                                            </li>
<?php

}

    }

?>
                                         </ul>
                                      </div>
                                  </div>
                              </div><!--panelbody ends-->

                          </div><!--panel ends-->
                      </div>
                      <!--chat block ends--> 

                   </div>
                <!-- Side Bar Left  end -->
                <!-- Side Bar Left  end -->





                <!-- Newsfeed maincontent  -->


<div class="col-md-7" style="margin-top: 30px;">

<!-- Post Create Box -->
<!-- Post Create Box -->
                      <div class="create-post">
                          <div class="row">
                             <form id="form1" runat="server" action="" method="post" enctype="multipart/form-data"> 
                                  <div class="image-upload">
                                              <label for="file-input">
                                                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="ion-images postimg">&nbsp&nbspAdd Image</i>
                                              </label>
                                   <input id="file-input"  onchange="readU(this);" type="file"  name="post_image" />
                              <?php  

                                if ($statusmsg != "") {
                                  echo $statusmsg;
                                }

                            ?>
                                   </div>
                                <div class="col-md-7 col-sm-7">
                                    <div class="form-group">
                                         <img src="<?php echo $profile_image_details['profile_image']; ?>" alt="" class="profile-photo-md" />
                                        <textarea onkeyup="auto_grow(this)" class="form-control" placeholder="Write what you wish" name="post_text"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                  <div class="tools pull-right">
                                    <button class="btn btn-primary" name="post_submit">Publish</button>
                                  </div>          
                                </div>
                             </form> 
                   
                              <center> <img  id="blah1" class="showpostimg"  /></center>
                          </div>
                      </div>
<!-- Post Create Box End-->
<!-- Post Create Box End-->










<?php

  //comment code 
  //comment code

  if (isset($_POST['comment_submit2'])) {
    
      $comment_text = $_POST['post_comment'];
      $post_id      = $_POST['post_id'];
      $user_id      = $_SESSION['userid'];

      if (empty($comment_text)) {
           echo "<script>alert('comment field can not be empty');</script>";
      }else{
        $db->insert("INSERT INTO comment(`post_id`, `user_id`, `comment_text`) VALUES ( :post_id, :user_id, :comment_text);",array('post_id'=>$post_id, 'user_id'=>$user_id, 'comment_text'=>$comment_text));
      }
  }

    if (isset($_POST['comment_submit1'])) {
    
      $comment_text = $_POST['post_comment'];
      $post_id      = $_POST['post_id'];
      $user_id      = $_SESSION['userid'];

      if (empty($comment_text)) {
           echo "<script>alert('comment field can not be empty');</script>";
      }else{
        $db->insert("INSERT INTO comment(`post_id`, `user_id`, `comment_text`) VALUES ( :post_id, :user_id, :comment_text);",array('post_id'=>$post_id, 'user_id'=>$user_id, 'comment_text'=>$comment_text));
      }
  }

 //comment code 
  //comment code


?>


<?php
  //like dislike code
 //like dislike code


//for like 
if (isset($_POST['like_post'])) {

    $post_id =$_POST['post_id'];
    $like = 0;

    $likes_dislikes = $db->select_one_row("SELECT * from post_like WHERE post_id = :post_id AND user_id = :user_id",array('post_id' => $post_id, 'user_id'=>$_SESSION['userid']));
   
    if ($likes_dislikes == false) {

      
      $db->insert("INSERT INTO post_like(`post_id`, `user_id`, `status`) VALUES ( :post_id, :user_id, :status);",array('post_id'=>$post_id, 'user_id'=>$_SESSION['userid'], 'status'=>$like));

    }elseif($likes_dislikes['status'] != 0 ){
      
       $db->update("UPDATE post_like SET status = 0 WHERE post_id = :post_id AND user_id = :user_id ",array('post_id'=>$post_id, 'user_id'=>$_SESSION['userid']));


    }
}

//for dislike 

if (isset($_POST['dislike_post'])) {

    $post_id =$_POST['post_id'];
    $like = 1;

    $likes_dislikes = $db->select_one_row("SELECT * from post_like WHERE post_id = :post_id AND user_id = :user_id",array('post_id' => $post_id, 'user_id'=>$_SESSION['userid']));
   
    if ($likes_dislikes == false) {

      
      $db->insert("INSERT INTO post_like(`post_id`, `user_id`, `status`) VALUES ( :post_id, :user_id, :status);",array('post_id'=>$post_id, 'user_id'=>$_SESSION['userid'], 'status'=>$like));

    }elseif($likes_dislikes['status'] != 1 ){
      
       $db->update("UPDATE post_like SET status = 1 WHERE post_id = :post_id AND user_id = :user_id ",array('post_id'=>$post_id,'user_id'=>$_SESSION['userid']));


    }
}


//for heart 

if (isset($_POST['heart_post'])) {

    $post_id =$_POST['post_id'];
    $like = 2;

    $likes_dislikes = $db->select_one_row("SELECT * from post_like WHERE post_id = :post_id AND user_id = :user_id",array('post_id' => $post_id, 'user_id'=>$_SESSION['userid']));
   
    if ($likes_dislikes == false) {

      
      $db->insert("INSERT INTO post_like(`post_id`, `user_id`, `status`) VALUES ( :post_id, :user_id, :status);",array('post_id'=>$post_id, 'user_id'=>$_SESSION['userid'], 'status'=>$like));

    }elseif($likes_dislikes['status'] != 2 ){
      
       $db->update("UPDATE post_like SET status = 2 WHERE post_id = :post_id AND user_id = :user_id ",array('post_id'=>$post_id, 'user_id'=>$_SESSION['userid']));


    }
}


//for delete

if (isset($_POST['delete_like'])) {
  
      $post_id =$_POST['post_id'];

      $db->delete("DELETE FROM post_like WHERE post_id = :post_id AND user_id = :user_id",array('post_id' => $post_id, 'user_id'=>$_SESSION['userid']));

}





 //like dislike code end
 //like dislike code end


?>







<?php


  $frnd_post = $db->select("SELECT * FROM friendship WHERE (user1_id = :user1_id OR user2_id = :user2_id) AND status = 1",array('user1_id'=>$_SESSION['userid'],'user2_id'=>$_SESSION['userid']));

    foreach ($frnd_post as $key_fnrd ) {
     
      if ($key_fnrd['user1_id'] == $_SESSION['userid']) {
            
              $key = $key_fnrd['user2_id'] ;

        }else{
          $key = $key_fnrd['user1_id'] ;
        }


        $post_details = $db->select("SELECT * FROM posts WHERE user_id = :user_id ORDER BY post_time DESC",array('user_id'=>$key));

        $post_user_details = $db->select_one_row("SELECT * FROM users WHERE userid = :userid", array('userid'=>$key));

        $post_user_image = $db->select_one_row("SELECT * FROM profile_images WHERE user_id = :user_id", array('user_id'=>$key));








  //post read code start
  

  

  foreach ($post_details as  $value_post) {

     if (empty($value_post['post_image'])) {
?>
<!-- 1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111-->
<!-- Post Content    -->
<!-- Post Content    -->
             <div class="panel panel-default">
                                   <div class="panel-heading" style="background-color: #fff;">
                                        



                                          <div class="post_header">

<?php

    if ($post_user_image == false ) {
      
?>
  <a href="userprofile.php?userid=<?php echo base64_encode($post_user_details['userid']) ?>"><img src="images/profileimages/demo.png" alt="" class="profile-photo-md" /></a>
<?php  
    }else{

?>

  <a href="userprofile.php?userid=<?php echo base64_encode($post_user_details['userid']) ?>"><img src="<?php echo $post_user_image['profile_image']; ?>" alt="" class="profile-photo-md" /></a>
<?php

    }


?>

                                               



                                                    <div>
                                                          <a class="cmnta" href="userprofile.php?userid=<?php echo base64_encode($post_user_details['userid']) ?>" ><span class="post_name"> <?php echo $post_user_details['firstname']." ".$post_user_details['lastname'] ;  ?></span></a><br>
                                                          <span class="post_date">posted at <?php echo facebook_time_ago($value_post['post_time']);  ?></span> 
                                                    </div>

                                           </div>
                                                 <div class="post_content">
                                                         <pre class="post_pre"><?php echo $value_post['post_text'];  ?></pre><hr>
                                                          
                                                  </div>
<?php

     
//like dislike read code
  $like_details = $db->select_one_row("SELECT * from post_like WHERE post_id = :post_id AND user_id = :user_id",array('post_id' => $value_post['post_id'], 'user_id'=>$_SESSION['userid']));


            $row_like = $db->select("SELECT * from post_like WHERE post_id = :post_id AND status = 0",array('post_id' => $value_post['post_id']));

            $row_dislike = $db->select("SELECT * from post_like WHERE post_id = :post_id AND status = 1",array('post_id' => $value_post['post_id']));

            $row_heart = $db->select("SELECT * from post_like WHERE post_id = :post_id AND status = 2",array('post_id' => $value_post['post_id']));

      if ($like_details == false) {
        $flag = 0;
      }
      else{
              
            $flag = 1 ;  
                      
      }

?>
                <form action="" method="post">


                     <?php
                     

                          if ($flag == 1) {
                            
                          

                              if ($like_details['status'] == 0 ) {
                                
                                  echo '<button class="post_like2" name="delete_like"><i class="ion-thumbsup"></i> '.count($row_like).'</a></button>';

                              }else{

                                 echo '<button class="post_like" name="like_post"><i class="ion-thumbsup"></i> '.count($row_like).'</a></button>';
                              }

                              if ($like_details['status'] == 1 ) {
                                
                                  echo '<button class="post_dislike1" name="delete_like"><i class="fa fa-thumbs-down"></i> '.count($row_dislike).'</button>';

                              }else{

                                 echo '<button class="post_dislike" name="dislike_post"><i class="fa fa-thumbs-down"></i> '.count($row_dislike).'</button>';
                              }

                              if ($like_details['status'] == 2 ) {
                                
                                  echo '<button class="post_heart1" name="delete_like"><i class="ion-heart"></i> '.count($row_heart).'</a></button> ';

                              }else{

                                 echo '<button class="post_heart" name="heart_post"><i class="ion-heart"></i> '.count($row_heart).'</a></button> ';
                              }

                          }else{
                              echo '<button class="post_like" name="like_post"><i class="ion-thumbsup"></i> '.count($row_like).'</a></button>';
                              echo '<button class="post_dislike" name="dislike_post"><i class="fa fa-thumbs-down"></i> '.count($row_dislike).'</button>';
                              echo '<button class="post_heart" name="heart_post"><i class="ion-heart"></i> '.count($row_heart).'</a></button> ';
                          }

                     ?>                               


                                                      
                                                      <input type="text" name="post_id" hidden value="<?php echo $value_post['post_id']; ?>">
                                                     
                                                            
                                                      <span>

                                               <?php
                                               
                                                    if ($flag == 0) {
                                                      echo " You haven't liked the post yet";
                                                    }elseif($like_details['status'] == 0 ){

                                                        if (count($row_like) > 2 ) {
                                                            echo "you and ".(count($row_like)-1)."  others liked the post";
                                                        }else{
                                                          echo " you liked the post";
                                                        }  

                                                        

                                                    }elseif ($like_details['status'] == 1 ) {

                                                      if (count($row_dislike) > 2 ) {
                                                            echo "you and ".(count($row_dislike)-1)."  others disliked the post";
                                                        }else{
                                                          echo " you disliked the post";
                                                        }

                                                    }elseif($like_details['status'] == 2){

                                                        if (count($row_heart) > 2 ) {
                                                            echo "you and ".(count($row_heart)-1)."  others reacted to the post";
                                                        }else{
                                                          echo " you reacted to the post";
                                                        }

                                                    }




                                               ?>           


                                                      </span>

                                                </form>

                                              </div>

                                   <div class="panel-body">
                                          <div class="row">
                                              <form id="form1" runat="server" action="" method="post"> 
                                                <div class="col-md-7 col-sm-7">
                                                    <div class="form-group">
                                                        <textarea onkeyup="auto_grow(this)" class="form-control comment_text" placeholder="comment here ..." name="post_comment"></textarea>
                                                        <input type="text" name="post_id" hidden="" value="<?php echo $value_post['post_id']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-sm-5">
                                                  <div class="tools pull-right">
                                                    <button class="btn btn-primary" name="comment_submit2">Comment</button>
                                                  </div>          
                                                </div>
                                             </form> 
                                          </div>
 <?php
//comment read code
  $comment_details = $db->select("SELECT * FROM comment WHERE post_id = :post_id ORDER BY comment_time DESC",array('post_id'=>$value_post['post_id']));
  foreach ($comment_details as $value_comment) {
    $comment_user = $db->select_one_row("SELECT * FROM users WHERE userid = :userid",array('userid'=>$value_comment['user_id']));

    $cmnt_photo = $db->select_one_row("SELECT profile_image FROM profile_images WHERE user_id =:user_id ORDER BY profile_image_time DESC",array('user_id'=>$value_comment['user_id']));

?>
                                            <div class="row">
                                                <div class="comment_div">
<?php

  if ($cmnt_photo == false) {
    
?>
      <a href="

                                                    <?php  
                                                   
                                                          if($comment_user['userid'] == $_SESSION['userid'] ){
                                                              echo "profile.php";
                                                          }else{
                                                            echo "userprofile.php?userid=".base64_encode($comment_user['userid']);
                                                          }


                                                        ?> 

      "><img src="images/profileimages/demo.png" alt="" class="comment-photo" /></a>

<?php
  }else{

?>

  <a href="
                                                    <?php                                           
                                                          if($comment_user['userid'] == $_SESSION['userid'] ){
                                                              echo "profile.php";
                                                          }else{
                                                            echo "userprofile.php?userid=".base64_encode($comment_user['userid']);
                                                          }


                                                        ?> 
  " ><img src="<?php echo $cmnt_photo['profile_image']; ?>" alt="" class="comment-photo" /></a>

<?php

  }

?>
                                                 
                                                      <div class="cmnt_txt">
                                                         <a href="

                                                       <?php  
                                                   
                                                          if($comment_user['userid'] == $_SESSION['userid'] ){
                                                              echo "profile.php";
                                                          }else{
                                                            echo "userprofile.php?userid=".base64_encode($comment_user['userid']);
                                                          }


                                                        ?>     

                                                    " style="font-weight: bolder;" class="cmnta" ><?php echo $comment_user['firstname']?>&nbsp </a>

                                                            <?php echo $value_comment['comment_text']; ?>
                                                            

                                                          <span class="post_date" style="display: block;">
                                                              <i class="fa fa-clock-o" aria-hidden="true"> </i>
                                                              <?php echo facebook_time_ago($value_comment['comment_time']); ?>
<?php
  
  if ($comment_user['userid'] == $_SESSION['userid']) {

?>
                                                              &nbsp &nbsp<a href="newsfeed.php?nid=<?php echo base64_encode($value_comment['comment_id']); ?>" class="cmnta" onclick="return confirm('are you sure ?')"><i class="fa fa-trash" aria-hidden="true"></i></a>


<?php } ?>

                                                          </span>
                                                     </div>
                                              </div>
                                    </div> 
<?php
  }//comment read code
?>
     
                               </div>
                  </div>
                  

<!-- Post Content  end  -->
<!-- Post Content  end -->





<!-- 1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111-->


<?php    
      }else{

?>

<!-- 222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222-->


<!-- Post Content    -->
<!-- Post Content    -->
                  <div class="panel panel-default">
                          <div class="panel-heading" style="background-color: #fff;">
                                 
                                <div class="post_header">
   <?php

    if ($post_user_image == false ) {
      
?>
  <a href="userprofile.php?userid=<?php echo base64_encode($post_user_details['userid']) ?>"><img src="images/profileimages/demo.png" alt="" class="profile-photo-md" /></a>
<?php  
    }else{

?>

  <a href="userprofile.php?userid=<?php echo base64_encode($post_user_details['userid']) ?>"><img src="<?php echo $post_user_image['profile_image']; ?>" alt="" class="profile-photo-md" /></a>
<?php

    }


?>

                                        <div>
                                              <a class="cmnta" href="userprofile.php?userid=<?php echo base64_encode($post_user_details['userid']) ?>" ><span class="post_name"> <?php echo $post_user_details['firstname']." ".$post_user_details['lastname'] ;  ?></span></a><br>
                                              <span class="post_date">Posted at <?php echo facebook_time_ago($value_post['post_time']);  ?></span> 
                                        </div>
                                </div>
                                 <div class="post_content">
                                  <pre class="post_pre"><?php echo $value_post['post_text'];  ?></pre>
                                  <img src="<?php echo $value_post['post_image'];?>" class="post-image">
                                </div><hr>
<?php

     
//like dislike read code
  $like_details = $db->select_one_row("SELECT * from post_like WHERE post_id = :post_id AND user_id = :user_id",array('post_id' => $value_post['post_id'], 'user_id'=>$_SESSION['userid']));

     $row_like = $db->select("SELECT * from post_like WHERE post_id = :post_id AND status = 0",array('post_id' => $value_post['post_id']));

            $row_dislike = $db->select("SELECT * from post_like WHERE post_id = :post_id AND status = 1",array('post_id' => $value_post['post_id']));

            $row_heart = $db->select("SELECT * from post_like WHERE post_id = :post_id AND status = 2",array('post_id' => $value_post['post_id']));


      if ($like_details == false) {
        $flag = 0;
      }
      else{
              
            $flag = 1 ;  
                
      }

?>
  
                          <div>
                              <form action="" method="post">

                                   
                     <?php
                     

                          if ($flag == 1) {
                            


                              if ($like_details['status'] == 0 ) {
                                
                                  echo '<button class="post_like2" name="delete_like"><i class="ion-thumbsup"></i> '.count($row_like).'</a></button>';

                              }else{

                                 echo '<button class="post_like" name="like_post"><i class="ion-thumbsup"></i> '.count($row_like).'</a></button>';
                              }

                              if ($like_details['status'] == 1 ) {
                                
                                  echo '<button class="post_dislike1" name="delete_like"><i class="fa fa-thumbs-down"></i> '.count($row_dislike).'</button>';

                              }else{

                                 echo '<button class="post_dislike" name="dislike_post"><i class="fa fa-thumbs-down"></i> '.count($row_dislike).'</button>';
                              }

                              if ($like_details['status'] == 2 ) {
                                
                                  echo '<button class="post_heart1" name="delete_like"><i class="ion-heart"></i> '.count($row_heart).'</a></button> ';

                              }else{

                                 echo '<button class="post_heart" name="heart_post"><i class="ion-heart"></i> '.count($row_heart).'</a></button> ';
                              }

                          }else{
                              echo '<button class="post_like" name="like_post"><i class="ion-thumbsup"></i> '.count($row_like).'</a></button>';
                              echo '<button class="post_dislike" name="dislike_post"><i class="fa fa-thumbs-down"></i> '.count($row_dislike).'</button>';
                              echo '<button class="post_heart" name="heart_post"><i class="ion-heart"></i> '.count($row_heart).'</a></button> ';
                          }

                     ?>                  
                                    <input type="text" name="post_id" hidden value="<?php echo $value_post['post_id']; ?>">
                                     
                                    <span>

                                               <?php
                                               
                                                    if ($flag == 0) {
                                                      echo "You haven't liked the post yet";
                                                    }elseif($like_details['status'] == 0 ){

                                                        if (count($row_like) > 2 ) {
                                                            echo "you and ".(count($row_like)-1)."  others liked the post";
                                                        }else{
                                                          echo "you liked the post";
                                                        }  

                                                        

                                                    }elseif ($like_details['status'] == 1 ) {

                                                      if (count($row_dislike) > 2 ) {
                                                            echo "you and ".(count($row_dislike)-1)."  others disliked the post";
                                                        }else{
                                                          echo "you disliked the post";
                                                        }

                                                    }elseif($like_details['status'] == 2){

                                                        if (count($row_heart) > 2 ) {
                                                            echo "you and ".(count($row_heart)-1)."  others reacted to the post";
                                                        }else{
                                                          echo "you reacted to the post";
                                                        }

                                                    }




                                               ?>           

                                                      </span>

                                </form>
                                  

                                   
                                </div>
                          </div>
                         <div class="panel-body">
                              <div class="row">
                                  <form id="form1" runat="server" action="" method="post"> 
                                    <div class="col-md-7 col-sm-7">
                                        <div class="form-group">
                                            <textarea onkeyup="auto_grow(this)" class="form-control comment_text" placeholder="comment here ..." name="post_comment"></textarea>
                                            <input type="text" name="post_id" hidden="" value="<?php echo $value_post['post_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-5">
                                      <div class="tools pull-right">
                                        <button class="btn btn-primary" name="comment_submit1">Comment</button>
                                      </div>          
                                    </div>
                                 </form> 
                              </div><hr>
<?php
//comment read code
  $comment_details = $db->select("SELECT * FROM comment WHERE post_id = :post_id ORDER BY comment_time DESC",array('post_id'=>$value_post['post_id']));
  foreach ($comment_details as $value_comment) {

     $comment_user = $db->select_one_row("SELECT * FROM users WHERE userid = :userid",array('userid'=>$value_comment['user_id']));
     $cmnt_photo = $db->select_one_row("SELECT profile_image FROM profile_images WHERE user_id =:user_id ORDER BY profile_image_time DESC",array('user_id'=>$value_comment['user_id']));
 
?>
                               <div class="row">

                                          <div class="comment_div">
<?php

  if ($cmnt_photo == false) {
    
?>
      <a href="

                                                    <?php  
                                                   
                                                          if($comment_user['userid'] == $_SESSION['userid'] ){
                                                              echo "profile.php";
                                                          }else{
                                                            echo "userprofile.php?userid=".base64_encode($comment_user['userid']);
                                                          }


                                                        ?> 

      "><img src="images/profileimages/demo.png" alt="" class="comment-photo" /></a>

<?php
  }else{

?>

  <a href="
                                                    <?php                                           
                                                          if($comment_user['userid'] == $_SESSION['userid'] ){
                                                              echo "profile.php";
                                                          }else{
                                                            echo "userprofile.php?userid=".base64_encode($comment_user['userid']);
                                                          }


                                                        ?> 
  " ><img src="<?php echo $cmnt_photo['profile_image']; ?>" alt="" class="comment-photo" /></a>

<?php

  }

?>
                                              <div class="cmnt_txt">
                                                  
                                                    <a href="

                                                   <?php  
                                               
                                                      if($comment_user['userid'] == $_SESSION['userid'] ){
                                                          echo "profile.php";
                                                      }else{
                                                        echo "userprofile.php?userid=".base64_encode($comment_user['userid']);
                                                      }


                                                    ?>     


                                                    " style="font-weight: bolder;" class="cmnta" ><?php echo $comment_user['firstname']?>&nbsp </a>
                                                    <?php echo $value_comment['comment_text']; ?>
                                                  
                                                  <span class="post_date" style="display: block;">
                                                      <i class="fa fa-clock-o" aria-hidden="true"> </i>
                                                     <?php echo facebook_time_ago($value_comment['comment_time']); ?>
                                                      &nbsp &nbsp<a href="newsfeed.php?nid=<?php echo base64_encode($value_comment['comment_id']); ?>" class="cmnta" onclick="return confirm('are you sure ?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                  </span>
                                              </div>
                                          </div>

                              </div>   


<?php
  }//comment read code
?>
                        </div>
                  </div>
                  

<!-- Post Content  end  -->
<!-- Post Content  end -->
        


<!-- 222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222-->

<?php

}//post foreach end

  }//post if end

       }
?>






</div><!--col-md-7 end-->






                <!-- Newsfeed maincontent  -->

              
            </div><!--main content row end --> 
          </div><!--main content  end --> 



          <!-- Newsfeed Common Side Bar Right  -->
          <!-- Newsfeed Common Side Bar Right  -->
      <?php include 'chatbar.php'; ?>         
            <!-- Newsfeed Common Side Bar Right end -->
            <!-- Newsfeed Common Side Bar Right  end-->



    <!--Main content END-->




<?php include 'footer.php'; ?>
   
    