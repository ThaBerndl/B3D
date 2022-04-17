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
        $stmt = $db->pdo->prepare("select * from game where game_id  = ?");
        $stmt->bindParam(1,$game_id, PDO::PARAM_INT);
        $stmt->execute();
        $error=$stmt->errorInfo();
        $data = $stmt->fetchAll();
        return new Game($data[0]['game_id'],$data[0]['created'],$data[0]['parcour_id']);
    }
}