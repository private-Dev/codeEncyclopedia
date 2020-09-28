<?php
Session_start();
if (!isset( $_SESSION['auth'])){
  header('Location: login.php');
  exit();
}




?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title></title>

  
    <!-- Bootstrap core CSS -->
   <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">

    <!-- Favicons -->
    <link href="http://fonts.googleapis.com/css?family=Chelsea+Market" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
    
    <!-- Custom styles for this template -->
    <link href="css/app.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Encyclopédia</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/themes.php">
              <span data-feather="file"></span>
              Themes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              Blocknotes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users"></span>
              Notes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Configuration</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Tables
            </a>
          </li>
          
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="container ">
          <div class="row container-marged">
              <div class="col-12">
                  <div class="wrapper-logo-admin d-flex flex-sm-column flex-lg-row justify-content-center align-items-center">
                      <img src="assets/logo-cre.svg" class="adminImgLogo mt-1" width="50" height="50" alt="Global notes Logo">
                      <h1 class="ml-5 h1-color"> Administration </h1>
                      <h1 class="ml-5 h1-color">Code Reminder Encyclopedia</h1>
                  </div>
                  <hr>
                  <h1 class="ml-5 d-flex align-items-center"></h1>
              </div>
              <div class="vapor">Dashboard</div>
          </div>
          <div class="row mt-5 ">
            <div class="d-inline-flex flex-row col-12 text-center mb-3 mt-5 border-2 rounded ">
              <div class="mt-3">
                    <i class="fas fa-database small-icon text-light"></i>
              </div>
              <div class="ml-3 mt-5 vapor-2">
                <h4>Informations base de données</h4>
              </div>
            </div>
              <hr>
          </div>
          <div class="row mt-5 ">
            
              <div class="col-sm-12 col-md-12 col-lg-4">
                  <div class="card mb-3 card-admin" >
                      <div class="row no-gutters">
                          <div class="col-md-4">
                              <i class="fas fa-folder big-icon"></i>
                          </div>
                          <div class="col-md-8">
                              <div class="card-body">
                                  <h5 class="card-title">Folders : <strong>5</strong></h5>
                                  <p class="card-text">Folders crées dans la base de données.</p>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-12 col-lg-4">
                  <div class="card mb-3 card-admin" >
                      <div class="row no-gutters">
                          <div class="col-md-4">
                              <i class="fas fa-archive big-icon"></i>
                          </div>
                          <div class="col-md-8">
                              <div class="card-body">
                                  <h5 class="card-title">Blocknotes : <strong>5</strong></h5>
                                  <p class="card-text">Blocknotes presents dans la base de données. </p>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-12 col-lg-4">
                  <div class="card mb-3 card-admin" >
                      <div class="row no-gutters">
                          <div class="col-md-4">
                              <i class="far far fa-sticky-note big-icon"></i>
                          </div>
                          <div class="col-md-8">
                              <div class="card-body">
                                  <h5 class="card-title">Notes : <strong>5</strong></h5>
                                  <p class="card-text">Notes enregistrés dans la base de données.</p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-12 col-lg-4">
                  <div class="card mb-3 card-admin" >
                      <div class="row no-gutters">
                          <div class="col-md-4">
                              <i class="far fa-address-book big-icon"></i>
                          </div>
                          <div class="col-md-8">
                              <div class="card-body">
                                  <h5 class="card-title">Users : <strong>5</strong></h5>
                                  <p class="card-text">Utilisateurs presents dans la base de données.</p>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-12 col-lg-4">
                  <div class="card mb-3 card-admin">
                      <div class="row no-gutters">
                          <div class="col-md-4">
                              <i class="fas fa-fingerprint big-icon"></i>
                          </div>
                          <div class="col-md-8">
                              <div class="card-body">
                                  <h5 class="card-title">Rules : <strong>4</strong></h5>
                                  <p class="card-text">Droits presents dans la base de données.</p>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <hr>
      </div>
   
    </main>
  </div>
</div>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/app.js"></script>
</body>
</html>

