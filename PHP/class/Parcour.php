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

    public static function getAllParcoursWithOrt($ortbez)
    {
        $db = new DB();
        $stmt = $db->pdo->prepare("Select p.* from Parcour p, Ort o where o.ort_id = p.ort_id and o.bez = ?");
        $stmt->bindParam(1,$ortbez, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }

    public static function getIDWithNames($parcourbez, $ortbez){
        $db = new DB();
        $stmt = $db->pdo->prepare("select p.* 
                                              from Parcour p, 
                                                   Ort o
                                             where p.ort_id = o.ort_id
                                               and p.bez = ?
                                               and o.bez = ?");
        $stmt->bindParam(1,$parcourbez, PDO::PARAM_STR);
        $stmt->bindParam(2,$ortbez, PDO::PARAM_STR);
        $stmt->execute();
        while($data = $stmt->fetch())
        {
            return $data['parcour_id'];
        }
    }
    public function create(){
        $stmt = $this->pdo->prepare("Insert into Parcour (bez, ort_id) values(?,?)");
        $stmt->bindParam(1,$this->bez,PDO::PARAM_STR);
        $stmt->bindParam(2,$this->ort_id,PDO::PARAM_INT);
        $stmt->execute();
        $error = $stmt->errorInfo();
        $this->parcour_id = $this->pdo->lastInsertId();

    }
}
