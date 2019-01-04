<?php include 'header.php'; ?>

    <!--Main content-->
      <div class="container">
            <!-- cover profile and profile nav-->
            <!-- cover profile and profile nav-->

<?php include 'profilenav.php'; ?>

          <!-- cover profile and profile nav end-->
          <!-- cover profile and profile nav end-->
<?php


// BIO CODE START HERE

	if(isset($_POST['addbio'])) 

  {
      $userid = $_SESSION['userid'];
      $bioid =$_GET['bio_id'];
      $biotext = $_POST['biotext'];

      if(empty($biotext))
    {
      $errMSG = "Please update your bio.";
    }

    else 
    {
       
      $user_bio = $db->update("UPDATE bio SET biotext=:biotext WHERE userid=:userid AND bioid=:bioid ",array('biotext'=>$biotext,'userid'=>$userid,'bioid'=>$bioid));

       echo  "<script>alert('Bio updated seccessfully');</script>"; 
       echo "<script>window.location='about.php';</script>";

    }
   
  }
 
if(isset($_GET['bio_id']) && !empty($_GET['bio_id']))
{
    $id = $_GET['bio_id'];
    $biotext= $db->select('SELECT biotext FROM bio WHERE bioid =:bioid',array('bioid'=>$id));
    foreach ($biotext as $bio) {
        $bio['biotext'];
    }

?>
          <div class="row main-row">
            <div class="col-md-11 ">
              <?php
              if(isset($errMSG))
              {
                echo $errMSG;
              }

              ?>
         <li style="list-style: none; font-size: 20px;"><i class="fa fa-globe info" aria-hidden="true"></i> About Yourself</li>
        <hr>

        <form method="post" name="form1" action="">
          <table width="30%" border="0">
            <tr> 
              <td>Add your bio : </td>

               
            <td><input type="text" name="biotext" value="<?= $bio['biotext'];?>" class="form-control aboutinput"></td> 
            </tr>

            <tr> 
            <td></td>
            <td><input type="submit" name="addbio" value="UPDATE" class="btn aboutbtn"></td>
            </tr>
          </table>
        </form>
            
          </div>
          </div>
   <?php 

}

// BIO CODE END HERE

?>


<?php

// WORK CODE START

	if(isset($_POST['addwork'])) 

  {

      $userid = $_SESSION['userid'];
      $workid = $_GET['work_id'];
      $company = $_POST['company'];
      $designation = $_POST['designation'];
      if(empty($company))
    {
      $errMSG = "Please update your company.";
    }

    else 
    {
       
      $user_works = $db->update("UPDATE work SET company=:company,designation=:designation WHERE userid=:userid AND workid=:workid",array('company'=>$company,'designation'=>$designation,'userid'=>$userid,'workid'=>$workid));

         echo  "<script>alert('Work updated seccessfully');</script>"; 
         echo "<script>window.location='about.php';</script>";
          
    }   
  }

	if(isset($_GET['work_id']) && !empty($_GET['work_id']))
	{
    $id = $_GET['work_id'];
    $stmt= $db->select('SELECT company,designation FROM work WHERE workid =:workid',array('workid'=>$id));
   
    foreach ($stmt as $work) {

        $work['company'];
        $work['designation'];
    }

?>
          <div class="row main-row">
            <div class="col-md-11 ">

              <?php
                  if(isset($errMSG))
                  {
                    echo $errMSG;
                  }

              ?>
        <li style="list-style: none; font-size: 20px;"><i class="fa fa-briefcase info" aria-hidden="true"></i> Work Experience</li>

        <hr>

        <form method="post" name="form1" action="">
          <table width="50%" border="0">
            <tr> 
              <td>Add your company :</td>
              <td><input type="text" name="company" value="<?=$work['company']; ?>" class="form-control aboutinput"  ></td> 
              </tr>

              <tr>
              <td>Add your designation :             </td>
              <td><input type="text" name="designation" value="<?=$work['designation']; ?>" class="form-control aboutinput"></td> 
              </tr>

              <tr> 
              <td></td>
              <td><input type="submit" name="addwork" value="Add Work" class="btn aboutbtn"></td>
            </tr>
          </table>
        </form>
            
            </div>
          </div>
   <?php 

}

// WORK CODE END

?>



<?php

