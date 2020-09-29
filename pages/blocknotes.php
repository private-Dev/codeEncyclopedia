<?php 
Session_start();

if (!isset( $_SESSION['auth'])){
  header('Location: ../login.php');
  exit();
}
include_once     "../classes/class.Constants.php";
include_once     "../classes/db/class.Database.php";

$db = new Database();

include_once ('../top.php');
include_once ('../navTop.php');


?>