<?php 
Session_start();

if (!isset( $_SESSION['auth'])){
  header('Location: ../login.php');
  exit();
}
include_once     "../classes/class.Constants.php";
include_once     "../classes/db/class.Database.php";
include_once     "../classes/metier/theme.class.php";

$db = new Database();
$theme = new Theme($db->getInstance());
$themes = $theme->getRows($_SESSION['auth']->id);

include_once ('../top.php');
include_once ('../navTop.php');
include_once ('../side.php');

?>

    
<div class="container"> 
    <div class="row mt-5 ">
        <div class="d-inline-flex flex-row col-12 text-center mb-3 mt-5 border-2 rounded ">
            <div class="mt-0">
                <i class="fas fa-database small-icon text-light"></i>
            </div>
            <div class="ml-2 mt-3 vapor-2">
                <h3>Thèmes</h3>
            </div>
            <span id="addElement" class="addElement" data-toggle="tooltip" data-placement="top" title="Ajouter un Thème"><i class="fa fa-plus-circle " aria-hidden="true"></i></span>        
        </div>
        <hr class="hrVapor">      
    </div>  
    <div id="formTheme" class="row mt-5">

    </div>
    <div class="row m-5">
        <?php foreach($themes as $k => $theme){ ?> 
            <div id="div<?php echo $k; ?>" class="contenant">   
                <div id="<?php echo $theme->rowid; ?>" class="moveable d-flex flex-column justify-content-center align-items-center" draggable=true ondragstart="drag(event)" ondragover="allowDrop(event)" ondrop="drop(event)" data-toggle="tooltip" data-placement="top" title="<?= $theme->toolTipMsg;?>">
                    
                       <div style="position:absolute; top:5px; opacity:0.5"><img src="../assets/logo-cre-yellow.svg" width="45" height="45"></div>
                        <span class="W-100 center"><a href="blocknotes.php?id=<?= $theme->rowid;?>"><?= strtoupper($theme->label); ?></a></span>
                   
                </div>
            </div>
            <?php } ?>    
        </div>
    </div>

    


<script src="../js/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../js/drag.js"></script>
<script src="../js/app.js"></script>

</body>
</html>

