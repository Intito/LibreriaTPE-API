<?php
require_once 'model.php';

class UserModel extends model{

    public function getUserByName($name) {    
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE nombre = ?");
        $query->execute([$name]);
        
        $user = $query->fetch(PDO::FETCH_OBJ);
        
        return $user;
    }
}