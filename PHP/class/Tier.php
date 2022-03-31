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
}
