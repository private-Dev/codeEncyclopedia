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
include_once     "../classes/metier/note.class.php";
include_once     "../classes/metier/paragraph.class.php";

include_once     "../classes/user/class.User.php";

$userId             = isset($_SESSION['auth']->id) ? $_SESSION['auth']->id :'';
$firstTheme         = isset($_POST['firstThemeId']) ? $_POST['firstThemeId'] :'';  
$secondTheme        = isset($_POST['secondThemeId']) ? $_POST['secondThemeId']:'' ; 
$firstBlock         = isset($_POST['firstblockId']) ? $_POST['firstblockId'] :'';  
$secondBlock        = isset($_POST['secondblockId']) ? $_POST['secondblockId']:'' ;

$action             = isset($_POST['action']) ? $_POST['action']:'';
$fktheme            = isset($_POST['fktheme']) ? $_POST['fktheme']:'';

$beware             = isset($_POST['beware']) ? $_POST['beware']:'' ;
$bigtitle           = isset($_POST['bigtitle']) ? $_POST['bigtitle']:'' ;
$title              = isset($_POST['Paragraphtitle']) ? $_POST['Paragraphtitle']:'' ;
$importantcomment   = isset($_POST['importantcomment']) ? $_POST['importantcomment']:'' ;
$comment            = isset($_POST['comment']) ? $_POST['comment']:'' ;
$commentbar         = isset($_POST['commentbar']) ? $_POST['commentbar']:'' ;
$codeblock          = isset($_POST['codeblock']) ? $_POST['codeblock']:'' ;
$imgblock           = isset($_POST['imgblock']) ? $_POST['imgblock']:'' ;
$hashtitle          = isset($_POST['hashtitle']) ? $_POST['hashtitle']:'' ;
$fkblocknote          = isset($_POST['fkblocknote']) ? $_POST['fkblocknote']:'' ;

// element added
$label = isset($_POST['label']) ? $_POST['label'] :'';
$tooltip =isset($_POST['tooltip']) ? $_POST['tooltip']:'' ;
$action = isset($_POST['action']) ? $_POST['action']:'';
// --
$data =[];

/**
 * _______________________________________________________________________________
 *                  DRAGGED BEHAVIORS 
 * _______________________________________________________________________________
 */
//dragged  --- 
if (isset($action) && !empty($action) &&  $action == 'themeDragged'){
    
    $db = new Database();
    $theme = new Theme($db->getInstance());
    
    $th_ranked_one = $theme->getRank($userId,$firstTheme);
    $th_ranked_two = $theme->getRank($userId,$secondTheme);

    $theme->updateUserRank($userId,$th_ranked_one->fk_theme,$th_ranked_two->rank_display);    
    $theme->updateUserRank($userId,$th_ranked_two->fk_theme,$th_ranked_one->rank_display);   

}
if (isset($action) && !empty($action) &&  $action == 'blockNoteDragged'){
    
    $db = new Database();
    $blocknote = new Blocknote($db->getInstance());
   
    $b_ranked_one = $blocknote->getRank($userId,$firstBlock);
    $b_ranked_two = $blocknote->getRank($userId,$secondBlock);
   

    $blocknote->updateUserRank($userId,$b_ranked_one->fk_blocknote,$b_ranked_two->rank_display);    
    $blocknote->updateUserRank($userId,$b_ranked_two->fk_blocknote,$b_ranked_one->rank_display);   
}
//not implemented yet 
if (isset($action) && !empty($action) &&  $action == 'paragraphDragged'){}
// ---- 

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


    /**--------------------------------------------------------- */
    /**
     * à la création du theme
     * on reset la session idblocknote
     * nous ne voulons pas conserver
     * un id block qui ne serait pas lié au nouvel id du theme
     *
     * @TODO SI ON AJOUTE LE SYSTEM POUR LES NOTES ON DEVRA FAIRE DE MËME
     * AVEC LA SESSION IDNOTE
     */
    // memory for creating note
    $_SESSION['NewNote']['idTheme'] = $lastIdTheme;

    if (isset($_SESSION['NewNote']['idBlock'])){
        unset($_SESSION['NewNote']['idBlock']);
    }
    /**--------------------------------------------------------- */



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
/**
 * _______________________________________________________________________________
 *                  BLOCKNOTES 
 * _______________________________________________________________________________
 */
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

    $lastIdBlockNote = $blocknote->create($label,$tooltip,$rank,$fktheme);
    // memory for creating note
    $_SESSION['NewNote']['idBlock'] = $lastIdBlockNote;


    // select all users 
    $user = new User($db->getInstance());
    $users = $user->getRowsId();

    // foreach user insert in display_theme an entry with id theme, rank, id_user
    foreach($users as $k => $u){
        $statment = $db->getInstance()->prepare("INSERT INTO blocknote_display_user (fk_user,fk_blocknote,rank_display) VALUES (?,?,?)");
        $statment->execute([intval($u->id),intval($lastIdBlockNote),intval($rank)]);
    }
    $data['success'] = true;
    $data['message'] = 'Success';

    echo json_encode($data);
}

/**
 * _______________________________________________________________________________
 *                  NOTES 
 * _______________________________________________________________________________
 */

if (isset($action) && !empty($action) &&  $action == 'addnote'){
    $data['errors']  ='none';   
    $nb =0;
    $rank =0;

    $db = new Database();
    
    $blocknote = new Blocknote($db->getInstance());

    $note = new Note($db->getInstance());

    // return nb note + 1 for rank 
    $n = new note($db->getInstance());
    $nb = $n->getMaxRank();
    $rank = $nb->nb + 1;
   
    // create theme with rank created earlier
    $lastIdTheme = $note->create($beware,$bigtitle,$title,$importantcomment,$comment,$commentbar,$codeblock,$imgblock,$hashtitle,$rank,$fkblocknote);
   
    // select all users 
    $user = new User($db->getInstance());
    $users = $user->getRowsId();

    // foreach user insert in display_theme an entry with id theme, rank, id_user
   // foreach($users as $k => $u){
   //     $statment = $db->getInstance()->prepare("INSERT INTO blocknote_display_user (fk_user,fk_blocknote,rank_display) VALUES (?,?,?)");
   //     $statment->execute([intval($u->id),intval($lastIdTheme),intval($rank)]);
    //}
    $data['success'] = true;
    $data['message'] = 'Success';

    echo json_encode($data);
}

if (isset($action) && !empty($action) &&  $action == 'previewNote'){
    include_once     "../include/ParseClassdown.php";
    $p = new ParseClassedown();

    $content = isset($_POST['content']) ? $_POST['content'] : '' ;
    $data = $p->text($content,true);
   // var_dump($data);
    echo json_encode($data);

}

if (isset($action) && !empty($action) &&  $action == 'deleteNote'){
    $idNote = isset($_POST['idNote']) ? $_POST['idNote'] : '' ;
    $errors ="";
    if (is_Numeric($idNote)){
        $db = new Database();
        $note = new Note($db->getInstance());
        $note->fetch($idNote);
        $note->delete();
    }else{
        $errors ="Erreur lors de la suppression de la Note.";
    }

}