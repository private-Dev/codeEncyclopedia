<?php
/**
 * Created by PhpStorm.
 * User: root-home
 * Date: 11/11/2020
 * Time: 11:58
 */

Session_start();

if (!isset( $_SESSION['auth'])){
    // header('Location: ../login.php');
    exit();
}


include_once     "../classes/class.Constants.php";
include_once     "../classes/db/class.Database.php";
include_once     "../classes/metier/theme.class.php";
include_once     "../classes/metier/blocknote.class.php";
include_once     "../classes/metier/note.class.php";
include_once     "../classes/metier/paragraph.class.php";
include_once     "../classes/user/class.User.php";


$userId = $_SESSION['auth']->id ;
$action = isset($_POST['action']) ? $_POST['action']:'';
$fktheme = isset($_POST['fktheme']) ? $_POST['fktheme']:'';
$fkblocknote = isset($_POST['fkblocknote']) ? $_POST['fkblocknote']:'';
$notelabel = isset($_POST['notelabel']) ? $_POST['notelabel']:'';
$paragraph = isset($_POST['paragraph']) ? $_POST['paragraph']:'';


if (isset($action) && !empty($action) &&  $action == 'addnote'){

    // create note attached to blockNote
    $db = new Database();
    $note = new Note($db->getInstance());
    $rank = 0;
    $toolTipMsg ="";

    // get next Rank
    $nb = $note->getMaxRank();
    $rank = $nb->nb + 1;
    
    //create note and get is Id 
    $idNote = $note->create($notelabel,$fkblocknote,$rank,$toolTipMsg);
    
    $p = new Paragraph($db->getInstance());
    $nb = $p->getMaxRank();
    $rank = $nb->nb + 1;

    // create paragraph attached to this note 
    $idParagraph = $p->create($idNote,$paragraph,$rank);
    $data['id'] = $idNote;
   
    echo json_encode($data);
    

}