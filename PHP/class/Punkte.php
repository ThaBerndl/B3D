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

    public static function insertPunkteStand($game_id, $user_id, $tz_id, $punkte)
    {
        $db = new DB();
        $stmt = $db->pdo->prepare("insert into Punktestand(game_id, user_id, tierzuord_id, punkte) values(?, ?, ?, ?)");
        $stmt->bindParam(1,$game_id,PDO::PARAM_INT);
        $stmt->bindParam(2,$user_id,PDO::PARAM_INT);
        $stmt->bindParam(3,$tz_id,PDO::PARAM_INT);
        $stmt->bindParam(4,$punkte,PDO::PARAM_INT);
        $stmt->execute();
        $error = $stmt->errorInfo();
    }

    public static function getFirstTierzuord($parcour_id)
    {
        $db = new DB();
        $stmt = $db->pdo->prepare("select tierzuord_id from Tierzuord where parcour_id = ? and pos = 1");
        $stmt->bindParam(1,$parcour_id,PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
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
        $stmt = $db->pdo->prepare("update Punktestand 
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

    public static function createnextPos($game_id, $pos)
    {
        $prevpos = $pos-1;
        $db = new DB();
            //if entries already exist then do nothing
        $check = $db->pdo->prepare("select count(*) 
                                            from Punktestand p, 
                                                 Tierzuord tz 
                                           where p.tierzuord_id = tz.tierzuord_id 
                                             and game_id = ?
                                             and pos = ?");
        $check->bindParam(1, $game_id, PDO::PARAM_INT);
        $check->bindParam(2, $pos, PDO::PARAM_INT);
        $check->execute();
        $error = $check->errorInfo();
        $cnt = $check->fetchAll();
        if ($cnt[0][0] == 0) {
            //die User vom aktuellen Spiel raussuchen
            $users = $db->pdo->prepare("select * 
                                                from Punktestand p, 
                                                     Tierzuord tz 
                                               where p.tierzuord_id = tz.tierzuord_id 
                                                 and game_id = ?
                                                 and pos = ?");
            $users->bindParam(1, $game_id, PDO::PARAM_INT);
            $users->bindParam(2, $prevpos, PDO::PARAM_INT);
            $users->execute();
            $error = $users->errorInfo();


            $tierzuordstmt = $db->pdo->prepare("select tz.tierzuord_id 
                                                           from Game g,
                                                                Tierzuord tz
                                                          where g.game_id = ?
                                                            and tz.parcour_id = g.parcour_id
                                                            and tz.pos = ?");
            $tierzuordstmt->bindParam(1, $game_id, PDO::PARAM_INT);
            $tierzuordstmt->bindParam(2, $pos, PDO::PARAM_INT);
            $tierzuordstmt->execute();
            $error = $tierzuordstmt->errorInfo();
            $tierzuord = $tierzuordstmt->fetchAll();

            while ($data = $users->fetch()) {
                $insert = $db->pdo->prepare("insert into Punktestand (game_id, user_id, tierzuord_id) values(?,?,?)");
                $insert->bindParam(1, $game_id, PDO::PARAM_INT);
                $insert->bindParam(2, $data['user_id'], PDO::PARAM_INT);
                $insert->bindParam(3, $tierzuord[0]['tierzuord_id'], PDO::PARAM_INT);
                $insert->execute();
                $error = $insert->errorInfo();
            }
        }
    }
}