<?php
//defining two users nd making the smallest userid user1 
  $user1 = $_SESSION['userid'];
  $user2 = $user2_details['userid'];
  if ($user1 > $user2) {
    $helpers->swap($user1,$user2);
  }
  //frndcheck & request
  $frnd_details = $db->select_one_row("SELECT * FROM friendship WHERE user1_id = :user1_id AND user2_id = :user2_id",array('user1_id'=>$user1, 'user2_id'=>$user2));
 ?>
 <?php
//friend code
 //sending request
if (isset($_POST['send_request'])) {

      $status = 0;
      $frnd_req_send = $db->insert('INSERT INTO friendship(user1_id, user2_id, status, action_id) VALUES(:user1_id, :user2_id, :status, :action_id)', array('user1_id'=>$user1, 'user2_id'=>$user2, 'status'=>$status, 'action_id'=>$_SESSION["userid"]));
        echo "<script>window.location='userprofile.php?userid=".base64_encode($user2_details['userid'])."';</script>";
     
}


//cancelling request//unfriend
if (isset($_POST['cancel_request'])) {

    $frnd_req_cancel = $db->delete("DELETE FROM friendship WHERE user1_id = :user1_id AND user2_id = :user2_id", array('user1_id'=>$user1, 'user2_id'=>$user2));
    echo "<script>window.location='userprofile.php?userid=".base64_encode($user2_details['userid'])."';</script>";
}


//accepting request
if (isset($_POST['confirm_request'])) {
  
  $frnd_req_confirm = $db->update("UPDATE friendship SET status = 1 WHERE user1_id = :user1_id AND user2_id = :user2_id", array('user1_id'=>$user1, 'user2_id'=>$user2));
   echo "<script>window.location='userprofile.php?userid=".base64_encode($user2_details['userid'])."';</script>";
}

?>
<div class="row">
    <div class="col-md-11">
  			<a href="">
<?php

    if ($user2_cover_image == false) {
      echo '<img src="images/profileimages/demo.png" class="cover-image">  ';
    }else{
      echo '<img src="'.$user2_cover_image['cover_image'].'" class="cover-image"> ';
    }

?>
         



       </a>
    			<div class="col-md-3">
  				<a href="">
<?php

    if ($user2_profile_image == false) {
      echo '<img src="images/profileimages/demo.png" class="profile-image"> ';
    }else{
      echo '<img src="'.$user2_profile_image['profile_image'].'" class="profile-image"> ';
    }

?>
           




         </a>
  			  </div>
    			<diV class="col-md-5 name_add_mes">
    				<h3 class=""><?php echo $user2_details['firstname']." ".$user2_details['lastname']; ?> <a class="msg-msg" href="chat.php?userid=<?php echo base64_encode($user2_details['userid']); ?>"><i class="fa fa-commenting" aria-hidden="true"></i></a> </h3>

          
                <form action="" method="post">
<?php
  if ($frnd_details == false) {
?>
      <button class="btn btnfrnd" name="send_request"><i class="fa fa-user-plus" aria-hidden="true"></i> Add friend</button>
<?php
 }elseif ($frnd_details['status'] == 0 && $frnd_details['action_id'] == $_SESSION['userid'] ) {
?>
     
      <button class="btn btnfrnd" name="cancel_request"><i class="fa fa-user-times" aria-hidden="true"> </i> &nbspCancel Request</button>

<?php
 }elseif ($frnd_details['status'] == 0 && $frnd_details['action_id'] == $user2_id) { 
?>

  <button class="btn btnfrnd" name="confirm_request"><i class="fa fa-user-plus" aria-hidden="true"> </i> &nbspConfirm</button>
  <button class="btn btnfrnd" name="cancel_request"><i class="fa fa-user-times" aria-hidden="true"> </i> &nbspCancel</button>

<?php
 }elseif ($frnd_details['status'] == 1) {
?>
  <button class="btn btnfrnd" name="cancel_request"><i class="fa fa-user-times" aria-hidden="true"> </i> &nbspUnfriend</button>
<?php
 }
?>                


                
    				
            </form>
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

                    <li><a href="userprofile.php?userid=<?php echo base64_encode($user2_details['userid']); ?>">Timeline</a></li>
                    <li><a href="userabout.php?userid=<?php echo base64_encode($user2_details['userid']); ?>"  >About</a></li>
                    <li > <a href="userfrnd.php?userid=<?php echo base64_encode($user2_details['userid']); ?>">Friends</a></li>
                    <li > <a href="userphotos.php?userid=<?php echo base64_encode($user2_details['userid']); ?>">Photos</a></li>
                   
                  </ul>
                </div><!-- /.navbar-collapse -->
              </nav>
          </div>
    </div>
</div>