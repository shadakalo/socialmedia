<!doctype html>
<html>

<head>
    <title>Classic Games</title>
    <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One|Righteous" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/ion-icons/css/ionicons.css">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    <style>
        body {
            background: #ebebeb;
        }

        h1 {
            font-family: 'Julius Sans One', sans-serif;
            text-align: center;
            color: #93628F;
        }

        .games {
            background: #93628F;
            /* For browsers that do not support gradients */
            background: -webkit-linear-gradient(#93628F, #4A2849) no-repeat center fixed;
            /* For Safari 5.1 to 6.0 */
            background: -o-linear-gradient(#93628F, #4A2849) no-repeat center fixed;
            /* For Opera 11.1 to 12.0 */
            background: -moz-linear-gradient(#93628F, #4A2849) no-repeat center fixed;
            /* For Firefox 3.6 to 15 */
            background: linear-gradient(#93628F, #4A2849) no-repeat center fixed;
            /* Standard syntax */
            padding: 5%;
            margin: 0 auto;
            width: 80%;
            border-radius: 10px;
        }

        .games a {
            background: rgba(173, 173, 173, 0.2);
            color: white;
            font-family: 'Righteous', cursive;
            font-size: 20px;
            display: block;
            text-align: center;
            text-decoration: none;
            margin: 2% auto;
            padding: 2%;
            width: 30%;
            border-radius: 10px;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.2);
        }

        .games a:hover {
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.2);
            width: 32%;
            color: #ededed;
            background: #391e31;
        }


          .fixed_nav{
              position: fixed; 
              top: 220px;left:0px; 
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

    </style>
</head>

<body>
    <div class="container">
        <h1 class="animated slideInDown">Classic Games</h1>
        <hr style="width: 300px;">
        <div class="container">
            <div class="games">
                <a href="snake/snake.html" class="animated rubberBand">Snake</a>
                <a href="pong/game.html" class="animated rubberBand">Pong</a>
                <a href="infinte_runner/runner.html" class="animated rubberBand">Infinite Runner</a>
                <a href="tetris/tetris.html" class="animated rubberBand">Tetris</a>
            </div>
        </div>
    </div>

</body>

<div class="fixed_nav">
    
 
                          
                          
                                <a class="fixed_nav_feed" href="newsfeed.php"><i class="icon ion-ios-paper"></i></a><br>                  
                                <a class="fixed_nav_frnd" href="friends.php"><i class="icon ion-android-contacts"></i></a><br>
                                <a class="fixed_nav_pic"  href="photos.php"><i class="icon ion-social-instagram"></i></a>     <br>                     
                                <a class="fixed_nav_msg" href="message.php"><i class="icon ion-chatboxes"></i></a> <br>      
                                <a class="fixed_nav_game" href="game.php"><i class="icon ion-ios-game-controller-b"></i></a><br>                        

</div>

</html>
