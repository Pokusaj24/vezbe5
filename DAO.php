<?php
require_once 'db.php';

class DAO {
    private $db;
    private $UPDATEPASS = "UPDATE klijent SET pass = ? WHERE user = ?";
    private $USEREXIST = "SELECT * FROM klijent WHERE user = ? AND pass = ?";
    private $SELECTUSER = "SELECT * FROM klijent WHERE user = ?";

    public function __construct() {
        $this->db = DB::createInstance();
    }

    public function getKlijentbyUsername($user) {
        $statement = $this->db->prepare($this->SELECTUSER);
        $statement->bindValue(1, $user);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function updatePass($user, $pass) {
        $statement = $this->db->prepare($this->UPDATEPASS);
        $statement->bindValue(1, $pass);
        $statement->bindValue(2, $user);
        $statement->execute();
    }

    public function klijentExist($user, $pass) {
        $statement = $this->db->prepare($this->USEREXIST);
        $statement->bindValue(1, $user);
        $statement->bindValue(2, $pass);
        $statement->execute();
        $result = $statement->fetchAll();
        return !empty($result);
    }
}
?>
