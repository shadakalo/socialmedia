 
    <div class="clear">
    </div>
    <div id="site_info">
        <p>
         &copy;  <?php

	    $title = $db->select_one_row("SELECT * FROM copyr8 WHERE id = 1");
	    echo $title['copy'];

  			 ?>
    All Rights Reserved.
        </p>
    </div>
</body>
</html>
