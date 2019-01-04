<!-- cover profile and profile nav end-->
<!-- cover profile and profile nav end-->
          
            <!-- intro bio etc -->
            <!-- intro bio etc -->
          <div class="row main-row">  
             <div class="col-md-4" >
                
            </div>
           



          <!-- intro bio etc end-->
          <!-- intro bio etc end-->
          


 



<?php
  //like dislike code
  $like_details = $db->select_one_row("SELECT * from post_like WHERE post_id = :post_id AND user_id = :user_id",array('post_id' => $value_post['post_id'], 'user_id'=>$_SESSION['userid']));


if (isset($_POST['like_post'])) {
  
    if ($like_details == false ) {
      
        $like = 0;

        $db->insert("INSERT INTO post_like(`post_id`, `user_id`, `status`) VALUES ( :post_id, :user_id, :status);",array('post_id'=>$value_post['post_id'], 'user_id'=>$_SESSION['userid'], 'status'=>$like));

    }


} 
?>
    





<!-- Newsfeed Common Side Bar Right  -->
<!-- Newsfeed Common Side Bar Right  -->
<?php include 'chatbar.php'; ?>         
<!-- Newsfeed Common Side Bar Right end -->
<!-- Newsfeed Common Side Bar Right  end-->