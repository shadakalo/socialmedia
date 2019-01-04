<?php include 'header.php'; ?>

<?php include 'nav.php'; ?>
<div class="clear">
</div>
<?php include 'sidebar.php'; ?>

     <div class="grid_10">
        
            <div class="box round first grid">
                <h2> SEARCH USERS</h2>
                                <div class="block col-md-5">



                                   <form class="navbar-form"  action="" method="POST">
                                        <div class="form-group" style="display:inline;">
                                          <div class="input-group" style="display:table;">

                                        
                                              <input type="text" class="form-control" name="text" placeholder="Search...">
                                              <span class="input-group-addon" style="width:1%;">
                                                  <input type="submit" name="search" value="search" hidden>  <span class="glyphicon glyphicon-search"></span> 
                                              </span>
                                
                                            
                                          </div>
                                        </div>
                                  </form>

                                </div><hr>


<?php

    if (isset($_POST['search'])) {
        

        $search_text = $_POST['text'];



         $result = $db->select("SELECT * FROM users WHERE firstname LIKE '%$search_text%' OR  lastname LIKE '%$search_text%' ",array('firstname'=>'%$search_text%', 'lastname'=>'%$search_text%'));

          if (count($result) == 0 ) {
            echo "<span style='color:red'> *** No result found</span>";
          }


          foreach ($result as $key) {
              
?>

        <div class="col-md-6" style="margin-bottom: 30px;">

<?php

       $block_list = $db->select("SELECT * FROM block_admin WHERE userid = :userid",array('userid'=>$key['userid']));
?>
      <i class="fa fa-user-secret" aria-hidden="true"></i>&nbsp<?php echo $key['firstname']." ".$key['lastname']  ?> ( <?php echo $key['userid'];?> )
<?php
       if (count($block_list) == 0) {

      

?>


            
            <a style=" color: #fff; padding: 5px; background-color: red; border-radius: 5px;margin-left: 5px; "  onclick="return confirm('Are you sure ??');" href="block.php?userid=<?php echo base64_encode($key['userid']); ?>">Block </a>

<?php

   }else{
?>

           <a style=" color: #fff; padding: 5px; background-color: green; border-radius: 5px;margin-left: 5px; "  onclick="return confirm('Are you sure ??');" href="unblock.php?userid=<?php echo base64_encode($key['userid']); ?>">Unblock </a>
<?php    
   }

?>
        </div>

<?php
          }

    }

?>                       
                                
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
  <?php include 'footer.php'; ?>