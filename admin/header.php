
<?php
   session_start();
   $path = $_SERVER['DOCUMENT_ROOT']; // starts with root directory such as wamp/www or xammp/htdocs
   $dbpath = $path."/social/class/Database.php";// for including database class
   $helperspath = $path."/social/class/helpers.php";// for including helpers class
   include_once($dbpath);
   include_once($helperspath);
   $db = new Database(); // object for db
   $helpers = new Format(); // object for helpers

    if ($_SESSION['login'] == false) {
        echo "<script>window.location='login.php';</script>";
    }else{
        $admin_details =  $db->select_one_row("SELECT * FROM admin WHERE id = :id",array('id'=>$_SESSION['id']));
    }


?>

<?php

    $users = $db->select("SELECT * FROM users");
    $users_log = $db->select("SELECT * FROM users WHERE log_status = 1");
    $users_active = $db->select("SELECT * FROM users WHERE activate = 1");
    $users_inactive = $db->select("SELECT * FROM users WHERE activate = 0");
    $users_blocked = $db->select("SELECT * FROM block_admin");
   


?>




<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="icon" href="./favicon.ico?v1" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico?v1" type="image/x-icon" />
    <title> Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/ion-icons/css/ionicons.css">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });

      


    </script>
    <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();


        });
    </script>


    <style type="text/css">
        a{
            text-decoration: none;
            color: black;

        }

        a:hover{
            text-decoration: none;
            color: black;

        }

        .btn-info{

                color: #FFF; background-color: #204562;border-radius: 5px;border-color: #204562;
        }

        .btn-info:hover{

                color: #FFF; background-color: #315C7C;border-radius: 5px;border-color: #204562;
        }


    </style>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/logo.png" alt="Logo" />
                </div>
                <div class="floatleft middle">
                    <h1>
                        
                         <?php

                            $title = $db->select_one_row("SELECT * FROM title WHERE id = 1");
                            echo strtoupper($title['title_media']);

                           ?>

                    </h1>
                    <p>
                        
                        <?php

                        $title = $db->select_one_row("SELECT * FROM slogan WHERE id = 1");
                        echo $title['slogan_media'];

                       ?>


                    </p>
                </div>
                <div class="floatright">
                    <div class="floatleft">
                        <i class="fa fa-user-secret" aria-hidden="true" style="color: #fff; font-size: 24px;"></i></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php echo $admin_details['name'] ?></li>
                            <li><a href="logout.php" onclick="return confirm('are you sure ??')">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>