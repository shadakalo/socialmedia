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






?>



    <!--Main content-->
      <div class="container">
      
            

            <!-- cover profile and profile nav-->
            <!-- cover profile and profile nav-->

<?php include 'userprofilenav.php'; ?>

          <!-- cover profile and profile nav end-->
          <!-- cover profile and profile nav end-->


<div class="main-row">
                <?php

                if ( $frnd_details['status'] != 1){

                echo '<center><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '.$user2_details['firstname']." ".$user2_details['lastname']." is not your friend ...</center>";

            }//frnd check end
            ?>

</div>




<?php

  if ( $frnd_details['status'] == 1){

?>

<!DOCTYPE html>
<html>
<head>
  <title></title>

  
  <style type="text/css">

    
/*  panel tab */
div.panel-tab-container{

  background-color: #ffffff;
  padding: 0 !important;
  border-radius: 4px;
  -moz-border-radius: 4px;
  border:1px solid #ddd;
  margin-top: 20px;
  margin-left: 50px;
  -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  box-shadow: 0 6px 12px rgba(0,0,0,.175);
  -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);

}
div.panel-tab-menu{ 
  padding-right: 0;
  padding-left: 0;
  padding-bottom: 0;
}
div.panel-tab-menu div.list-group{
  margin-bottom: 0;
}
div.panel-tab-menu div.list-group>a{
  margin-bottom: 0;
}
div.panel-tab-menu div.list-group>a .glyphicon,
div.panel-tab-menu div.list-group>a .fa {
  color: #A07A9D;
}
div.panel-tab-menu div.list-group>a:first-child{
  border-top-right-radius: 0;
  -moz-border-top-right-radius: 0;
}
div.panel-tab-menu div.list-group>a:last-child{
  border-bottom-right-radius: 0;
  -moz-border-bottom-right-radius: 0;
}
div.panel-tab-menu div.list-group>a.active,
div.panel-tab-menu div.list-group>a.active .glyphicon,
div.panel-tab-menu div.list-group>a.active .fa{
  background-color:#A07A9D;
  background-image: #A07A9D;
  color: #ffffff;
}
div.panel-tab-menu div.list-group>a.active:after{
  content: '';
  position: absolute;
  left: 100%;
  top: 50%;
  margin-top: -13px;
  border-left: 0;
  border-bottom: 13px solid transparent;
  border-top: 13px solid transparent;
  border-left: 10px solid #A07A9D;
}

div.panel-tab-content{
  background-color: #ffffff;
  /* border: 1px solid #eeeeee; */
  padding-left: 20px;
  padding-top: 50px;
}

div.panel-tab div.panel-tab-content:not(.active){
  display: none;
}

.list-group .list-group-item {
  border: 0px;
  border-bottom: 1px solid #eee !important;
  margin-bottom: 4px;
}
.list-group-item:first-child, {
  border-top-left-radius: 0px;
  border-top-right-radius: 0px;
}

</style>

</head>
<body>



