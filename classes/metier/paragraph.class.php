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
     * 
     */
    public function fetch($id) {
        $sql = "SELECT * FROM  paragraph as t WHERE t.fk_note = ? ";
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

    }
    /**
    * 
    */
    public function getRows($userId,$noteId){

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

    public function create($fk_note,$content,$rank){
        $date = date('Y-m-d H:i:s');
        // prepare and bind
        $stmt = $this->_db->prepare("INSERT INTO paragraph (fk_note,rank,content,date_created,date_update) VALUES (:fk_note,:rank,:content,:date_c,:date_u)");

        $stmt->bindParam(':fk_note',$fk_note);
        $stmt->bindParam(':rank', $rank);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':date_c', $date);
        $stmt->bindParam(':date_u', $date);
        
        $stmt->execute();
        $stmt = null;
        return $this->_db->lastInsertId(); 
    }

}