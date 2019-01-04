<?php include 'header.php'; ?>








<?php
  //post delete code
  if (isset($_GET['id'])) {
    
    $post_id = base64_decode($_GET['id']);

    $post_details =  $db->delete("DELETE FROM posts WHERE post_id = :post_id",array('post_id'=>$post_id));

    echo "<script>alert('Post Deleted');</script>";
    echo  "<script>window.location='profile.php';</script>";
  }
  // post delete with image
   if (isset($_GET['pid'])) {
    
    $post_id = base64_decode($_GET['pid']);
    $post_image = base64_decode($_GET['imageid']);
    unlink("$path/social/$post_image");
    $post_details =  $db->delete("DELETE FROM posts WHERE post_id = :post_id",array('post_id'=>$post_id));

    echo "<script>alert('Post Deleted');</script>";
    echo  "<script>window.location='profile.php';</script>";
  }

  //comment delete code

   if (isset($_GET['cid'])) {
    
    $comment_id = base64_decode($_GET['cid']);

    $post_details =  $db->delete("DELETE FROM comment WHERE comment_id = :comment_id",array('comment_id'=>$comment_id));

    echo "<script>alert('comment Deleted');</script>";
    echo  "<script>window.location='profile.php';</script>";
  }

  
?>



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
                         echo "<script>window.location='profile.php';</script>";
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
    <!--Main content-->
<div class="container">
<!-- cover profile and profile nav-->
<!-- cover profile and profile nav-->
<?php include 'profilenav.php'; ?>

<div class="row main-row">



        <div class="col-md-4">


          <div class="panel panel-default ">
                 <div class="panel-heading" style="background-color: #fff;"><div class="panel_info"><i class="fa fa-user-circle " aria-hidden="true"></i> &nbsp<span class="panel_header_text"><a class="details-a" href="about.php">Intro</a></span></div>
