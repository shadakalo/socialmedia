<?php include 'header.php'; ?>

    <!--Main content-->
      <div class="container">
            <!-- cover profile and profile nav-->
            <!-- cover profile and profile nav-->

<?php include 'profilenav.php'; ?>

          <!-- cover profile and profile nav end-->
          <!-- cover profile and profile nav end-->

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
.button-bg{
    background-color: #A07A9D;
    border-color: #A07A9D; 
  }
.button-bg:hover{
      background-color: #2a6496;
    }
</style>

</head>
<body>

<!-- INSERT BIO -->
<?php 
  if(isset($_POST['save'])) 
  {
      $userid = $_SESSION['userid'];
      $biotext = $helpers->validation($_POST['biotext']);

      if(empty($biotext))
    {
      $errMSG = "Please Enter bio.";
    }
    else 
    {
       
      $user_bio = $db->insert('INSERT INTO bio(userid,biotext) VALUES(:userid,:biotext)',array('userid'=>$userid, 'biotext'=>$biotext));

      echo  "<script>alert('Bio updated seccessfully');</script>"; 
       echo "<script>window.location='about.php';</script>";

          //echo "<font color='green'>Data added successfully.";
    }
   
  }

?>


<!-- INSERT WORK -->

<?php 
  if(isset($_POST['submit'])) 

  {
      $userid = $_SESSION['userid'];
      $company = $helpers->validation($_POST['company']);
      $designation = $helpers->validation($_POST['designation']);

      if(empty($company))
    {
      $errMSG = "Please Enter company.";
    }

    else 
    {
       
      $user_bio = $db->insert('INSERT INTO work(userid,company,designation) VALUES(:userid,:company,:designation)',array('userid'=>$userid, 'company'=>$company,'designation'=>$designation));
        
           echo  "<script>alert('Work updated seccessfully');</script>"; 
       echo "<script>window.location='about.php';</script>";
          //echo "<font color='green'>Data added successfully.";
    }
   
  }

?>



<!-- INSERT EDUCATION -->

<?php 
  if(isset($_POST['add'])) 

  {
      $userid = $_SESSION['userid'];
      $institute = $helpers->validation($_POST['institute']);
      $subject = $helpers->validation($_POST['subject']);
      $degree = $helpers->validation($_POST['degree']);

      if(empty($institute))
    {
      $errMSG = "Please Enter institute.";
    }

    else 
    {  
      $user_education = $db->insert('INSERT INTO education(userid,institute,subject,degree) VALUES(:userid,:institute,:subject,:degree)',array('userid'=>$userid, 'institute'=>$institute,'subject'=>$subject,'degree'=>$degree));
       echo  "<script>alert('Education updated seccessfully');</script>"; 
       echo "<script>window.location='about.php';</script>";
        
    }
   
  }

?>


<!-- INSERT OTHERS INFO -->
<?php 
  if(isset($_POST['addother'])) 

  {
      $userid = $_SESSION['userid'];
      $livesin = $helpers->validation($_POST['livesin']);
      $comesfrom = $helpers->validation($_POST['comesfrom']);
      $relationship = $helpers->validation($_POST['relationship']);

      if(empty($livesin))
    {
      $errMSG = "Please Enter your place.";
    }

    else 
    {
       
      $user_other = $db->insert('INSERT INTO other_info(userid,livesin,comesfrom,relationship) VALUES(:userid,:livesin,:comesfrom,:relationship)',array('userid'=>$userid,'livesin'=>$livesin,'comesfrom'=>$comesfrom,'relationship'=>$relationship));
          
          echo  "<script>alert('Info updated seccessfully');</script>"; 
       echo "<script>window.location='about.php';</script>";
      
    }
   
  }

