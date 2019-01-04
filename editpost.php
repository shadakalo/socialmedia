<?php include 'header.php'; ?>

<?php

	if (isset($_GET['id'])) {
		
		$post_id = base64_decode($_GET['id']);

		$post_details =  $db->select_one_row("SELECT * FROM posts WHERE post_id = :post_id",array('post_id'=>$post_id));
	}else{
		echo  "<script>window.location='profile.php';</script>";
	}




?>
<?php

	if (isset($_POST['post_edit'])) {
		
			$post_text = $_POST['post_text'];

			$db->update("UPDATE posts SET post_text = :post_text WHERE post_id = :post_id",array('post_text'=>$post_text,'post_id'=>$post_id));

			echo "<script>alert('Post Updated');</script>";
			echo  "<script>window.location='editpost.php?id=".base64_encode($post_details['post_id'])."';</script>";

	}


?>
<?php

	if (isset($_POST['post_cancel'])) {

			echo  "<script>window.location='profile.php';</script>";

	}


?>

<div class="container" style="margin-top: 15px;">
	<div class="row">
   		 <div class="col-md-8">
   		 		 <div class="panel panel-default">
                      <div class="panel-heading" style="background-color: #fff;">
                            <div class="post_header">

<?php

$user_photo = $db->select_one_row("SELECT profile_image FROM profile_images WHERE user_id =:user_id ORDER BY profile_image_time DESC",array('user_id'=>$_SESSION['userid']));

  if ($user_photo == false) {
    echo '<a href="profile.php"><img src="images/profileimages/dem0.png alt="" class="profile-photo-md" /></a>';
  }else{
    echo '<a href="profile.php"><img src="'.$user_photo['profile_image'].'" alt="" class="profile-photo-md" /></a>';
  }

?>  



                               
                                    <div>
                                          <span class="post_name"><a href="profile.php" class="cmnta"> <?php echo $user_details['firstname']." ".$user_details['lastname']; ?></a></span><br>
                                          <span class="post_date">Posted at <?php echo $post_details['post_time'];  ?></span> 
                                    </div>
                            </div>
                             <div class="post_content">
                              	<form action="" method="post">
                              		<textarea onkeyup="auto_grow(this)" class="form-control"  name="post_text" placeholder="Your Post Has no text" style="margin-top: 5px;"><?php echo $post_details['post_text'];  ?></textarea>

                              		<div class="edit_post_button">
                              			<button class="btn btn-primary" name="post_edit">Save</button>
                              			<button class="btn btn-primary" name="post_cancel">Cancel</button>
                              		</div>
                              	</form>


                              
                            </div><hr>
                             






























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



<?php include 'footer.php'; ?>