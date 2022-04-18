<?php
class Game extends DB{
    public $game_id;
    public $created;
    public $parcour_id;
    
    public function __construct($game_id = null, $created = null, $parcour_id = null)
    {
        parent::__construct();
        $this->game_id = $game_id;
        $this->created = $created;
        $this->parcour_id = $parcour_id;
    }

    public static function getGame($game_id){
        $db = new DB();
        $stmt = $db->pdo->prepare("select * from Game where game_id  = ?");
        $stmt->bindParam(1,$game_id, PDO::PARAM_INT);
        $stmt->execute();
        $error=$stmt->errorInfo();
        $data = $stmt->fetchAll();
        return new Game($data[0]['game_id'],$data[0]['created'],$data[0]['parcour_id']);
    }

    public static function getGamesFromUser($user_id){
        $db = new DB();
        $stmt = $db->pdo->prepare("select g.game_id 'game_id',
                                                   p.bez 'parcour', 
                                                   o.bez 'ort', 
                                                   g.created 'created' 
                                              from Parcour p,
                                                   Ort o,
                                                   Game g,
                                                   Punktestand pu
                                             where p.ort_id = o.ort_id
                                               and g.parcour_id = p.parcour_id
                                               and pu.game_id = g.game_id
                                               and user_id = ?
                                             group by p.bez, o.bez, g.created
                                             order by created desc");
        $stmt->bindParam(1,$user_id, PDO::PARAM_INT);
        $stmt->execute();
        $error=$stmt->errorInfo();
        return $stmt;
    }

    public static function insertGame($parcour_id)
    {
        $db = new DB();
        $stmt = $db->pdo->prepare("insert into Game(created, parcour_id) values(CURRENT_TIME(), ?);");
        $stmt->bindParam(1,$parcour_id, PDO::PARAM_INT);
        $stmt->execute();
        $error=$stmt->errorInfo();
        return $stmt;
    }

    public static function getLastGame()
    {
        $db = new DB();
        $stmt = $db->pdo->prepare("select game_id from Game order by created desc limit 1");
        $stmt->bindParam(1,$parcour_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();

        return $row[0];
    }
}