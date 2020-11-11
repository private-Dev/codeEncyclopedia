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
include_once     "../classes/metier/blocknote.class.php";
include_once     "../classes/user/class.User.php";

$label = isset($_POST['label']) ? $_POST['label'] :'';  
$tooltip =isset($_POST['tooltip']) ? $_POST['tooltip']:'' ; 
$action = isset($_POST['action']) ? $_POST['action']:'';

$data =[];

if (isset($action) && !empty($action) &&  $action == 'addTheme'){
    $data['errors']  ='none';   
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
   
    // select all users 
    $user = new User($db->getInstance());
    $users = $user->getRowsId();

    // foreach user insert in display_theme an entry with id theme, rank, id_user
    foreach($users as $k => $u){
        $statment = $db->getInstance()->prepare("INSERT INTO theme_display_user (fk_user,fk_theme,rank_display) VALUES (?,?,?)");
        $statment->execute([intval($u->id),intval($lastIdTheme),intval($rank)]);
    }
    $data['success'] = true;
    $data['message'] = 'Success';

    echo json_encode($data);
}


if (isset($action) && !empty($action) &&  $action == 'addblocknote'){
    $data['errors']  ='none';   
    $nb =0;
    $rank =0;

    $db = new Database();
    $blocknote = new Blocknote($db->getInstance());

    // return nb blocknote + 1 for rank 
    $bl = new Blocknote($db->getInstance());
    $nb = $bl->getMaxRank();
    $rank = $nb->nb + 1;
   
    // create theme with rank created earlier
    $lastIdTheme = $blocknote->create($label,$tooltip,$rank,);
   
    // select all users 
    $user = new User($db->getInstance());
    $users = $user->getRowsId();

    // foreach user insert in display_theme an entry with id theme, rank, id_user
    foreach($users as $k => $u){
        $statment = $db->getInstance()->prepare("INSERT INTO blocknote_display_user (fk_user,fk_theme,rank_display) VALUES (?,?,?)");
        $statment->execute([intval($u->id),intval($lastIdTheme),intval($rank)]);
    }
    $data['success'] = true;
    $data['message'] = 'Success';

    echo json_encode($data);
}