<?php
require_once "DB.php";
class User extends DB
{
    public $id;
    public $vName;
    public $nName;
    public $nickname;
    public $passwort;
    public $newPasswort;

    public function __construct($iNickname=null, $iVName=null, $iNName=null, $iPasswort=null)
    {
        parent::__construct();

        $this->vName = $iVName;
        $this->nName = $iNName;
        $this->nickname = $iNickname;
        $this->passwort = $iPasswort;
    }

    public function getAllArticles()
    {
        try{
            $sql = $this->pdo->prepare("SELECT * FROM articles");
            $sql->execute();
            while ($row = $sql->fetch())
            {
                echo "<h1>".$row['title']."</h1><br />";
            }
        } catch(Exception $e)
        {
            echo $e;
        }
    }

    public function insertUser()
    {
        try {
            $this->newPasswort = $this->passwort;
            if(!$this->getUser())
            {
                $stmt = $this->pdo->prepare("INSERT INTO User (vName, nName, nickname, passwort) VALUES (?,?,?,?)");
                $stmt->bindParam(1, $this->vName, PDO::PARAM_STR);
                $stmt->bindParam(2, $this->nName, PDO::PARAM_STR);
                $stmt->bindParam(3, $this->nickname, PDO::PARAM_STR);
                $stmt->bindParam(4, $this->passwort, PDO::PARAM_STR);
                $stmt->execute();

                return true;
            }
            else
            {
                if($this->passwort == null || $this->passwort == '')
                {
                    $stmt = $this->pdo->prepare("update User Set passwort = ? Where nickname = ?");
                    $stmt->bindParam(1, $this->newPasswort, PDO::PARAM_STR);
                    $stmt->bindParam(2, $this->nickname, PDO::PARAM_STR);
                    $stmt->execute();
                    return true;
                }
                else
                {
                    return false;
                }
            }


        } catch (Exception $e)
        {
            echo "<script>alert('$e');</script>";
        }
    }

    public function getUser()
    {
        try
        {
            $stmt = $this->pdo->prepare("select * from User where lower(nickname) = lower(?)");
            $stmt->bindParam(1, $this->nickname, PDO::PARAM_STR);
            $stmt->execute();

            //27.03 NALU: Wenn der User gefunden wird, werden die daten
            while($row = $stmt->fetch())
            {
                $this->vName = $row['vName'];
                $this->nName = $row['nName'];
                $this->passwort = $row['passwort'];
                $this->id = $row['user_id'];
                return true;
            }
            return false;
        } catch (Exception $e)
        {
            echo $e;
        }
    }

    public function checkLogin()
    {
        $stmt = $this->pdo->prepare("select * from User where nickname = ? and passwort = ?");
        $stmt->bindParam(1, $this->nickname, PDO::PARAM_STR);
        $stmt->bindParam(2, $this->passwort, PDO::PARAM_STR);
        $stmt->execute();

        //26.03 BEST: wenn etwas gefunden wurde dann Details speichern und True als return wert, wenn nicht dann false zurückgeben
        while($row = $stmt->fetch())
        {
            $this->vName = $row['vName'];
            $this->nName = $row['nName'];
            $this->id = $row['user_id'];
            return true;
        }
        return false;
    }

    //BEST 26.03 Ein User Objekt mithilfe der User_id bekommen
    public static function getUserwithID($id)
    {
        $user = new User();
        $stmt = $user->pdo->prepare("SELECT * FROM User where user_id = ?");
        $stmt->bindParam(1,$id,PDO::PARAM_INT);
        $stmt->execute();
        while($row = $stmt->fetch())
        {
            $user->id = $row['user_id'];
            $user->nickname = $row['nickname'];
            $user->vName = $row['vName'];
            $user->nName = $row['nName'];
            $user->passwort = $row['passwort'];
            return $user;
        }
    }

    //BEST 26.03 Ein User Objekt mithilfe der User_id bekommen
    public function getUserwithNick()
    {
        $user = new User();
        $stmt = $user->pdo->prepare("SELECT * FROM User where nickname = ?");
        $stmt->bindParam(1,$this->nickname,PDO::PARAM_STR);
        $stmt->execute();
        while($row = $stmt->fetch())
        {
            $user->id = $row['user_id'];
            $user->vName = $row['vName'];
            $user->nName = $row['nName'];
            $user->passwort = $row['passwort'];
            return $user;
        }
    }
}