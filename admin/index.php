<?php include 'header.php'; ?>


<?php include 'nav.php'; ?>
<div class="clear">
</div>
<?php include 'sidebar.php'; ?>

     <div class="grid_10">
        
            <div class="box round first grid">
                <h2> Dashbord</h2>

                <div class="block">               
                    
                  <i class="fa fa-users" aria-hidden="true"></i>&nbsp  Total User Count = <?php echo count($users); ?> 

                </div>
                 <div class="block">               
                    
                 <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp   Activated Users = <?php echo count($users_active); ?> 

                </div>
                 <div class="block">               
                    
                 <i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp  Activation Pending Users = <?php echo count($users_inactive); ?> 

                </div>

                <div class="block">               
                    
                  <i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp  Logged in Users = <?php echo count($users_log); ?> 

                </div>
                <div class="block" style="color: red;">               
                    
                 <i class="fa fa-user-times" aria-hidden="true"></i>&nbsp   Blocked Users = <?php echo count($users_blocked); ?>

                </div>

                <div class="block">               
                    
                   <a href="logoutall.php" style="color: #FFF; background-color: #204562;padding: 10px; border-radius: 5px;">Log Out all users</a>

                </div>

            </div>
        </div>
        
        <div class="clear">
        </div>
    </div>
  <?php include 'footer.php'; ?>