<div class="row main-row">
  <div class="col-md-11 ">
    <div class="col-md-10 panel-tab-container">
        <div class="col-lg-4 col-md-4 panel-tab-menu">
            <div class="list-group">
                <a href="#" class="list-group-item active text-center">
                   <h4 class="fa fa-child"></h4><br>Overview
                </a>
                <a href="#" class="list-group-item text-center">
                   <h4 class="fa fa-briefcase info"></h4><br>Work
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="fa fa-book info"></h4><br>Education info
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="fa fa-globe info"></h4><br/>Other Info
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="fa fa-info info"></h4><br/>About Yourself 
                </a>
            
            </div>
        </div>

        <div class="col-lg-6 col-md-6 panel-tab">
            <div class="panel-tab-content active">
                <ul class="list-group">
                  <li class="list-group-item"><i class="fa fa-briefcase info"></i>&nbsp; 
                      <?php 
                      $user_works =  $db->select("SELECT * FROM work WHERE userid = :userid ORDER BY work_status DESC ",array('userid'=>$user2_id ));
                      if (count($user_works) == 0 ) {
                        echo "&nbsp&nbsp  No work to show";
                      }
                      foreach ($user_works as  $value) 
                        {
                      ?>       
                      <span class="info2"><?php echo $value['designation']; ?> at 
                      <span class="info"><?php echo $value['company']; ?></Span>  &nbsp&nbsp&nbsp&nbsp 
                      <br>
                      <?php  }?>                   
                  </li>

                  <li class="list-group-item"><i class="fa fa-home info"></i>&nbsp; 
                      <?php
                      $user_other =  $db->select("SELECT * FROM other_info WHERE userid = :userid ",array('userid'=>$user2_id ));
                      if (count($user_other) == 0 ) {
                        echo "&nbsp&nbsp No place to show";
                      }
                        foreach ($user_other as $value_other) {
                      ?>

                      lives in <span class="info"> <?php echo $value_other['livesin'];  ?>,<?php echo $value_other['comesfrom'];  ?></span>
                      <?php }?>
                  </li>

                  <li class="list-group-item"><i class="fa fa-heart info"></i>&nbsp; 
                    <?php
                      $user_other =  $db->select("SELECT * FROM other_info WHERE userid = :userid ",array('userid'=>$user2_id ));
                       if (count($user_other) == 0 ) {
                        echo "&nbsp&nbsp No Relationship status";
                      }
                        foreach ($user_other as $value_other) {
                      ?>

                     Relationship Status:<span class="info2"><?php echo $value_other['relationship'];  ?>
                    <?php }?>  
                     
                  </li>
                  <li class="list-group-item"><i class="fa fa-envelope info"></i>&nbsp; About Yourself  <br>
                      <?php
                      $user_bio =  $db->select("SELECT * FROM bio WHERE userid = :userid ",array('userid'=>$user2_id ));
                      if (count($user_bio) == 0 ) {
                        echo "&nbsp&nbsp&nbsp&nbsp (No bio to show)";
                      }
                    
                      foreach ($user_bio as  $value_bio) 
                      {                    
                      ?>
                    <li style="list-style: none; font-size: 15px; padding-left: 15px;"><span class="info2"><?php echo $value_bio['biotext']; ?> </span></li>
                    <?php }?>
                  </li>  
                </ul>  
            </div>

<!--  Work Experience -->
<!--  Work Experience -->
            <div class="panel-tab-content">
                      
              <li style="list-style: none; font-size: 20px;"><i class="fa fa-briefcase info" aria-hidden="true"></i> Work Experience</li><hr>
                    
              <?php 
                      $user_works =  $db->select("SELECT * FROM work WHERE userid = :userid ORDER BY work_status DESC ",array('userid'=>$user2_id ));
                      if (count($user_works) == 0 ) {
                        echo "&nbsp&nbsp  (No work to show)";
                      }
                      foreach ($user_works as  $value) 
                        {
              ?>     
                      <li style="list-style: none; font-size: 15px;">
                      <span class="info2"><?php echo $value['designation']; ?></span> &nbsp&nbsp&nbsp&nbsp 
                      
                      <br>
                      At <span class="info"><?php echo $value['company']; ?></Span> 
                      </li> 
                      <hr>
              <?php 
                       }
              ?>       
        </div>
    
<!-- EDUCATION -->
<!-- EDUCATION -->
        <div class="panel-tab-content">
          <li style="list-style: none; font-size: 20px;"><i class="fa fa-book info" aria-hidden="true"></i> Education </li><hr>    
          <?php
          
              $user_education =  $db->select("SELECT * FROM education WHERE userid = :userid ORDER BY edu_status DESC ",array('userid'=>$user2_id ));

              if (count($user_education) == 0 ) {
                        echo "&nbsp&nbsp ( No info to show )";
                      }

              foreach ($user_education as  $value) 
            {
                          
          ?>  
              
                <li style="list-style: none; font-size: 15px;"> <span class="info2">Studies  (<?php echo $value['degree']; ?>)  in <?php echo $value['subject']; ?> at&nbsp </span><span class="info"><?php echo $value['institute']; ?></Span> 
                  
                </li> 
                                              
        <?php 
            }   
         ?>
            
          </div>
                
