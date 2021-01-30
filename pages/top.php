<?php
Session_start();
if (!isset( $_SESSION['auth'])){
    header('Location: ../login.php');
    exit();
}


include_once     "../include/parseClassDown.php";
include_once     "../classes/class.Constants.php";
include_once     "../classes/db/class.Database.php";
include_once     "../classes/metier/paragraph.class.php";
include_once     "../classes/metier/blocknote.class.php";
include_once     "../classes/metier/theme.class.php";
include_once     "../classes/metier/note.class.php";
include_once     "../classes/Util/Util.php";

$db = new Database();
$p = new ParseClassedown();
$paragraph = new Paragraph($db->getInstance());
//$paragraph->fetch($_GET['id']);

$theme = new Theme($db->getInstance());
$block = new Blocknote($db->getInstance());
$note = new Note($db->getInstance());
$paragraph = new Paragraph($db->getInstance());

$user = $_SESSION['auth']->id;
$themes = $theme->getRows($user);

$action = isset($_GET['action']) ? $_GET['action'] : '';

// we must have all 3 ids ...
if (isset($_GET['noteId']) && isset($_GET['blocknoteId']) && isset($_GET['themeId']) ){
 
    $noteId = isset($_GET['noteId']) ? $_GET['noteId'] : '';
    $blocknoteId = isset($_GET['blocknoteId']) ? $_GET['blocknoteId'] : '';
    $themeId = isset($_GET['themeId']) ? $_GET['themeId'] : '';    

    // l'utilisateur à t'il modifié l'uri comme un crobard de merde ? 
    $secure = true;
    $res =  $db->secureNoteUri($noteId,$blocknoteId,$themeId);
    if ($res){
        $_SESSION['NewNote']['idTheme'] = $themeId;
        $_SESSION['NewNote']['idBlock'] = $blocknoteId;
        $_SESSION['NewNote']['idNote'] = $noteId;
    }else{
        $secure = false;
    }
}else{
    $secure = false;
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Code Reminder Encyclopédia</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/style5.css">
    <link rel="stylesheet" href="../css/sideMenu.css">
    <link rel="stylesheet" href="../css/leftMenu.css">
    <link rel="stylesheet" href="../css/note.css">
    <!-- <link rel="stylesheet" href="../css/app.css">-->

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
   
</head>


<body>
<!-- The video -->
<!--<video autoplay muted loop id="myVideo">
  <source src="../assets/animated-form/v1.mp4" type="video/mp4">
</video>
-->
<div class="wrapper">
    <!-- left menu -->
        <div class="accordion js-accordion" id="sidebar">
        <div class="sidebar-header">
            <span class="d-inline-flex p-3 markk">
                <img src="../assets/logo-cre-yellow.svg" class="adminImgLogo mt-1" width="40" height="40" alt="codeEncyclopedia logo">
                <span class="mt-3 ml-3 text-light">Code Encyclopédia</span>
            </span>
        </div>
        <div class="sidebar-header">
            <div class="input-group mb-3">

                <input type="text" class="form-control" id="filter-left" name="filter-left" placeholder="filters" aria-label="filters" aria-describedby="basic-addon1">
            </div>
        </div>
        <?php foreach ($themes as $t) { ?>
        <div class="accordion__item js-accordion-item active">

            <div class="accordion-header js-accordion-header"><?= $t->label; ?></div>
            <div class="accordion-body js-accordion-body">

                <div class="accordion js-accordion">
                    <?php
                    $blocks =  $block->getRows($user,$t->rowid);

                    foreach ($blocks as $b) {  ?>
                    <div class="accordion__item js-accordion-item ">
                        <div class="accordion-header js-accordion-header"> <?= $b->label ?></div>
                        <div class="accordion-body js-accordion-body">
                            <?php
                            $notes =  $note->getRows($user,$b->rowid);

                            foreach ($notes as $n) {  ?>
                            <div class="accordion-body__contents">
                                <a class="section-link" href="addNote.php?action=<?=Constant::$VIEWNOTE?>&noteId=<?=$n->rowid ?>&blocknoteId=<?=$b->rowid ?>&themeId=<?=$t->rowid ?>" title="<?=$n->label ?>">
                                    <i class="fa fa-tag" aria-hidden="true"></i>
                                    <?=$n->label ?>
                                </a>
                            </div><!-- end of sub accordion item body contents -->
                            <?php } ?>
                        </div><!-- end of sub accordion item body -->
                    </div><!-- end of sub accordion item -->
                    <?php }  ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <!-- left menu end -->



     <!-- Page Content Holder -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="navbar-btn active">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                        <form class="form-inline debug" >
                            <input id="searchInput" class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Search" >
                        </form>           
                        </li>
                        <li class="nav-item">
                            <i class="fab fa-android" aria-hidden="true"></i>
                            <a class="nav-link" href="addNote.php?action=<?=Constant::$CREATENOTE?>">Note <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../signout.php">Sign out</a>
                        </li>
                        <li class="nav-item">
                        <h6 class="ml-2" >
                            <span><small class="ml-5 mt-2 bluetext">V1.0.0</small></span>
                        </h6>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>