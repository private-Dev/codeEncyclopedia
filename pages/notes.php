<?php 
Session_start();

if (!isset( $_SESSION['auth'])){
  header('Location: ../login.php');
  exit();
}
include_once      "../include/Parsedown.php";
include_once     "../classes/class.Constants.php";
include_once     "../classes/db/class.Database.php";
include_once     "../classes/metier/blocknote.class.php";
include_once     "../classes/metier/theme.class.php";
include_once     "../classes/metier/note.class.php";
$db = new Database();




$blocknote = new Blocknote($db->getInstance());
$blocknote->fetch($_GET['id']);

$th = new Theme($db->getInstance());
$th->fetch($blocknote->fk_theme);

$note = new Note($db->getInstance());
$notes = $note->getRows($_SESSION['auth']->id,$_GET['id']);

include_once ('../top.php');
include_once ('../navTop.php');
include_once ('../side.php');

$_SESSION['selectedBlocknoteId'] = $_GET['id'];

?>


    
<div class="container"> 
    <div class="row mt-5 mb-n5 ml-2">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
      <li class="breadcrumb-item"><a class="a-breadcrumb" href="themes.php"> <strong>Thème :</strong></a></li>
      <li class="breadcrumb-item"><strong> <?= $th->getLabel();?> </strong></li>
      <li class="breadcrumb-item"><a class="a-breadcrumb" href="blocknotes.php"> <strong>Blocknote :</strong></a></li>
      <li class="breadcrumb-item"><strong> <?= $blocknote->getLabel();?> </strong></li>
      <li class="breadcrumb-item active" aria-current="page"><strong>Note</strong></li>
      </ol>
    </nav>
    </div>
    <div class="row mt-0">
    
        <div class="d-inline-flex flex-row col-12 text-center mb-3 mt-5 border-2 rounded ">
            <div class="mt-0">
                <i class="fas fa-database small-icon text-light"></i>
            </div>
            <div class="ml-2 mt-3 vapor-2">
                <h3>notes</h3>
            </div>
            <span id="addnote" class="addElement" data-toggle="tooltip" data-placement="top" data-fk_blocknote="<?=$blocknote->id ?>" title="Ajouter une note au blocknote"><i class="fa fa-plus-circle " aria-hidden="true"></i></span>        
        </div>
        <hr class="hrVapor">      
    </div>  
    <div id="formNote" class="row mt-5">

    </div>
    <div class="row debug">
      <table>
        <?php foreach($notes as $k => $n){ ?> 
           
            <!--<div id="div<?php echo $k; ?>" class="contenant note-contenant">   -->
            
               <!-- <div id="<?php echo $n->rowid; ?>" class="moveable d-flex flex-column justify-content-start align-items-center debugg" draggable=true ondragstart="drag(event)" ondragover="allowDrop(event)" ondrop="drop(event)">-->
                       <!-- design note here !! -->  
                       <!-- BEWARE -->
                       
                       <?php if ($n->beware != '' ){ ?>
                        <tr><td>
                        <p class="tip warning"> <?= $n->beware ?> </p>
                       </td></tr>
                       <?php } ?>
                       

                        <!-- big-title -->
                        <?php if ($n->big_title != '' ){ ?>
                          <tr><td>
                          <h1> <?= $n->big_title ?> </h1>
                        </td></tr>
                       <?php } ?>
                       

                       <!-- title -->
                       <?php if ($n->title != '' ){ ?>
                        <tr><td>
                        <h2 id="Basics"><a href="#<?= $n->title ?>" class="headerlink" title="<?= $n->title ?>" data-scroll=""><?= $n->title ?></a></h2>
                       </td></tr>
                       <?php } ?>


                      <!-- important_comment -->
                        <?php if ($n->important_comment != '' ){ ?>
                          <tr><td>
                          <p class="tip imp"><?= $n->important_comment ?> </p>
                        </td></tr>
                       <?php } ?>

                      
                       <!-- comment -->
                       <?php if ($n->comment != '' ){ ?>
                        <tr><td>
                          <p><?= $n->comment ?> </p>
                       </td></tr>
                       <?php } ?>


                       <!-- comment_bar -->
                       <?php if ($n->comment_bar != '' ){ ?>
                        <tr><td>
                        <blockquote>
                          <p><?= $n->comment_bar ?> </p>
                        </blockquote>     
                       </td></tr>
                       <?php } ?>

                      <!-- code_block -->
                      <?php if ($n->code_block != '' ){ ?>
                        <tr><td>
                          <pre>
                            <code class="hljs js"><?= $n->code_block ?></code>
                          </pre>
                      </td></tr>
                      <?php } ?>

                       <!-- hash_title -->
                       <?php if ($n->hash_title != '' ){ ?>
                        <tr><td>
                        <h3 class="h3-hash" id="Arbitrary-Route-Properties-replaced"><a href="#<?= $n->hash_title ?>" class="headerlink" title="<?= $n->hash_title ?>" ><?= $n->hash_title ?></a></h3> 
                       </td></tr>
                      <?php } ?>
                <!-- </div> -->
           <!-- </div>-->
            <?php } ?> 
                       </table>   
        </div>
    </div>

    


<script src="../js/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../js/dragnote.js"></script>
<script src="../js/app.js"></script>


</body>
</html>
