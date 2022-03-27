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
}