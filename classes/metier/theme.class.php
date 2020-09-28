<?php 

class Theme {

public $_db;

public $id;
public $label;
public $date_created;
public $date_updated;

public $current_user;

    public function __construct($db){
    $this->_db = $db;
    }


    public function getRank($userId,$themeId){
        
        $sql = "SELECT fk_theme,rank_display FROM  theme_display_user as td WHERE td.fk_user = ? AND fk_theme = ?";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$userId,$themeId]);
        $row = $stmt->fetch(); 
        $stmt = null;
        return $row;
    }

    public function updateUserRank($userId,$current_theme,$rank){
        $sql="UPDATE theme_display_user   
        SET `rank_display` = :rank
        WHERE `fk_user` = :user_id  AND fk_theme = :current_theme";
    
         $statement = $this->_db->prepare($sql);
    
        $statement->bindValue(":rank", $rank);
        $statement->bindValue(":user_id", $userId);
        $statement->bindValue(":current_theme", $current_theme);
    
        $count = $statement->execute();
    }

    public function getRows($userId){
        
        $sql = "SELECT t.id as rowid, t.label , t.date_created,t.toolTipMsg FROM theme as t ";
        $sql .= "LEFT JOIN  theme_display_user as td ON  t.id = td.fk_theme AND td.fk_user = ? ";
        $sql .= "ORDER BY td.rank_display,t.rank";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$userId]);
        $rows = $stmt->fetchAll(); 
        $stmt = null;
        return $rows;
    }

    
}

?>