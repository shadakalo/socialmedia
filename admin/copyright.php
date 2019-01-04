<?php include 'header.php'; ?>

<?php include 'nav.php'; ?>
<div class="clear">
</div>
<?php include 'sidebar.php'; ?>

     <div class="grid_10">
        
            <div class="box round first grid">
                <h2> Copyright</h2>
                <div class="col-md-4 block">               
<?php

    $msg = "";
    if (isset($_POST['copy_submit'])) {
        
        $copy =   $_POST['copy'];

        if (empty($copy)) {
           echo "<span style = 'color:red;'>Please enter owner !!!</span>";
        }else{


              if($db->update("UPDATE copyr8 SET copy = :copy WHERE id = 1",array('copy'=>$copy)))

            echo "<span style = 'color:green;'>Copyright Updated Successfully !!!</span>";

        }

     

    }


?>

                    <form action="" method="post">
                    <div class="form-group">
                     <input type="text" name="copy" class="form-control" placeholder="Copyright Text ...">
                    </div>
                       
                     <input type="submit" name="copy_submit" class="btn btn-info " value="update" style="margin-bottom: 10px;">
                    </form>


                </div><hr>

   

            
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
  <?php include 'footer.php'; ?>