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
        $stmt = $db->pdo->prepare("select tz.tierzuord_id,p.bez parcour,t.bez tier,pos
                                             from Tierzuord tz 
                                             left outer join Parcour p on p.parcour_id = tz.parcour_id
                                             left outer join Tier t on t.tier_id = tz.tier_id
                                            where p.parcour_id = ?");
        $stmt->bindParam(1,$parcour_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function getnextPos(){
        $stmt = $this->pdo->prepare("select max(pos) as pos
                                                from Tierzuord tz
                                               where parcour_id = ?;");
        $stmt->bindParam(1,$this->parcour_id, PDO::PARAM_INT);
        $stmt->execute();
        while($data = $stmt->fetch()){
            $this->pos = ($data['pos']+1);
            return;
        }
    }

    public function insertTierZuord(){
        $stmt = $this->pdo->prepare("insert into Tierzuord(parcour_id,pos) values (?,?)");
        $stmt->bindParam(1,$this->parcour_id,PDO::PARAM_INT);
        $stmt->bindParam(2,$this->pos,PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateTier(){
        $stmt = $this->pdo->prepare("update tierzuord set tier_id = ? where parcour_id = ? and pos = ?");
        $stmt->bindParam(1,$this->tier_id,PDO::PARAM_INT);
        $stmt->bindParam(2,$this->parcour_id,PDO::PARAM_INT);
        $stmt->bindParam(3,$this->pos,PDO::PARAM_INT);
        $stmt->execute();
    }
}
