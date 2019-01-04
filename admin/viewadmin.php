<?php include 'header.php'; ?>


<?php include 'nav.php'; ?>
<div class="clear">
</div>
<?php include 'sidebar.php'; ?>


 <?php



      $admin_check =  $db->select("SELECT * FROM admin");


?>


     <div class="grid_10">
        
            <div class=" box round first grid">
                <h2> All Admin</h2>
                   


                <div class="block">
                  
                <i class="fa fa-eye" aria-hidden="true"></i>&nbsp  Admin Count = <?php echo count($admin_check);  ?>

                </div>
      
                <div class="block">  


                    <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th><center>Id</center></th>
                            <th><center>Name</center></th>
                            <th><center>Email</center></th>
                            <th><center>Delete</center></th>
                        </tr>
                    </thead>
                    <tbody>
        

 <?php
 
        foreach ($admin_check as $key_admin) {
?>


        <tr class="odd gradex">
            <td><center><?php echo $key_admin['id']; ?></center></td>
            <td><center><?php echo $key_admin['name']; ?></center></td>
            <td><center><?php echo $key_admin['email']; ?></center></td>
            <td><center><a onclick="return confirm('Are you sure ??');" href="deleteadmin.php?id=<?php echo base64_encode($key_admin['id']); ?>"> Delete </a></center></td>
        </tr>
  <?php

    }

  ?>              
                 </tbody>
                </table>
            </div>


            </div>
        </div>
        
        <div class="clear">
        </div>
    </div>
  <?php include 'footer.php'; ?>