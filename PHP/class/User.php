<?php
class User extends DB
{
    public $id;
    public $vName;
    public $nName;
    public $nickname;
    public $passwort;

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
            $stmt = $this->pdo->prepare("INSERT INTO User (vName, nName, nickname, passwort) VALUES (?,?,?,?)");
            $stmt->bindParam(1, $vName, PDO::PARAM_STR);
            $stmt->bindParam(2, $nName, PDO::PARAM_STR);
            $stmt->bindParam(3, $nickname, PDO::PARAM_STR);
            $stmt->bindParam(4, $passwort, PDO::PARAM_STR);
            if($stmt->execute())
            {
                $stmt = $this->pdo->prepare("SELECT * FROM User where nickname = ?");
                $stmt->bindParam(1, $vName, PDO::PARAM_STR);
                $stmt->execute();
                while ($row = $stmt->fetch())
                {
                    $this->id = $row['user_id'];
                    return $this->id;
                }
            }
        } catch (Exception $e)
        {
            echo $e;
        }
    }

    public function checkUser()
    {
        try
        {
            $stmt = $this->pdo->prepare("select count(nickname) as nn from User where lower(nickname) = lower(?)");
            $stmt->bindParam(1, $nickname, PDO::PARAM_STR);
            $stmt->execute();

            while($row = $stmt->fetch())
            {
                if($row['nn'] >= 1)
                {
                    return true;    //wenn etwas gefunden wurde -> True
                }
                else
                {
                    return false;    //wenn etwas gefunden wurde -> False
                }
            }
        } catch (Exception $e)
        {
            echo $e;
        }
    }
}