<?php include 'header.php'; ?>

<?php include 'nav.php'; ?>
<div class="clear">
</div>
<?php include 'sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Pending Users</h2>

                 <div class="block">               
                    
                  <i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp  Pending Users = <?php echo count($users_inactive); ?> 

                </div>

                <div class="block">  
<?php
    if (count($users_inactive) == 0 ) {
        echo "No user found";
    }else{

?>      
                    <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th><center>Id</center></th>
                            <th><center>First Name</center></th>
                            <th><center>Last Name</center></th>
                            <th><center>Email</center></th>
                            <th><center>Activity</center></th>
                            <th><center>Log Status</center></th>
                            <th><center>Action</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

foreach ($users_inactive as $value) {
        
    $block = $db->select_one_row("SELECT * FROM block_admin WHERE userid = :userid",array('userid'=>$value['userid']));

 ?>



        <tr class="odd gradex">
            <td><center><?php echo $value['userid']; ?></center></td>
            <td><center><?php echo $value['firstname']; ?></center></td>
            <td><center><?php echo $value['lastname']; ?></center></td>
            <td><center><?php echo $value['email']; ?></center></td>
            <td><center><?php echo $value['activate']; ?></center></td>
            <td><center><?php echo $value['log_status']; ?></center></td>
            <td><center>

<?php

    if ($block == false) {
?>
        <a onclick="return confirm('Are you sure ??');" href="block.php?userid=<?php echo base64_encode($value['userid']); ?>"> Block </a>

<?php
    }else{

?>

    <a onclick="return confirm('Are you sure ??');" href="unblock.php?userid=<?php echo base64_encode($value['userid']); ?>"> Unblock </a>



<?php

    }

?>
             


              <center></td>

        </tr>
<?php

}

 ?>
                     
                    </tbody>
                </table>

<?php

}

?>


   
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
<?php include 'footer.php'; ?>