<?php
require_once "DB.php";
class Freund
{
    public $user_id;
    public $freund_id;
    public $db;

    public function __construct($user, $freund)
    {
        $this->user_id = $user;
        $this->freund_id = $freund;
        $this->db = new DB();
    }

    public function insertFreund()
    {
        $stmt = $this->db->pdo->prepare("INSERT INTO Freund (user_id, freund_id) VALUES (?,?)");
        $stmt->bindParam(1, $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $this->freund_id, PDO::PARAM_INT);
        return($stmt->execute()); //True wenn erfolgreich False wenn fehlgeschlagen
    }

    public static function getAllFreunde($user_id)
    {
        $db = new DB();
        $stmt = $db->pdo->prepare("SELECT * FROM Freund where user_id = ?");
        $stmt->bindParam(1,$user_id, PDO::PARAM_INT);
        $stmt->execute();
        $cnt = 0;
        $freunde = array();
        while($row = $stmt->fetch())
        {
            $freunde[$cnt] = new Freund($row['user_id'],$row['freund_id']);
            $cnt = $cnt+1;
        }
        unset($row);
        return $freunde;
    }

    public function delFreund()
    {
        $stmt = $this->db->pdo->prepare("Delete from Freund where user_id = ? and freund_id = ?");
        $stmt->bindParam(1,$this->user_id , PDO::PARAM_INT);
        $stmt->bindParam(2,$this->freund_id , PDO::PARAM_INT);
        $stmt->execute();
    }

    public function checkFreund()
    {
        $stmt = $this->db->pdo->prepare("select * from Freund where user_id = ? and freund_id = ?");
        $stmt->bindParam(1, $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $this->freund_id, PDO::PARAM_INT);
        $stmt->execute();
        while($row = $stmt->fetch())
        {
            return true;
        }
        return false;
    }

}