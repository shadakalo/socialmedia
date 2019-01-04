<?php include 'header.php'; ?>

    <!--Main content-->
      <div class="container">
            <!-- cover profile and profile nav-->
            <!-- cover profile and profile nav-->

<?php include 'profilenav.php'; ?>

          <!-- cover profile and profile nav end-->
          <!-- cover profile and profile nav end-->

<!-- deleting the row from WORK  -->

    <?php 

        if(isset($_GET['bio_id']))
        {
      
        $bioid = $_GET['bio_id'];
        $user_bio = $db->delete("DELETE FROM bio WHERE bioid=:bioid",array('bioid'=>$bioid));
        echo "<script>window.location='about.php';</script>";
        }
    ?>
<!-- deleting the row from WORK end-->



<!-- deleting the row from WORK  -->

    <?php 

        if(isset($_GET['work_id']))
        {
      
        $workid = $_GET['work_id'];
        $user_works = $db->delete("DELETE FROM work WHERE workid=:workid",array('workid'=>$workid));
        echo "<script>window.location='about.php';</script>";
        }
    ?>
<!-- deleting the row from WORK end-->



<!-- deleting the row from Education  -->

    <?php 

        if(isset($_GET['education_id']))
        {
      
        $educationid = $_GET['education_id'];
        $user_education = $db->delete("DELETE FROM education WHERE educationid=:educationid",array('educationid'=>$educationid));
        echo "<script>window.location='about.php';</script>";
        }
    ?>
<!-- deleting the row from Education end-->



<!-- deleting the row from Other Info  -->

    <?php 

        if(isset($_GET['others_id']))
        {
      
        $otherid = $_GET['others_id'];
        $user_other = $db->delete("DELETE FROM other_info WHERE otherid=:otherid",array('otherid'=>$otherid));
        echo "<script>window.location='about.php';</script>";
        }
    ?>
<!-- deleting the row from Other Info end-->




          <!-- Newsfeed Common Side Bar Right  -->
          <!-- Newsfeed Common Side Bar Right  -->
      <?php include 'chatbar.php'; ?>         
            <!-- Newsfeed Common Side Bar Right end -->
            <!-- Newsfeed Common Side Bar Right  end-->


   
          </div><!--main content  end --> 
    <!--Main content END-->

<?php include 'footer.php'; ?>


  

  
   
    
