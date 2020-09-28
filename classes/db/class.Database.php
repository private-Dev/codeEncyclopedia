<?php

/**
 * Class Database
 * gère lla connexion à la base de donnée
 *
 */
class Database {
  private $_instance = null;
  private $_constante = null;
  public function __construct() {
    $this->_constante = new Constant();
    $this->createConnexion();
  }
  private function createConnexion(){
   
    if ($this->_constante->getLOCAL_DEV()){
      $pDSN       = $this->_constante->getLOCAL_DNS();
      $pUserName  = $this->_constante->getLOCAL_USER();
      $pPassword  = $this->_constante->getLOCAL_PASSWORD();
  } else{
      $pDSN      = $this->_constante->getDISTANT_DNS();
      $pUserName = $this->_constante->getDISTANT_USER();
      $pPassword = $this->_constante->getDISTANT_PASSWORD();


  } 
  try {
      $this->_instance = new PDO($pDSN, $pUserName, $pPassword);
      $this->_instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $this->_instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      $this->_instance->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
      $this->_instance->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
  }  catch (PDOException $e) {
      echo 'Base de Donnée Non Accessible ... veuillez reéessayer.';
  }
}
  public function getInstance(){
      return $this->_instance;
  }

  public function getConstant(){
    return  $this->_constante;
  }

  public function stateObj(){
    print_r("Obj Database Crée avec succes.<br>");
  }
}
