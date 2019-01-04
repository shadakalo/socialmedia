<?php include 'header.php'; ?>


<?php include 'nav.php'; ?>
<div class="clear">
</div>
<?php include 'sidebar.php'; ?>

     <div class="grid_10">
        
            <div class="box round first grid">
                <h2> Title & Slogan</h2>
                <div class="col-md-4 block">               
<?php

    $msg = "";
    if (isset($_POST['title_submit'])) {
        
        $title =   $_POST['title'];

        if (empty($title)) {
           echo "<span style = 'color:red;'>Please enter your new title !!!</span>";
        }else{


              if($db->update("UPDATE title SET title_media = :title_media WHERE id = 1",array('title_media'=>$title)))

              echo "<span style = 'color:green;'>Title Updated Successfully !!!</span>";
              echo "<script>window.location='titleslogan.php';</script>";
        }

     

    }


?>

                    <form action="" method="post">
                    <div class="form-group">
                      <label for="title">Title  :</label>
                     <input type="text" name="title" class="form-control" placeholder="Update Title... ">
                    </div>
                       
                     <input type="submit" name="title_submit" class="btn btn-info " value="update" style="margin-bottom: 10px;">
                    </form>


                </div><hr>

                <div class="col-md-4 block" >               
<?php

    $msg = "";
    if (isset($_POST['slogan_submit'])) {
        
        $slogan =   $_POST['slogan'];

        if (empty($slogan)) {
           echo "<span style = 'color:red;'>Please enter your new slogan !!!</span>";
        }else{


              if($db->update("UPDATE slogan SET slogan_media = :slogan_media WHERE id = 1",array('slogan_media'=>$slogan)))

            echo "<span style = 'color:green;'>Slogan Updated Successfully !!!</span>";
            echo "<script>window.location='titleslogan.php';</script>";
            
        }

     

    }


?>

                    <form action="" method="post">
                    <div class="form-group">
                      <label for="slogan">Slogan : </label>
                     <input type="text" name="slogan" class="form-control" placeholder="Update slogan... ">
                    </div>
                       
                     <input type="submit" name="slogan_submit" class="btn btn-info " value="update">
                    </form>


                </div>

            
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
  <?php include 'footer.php'; ?>