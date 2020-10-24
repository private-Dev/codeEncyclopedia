<?php 

class Paragraph {

public $_db;

public $id;
public $content;
public $date_created;
public $date_update;
public $fk_blocknote;
public $current_user;
public $rank;

    public function __construct($db) {
    $this->_db = $db;
    }

    public function fetch($id) {
        $sql = "SELECT * FROM  paragraph as t WHERE t.id = ? ";
        $stmt = $this->_db->prepare($sql);
        $result  = $stmt->execute([$id]);
        
        $row = $stmt->fetch(); 
        $this->content = $row->content;
        $this->id = $row->id;
        $this->date_created = $row->date_created;
        $this->date_update = $row->date_update;
        $this->fk_blocknote =  $row->fk_blocknote;
        $this->rank = $row->rank;
        $stmt = null;

        return $result;

    }  
    
    public function getRank($userId,$blockNoteId){
        
        $sql = "SELECT fk_blocknote, rank_display FROM  paragraph_display_user WHERE fk_user = ? AND fk_blocknote = ?";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$userId,$blockNoteId]);
        $row = $stmt->fetch(); 
        $stmt = null;
        return $row;
    }


}