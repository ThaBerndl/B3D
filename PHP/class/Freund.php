<?php
class Freund extends DB
{
    public $user_id;
    public $freund_id;

    public function __construct($user_id = null, $freund_id = null)
    {
        $this->user_id = $user_id;
        $this->freund_id = $freund_id;
    }

    public function insertFreund()
    {
        $stmt = $this->pdo->prepare("INSERT INTO Freund (user_id, freund_id) VALUES (?,?)");
        $stmt->bindParam(1, $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $this->freund_id, PDO::PARAM_INT);
        return($stmt->execute()); //True wenn erfolgreich False wenn fehlgeschlagen
    }
}