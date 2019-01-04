<?php include 'header.php'; ?>

<?php include 'nav.php'; ?>
<div class="clear">
</div>
<?php include 'sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Blocked Users</h2>

                 <div class="block" style="color: red;">               
                    
                 <i class="fa fa-user-times" aria-hidden="true"></i>&nbsp   Blocked Users = <?php echo count($users_blocked); ?>

                </div>

                <div class="block">  
<?php
    if (count($users_blocked) == 0 ) {
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

    foreach ($users_blocked as  $value_blocked) {
        
    $block = $db->select_one_row("SELECT * FROM users WHERE userid = :userid",array('userid'=>$value_blocked['userid']));

?>      

<?php 


        
  

 ?>



        <tr>
            <td><center><?php echo $block['userid']; ?></center></td>
            <td><center><?php echo $block['firstname']; ?></center></td>
            <td><center><?php echo $block['lastname']; ?></center></td>
            <td><center><?php echo $block['email']; ?></center></td>
            <td><center><?php echo $block['activate']; ?></center></td>
            <td><center><?php echo $block['log_status']; ?></center></td>
            <td><center> <a onclick="return confirm('Are you sure ??');" href="unblock.php?userid=<?php echo base64_encode($value_blocked['userid']); ?>"> Unblock </a><center></td>

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