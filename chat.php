<?php
   session_start();

   $url="index.php";
   header("Refresh: 10; URL=$url");

   $path = $_SERVER['DOCUMENT_ROOT']; // starts with root directory such as wamp/www or xammp/htdocs
   $dbpath = $path."/social/class/Database.php";// for including database class
   $helperspath = $path."/social/class/helpers.php";// for including helpers class
   include_once($dbpath);
   include_once($helperspath);
   $db = new Database(); // object for db
   $helpers = new Format(); // object for helpers

	if ($_SESSION['login'] == false) {
		echo "<script>window.location='index.php';</script>";
	}else{
		$user_details =  $db->select_one_row("SELECT * FROM users WHERE userid = :userid",array('userid'=>$_SESSION['userid']));
		if ($user_details['log_status'] == 0){

			echo "<script>alert('Session expired... Login again please... ');</script>";
			session_destroy();
			unset($_SESSION['login']);
			echo "<script>window.location='index.php';</script>";
		}
	}


//image code 
//image code

  $profile_image_details = $db->select_one_row("SELECT * FROM profile_images WHERE user_id = :user_id ORDER BY profile_image_time DESC",array('user_id' => $_SESSION['userid']));

  if ($profile_image_details == false) {
      
      $profile_image_details['profile_image'] = 'images/profileimages/demo.png';

  }

  $cover_image_details = $db->select_one_row("SELECT * FROM cover_images WHERE user_id = :user_id ORDER BY cover_image_time DESC",array('user_id' => $_SESSION['userid']));

  if ($cover_image_details == false) {
      
      $cover_image_details['cover_image'] = 'images/profileimages/demo.png';

  }


?>
<?php  
 date_default_timezone_set('Asia/Dhaka');  
 function facebook_time_ago($timestamp)  
 {  
      $time_ago = strtotime($timestamp);  
      $current_time = time();  
      $time_difference = $current_time - $time_ago;  
      $seconds = $time_difference;  
      $minutes      = round($seconds / 60 );           // value 60 is seconds  
      $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
      $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
      $weeks          = round($seconds / 604800);          // 7*24*60*60;  
      $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
      $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
      if($seconds <= 60)  
      {  
     return "Just Now";  
   }  
      else if($minutes <=60)  
      {  
     if($minutes==1)  
           {  
       return "one minute ago";  
     }  
     else  
           {  
       return "$minutes minutes ago";  
     }  
   }  
      else if($hours <=24)  
      {  
     if($hours==1)  
           {  
       return "an hour ago";  
     }  
           else  
           {  
       return "$hours hrs ago";  
     }  
   }  
      else if($days <= 7)  
      {  
     if($days==1)  
           {  
       return "yesterday";  
     }  
           else  
           {  
       return "$days days ago";  
     }  
   }  
      else if($weeks <= 4.3) //4.3 == 52/12  
      {  
     if($weeks==1)  
           {  
       return "a week ago";  
     }  
           else  
           {  
       return "$weeks weeks ago";  
     }  
   }  
       else if($months <=12)  
      {  
     if($months==1)  
           {  
       return "a month ago";  
     }  
           else  
           {  
       return "$months months ago";  
     }  
   }  
      else  
      {  
     if($years==1)  
           {  
       return "one year ago";  
     }  
           else  
           {  
       return "$years years ago";  
     }  
   }  
 }  
 ?> 
<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="10">
    <title><?php echo $user_details['firstname']; ?></title>

    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/ion-icons/css/ionicons.css">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    <script type="text/javascript" src="js/multiplepageajax.js"></script>
