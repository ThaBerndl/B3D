<?php

require_once "DB.php";

class Ort extends DB
{
    public $id;
    public $bez;

    public function __construct($ibez = null)
    {
        parent::__construct();

        $this->bez = $ibez;
    }

    public function insertOrt()
    {
        try {
            if(!$this->checkOrtExists())
            {
                $stmt = $this->pdo->prepare("INSERT INTO Ort (bez) VALUES (?)");
                $stmt->bindParam(1, $this->bez, PDO::PARAM_STR);
                $stmt->execute();
                $this->id = $this->pdo->lastInsertId();
                return true;
            }
            else
            {
                return false;
            }


        } catch (Exception $e)
        {
            echo "<script>alert('$e');</script>";
        }
    }

    public function checkOrtExists()
    {
        try
        {
            $stmt = $this->pdo->prepare("select * from Ort where lower(bez) = lower(?)");
            $stmt->bindParam(1, $this->bez, PDO::PARAM_STR);
            $stmt->execute();

            //27.03 OBLE: Wenn der Ort gefunden wird, wird true zurückgegeben
            while($row = $stmt->fetch())
            {
                return true;
            }
            return false;
        } catch (Exception $e)
        {
            echo $e;
        }
    }

    //OBLE 27.03 Gibt ein Ort Obj mit ID und Bez zurück
    public static function getOrtwithBez($iBez)
    {
        try
        {
            $myOrt = new Ort();
            $stmt = $myOrt->pdo->prepare("SELECT * FROM Ort where lower(bez) = lower(?)");
            $stmt->bindParam(1,$iBez,PDO::PARAM_STR);
            $stmt->execute();
            while($row = $stmt->fetch())
            {
                $myOrt->id = $row['ort_id'];
                $myOrt->bez = $row['bez'];
                return $myOrt;
            }
        }
        catch (Exception $e)
        {
            echo $e;
        }
    }

    public static function getAllOrte()
    {
        $db = new DB();
        $stmt = $db->pdo->prepare("SELECT * FROM Ort");
        $stmt->execute();
        return $stmt;
    }

    public static function getOrt($ort_id){
        $db = new DB();
        $stmt = $db->pdo->prepare("select * from Ort where ort_id  = ?");
        $stmt->bindParam(1,$ort_id, PDO::PARAM_INT);
        $stmt->execute();
        $error=$stmt->errorInfo();
        $data = $stmt->fetchAll();
        $ort = new Ort($data[0]['bez']);
        $ort->id = $ort_id;
        return $ort;
    }
}