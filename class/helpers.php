<?php
/**
* Format Class
*/
class Format{
 public function formatDate($date){
  return date('F j, Y, g:i a', strtotime($date));
 }

 public function textShorten($text, $limit = 400){
  $text = $text. " ";
  $text = substr($text, 0, $limit);
  $text = substr($text, 0, strrpos($text, ' '));
  $text = $text.".....";
  return $text;
 }

 public function validation($data){
  $data = trim($data);
  $data = stripcslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }

 public function title(){
  $path = $_SERVER['SCRIPT_FILENAME'];
  $title = basename($path, '.php');
  //$title = str_replace('_', ' ', $title);
  if ($title == 'index') {
   $title = 'home';
  }elseif ($title == 'contact') {
   $title = 'contact';
  }
  return $title = ucfirst($title);
 }

 function swap(&$x,&$y) {
    $tmp=$x;
    $x=$y;
    $y=$tmp;
}


public function verification_mail($email,$token){

    require_once('mailer/class.phpmailer.php');


  

      $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
      try {
          //Server settings
          $mail->SMTPDebug = 2;                                 // Enable verbose debug output
          $mail->isSMTP();                                      // Set mailer to use SMTP
          $mail->Host = 'smtp.sendgrid.net';  // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                               // Enable SMTP authentication
          $mail->Username = 'shadakaloths002@gmail.com';                 // SMTP username
          $mail->Password = 'tumiamarghumm';                           // SMTP password
          $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 587;                                    // TCP port to connect to

          //Recipients
          $mail->setFrom('developers@trivuz.com', 'Team Trivuz');
          $mail->addAddress($email);     // Add a recipient
         
       

         $token = base64_encode($token);

         $subject = 'Trivuz Account Activation';

         $message = '<h2 style="color:blue;">Please click on following link to activate your account</h2><br>'."<a href='http://anik.phpbd4.com//verify.php?email=$email&token=$token'>Click Here</a>";



          //Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = 'Account Activation';
          $mail->Body    = $message;

          $mail->send();
          echo 'Message has been sent';
      } catch (Exception $e) {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
      }


  }



  

public function password_reset($email,$token){

    require_once('mailer/class.phpmailer.php');
   

      $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
      try {
          //Server settings
          $mail->SMTPDebug = 2;                                 // Enable verbose debug output
          $mail->isSMTP();                                      // Set mailer to use SMTP
          $mail->Host = 'smtp.sendgrid.net';  // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                               // Enable SMTP authentication
          $mail->Username = 'shadakaloths002@gmail.com';                 // SMTP username
          $mail->Password = 'tumiamarghumm';                           // SMTP password
          $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 587;                                    // TCP port to connect to

          //Recipients
          $mail->setFrom('developers@trivuz.com', 'Team Trivuz');
          $mail->addAddress($email);     // Add a recipient
         
       

         $subject = 'Trivuz Reset Password';
         $token = base64_encode($token);

         $message = '<h2 style="color:red;">Please click on following link to reset your password</h2><br>'."<a href='http://anik.phpbd4.com/resetpass.php?email=$email&token=$token'>Click Here</a>";  

      
          


          //Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = 'Reset Passowrd';
          $mail->Body    = $message;

          $mail->send();
          echo 'Message has been sent';
      } catch (Exception $e) {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
      }

  }




}




?>