?>



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
                      $user_works =  $db->select("SELECT * FROM work WHERE userid = :userid ORDER BY work_status DESC ",array('userid'=>$_SESSION['userid']));

                      if (count($user_works) == 0 ) {
                        echo "&nbsp&nbsp  Add your working Place";
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
                      $user_other =  $db->select("SELECT * FROM other_info WHERE userid = :userid ",array('userid'=>$_SESSION['userid']));
                       if (count($user_other) == 0 ) {
                        echo "&nbsp&nbsp Add your Living Place";
                      }
                        foreach ($user_other as $value_other) {
                      ?>

                      lives in <span class="info"> <?php echo $value_other['livesin'];  ?></span>
                      <?php }?>
                  </li>

                  <li class="list-group-item"><i class="fa fa-heart info"></i>&nbsp; 
                    <?php
                      $user_other =  $db->select("SELECT * FROM other_info WHERE userid = :userid ",array('userid'=>$_SESSION['userid']));

                        if (count($user_other) == 0 ) {
                        echo "&nbsp&nbsp Add your Relationship status";
                      }

                        foreach ($user_other as $value_other) {
                      ?>

                     Relationship Status: <span class="info2"> <?php echo $value_other['relationship'];  ?>
                    <?php }?>  
                     
                  </li>
                  <li class="list-group-item"><i class="fa fa-envelope info"></i>&nbsp; About Yourself  <br>
                      <?php
                      $user_bio =  $db->select("SELECT * FROM bio WHERE userid = :userid ",array('userid'=>$_SESSION['userid']));
                  
                      if (count($user_bio) == 0 ) {
                        echo "&nbsp&nbsp&nbsp&nbsp (No bio to show)";
                      }
                    
                      foreach ($user_bio as  $value_bio) 
                      {                    
                      ?>
                    <li style="list-style: none; font-size: 15px; padding-left: 15px;">  
                      <span class="info2"><?php echo $value_bio['biotext']; ?> </span></li>
                    <?php }?>
                  </li>  
                </ul>  
            </div>

<!--  Work Experience -->
<!--  Work Experience -->
            <div class="panel-tab-content">
                      
                  <li style="list-style: none; font-size: 20px;"><i class="fa fa-briefcase info" aria-hidden="true"></i> Work Experience &nbsp&nbsp&nbsp&nbsp
                  <button type="button" class="btn btn-info btn-xs button-bg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </li>

             <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title info5"><i class="fa fa-briefcase" aria-hidden="true"></i> Add Work Experience</h4>
                      </div>
                      <div class="modal-body">
                        <form method="post" name="form1" action="">
                          <table>
                            <tr> 
                              <td>Add your company : </td>
                              <td><input type="text" name="company" class="form-control" style="margin-bottom: 5px;"></td> 
                              </tr>

                              <tr>
                              <td>Add your designation :</td>
                              <td><input class="form-control" type="text" name="designation"></td> 
                              </tr>

                              <tr> 
                              <td></td>
                              <td><input type="submit" name="submit" value="Add" class="btn  btn-primary pull-right"></td>
                            </tr>
                          </table>
                        </form> 
                      </div>
                      <div class="modal-footer">
                          
                      </div>
                    </div>
                  </div>
            </div>  <hr>
              
              <?php 
                      $user_works =  $db->select("SELECT * FROM work WHERE userid = :userid ORDER BY work_status DESC ",array('userid'=>$_SESSION['userid']));
                      foreach ($user_works as  $value) 
                        {
              ?>     
                      <li style="list-style: none; font-size: 15px;">
                      <span class="info2"><?php echo $value['designation']; ?></span> &nbsp&nbsp&nbsp&nbsp 
                      <div class="dropdown pull-right">
                        <i class="btn dropdown-toggle fa fa-pencil-square-o info" type="button" data-toggle="dropdown"></i>
                          <ul class="dropdown-menu "> 

                              <li ><a href="edit.php?work_id=<?= $value['workid']; ?>" class="edit_drop" title="click for edit">EDIT <i class="fa fa-pencil info" aria-hidden="true"></i></a></li>

                              <li > <a href="delete.php?work_id=<?= $value['workid']; ?>" class="edit_drop" title="click for delete" onclick="return confirm('sure to delete ?')">DELETE <i class="fa fa-trash info" aria-hidden="true"></i></a></li>
                          </ul>
                      </div>
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
                <li style="list-style: none; font-size: 20px;"><i class="fa fa-book info" aria-hidden="true"></i> Education  &nbsp&nbsp&nbsp&nbsp
          <button type="button" class="btn btn-info btn-xs button-bg" data-toggle="modal" data-target="#myModaledu"><i class="fa fa-plus" aria-hidden="true"></i></button>
           </li><hr>   
          <?php
          
              $user_education =  $db->select("SELECT * FROM education WHERE userid = :userid ORDER BY edu_status DESC ",array('userid'=>$_SESSION['userid']));

              foreach ($user_education as  $value) 
            {
                          
          ?>  
              
                <li style="list-style: none; font-size: 15px;"> <span class="info2">Studies  (<?php echo $value['degree']; ?>)  in <?php echo $value['subject']; ?> at&nbsp </span><span class="info"><?php echo $value['institute']; ?></Span> 
                  <div class="dropdown pull-right">
                  <i class="btn dropdown-toggle fa fa-pencil-square-o info" type="button" data-toggle="dropdown"></i>

                    <ul class="dropdown-menu "> 

                        <li >
                           <a href="edit.php?education_id=<?= $value['educationid']; ?>" class="edit_drop">EDIT<i class="fa fa-pencil info" aria-hidden="true"></i>  </a> 
                        </li>
                        <li > <a href="delete.php?education_id=<?= $value['educationid']; ?>" class="edit_drop" title="click for delete" onclick="return confirm('sure to delete ?')">DELETE<i class="fa fa-trash info" aria-hidden="true"></i></a>
                        </li>

                    </ul>
                  </div>
                </li> 
                                              
        <?php 
            }   
         ?>
                <div class="modal fade" id="myModaledu" role="dialog">
                    <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title info5">Add Education</h4>
                        </div>
                        <div class="modal-body">
                          <form method="post" name="form1" action="">
                            <table>
                              <tr> 
                                <td>Add your Institute :</td>
                                <td><input type="text" name="institute" class="form-control"></td> 
                                </tr>

                                <tr>
                                <td>Add your Subject :</td>
                                <td><input type="text" name="subject" class="form-control"></td> 
                                </tr>

                                <tr>
                                <td>Add your Degree :</td>
                                <td><input type="text" name="degree" class="form-control"></td> 
                                </tr>

                                <tr> 
                                <td></td>
                                <td><input type="submit" name="add" value="Save" class="btn btn-primary pull-right"></td>
                              </tr>
                            </table>
                          </form>    
                        </div>
                        <div class="modal-footer">
                           
                        </div>
                      </div>
                    </div>
                  </div>  
          </div>
                
<!-- OTHER INFORMATION -->
<!-- OTHER INFORMATION -->

      <div class="panel-tab-content">
        <?php
          $user_other =  $db->select("SELECT * FROM other_info WHERE userid = :userid ",array('userid'=>$_SESSION['userid']));
          if (count($user_other) == 0){
        ?>
              <li style="list-style: none; font-size: 20px;"><i class="fa fa-info-circle info" aria-hidden="true"></i> Other Information
              <button type="button" class="btn btn-info btn-xs button-bg" data-toggle="modal" data-target="#myModalothers"><i class="fa fa-plus" aria-hidden="true"></i> </button>
              </li><hr>
              <div class="modal fade" id="myModalothers" role="dialog">
                  <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add other information</h4>
                        </div>
                        <div class="modal-body">
                          <form method="post" name="form1" action="">
                            <table>
                              <tr> 
                                <td>Lives in</td>
                                <td><input type="text" name="livesin" class="form-control"></td> 
                              </tr>

                              <tr> 
                                <td>Comes from</td>
                                <td><input type="text" name="comesfrom" class="form-control"></td> 
                              </tr>

                              <tr> 
                                <td>Relationship</td>
                                <td><input type="text" name="relationship" class="form-control"></td> 
                              </tr>

                                <tr> 
                                <td></td>
                                <td><input type="submit" name="addother" value="Add" class="btn btn-primary pull-right"></td>
                              </tr>
                            </table>
                          </form> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>  

      
            <?php 

            }else{

                foreach ($user_other as $value_other) {

            ?>
          <?php
              if ($value_other['livesin']!="") {
           ?>  
                <div style="margin-top: 25px; margin-bottom: 20px;">
                  <li style="list-style: none; font-size: 20px;"><i class="fa fa-globe info" aria-hidden="true"></i> Others Information &nbsp
                   <div class="dropdown pull-right">
                          <i class="btn dropdown-toggle fa fa-pencil-square-o info" type="button" data-toggle="dropdown"></i>

                            <ul class="dropdown-menu "> 

                                <li >
                                   <a href="edit.php?others_id=<?php echo $value_other['otherid']; ?>" class="edit_drop">EDIT<i class="fa fa-pencil info" aria-hidden="true"></i>  </a> 
                                </li>
                                <li > <a href="delete.php?others_id=<?= $value_other['otherid']; ?>" class="edit_drop" title="click for delete" onclick="return confirm('sure to delete ?')">DELETE<i class="fa fa-trash info" aria-hidden="true"></i></a>
                                </li>

                            </ul>
                  </div>
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
          $user_bio =  $db->select("SELECT * FROM bio WHERE userid = :userid ",array('userid'=>$_SESSION['userid'])); 
          if (count($user_bio) == 0) 
          {
        ?>  
            <li style="list-style: none; font-size: 20px;"><i class="fa fa-info-circle info" aria-hidden="true"></i> About Yourself &nbsp
            <button type="button" class="btn btn-info btn-xs button-bg" data-toggle="modal" data-target="#myModalbio"><i class="fa fa-plus" aria-hidden="true"></i> </button>
              </li><hr>
              <div class="modal fade" id="myModalbio" role="dialog">
                  <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Bio</h4>
                        </div>
                        <div class="modal-body">
                          <form method="post" name="form1" action="" >
                            <table>
                              <tr> 
                                <td>Add your bio</td>
                                <td><input type="text" name="biotext" class="form-control"></td>  
                                </tr>

                                <tr> 
                                <td></td>
                                <td><input type="submit" name="save" value="Add" class="btn btn-primary pull-right"></td> 
                              </tr>
                            </table>
                          </form>
                        </div>
                        <div class="modal-footer">
                           
                        </div>
                      </div>
                    </div>
                  </div>  
       
            

        <?php
        }
        else
        {
        foreach ($user_bio as  $value_bio) 
        {
        ?>

             <div style="margin-bottom: 5px;">
                <li style="list-style: none; font-size: 20px;"><i class="fa fa-info-circle info" aria-hidden="true"></i> About Yourself  
                <div class="dropdown pull-right">
                          <i class="btn dropdown-toggle fa fa-pencil-square-o info" type="button" data-toggle="dropdown"></i>

                            <ul class="dropdown-menu "> 

                                <li >
                                   <a style="margin:right;" href="edit.php?bio_id=<?php echo $value_bio['bioid']; ?>" class="edit_drop">EDIT<i class="fa fa-pencil info" aria-hidden="true"></i>  </a> 
                                </li>
                                <li > <a href="delete.php?bio_id=<?= $value_bio['bioid']; ?>" class="edit_drop" title="click for delete" onclick="return confirm('sure to delete ?')">DELETE<i class="fa fa-trash info" aria-hidden="true"></i></a>
                                </li>

                            </ul>
                  </div>  
                
                  
             </div> 
             <hr>
               <li style="list-style: none; font-size: 15px;"><span class="info2"><?php echo $value_bio['biotext']; ?> </span></li> 

        <?php }} ?>

            </div> <!--panel tab content -->


            </div>
        </div>
  </div>
</div>



  



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