<?php 
// check if user coming from request
if($_SERVER["REQUEST_METHOD"]=='POST'){
  $user=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
  $mail=filter_var($_POST['mail'],FILTER_SANITIZE_EMAIL);
  $phone=filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
  $message=filter_var($_POST['message'],FILTER_SANITIZE_STRING);
  $formerrors=array();
  if(strlen($user)<=3){
    $formerrors[]="user name must be larger than <strong>3</strong> character";
  } 
  if(strlen($message)<=10){
    $formerrors[]="your message must be larger than <strong>10</strong> character";
  } 
  if(empty($formerrors)){
    $myemail='ashrafthabet26@gmail.com';
    $subject="contact form";
    $header="from ".$mail."\r\n";
    mail($myemail,$subject,$message,$header,'ashrafahmed');
    $sucess="<div class='alert alert-success mx-auto success'>we received your message</div>";

    $user='';
    $mail='';
    $phone='';
    $message='';

  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Contact form</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css"/>
  </head>
  <body>
     <!-- start form-->
     <div class="container">
       <h1 class="text-center mb-4">Contact Me</h1>
       <?php
        if(!empty($formerrors)){  ?>
       <div class="alert alert-warning alert-danger mx-auto  fade show   warn"  role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <?php
            foreach($formerrors as $errors){
              echo $errors ."<br/>";
            }
            ?>
           </div>
            <?php
          }
        ?>

        <?php if(isset($sucess)){echo $sucess;}?>
       <form class="mx-auto"  action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
         <input class="form-control" type="text" name="username" placeholder="Username" value="<?php if(isset($user)){ echo$user;}?>"/>
         <i class="fa fa-user fa-fw"></i>
         <input class="form-control" type="email" name="mail" placeholder="Email" value="<?php if(isset($mail)){ echo$mail;}?>"/>
         <i class="fa fa-envelope fa-fw"></i>
         <input class="form-control" type="text" name="phone"placeholder="Phone Number" value="<?php if(isset($phone)){ echo$phone;}?>"/>
         <i class="fa fa-phone-alt fa-fw"></i>
         <textarea class="form-control" name="message" placeholder="Write Your Message"><?php if(isset($message)){echo$message;}?></textarea>
         <input class="btn btn-success" type="submit" value="Send Message"/>
         <i class="fas fa-paper-plane fa-fw send"></i>

       </form>

     </div>
     <!-- end form -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
