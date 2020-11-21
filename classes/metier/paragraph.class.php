<?php 

class Paragraph {

public $_db;

public $id;
public $content;
public $date_created;
public $date_update;
public $fk_note;
public $current_user;
public $rank;

    public function __construct($db) {
    $this->_db = $db;
    }
    
    /**
     * fetch paragraph with 
     * @param id int fk_note related to paragraph 
     */
    public function fetch($id) {
        $sql = "SELECT * FROM  paragraph as t WHERE t.fk_note = ? ";
        try{
        $stmt = $this->_db->prepare($sql);
        $result  = $stmt->execute([$id]);
        
        $row = $stmt->fetch(); 
        //var_dump($row);
        $this->id = $row->id;
        $this->content = $row->content;
        $this->date_created = $row->date_created;
        $this->date_update = $row->date_update;
        $this->fk_note =  $row->fk_note;
        $this->rank = $row->rank;
        $stmt = null;

        return $result;
        }catch(Exception $e){
            die('error load paragraph.');
        }   
    }
     /**
     * fetch paragraph with 
     * @param id int fk_note related to paragraph 
     */
    public function fetchWithId($id) {
      

        $sql = "SELECT * FROM  paragraph as t WHERE t.id = ? ";
        try{
        $stmt = $this->_db->prepare($sql);
        $result  = $stmt->execute([$id]);
        
        $row = $stmt->fetch(); 
        //var_dump($row);
        $this->id = $row->id;
        $this->content = $row->content;
        $this->date_created = $row->date_created;
        $this->date_update = $row->date_update;
        $this->fk_note =  $row->fk_note;
        $this->rank = $row->rank;
        $stmt = null;

        return $result;
        }catch(Exception $e){
            die('error load paragraph.');
        }   
    }
    /**
    * 
    */
    public function getRows($userId,$noteId){
        if (!is_numeric($noteId)){
            return 0;
        }    

        $sql = "SELECT p.id, p.content ,p.rank FROM paragraph as p";
        $sql .= " WHERE p.fk_note = ?";
        $sql .= " ORDER BY p.rank";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([intval($noteId)]);
        $rows = $stmt->fetchAll();

        $stmt = null;
        return $rows;
    }
    /**
     * 
     */
    public function getRank($userId,$blockNoteId){
        
        $sql = "SELECT fk_note, rank_display FROM  paragraph_display_user WHERE fk_user = ? AND fk_blocknote = ?";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$userId,$blockNoteId]);
        $row = $stmt->fetch(); 
        $stmt = null;
        return $row;
    }
    /**
     * 
     */
    public function getMaxRank(){
        $sql = "SELECT MAX(rank) as nb FROM paragraph";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(); 
        $stmt = null;
        return $result;
    }
    /**
     * 
     */
    public function create($fk_note,$content,$rank){
        $date = date('Y-m-d H:i:s');
        include_once     "../include/parseClassDown.php";
            $p = new ParseClassedown();
            $result = implode('', $p->cleanText($content));  
        // prepare and bind
        $stmt = $this->_db->prepare("INSERT INTO paragraph (fk_note,rank,content,content_tagless,date_created,date_update) VALUES (:fk_note,:rank,:content,:tagless,:date_c,:date_u)");

        $stmt->bindParam(':fk_note',$fk_note);
        $stmt->bindParam(':rank', $rank);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':tagless', $result);
        $stmt->bindParam(':date_c', $date);
        $stmt->bindParam(':date_u', $date);
        
        $stmt->execute();
        $stmt = null;
        return $this->_db->lastInsertId(); 
    }
    /**
     * 
     */
    public function update($content){

            
            include_once     "../include/parseClassDown.php";
            $p = new ParseClassedown();
            $result = implode('', $p->cleanText($content));  

            $date = date('Y-m-d H:i:s');
        
            $sql="UPDATE paragraph SET `content` = :content ,`date_update` = :dateU ,`content_tagless`=:tagless WHERE `id` = :id";
            try {  
                $statement = $this->_db->prepare($sql);
                $statement->bindValue(":content", $content);
                $statement->bindValue(":tagless", $result);
                $statement->bindValue(":dateU", $date);
                $statement->bindValue(":id", $this->id);
                $count = $statement->execute();
            }catch(Exception $e){
                die("update paragraph error.");
            }
    }
    /**
     * Search engine On Full text  mysql behavior.
     */
    public function Search($entries){

      $sql='  SELECT t.id as idtheme,b.id as idblocknote,n.id as idnote, p.fk_note , n.label, n.date_created, n.toolTipMsg, p.content_tagless as t, ';
      $sql.= ' MATCH(content_tagless) AGAINST (? IN NATURAL LANGUAGE MODE) AS score';
      $sql.=' FROM paragraph p';
      $sql.='  INNER JOIN note n ON p.fk_note = n.id';
      $sql.='  INNER JOIN blocknote b ON n.fk_blocknote = b.id';
      $sql.='  INNER JOIN theme t ON b.fk_theme = t.id';
      $sql .=" WHERE MATCH(content_tagless) AGAINST (  ?  IN BOOLEAN MODE )";
      $sql.=' order by score DESC';

        try {  
            $stmt = $this->_db->prepare($sql);
            $stmt->execute([$entries,$entries]);
            $rows = $stmt->fetchAll();
        }catch(Exception $e){
            die("update paragraph error.");
        }    
        
        
        return $this->splitInSeakerView($rows ,$entries);;

        //SELECT id , MATCH(content) AGAINST('Module' IN NATURAL LANGUAGE MODE) AS score FROM paragraph order by score DESC limit 2;
        /*SELECT count(id) FROM paragraph WHERE MATCH(content) AGAINST('Copy,sql,Le' WITH QUERY EXPANSION);*/
    }

    public function splitInSeakerView($rows,$entries){
          $Tworld = explode(' ',preg_replace('/[*]/', '', $entries));  
         
        for ($i = 0; $i < count($rows);$i++){
            $Tresult = explode('  ', $rows[$i]->t);
         //   var_dump($Tresult);
            $Tpertinence = array();
            foreach($Tresult as $k => $t){
                 foreach ($Tworld as $word){
                    if (preg_match('/(?<=[\s,.:;"\']|^)' . $word . '(?=[\s,.:;"\']|$)/', $t)){
                        $Tpertinence[] = $t;
                    }
                 }     
            }   
           // var_dump($Tpertinence). 
            $rows[$i]->pertinence = implode(" ",$Tpertinence);
        
        }

        return $rows;   
    }
}