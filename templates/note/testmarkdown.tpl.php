<?php  
Session_start();
if (!isset( $_SESSION['auth'])){
  header('Location: ../login.php');
  exit();
}
?>

<div class="container mt-5">
  <div class="row">
        <div class="col-sm">
            <div class="formulaire-note">
                <a href="" class="closeBtn"><i class="fa fa-times-circle iclose" aria-hidden="true"></i></a>
                <div class="form-group">
                    <label for="paragraph" class="font-weight-bold">Paragraph</label>
                    <textarea id="paragraph" name="paragraph"  class="form-control"  rows="24" cols="80"></textarea>
                </div>
                <div class="form-group">
                    <a  href="#" class ="btn btn-redCode  A-create-paragraph" data-fkblocknote="<?php echo $_SESSION['selectedBlocknoteId'];?>">Créer</a> 
                </div>
            </div>
        </div>
    </div>
</div>