<?php
require_once "DB.php";
class Parcour extends DB{

    public $parcour_id;
    public $bez;
    public $ort_id;

    public function __construct($parcour_id = null, $bez = null, $ort_id = null)
    {
        parent::__construct();
        $this->parcour_id = $parcour_id;
        $this->bez = $bez;
        $this->ort_id = $ort_id;
    }

    public static function getAllParcours()
    {
        $db = new DB();
        $stmt = $db->pdo->prepare("SELECT * FROM Parcour");
        $stmt->execute();
        return $stmt;
    }

    public static function getAllParcoursWithOrt($ort_id)
    {
        $db = new DB();
        $stmt = $db->pdo->prepare("Select * from Parcour where ort_id = ?");
        $stmt->bindParam(1,$ort_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
}
