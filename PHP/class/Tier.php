<?php
class Article extends DB
{
    public $id;
    public $project_id;
    public $user_id;
    public $title;
    public $slug;
    public $body;
    public $published;
    public $created;
    public $modified;
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
    public function insertArticle( $projectID, $userID, $title, $slug, $body, $published)
    {
        try {
            $date = date("Y-m-d H:i:s");
            $stmt = $this->pdo->prepare("INSERT INTO articles (project_id,user_id,title, slug,body,published, created, modified) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bindParam(1, $projectID, PDO::PARAM_STR);
            $stmt->bindParam(2, $userID, PDO::PARAM_STR);
            $stmt->bindParam(3, $title, PDO::PARAM_STR);
            $stmt->bindParam(4, $slug, PDO::PARAM_STR);
            $stmt->bindParam(5, $body, PDO::PARAM_STR);
            $stmt->bindParam(6, $published, PDO::PARAM_INT);
            $stmt->bindParam(7, $date, PDO::PARAM_STR);
            $stmt->bindParam(8, $date, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e)
        {
            echo $e;
        }
    }
}