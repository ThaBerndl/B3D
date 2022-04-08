<?php
require_once "DB.php";
class Tier extends DB{

    public $tier_id;
    public $bez;

    public function __construct($tier_id = null, $bez = null)
    {
        parent::__construct();
        $this->tier_id = $tier_id;
        $this->bez = $bez;
    }

    public static function getAllTiere()
    {
        $db = new DB();
        $stmt = $db->pdo->prepare("SELECT * FROM Tier");
        $stmt->execute();
        return $stmt;
    }

    public static function getTierfromBez($bez){
        $db = new DB();
        $stmt = $db->pdo->prepare("SELECT * FROM Tier where bez = ?");
        $stmt->bindParam(1,$bez,PDO::PARAM_STR);
        $stmt->execute();
        while($data = $stmt->fetch())
        {
            return new Tier($data['tier_id'],$data['bez']);
        }
    }

    public static function getTierfromID($id){
        $db = new DB();
        $stmt = $db->pdo->prepare("SELECT * FROM Tier where tier_id = ?");
        $stmt->bindParam(1,$id,PDO::PARAM_INT);
        $stmt->execute();
        while($data = $stmt->fetch())
        {
            return new Tier($data['tier_id'],$data['bez']);
        }
    }

    public static function createTier($bez){
        $db = new DB();
        $stmt = $db->pdo->prepare("Insert into tier (bez) values (?)");
        $stmt->bindParam(1,$bez,PDO::PARAM_STR);
        $stmt->execute();
        $error = $db->pdo->errorInfo();
        return Tier::getTierfromID($db->pdo->lastInsertId());
    }
}
