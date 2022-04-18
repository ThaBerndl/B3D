<?php
class Punkte_data extends DB{
    public $ID;
    public $punkte;
    public $pos;
    public $tz_id;
    public $tier_id;
    public $tier_bez;
    public $user_id;
    public $user_vname;
    public $user_nname;
    public $user_nickname;
    public $game_id;
    public $game_created;

    public function __construct($id = null,$punkte= null,$pos=null, $tz_id = null, $tier_id= null, $tier_bez= null,$user_id= null, $user_vname= null,$user_nname= null, $user_nickname= null, $game_id= null, $game_created= null)
    {
        parent::__construct();
        $this->ID = $id;
        $this->punkte = $punkte;
        $this->pos = $pos;
        $this->tz_id = $tz_id;
        $this->tier_id = $tier_id;
        $this->tier_bez = $tier_bez;
        $this->user_id = $user_id;
        $this->user_vname = $user_vname;
        $this->user_nname = $user_nname;
        $this->user_nickname = $user_nickname;
        $this->game_id = $game_id;
        $this->game_created = $game_created;
    }

    public static function getDataAkt($game_id,$pos){
        $db = new DB();
        $stmt = $db->pdo->prepare("select 	p.punktestand_id 'ID',
                                                    p.punkte 'punkte',
                                                    tz.pos 'pos',
                                                    tz.tierzuord_id 'tz_id',
                                                    t.tier_id 'tier_id', 
                                                    t.bez 'tier_bez', 
                                                    p.user_id 'user_id', 
                                                    u.vName 'user_vname', 
                                                    u.nName 'user_nname', 
                                                    u.nickname 'user_nickname', 
                                                    p.game_id 'game_id', 
                                                    g.created 'game_created' 
                                                from Punktestand p,
                                                     Tierzuord tz,
                                                     Tier t,
                                                     User u,
                                                     Game g
                                               where p.game_id = ?
                                                 and tz.pos = ?
                                                 and tz.tierzuord_id = p.tierzuord_id
                                                 and t.tier_id = tz.tier_id
                                                 and u.user_id = p.user_id
                                                 and g.game_id = p.game_id");
        $stmt->bindParam(1,$game_id, PDO::PARAM_INT);
        $stmt->bindParam(2,$pos, PDO::PARAM_INT);
        $stmt->execute();
        $error = $stmt->errorInfo();
        $dataArr = array();
        while($data = $stmt->fetch())
        {
            $punkte_data = new Punkte_data($data['ID'],$data['punkte'],$data['pos'], $data['tz_id'], $data['tier_id'],$data['tier_bez'],$data['user_id'],$data['user_vname'],$data['user_nname'],$data['user_nickname'],$data['game_id'],$data['game_created'],);
            array_push($dataArr,$punkte_data);
        }
        return $dataArr;
    }

    public static function getSum($game_id, $user_id){
        $db = new DB();
        $stmt = $db->pdo->prepare("select sum(punkte) 'summe'
                                              from punktestand
                                             where game_id = ?
                                               and user_id = ?");
        $stmt->bindParam(1,$game_id, PDO::PARAM_INT);
        $stmt->bindParam(2,$user_id, PDO::PARAM_INT);
        $stmt->execute();
        $error = $stmt->errorInfo();
        while($data = $stmt->fetch()){
            return $data['summe'];
        }
    }

    public static function getPerc($game_id, $user_id){
        $db = new DB;
        $stmt = $db->pdo->prepare("select parcour_id from Game where game_id = ?");
        $stmt->bindParam(1,$game_id, PDO::PARAM_INT);
        $stmt->execute();
        $error = $stmt->errorInfo();

        $data = $stmt->fetchAll();
        $tz = new Tierzuord();
        $tz->parcour_id = $data[0]['parcour_id'];
        $tz->getAktPos();
        $maxSum = $tz->pos*20;
        $sum = self::getSum($game_id,$user_id);
        return $sum*100/$maxSum;
    }

    public static function getMisses($game_id, $user_id){
        $db = new DB();
        $stmt = $db->pdo->prepare("   select count(punkte)  'misses'
                                                 from Punktestand
                                                where game_id = ?
                                                  and user_id = ?
                                                  and (punkte = 0
                                                   or punkte is null)");
        $stmt->bindParam(1,$game_id, PDO::PARAM_INT);
        $stmt->bindParam(2,$user_id, PDO::PARAM_INT);
        $stmt->execute();
        $error = $stmt->errorInfo();
        while($data = $stmt->fetch()){
            return $data['misses'];
        }
    }

    public static function getMaxPos($game_id)
    {
        $db = new DB();
        $stmt = $db->pdo->prepare("select max(pos) 'maxPos'
                                              from Game g,
                                                   Parcour p,
                                                   Tierzuord tz
                                             where g.game_id = ?
                                               and g.parcour_id = p.parcour_id
                                               and p.parcour_id = tz.parcour_id");
        $stmt->bindParam(1,$game_id, PDO::PARAM_INT);
        $stmt->execute();
        $error = $stmt->errorInfo();
        while($data = $stmt->fetch()){
            return $data['maxPos'];
        }
    }

    public static function getArrow1($game_id, $user_id){
        $db = new DB();
        $stmt = $db->pdo->prepare("   select count(punkte)  'arrow1'
                                                 from Punktestand
                                                where game_id = ?
                                                  and user_id = ?
                                                  and punkte in (20,18,16);");
        $stmt->bindParam(1,$game_id, PDO::PARAM_INT);
        $stmt->bindParam(2,$user_id, PDO::PARAM_INT);
        $stmt->execute();
        $error = $stmt->errorInfo();
        while($data = $stmt->fetch()){
            return $data['arrow1'];
        }
    }

    public static function getArrow2($game_id, $user_id){
        $db = new DB();
        $stmt = $db->pdo->prepare("   select count(punkte)  'arrow2'
                                                 from Punktestand
                                                where game_id = ?
                                                  and user_id = ?
                                                  and punkte in (14,12,10);");
        $stmt->bindParam(1,$game_id, PDO::PARAM_INT);
        $stmt->bindParam(2,$user_id, PDO::PARAM_INT);
        $stmt->execute();
        $error = $stmt->errorInfo();
        while($data = $stmt->fetch()){
            return $data['arrow2'];
        }
    }

    public static function getArrow3($game_id, $user_id){
        $db = new DB();
        $stmt = $db->pdo->prepare("   select count(punkte)  'arrow3'
                                                 from Punktestand
                                                where game_id = ?
                                                  and user_id = ?
                                                  and punkte in (8,6,4);");
        $stmt->bindParam(1,$game_id, PDO::PARAM_INT);
        $stmt->bindParam(2,$user_id, PDO::PARAM_INT);
        $stmt->execute();
        $error = $stmt->errorInfo();
        while($data = $stmt->fetch()){
            return $data['arrow3'];
        }
    }

    public static function getPunkte($game_id, $user_id, $pos){
        $db = new DB();
        $stmt = $db->pdo->prepare("   select punkte
                                                 from Punktestand p,
                                                      Tierzuord tz
                                                where game_id = ?
                                                  and user_id = ?
                                                  and p.tierzuord_id = tz.tierzuord_id
                                                  and tz.pos = ?;");
        $stmt->bindParam(1,$game_id, PDO::PARAM_INT);
        $stmt->bindParam(2,$user_id, PDO::PARAM_INT);
        $stmt->bindParam(3,$pos, PDO::PARAM_INT);
        $stmt->execute();
        $error = $stmt->errorInfo();
        while($data = $stmt->fetch()){
            return $data['punkte'];
        }
    }
}