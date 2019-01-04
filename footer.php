  <!-- Footer -->
    
    <footer id="footer">
      <div class="container">
        <div class="row">
          <div class="footer-wrapper">
            <div class="copyright">
              <p> <a href="http://localhost/social/index.php">&copy; 

   <?php

    $title = $db->select_one_row("SELECT * FROM copyr8 WHERE id = 1");
    echo $title['copy'];

   ?>
               </a> &nbsp&nbspAll rights reserved </p>
            </div>
            
          </div>
        </div>
      </div>
    </footer>
      <!-- Footer -->
   
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/image.js"></script>
    <script src="js/text.js"></script>

 
    
  

</body>
</html>