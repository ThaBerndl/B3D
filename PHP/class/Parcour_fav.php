<?php
class Parcour_fav extends DB{
    public $user_id;
    public $parcour_id;

    public function __construct($user_id = null, $parcour_id = null)
    {
        parent::__construct();
        $this->user_id = $user_id;
        $this->parcour_id = $parcour_id;
    }

    public function insert(){
        $stmt = $this->pdo->prepare("Insert into ParcourFavorit(user_id, parcour_id) values (?,?)");
        $stmt->bindParam(1,$this->user_id,PDO::PARAM_INT);
        $stmt->bindParam(2,$this->parcour_id,PDO::PARAM_INT);
        $stmt->execute();
        $error = $this->pdo->errorInfo();
        return $stmt;
    }

    public static function getFavs($user_id){
        $db = new DB();
        $stmt = $db->pdo->prepare("select * from ParcourFavorit where user_id = ?");
        $stmt->bindParam(1,$user_id,PDO::PARAM_INT);
        $stmt->execute();
        $error = $db->pdo->errorInfo();
        return $stmt;
    }

    public function delete()
    {
        $stmt = $this->pdo->prepare("Delete from ParcourFavorit where user_id = ? and parcour_id = ?");
        $stmt->bindParam(1,$this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(2,$this->parcour_id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->pdo->errorInfo();
    }
}