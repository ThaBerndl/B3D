<?php
class User extends DB
{
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
            $stmt = $this->pdo->prepare("INSERT INTO user (vName, nName, nickname, passwort) VALUES (?,?,?,?)");
            $stmt->bindParam(1, $vName, PDO::PARAM_STR);
            $stmt->bindParam(2, $nName, PDO::PARAM_STR);
            $stmt->bindParam(3, $nickname, PDO::PARAM_STR);
            $stmt->bindParam(4, $passwort, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e)
        {
            echo $e;
        }
    }

    public function checkUser()
    {
        try {
            $stmt = $this->pdo->prepare("select INTO user (vName, nName, nickname, passwort) VALUES (?,?,?,?)");
            $stmt->bindParam(1, $vName, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e)
        {
            echo $e;
        }
    }
}