<style type="text/css">
    textarea {
        resize: vertical;
    }

    .btnfrnd {

        background-image: -webkit-linear-gradient(bottom, #4A2849, #93628F);
        background: linear-gradient(to bottom, rgb(74, 40, 73, .8), rgb(147, 98, 143, .8));
        background-size: cover;
        border-color: rgb(147, 98, 143);
        color: #fff;
        border-radius: 0;

    }

    .btnfrnd:hover {
        background-image: -webkit-linear-gradient(bottom, #4A2849, #93628F);
        background: linear-gradient(to bottom, rgb(74, 40, 73, .8), rgb(147, 98, 143, .8));
        background-size: cover;
        border-color: rgb(147, 98, 143);
        color: #fff;
    }

    .frnd-img {

        height: 96px;
        padding: 0px;
        padding-bottom: 3px;

    }

    .imagediv {
        float: left;
        position: relative;
        width: 96px;

    }

    .imgtxt {
        position: absolute;
        top: 70px;
        left: 10px;
        color: #fff;
        font-weight: normal;
    }

    textarea {

        overflow: hidden;
        min-height: 70px;
        margin-bottom: 5px;

    }

    .create-post {
        border-radius: 10px;
        width: 100%;
        min-height: 70px;
        padding: 5px;
        margin-bottom: 20px;
        border-bottom: 1px solid #f1f2f2;
        background-image: -webkit-linear-gradient(bottom, #4A2849, #93628F);
        background: #ADA996;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #ADA996, #DBDBDB, #F2F2F2, #EAEAEA);
        /* Chrome 10-25, Safari 5.1-6  DBDBDB*/
        background: linear-gradient(to right, #ADA996, #DBDBDB, #F2F2F2, #EAEAEA);
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .create-post .form-group img.profile-photo-md {
        margin-right: 10px;
    }

    .create-post .form-group .form-control {
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        width: 400px;
        height: auto;
    }

    .image-upload>input {
        display: none;
    }

    .postimg {

        color: rgb(74, 40, 73);
        cursor: pointer;
        transition: 1s;

    }

    .postimg:hover {
        font-size: 16px;
    }

    .showpostimg {
        width: 50%;
        height: auto;
        padding: 6px;
    }

    img.profile-photo-md {
        height: 50px;
        width: 50px;
        border-radius: 50%;
        position: relative;
        left: 5px;
    }

    .btn-primary {
        background: rgb(74, 40, 73);
        padding: 7px 25px;
        border: none;
        font-size: 14px;
        border-radius: 4px;
        color: #fff;
        position: relative;
        font-weight: 600;
        outline: none;
        border-radius: 30px;
        top: 7px;
        left: -6px;
    }


    /*for post and post comment*/

    .post_header {
        display: flex;
        position: relative;
        left: -10px;
        margin-bottom: 0px;
    }

    .post_header div {

        padding: 0px;
        padding-left: 18px;
        line-height: 18px;
        position: relative;
        top: 6px;
    }

    .post_name {

        font-weight: bolder;
        color: rgb(74, 40, 73);
        font-size: 16px;
    }

    .post_date {

        font-weight: bolder;
        color: grey;
        font-size: 12px;
    }

    .post_like {
        background-color: #fff;
        color: #3366ff;
        margin: 10px 5px;
        border: 1px solid #3366ff;
        border-radius: 15%;
    }

    .post_dislike {
        background-color: #fff;
        color: #cc6600;
        margin: 10px 5px;
        border: 1px solid #cc6600;
        border-radius: 15%;
    }

    .post_heart {
        background-color: #fff;
        color: #ff0000;
        margin: 10px 5px;
        border: 1px solid #ff0000;
        border-radius: 15%;
    }

    .post-image {
        width: 100%;
        height: auto;
        padding: 0px;
        box-shadow: 0 0 2px 0;

    }

    .edit_drop {
        background-color: #fff;
        box-shadow: 0 0 1px 1px;
    }

    .post_pre {
        background-color: #fff;
        border: 0px;
    }

    hr {
        margin: 0px;
    }

    .edit_post_button {
        position: relative;
        left: 450px;
        margin-bottom: 20px;
    }

    .comment_text {
        min-height: 30px;
        width: 130%;
        border-radius: 10px;
    }

    .comment_text:focus {
        border: 1px solid rgb(74, 40, 73);

    }

    .comment-photo {
        height: 35px;
        width: 35px;
        border-radius: 50%;

    }

    .comment_div {
        display: flex;
        padding: 5px 15px;
        background-color: #ddd;
        border-radius: 10%;
        margin: 5px;
    }

    .cmnt_txt {
        color: #000;
        line-height: 18px;
        margin-left: 5px;
    }

    .cmnta:hover {
        color: rgb(74, 40, 73);
    }

    .post_like2 {
        background-color: #3366ff;
        color: #fff;
        margin: 10px 5px;
        border: 1px solid #3366ff;
        border-radius: 15%;
    }

    .post_dislike1 {
        background-color: #cc6600;
        color: #fff;
        margin: 10px 5px;
        border: 1px solid #cc6600;
        border-radius: 15%;
    }

    .post_heart1 {
        background-color: #ff0000;
        color: #fff;
        margin: 10px 5px;
        border: 1px solid #ff0000;
        border-radius: 15%;
    }

    .profile_image {

        width: 50%;
        height: auto;


    }

    .BroweForFile>input {
        display: none;
    }

    .profile_image_input {

        color: rgb(74, 40, 73);
        font-weight: bolder;
        cursor: pointer;

    }

    .photo {
        width: 90px;
        height: 90px;
        padding: 2px;
    }

    .frnd-panel {
        display: flex;
        background-color: #f2f2f2;
        margin-right: 37px;
        margin-left: 37px;
        margin-bottom: 10px;

    }

    .friend_image {
        height: 100px;
        width: 100px;
        position: relative;
        left: -15px;

    }

    .frnd-det {
        padding: auto;
        display: block;
    }

    .frnd-name {
        font-weight: bolder;
        font-size: 14px;
    }

    .frnd-btn {
        background-color: rgb(74, 40, 73);
        color: #fff;
        border: 1px solid rgb(74, 40, 73);
        border-radius: 10%;
        font-size: 10px;
    }

    .photo-a {

        height: 200px;
        width: 200px;
        margin: 11px;

    }

    .details-a:hover {
        text-decoration: none;
        color: #A07A9D;
    }

    .img-nav1 {
        width: 50px;
        height: 50px;

        border-radius: 50%;
    }

    .userbox {

        margin: auto;
        margin-right: 0px;
        position: relative;
        top: 80px;

    }

    .chatbox {
        margin: auto;
        margin-right: 0px;
        position: relative;
        right: -30px;
    }

    .chatdiv {
        height: 400px;
        padding: 20px;
        margin-bottom: 0px;
        box-sizing: border-box;
        background-color: #262626;
        color: white;
        border-radius: 5px 0px;
        overflow-y: scroll;
        scroll-behavior: smooth;

    }

    .chatdiv::scrolbar {
        display: none;
    }

    .chatdiv2 {
        background-color: #333333;
        box-sizing: border-box;
        border-radius: 5px 0px;
        padding: 5px;

    }

    .img1 {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        float: left;
        position: relative;
        left: -32px;
        z-index: 999999;

    }

    .img2 {
        width: 160px;
        height: 160px;
        border: 3px solid #B3B3BE;
        border-radius: 50%;
        box-shadow: 5px 3px 5px #262626;


    }

    .time {
        float: right;
        padding: 5px;
        font-size: 10px;
    }

    .frn-prfl {
        width: 70px;
        padding: 3px;
        text-decoration: none;
        text-align: center;
        display: block;
        background-color: rgb(74, 40, 73);
        color: #fff;
        border-radius: 5px;

    }

    .frn-prfl:hover {
        background-color: #543052;
        text-decoration: none;
        color: #fff;
    }

    .main {
        width: 80%;
        background-image: -webkit-linear-gradient(bottom, #4A2849, #93628F);
        background: linear-gradient(to bottom, rgb(74, 40, 73, .8), rgb(147, 98, 143, .8));
        background-size: cover;
        border-color: rgb(147, 98, 143);
        opacity: 1;
        border-radius: 5px;
        box-shadow: -5px -5px 5px #888888;

    }

    .textchat {
        margin: 0 auto;
        width: 70%;
        height: 30px;
        font-weight: bolder;
        padding: 5px;
        box-sizing: border-box;
    }

    chat-ul li {
        list-style-type: none;
        background-color: #d9d9d9;
        padding: 10px;
        font-size: 16px;
        font-weight: bolder;
        color: #1a1a1a;
        margin: 5px;
        margin-top: 10px;
        border-top-left-radius: 20px;
        border-bottom-right-radius: 20px;

    }

    .profile-info {
        position: relative;
        top: -6px;
    }
    
    
    
    /*-------------------------------------------------------*/
    
    
    .container .main{
        margin-top: 80px;
        margin-bottom: 30px;
    }

    .chatdiv2 {
        background-color: rgb(51, 51, 51);
        box-sizing: border-box;
        border-radius: 5px 0px;
        padding: 5px;

    }

    .textchat {
        margin: 0 15px;
        width: 90%;
        height: 30px;
        font-weight: bolder;
        padding: 5px 5px;
        box-sizing: border-box;
        border-radius: 5px;
    }

    .frn-prfl {
        width: 70px;
        padding: 3px;
        text-decoration: none;
        text-align: center;
        display: block;
        background-color: rgb(57, 28, 56);
        color: #c9c9c9;
        border-radius: 5px;
        box-shadow: -3px -3px 4px rgba(0, 0, 0, 0.3);

    }

    .frn-prfl:hover {
        background-color: rgb(25, 13, 24);
        text-decoration: none;
        color: #fff;
        box-shadow: -1px -1px 4px rgba(0, 0, 0, 0.3);
    }
    
    
     .fixed_nav{
              position: fixed; 
              top: 280px;left:0px; 
              font-size: 30px;
              z-index: 9999;
              padding: 5px;
            }

            .fixed_nav_feed{

              color: #8DC63F;
              transition: .3s;

            }
            .fixed_nav_feed:hover{

              color: #8DC63F;
              font-size: 40px;
           

            }

            .fixed_nav_frnd{

              color: #4267B2;
              transition: .3s;

            }
            .fixed_nav_frnd:hover{

              color: #4267B2;
              font-size: 40px;
           

            }

            .fixed_nav_pic{

              color: #800000;
              transition: .3s;

            }
            .fixed_nav_pic:hover{

              color: #800000;
              font-size: 40px;
           

            }
            .fixed_nav_game{

              color: #e68a00;
              transition: .3s;

            }
            .fixed_nav_game:hover{

              color: #e68a00;
              font-size: 40px;
           

            }
             .fixed_nav_msg{

              color: #A6A6ED;
              transition: .3s;

            }
            .fixed_nav_msg:hover{

              color: #A6A6ED;
              font-size: 40px;
           

            }
              .logo-link {
                font-size: 200%;
                color: #e3e3e3;
                position: relative;
                top: 10px;
            }
            .logo-link:hover {
                text-decoration: none;
                color: #ffffff;
            }
            .logo-link img {
                width: 40px;
                height: 40px;
                margin-right: 10px;
            }
             #header .navbar-right {
           
            }
            .header-list {
                margin-top: 3px;
            }
            .header-list .dropdown-menu{
                padding: 1px;
            }
            .header-list .dropdown-menu li{
                margin: 1px 0px;
            }
            .header-list .dropdown-menu li a{
                padding: 10px;
                padding-top: 12px;
            }
            .header-list .dropdown-menu li:hover{
                background: #7e617c;
            }
            
            
            .navbar-principal .navbar-nav .open a, .navbar-principal .navbar-nav .open a:hover, .navbar-principal .navbar-nav li a:hover, .navbar-principal .navbar-nav li a:focus, .navbar-principal .navbar-nav .active a, .navbar-principal .navbar-nav .active a:hover {
                color: #fff;
                background: rgba(0, 0, 0, .1);
            }

</style>

<script type='text/javascript'>
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>

<script type="text/javascript">
  
    function readUR(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


</script>
<script type="text/javascript">
  
    function readU(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah1')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


</script>
</head>
<body>
<!--Header -->
<!--Header -->
<header id="header">        
  <nav class="navbar navbar-default navbar-fixed-top navbar-principal">
    <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand" href="index.html">
             <a  class="logo-link" href="newsfeed.php" style="position: relative;left: -20px;"><img src="images/logo.png">Trivuz</a>
          </a>
         </div>

    <div id="navbar" class="collapse navbar-collapse">
        <div class="col-md-5 col-sm-4">         
         <form class="navbar-form"  action="search.php" method="get">
            <div class="form-group" style="display:inline;">
              <div class="input-group" style="display:table;">

            
                  <input type="text" class="form-control" name="text" placeholder="Search..."  style="position:relative; top: 7px;left: -20px;">
                  <span class="input-group-addon"  style="width:1%; position:relative; top: 7px;left: -20px;">
                      <input type="submit" name="search" value="search" hidden>  <span class="glyphicon glyphicon-search"></span> 
                  </span>
    
                
              </div>
            </div>
          </form>
        </div>  

        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="profile.php"> 
              <img src="<?php echo $profile_image_details['profile_image']; ?>" class="img-nav" >&nbsp
                <?php echo $user_details['firstname'];  ?>
            </a>
          </li>

          <li class=""><a href="newsfeed.php"><i class="fa fa-bars"></i>&nbsp;Home</a></li>

          <li><a href="#"><i class="fa fa-comments"></i></a></li>
           <li><a href="#"><i class="fa fa-globe"></i></a></li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Settings <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Recover password</a></li>
              <li><a href="#">privacy</a></li>
              <li><a href="logout.php">logout</a></li>
            </ul>
          </li>
        </ul>
        <div class="fixed_nav">
    
 
                          
                          
                                <a class="fixed_nav_feed" href="newsfeed.php"><i class="icon ion-ios-paper"></i></a><br>                  
                                <a class="fixed_nav_frnd" href="friends.php"><i class="icon ion-android-contacts"></i></a><br>
                                <a class="fixed_nav_pic"  href="photos.php"><i class="icon ion-social-instagram"></i></a>     <br>                     
                                <a class="fixed_nav_msg" href="message.php"><i class="icon ion-chatboxes"></i></a> <br>      
                                <a class="fixed_nav_game" href="Game/game.php"><i class="icon ion-ios-game-controller-b"></i></a><br>                        

</div>


    </div>
  </div>

 </nav>
</header>


    <!--Header End-->
    <!--Header End-->


<?php

	if (isset($_GET['userid'])) {
		$user_frnd_id = base64_decode($_GET['userid']);
		$user_frnd_id;


 
		   $frnd_chat_details = $db->select_one_row("SELECT * FROM users WHERE userid = :userid ",array('userid'=>$user_frnd_id));
   		 $frnd_chat_image   = $db->select_one_row("SELECT * FROM profile_images WHERE user_id = :user_id ",array('user_id'=>$user_frnd_id));



	}

	$user1 = $_SESSION['userid'];
	$user2 = $user_frnd_id;

	if ($user1 > $user2) {
			
			$helpers->swap($user1,$user2);

		}


?>

<div class="container">
			<div class="row">

						<div class="col-md-10 main" >

										<div class="col-md-6" >
											<div class="userbox">
											      <center>

													<?php

													    if ($frnd_chat_image == false) {
													      
													  ?>
													    <img src="images/profileimages/demo.png" class="img2">
													  <?php
													    }else{
													  ?>
													      <img src= "<?php echo $frnd_chat_image["profile_image"] ?>" class="img2">
													  <?php
													    }

													?>
											        <h2 style="color: #eaeaea;"><?php echo $frnd_chat_details['firstname']." ".$frnd_chat_details['lastname'] ?></h2>
											        <a href="userprofile.php?userid=<?php echo base64_encode($frnd_chat_details['userid']);?>" class="frn-prfl" >Profile</a>

											    </center>
											  </div>

										</div>



<?php

	
	if (isset($_POST['send'])) {
		$user_1 = $_POST['user1'];
		$user_2 = $_POST['user2'];
		$content = $_POST['content'];



		$prev_det = $db->select_one_row("SELECT * FROM chat_user WHERE user_1 = :user_1 AND user_2 = :user_2",array('user_1' =>$user_1,'user_2'=>$user_2));
		
		


		if ($content != "") {
				$db->insert("INSERT INTO chat(user_1,user_2,content,actionid) VALUES(:user_1,:user_2,:content,:actionid)",array('user_1'=>$user_1,'user_2'=>$user_2,'content'=>$content,'actionid'=>$_SESSION['userid']));


        if ($prev_det == false) {
          $db->insert("INSERT INTO chat_user(user_1,user_2) VALUES(:user_1,:user_2)",array('user_1'=>$user_1,'user_2'=>$user_2));
        }
         $db->insert("INSERT INTO chat_notification(user_1,user_2,actionid) VALUES(:user_1,:user_2,:actionid)",array('user_1'=>$user_1,'user_2'=>$user_2,'actionid'=>$_SESSION['userid']));
		}
	}

?>



									 <div class="col-md-6">
											 	<div class="chatbox">
													      <div class="chatdiv">
													        
													          <ul class="chat-ul">

<?php

	$chat_result = $db->select("SELECT * FROM chat WHERE user_1 = :user_1 AND user_2 = :user_2 ORDER BY chat_time DESC",array('user_1'=>$user1,'user_2'=>$user2));

	if (count($chat_result) == 0 ) {
		echo "No chat details";
	}


	foreach ($chat_result as $value_result) {
?>

<?php

	if ($value_result['actionid'] != $_SESSION['userid']) {
?>


<?php
	
	if ($frnd_chat_image == false) {
		
?>	
	 <img class="img1" src="images/profileimages/demo.png">
<?php	
	}else{
?>
	 <img class="img1" src="<?php echo $frnd_chat_image['profile_image'] ?>">
<?php

	}

?>

<?php
	}else{
?>

  
<?php

  if ($profile_image_details == false) {
?>
  <img class="img1" src="images/profileimages/demp.png">
<?php
  }else{

?>
<img class="img1" src="<?php echo  $profile_image_details['profile_image'] ?>">
<?php
  }

?>
	 
<?php
	}

?>



													         
														          <li style="list-style-type: none;
																      background-color: #d9d9d9;
																      padding: 5px;
																      font-size: 16px;
																      font-weight: bolder;
																      color: #1a1a1a;
																      margin: 5px;
																      margin-top: 10px;
																      border-top-left-radius: 20px;
																      border-bottom-right-radius: 20px;
																      position: relative;
																      left: -30px;
																      width: 100%;
																      ">
														            <span class="time"><?php echo facebook_time_ago($value_result['chat_time']); ?></span>
														            <?php echo wordwrap($value_result['content'], 28, "\n", true);?>
														           </li>
<?php
	}

?>
													          </ul> 
													      </div>

													      <div class="chatdiv2">
														        <form action="" method="post">
														          <input name="content" class="textchat"v placeholder="Enter text ..." >
														         <input type="text" name="user1" hidden="" value="<?php  echo $user1  ?>">
														           <input type="text" name="user2" hidden="" value="<?php  echo $user2  ?>">
														           
														          	<input class="textsent" type="submit" name="send" value="send" hidden=""><br>
														        </form>
														      </div>
												   		</div> 
											 </div>

						</div>
				</div>
	</div>

<?php include 'chatbar.php'; ?> 

<?php include 'footer.php'; ?>
   
