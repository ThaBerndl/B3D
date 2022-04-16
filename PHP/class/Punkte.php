<?php
class Punkte extends DB
{
    public $punktestand_id;
    public $game_id;
    public $user_id;
    public $tierzuord_id;
    public $punkte;

    public function __construct($punktestand_id = null,$game_id = null,$user_id = null,$tierzuord_id = null,$punkte = null)
    {
        parent::__construct();
        $this->punktestand_id = $punktestand_id;
        $this->game_id = $game_id;
        $this->user_id = $user_id;
        $this->tierzuord_id = $tierzuord_id;
        $this->punkte = $punkte;
    }

    public static function insertpoints($game_id, $user_id,$tz_id, $arrow, $zone, $zaehlweise = 3){
        $points = 0;
        if ($arrow == 1){
            switch ($zone){
                case 'center':
                    $points = 20;
                    break;
                case 'kill':
                    $points = 18;
                    break;
                case 'body':
                    $points = 16;
                    break;
            }
        }elseif ($arrow == 2){
            switch ($zone){
                case 'center':
                    $points = 14;
                    break;
                case 'kill':
                    $points = 12;
                    break;
                case 'body':
                    $points = 10;
                    break;
            }
        }elseif ($arrow == 3){
            switch ($zone){
                case 'center':
                    $points = 8;
                    break;
                case 'kill':
                    $points = 6;
                    break;
                case 'body':
                    $points = 4;
                    break;
            }
        }
        $db = new DB();
        $stmt = $db->pdo->prepare("update punktestand 
                                               set punkte = ?
                                             where game_id = ?
                                               and user_id = ?
                                               and tierzuord_id = ?");
        $stmt->bindParam(1,$points,PDO::PARAM_INT);
        $stmt->bindParam(2,$game_id,PDO::PARAM_INT);
        $stmt->bindParam(3,$user_id,PDO::PARAM_INT);
        $stmt->bindParam(4,$tz_id,PDO::PARAM_INT);
        $stmt->execute();
        $error = $stmt->errorInfo();
    }
}