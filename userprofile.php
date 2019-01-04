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




if (isset($_GET['ccid'])) {
    
    $comment_id = base64_decode($_GET['ccid']);
    $user2_id   = base64_decode($_GET['userid']);
    $post_details =  $db->delete("DELETE FROM comment WHERE comment_id = :comment_id",array('comment_id'=>$comment_id));

    echo "<script>alert('comment Deleted');</script>";
    echo  "<script>window.location='userprofile.php?userid=".base64_encode($user2_id)."';</script>";
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
if ( $frnd_details['status'] != 1){

    echo '<center><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '.$user2_details['firstname']." ".$user2_details['lastname']." is not your friend ...</center>";

}//frnd check end

if ( $frnd_details['status'] == 1) {
 

?>


 
           
           
    <div class="col-md-4">


          <div class="panel panel-default ">
                 <div class="panel-heading" style="background-color: #fff;"><div class="panel_info"><i class="fa fa-user-circle " aria-hidden="true"></i> &nbsp<span class="panel_header_text"><a class="details-a" href="userabout.php?userid=<?php echo base64_encode($user2_id); ?>">Intro</a></span></div>
<?php
    //bio code start
    //bio code start
    $user_bio =  $db->select("SELECT * FROM bio WHERE userid = :userid ",array('userid'=>$user2_id));
    if (count($user_bio) == 0) {
?>
     <center style="padding: 0px 20px;" > User has no bio  </center>
<?php
    }else{
      foreach ($user_bio as  $value_bio) {
?>

   <center style="padding: 0px 20px;"> <?php echo $value_bio['biotext'];  ?>  </center>              
<?php


      }

    }
     //bio code start end
    //bio code start  end

?>
                    
                 </div>
                  <div class="panel-body">
                      <ul class="information">
                  

<?php 

    // work code start
    // work code start

  $about = 0 ;

  $user_works =  $db->select("SELECT * FROM work WHERE userid = :userid ORDER BY work_status DESC ",array('userid'=>$user2_id));
  if (count($user_works) == 0) {

    $about = 1;

  }else{

      foreach ($user_works as  $value) {

        if ($value['work_status'] == 0) {
?>  
           <li><i class="fa fa-briefcase info" aria-hidden="true"></i>&nbsp&nbsp<span class="info2">Former <?php echo $value['designation']; ?> at&nbsp </span><span class="info"><?php echo $value['company']; ?></Span></li> 


<?php   }else{ ?>
      
            <li><i class="fa fa-briefcase info" aria-hidden="true"></i>&nbsp&nbsp <span class="info2"><?php echo $value['designation']; ?> at&nbsp </span><span class="info"><?php echo $value['company']; ?></Span></li> 

<?php  } } }
    //work code end 
    //work code end 
?>


<?php 

  // Education code start
  // Education code start


  $user_education =  $db->select("SELECT * FROM education WHERE userid = :userid ORDER BY edu_status DESC ",array('userid'=>$user2_id));
  if (count($user_education) == 0) {

      $about = $about + 1 ;

  }else{

      foreach ($user_education as  $value) {

        if ($value['edu_status'] == 0) {
?>  
            <li><i class="fa fa-graduation-cap info" aria-hidden="true"></i>&nbsp&nbsp<span class="info2">Studied (<?php echo $value['degree']; ?>) in <?php echo $value['subject']; ?> at&nbsp </span><span class="info"><?php echo $value['institute']; ?></Span></li>   


<?php }else{ ?>
      
                   <li><i class="fa fa-book info" aria-hidden="true"></i>&nbsp&nbsp <span class="info2">Studies  (<?php echo $value['degree']; ?>)  in <?php echo $value['subject']; ?> at&nbsp </span><span class="info"><?php echo $value['institute']; ?></Span></li>   

<?php  } } }
    //Education code end
    //Education code end
 ?>
<?php
  
    //othersinfo code 
    //othersinfo code 
  $user_other =  $db->select("SELECT * FROM other_info WHERE userid = :userid ",array('userid'=>$user2_id));
  if (count($user_other) == 0){
 
      $about = $about + 1 ;

  }else{

      foreach ($user_other as $value_other) {

  ?>
<?php
    if ($value_other['livesin']!="") {
 ?>  
       <li> <i class="fa fa-home info" aria-hidden="true"></i>&nbsp&nbsp<span class="info2">Lives in </span><span class="info"> <?php echo $value_other['livesin'];  ?></span></li>
<?php
    }

    if ($value_other['comesfrom']!="") {
?>
    <li><i class="fa fa-globe info" aria-hidden="true"></i>&nbsp&nbsp<span class="info2">From </span><span class="info"> <?php echo $value_other['comesfrom'];  ?></span></li>

<?php   } ?>
     
      <li><i class="fa fa-heart info" aria-hidden="true"></i>&nbsp&nbsp<span class="info2"><?php echo $value_other['relationship'];  ?></span></li>
   
  <?php
      }
  }


      if ($about == 3) {
        echo '<i class="fa fa-info-circle" aria-hidden="true"> </i>&nbsp No info to show';
      }


    //othersinfo code end
    //othersinfo code end
?>
                     </ul>
                </div>
            </div>


<!--Friends panel-->   
<!--Friends panel--> 
              <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #fff;"><div class="panel_info"><i class="fa fa-users" aria-hidden="true"></i>&nbsp<span class="panel_header_text"> <a class="details-a" href="friends.php">Friends</a></span></div></div>
                    <div class="panel-body">
                        <center>
<?php
//temporary user code
  
  $users_friendlist = $db->select("SELECT * FROM friendship WHERE (user1_id = :userid OR user2_id = :userid) AND status = 1 ",array('userid'=>$user2_id));
  
if ($users_friendlist) {
    
  foreach ($users_friendlist as  $value_friendlist) {
        if ($value_friendlist['user1_id'] != $user2_id  ) {
             $frndid = $value_friendlist['user1_id'];
        }else{
             $frndid = $value_friendlist['user2_id'];
        }

       $frnd_details =  $db->select_one_row("SELECT * FROM users WHERE userid = :userid",array('userid'=>$frndid));

      $frnd_photo = $db->select_one_row("SELECT profile_image FROM profile_images WHERE user_id =:user_id ORDER BY profile_image_time DESC",array('user_id'=>$frndid));
?>

         <a href="userprofile.php?userid=<?php echo base64_encode($frnd_details['userid']); ?>">
              <div class="imagediv">
  
        <?php

            if ($frnd_photo == false) {
             echo '<img src="images/profileimages/demo.png" class="frnd-img" >';
            }else{
              echo '<img src="'.$frnd_photo['profile_image'].'" class="frnd-img" >';
            }

        ?>

             
               <p class="imgtxt"><?php echo $frnd_details['firstname']; ?>
              </p>
            </div>
         </a>

<?php

  }  

}else{
  echo "<span style='color:#A07A9D;font-size: 13px;'>No friends to show</span>";
}
?>
                      </center>
                    </div>
            </div>
<!--Friends panel end-->   
<!--Friends panel end-->   
            <div class="panel panel-default">
              <div class="panel-heading" style="background-color: #fff;"><div class="panel_info"><i class="fa fa-camera-retro" aria-hidden="true"></i>&nbsp<span class="panel_header_text"><a class="details-a" href="photos.php"> Photos</a></span></div></div>
              <div class="panel-body">

 <?php
 //photos code

      $user_image = 0;

      $photos = $db->select("SELECT * FROM profile_images WHERE user_id = :user_id ORDER BY profile_image_time DESC LIMIT 3",array('user_id' => $user2_id));
      $photos2 = $db->select("SELECT * FROM cover_images WHERE user_id = :user_id ORDER BY cover_image_time DESC LIMIT 3",array('user_id' => $user2_id));
      $photos3 = $db->select("SELECT * FROM posts WHERE user_id = :user_id ORDER BY post_time DESC LIMIT 3",array('user_id' => $user2_id));
      foreach ($photos as $value_photos) {

        $user_image = 1;
 ?>


            <img class="photo" src="<?php echo $value_photos['profile_image']; ?>">

 <?php       

      }

      foreach ($photos2 as $value_photos2) {
        $user_image = 1;
 ?>                 
           <img class="photo" src="<?php echo $value_photos2['cover_image']; ?>">

 <?php       

      }

      foreach ($photos3 as $value_photos3) {

          if (isset($value_photos3['post_image'])) {
           
            $user_image = 1;

 ?>                 
           <img class="photo" src="<?php echo $value_photos3['post_image']; ?>">

<?php       

    }

      }


      if ($user_image == 0) {
        echo '<i class="fa fa-file-image-o" aria-hidden="true"></i>&nbsp No photos to show ';
      }


?>



            </div>
            </div>


         
        </div><!--col-md-4  end --> 


<div class="col-md-7">




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
  //post read code start
  $post_details = $db->select("SELECT * FROM posts WHERE user_id = :user_id ORDER BY post_time DESC",array('user_id'=>$user2_id));

  if (count($post_details) == 0 ) {
     echo "<center>Your friend has not Posted yet</center>";
  }


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
  if ($user2_profile_image == (false or 0)) {
   
?>
<img src="images/profileimages/demo.png" alt="" class="profile-photo-md" />
<?php

  }else{
    ?>
    <img src="<?php echo $user2_profile_image['profile_image']; ?>" alt="" class="profile-photo-md" />
  <?php
  }

?>
                                 
                                                    <div>
                                                          <span class="post_name">  <?php echo $user2_details['firstname']." ".$user2_details['lastname'];  ?></span><br>
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

        if  ($comment_user['userid'] == $_SESSION['userid']) {
   ?>     
                               &nbsp &nbsp<a href="userprofile.php?ccid=<?php echo base64_encode($value_comment['comment_id']);?>&userid=<?php echo base64_encode($user2_id);?>" class="cmnta" onclick="return confirm('are you sure ?')"><i class="fa fa-trash" aria-hidden="true"></i></a>

<?php
         }else{
          echo " ";
         }


    ?>
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
                                   <img src="<?php echo $user2_profile_image['profile_image']; ?>" alt="" class="profile-photo-md" />
                                        <div>
                                              <span class="post_name"> <?php  echo $user2_details['firstname']." ".$user2_details['lastname'];  ?></span><br>
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
                                                          $del = 1;
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

        if  ($comment_user['userid'] == $_SESSION['userid']) {
   ?>     
                              &nbsp &nbsp<a href="userprofile.php?ccid=<?php echo base64_encode($value_comment['comment_id']); ?>&userid=<?php echo base64_encode($user2_id); ?>" class="cmnta" onclick="return confirm('are you sure ?')"><i class="fa fa-trash" aria-hidden="true"></i></a>

<?php
         }else{
          echo " ";
         }


    ?>
                                                     
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
?>





</div><!--col-md-7 end-->




 </div>




<?php

}

?>



          <!-- Newsfeed Common Side Bar Right  -->
          <!-- Newsfeed Common Side Bar Right  -->
      <?php include 'chatbar.php'; ?>         
            <!-- Newsfeed Common Side Bar Right end -->
            <!-- Newsfeed Common Side Bar Right  end-->


   
          </div><!--main content  end --> 
    <!--Main content END-->

<?php include 'footer.php'; ?>


  

  
   
    
