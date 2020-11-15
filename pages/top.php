<?php
Session_start();
if (!isset( $_SESSION['auth'])){
    header('Location: ../login.php');
    exit();
}


include_once     "../include/ParseClassdown.php";
include_once     "../classes/class.Constants.php";
include_once     "../classes/db/class.Database.php";
include_once     "../classes/metier/paragraph.class.php";
include_once     "../classes/metier/blocknote.class.php";
include_once     "../classes/metier/theme.class.php";
include_once     "../classes/metier/note.class.php";

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
    <link rel="stylesheet" href="../css/note.css">
    <!-- <link rel="stylesheet" href="../css/app.css">-->

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
   
</head>


<body>

<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar" class="active">
        <div class="sidebar-header">
            <span class="d-inline-flex p-3 markk">
                <img src="../assets/logo-cre-blue.svg" class="adminImgLogo mt-1" width="50" height="50" alt="Global notes Logo">
                <span class="mt-2">Code Encyclopédia</span>
            </span>
        </div>

        <ul class="list-unstyled components">
            <p></p>
            <?php foreach ($themes as $t) { ?>
                <li><p class="theme-list-label"><?= $t->label; ?></p>
                    <ul class="list-unstyled">
                        <?php
                        $blocks =  $block->getRows($user,$t->rowid);

                        foreach ($blocks as $b) {  ?>

                                <li>
                                    <span class="ml-2">
                                        <?= $b->label ?>
                                    </span>
                                    <hr>
                                </li>

                            <ul class="list-unstyled">
                                <?php
                                $notes =  $note->getRows($user,$b->rowid);

                                foreach ($notes as $n) {  ?>
                                    <li class="ml-3">
                                        <a class="section-link" href="addNote.php?action=<?=Constant::$VIEWNOTE?>&noteId=<?=$n->rowid ?>&blocknoteId=<?=$b->rowid ?>&themeId=<?=$t->rowid ?>" title="<?=$n->label ?>">
                                            <?=$n->label ?>
                                        </a>
                                    </li>
                                <?php  } ?>
                            </ul>
                            </li>
                        <?php  } ?>
                    </ul>
                </li>
            <?php  } ?>

        </ul>

    </nav>

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