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
include_once     "../classes/user/class.User.php";



$action = isset($_POST['action']) ? $_POST['action']:'';
$fktheme = isset($_POST['fktheme']) ? $_POST['fktheme']:'';
$fkblocknote = isset($_POST['fkblocknote']) ? $_POST['fkblocknote']:'';
$notelabel = isset($_POST['notelabel']) ? $_POST['notelabel']:'';
$paragraph = isset($_POST['paragraph']) ? $_POST['paragraph']:'';


if (isset($action) && !empty($action) &&  $action == 'addnote'){

    // create note attached to blockNote

    // get lastId note

    // create paragraph attached to this note


}