<!-- OTHER INFORMATION -->
<!-- OTHER INFORMATION -->

      <div class="panel-tab-content">
        <?php
          $user_other =  $db->select("SELECT * FROM other_info WHERE userid = :userid ",array('userid'=>$user2_id ));
          if (count($user_other) == 0){
        ?>
            <li style="list-style: none; font-size: 20px;"><i class="fa fa-info-circle info" aria-hidden="true"></i> Other Information</li><hr>

                 
            <?php 

                 
                        echo "&nbsp&nbsp (No info to show)";
             
            }else{

                foreach ($user_other as $value_other) {

            ?>
          <?php
              if ($value_other['livesin']!="") {
           ?>  
                <div style="margin-top: 25px; margin-bottom: 20px;">
                  <li style="list-style: none; font-size: 20px;"><i class="fa fa-info-circle info" aria-hidden="true"></i> Others Information &nbsp
                  </li>
                            <hr>
                 <li style="list-style: none; font-size: 15px;"> <i class="fa fa-home info" aria-hidden="true"></i>&nbsp&nbsp<span class="info2">Lives in </span><span class="info"> <?php echo $value_other['livesin'];  ?></span></li>
               

          <?php
              }

              if ($value_other['comesfrom']!="") {
          ?>
              <li style="list-style: none; font-size: 15px;"><i class="fa fa-globe info" aria-hidden="true"></i>&nbsp&nbsp<span class="info2">From </span><span class="info"> <?php echo $value_other['comesfrom'];  ?></span></li>

          <?php   } ?>
               <?php if(!empty($value_other)){ ?>
                <li style="list-style: none; font-size: 15px;"><i class="fa fa-heart info" aria-hidden="true"></i>&nbsp&nbsp Relationship Status: &nbsp<span class="info2"><?= $value_other['relationship'];?></span></li>

                </div>
                <?php }?>
             
            <?php
                } } ?>  
                          
      </div>


<!-- ABOUT YOURSELF -->
<!-- ABOUT YOURSELF -->

      <div class="panel-tab-content">
        <?php 
          if(isset($errMSG))
          {
            echo $errMSG;
          }
        ?>
        <?php
          $user_bio =  $db->select("SELECT * FROM bio WHERE userid = :userid ",array('userid'=>$user2_id )); 
          if (count($user_bio) == 0) 
          {
        ?>  
            <li style="list-style: none; font-size: 20px;"><i class="fa fa-globe info" aria-hidden="true"></i> About Yourself &nbsp</li><hr>
             

        <?php


                        echo "&nbsp&nbsp ( User has no bio)";
              

        }
        else
        {
        foreach ($user_bio as  $value_bio) 
        {
        ?>

             <div style="margin-bottom: 5px;">
                <li style="list-style: none; font-size: 20px;"><i class="fa fa-globe info" aria-hidden="true"></i> About Yourself        
             </div> 
             <hr>
               <li style="list-style: none; font-size: 15px;"><span class="info2"><?php echo $value_bio['biotext']; ?> </span></li> 

        <?php }} ?>
            </div>


            </div>
        </div>
  </div>
</div>

  
<?php } ?>


          <!-- Newsfeed Common Side Bar Right  -->
          <!-- Newsfeed Common Side Bar Right  -->
      <?php include 'chatbar.php'; ?>         
            <!-- Newsfeed Common Side Bar Right end -->
            <!-- Newsfeed Common Side Bar Right  end-->


   
          </div><!--main content  end --> 
    <!--Main content END-->

<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("div.panel-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.panel-tab>div.panel-tab-content").removeClass("active");
        $("div.panel-tab>div.panel-tab-content").eq(index).addClass("active");
    });
});
</script>



</body>
</html>