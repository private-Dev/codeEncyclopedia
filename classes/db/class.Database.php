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

  public function secureNoteUri($noteId,$BlockId,$themeId){
    if (is_numeric($noteId) && is_numeric($BlockId) && is_numeric($themeId)){
    $sql ='  SELECT * FROM note n ';
    $sql .=' INNER JOIN blocknote b ON n.fk_blocknote = b.id';
    $sql .=' INNER JOIN theme t ON b.fk_theme = t.id ';
    $sql .=' WHERE n.id = ?'; 
    $sql .=' AND b.id =?'; 
    $sql .=' AND t.id =? ';
    
     try {
            $stmt = $this->_instance->prepare($sql);
            $stmt->execute([$noteId,$BlockId,$themeId]);
            $row = $stmt->fetch(); 
            return $row ;
            
        }catch(Exception $e){
              die("There's an error in the secure query!");
        }
    }else{
      return 0;
    }       
    
  }
}