// EDUCATION CODE START HERE

	if(isset($_POST['addedu'])) 

  {
      $userid = $_SESSION['userid'];
      $educationid = $_GET['education_id'];
      $institute = $_POST['institute'];
      $subject = $_POST['subject'];
      $degree = $_POST['degree'];
      if(empty($institute))
    {
      $errMSG = "Please update your institute.";
    }

    else 
    {
       
      $user_education = $db->update("UPDATE education SET institute=:institute,subject=:subject,degree=:degree WHERE userid=:userid AND educationid=:educationid",array('institute'=>$institute,'subject'=>$subject,'degree'=>$degree,'educationid'=>$educationid,'userid'=>$userid));

         echo  "<script>alert('Education updated seccessfully');</script>"; 
         echo "<script>window.location='about.php';</script>";
          
    }
   
  }

	if(isset($_GET['education_id']) && !empty($_GET['education_id']))
	{ 
    $id = $_GET['education_id'];
    $stmt= $db->select('SELECT userid,institute,subject,degree FROM education WHERE educationid =:educationid',array('educationid'=>$id));
    foreach ($stmt as $education) {

        $education['institute'];
        $education['subject'];
        $education['degree'];
    }

?>
          <div class="row main-row">
            <div class="col-md-11 ">
              <?php
      if(isset($errMSG))
      {
        echo $errMSG;
      }

      ?>

        <li style="list-style: none; font-size: 20px;"><i class="fa fa-book info" aria-hidden="true"></i> Education</li> <hr>

        <form method="post" name="form1" action="">
          <table width="35%" border="0">
            <tr> 
              <td>Add your education :</td>
              <td><input type="text" name="institute" value="<?= $education['institute'];?>" class="form-control aboutinput"></td> 
              </tr>

              <tr>
              <td>Add your subject :</td>
              <td><input type="text" name="subject" value="<?= $education['subject'];?>" class="form-control aboutinput"></td> 
              </tr>

              <tr>
              <td>Add your degree :</td>
              <td><input type="text" name="degree" value="<?= $education['degree'];?>" class="form-control aboutinput"></td> 
              </tr>

              <tr> 
              <td></td>
              <td><input type="submit" name="add edu" value="UPDATE" class="btn aboutbtn "></td>
            </tr>
          </table>
        </form>
            
            </div>
          </div>
   <?php 

}

// Education start END
?>


<?php

// OTHERS INFO CODE START HERE

	if(isset($_POST['addother'])) 

  {
      $userid = $_SESSION['userid'];
      $livesin = $_POST['livesin'];
      $comesfrom = $_POST['comesfrom'];
      $relationship = $_POST['relationship'];
      if(empty($livesin))
    {
      $errMSG = "Please update your livesin.";
    }

    else 
    {
       
      $user_other = $db->update("UPDATE other_info SET livesin=:livesin,comesfrom=:comesfrom,relationship=:relationship WHERE userid=:userid",array('livesin'=>$livesin,'comesfrom'=>$comesfrom,'relationship'=>$relationship,'userid'=>$userid));
          
          echo  "<script>alert('Info updated seccessfully');</script>"; 
         echo "<script>window.location='about.php';</script>";
    }
   
  }

	if(isset($_GET['others_id']) && !empty($_GET['others_id']))
	{  
    $id = $_GET['others_id'];
    $stmt= $db->select('SELECT userid,livesin,comesfrom,relationship FROM other_info WHERE otherid =:otherid',array('otherid'=>$id));
    foreach ($stmt as $other) {

        $other['livesin'];
        $other['comesfrom'];
        $other['relationship'];
    }

?>
          <div class="row main-row">
            <div class="col-md-11 ">
        <?php
      if(isset($errMSG))
      {
        echo $errMSG;
      }
      ?>

        <li style="list-style: none; font-size: 20px;"><i class="fa fa-info-circle info" aria-hidden="true"></i> Other Information</li><hr>    
         
        <form method="post" name="form1" action="">
          <table width="30%" border="0">
            <tr> 
              <td>Lives in :</td>
              <td><input type="text" name="livesin" value="<?=  $other['livesin']; ?>" class="form-control aboutinput"></td> 
            </tr>

            <tr> 
              <td>Comes from :</td>
              <td><input type="text" name="comesfrom" value="<?=  $other['comesfrom']; ?>" class="form-control aboutinput"></td> 
            </tr>

            <tr> 
              <td>Relationship :</td>
              <td><input type="text" name="relationship" value="<?=  $other['relationship']; ?>" class="form-control aboutinput"></td> 
            </tr>

              <tr> 
              <td></td>
              <td><input type="submit" name="addother" value="Add Info" class="btn aboutbtn"></td>
            </tr>
          </table>
        </form>
            
          </div>
          </div>
   <?php 

}

// OTHERS INFO CODE END 
?>







          <!-- Newsfeed Common Side Bar Right  -->
          <!-- Newsfeed Common Side Bar Right  -->
      <?php include 'chatbar.php'; ?>         
            <!-- Newsfeed Common Side Bar Right end -->
            <!-- Newsfeed Common Side Bar Right  end-->


   
          </div><!--main content  end --> 
    <!--Main content END-->

<?php include 'footer.php'; ?>


  

  
   
    
