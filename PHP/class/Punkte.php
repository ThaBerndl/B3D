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
}