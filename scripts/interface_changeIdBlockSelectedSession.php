<?php
/**
 * Created by PhpStorm.
 * User: root-home
 * Date: 11/11/2020
 * Time: 11:14
 */


Session_start();

if (!isset( $_SESSION['auth'])){
    header('Location: ../login.php');
    exit();
}
$action = isset($_POST['action']) ? $_POST['action']:'';

if (isset($action) && !empty($action) &&  $action == 'selectChangeBlock'){
    $_SESSION['NewNote']['idBlock'] = isset($_POST['idBlock']) ? $_POST['idBlock'] : '';
}

