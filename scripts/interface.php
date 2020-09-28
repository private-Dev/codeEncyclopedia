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

$userId = isset($_SESSION['auth']->id) ? $_SESSION['auth']->id :'';
$firstTheme = isset($_POST['firstThemeId']) ? $_POST['firstThemeId'] :'';  
$secondTheme =isset($_POST['secondThemeId']) ? $_POST['secondThemeId']:'' ; 
$action = isset($_POST['action']) ? $_POST['action']:'';


if (isset($action) && !empty($action) &&  $action == 'themeDragged'){
    
    $db = new Database();
    $theme = new Theme($db->getInstance());

    $th_ranked_one = $theme->getRank($userId,$firstTheme);
    $th_ranked_two = $theme->getRank($userId,$secondTheme);

    $theme->updateUserRank($userId,$th_ranked_one->fk_theme,$th_ranked_two->rank_display);    
    $theme->updateUserRank($userId,$th_ranked_two->fk_theme,$th_ranked_one->rank_display);   

}
if (isset($action) && !empty($action) &&  $action == 'BlockNoteDragged'){}
if (isset($action) && !empty($action) &&  $action == 'paragraphDragged'){}

