<?php
require_once "DB.php";
class Tierzuord extends DB{

    public $tierzuord_id;
    public $parcour_id;
    public $tier_id;
    public $pos;

    public function __construct($tierzuord_id = null, $parcour_id = null, $tier_id = null, $pos = null)
    {
        parent::__construct();
        $this->tierzuord_id = $tierzuord_id;
        $this->parcour_id = $parcour_id;
        $this->tier_id = $tier_id;
        $this->pos = $pos;
    }

    public static function getAllParcours()
    {
        $db = new DB();
        $stmt = $db->pdo->prepare("SELECT * FROM Tierzuord");
        $stmt->execute();
        return $stmt;
    }

    public static function getAllTiereFromParcour($parcour_id)
    {
        $db = new DB();
        $stmt = $db->pdo->prepare("Select * from Tierzuord where parcour_id = ?");
        $stmt->bindParam(1,$parcour_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
}
