<?php 
setlocale(LC_CTYPE, 'fr_FR.UTF-8');
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
$paragraph->fetch($_GET['id']);

include_once ('../top.php');
include_once ('../navTop.php');
include_once ('../side.php');

$_SESSION['selectedNoteId'] = $_GET['id'];
?>

<div class="container">
    <?=$p->text($paragraph->content); ?>
</div>

<script src="../js/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../js/dragnote.js"></script>
<script src="../js/app.js"></script>


</body>
</html