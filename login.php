<?php

if (isset( $_SESSION['auth'])){
          session_destroy();
          print_r(session_status() . PHP_SESSION_ACTIVE);
    }
    Session_start();

$email    = isset($_POST['email']) ?  htmlentities(htmlspecialchars($_POST['email'])) : '';
$password = isset($_POST['email']) ?  htmlentities(htmlspecialchars($_POST['password'])):'';
$errors =array();
if (!empty($_POST) && !empty($email && !empty($password))){
 
      //----------------------------------------------------
      include_once     "classes/class.Constants.php";
      include_once     "classes/db/class.Database.php";
      include_once     "classes/user/class.User.php";

      $db = new Database();
      $login_db = $db->getInstance();
      $UserAuth = new User($db->getInstance()); 
    
      $errors = array();
      

      if (empty($errors)){
        //selection de l'email
        
        $UserAuth->Auth($email,$password);
        if ($UserAuth->Auth($email,$password)){
          $login_db = null;
          header('Location:  index.php');
        }else{
          $errors['msg'] = "email / password invalid";
        }
      }   
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>CODE REMINDER ENCYCLOPEDIA</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/animate.css">

  </head>
  <body class="bgdark bg">
    <!--
    <div id="video-fond">
    <video  id="video" preload  autoplay>
        <source src="assets/animated-form/v1.mp4" type="video/mp4"></source>
    </video>
  </div>
-->
    <div class="container">
      <br><br><br>
  
      <div class="row">
        <div class="col-sm"></div>

        <div class="col-sm"></div>
      </div>
    
      <div class="row">
          <div class="col-sm"></div>
          <br><br>
         
          <br><br>
          <div class="col-sm animated fadeIn login-frame">
            <form action="" method="post">
            <?php if (isset($errors['msg'])) { ?>
                    <div class="alert alert-warning" role="alert">
                      <?php print_r($errors['msg']) ; ?>
                    </div>
                    <?php }?>    
               <div class="form-group">
                    <label for="email">Login</label>
                    <input class="form-control" type="text" id="email" name="email" placeholder="" required autocomplete="off"/>
      
                    <br>
                    <label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" required autocomplete="off"/>
               
              </div>
              <center>
                <button type="submit" name="submit" class="btn btn-outline-success">
                  Se connecter
                </button>
              </center>
          </form>
      </div>
      <div class="col-sm"></div>
      </div><br><br>
      <?php
            include_once "classes/class.Constants.php";
            $c = new Constant();
            $StateAppArr = $c->getStateAppArr();
            if($c->getStateApp() == $StateAppArr['Restricted'] ){
              ?>
              <div class="col-sm animated fadeIn MsgAdmin">
              <h2>Login Temporairement restreint à l'administrateur ... veuillez patientez ...</h2>
              </div>
              <?php 
            } 
           ?>

  </div>
  <script src="js/jquery-3.5.1.min.js"></script> 
  <script src="js/app.js"> </script>

  </script>
  </script>
  </body>
</html>
