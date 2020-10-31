<?php
/**
 * Author :  jpb
 * Date   : 26/09/2020
 *
 *  Fichier exclusivement utilisé pour les appels ajax
 * Interface_Object_or_context.php
 *
 */

Session_start();

if (!isset( $_SESSION['auth'])){
    // header('Location: ../login.php');
    //exit();
}
include_once     "../classes/class.Constants.php";
include_once     "../classes/db/class.Database.php";
include_once     "../classes/metier/blocknote.class.php";
include_once     "../classes/user/class.User.php";

$idTheme = isset($_POST['idTheme']) ? $_POST['idTheme'] :'';
$action = isset($_POST['action']) ? $_POST['action']:'';

$data =[];

if (isset($action) && !empty($action) &&  $action == 'selectChangeTheme'){
    $db = new Database();
    $blocknote = new Blocknote($db->getInstance());
    $blocknotes = $blocknote->getRows($_SESSION['auth']->id,$idTheme);

    $html = '<label for="selectBlock" class="mt-1">Blocknote</label>';
    $html .='<select id="selectBlock" name="selectBlock" class="form-control ml-5">';
                      foreach ($blocknotes as $b){
                          $html .='<option value="'.$b->rowid.'">'.$b->label.'</option>';
                        }
    $html .='</select>';
    $html .='<a id="addBlocknote" class="nav-link" href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>';

}

echo $html;