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
    <link rel="icon" href="favicon.ico?v1" type="image/x-icon" />
    <link rel="shortcut icon" href="favicon.ico?v1" type="image/x-icon" /> 
    <title>
  
      Trivuz - 

<?php
        $title = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($title,'.php');
        echo ucfirst($title) ;

?>

      ( <?php echo $user_details['firstname']; ?> )
        


      </title>

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
                border-radius: 6px;
                font-size: 10px;
                margin-right: 7px;

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
            .image-upload1>input {
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
            
            
            
            
            
            
            
            

            /* Start Recent Changes */
            
            .post_like {
                background-color: #fff;
                color: #3291d6;
                margin: 10px 5px;
                border: 1px solid #3366ff;
                border-radius: 15%;
            }

            .post_like:hover {
                background-color: #3291d6;
                color: #fff;
            }

            .post_dislike {
                background-color: #fff;
                color: #cc6600;
                margin: 10px 5px;
                border: 1px solid #cc6600;
                border-radius: 15%;
            }

            .post_dislike:hover {
                background-color: #cc6600;
                color: #fff;
            }

            .post_heart {
                background-color: #fff;
                color: #d62424;
                margin: 10px 5px;
                border: 1px solid #ff0000;
                border-radius: 15%;
            }

            .post_heart:hover {
                background-color: #d62424;
                color: #fff;
            }
            

            /* End Recent Changes */

            
            
            
            
            
            
            
            
            
            
            
            
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
                overflow: auto;
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

            .profile-image {
                border: 3px solid #B3B3BE;
                border-radius: 50%;
                box-shadow: 5px 3px 5px #262626;
                -ms-transform: translateY(-12px);
                /* IE 9 */
                -webkit-transform: translateY(-12px);
                /* Safari */
                
                transform: translate(8px,8px);
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

            }

            .chatbox {
                margin: auto;
                margin-right: 0px;
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

            .textsent {

                float: right;
                padding: 10px;
                margin: 5px;
                margin-right: 30px;
                background-color: #00cccc;
                border: 1px solid #00cccc;
                font-weight: bolder;
                color: #404040;
                border-radius: 5px;
                cursor: pointer;

            }

            .textsent:hover {
                background-color: #5cd6d6;
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
                width: 100%;

                background-color: #00cccc;
                display: flex;
                margin: 80px auto;

                box-shadow: -5px -5px 5px #888888;
            }

            .textchat {
                width: 65%;
                height: 30px;
                margin-left: 30px;
                font-weight: bolder;
                padding: 5px;
                box-sizing: border-box;
            }

            chat-ul {
                padding: 0;
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
                top: -10px;
                background: red;
                /* For browsers that do not support gradients */
                background: -webkit-linear-gradient(#9a709d, #b769be, #9a709d);
                /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(#9a709d, #ba89be, #9a709d);
                /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(#9a709d, #ba89be, #9a709d);
                /* For Firefox 3.6 to 15 */
                background: linear-gradient(#743d79, #b769be, #743d79);
                /* Standard syntax */
            }

            .profile-nav {
                max-height: 50px;
                margin-bottom: 20px;
                border: 1px solid transparent;
            }

            .profile-nav-default {

                border-radius: 0px;
                background-color: transparent;

            }

            #bs-example-navbar-collapse-1 ul li a {
                color: #e2e2e2;
            }

            #bs-example-navbar-collapse-1 ul li a:hover {
                background: rgba(255,255 ,255 , 0.1);
                color: #ffffff;

            }

            .profile-card {

                background: linear-gradient(to bottom, rgb(74, 40, 73, .8), rgb(147, 98, 143, .8)), url(./images/covers/1.jpg) no-repeat;
                background: -webkit-linear-gradient(bottom, #4A2849, #93628F), url(./images/covers/1.jpg) no-repeat;
                /* image not working in chrome */
                background-size: cover;
                width: 100%;
                min-height: 90px;
                border-radius: 4px;
                padding: 10px 20px;
                color: #fff;
                margin-bottom: 40px;
            }

            .profile-card img.profile-photo {
                border: 3px solid rgb(121, 121, 121);
                float: left;
                margin-right: 20px;
                position: relative;
                top: -25px;
                height: 70px;
                width: 70px;
                border-radius: 50%;
                box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);
            }

            .profile-card a {
                text-decoration: none;
                color: #e3e3e3;
            }

            .profile-card a:hover {
                color: white;
            }

            nav-news-feed {
                border: 1px solide black;
            }

            ul.nav-news-feed {
                padding-left: 20px;
                padding-right: 20px;
                margin: 0 0 40px 0;
                border: 1px solid rgb(169, 129, 165);
                border-radius: 6px;
            }

            ul.nav-news-feed li {
                list-style: none;
                line-height: 12px;
                display: block;
                padding: 15px 0;
            }

            ul.nav-news-feed i.ion-ios-paper {
                color: #8dc63f;
            }
            
            
            
            
            /* Start Recent Changes*/
            
            
            ul.nav-news-feed li:hover {
                color: #8dc63f;
            }

            
            /* End Recent Changes*/
            
            
            ul.nav-news-feed li i {
                font-size: 18px;
                margin-right: 15px;
                float: left;
            }

            ul.nav-news-feed li div {
                position: relative;
                margin-left: 30px;
            }

            ul.nav-news-feed li a {
                color: #6d6e71;
            }

            ul.nav-news-feed {
                color: #6d6e71;
                overflow: hidden;
                padding-bottom: 20px;
            }


            ul.nav-news-feed .panel-heading .panel-title {
                text-align: center;
            }

            ul.nav-news-feed .panel-info {
                border-color: rgb(169, 129, 165);
                width: 130%;
                transform: translateX(-30px);
            }

            .panel-info>.panel-heading {
                color: #fff;
                background-color: rgb(164, 125, 161);
                border-color: rgb(169, 129, 165);
            }


            .sticky {
                position: fixed;
                top: 62px;
                width: 262px;
            }
             .cover-image{
              width: 100%;
              height: 350px;
              position: relative;
              top: 10px;
            }

            .info5{
              color: #A07A9D;
              cursor: pointer;
              text-decoration: none;
              font-size: 16px;
              font-weight: bolder;
            }
            /* End Recent Changes */
            
            .change_name_form {
                color: white;
               background-image: -webkit-linear-gradient(bottom, #4A2849, #93628F);
              background: linear-gradient(to bottom, rgb(74, 40, 73, .8), rgb(147, 98, 143, .8));
              background-size: cover;
              border-color: rgb(147, 98, 143);
                border-radius: 5px;
                width: 400px;
                padding: 40px;
                margin: 100px 20px 100px 380px;
                -webkit-box-shadow: -1px 3px 18px 0px rgba(0,0,0,0.75);
                -moz-box-shadow: -1px 3px 18px 0px rgba(0,0,0,0.75);
                box-shadow: -1px 3px 18px 0px rgba(0,0,0,0.75);
            }
            .change_name_form input[type=submit]{
                width: 30%;
                min-width: 90px;
                background-color: rgb(57, 28, 56);
                color: white;
                padding: 8px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-top: 10px;
            }
            .change_name_form input[type=submit]:hover{
                background-color: rgb(25, 13, 24);
                color: white;
            }
            .msg-img{
              margin-right: 10px;
            }
            .msg-not-text{
          
              color: #000;
              padding: 5px;
            }
            .msg-not-time{
              color: grey ;
            }
            .msg-not-div{
              margin: 10px;
            }
            .msg-not-a:hover{

              text-decoration: none;
              color: #643C62;

            }
            .msg-not-panel{
              position: relative;
              top:-150px;
            }
            .msg-not-del{
              color: red;
            }
            .msg-not-del:hover{
              color: #b30000;
            }
            .frnd-not-text{
              color: #000;
              margin : 0px 10px;
            }
            .btn-frnd-accept{

              color: green;
              background-color: #fff;
              padding: 0px;

            }
            .btn-frnd-accept:hover{

              color: #009900;
              background-color: #fff;

            }
            .btn-frnd-cancel{

              color: #cc0000;
              background-color: #fff;
              padding: 0px;
              margin : 0px 10px;

            }
            .btn-frnd-cancel:hover{

              color: red;
              background-color: #fff;

            }

            .fixed_nav{
              position: fixed; 
              top: 300px;left:0px; 
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

            .msg-msg{

              color: #5C365B;
              margin-left: 10px;


            }

            .msg-msg:hover{

              color: #895A86;

            }

            .edit_profile{

              
              padding:;
              color: #fff;
              border-radius: 5px;


            }

            .edit_profile:hover{

             
              color: #fff;
              

            }
            .message-container {
                margin-top: 20px;
            }
            .message-container .panel-heading {
                background: #725271;
                color: white;
                margin-bottom: 13px;
            }
            .message-container .panel-heading i {
                margin-right: 10px;
            }
            .list{
                border: 1px solid rgb(234, 234, 234);
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
                margin: 4px 5px;
                border-radius: 4px;
            }
            .list .panel-body img {
                margin-right: 20px;
                box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);
                padding: 1px;
            }
            .list a {
                color: #5f5f5f;
                text-decoration: none;
            }
            .list a:hover {
                color: #82547F;
            }
            .message-container li{
                margin-right: 20px;
                margin-top: 10px;
                list-style: none;
                background: rgba(212, 212, 212, 0.5);
                padding: 1%;
                border-bottom-right-radius: 20%;
                border-top-left-radius: 30%;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
            }
            .message-container li img{
                margin-right: 7px;
                position: relative;
                top: -10px;
                left: -5px;
                width: 30px;
                height: 30px;
                border: 1px solid rgb(234, 234, 234);
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
            }
            .message-container li .date-history{
                float: right;
                color: #aaaaaa;
            }

            .post_err{

              color: red;

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
            
            
            
            
            
            
            
            

            .profile-info {
                position: relative;
                top: -10px;
                background-image: -webkit-linear-gradient(bottom, #4A2849, #93628F);
                background: linear-gradient(to bottom, rgb(74, 40, 73, .8), rgb(147, 98, 143, .8));
                background-size: cover;
                border-color: rgb(147, 98, 143);
                /* Standard syntax */


            }
            

                .aboutbtn{
                  
                    background-color: #4A2849;
                    color: #fff;
                    padding: 5px;
                    font-size: 10px;
                    float: right;

                }
                .aboutbtn:hover{

                  background-color: #72476F;
                  color: #fff;

                }
                .aboutinput{
                  
                  margin: 10px;
                  
                }

                .name_add_mes{

                color: #fff;
                position: relative;
                top: -82px;
                left: -5px;
              }
            .rel{
              position: relative;
              top: 20px;
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
<body >
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

          <a class="navbar-brand" href="newsfeed.php">
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

       <li class=" header-list"><a href="newsfeed.php"><i class="fa fa-bars"></i>&nbsp;Home</a></li>

          <li class="header-list"><a href="messagenotification.php"><i class="fa fa-comments"></i>
<?php

  $pending_msg = $db->select("SELECT * FROM chat_notification WHERE (user_1 = :user_1 OR user_2 = :user_2)  AND actionid != :actionid",array('user_1'=>$_SESSION['userid'],'user_2'=>$_SESSION['userid'],'actionid'=>$_SESSION['userid']));

  if (count($pending_msg) != 0) {

    echo " (".count($pending_msg).")";

  }
  ?>
          </a></li>



           <li class="header-list"><a href="notification.php"><i class="fa fa-globe"></i>
<?php
$pending_req = $db->select("SELECT * FROM friendship WHERE (user1_id = :user1_id OR user2_id = :user2_id) AND status = 0 AND action_id != :action_id",array('user1_id'=>$_SESSION['userid'],'user2_id'=>$_SESSION['userid'],'action_id'=>$_SESSION['userid']));

  if (count($pending_req)>0) {
    echo " (".count($pending_req).")";
  }


?>     
          </a></li>

          <li class="dropdown header-list">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Settings <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="changepass.php">Change password</a></li>
              <li><a href="changename.php">Change Name</a></li>
              <li><a href="logout.php">logout</a></li>
            </ul>
          </li>
        </ul>

    </div>
  </div>

 </nav>


<div class="fixed_nav">
    
 
                          
                          
                                <a class="fixed_nav_feed" href="newsfeed.php"><i class="icon ion-ios-paper"></i></a><br>                  
                                <a class="fixed_nav_frnd" href="friends.php"><i class="icon ion-android-contacts"></i></a><br>
                                <a class="fixed_nav_pic"  href="photos.php"><i class="icon ion-social-instagram"></i></a>     <br>                     
                                <a class="fixed_nav_msg" href="message.php"><i class="icon ion-chatboxes"></i></a> <br>      
                                <a class="fixed_nav_game" href="game.php"><i class="icon ion-ios-game-controller-b"></i></a><br>                        

</div>


</header>

    <!--Header End-->
    <!--Header End-->
