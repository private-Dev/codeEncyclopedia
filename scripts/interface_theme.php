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
  exit();
}
include_once     "../classes/class.Constants.php";
include_once     "../classes/db/class.Database.php";
include_once     "../classes/metier/theme.class.php";
include_once     "../classes/user/class.User.php";

$label = isset($_POST['label']) ? $_POST['label'] :'';  
$tooltip =isset($_POST['tooltip']) ? $_POST['tooltip']:'' ; 
$action = isset($_POST['action']) ? $_POST['action']:'';

$data =[];

if (isset($action) && !empty($action) &&  $action == 'addTheme'){
    $nb =0;
    $rank =0;

    $db = new Database();
    $theme = new Theme($db->getInstance());

    // return nb theme + 1 for rank 
    $th = new Theme($db->getInstance());
    $nb = $th->getMaxRank();
    $rank = $nb->nb + 1;
   
    // create theme with rank created earlier
    $lastIdTheme = $theme->create($label,$tooltip,$rank);
    // theme get last id  
   
    // select all users 
    $user = new User($db->getInstance());
    $users = $user->getRowsId();

    // foreach user insert in display_theme an entry with id theme, rank, id_user
    foreach($users as $u){

    }

 
    $data['success'] = true;
    $data['message'] = 'Success';
    $data['errors']  ='none';   

    echo json_encode($data);
}