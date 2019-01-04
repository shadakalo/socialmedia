<?php include 'header.php'; ?>

    <!--Main content-->
      <div class="container">
            <!-- cover profile and profile nav-->
            <!-- cover profile and profile nav-->

          <!-- cover profile and profile nav end-->
          <!-- cover profile and profile nav end-->


 <?php
 //$_GET['search'] = "";

  if ( $_GET['search'] == 'search' )  {
    

    
 

      $search_text = $_GET['text'];

      if ($search_text != "") {
?>   
      



          <div class="row ">
            <div class="col-md-11 ">
                
                <div class="panel panel-default">

                  <div class="panel-heading" style="background-color: #fff;padding: 30px;"><div class="panel_info"><i class="fa fa-users" aria-hidden="true"></i>&nbsp<span class="panel_header_text"> Search result</span></div></div>

                        <div class="panel-body">
 



                              

 


<?php     

      $result = $db->select("SELECT * FROM users WHERE firstname LIKE '%$search_text%' OR  lastname LIKE '%$search_text%' ",array('firstname'=>'%$search_text%', 'lastname'=>'%$search_text%'));

      if (count($result) == 0 ) {
        echo "No result found";
      }

      foreach ($result as  $value) {

            $user_photo = $db->select_one_row("SELECT profile_image FROM profile_images WHERE user_id =:user_id ORDER BY profile_image_time DESC",array('user_id'=>$value['userid']));
            $user_works =  $db->select_one_row("SELECT * FROM work WHERE userid = :userid ORDER BY work_status DESC ",array('userid'=>$value['userid']));
?>





         <div class="col-md-5 frnd-panel">
<?php
      if ($user_photo == false) {
 
         echo '<a href="userprofile.php?userid='.base64_encode($value['userid']).'"><img class="friend_image" src="images/profileimages/demo.png"></a>';
 
      }else{

        echo '<a href="userprofile.php?userid='.base64_encode($value['userid']).'"><img class="friend_image" src="'.$user_photo['profile_image'].'"></a>';

      }




 ?>
                                     <div class="frnd-det">
                                          <a class="frnd-name info3" href="userprofile.php?userid=<?php echo base64_encode($value['userid']); ?>"><?php echo $value['firstname']." ".$value['lastname'];?></a><br>
<?php

      if ($user_works == false) {
        

           $user_other =  $db->select_one_row("SELECT * FROM other_info WHERE userid = :userid ",array('userid'=>$value['userid']));

           if ($user_other != false) {
             echo "Lives in  ".$user_other['livesin'];
           }


      }else{
        echo $user_works['designation']." at ".$user_works['company'];
      }


?>
                                      </div>
                                    </div>  

                                     
      <?php 

      }
    }else{
      echo "<script>alert('Please write the name you searching for');</script>";
    }

  }else{
    echo "<script>window.location='profile.php';</script>";
  }

?>
                                      
                                                     
                          </div>

                  </div>
                    



           
                    



             
            </div>
          </div>

          <!-- Newsfeed Common Side Bar Right  -->
          <!-- Newsfeed Common Side Bar Right  -->
          
            <!-- Newsfeed Common Side Bar Right end -->
            <!-- Newsfeed Common Side Bar Right  end-->


   
          </div><!--main content  end --> 
    <!--Main content END-->

<?php include 'footer.php'; ?>



  
   
