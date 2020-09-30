<?php 

class Blocknote {

public $_db;

public $id;
public $label;
public $date_created;
public $date_update;

public $current_user;

    public function __construct($db){
    $this->_db = $db;
    }


    public function getRank($userId,$blockNoteId){
        
        $sql = "SELECT fk_blocknote, rank_display FROM  blocknote_display_user WHERE fk_user = ? AND fk_blocknote = ?";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$userId,$blockNoteId]);
        $row = $stmt->fetch(); 
        $stmt = null;
        return $row;
    }

    public function updateUserRank($userId,$current_blocknote,$rank){
        $sql="UPDATE blocknote_display_user   
        SET `rank_display` = :rank
        WHERE `fk_user` = :user_id  AND fk_blocknote = :current_blocknote";
    
         $statement = $this->_db->prepare($sql);
    
        $statement->bindValue(":rank", $rank);
        $statement->bindValue(":user_id", $userId);
        $statement->bindValue(":current_blocknote", $current_blocknote);
    
        $count = $statement->execute();
    }

    public function getRows($userId){
        
        $sql = "SELECT b.id as rowid, b.label , b.date_created,t.toolTipMsg FROM blocknote as b ";
        $sql .= "LEFT JOIN  blocknote_display_user as td ON  b.id = td.fk_theme AND td.fk_user = ? ";
        $sql .= "ORDER BY td.rank_display,b.rank";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$userId]);
        $rows = $stmt->fetchAll(); 
        $stmt = null;
        return $rows;
    }

    public function getMaxRank(){
        $sql = "SELECT MAX(rank) as nb FROM blocknote";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(); 
        $stmt = null;
        return $result;
    }

    public function getNbRows(){
        $sql = "SELECT count(*) as nb FROM blocknote";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(); 
        $stmt = null;
        return $result;
    }

    public function  create($label,$tooltip,$rank){

        $date = date('Y-m-d H:i:s');
            // prepare and bind
        $stmt = $this->_db->prepare("INSERT INTO blocknote (label,toolTipMsg, rank,date_created,date_update) VALUES (:label,:toolTip,:rank,:date_c,:date_u)");
        $stmt->bindParam(':label', $label);
        $stmt->bindParam(':toolTip', $tooltip);
        $stmt->bindParam(':rank', $rank);
        $stmt->bindParam(':date_c', $date);
        $stmt->bindParam(':date_u', $date);
        $stmt->execute();
        $stmt = null;
        return $this->_db->lastInsertId(); 
    }
}

?>