<?php

class Constant{
    
     
    //---------------CONFIG SERVER AND DEV 
    private $LOCAL_DEV = true;
    
    
    private $StateAppArr = array('Running' => 1, 'Maintenance' => 2,'Restricted' => 3,'Closed' => 4);
    private $StateApp = 1;

    private $DEBUG = false;
    //---------------CONFIG SERVER AND DEV 
    
    private $LOCAL_DNS = 'mysql:dbname=dbName;host=localhost';// change this value for feeting your wish
    private $LOCAL_USER = 'root'; // change this value for feeting your wish
    private $LOCAL_PASSWORD ='root';// change this value for feeting your wish
    //------------------------------------------------
    private $DISTANT_DNS = 'mysql:dbname=dbName;host=IP';// change this value for feeting your wish
    private $DISTANT_USER = 'USERnAME';// change this value for feeting your wish
    private $DISTANT_PASSWORD = 'pASSWORD';//mysql password // change this value for feeting your wish
 

    /**
     * Get the value of LOCAL_DNS
     */ 
    public function getLOCAL_DNS(){
            return $this->LOCAL_DNS;
    }
    /**
     * Get the value of LOCAL_USER
     */ 
    public function getLOCAL_USER(){
            return $this->LOCAL_USER;
    }
    /**
     * Set the value of LOCAL_PASSWORD
     *
     * @return  self
     */ 
    public function getLOCAL_PASSWORD(){
            return $this->LOCAL_PASSWORD ;     
    }
    /**
     * Get the value of DISTANT_DNS
     */ 
    public function getDISTANT_DNS() {
        return $this->DISTANT_DNS;
    }
    /**
     * Get the value of DISTANT_USER
     */ 
    public function getDISTANT_USER() {
        return $this->DISTANT_USER;
    }
    /**
     * Get the value of DISTANT_PASSWORD
     */ 
    public function getDISTANT_PASSWORD(){
        return $this->DISTANT_PASSWORD;
    }
    
    /*
    * Get the value of LOCAL_DEV
    */
    public function getLOCAL_DEV(){
          return $this->LOCAL_DEV;
    }


}