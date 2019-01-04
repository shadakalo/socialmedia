<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>News Feed</title>

    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/ion-icons/css/ionicons.css">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    <style type="text/css">
      textarea {
         resize: none;
      }
    </style>
    

</head>
<body>

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
            <b>LOGO</b>
          </a>
         </div>

    <div id="navbar" class="collapse navbar-collapse">
        <div class="col-md-5 col-sm-4">         
         <form class="navbar-form">
            <div class="form-group" style="display:inline;">
              <div class="input-group" style="display:table;">
                <input class="form-control" name="search" placeholder="Search..." autocomplete="off" type="text">
                <span class="input-group-addon" style="width:1%;">
                  <span class="glyphicon glyphicon-search"></span>
                </span>
              </div>
            </div>
          </form>
        </div>  

        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="#">  Sakura Haruno
              <img src="images/users/user-1.jpg" class="img-nav">
            </a>
          </li>

          <li class="active"><a href="#"><i class="fa fa-bars"></i>&nbsp;Home</a></li>

          <li><a href="#"><i class="fa fa-comments"></i></a></li>
           <li><a href="#"><i class="fa fa-globe"></i></a></li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Settings <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Recover password</a></li>
              <li><a href="#">privacy</a></li>
              <li><a href="#">logout</a></li>
            </ul>
          </li>
        </ul>

    </div>
  </div>

 </nav>
</header>

    <!--Header End-->

<div id="page-contents">
  <div class="container">
    <div class="row">

    <!-- Side Bar Left   -->
         
      <div class="col-md-3 static">
        <div class="profile-card">
          <img src="images/users/user-1.jpg" alt="user" class="profile-photo">
          <h5><a href="#" class="text-white">Sakura Haruno</a></h5>
          <a href="#" class="text-white"><i class="ion ion-android-person-add"></i> 1000 followers</a>
        </div><!--profile ends-->


            <!--news-feed links -->
            <ul class="nav-news-feed">
              <li><i class="icon ion-ios-paper"></i><div><a href="index.html">My Newsfeed</a></div></li>
              <li><i class="icon ion-ios-people-outline"></i><div><a href="#">Friends</a></div></li>
              <li><i class="icon ion-chatboxes"></i><div><a href="#">Messages</a></div></li>
            </ul><!--news-feed links ends-->


          <div id="chat-block">
            <div class="panel panel-info">
              <div class="panel-heading">
                  <h3 class="panel-title">People You May Know</h3>
              </div>

          <div class="panel-body">
            <div class="card">
                <div class="content">
                    <ul class="list-unstyled team-members">
                        <li>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="avatar">
                                        <img src="images/Friends/guy-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                    </div>
                                </div>
                                <div class="col-xs-6"> Kabuto Yakushi</div>

                              
                                <div class="col-xs-3 text-right">
                                    <btn class="btn btn-sm btn-warning btn-icon"><i class="fa fa-user-plus"></i></btn>
                                </div>

                            </div>

                        </li>

                        <li>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="avatar">
                                        <img src="images/Friends/guy-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                    </div>
                                </div>

                                <div class="col-xs-6"> Hiruzen Sarutobi</div>

                      
                                <div class="col-xs-3 text-right">
                                    <btn class="btn btn-sm btn-warning btn-icon"><i class="fa fa-user-plus"></i></btn>
                                </div>

                            </div>
                        </li>

                        <li>
                            <div class="row">
                                <div class="col-xs-3">
                                   <div class="avatar">
                                      <img src="images/Friends/guy-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                    </div>
                                </div>

                                <div class="col-xs-6">Minato Namikaze  </div>

                                <div class="col-xs-3 text-right">

                                    <btn class="btn btn-sm btn-warning btn-icon"><i class="fa fa-user-plus"></i></btn>

                                </div>

	                            </div>
		                      </li>
		                    </ul>
		                </div>
		            </div>            
		          </div>      
	       	 </div>      
	       </div><!--chat block ends-->               
     </div>