<?php
    //bio code start
    //bio code start
    $user_bio =  $db->select("SELECT * FROM bio WHERE userid = :userid ",array('userid'=>$_SESSION['userid']));
    if (count($user_bio) == 0) {
?>
     <center style="padding: 0px 20px;"> <a class="info3" href="about.php"> Add Bio</a>  </center>
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



  $user_works =  $db->select("SELECT * FROM work WHERE userid = :userid ORDER BY work_status DESC ",array('userid'=>$_SESSION['userid']));
  if (count($user_works) == 0) {
?>
          <li><i class="fa fa-briefcase info" aria-hidden="true"></i>&nbsp&nbsp<a class="info3" href="about.php"> Add Work</a></li>
<?php
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


  $user_education =  $db->select("SELECT * FROM education WHERE userid = :userid ORDER BY edu_status DESC ",array('userid'=>$_SESSION['userid']));
  if (count($user_education) == 0) {
?>
            <li><i class="fa fa-book info" aria-hidden="true"></i>&nbsp&nbsp<a class="info3" href="about.php" > Add Education Details</a></li>
<?php
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
  $user_other =  $db->select("SELECT * FROM other_info WHERE userid = :userid ",array('userid'=>$_SESSION['userid']));
  if (count($user_other) == 0){
  ?>
      <li><i class="fa fa-address-card info" aria-hidden="true"></i>&nbsp&nbsp<a class="info3" href="about.php" > Add other Details</a></li>

  <?php 

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
  
  $users_friendlist = $db->select("SELECT * FROM friendship WHERE (user1_id = :userid OR user2_id = :userid) AND status = 1 ",array('userid'=>$_SESSION['userid']));
  
if ($users_friendlist) {
    
  foreach ($users_friendlist as  $value_friendlist) {
        if ($value_friendlist['user1_id'] != $_SESSION['userid']  ) {
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
      $photos = $db->select("SELECT * FROM profile_images WHERE user_id = :user_id ORDER BY profile_image_time DESC LIMIT 3",array('user_id' => $_SESSION['userid']));
      $photos2 = $db->select("SELECT * FROM cover_images WHERE user_id = :user_id ORDER BY cover_image_time DESC LIMIT 3",array('user_id' => $_SESSION['userid']));
      $photos3 = $db->select("SELECT * FROM posts WHERE user_id = :user_id ORDER BY post_time DESC LIMIT 3",array('user_id' => $_SESSION['userid']));

      foreach ($photos as $value_photos) {
 ?>


            <img class="photo" src="<?php echo $value_photos['profile_image']; ?>">

 <?php       

      }

      foreach ($photos2 as $value_photos2) {

 ?>                 
           <img class="photo" src="<?php echo $value_photos2['cover_image']; ?>">

 <?php       

      }

      $count = 0;

      foreach ($photos3 as $value_photos3) {

        $count ++ ;

          if (isset($value_photos3['post_image'])) {
           
          

 ?>                 
           <img class="photo" src="<?php echo $value_photos3['post_image']; ?>">

<?php       

    }

      }

      if ($count == 0) {
          
          echo "<center class = 'info'>No photos</center>";

      }
?>



            </div>
            </div>


         
        </div><!--col-md-4  end --> 






  <div class="col-md-7">

<!-- Post Create Box -->
<!-- Post Create Box -->
                      <div class="create-post">
                          <div class="row">
                             <form id="form1" runat="server" action="" method="post" enctype="multipart/form-data"> 
                                  <div class="image-upload">
                                              <label for="file-input">
                                                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="ion-images postimg">&nbsp&nbspAdd Image</i>
                                              </label>
                                   <input id="file-input"  onchange="readURL(this);" type="file"  name="post_image" />
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
                   
                              <center> <img  id="test"  class="showpostimg" /></center>
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
  //post read code start
  $post_details = $db->select("SELECT * FROM posts WHERE user_id = :user_id ORDER BY post_time DESC",array('user_id'=>$_SESSION['userid']));

  if (count($post_details) == 0 ) {
     echo "<center>You have no Posts to show</center>";
  }


  foreach ($post_details as  $value_post) {

     if (empty($value_post['post_image'])) {
?>
<!-- 1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111-->
<!-- Post Content    -->
<!-- Post Content    -->

                  <div class="panel panel-default">
                                   <div class="panel-heading" style="background-color: #fff;">
                                        <div class="dropdown pull-right">
                                            <i class="btn dropdown-toggle fa fa-pencil" type="button" data-toggle="dropdown"></i>

                                              <ul class="dropdown-menu "> 

                                                  <li ><a  href="editpost.php?id=<?php echo base64_encode($value_post['post_id']);  ?>"  class="edit_drop"><i class="fa fa-pencil-square-o" aria-hidden="true"> Edit</i></a></li>

                                                  <li ><a href="profile.php?id=<?php echo base64_encode($value_post['post_id']); ?>" class="edit_drop"  onclick="return confirm('are you sure ?')"; ><i class="fa fa-trash-o" aria-hidden="true"> Delete</i></a></li>

                                              </ul>
                                         </div>



                                          <div class="post_header">
                                               <img src="<?php echo $profile_image_details['profile_image']; ?>" alt="" class="profile-photo-md" />
                                                    <div>
                                                          <span class="post_name">  <?php echo $user_details['firstname']." ".$user_details['lastname']; ?></span><br>
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
                                                              &nbsp &nbsp<a href="profile.php?cid=<?php echo base64_encode($value_comment['comment_id']); ?>" class="cmnta" onclick="return confirm('are you sure ?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                                 <div class="dropdown pull-right">
                                    <i class="btn dropdown-toggle fa fa-pencil" type="button" data-toggle="dropdown"></i>

                                            <ul class="dropdown-menu "> 
                                                <li ><a  href="editpost.php?id=<?php echo base64_encode($value_post['post_id']);  ?>"  class="edit_drop"><i class="fa fa-pencil-square-o" aria-hidden="true"> Edit</i></a></li>

                                               <li ><a href="profile.php?pid=<?php echo base64_encode($value_post['post_id']); ?>&&imageid=<?php echo base64_encode($value_post['post_image']); ?>" class="edit_drop"  onclick="return confirm('are you sure ?')"; ><i class="fa fa-trash-o" aria-hidden="true"> Delete</i></a></li>

                                            </ul>
                                 </div>
                                <div class="post_header">
                                   <img src="<?php echo $profile_image_details['profile_image']; ?>" alt="" class="profile-photo-md" />
                                        <div>
                                              <span class="post_name"> <?php echo $user_details['firstname']." ".$user_details['lastname']; ?></span><br>
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
                                                      &nbsp &nbsp<a href="profile.php?cid=<?php echo base64_encode($value_comment['comment_id']); ?>" class="cmnta" onclick="return confirm('are you sure ?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
  

 </div><!--col-md-7 end --> 




          <!-- Newsfeed Common Side Bar Right  -->
          <!-- Newsfeed Common Side Bar Right  -->
      <?php include 'chatbar.php'; ?>         
            <!-- Newsfeed Common Side Bar Right end -->
            <!-- Newsfeed Common Side Bar Right  end-->


  </div><!--main content row2 end --> 

</div><!--main content col end --> 
    <!--Main content END-->

<?php include 'footer.php'; ?>


  

  
   
    