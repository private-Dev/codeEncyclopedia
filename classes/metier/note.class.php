<?php 

class Note {

public $_db;

public $id;
public $label;
public $date_created;
public $date_update;
public $fk_blocknote;
public $rank;
public $toolTipMsg;

public $current_user;

    public function __construct($db){
    $this->_db = $db;
    }

    public function fetch($id){
        
        $sql = "SELECT * FROM  note as t WHERE t.id = ? ";
        try {
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(); 

        $this->id = $row->id;
        $this->label = $row->label;
        $this->fk_blocknote = $row->fk_blocknote;   
        $this->date_created = $row->date_created;
        $this->date_update = $row->date_update;
        $this->rank = $row->rank;

        $stmt = null;
        }catch(Exception $e){
            die("Oh noes! There's an error in the query!");
        }
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

    public function getRows($userId,$blocknoteId){
        
        $sql = "SELECT n.id as rowid, ";
        $sql .= " n.label, ";
        $sql .= " n.rank, ";
        $sql .= " n.date_created, ";
        $sql .= " n.date_update, ";
        $sql .= " n.toolTipMsg ";
        $sql .= " FROM note as n";
        $sql .= " LEFT JOIN  note_display_user as nd ON  n.id = nd.fk_note AND nd.fk_user = ?";
        $sql .= " WHERE n.fk_blocknote = ?";
        $sql .= " ORDER BY nd.rank_display,n.rank";
        try {    
            $stmt = $this->_db->prepare($sql);
        
            $stmt->execute([$userId,intval($blocknoteId)]);
            $rows = $stmt->fetchAll(); 
            $stmt = null;
            return $rows;
        }catch(Exception $e){
            die("note Get row  errors in querry");
        }
    }

    public function getMaxRank(){
        $sql = "SELECT MAX(rank) as nb FROM note";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(); 
        $stmt = null;
        return $result;
    }

    public function getNbRows(){
        $sql = "SELECT count(*) as nb FROM note";
        try {  
            $stmt = $this->_db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(); 
            $stmt = null;
            return $result;
        }catch(Exception $e){
            die("note Get Nb row  errors in querry");
        }
    }

    public function  create($label,$fkBlocknote,$rank,$toolTipMsg){

        $date = date('Y-m-d H:i:s');
        // prepare and bind
        try { 
            $stmt = $this->_db->prepare("INSERT INTO note (fk_blocknote,rank,label,date_created,date_update,toolTipMsg) VALUES (:fk_blocknote,:rank,:label,:date_c,:date_u,:toolTipMsg)");

            $stmt->bindParam(':fk_blocknote',$fkBlocknote);
            $stmt->bindParam(':rank', $rank);
            $stmt->bindParam(':label', $label);
            $stmt->bindParam(':date_c', $date);
            $stmt->bindParam(':date_u', $date);
            $stmt->bindParam(':toolTipMsg', $toolTipMsg);
            $stmt->execute();
            $stmt = null;
            return $this->_db->lastInsertId(); 
        }catch(Exception $e){
            die("crate note  errors in querry");
        }
    }

    public function deleteAllParagraphLinkedTo (){
        try{   
              $sql ="DELETE FROM paragraph WHERE fk_note = ?";
              $stmt = $this->_db->prepare($sql);
              $stmt->execute([$this->id]);  
              $stmt = null;
              return 1; 
        }catch(Exception $e){
            die("delete all paragraphs linked to note errors in querry");        
        }
    }

    public function delete (){
         $result = $this->deleteAllParagraphLinkedTo();
         if ($result){
            try{   
                $sql ="DELETE FROM note WHERE id = ?";
                $stmt = $this->_db->prepare($sql);
                $stmt->execute([$this->id]);  
                $stmt = null;
                return 1; 
          }catch(Exception $e){
              die("delete note error in querry");
          }
         }
    }
}

?>