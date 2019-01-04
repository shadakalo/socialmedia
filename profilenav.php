
<div class="profilenav-container" >

<div class="row ">
    <div class="col-md-11">
        <a href=""  data-toggle="modal" data-target="#exampleModalLong1">

  <?php

    if ($cover_image_details == (false or 0)) {
      ?>
      <img src="images/profileimages/demo2.png" class="cover-image"> 
  <?php
    }else{
   ?>

      <img src="<?php echo $cover_image_details['cover_image']; ?>" class="cover-image"> 
   <?php   
    }

  ?>



  	
        </a>
      			<div class="col-md-3">
              <a href=""  data-toggle="modal" data-target="#exampleModalLong">

  <?php

    if ($profile_image_details == (false or 0)) {
      ?>
      <img src="images/profileimages/demo.png" class="profile-image"> 
  <?php
    }else{
   ?>

      <img src="<?php echo $profile_image_details['profile_image']; ?>" class="profile-image"> 
   <?php   
    }

  ?>


              </a>

    				
    			  </div>
    			<diV class="col-md-5 name_add_mes" >
    				<h3 class="" style="margin-bottom: 4px;"><?php echo $user_details['firstname']." ".$user_details['lastname']; ?></h3>
    				<a class="edit_profile" href="about.php"><i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>Edit Profile</a>
    			</diV>
            <div class="profile-info" style="position: relative;top: 10px;">
                <nav class="navbar navbar-default profile-nav profile-nav-default" style="z-index: 0">
                   <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                  </div>
                                                
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">

                      <li><a href="profile.php">Timeline</a></li>
                      <li><a href="about.php"  >About</a></li>
                      <li > <a href="friends.php">Friends</a></li>
                      <li > <a href="photos.php">Photos</a></li>
                     
                    </ul>
                  </div><!-- /.navbar-collapse -->
              </nav>
          </div>
    </div>
</div>

<!-- Button trigger modal -->

<?php

//profile image code

if (isset($_POST['change_image'])) {
  

      
      $user_id   = $_SESSION['userid']; 

      $permited  = array('jpg', 'jpeg', 'png', 'gif');
      $file_name = $_FILES['profile_image']['name'];
      $file_size = $_FILES['profile_image']['size'];
      $file_temp = $_FILES['profile_image']['tmp_name'];

      $div = explode('.', $file_name);
      $file_ext = strtolower(end($div));
      $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
      $uploaded_image = "images/profileimages/".$unique_image;


      if (empty($file_name)) {
      
          echo "<script>alert('Please select an image');</script>";

      }elseif ($file_size >5242880){

             echo "<script>alert('Image should be less than 5MB');</script>";
        
      } elseif (in_array($file_ext, $permited) === false) {

                 echo "<script>alert('You can upload only:-".implode(', ', $permited)."');</script>";

       }else{
                

             move_uploaded_file($file_temp, $uploaded_image);

                if($db->insert("INSERT INTO profile_images(user_id, profile_image) VALUES(:user_id, :profile_image)", array( 'user_id'=>$user_id, 'profile_image'=>$uploaded_image)) == false){

                   $statusmsg1 = "Something went wrong try again later";

                }else{
                   echo "<script>alert('Profile Picture Updated');</script>";
                   echo "<script>window.location='profile.php';</script>";
                }

                 
           }
}


?>
<?php

//profile image code

if (isset($_POST['change_cover_image'])) {
  

      
      $user_id   = $_SESSION['userid']; 

      $permited  = array('jpg', 'jpeg', 'png', 'gif');
      $file_name = $_FILES['cover_image']['name'];
      $file_size = $_FILES['cover_image']['size'];
      $file_temp = $_FILES['cover_image']['tmp_name'];

      $div = explode('.', $file_name);
      $file_ext = strtolower(end($div));
      $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
      $uploaded_image = "images/covers/".$unique_image;


      if (empty($file_name)) {
      
          echo "<script>alert('Please select an image');</script>";

      }elseif ($file_size >5242880){

             echo "<script>alert('Image should be less than 5MB');</script>";
        
      } elseif (in_array($file_ext, $permited) === false) {

                 echo "<script>alert('You can upload only:-".implode(', ', $permited)."');</script>";

       }else{
                

             move_uploaded_file($file_temp, $uploaded_image);

                if($db->insert("INSERT INTO cover_images(user_id, cover_image) VALUES(:user_id, :cover_image)", array( 'user_id'=>$user_id, 'cover_image'=>$uploaded_image)) == false){

                   $statusmsg1 = "Something went wrong try again later";

                }else{
                   echo "<script>alert('Cover Picture Updated');</script>";
                   echo "<script>window.location='profile.php';</script>";
                }

                 
           }
}


?>
<!-- Modal -->

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title info5" id="exampleModalLongTitle"><i class="fa fa-picture-o" aria-hidden="true"></i> &nbspChage Profile Image </h5>
      </div>
        <form action="profile.php" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                        <div id="wrapper" class="">
                          <center>
                          <div class="BroweForFile">
                                  <label for="PickFileButton">
                                      <i class="fa fa-picture-o profile_image_input" aria-hidden="true">&nbsp&nbspUpload Image</i>
                                  </label>
                              <input name="profile_image" type="file" accept="image/*" onchange="preview_image(event)" id="PickFileButton" >
                          </div>
                          
                         </center>
                         <center><img id="output_image" class="profile_image" /></center>
                        </div>
                              
              </div>

              <div class="modal-footer">
                   <button type="submit" class="btn btn-primary"  >Close</button>
                     <button type="submit" class="btn btn-primary" name="change_image">Save changes</button>
            </div>
 </form>
    </div>
  </div>
</div>
 

 <div class="modal fade" id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title info5" id="exampleModalLongTitle"> <i class="fa fa-picture-o" aria-hidden="true"></i> &nbspChage Cover Image </h5>
      </div>
        <form action="profile.php" method="post" enctype="multipart/form-data">
              <div class="modal-body"> 
                        <center>
                              <div class="">
                                   <label for="FileInput">
                                    <i  class="fa fa-picture-o profile_image_input"  aria-hidden="true" >&nbsp&nbspUpload Image</i>
                                   </label>
                                  <input  type='file' id="FileInput"  onchange="readUR(this);" name="cover_image" style="cursor: pointer;  display: none"/>
                              </div>
                        </center>

                          
                       

                 <center> <img id="blah" class="profile_image" /> </center>
              </div>
              <div class="modal-footer">
                   <button type="submit" class="btn btn-primary"  >Close</button>
                     <button type="submit" class="btn btn-primary" name="change_cover_image">Save changes</button>
            </div>
 </form>
    </div>
  </div>
</div>
 </div>