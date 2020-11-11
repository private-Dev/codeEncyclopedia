<?php  
Session_start();

if (!isset( $_SESSION['auth'])){
  header('Location: ../login.php');
  exit();
}
var_dump($_SESSION);
?>
<div class="formulaire-blocknote">
   
  <a href="" class="closeBtn"><i class="fa fa-times-circle iclose" aria-hidden="true"></i></a>
  <div class="form-group">
    <label for="label" class="font-weight-bold">Nom du Blocknote</label>
    <input type="text" class="form-control" name="label" id="label" aria-describedby="labelHelp">
    <div id="labelAlert" class="alert alert-danger" role="alert">Nom du blocknote obligatoire</div>
  </div>
  <div class="form-group">
    <label for="tooltip" class="font-weight-bold">ToolTip message</label>
    <input type="text" class="form-control" id="tooltip" name="tooltip">
  </div>
  <a  href="#" class ="btn btn-purpleCode  A-create-Blocknote" data-fktheme="<?php echo $_SESSION['NewNote']['idTheme'];?>">Créer</a>
  </div>