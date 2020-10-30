<?php 
Session_start();

if (!isset( $_SESSION['auth'])){
  header('Location: ../login.php');
  exit();
}

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
    <div class="row m-5">

        <?php foreach($notes as $k => $b){ ?> 
           
            <div id="div<?php echo $k; ?>" class="contenant blocknote-contenant">   
            
                <div id="<?php echo $b->rowid; ?>" class="moveable d-flex flex-column justify-content-center align-items-center" draggable=true ondragstart="drag(event)" ondragover="allowDrop(event)" ondrop="drop(event)" data-toggle="tooltip" data-placement="top" title="<?= $b->toolTipMsg;?>">
                               
                       <div style="position:absolute; top:5px; opacity:0.5">
                            <img src="../assets/logo-cre-orange.svg" width="45" height="45">
                            <i class="fa fa-pencil" aria-hidden="true"></i>    
                        </div>
                       <span class="W-100 center"><a href="note.php?id=<?= $b->rowid;?>"><?= strtoupper($b->label); ?></a></span>
                   
                </div>
            </div>
            <?php } ?>    
        </div>
    </div>

    


<script src="../js/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../js/dragnote.js"></script>
<script src="../js/app.js"></script>


</body>
</html>
