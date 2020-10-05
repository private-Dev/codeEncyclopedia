<?php 

class Note {

public $_db;

public $id;
public $label;
public $date_created;
public $date_update;
public $fk_theme;

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

    public function getRows($userId,$blocknoteId){
        
        $sql = "SELECT n.id as rowid FROM note as n";
        $sql .= " LEFT JOIN  note_display_user as nd ON  n.id = nd.fk_note AND nd.fk_user = ?";
        $sql .= " WHERE n.fk_blocknote = ?";
        $sql .= " ORDER BY nd.rank_display,n.rank";
      
        $stmt = $this->_db->prepare($sql);
       
        $stmt->execute([$userId,intval($blocknoteId)]);
        $rows = $stmt->fetchAll(); 
        $stmt = null;
        return $rows;
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
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(); 
        $stmt = null;
        return $result;
    }

    public function  create($beware,$big_title,$title,$important_comment,$comment,$comment_bar,$code_block,$block_img,$hash_title){

        $date = date('Y-m-d H:i:s');
            // prepare and bind
        $stmt = $this->_db->prepare("INSERT INTO note (beware,big_title,title,important_comment,comment,comment_bar,code_block,block_img,hash_title) VALUES (:beware,:big_title,:title,:important_comment,:comment,:comment_bar,:code_block,:block_img,:hash_title)");
       
        $stmt->bindParam(':beware', $beware);

        $stmt->bindParam(':big_title', $big_title);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':important_comment', $important_comment);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':comment_bar', $comment_bar);
        $stmt->bindParam(':code_block', $code_block);
        $stmt->bindParam(':comment_bar', $comment_bar);
        $stmt->bindParam(':hash_title', $hash_title);
        $stmt->bindParam(':block_img', $block_img);
        // need created at, updated at
        $stmt->execute();
        $stmt = null;
        return $this->_db->lastInsertId(); 
    }
}

?>