<div class="col-md-7">

        <div class="create-post"> <!-- Status -->
          <div class="row">
            <div class="col-md-7 col-sm-7">
              <div class="form-group">
                <img src="images/users/user-1.jpg" alt="" class="profile-photo-md">
                <textarea name="texts" id="exampleTextarea" cols="30" rows="1" class="form-control" placeholder="Write what you wish"></textarea>
              </div>
            </div>
            <div class="col-md-5 col-sm-5">
              <div class="tools">
                <ul class="publishing-tools list-inline">
                  <li><a href="#"><i class="ion-compose"></i></a></li>
                  <li><a href="#"><i class="ion-images"></i></a></li>
                  <li><a href="#"><i class="ion-ios-videocam"></i></a></li>
                  <li><a href="#"><i class="ion-map"></i></a></li>
                </ul>
                <button class="btn btn-primary pull-right">Publish</button>
              </div>
            </div>
          </div>
        </div><!-- Status End-->

        <!-- Post Content --> 
        <div class="post-content">
          <img src="images/post-images/1.jpg" alt="post-image" class="img-responsive post-image">
          <div class="post-container">
            <img src="images/users/user-5.jpg" alt="user" class="profile-photo-md pull-left">
            <div class="post-detail">
              <div class="user-info">
                <h5><a href="timeline.html" class="profile-link">Kakashi Hatake</a></h5>
                <p class="text-muted">Published a photo about 5 mins ago</p>
              </div>
              <div class="reaction">
                <a class="btn text-green"><i class="icon ion-heart"></i> 20</a>
                <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a> 
                <a class="btn text-blue"><i class="icon ion-sad-outline"></i> 1</a>
              </div>
              <div class="line-divider"></div>
              <div class="post-text">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
                <i class="em em-anguished"></i> <i class="em em-anguished"></i> </p>
              </div>
              <div class="line-divider"></div>
              <div class="post-comment">
                <img src="images/users/user-11.jpg" alt="" class="profile-photo-sm">
                <p><a href="timeline.html" class="profile-link">Naruto Uzumaki </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
              </div>
              <div class="post-comment">
                <img src="images/users/user-4.jpg" alt="" class="profile-photo-sm">
                <p><a href="timeline.html" class="profile-link">Saske Uchiha</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
              </div>
              <div class="post-comment">
                <img src="images/users/user-1.jpg" alt="" class="profile-photo-sm">
                <input class="form-control" placeholder="Post a comment" type="text">
              </div>
            </div>
          </div>
        </div>     <!-- Post Content End   -->

          
          
        <div class="post-content">
          <img src="images/post-images/1.jpg" alt="post-image" class="img-responsive post-image">
          <div class="post-container">
            <img src="images/users/user-5.jpg" alt="user" class="profile-photo-md pull-left">
            <div class="post-detail">
              <div class="user-info">
                <h5><a href="#" class="profile-link">Kakashi Hatake</a></h5>
                <p class="text-muted">Published a photo about 5 mins ago</p>
              </div>
              <div class="reaction">
                <a class="btn text-green"><i class="icon ion-heart"></i> 20</a>
                <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a> 
                <a class="btn text-blue"><i class="icon ion-sad-outline"></i> 1</a>
              </div>
              <div class="line-divider"></div>
              <div class="post-text">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
                <i class="em em-anguished"></i> <i class="em em-anguished"></i> </p>
              </div>
              <div class="line-divider"></div>
              <div class="post-comment">
                <img src="images/users/user-11.jpg" alt="" class="profile-photo-sm">
                <p><a href="#" class="profile-link">Naruto Uzumaki </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
              </div>
              <div class="post-comment">
                <img src="images/users/user-4.jpg" alt="" class="profile-photo-sm">
                <p><a href="#" class="profile-link">Saske Uchiha</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
              </div>
              <div class="post-comment">
                <img src="images/users/user-1.jpg" alt="" class="profile-photo-sm">
                <input class="form-control" placeholder="Post a comment" type="text">
              </div>
            </div>
          </div>
        </div>  <!-- Post Content -->  
            
       <!-- Post Content -->   
        <div class="post-content">
          <img src="images/post-images/1.jpg" alt="post-image" class="img-responsive post-image">
          <div class="post-container">
            <img src="images/users/user-5.jpg" alt="user" class="profile-photo-md pull-left">
            <div class="post-detail">
              <div class="user-info">
                <h5><a href="#" class="profile-link">Kakashi Hatake</a></h5>
                <p class="text-muted">Published a photo about 5 mins ago</p>
              </div>
              <div class="reaction">
                <a class="btn text-green"><i class="icon ion-heart"></i> 8</a>
                <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a> 
                <a class="btn text-blue"><i class="icon ion-sad-outline"></i> 5</a>
              </div>
              <div class="line-divider"></div>
              <div class="post-text">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
                <i class="em em-anguished"></i> <i class="em em-anguished"></i> </p>
              </div>
              <div class="line-divider"></div>
              <div class="post-comment">
                <img src="images/users/user-11.jpg" alt="" class="profile-photo-sm">
                <p><a href="#" class="profile-link">Naruto Uzumaki </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
              </div>
              <div class="post-comment">
                <img src="images/users/user-4.jpg" alt="" class="profile-photo-sm">
                <p><a href="#" class="profile-link">Saske Uchiha</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
              </div>
              <div class="post-comment">
                <img src="images/users/user-1.jpg" alt="" class="profile-photo-sm">
                <input class="form-control" placeholder="Post a comment" type="text">
              </div>
            </div>
          </div>
        </div>  
        <!-- Post Content End --> 
            
            
        <!-- Newsfeed Common Side Bar Right  -->
                
        <div class="chat-sidebar focus">
          <div class="list-group text-left">

            <p class="text-center chat-title">Online Users</p>  
            <a href="#" class="list-group-item">
                <i class="fa fa-check-circle connected-status"></i>
                <img src="images/Friends/guy-2.jpg" class="img-chat img-thumbnail">
                <span class="chat-user-name">Naruto Uzimaki</span>
            </a>

            <a href="#" class="list-group-item">
              <i class="fa fa-times-circle absent-status"></i>
              <img src="images/Friends/woman-1.jpg" class="img-chat img-thumbnail">
              <span class="chat-user-name">Hinata Hyuga</span>
            </a>

            <a href="#" class="list-group-item">
                <i class="fa fa-check-circle connected-status"></i>
                <img src="images/Friends/guy-2.jpg" class="img-chat img-thumbnail">
                <span class="chat-user-name">Sakura Haruno</span>
              </a>

            <a href="#" class="list-group-item">
                <i class="fa fa-check-circle connected-status"></i>
                <img src="images/Friends/guy-2.jpg" class="img-chat img-thumbnail">
                <span class="chat-user-name">Gaara</span>
              </a>

             <a href="#" class="list-group-item">
                  <i class="fa fa-check-circle connected-status"></i>
                  <img src="images/Friends/guy-2.jpg" class="img-chat img-thumbnail">
                  <span class="chat-user-name">Sasuke Uchiha</span>
                </a>

             <a href="#" class="list-group-item">
                <i class="fa fa-times-circle absent-status"></i>
                <img src="images/Friends/woman-1.jpg" class="img-chat img-thumbnail">
                <span class="chat-user-name">Itachi Uchiha</span>
              </a>

            <a href="messages.html" class="list-group-item">
              <i class="fa fa-times-circle absent-status"></i>
              <img src="images/Friends/guy-2.jpg" class="img-chat img-thumbnail">
              <span class="chat-user-name">Ino Yamanaka</span>
            </a>

            <a href="#" class="list-group-item">
                  <i class="fa fa-check-circle connected-status"></i>
                  <img src="images/Friends/guy-2.jpg" class="img-chat img-thumbnail">
                  <span class="chat-user-name">Shikamaru Nara</span>
                </a>

            <a href="#" class="list-group-item">
                  <i class="fa fa-check-circle connected-status"></i>
                  <img src="images/Friends/guy-2.jpg" class="img-chat img-thumbnail">
                  <span class="chat-user-name">Naruto Uzimaki</span>
            </a>      

          </div>         
        </div>   
    </div>
  </div>
</div>
</div>

    <!-- Footer -->
    
    <footer id="footer">
      <div class="container">
        <div class="row">
          <div class="footer-wrapper">
            <div class="copyright">
              <p>&copy; All rights reserved</p>
            </div>
            
          </div>
        </div>
      </div>
    </footer>
    
   
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
 

  

</body>
</html>

  
   
